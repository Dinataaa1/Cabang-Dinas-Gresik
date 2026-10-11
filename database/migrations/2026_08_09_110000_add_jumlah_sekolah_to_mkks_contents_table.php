<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('mkks_contents', function (Blueprint $table) {
            $table->unsignedInteger('jumlah_sekolah')->default(0)->after('content');
        });
    }

    public function down(): void
    {
        Schema::table('mkks_contents', function (Blueprint $table) {
            $table->dropColumn('jumlah_sekolah');
        });
    }
};
