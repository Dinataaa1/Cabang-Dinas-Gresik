<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('location')->nullable();       // Lokasi kegiatan
            $table->date('activity_date')->nullable();    // Tanggal kegiatan
            $table->string('category')->default('umum'); // umum, prestasi, sosial, olahraga, seni, dll
            $table->json('images')->nullable();           // Array foto kegiatan (slideshow)
            $table->string('cover_image')->nullable();    // Foto sampul utama
            $table->boolean('is_published')->default(true);
            $table->integer('views')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
};
