<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori_Wisata;
use App\Models\Objek_Wisata;
use App\Models\Paket_Wisata;

class PackagesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $obtas = Objek_Wisata::with('kategori_wisata')->get();
        $kategori_wisatas = Kategori_Wisata::all();
        $paket_wisatas = Paket_Wisata::all(); // ambil data dari tabel ketiga

        return view('package.index', [
            'obtas' => $obtas,
            'kategori_wisatas' => $kategori_wisatas,
            'paket_wisatas' => $paket_wisatas, // kirim ke view
            'title' => 'Packages'
        ]);
        
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
