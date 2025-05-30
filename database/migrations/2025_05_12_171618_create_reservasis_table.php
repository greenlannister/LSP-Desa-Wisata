<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reservasis', function (Blueprint $table) {
            $table->id();
            
            // Kolom foreign key
            $table->unsignedBigInteger('id_pelanggan');
            $table->unsignedBigInteger('id_user'); // Tambahan untuk relasi ke users
            $table->unsignedBigInteger('id_paket_wisata');
            $table->unsignedBigInteger('id_diskon')->nullable();
            $table->unsignedBigInteger('id_jenis_pembayaran')->nullable();
            
            // Kolom lainnya
            $table->string('nama_pelanggan');
            $table->string('email'); // Dihapus unique()
            $table->dateTime('tgl_mulai_reservasi');
            $table->dateTime('tgl_selesai_reservasi');
            $table->decimal('harga', 12, 2);
            $table->integer('jumlah_peserta')->default(1);
            $table->decimal('persentase_diskon', 5, 2)->nullable();
            $table->decimal('nilai_diskon', 12, 2)->nullable();
            $table->decimal('subtotal', 12, 2);
            $table->decimal('total_bayar', 12, 2);
            $table->text('bukti_tf')->nullable();
            $table->enum('status_reservasi', ['Dipesan', 'Selesai', 'Dibatalkan'])->default('Dipesan');
            $table->timestamps();
            
            // Foreign key constraints
            $table->foreign('id_pelanggan')
                  ->references('id')
                  ->on('pelanggans')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            
            $table->foreign('id_user')
                  ->references('id')
                  ->on('users')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            
            $table->foreign('id_paket_wisata')
                  ->references('id')
                  ->on('paket_wisatas')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            
            $table->foreign('id_diskon')
                  ->references('id')
                  ->on('diskons')
                  ->onUpdate('cascade')
                  ->onDelete('set null');
            
            $table->foreign('id_jenis_pembayaran')
                  ->references('id')
                  ->on('jenis_pembayarans')
                  ->onUpdate('cascade')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservasis');
    }
};
