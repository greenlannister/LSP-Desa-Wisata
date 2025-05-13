<?php

namespace App\Models;

use App\Models\Diskon;
use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
    protected $table = 'reservasis';

    protected $fillable = ['id_pelanggan', 'id_paket_wisata', 'id_diskon', 'id_jenis_pembayaran', 'tanggal_reservasi', 'harga', 'jumlah_peserta', 'persentase_diskon', 'nilai_diskon', 'subtotal', 'total_bayar', 'bukti_tf', 'status_reservasi'];

    public function diskons(){
        return $this->belongsTo(Diskon::class, 'diskon_id');
    }
}
