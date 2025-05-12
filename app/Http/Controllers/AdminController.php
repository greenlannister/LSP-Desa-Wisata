<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Kategori_Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Karyawan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Storage; 
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        

        return view('admin.index', [
            'title' => 'Admin',
        ]);
    }

    // Start Of User Management
    function con1(){
                // Ambil hanya karyawan yang memiliki user dengan level bukan pelanggan
            $karyawans = Karyawan::with('user')
            ->whereHas('user', function($query) {
                $query->where('level', '!=', 'pelanggan');
            })
            ->get();

        return view('admin.con1', compact('karyawans'), [
            'title' => 'Admin',
        ]);
    }
  
    public function store(Request $request)
    {
        \Log::info('Store Request Data:', $request->all());

        $validated = $request->validate([
            'nama_karyawan' => ['required', 'string', 'min:5'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:3'],
            'alamat' => ['required', 'string'],
            'no_hp' => ['required', 'string', 'max:15'],
            'level' => ['required', 'in:admin,pemilik,bendahara'],
            'status' => ['required', 'in:aktif,banned'],
            'foto_karyawan' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ],[
            'nama_karyawan.required' => 'Nama Karyawan wajib diisi',
            'email.required' => 'Email wajib diisi',
            'password.required' => 'Password wajib diisi',
            'alamat.required' => 'Alamat wajib diisi',
            'no_hp.required' => 'Nomor Handphone wajib diisi',
            'level.required' => 'Level wajib dipilih',
            'status.required' => 'Status wajib dipilih',
        ]);

        // Sinkronisasi
        $jabatan = $request->level; // Jabatan mengikuti level
        $aktif = $request->status === 'aktif' ? 1 : 0; // Aktif mengikuti status

        DB::beginTransaction();
        try {
            // Buat user baru
            $user = User::create([
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'level' => $validated['level'],
                'aktif' => $aktif,
                'email_verified_at' => now()
            ]);    

            // Handle upload foto
            $fotoPath = null;
            if ($request->hasFile('foto_karyawan')) {
                $fotoPath = $request->file('foto_karyawan')->store('karyawan', 'public');
            }

            // Buat data karyawan
            $karyawan = Karyawan::create([
                'nama_karyawan' => $validated['nama_karyawan'],
                'alamat' => $validated['alamat'],
                'no_hp' => $validated['no_hp'],
                'jabatan' => $jabatan,
                'status' => $validated['status'],
                'id_user' => $user->id,
                'foto_karyawan' => $fotoPath
            ]);

            DB::commit();
            return redirect()->route('admin.user.management')->with('swal', [
                'title' => 'Berhasil!',
                'text' => 'Karyawan berhasil ditambahkan!',
                'icon' => 'success',
                'draggable' => true
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('swal', [
                'title' => 'Gagal!',
                'text' => 'Terjadi kesalahan: ' . $e->getMessage(),
                'icon' => 'error'
            ])->withInput();
        }
    }


    public function update(Request $request, string $id)
    {
        \Log::info('Update Request Data:', $request->all());

        $validated = $request->validate([
            'nama_karyawan' => ['required', 'string', 'min:5'],
            'email' => ['required', 'email'],
            'alamat' => ['required', 'string'],
            'no_hp' => ['required', 'string', 'max:15'],
            'level' => ['required', 'in:admin,pemilik,bendahara'],
            'status' => ['required', 'in:aktif,banned'],
            'foto_karyawan' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        // Sinkronisasi
        $jabatan = $request->level; // Jabatan mengikuti level
        $aktif = $request->status === 'aktif' ? 1 : 0; // Aktif mengikuti status

        DB::beginTransaction();
        try {
            $karyawan = Karyawan::findOrFail($id);
            $user = User::findOrFail($karyawan->id_user);

            // Update user
            $user->update([
                'email' => $validated['email'],
                'level' => $validated['level'],
                'aktif' => $aktif
            ]);

            // Handle foto jika ada
            if ($request->hasFile('foto_karyawan')) {
                if ($karyawan->foto_karyawan) {
                    Storage::disk('public')->delete($karyawan->foto_karyawan);
                }
                $fotoPath = $request->file('foto_karyawan')->store('karyawan', 'public');
                $karyawan->foto_karyawan = $fotoPath;
            }

            // Update karyawan
            $karyawan->update([
                'nama_karyawan' => $validated['nama_karyawan'],
                'alamat' => $validated['alamat'],
                'no_hp' => $validated['no_hp'],
                'jabatan' => $jabatan,
                'status' => $validated['status'],
            ]);

            DB::commit();

            return redirect()->route('admin.user.management')->with('swal', [
                'title' => 'Berhasil!',
                'text' => 'Data karyawan berhasil diperbarui!',
                'icon' => 'success'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('swal', [
                'title' => 'Gagal!',
                'text' => 'Terjadi kesalahan: ' . $e->getMessage(),
                'icon' => 'error'
            ])->withInput();
        }
    }


    public function ban($id)
{
    $karyawan = Karyawan::with('user')->find($id);
    
    if(!$karyawan) {
        return response()->json(['error' => 'Karyawan tidak ditemukan'], 404);
    }

    DB::beginTransaction();
    try {
        // Update keduanya untuk konsistensi
        $karyawan->update(['status' => 'banned']);
        $karyawan->user->update(['aktif' => 0]);
        
        DB::commit();
        
        return redirect()->route('admin.user.management')->with('swal', [
            'title' => 'Berhasil!',
            'text' => 'Akun telah dibanned!',
            'icon' => 'success'
        ]);

    } catch (\Exception $e) {
        DB::rollBack();
        return back()->with('swal', [
            'title' => 'Gagal!',
            'text' => 'Gagal membanned akun: ' . $e->getMessage(),
            'icon' => 'error'
        ]);
    }
}


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

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    // End Of User Management

    // Start Of News Management

    function con2(){
        $kategoriBeritas = Kategori_Berita::all();
        return view('admin.con2', [
        'title' => 'Admin',
        'kategoriBeritas' => $kategoriBeritas
    ]);
    }

    function kategoriBerita(Request $request) {
        $incomingFields = $request->validate([
            'kategori_berita' => ['required', 'string', 'min:5']
        ]);

        $incomingFields['kategori_berita'] = strip_tags($incomingFields['kategori_berita']);

        try {
            Kategori_Berita::create($incomingFields);
            return redirect()->route('news.management')->with('swal', [
                'title' => 'Berhasil!',
                'text' => 'Kategori Berita berhasil dibuat!',
                'icon' => 'success',
                'draggable' => true
            ]);
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal menyimpan kategori']);
        }
    }

    public function updateKategori(Request $request, $id) {
            $request->validate([
                'kategori_berita' => ['required', 'string', 'min:5']
            ]);
        
            $kategori = Kategori_Berita::find($id);
            if (!$kategori) {
                return back()->with('error', 'Kategori tidak ditemukan.');
            }
        
            try {
                $kategori->kategori_berita = strip_tags($request->kategori_berita);
                $kategori->save(); // <-- INI WAJIB supaya perubahan tersimpan ke database
        
                return redirect()->route('news.management')->with('swal', [
                    'title' => 'Berhasil!',
                    'text' => 'Kategori Berita berhasil diubah!',
                    'icon' => 'success',
                    'draggable' => true
                ]);
            } catch (\Exception $e) {
                return back()->withErrors(['error' => 'Gagal menyimpan kategori']);
            }
    
        
    }

    public function destroyKategori($id) {
        $kategori = Kategori_Berita::find($id);
    
        if (!$kategori) {
            return back()->with('error', 'Kategori tidak ditemukan.');
        }
    
        $kategori->delete();
        return redirect()->route('news.management')->with('swal', [
            'title' => 'Berhasil!',
            'text' => 'Kategori Berita telah dihapus!',
            'icon' => 'success'
        ]);
    }

    function con3(){
        $beritas = Berita::with('kategori')->get();
        $kategori_beritas = Kategori_Berita::all();
        
        return view('admin.con3', [
        'beritas' => $beritas,
        'kategori_beritas' => $kategori_beritas,
        'title' => 'Admin',
        ]);
        
    }
    

    function Berita (Request $request){
        $validasi = $request->validate([
            'judul' => ['required', 'string', 'min:5'],
            'berita' => ['required', 'string'],
            'tanggal_post' => ['required', 'date'],
            'foto1' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'foto2' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'foto3' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'id_kategori_berita' => ['required', 'exists:kategori_beritas,id']
        ]);
    
        DB::beginTransaction();
        try {
            $foto1 = $request->file('foto1')->store('berita', 'public');
            $foto2 = $request->file('foto2') ? $request->file('foto2')->store('berita', 'public') : null;
            $foto3 = $request->file('foto3') ? $request->file('foto3')->store('berita', 'public') : null;
    
            Berita::create([
                'judul' => $validasi['judul'],
                'berita' => $validasi['berita'],
                'tanggal_post' => $validasi['tanggal_post'],
                'foto1' => $foto1,
                'foto2' => $foto2,
                'foto3' => $foto3,
                'id_kategori_berita' => $validasi['id_kategori_berita'],
            ]);
    
            DB::commit();
            return redirect()->route('manage.news')->with('swal', [
                'title' => 'Berhasil!',
                'text' => 'Berita berhasil ditambahkan!',
                'icon' => 'success'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('swal', [
                'title' => 'Gagal!',
                'text' => 'Terjadi kesalahan: ' . $e->getMessage(),
                'icon' => 'error'
            ])->withInput();
        }
    }

    public function BerUpdate(Request $request, string $id)
    {
        $validasi = $request->validate([
            'judul' => ['required', 'string', 'min:5'],
            'berita' => ['required', 'string'],
            'tanggal_post' => ['required', 'date'],
            'foto1' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'foto2' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'foto3' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'id_kategori_berita' => ['required', 'exists:kategori_beritas,id']
        ]);

        DB::beginTransaction();
        try {
            $berita = Berita::findOrFail($id);

            // Handle foto1
            if ($request->hasFile('foto1')) {
                // Hapus foto lama jika ada
                if ($berita->foto1) {
                    Storage::disk('public')->delete($berita->foto1);
                }
                $foto1 = $request->file('foto1')->store('berita', 'public');
                $berita->foto1 = $foto1;
            }

            // Handle foto2
            if ($request->hasFile('foto2')) {
                if ($berita->foto2) {
                    Storage::disk('public')->delete($berita->foto2);
                }
                $foto2 = $request->file('foto2')->store('berita', 'public');
                $berita->foto2 = $foto2;
            }

            // Handle foto3
            if ($request->hasFile('foto3')) {
                if ($berita->foto3) {
                    Storage::disk('public')->delete($berita->foto3);
                }
                $foto3 = $request->file('foto3')->store('berita', 'public');
                $berita->foto3 = $foto3;
            }

            // Update data berita
            $berita->update([
                'judul' => $validasi['judul'],
                'berita' => $validasi['berita'],
                'tanggal_post' => $validasi['tanggal_post'],
                'id_kategori_berita' => $validasi['id_kategori_berita'],
            ]);

            DB::commit();

            return redirect()->route('manage.news')->with('swal', [
                'title' => 'Berhasil!',
                'text' => 'Berita berhasil diperbarui!',
                'icon' => 'success'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('swal', [
                'title' => 'Gagal!',
                'text' => 'Terjadi kesalahan: ' . $e->getMessage(),
                'icon' => 'error'
            ])->withInput();
        }
    }

    public function destroyBerita($id)
    {
        DB::beginTransaction();
        try {
            $berita = Berita::findOrFail($id);

            // Hapus file foto dari storage
            if ($berita->foto1) {
                Storage::disk('public')->delete($berita->foto1);
            }
            if ($berita->foto2) {
                Storage::disk('public')->delete($berita->foto2);
            }
            if ($berita->foto3) {
                Storage::disk('public')->delete($berita->foto3);
            }

            $berita->delete();

            DB::commit();

            return redirect()->route('manage.news')->with('swal', [
                'title' => 'Berhasil!',
                'text' => 'Berita berhasil dihapus!',
                'icon' => 'success'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('swal', [
                'title' => 'Gagal!',
                'text' => 'Terjadi kesalahan: ' . $e->getMessage(),
                'icon' => 'error'
            ]);
        }
    }
    
}
