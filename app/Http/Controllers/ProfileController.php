<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Reservasi;

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
