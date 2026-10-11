<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('skm_responses', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('q1'); // Persyaratan
            $table->unsignedTinyInteger('q2'); // Prosedur
            $table->unsignedTinyInteger('q3'); // Waktu
            $table->unsignedTinyInteger('q4'); // Biaya
            $table->unsignedTinyInteger('q5'); // Produk/Hasil
            $table->unsignedTinyInteger('q6'); // Kompetensi Petugas
            $table->unsignedTinyInteger('q7'); // Perilaku Petugas
            $table->unsignedTinyInteger('q8'); // Sarana Prasarana
            $table->text('saran')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('skm_responses');
    }
};
