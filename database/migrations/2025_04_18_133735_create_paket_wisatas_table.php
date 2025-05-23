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
        Schema::create('paket_wisatas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_paket')->unique();
            $table->text('deskripsi');
            $table->string('fasilitas');
            $table->integer('harga_per_pack');
            $table->integer('max_kapasitas');
            $table->text('foto1');
            $table->text('foto2');
            $table->text('foto3');
            $table->text('foto4')->nullable();
            $table->text('foto5')->nullable();
            $table->text('foto6')->nullable();
            $table->text('foto7')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paket_wisatas');
    }
};
