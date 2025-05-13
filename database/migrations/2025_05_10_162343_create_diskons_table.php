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
        Schema::create('diskons', function (Blueprint $table) {
            $table->id();
            $table->string('kode_diskon', 50)->unique();
            $table->string('nama_diskon', 100);
            $table->decimal('persentase_diskon', 5, 2); // Contoh: 15.50%
            $table->date('tanggal_mulai');
            $table->date('tanggal_berakhir');
            $table->text('deskripsi')->nullable();
            $table->string('foto')->nullable();
            $table->boolean('aktif')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diskons');
    }
};
