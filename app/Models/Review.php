<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    // Model Review
    protected $table = 'review';

    protected $fillable = ['id_pelanggan', 'ulasan'];

    // Relasi yang benar ke Pelanggan
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan');
    }
}
