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
            
            // Definisikan kolom foreign key terlebih dahulu
            $table->unsignedBigInteger('id_pelanggan');
            $table->unsignedBigInteger('id_paket_wisata');
            $table->unsignedBigInteger('id_diskon')->nullable();
            
            // Kolom lainnya
            $table->dateTime('tanggal_reservasi');
            $table->decimal('harga', 12, 2);
            $table->integer('jumlah_peserta')->default(1);
            $table->decimal('persentase_diskon', 5, 2)->nullable();
            $table->decimal('nilai_diskon', 12, 2)->nullable();
            $table->decimal('subtotal', 12, 2);
            $table->decimal('total_bayar', 12, 2);
            $table->text('bukti_tf')->nullable();
            $table->enum('status_reservasi', ['Dipesan', 'Menunggu Konfirmasi', 'Ditolak', 'Selesai'])->default('Dipesan');
            $table->timestamps();
            
            // Tambahkan foreign key constraints SETELAH semua kolom didefinisikan
            $table->foreign('id_pelanggan')
                  ->references('id')
                  ->on('pelanggans')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            
            $table->foreign('id_paket_wisata')
                  ->references('id')
                  ->on('paket_wisatas')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            
            // Untuk diskon yang nullable, gunakan set null
            $table->foreign('id_diskon')
                  ->references('id')
                  ->on('diskons')
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
