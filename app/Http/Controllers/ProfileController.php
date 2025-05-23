<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Reservasi;
use App\Models\Pelanggan;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{

    public function ProfileKar()
    {
        $user = Auth::user();

        $profile = User::with('karyawan')->where('id', $user->id)->first();

        return view('be.profile-kar', [
            'title' => 'Profil Karyawan',
            'profile' => $profile
        ]);
    }

    public function Profile(){
        $userId = Auth::id();

        $profilepel = User::with('pelanggan')->findOrFail($userId);
        
        $reservasis = Reservasi::with(['paketWisata', 'user'])
            ->where('id_user', $userId)
            ->orderBy('tgl_mulai_reservasi', 'desc')
            ->get();

        return view('fe.profile', [
            'title' => 'Profil Pelanggan',
            'profilepel' => $profilepel,
            'reservasis' => $reservasis
        ]);
    }

    public function update(Request $request)
    {
        $userId = Auth::id();
        
        // Validasi input
        $request->validate([
            'nama_pelanggan' => ['required', 'string', 'max:255'],
            'email' => 'required|email|unique:users,email,' . $userId,
            'alamat' => ['required', 'string'],
            'nomor_HP' => ['required', 'string', 'max:15'],
            'foto' => ['nullable', 'image', 'max:2048'],
        ]);
    
        try {
            // Update data di tabel users
            $user = User::findOrFail($userId);
            $user->email = $request->email;
            $user->save();
    
            // Update data di tabel pelanggans
            $pelanggan = Pelanggan::where('id_user', $userId)->firstOrFail();
            $pelanggan->nama_pelanggan = $request->nama_pelanggan;
            $pelanggan->nomor_HP = $request->nomor_HP;
            $pelanggan->alamat = $request->alamat;
    
            // Handle upload foto jika ada
            if ($request->hasFile('foto')) {
                // Hapus foto lama jika ada
                if ($pelanggan->foto) {
                    Storage::disk('public')->delete($pelanggan->foto);
                }
                
                // Simpan foto baru
                $pelanggan->foto = $request->file('foto')->store('pelanggan', 'public');
            }
    
            $pelanggan->save();
    
            return redirect()->back()->with('success', 'Profil berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui profil: ' . $e->getMessage());
        }
    }

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
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
