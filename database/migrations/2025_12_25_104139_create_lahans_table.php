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
        Schema::create('lahan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('peserta_id');
            $table->foreignId('petani_id');
            $table->string('no_shm');
            $table->date('tanggal_shm');
            $table->string('alamat_jaminan');
            $table->unsignedBigInteger('luas_jumlah');
            $table->foreignId('blok_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lahan');
    }
};
