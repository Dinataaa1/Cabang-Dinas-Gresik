<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('skm_responses', function (Blueprint $table) {
            $table->string('nama')->nullable()->after('id');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan'])->nullable()->after('nama');
            $table->unsignedTinyInteger('usia')->nullable()->after('jenis_kelamin');
            $table->string('pendidikan')->nullable()->after('usia');
            $table->string('pekerjaan')->nullable()->after('pendidikan');
            $table->string('layanan_diterima')->nullable()->after('pekerjaan');
            $table->date('tanggal_pelayanan')->nullable()->after('layanan_diterima');
        });
    }

    public function down(): void
    {
        Schema::table('skm_responses', function (Blueprint $table) {
            $table->dropColumn(['nama','jenis_kelamin','usia','pendidikan','pekerjaan','layanan_diterima','tanggal_pelayanan']);
        });
    }
};
