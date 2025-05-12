<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    protected $table = 'beritas';

    protected $fillable = [
        'judul', 'berita', 'tanggal_post', 'id_kategori_berita', 'foto1', 'foto2', 'foto3'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori_Berita::class, 'id_kategori_berita');
    }

    protected $casts = [
        'tanggal_post' => 'date',
    ];
    
}

