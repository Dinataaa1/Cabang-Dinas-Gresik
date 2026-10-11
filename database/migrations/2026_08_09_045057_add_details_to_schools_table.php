<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('schools', function (Blueprint $table) {
            $table->unsignedInteger('jumlah_tendik')->default(0)->after('jumlah_guru');
            $table->unsignedInteger('siswa_x_l')->default(0)->after('jumlah_siswa');
            $table->unsignedInteger('siswa_x_p')->default(0)->after('siswa_x_l');
            $table->unsignedInteger('siswa_xi_l')->default(0)->after('siswa_x_p');
            $table->unsignedInteger('siswa_xi_p')->default(0)->after('siswa_xi_l');
            $table->unsignedInteger('siswa_xii_l')->default(0)->after('siswa_xi_p');
            $table->unsignedInteger('siswa_xii_p')->default(0)->after('siswa_xii_l');
        });
    }

    public function down(): void
    {
        Schema::table('schools', function (Blueprint $table) {
            $table->dropColumn([
                'jumlah_tendik',
                'siswa_x_l',
                'siswa_x_p',
                'siswa_xi_l',
                'siswa_xi_p',
                'siswa_xii_l',
                'siswa_xii_p'
            ]);
        });
    }
};
