<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Diskon extends Model
{
    protected $table = 'diskons';

    protected $fillable = ['nama_diskon', 'kode_diskon', 'persentase_diskon', 'tanggal_mulai', 'tanggal_berakhir', 'deskripsi', 'aktif'];

    public function reservasis(){
        return $this->hasMany(Diskon::class, 'diskon_id');
    }

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_berakhir' => 'date',
        'aktif' => 'boolean'
    ];
}
