<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContactFormMail;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('contact.index', [
            'title' => 'Contact',
        ]);
    }

    public function sendEmail(Request $request)
    {
        // Tambahkan ini untuk debugging
        $viewPath = resource_path('views\fe\emails\contact-form.blade.php');
        if (!file_exists($viewPath)) {
            return response()->json([
                'success' => false,
                'message' => 'View file not found at: '.$viewPath
            ]);
        }

        // Validasi input
        $request->validate([
            'cname' => 'required|string|max:255',
            'cemail' => 'required|email',
            'cmessage' => 'required|string',
            'cterms' => 'required|accepted'
        ]);

        // Kirim email
        Mail::to('putriauliarahma129l@gmail.com')
            ->send(new ContactFormMail(
                $request->input('cname'),
                $request->input('cemail'),
                $request->input('cmessage')
            ));

        return response()->json([
            'success' => true,
            'message' => 'Pesan Anda telah terkirim. Terima kasih!'
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
