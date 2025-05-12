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
        Schema::create('objek_wisatas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_wisata')->unique();
            $table->text('deskripsi');
            $table->unsignedBigInteger('id_kategori_wisata');
            $table->foreign('id_kategori_wisata')->references('id')->on('kategori_wisatas')->onDelete('cascade')->onUpdate('cascade');
            $table->text('fasilitas');
            $table->text('foto1');
            $table->text('foto2');
            $table->text('foto3')->nullable();
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
        Schema::dropIfExists('objek_wisatas');
    }
};
