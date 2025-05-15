<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paket_Wisata extends Model
{
    protected $table = 'paket_wisatas';

    protected $fillable = ['nama_paket', 'deskripsi', 'fasilitas', 'harga_per_pack', 'max_kapasitas', 'foto1', 'foto2', 'foto3', 'foto4', 'foto5', 'foto6', 'foto7'];

    // Should be (matches your fillable field):
    public function reservasis(){
        return $this->hasMany(Reservasi::class, 'id_paket_wisata');
    }
}
