<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paket_Wisata extends Model
{
    protected $table = 'paket_wisatas';

    protected $fillable = ['nama_paket', 'deskripsi', 'fasilitas', 'harga_per_pack', 'foto1', 'foto2', 'foto3', 'foto4', 'foto5', 'foto6', 'foto7'];

    public function reservasis(){
        return $this->hasMany(Paket_Wisata::class, 'paket_wisata_id');
    }
}
