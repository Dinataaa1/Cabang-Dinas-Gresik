<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Rename jumlah_sekolah → jumlah_prestasi on mkks_contents
        Schema::table('mkks_contents', function (Blueprint $table) {
            $table->renameColumn('jumlah_sekolah', 'jumlah_prestasi');
        });

        // Create schools table for per-school data
        Schema::create('schools', function (Blueprint $table) {
            $table->id();
            $table->string('category');         // SMA | SMK | PK/PLK
            $table->string('name');             // Nama Sekolah
            $table->string('npsn')->nullable(); // NPSN
            $table->string('address')->nullable();
            $table->unsignedInteger('jumlah_guru')->default(0);
            $table->unsignedInteger('jumlah_siswa')->default(0);
            $table->unsignedInteger('jumlah_prestasi')->default(0);
            $table->string('status')->default('Negeri'); // Negeri | Swasta
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::table('mkks_contents', function (Blueprint $table) {
            $table->renameColumn('jumlah_prestasi', 'jumlah_sekolah');
        });
        Schema::dropIfExists('schools');
    }
};
