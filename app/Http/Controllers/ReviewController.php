<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'ulasan' => 'required|string|max:1000',
        ]);

        // Pastikan user sudah login dan memiliki data pelanggan
        if (!Auth::check() || !Auth::user()->pelanggan) {
            return redirect()->back()->with('error', 'Anda harus login sebagai pelanggan untuk memberikan review.');
        }

        Review::create([
            'id_pelanggan' => Auth::user()->pelanggan->id,
            'ulasan' => $request->ulasan,
        ]);

        return redirect()->back()->with('success', 'Review berhasil ditambahkan!');
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
