<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penginapan extends Model
{
    protected $table = 'penginapans';

    protected $fillable = ['nama_penginapan', 'deskripsi', 'fasilitas', 'foto1', 'foto2', 'foto3', 'foto4', 'foto5'];
}
