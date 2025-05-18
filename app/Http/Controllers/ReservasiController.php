<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;
use App\Models\Pelanggan;
use App\Models\Paket_Wisata;
use App\Models\Diskon;
use App\Models\Reservasi;
use App\Models\Jenis_Pembayaran;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ReservasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        // Ambil data paket wisata
        $paket_wisata = Paket_Wisata::findOrFail($id);
        
        // Ambil data pelanggan berdasarkan user yang login
        $user = Auth::user();
        $pelanggan = Pelanggan::where('id_user', $user->id)->firstOrFail();
        
        // Ambil data diskon yang aktif
        $diskons = Diskon::where('aktif', true)
                        ->where('tanggal_mulai', '<=', now())
                        ->where('tanggal_berakhir', '>=', now())
                        ->get();
        
        // Ambil data jenis pembayaran
        $jenis_pembayarans = Jenis_Pembayaran::all();
        
        return view('reservasi.index', compact(
            'paket_wisata',
            'pelanggan',
            'user',
            'diskons',
            'jenis_pembayarans'
        ))->with('title', 'Reservasi');;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_paket_wisata' => 'required|exists:paket_wisatas,id',
            'id_diskon' => 'nullable|exists:diskons,id',
            'id_jenis_pembayaran' => 'required|exists:jenis_pembayarans,id',
            'tgl_mulai_reservasi' => 'required|date|after_or_equal:today',
            'tgl_selesai_reservasi' => 'required|date|after:tgl_mulai_reservasi',
            'jumlah_peserta' => 'required|integer|min:1',
            'bukti_tf' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        
        // Ambil data paket wisata 
            $paket_wisata = Paket_Wisata::findOrFail($request->id_paket_wisata);
            
            // Hitung jumlah hari dari tanggal mulai dan selesai
            $tglMulai = new DateTime($request->tgl_mulai_reservasi);
            $tglSelesai = new DateTime($request->tgl_selesai_reservasi);
            $jumlahHari = $tglSelesai->diff($tglMulai)->days + 1; // +1 untuk inklusif
            
            // Validasi minimal 1 hari
            if ($jumlahHari < 1) {
                return back()->withErrors([
                    'tgl_selesai_reservasi' => 'Tanggal selesai harus setelah tanggal mulai'
                ])->withInput();
            }
        
            // Cek ketersediaan (query tetap sama)
            $totalPeserta = Reservasi::where('id_paket_wisata', $paket_wisata->id)
                ->where(function($query) use ($request) {
                    $query->whereBetween('tgl_mulai_reservasi', [$request->tgl_mulai_reservasi, $request->tgl_selesai_reservasi])
                          ->orWhereBetween('tgl_selesai_reservasi', [$request->tgl_mulai_reservasi, $request->tgl_selesai_reservasi])
                          ->orWhere(function($q) use ($request) {
                              $q->where('tgl_mulai_reservasi', '<=', $request->tgl_mulai_reservasi)
                                ->where('tgl_selesai_reservasi', '>=', $request->tgl_selesai_reservasi);
                          });
                })
                ->where('status_reservasi', '!=', 'Dibatalkan')
                ->sum('jumlah_peserta');
            
            $kapasitasTersedia = $paket_wisata->max_kapasitas - $totalPeserta;
            
            if ($kapasitasTersedia < $request->jumlah_peserta) {
                return back()->withErrors([
                    'jumlah_peserta' => 'Kapasitas tidak mencukupi. Hanya tersisa ' . $kapasitasTersedia . ' slot',
                    'tgl_mulai_reservasi' => 'Tanggal yang dipilih sudah penuh',
                    'tgl_selesai_reservasi' => 'Tanggal yang dipilih sudah penuh'
                ])->withInput();
            }
            
            // Hitung harga berdasarkan hari dan orang
            $hargaPerOrangPerHari = $paket_wisata->harga_per_pack;
            $subtotal = $hargaPerOrangPerHari * $request->jumlah_peserta * $jumlahHari;
            
            // Hitung diskon (tetap sama)
            $persentaseDiskon = 0;
            $nilaiDiskon = 0;
            
            if ($request->id_diskon) {
                $diskonData = Diskon::find($request->id_diskon);
                $persentaseDiskon = $diskonData->persentase_diskon;
                $nilaiDiskon = $subtotal * ($persentaseDiskon / 100);
            }
            
            $totalBayar = $subtotal - $nilaiDiskon;
            
            // Upload bukti transfer
            $buktiTfPath = $request->file('bukti_tf')->store('bukti_tf', 'public');
            
            // Buat reservasi (tanpa menyimpan jumlah_hari)
            $reservasi = Reservasi::create([
                'id_pelanggan' => $request->id_pelanggan,
                'id_user' => Auth::id(),
                'id_paket_wisata' => $paket_wisata->id,
                'id_diskon' => $request->id_diskon,
                'id_jenis_pembayaran' => $request->id_jenis_pembayaran,
                'nama_pelanggan' => $request->nama_pelanggan,
                'email' => $request->email,
                'tgl_mulai_reservasi' => $request->tgl_mulai_reservasi,
                'tgl_selesai_reservasi' => $request->tgl_selesai_reservasi,
                'harga' => $hargaPerOrangPerHari,
                'jumlah_peserta' => $request->jumlah_peserta,
                'persentase_diskon' => $persentaseDiskon,
                'nilai_diskon' => $nilaiDiskon,
                'subtotal' => $subtotal,
                'total_bayar' => $totalBayar,
                'bukti_tf' => $buktiTfPath,
                'status_reservasi' => 'Dipesan',
            ]);
            
            return redirect()->route('profile', $reservasi->id)
                ->with('success', 'Reservasi berhasil dibuat');

    }

    public function updateStatus()
    {
        // Update status reservasi yang sudah lewat tanggal selesai
        $updated = Reservasi::where('tgl_selesai_reservasi', '<', now())
            ->where('status_reservasi', 'Dipesan')
            ->update(['status_reservasi' => 'Selesai']);
            
        return response()->json(['message' => 'Status reservasi diperbarui', 'updated' => $updated]);
    }
    public function downloadNota($id)
    {
        // Ambil data reservasi dengan relasi
        $reservasi = Reservasi::with(['pelanggan', 'diskon', 'paketWisata', 'jenisPembayaran'])
                        ->where('id', $id)
                        ->firstOrFail();
        
        // Verifikasi bahwa reservasi milik pelanggan yang login
        if (auth()->user()->id != $reservasi->id_user) {
            abort(403, 'Unauthorized action.');
        }
    
        // Hitung jumlah hari
        $tglMulai = new DateTime($reservasi->tgl_mulai_reservasi);
        $tglSelesai = new DateTime($reservasi->tgl_selesai_reservasi);
        $jumlahHari = $tglSelesai->diff($tglMulai)->days + 1;
    
        // Format data untuk nota
        $data = [
            'no_nota' => 'NOTA-'.str_pad($reservasi->id, 6, '0', STR_PAD_LEFT),
            'nama_pelanggan' => $reservasi->pelanggan->nama_pelanggan,
            'tgl_reservasi' => $reservasi->created_at->format('d/m/Y'),
            'tgl_mulai' => $reservasi->tgl_mulai_reservasi->format('d/m/Y H:i'),
            'tgl_selesai' => $reservasi->tgl_selesai_reservasi->format('d/m/Y H:i'),
            'nama_paket' => $reservasi->paketWisata->nama_paket,
            'jumlah_peserta' => $reservasi->jumlah_peserta,
            'jumlah_hari' => $jumlahHari,
            'harga_per_hari' => number_format($reservasi->harga, 0, ',', '.'),
            'harga_total_per_hari' => number_format($reservasi->harga * $jumlahHari, 0, ',', '.'),
            'diskon' => $reservasi->diskon ? $reservasi->diskon->nama_diskon : '-',
            'nilai_diskon' => number_format($reservasi->nilai_diskon ?? 0, 0, ',', '.'),
            'subtotal' => number_format($reservasi->subtotal, 0, ',', '.'),
            'total_bayar' => number_format($reservasi->total_bayar, 0, ',', '.'),
            'jenis_pembayaran' => $reservasi->jenisPembayaran ? $reservasi->jenisPembayaran->jenis_pembayaran : '-',
            'status' => $reservasi->status_reservasi,
        ];
    
        $pdf = Pdf::loadView('fe.nota', $data);
        return $pdf->stream('nota-reservasi-'.$reservasi->id.'.pdf');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
