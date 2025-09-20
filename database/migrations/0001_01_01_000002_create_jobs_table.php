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
        Schema::create('surats', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_surat')->unique();   // Nomor Surat
            $table->string('kategori');                // Kategori Surat
            $table->string('judul');                   // Judul Surat
            $table->timestamp('waktu_pengarsipan')->useCurrent(); // Waktu Pengarsipan
            $table->string('file_path')->nullable();   // opsional: simpan path file surat
            $table->timestamps();                      // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surats');
    }
};
