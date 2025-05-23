<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    protected $table = 'pelanggans';

    protected $fillable = [
        'nama_pelanggan', 'alamat', 'nomor_HP', 'id_user', 'foto'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
    public function review()
    {
        return $this->hasMany(Review::class, 'id_pelanggan');
    }
}
