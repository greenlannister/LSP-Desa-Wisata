<?php

namespace App\Models;

use App\Models\Diskon;
use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
    protected $table = 'reservasis';

    protected $fillable = [
    'id_user',
    'id_pelanggan',
    'id_jenis_pembayaran',
    'id_diskon',
    'id_paket_wisata',
    'nama_pelanggan',
    'email',
    'tgl_mulai_reservasi',
    'tgl_selesai_reservasi',
    'harga',
    'jumlah_peserta',
    'persentase_diskon',
    'nilai_diskon',
    'subtotal',
    'total_bayar',
    'bukti_tf',
    'status_reservasi'    
    ];

    protected $casts = [
        'tgl_mulai_reservasi' => 'datetime',
        'tgl_selesai_reservasi' => 'datetime',
    ];


    public function diskon(){
        return $this->belongsTo(Diskon::class, 'id_diskon');
    }
    
    public function paketWisata(){
        return $this->belongsTo(Paket_Wisata::class, 'id_paket_wisata');
    }
    
    public function user(){
        return $this->belongsTo(User::class, 'id_user');
    }
    
    public function jenisPembayaran(){
        return $this->belongsTo(Jenis_Pembayaran::class, 'id_jenis_pembayaran');
    }
    
    public function pelanggan(){
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan');
    }
    
}

