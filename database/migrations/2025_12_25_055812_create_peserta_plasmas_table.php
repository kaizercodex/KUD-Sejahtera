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
        Schema::create('peserta_plasma', function (Blueprint $table) {
            $table->id();
            $table->string('no_reg')->unique();
            $table->string('nama');
            $table->string('nik_ktp', 16)->unique();
            $table->string('no_kk', 16);
            $table->text('alamat');
            $table->string('no_hp', 16)->nullable();
            $table->string('photo')->nullable();
            $table->foreignId('kelompok_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peserta_plasma');
    }
};
