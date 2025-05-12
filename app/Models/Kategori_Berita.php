<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori_Berita extends Model
{
    protected $table = 'kategori_beritas';

    protected $fillable = ['kategori_berita'];

    public function beritas(){
        return $this->hasMany(Kategori_Berita::class, 'kategori_berita_id');
    }
}

