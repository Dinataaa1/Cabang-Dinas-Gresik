<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use App\Models\Activity;

return new class extends Migration {
    public function up(): void
    {
        // 1. Update LKS Activity
        $lks = Activity::where('title', 'like', '%Lomba Kompetensi Siswa%')->orWhere('slug', 'like', '%lks%')->first();
        if ($lks) {
            $lks->update([
                'cover_image' => 'activities/lks_cover.jpg',
                'images' => [
                    'activities/lks_1.jpg',
                    'activities/lks_2.jpg',
                    'activities/lks_3.jpg',
                ],
            ]);
        }

        // 2. Update FLS2N Activity
        $fls2n = Activity::where('title', 'like', '%Festival%Lomba Seni%')->orWhere('slug', 'like', '%fls2n%')->first();
        if ($fls2n) {
            $fls2n->update([
                'cover_image' => 'activities/fls2n_cover.jpg',
                'images' => [
                    'activities/fls2n_1.jpg',
                    'activities/fls2n_2.jpg',
                    'activities/fls2n_3.jpg',
                ],
            ]);
        }

        // 3. Update PPDB Activity
        $ppdb = Activity::where('title', 'like', '%PPDB%')->orWhere('slug', 'like', '%ppdb%')->first();
        if ($ppdb) {
            $ppdb->update([
                'cover_image' => 'activities/tc90IFEA99zmVKxiaAFwJmFDG7bJMJmKdsxy32d9.jpg',
                'images' => [
                    'activities/RBnxAuNt8941VMbQZM9PoNCq5AmWzkshdc95W8FN.jpg',
                    'activities/k5GxZA9RWQO3tfFnJBGVSTXlDwAhtyQl3qrn1JRU.jpg',
                    'activities/iB8piMtJArjbkfgYSKYdSjlKGNRFbhxsjghTocpT.jpg',
                ],
            ]);
        }

        // If no activities existed at all on this DB, run the seeder
        if (Activity::count() === 0) {
            $seeder = new \Database\Seeders\ActivitySeeder();
            $seeder->run();
        }
    }

    public function down(): void
    {
        // No-op
    }
};
