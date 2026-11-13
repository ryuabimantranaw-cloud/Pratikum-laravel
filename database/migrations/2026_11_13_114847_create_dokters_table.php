<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dokter_0004', function (Blueprint $table) {
            $table->id();
            $table->string('kode_dokter', 20)->unique();
            $table->string('nama_lengkap', 100);
            $table->string('gelar', 50)->nullable();
            $table->string('jenis_kelamin', 20);
            $table->string('sip', 50);
            $table->string('spesialisasi', 50);
            $table->string('hari_praktik')->nullable();
            $table->string('email', 100)->nullable();
            $table->string('telepon', 20);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dokter_0004');
    }
};