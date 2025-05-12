<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Pelanggan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Storage; 
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;

class RegisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('fe.sigup', [
            'title' => 'Register',
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'nama_pelanggan' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string'],
            'nomor_HP' => ['required', 'string', 'max:15'],
            'foto' => ['nullable', 'image', 'max:2048'],
        ], [
            'email.required' => 'Email wajib diisi',
            'password.required' => 'Password wajib diisi',
            'nama_pelanggan.required' => 'Nama wajib diisi',
            'alamat.required' => 'Alamat wajib diisi',
            'nomor_HP.required' => 'Nomor Handphone wajib diisi',
        ]);

        try {
            DB::transaction(function() use ($request) {
                $user = User::create([
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'level' => 'pelanggan', 
                    'aktif' => 1
                ]);

                $fotoPath = $request->file('foto') ? $request->file('foto')->store('pelanggan', 'public') : null;

                Pelanggan::create([
                    'nama_pelanggan' => $request->nama_pelanggan,
                    'alamat' => $request->alamat,
                    'nomor_HP' => $request->nomor_HP,
                    'id_user' => $user->id,
                    'foto' => $fotoPath
                ]);
                Auth::login($user); 
            });


        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat registrasi.')->withInput();
        }

            return redirect('/')->with('success', 'Berhasil daftar, silakan login!');
        
    }

    
    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     //
    // }

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
