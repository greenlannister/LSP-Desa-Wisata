<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori_Wisata extends Model
{
    protected $table = 'kategori_wisatas';

    protected $fillable = ['kategori_wisata'];

    public function objek_wisata(){
        return $this->hasMany(Objek_Wisata::class, 'id_kategori_wisata');
    }
}
