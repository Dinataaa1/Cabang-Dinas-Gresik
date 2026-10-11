<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('mkks_contents', function (Blueprint $table) {
            $table->unsignedInteger('jumlah_sekolah')->default(0)->after('content');
            $table->unsignedInteger('jumlah_guru')->default(0)->after('jumlah_sekolah');
            $table->unsignedInteger('jumlah_siswa')->default(0)->after('jumlah_guru');
            $table->text('prestasi_unggulan')->nullable()->after('jumlah_siswa');
        });
    }

    public function down(): void
    {
        Schema::table('mkks_contents', function (Blueprint $table) {
            $table->dropColumn(['jumlah_sekolah', 'jumlah_guru', 'jumlah_siswa', 'prestasi_unggulan']);
        });
    }
};
