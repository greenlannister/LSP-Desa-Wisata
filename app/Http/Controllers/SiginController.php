<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class SiginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('be.login', [
            'title' => 'Login',
        ]);
    }

    function login(Request $request){
        $request->validate([
            'email'=>'required',
            'password' => 'required'
        ],[
            'email.required' => 'Email wajib diisi',
            'password.required' => 'Password wajib diisi',
        ]);

        $credentials = $request->only('email', 'password');
        $credentials['aktif'] = 1; // Hanya user aktif yang bisa login

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate(); // Regenerate session untuk keamanan

            // Redirect berdasarkan level user
            switch (Auth::user()->level) {
                case 'pelanggan':
                    return redirect('/');
                case 'bendahara':
                    return redirect('/bendahara-dwp');
                case 'admin':
                    return redirect('/admin-dwp');
                case 'pemilik':
                    return redirect('/owner-dwp');
                default:
                    Auth::logout();
                    return redirect('/login')->withErrors('Akses tidak valid');
            }
        }

        return redirect('/login')
            ->withErrors('Email atau password salah')
            ->withInput($request->except('password'));

    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
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
