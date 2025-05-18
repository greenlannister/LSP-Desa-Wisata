<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;
use App\Models\Reservasi;
use App\Models\Pelanggan;
use App\Models\Paket_Wisata;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class OwnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tahun = $request->tahun ?? date('Y');
        
        // Data statistik umum
        $data = [
            'jmlReservasi' => Reservasi::count(),
            'jmlPelanggan' => Pelanggan::count(),
            'jmlPaketWisata' => Paket_Wisata::count(),
            'jmlReservasiAktif' => Reservasi::where('status_reservasi', 'Dipesan')->count(),
            'tahun' => $tahun
        ];
    
        // Data untuk chart bulanan
        $reservasiBulanan = Reservasi::selectRaw('
                MONTH(created_at) as bulan, 
                COUNT(*) as jumlah_reservasi
            ')
            ->whereYear('created_at', $tahun)
            ->groupBy('bulan')
            ->orderBy('bulan', 'asc')
            ->get();
    
        // Inisialisasi semua bulan
        $monthlyData = array_fill(1, 12, 0); // [1=>0, 2=>0, ..., 12=>0]
    
        // Isi data yang ada
        foreach ($reservasiBulanan as $item) {
            $monthlyData[$item->bulan] = $item->jumlah_reservasi;
        }
    
        $jumlahReservasi = array_values($monthlyData); // [0, 3, 5, ...]
        $labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    
        return view('owner.index', compact('data', 'labels', 'jumlahReservasi'))
            ->with('data', $data)
            ->with('title', 'Owner');
    }

    public function laporanBulanan(Request $request)
    {
        $request->validate([
            'bulan' => 'required|integer|min:1|max:12',
            'tahun' => 'required|integer|min:2020|max:' . now()->year,
        ]);
    
        $bulan = $request->bulan;
        $tahun = $request->tahun;
    
        $reservasis = Reservasi::with(['pelanggan', 'paketWisata'])
            ->whereMonth('created_at', $bulan)
            ->whereYear('created_at', $tahun)
            ->get();
    
        $data = [
            'reservasis' => $reservasis->map(function ($r) {
                return [
                    'nama_pelanggan' => $r->pelanggan->nama_pelanggan ?? $r->nama_pelanggan,
                    'nama_paket' => $r->paketWisata->nama_paket ?? '-',
                    'jumlah_peserta' => $r->jumlah_peserta,
                    'total_bayar' => number_format($r->total_bayar, 0, ',', '.'),
                    'tgl_reservasi' => $r->created_at->format('d/m/Y'),
                    'status' => $r->status_reservasi,
                ];
            }),
            'total_reservasi' => $reservasis->count(),
            'total_pendapatan' => number_format($reservasis->sum('total_bayar'), 0, ',', '.'),
            'bulan' => \Carbon\Carbon::create()->month((int) $bulan)->locale('id')->translatedFormat('F'),
            'tahun' => $tahun
        ];
    
        $pdf = Pdf::loadView('owner.template', $data);
        return $pdf->download('laporan-reservasi-' . $bulan . '-' . $tahun . '.pdf');
    }
    


    // public function Laporan()
    // {
    //     // Ambil tahun-tahun unik dari data reservasi
    //     $years = Reservasi::selectRaw('YEAR(created_at) as year')
    //     ->groupBy('year')
    //     ->orderBy('year', 'desc')
    //     ->pluck('year');
        
    //     $recentReports = $this->getRecentReports();
        
    //     return view('owner.laporan', compact('years', 'recentReports'));
    // }

    // public function downloadLaporan(Request $request)
    // {
    //     $request->validate([
    //         'bulan' => 'required|numeric|between:1,12',
    //         'tahun' => 'required|numeric'
    //     ]);

    //     $bulan = $request->bulan;
    //     $tahun = $request->tahun;

    //     // Ambil data reservasi bulan dan tahun yang dipilih
    //     $reservasis = Reservasi::with(['pelanggan', 'paketWisata'])
    //         ->whereMonth('created_at', $bulan)
    //         ->whereYear('created_at', $tahun)
    //         ->orderBy('created_at', 'desc')
    //         ->get();

    //     // Format data untuk laporan
    //     $data = [
    //         'bulan' => Carbon::create()->month($bulan)->monthName,
    //         'tahun' => $tahun,
    //         'reservasis' => $reservasis->map(function ($reservasi) {
    //             return [
    //                 'nama_pelanggan' => $reservasi->pelanggan->nama_pelanggan,
    //                 'nama_paket' => $reservasi->paketWisata->nama_paket,
    //                 'jumlah_peserta' => $reservasi->jumlah_peserta,
    //                 'total_bayar' => number_format($reservasi->total_bayar, 0, ',', '.'),
    //                 'tgl_reservasi' => $reservasi->created_at->format('d/m/Y H:i'),
    //                 'status' => $reservasi->status_reservasi
    //             ];
    //         }),
    //         'total_pendapatan' => number_format($reservasis->sum('total_bayar'), 0, ',', '.'),
    //         'total_reservasi' => $reservasis->count()
    //     ];

    //     $pdf = Pdf::loadView('owner.template', $data);
    //     return $pdf->download("laporan-reservasi-{$data['bulan']}-{$tahun}.pdf");
    // }

    // private function getRecentReports()
    // {
    //     $recentMonths = Reservasi::selectRaw('YEAR(created_at) as tahun, MONTH(created_at) as bulan')
    //         ->groupBy('tahun', 'bulan')
    //         ->orderBy('tahun', 'desc')
    //         ->orderBy('bulan', 'desc')
    //         ->take(5)
    //         ->get();

    //     return $recentMonths->map(function ($item) {
    //         return [
    //             'bulan' => DateTime::createFromFormat('!m', $item->bulan)->format('F'),
    //             'bulan_num' => $item->bulan,
    //             'tahun' => $item->tahun
    //         ];
    //     });
    // }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
