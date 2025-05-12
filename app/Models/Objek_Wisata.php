<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Objek_Wisata extends Model
{
    protected $table = 'objek_wisatas';

    protected $fillable = [
        'nama_wisata', 'deskripsi', 'fasilitas', 'id_kategori_wisata', 'foto1', 'foto2', 'foto3', 'foto4', 'foto5', 'foto6', 'foto7'
    ];

    public function kategori_wisata()
    {
        return $this->belongsTo(Kategori_Wisata::class, 'id_kategori_wisata');
    }

}
