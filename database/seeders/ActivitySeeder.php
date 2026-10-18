<?php

namespace Database\Seeders;

use App\Models\Activity;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ActivitySeeder extends Seeder
{
    public function run(): void
    {
        Activity::truncate();

        Activity::create([
            'title' => 'Lomba Kompetensi Siswa (LKS) SMK Tingkat Wilayah Kerja 2026',
            'slug' => Str::slug('Lomba Kompetensi Siswa (LKS) SMK Tingkat Wilayah Kerja 2026') . '-' . Str::random(5),
            'description' => '<p>Kegiatan Lomba Kompetensi Siswa (LKS) SMK merupakan ajang kompetensi tahunan bergengsi antar siswa SMK se-Kabupaten Gresik untuk unjuk keahlian pada bidang studi keahlian masing-masing. Kegiatan ini diikuti oleh perwakilan siswa terbaik dari puluhan SMK Negeri dan Swasta.</p><p>Kategori yang dilombakan meliputi teknologi informasi, kelistrikan, otomotif, hingga seni kriya. Pemenang tingkat kabupaten akan mewakili Kabupaten Gresik ke tingkat Provinsi Jawa Timur.</p>',
            'location' => 'SMK Negeri 1 Gresik',
            'activity_date' => '2026-03-10',
            'category' => 'prestasi',
            'cover_image' => 'activities/lks_cover.jpg',
            'images' => [
                'activities/lks_1.jpg',
                'activities/lks_2.jpg',
                'activities/lks_3.jpg',
            ],
            'is_published' => true,
        ]);

        Activity::create([
            'title' => 'Festival & Lomba Seni Siswa Nasional (FLS2N) SMA/SMK Gresik',
            'slug' => Str::slug('Festival & Lomba Seni Siswa Nasional (FLS2N) SMA/SMK Gresik') . '-' . Str::random(5),
            'description' => '<p>Ajang festival seni pelajar SMA dan SMK tingkat Kabupaten Gresik kembali diselenggarakan dengan meriah. Berbagai cabang seni seperti tari kreasi, vokal solo, baca puisi, desain poster, dan kriya seni diikuti oleh ratusan siswa bertalenta tinggi.</p><p>Kegiatan bertujuan menggali dan mengembangkan kreativitas seni generasi muda sekaligus memupuk rasa bangga terhadap budaya Nusantara.</p>',
            'location' => 'Gedung Nasional Indonesia (GNI) Gresik',
            'activity_date' => '2026-04-15',
            'category' => 'seni',
            'cover_image' => 'activities/fls2n_cover.jpg',
            'images' => [
                'activities/fls2n_1.jpg',
                'activities/fls2n_2.jpg',
                'activities/fls2n_3.jpg',
            ],
            'is_published' => true,
        ]);

        Activity::create([
            'title' => 'Rapat Koordinasi Evaluasi PPDB SMA/SMK Kabupaten Gresik',
            'slug' => Str::slug('Rapat Koordinasi Evaluasi PPDB SMA/SMK Kabupaten Gresik') . '-' . Str::random(5),
            'description' => '<p>Rapat koordinasi rutin yang dihadiri seluruh jajaran Kepala Sekolah SMA dan SMK Negeri se-Kabupaten Gresik untuk mengevaluasi pelaksanaan Penerimaan Peserta Didik Baru (PPDB) Jawa Timur tahun ajaran berjalan.</p><p>Rapat dipimpin langsung oleh Kepala Cabang Dinas Pendidikan Provinsi Jawa Timur Wilayah Kabupaten Gresik guna memastikan transparansi, keadilan, dan akuntabilitas PPDB.</p>',
            'location' => 'Aula Cabang Dinas Pendidikan Gresik',
            'activity_date' => '2026-07-22',
            'category' => 'pendidikan',
            'cover_image' => 'activities/tc90IFEA99zmVKxiaAFwJmFDG7bJMJmKdsxy32d9.jpg',
            'images' => [
                'activities/RBnxAuNt8941VMbQZM9PoNCq5AmWzkshdc95W8FN.jpg',
                'activities/k5GxZA9RWQO3tfFnJBGVSTXlDwAhtyQl3qrn1JRU.jpg',
                'activities/iB8piMtJArjbkfgYSKYdSjlKGNRFbhxsjghTocpT.jpg',
            ],
            'is_published' => true,
        ]);
    }
}
