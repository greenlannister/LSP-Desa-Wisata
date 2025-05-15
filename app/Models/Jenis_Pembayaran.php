<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jenis_Pembayaran extends Model
{
    protected $table = 'jenis_pembayarans';

    protected $fillable = ['jenis_pembayaran', 'nomor_tf', 'foto'];
    public function jenisPembayaran(){
        return $this->belongsTo(Jenis_Pembayaran::class, 'id_jenis_pembayaran');
    }
}
