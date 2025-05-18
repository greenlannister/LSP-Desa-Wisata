<?php

namespace App\Http\Controllers;

use App\Models\Kategori_Wisata;
use App\Models\Objek_Wisata;
use App\Models\Paket_Wisata;
use App\Models\Jenis_Pembayaran;
use App\Models\Diskon;
use App\Models\Pelanggan;
use App\Models\Reservasi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use App\Models\Penginapan;
use Illuminate\Support\Facades\Storage; 

class BendaharaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view ('bendahara.index', [
            'title' => 'Bendahara',
        ]);
    }


    // Homestay
    function cont1(){
        $penginapan = Penginapan::all();

        return view('bendahara.cont1', [
        'penginapans' => $penginapan,
        'title' => 'Bendahara',
        ]);
        
    }

    function Homestay(Request $request){
        $addhome = $request->validate([
            'nama_penginapan' => ['required', 'string', 'min:5'],
            'deskripsi' => ['required', 'string'],
            'fasilitas' => ['required', 'string', 'min:5'],
            'foto1' => ['required', 'image', 'mimes:jpeg,png,jpg,gif'],
            'foto2' => ['required', 'image', 'mimes:jpeg,png,jpg,gif'],
            'foto3' => ['required', 'image', 'mimes:jpeg,png,jpg,gif'],
            'foto4' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif'],
            'foto5' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif']
        ]);

        DB::beginTransaction();
        try {
            $foto1 = $request->file('foto1')->store('berita', 'public');
            $foto2 = $request->file('foto2')->store('berita', 'public');
            $foto3 = $request->file('foto3')->store('berita', 'public');
            $foto4 = $request->file('foto4') ? $request->file('foto4')->store('berita', 'public') : null;
            $foto5 = $request->file('foto5') ? $request->file('foto5')->store('berita', 'public') : null;
    
            $penginapan = Penginapan::create([
                'nama_penginapan' => $addhome['nama_penginapan'],
                'deskripsi' => $addhome['deskripsi'],
                'fasilitas' => $addhome['fasilitas'],
                'foto1' => $foto1,
                'foto2' => $foto2,
                'foto3' => $foto3,
                'foto4' => $foto4,
                'foto5' => $foto5,
            ]);
    
            DB::commit();
            return redirect()->route('homestay')->with('swal', [
                'title' => 'Berhasil!',
                'text' => 'Penginapan berhasil ditambahkan!',
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

    public function HomestayUpdate(Request $request, $id)
    {
        $validasi = $request->validate([
            'nama_penginapan' => ['required', 'string', 'min:5'],
            'deskripsi' => ['required', 'string'],
            'fasilitas' => ['required', 'string', 'min:5'],
            'foto1' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif'],
            'foto2' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif'],
            'foto3' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif'],
            'foto4' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif'],
            'foto5' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif']
        ]);

        DB::beginTransaction();
        try {
            $penginapan = Penginapan::findOrFail($id);

            foreach (['foto1', 'foto2', 'foto3', 'foto4', 'foto5'] as $foto) {
                if ($request->hasFile($foto)) {
                    if ($penginapan->$foto) {
                        Storage::disk('public')->delete($penginapan->$foto);
                    }
                    $penginapan->$foto = $request->file($foto)->store('berita', 'public');
                }
            }

            $penginapan->update([
                'nama_penginapan' => $validasi['nama_penginapan'],
                'deskripsi' => $validasi['deskripsi'],
                'fasilitas' => $validasi['fasilitas'],
                'foto1' => $penginapan->foto1,
                'foto2' => $penginapan->foto2,
                'foto3' => $penginapan->foto3,
                'foto4' => $penginapan->foto4,
                'foto5' => $penginapan->foto5,
            ]);

            DB::commit();
            return redirect()->route('homestay')->with('swal', [
                'title' => 'Berhasil!',
                'text' => 'Penginapan berhasil diperbarui!',
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

    public function destroyHomestay($id)
    {
        DB::beginTransaction();
        try {
            $penginapan = Penginapan::findOrFail($id);

            foreach (['foto1', 'foto2', 'foto3', 'foto4', 'foto5'] as $foto) {
                if ($penginapan->$foto) {
                    Storage::disk('public')->delete($penginapan->$foto);
                }
            }

            $penginapan->delete();

            DB::commit();
            return redirect()->route('homestay')->with('swal', [
                'title' => 'Berhasil!',
                'text' => 'Penginapan berhasil dihapus!',
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


    // Package Wisata
    function cont2(){
        $packageWisatas = Paket_Wisata::all();
        return view('bendahara.cont2', [
        'title' => 'Bendahara',
        'packageWisatas' => $packageWisatas
        ]);
    }

    function PaketWisata(Request $request){
        $validated = $request->validate([
            'nama_paket' => ['required', 'string', 'min:5'],
            'deskripsi' => ['required', 'string'],
            'fasilitas' => ['required', 'string'],
            'harga_per_pack' => ['required', 'integer', 'min:3'],
            'max_kapasitas' => ['required', 'integer'], // Pastikan 2 'p'
            'foto1' => ['required', 'image', 'mimes:jpeg,png,jpg,gif'],
            'foto2' => ['required', 'image', 'mimes:jpeg,png,jpg,gif'],
            'foto3' => ['required', 'image', 'mimes:jpeg,png,jpg,gif'],
            'foto4' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif'],
            'foto5' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif'],
            'foto6' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif'],
            'foto7' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif'],
        ]);
    
        DB::beginTransaction();
        try {
            $foto1 = $request->file('foto1')->store('paket_wisata', 'public');
            $foto2 = $request->file('foto2')->store('paket_wisata', 'public');
            $foto3 = $request->file('foto3')->store('paket_wisata', 'public');
            $foto4 = $request->file('foto4') ? $request->file('foto4')->store('paket_wisata', 'public') : null;
            $foto5 = $request->file('foto5') ? $request->file('foto5')->store('paket_wisata', 'public') : null;
            $foto6 = $request->file('foto6') ? $request->file('foto6')->store('paket_wisata', 'public') : null;
            $foto7 = $request->file('foto7') ? $request->file('foto7')->store('paket_wisata', 'public') : null;
    
            Paket_Wisata::create([
                'nama_paket' => $validated['nama_paket'],
                'deskripsi' => $validated['deskripsi'],
                'fasilitas' => $validated['fasilitas'],
                'harga_per_pack' => $validated['harga_per_pack'],
                'max_kapasitas' => $validated['max_kapasitas'], // Pastikan 2 'p'
                'foto1' => $foto1,
                'foto2' => $foto2,
                'foto3' => $foto3,
                'foto4' => $foto4,
                'foto5' => $foto5,
                'foto6' => $foto6,
                'foto7' => $foto7,
            ]);
    
            DB::commit();
            return redirect()->route('paket')->with('swal', [
                'title' => 'Berhasil!',
                'text' => 'Paket Wisata berhasil ditambahkan!',
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

    public function PaketUpdate(Request $request, string $id)
    {
        $editpaket = $request->validate([
            'nama_paket' => ['required', 'string', 'min:5'],
            'deskripsi' => ['required', 'string'],
            'fasilitas' => ['required', 'string'],
            'harga_per_pack' => ['required', 'integer', 'min:3'],
            'max_kapasitas' => ['required', 'integer'],
            'foto1' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif'],
            'foto2' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif'],
            'foto3' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif'],
            'foto4' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif'],
            'foto5' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif'],
            'foto6' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif'],
            'foto7' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif'],
        ]);

        DB::beginTransaction();
        try {
            $paket = Paket_Wisata::findOrFail($id);

            // Handle foto1
            if ($request->hasFile('foto1')) {
                // Hapus foto lama jika ada
                if ($paket->foto1) {
                    Storage::disk('public')->delete($paket->foto1);
                }
                $foto1 = $request->file('foto1')->store('paket_wisata', 'public');
                $paket->foto1 = $foto1;
            }

            // Handle foto2
            if ($request->hasFile('foto2')) {
                // Hapus foto lama jika ada
                if ($paket->foto2) {
                    Storage::disk('public')->delete($paket->foto2);
                }
                $foto2 = $request->file('foto2')->store('paket_wisata', 'public');
                $paket->foto2 = $foto2;
            }


            // Handle foto3
            if ($request->hasFile('foto3')) {
                // Hapus foto lama jika ada
                if ($paket->foto3) {
                    Storage::disk('public')->delete($paket->foto3);
                }
                $foto3 = $request->file('foto3')->store('paket_wisata', 'public');
                $paket->foto3 = $foto3;
            }


            // Handle foto4
            if ($request->hasFile('foto4')) {
                // Hapus foto lama jika ada
                if ($paket->foto4) {
                    Storage::disk('public')->delete($paket->foto4);
                }
                $foto4 = $request->file('foto4')->store('paket_wisata', 'public');
                $paket->foto4 = $foto4;
            }


            // Handle foto5
            if ($request->hasFile('foto5')) {
                // Hapus foto lama jika ada
                if ($paket->foto5) {
                    Storage::disk('public')->delete($paket->foto5);
                }
                $foto5 = $request->file('foto5')->store('paket_wisata', 'public');
                $paket->foto5 = $foto5;
            }


            // Handle foto6
            if ($request->hasFile('foto6')) {
                // Hapus foto lama jika ada
                if ($paket->foto6) {
                    Storage::disk('public')->delete($paket->foto6);
                }
                $foto6 = $request->file('foto6')->store('paket_wisata', 'public');
                $paket->foto6 = $foto6;
            }


            // Handle foto7
            if ($request->hasFile('foto7')) {
                // Hapus foto lama jika ada
                if ($paket->foto7) {
                    Storage::disk('public')->delete($paket->foto7);
                }
                $foto7 = $request->file('foto7')->store('paket_wisata', 'public');
                $paket->foto7 = $foto7;
            }


            // Update data berita
            $paket->update([
                    'nama_paket' => $request->nama_paket,
                    'deskripsi' => $request->deskripsi,
                    'fasilitas' => $request->fasilitas,
                    'harga_per_pack' => $request->harga_per_pack,
                    'max_kapasitas' => $request->max_kapasitas,
                    'foto1' => $paket->foto1,
                    'foto2' => $paket->foto2,
                    'foto3' => $paket->foto3,
                    'foto4' => $paket->foto4,
                    'foto5' => $paket->foto5,
                    'foto6' => $paket->foto6,
                    'foto7' => $paket->foto7,
                    'id_kategori_wisata' => $request->id_kategori_wisata,
            ]);

            DB::commit();

            return redirect()->route('paket')->with('swal', [
                'title' => 'Berhasil!',
                'text' => 'Paket wisata berhasil diperbarui!',
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

    public function PaketDestroy($id)
    {
        DB::beginTransaction();
        try {
            $paket = Paket_Wisata::findOrFail($id);

            // Hapus file foto dari storage
            if ($paket->foto1) {
                Storage::disk('public')->delete($paket->foto1);
            }
            if ($paket->foto2) {
                Storage::disk('public')->delete($paket->foto2);
            }
            if ($paket->foto3) {
                Storage::disk('public')->delete($paket->foto3);
            }
            if ($paket->foto4) {
                Storage::disk('public')->delete($paket->foto4);
            }
            if ($paket->foto5) {
                Storage::disk('public')->delete($paket->foto5);
            }
            if ($paket->foto6) {
                Storage::disk('public')->delete($paket->foto6);
            }
            if ($paket->foto7) {
                Storage::disk('public')->delete($paket->foto7);
            }

            $paket->delete();

            DB::commit();

            return redirect()->route('paket')->with('swal', [
                'title' => 'Berhasil!',
                'text' => 'Paket berhasil dihapus!',
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
    




    // Objek Wisata
    function cont3(){
        $obtas= Objek_Wisata::with('kategori_wisata')->get();
        $kategori_wisatas = Kategori_Wisata::all();
        
        return view('bendahara.cont3', [
        'obtas' => $obtas,
        'kategori_wisatas' => $kategori_wisatas,
        'title' => 'Bendahara',
        ]);
    }

    function objekWisata(Request $request){
        $addobta = $request->validate([
            'nama_wisata' => ['required', 'string', 'min:5'],
            'deskripsi' => ['required', 'string'],
            'fasilitas' => ['required', 'string'],
            'foto1' => ['required', 'image', 'mimes:jpeg,png,jpg,gif'],
            'foto2' => ['required', 'image', 'mimes:jpeg,png,jpg,gif'],
            'foto3' => ['required', 'image', 'mimes:jpeg,png,jpg,gif'],
            'foto4' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif'],
            'foto5' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif'],
            'foto6' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif'],
            'foto7' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif'],
            'id_kategori_wisata' => ['required', 'exists:kategori_wisatas,id']
        ]);
    
        DB::beginTransaction();
        try {
            $foto1 = $request->file('foto1')->store('objek_wisata', 'public');
            $foto2 = $request->file('foto2')->store('objek_wisata', 'public');
            $foto3 = $request->file('foto3')->store('objek_wisata', 'public');
            $foto4 = $request->file('foto4') ? $request->file('foto4')->store('objek_wisata', 'public') : null;
            $foto5 = $request->file('foto5') ? $request->file('foto5')->store('objek_wisata', 'public') : null;
            $foto6 = $request->file('foto6') ? $request->file('foto6')->store('objek_wisata', 'public') : null;
            $foto7 = $request->file('foto7') ? $request->file('foto7')->store('objek_wisata', 'public') : null;
    
            Objek_Wisata::create([
                'nama_wisata' => $addobta['nama_wisata'],
                'deskripsi' => $addobta['deskripsi'],
                'fasilitas' => $addobta['fasilitas'],
                'foto1' => $foto1,
                'foto2' => $foto2,
                'foto3' => $foto3,
                'foto4' => $foto4,
                'foto5' => $foto5,
                'foto6' => $foto6,
                'foto7' => $foto7,
                'id_kategori_wisata' => $addobta['id_kategori_wisata'],
            ]);
    
            DB::commit();
            return redirect()->route('obta')->with('swal', [
                'title' => 'Berhasil!',
                'text' => 'Objek Wisata berhasil ditambahkan!',
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

    public function ObtaUpdate(Request $request, string $id)
    {
        $validasi = $request->validate([
            'nama_wisata' => ['required', 'string', 'min:5'],
            'deskripsi' => ['required', 'string'],
            'fasilitas' => ['required', 'string'],
            'foto1' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif'],
            'foto2' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif'],
            'foto3' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif'],
            'foto4' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif'],
            'foto5' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif'],
            'foto6' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif'],
            'foto7' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif'],
            'id_kategori_wisata' => ['required', 'exists:kategori_wisatas,id']
        ]);

        DB::beginTransaction();
        try {
            $obta = Objek_Wisata::findOrFail($id);

            // Handle foto1
            if ($request->hasFile('foto1')) {
                // Hapus foto lama jika ada
                if ($obta->foto1) {
                    Storage::disk('public')->delete($obta->foto1);
                }
                $foto1 = $request->file('foto1')->store('objek_wisata', 'public');
                $obta->foto1 = $foto1;
            }

            // Handle foto2
            if ($request->hasFile('foto2')) {
                // Hapus foto lama jika ada
                if ($obta->foto2) {
                    Storage::disk('public')->delete($obta->foto2);
                }
                $foto2 = $request->file('foto2')->store('objek_wisata', 'public');
                $obta->foto2 = $foto2;
            }


            // Handle foto3
            if ($request->hasFile('foto3')) {
                // Hapus foto lama jika ada
                if ($obta->foto3) {
                    Storage::disk('public')->delete($obta->foto3);
                }
                $foto3 = $request->file('foto3')->store('objek_wisata', 'public');
                $obta->foto3 = $foto3;
            }


            // Handle foto4
            if ($request->hasFile('foto4')) {
                // Hapus foto lama jika ada
                if ($obta->foto4) {
                    Storage::disk('public')->delete($obta->foto4);
                }
                $foto4 = $request->file('foto4')->store('objek_wisata', 'public');
                $obta->foto4 = $foto4;
            }


            // Handle foto5
            if ($request->hasFile('foto5')) {
                // Hapus foto lama jika ada
                if ($obta->foto5) {
                    Storage::disk('public')->delete($obta->foto5);
                }
                $foto5 = $request->file('foto5')->store('objek_wisata', 'public');
                $obta->foto5 = $foto5;
            }


            // Handle foto6
            if ($request->hasFile('foto6')) {
                // Hapus foto lama jika ada
                if ($obta->foto6) {
                    Storage::disk('public')->delete($obta->foto6);
                }
                $foto6 = $request->file('foto6')->store('objek_wisata', 'public');
                $obta->foto6 = $foto6;
            }


            // Handle foto7
            if ($request->hasFile('foto7')) {
                // Hapus foto lama jika ada
                if ($obta->foto7) {
                    Storage::disk('public')->delete($obta->foto7);
                }
                $foto7 = $request->file('foto7')->store('objek_wisata', 'public');
                $obta->foto7 = $foto7;
            }


            // Update data berita
            $obta->update([
                'nama_wisata' => $request->nama_wisata,
                    'deskripsi' => $request->deskripsi,
                    'fasilitas' => $request->fasilitas,
                    'foto1' => $obta->foto1,
                    'foto2' => $obta->foto2,
                    'foto3' => $obta->foto3,
                    'foto4' => $obta->foto4,
                    'foto5' => $obta->foto5,
                    'foto6' => $obta->foto6,
                    'foto7' => $obta->foto7,
                    'id_kategori_wisata' => $request->id_kategori_wisata,
            ]);

            DB::commit();

            return redirect()->route('obta')->with('swal', [
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

    public function ObtaDestroy($id)
    {
        DB::beginTransaction();
        try {
            $obta = Objek_Wisata::findOrFail($id);

            // Hapus file foto dari storage
            if ($obta->foto1) {
                Storage::disk('public')->delete($obta->foto1);
            }
            if ($obta->foto2) {
                Storage::disk('public')->delete($obta->foto2);
            }
            if ($obta->foto3) {
                Storage::disk('public')->delete($obta->foto3);
            }
            if ($obta->foto4) {
                Storage::disk('public')->delete($obta->foto4);
            }
            if ($obta->foto5) {
                Storage::disk('public')->delete($obta->foto5);
            }
            if ($obta->foto6) {
                Storage::disk('public')->delete($obta->foto6);
            }
            if ($obta->foto7) {
                Storage::disk('public')->delete($obta->foto7);
            }

            $obta->delete();

            DB::commit();

            return redirect()->route('obta')->with('swal', [
                'title' => 'Berhasil!',
                'text' => 'Objek berhasil dihapus!',
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


    // Konfirmasi
    function cont4(){
        $reservasis = Reservasi::with(['pelanggan.user', 'paketWisata'])->get();

        return view('bendahara.cont4', [
            'reservasis' => $reservasis,
            'title' => 'Bendahara'
        ]);
    }


    // Kategori Wisata
    function cont5(){
        $kategoriWisatas = Kategori_Wisata::all();
        return view('bendahara.cont5', [
        'title' => 'Bendahara',
        'kategoriWisatas' => $kategoriWisatas
        ]);
    }

    function kategoriWisata(Request $request) {
        $addwis = $request->validate([
            'kategori_wisata' => ['required', 'string', 'min:5']
        ]);

        $addwis['kategori_wisata'] = strip_tags($addwis['kategori_wisata']);

        try {
            Kategori_Wisata::create($addwis);
            return redirect()->route('katwis')->with('swal', [
                'title' => 'Berhasil!',
                'text' => 'Kategori Wisata berhasil dibuat!',
                'icon' => 'success',
                'draggable' => true
            ]);
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal menyimpan kategori']);
        }
    }

    public function updateKatwis(Request $request, $id) {
        $request->validate([
            'kategori_wisata' => ['required', 'string', 'min:5']
        ]);
    
        $katwis = Kategori_Wisata::find($id);
        if (!$katwis) {
            return back()->with('error', 'Kategori tidak ditemukan.');
        }
    
        try {
            $katwis->kategori_wisata = strip_tags($request->kategori_wisata);
            $katwis->save(); // <-- INI WAJIB supaya perubahan tersimpan ke database
    
            return redirect()->route('katwis')->with('swal', [
                'title' => 'Berhasil!',
                'text' => 'Kategori Wisata berhasil diubah!',
                'icon' => 'success',
                'draggable' => true
            ]);
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal menyimpan kategori']);
        }
    
    }


    public function destroyKatwis($id) {
        $katwis = Kategori_Wisata::find($id);

        if (!$katwis) {
            return back()->with('error', 'Kategori tidak ditemukan.');
        }

        $katwis->delete();
        return redirect()->route('katwis')->with('swal', [
            'title' => 'Berhasil!',
            'text' => 'Kategori Berita telah dihapus!',
            'icon' => 'success'
        ]);
    }


    // Jenis Pembayaran
    function cont6(){
        $jenisPembayarans = Jenis_Pembayaran::all();
        return view('bendahara.cont6', [
        'title' => 'Bendahara',
        'jenisPembayarans' => $jenisPembayarans
        ]);
    }

    function JenisPembayaran(Request $request){
        $addjen = $request->validate([
            'jenis_pembayaran' => ['required', 'string'],
            'nomor_tf' => ['required', 'string', 'min:0', 'max:30'],
            'foto' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif'],
        ]);

        $addjen['jenis_pembayaran'] = strip_tags($addjen['jenis_pembayaran']);
        $addjen['nomor_tf'] = strip_tags($addjen['nomor_tf']);
        if ($request->hasFile('foto')) {
            $addjen['foto'] = $request->file('foto')->store('jenis_pembayaran', 'public');
        }
        

        try {
            Jenis_Pembayaran::create($addjen);
            return redirect()->route('jenpe')->with('swal', [
                'title' => 'Berhasil!',
                'text' => 'Jenis Pembayaran berhasil dibuat!',
                'icon' => 'success',
                'draggable' => true
            ]);
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal menyimpan kategori']);
        }
    }

    public function updateJenpe(Request $request, $id) {
        $request->validate([
            'jenis_pembayaran' => ['required', 'string'],
            'nomor_tf' => ['required', 'string', 'min:0', 'max:30'],
            'foto' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif'],
        ]);
    
        $jenpe = Jenis_Pembayaran::find($id);
        if (!$jenpe) {
            return back()->with('error', 'Jenis Pembayaran tidak ditemukan.');
        }
    
        try {
            // Update data utama
            $jenpe->jenis_pembayaran = strip_tags($request->jenis_pembayaran);
            $jenpe->nomor_tf = strip_tags($request->nomor_tf);
    
            // Handle file upload
            if ($request->hasFile('foto')) {
                // Hapus foto lama jika ada
                if ($jenpe->foto && Storage::exists($jenpe->foto)) {
                    Storage::delete($jenpe->foto);
                }
                
                // Simpan foto baru
                $path = $request->file('foto')->store('public/jenis_pembayaran');
                $jenpe->foto = str_replace('public/', '', $path);
            }
    
            $jenpe->save();
    
            return redirect()->route('jenpe')->with('swal', [
                'title' => 'Berhasil!',
                'text' => 'Jenis Pembayaran berhasil diubah!',
                'icon' => 'success',
                'draggable' => true
            ]);
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal menyimpan perubahan: ' . $e->getMessage()]);
        }
    
    }

    public function destroyJenpe($id) {
        $jenpe = Jenis_Pembayaran::find($id);

        if (!$jenpe) {
            return back()->with('error', 'Jenis Pembayaran tidak ditemukan.');
        }

        $jenpe->delete();
        return redirect()->route('jenpe')->with('swal', [
            'title' => 'Berhasil!',
            'text' => 'Jenis Pembayaran telah dihapus!',
            'icon' => 'success'
        ]);
    }



    // Diskon
    function cont7(){
        $diskons = Diskon::all();
        return view('bendahara.cont7', [
            'title' => 'Bendahara',
            'diskons' => $diskons
        ]);
    }
    
    function Diskon(Request $request){
        $request->validate([
            'kode_diskon' => ['required', 'string', 'max:50', 'unique:diskons'],
            'nama_diskon' => ['required', 'string', 'max:100'],
            'persentase_diskon' => ['required', 'numeric', 'min:0', 'max:100'],
            'tanggal_mulai' => ['required', 'date'],
            'tanggal_berakhir' => ['required', 'date', 'after_or_equal:tanggal_mulai'],
            'foto' => ['nullable', 'image'],
            'deskripsi' => ['nullable', 'string'],
            'aktif' => ['required', 'boolean']
        ]);
    
        $diskonData = $request->except('foto');
        
        // Handle file upload
        if ($request->hasFile('foto')) {
            $diskonData['foto'] = $request->file('foto')->store('diskons', 'public');
        }
    
        try {
            Diskon::create($diskonData);
            
            return redirect()->route('diskon')->with('swal', [
                'title' => 'Berhasil!',
                'text' => 'Diskon berhasil dibuat!',
                'icon' => 'success',
                'draggable' => true
            ]);
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal menyimpan diskon: ' . $e->getMessage()]);
        }
    }
    
    public function updateDiskon(Request $request, $id){
        $diskon = Diskon::findOrFail($id);
        
        $validasi = $request->validate([
            'kode_diskon' => ['required', 'string', 'max:50', 'unique:diskons,kode_diskon,'.$id],
            'nama_diskon' => ['required', 'string', 'max:100'],
            'persentase_diskon' => ['required', 'numeric', 'min:0', 'max:100'],
            'tanggal_mulai' => ['required', 'date'],
            'tanggal_berakhir' => ['required', 'date', 'after_or_equal:tanggal_mulai'],
            'foto' => ['nullable', 'image'],
            'deskripsi' => ['nullable', 'string'],
            'aktif' => ['required', 'boolean']
        ]);
    
        $updateData = $request->except('foto');
        
        // Handle file upload
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($diskon->foto && Storage::exists('public/' . $diskon->foto)) {
                Storage::delete('public/' . $diskon->foto);
            }
        }
    
        try {
            $diskon->update($updateData);
            
            return redirect()->route('diskon')->with('swal', [
                'title' => 'Berhasil!',
                'text' => 'Diskon berhasil diperbarui!',
                'icon' => 'success',
                'draggable' => true
            ]);
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal memperbarui diskon: ' . $e->getMessage()]);
        }
    }
    
    function destroyDiskon($id){
        $diskon = Diskon::find($id);
        
        if (!$diskon) {
            return back()->with('error', 'Diskon tidak ditemukan.');
        }
    
        try {
            // Hapus foto jika ada
            if ($diskon->foto && Storage::exists('public/' . $diskon->foto)) {
                Storage::delete('public/' . $diskon->foto);
            }
            
            $diskon->delete();
            
            return redirect()->route('diskon')->with('swal', [
                'title' => 'Berhasil!',
                'text' => 'Diskon berhasil dihapus!',
                'icon' => 'success'
            ]);
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal menghapus diskon: ' . $e->getMessage()]);
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
