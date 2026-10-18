<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Profile;
use App\Models\Post;
use App\Models\Service;
use App\Models\MkksContent;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Seed Admin User
        User::create([
            'name' => 'Admin Cabdin Gresik',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
        ]);

        // 2. Seed Default Profile Contents
        Profile::create([
            'key' => 'about',
            'content' => 'Cabang Dinas Pendidikan Wilayah Kabupaten Gresik merupakan unit kerja di bawah Dinas Pendidikan Provinsi Jawa Timur yang bertugas menyelenggarakan pelayanan publik, pembinaan, serta pengawasan jenjang SMA, SMK, dan PK-PLK di wilayah Kabupaten Gresik.',
            'image' => null,
        ]);

        Profile::create([
            'key' => 'visi_misi',
            'content' => "### Visi\r\nTerwujudnya layanan pendidikan menengah dan khusus yang berkualitas, berkarakter, berdaya saing, dan merata menuju masyarakat Kabupaten Gresik yang sejahtera.\r\n\r\n### Misi\r\n1. Meningkatkan aksesbilitas dan pemerataan layanan pendidikan berkualitas.\r\n2. Meningkatkan mutu pendidik, tenaga kependidikan, serta fasilitas sekolah.\r\n3. Membina karakter dan budi pekerti luhur berlandaskan kearifan lokal.\r\n4. Mendorong inovasi dan kreativitas sekolah di bidang akademik maupun kejuruan.",
            'image' => null,
        ]);

        Profile::create([
            'key' => 'struktur',
            'content' => 'Berikut adalah bagan struktur organisasi Cabang Dinas Pendidikan Wilayah Kabupaten Gresik. Anda dapat melihat alur kepemimpinan dan pembagian seksi bidang pelayanan di bawah Kepala Cabang Dinas.',
            'image' => null,
        ]);

        // 3. Seed Sample Posts (Berita, Pengumuman, Inovasi, Prestasi)
        $posts = [
            [
                'title' => 'SDN 1 Gresik Raih Penghargaan Bergengsi Sekolah Adiwiyata Mandiri 2026',
                'slug' => 'sdn-1-gresik-raih-adiwiyata-mandiri-2026',
                'content' => 'Kabar membanggakan menyelimuti dunia pendidikan dasar di Kabupaten Gresik. Sekolah Dasar Negeri (SDN) 1 Gresik secara resmi dinobatkan sebagai penerima penghargaan Sekolah Adiwiyata Mandiri 2026 dari Kementerian Lingkungan Hidup dan Kehutanan bersama Kementerian Pendidikan. Penghargaan ini diraih berkat konsistensi pihak sekolah, guru, dan para siswa dalam melestarikan lingkungan, mengelola sampah secara mandiri, serta menerapkan kurikulum berbasis cinta lingkungan hidup.',
                'type' => 'berita',
                'image' => 'https://kotagresik.com/wp-content/uploads/2026/06/WhatsApp-Image-2026-06-04-at-21.46.55.jpeg',
                'created_at' => '2026-08-01 09:00:00',
            ],
            [
                'title' => 'Dinas Pendidikan Kabupaten Gresik Gelar Festival Gerak Jalan Tradisional Pelajar SMP se-Kabupaten',
                'slug' => 'festival-gerak-jalan-tradisional-smp-gresik-2026',
                'content' => 'Dalam rangka menyambut hari kemerdekaan, Dinas Pendidikan Kabupaten Gresik sukses menyelenggarakan Festival Gerak Jalan Tradisional yang diikuti oleh ribuan pelajar dari SMP Negeri dan Swasta se-Kabupaten Gresik. Mengambil rute start dari alun-alun kota Gresik dan finish di Gelora Joko Samudro, para peserta menunjukkan antusiasme tinggi dengan kostum unik bermotif batik khas Gresik serta kekompakan baris-berbaris di sepanjang rute.',
                'type' => 'berita',
                'image' => 'https://images.unsplash.com/photo-1502086223501-7ea6ecd79368?q=80&w=800&auto=format&fit=crop',
                'created_at' => '2026-07-28 10:30:00',
            ],
            [
                'title' => 'Siswa SMAN 1 Gresik Terpilih Menjadi Anggota Paskibraka Provinsi Jawa Timur Tahun 2026',
                'slug' => 'siswa-sman-1-gresik-terpilih-paskibraka-jatim-2026',
                'content' => 'Prestasi membanggakan kembali ditorehkan oleh siswa jenjang menengah atas Kabupaten Gresik. Salah satu siswa kelas XI SMAN 1 Gresik berhasil lolos seleksi ketat dan terpilih menjadi bagian dari Pasukan Pengibar Bendera Pusaka (Paskibraka) tingkat Provinsi Jawa Timur yang akan bertugas pada upacara peringatan HUT RI ke-81 di Surabaya. Kepala Cabang Dinas Pendidikan memberikan apresiasi tinggi dan berharap prestasi ini memotivasi pelajar lain.',
                'type' => 'berita',
                'image' => 'https://images.unsplash.com/photo-1541339907198-e08756dedf3f?q=80&w=800&auto=format&fit=crop',
                'created_at' => '2026-07-25 08:00:00',
            ],
            [
                'title' => 'Pemerintah Kabupaten Gresik Meluncurkan Proyek Uji Coba Makan Siang Bergizi Gratis di Sekolah Dasar',
                'slug' => 'uji-coba-makan-siang-bergizi-gratis-sd-gresik',
                'content' => 'Pemerintah Kabupaten Gresik resmi memulai uji coba program pemberian makan siang bergizi gratis kepada siswa sekolah dasar. Langkah ini diambil untuk memastikan pemenuhan gizi anak-anak usia sekolah, meningkatkan konsentrasi dalam belajar, serta mengedukasi siswa mengenai pola makan sehat. Program ini diawasi ketat oleh dinas kesehatan dan ahli gizi untuk menjaga kehigienisan menu harian.',
                'type' => 'berita',
                'image' => 'https://images.unsplash.com/photo-1577896851231-70ef18881754?q=80&w=800&auto=format&fit=crop',
                'created_at' => '2026-07-22 11:15:00',
            ],
            [
                'title' => 'Bupati Gresik Resmikan Fasilitas Perpustakaan Digital Baru untuk SMP Negeri se-Kabupaten',
                'slug' => 'bupati-gresik-resmikan-perpustakaan-digital-smp',
                'content' => 'Guna mempercepat digitalisasi pendidikan dan meningkatkan minat baca siswa, Bupati Gresik meresmikan sistem perpustakaan digital terintegrasi untuk seluruh SMP Negeri di Kabupaten Gresik. Melalui platform digital ini, siswa dapat mengakses ribuan e-book, jurnal pendidikan, serta materi audio-visual secara gratis baik di sekolah maupun dari rumah masing-masing.',
                'type' => 'berita',
                'image' => 'https://images.unsplash.com/photo-1521587760476-6c12a4b040da?q=80&w=800&auto=format&fit=crop',
                'created_at' => '2026-07-20 14:00:00',
            ],
            [
                'title' => 'Penerimaan Peserta Didik Baru (PPDB) SMA/SMK Gresik 2026 Berjalan Sukses, Aman, dan Transparan',
                'slug' => 'ppdb-sma-smk-gresik-2026-sukses-dan-transparan',
                'content' => 'Proses Penerimaan Peserta Didik Baru (PPDB) online untuk jenjang SMA dan SMK di wilayah Kabupaten Gresik tahun pelajaran 2026/2027 resmi ditutup dengan sukses. Berdasarkan data evaluasi Cabang Dinas Pendidikan, seluruh tahapan pendaftaran mulai dari jalur afirmasi, prestasi, zonasi, hingga perpindahan tugas berjalan dengan aman, tertib, dan transparan tanpa ada kendala sistem yang berarti.',
                'type' => 'berita',
                'image' => 'https://images.unsplash.com/photo-1434030216411-0b793f4b4173?q=80&w=800&auto=format&fit=crop',
                'created_at' => '2026-07-15 16:30:00',
            ],
            [
                'title' => 'SMKN 1 Driyorejo Gresik Jalin Kerjasama Link & Match dengan Industri Manufaktur Besar',
                'slug' => 'smkn-1-driyorejo-kerjasama-link-match-industri',
                'content' => 'Sebagai upaya menyelaraskan kompetensi lulusan dengan kebutuhan dunia kerja, SMKN 1 Driyorejo Gresik menandatangani kesepakatan kerjasama (MoU) link and match dengan salah satu perusahaan manufaktur multinasional terbesar di kawasan industri Driyorejo. Kerjasama ini mencakup penyelarasan kurikulum kejuruan, magang industri bagi siswa, sertifikasi keahlian, hingga rekrutmen prioritas bagi lulusan terbaik.',
                'type' => 'berita',
                'image' => 'https://images.unsplash.com/photo-1581092918056-0c4c3acd3789?q=80&w=800&auto=format&fit=crop',
                'created_at' => '2026-07-10 10:00:00',
            ],
            [
                'title' => 'Festival Lomba Seni Siswa Nasional (FLS2N) Jenjang SD Tingkat Kabupaten Sukses Digelar',
                'slug' => 'fls2n-sd-tingkat-kabupaten-gresik-2026',
                'content' => 'Ajang Festival Lomba Seni Siswa Nasional (FLS2N) jenjang Sekolah Dasar (SD) tingkat Kabupaten Gresik tahun 2026 sukses diselenggarakan. Kompetisi ini menampilkan berbagai bakat seni siswa SD mulai dari lomba menyanyi tunggal, seni tari tradisional, gambar bercerita, hingga pantomim. Juara pertama dari masing-masing kategori akan mewakili Kabupaten Gresik di tingkat Provinsi.',
                'type' => 'berita',
                'image' => 'https://images.unsplash.com/photo-1460661419201-fd4cecdf8a8b?q=80&w=800&auto=format&fit=crop',
                'created_at' => '2026-07-05 08:30:00',
            ],
            [
                'title' => 'Dinas Pendidikan Gresik Salurkan Beasiswa bagi 500 Pelajar Berprestasi dari Keluarga Kurang Mampu',
                'slug' => 'beasiswa-dinas-pendidikan-gresik-500-pelajar',
                'content' => 'Dinas Pendidikan Kabupaten Gresik merealisasikan komitmen pemerataan akses pendidikan dengan menyalurkan beasiswa kepada 500 siswa berprestasi yang berasal dari keluarga kurang mampu. Beasiswa berupa bantuan dana pendidikan dan perlengkapan sekolah ini diserahkan langsung oleh Kepala Dinas secara simbolis di aula dinas pendidikan.',
                'type' => 'berita',
                'image' => 'https://images.unsplash.com/photo-1523240795612-9a054b0db644?q=80&w=800&auto=format&fit=crop',
                'created_at' => '2026-07-01 13:00:00',
            ],
            [
                'title' => 'Peringatan Hari Anak Nasional di Gresik, Siswa SLB Pamerkan Karya Seni Unik Damar Kurung',
                'slug' => 'hari-anak-nasional-slb-gresik-pamerkan-karya-seni',
                'content' => 'Dalam rangka memperingati Hari Anak Nasional 2026, siswa-siswi Sekolah Luar Biasa (SLB) se-Kabupaten Gresik memamerkan karya seni lukis lampion tradisional khas Gresik, Damar Kurung. Kegiatan pameran ini bertujuan melatih kreativitas, meningkatkan rasa percaya diri anak-anak berkebutuhan khusus, serta menunjukkan bahwa keterbatasan bukanlah halangan untuk berkarya dan melestarikan budaya lokal.',
                'type' => 'berita',
                'image' => 'https://images.unsplash.com/photo-1516627145497-ae6968895b74?q=80&w=800&auto=format&fit=crop',
                'created_at' => '2026-06-25 09:30:00',
            ],
            [
                'title' => 'SMAN 1 Manyar Gresik Menyelenggarakan Science Film Festival untuk Edukasi Perubahan Iklim',
                'slug' => 'sman-1-manyar-gresik-gelar-science-film-festival',
                'content' => 'SMAN 1 Manyar Gresik bekerjasama dengan institusi kebudayaan menyelenggarakan Science Film Festival 2026 yang mengusung tema pemanasan global dan perubahan iklim. Festival ini menayangkan berbagai film dokumenter ilmiah populer yang diikuti oleh diskusi edukatif dan eksperimen sains sederhana untuk meningkatkan kesadaran lingkungan siswa sejak dini.',
                'type' => 'berita',
                'image' => 'https://images.unsplash.com/photo-1503676260728-1c00da094a0b?q=80&w=800&auto=format&fit=crop',
                'created_at' => '2026-06-20 10:00:00',
            ],
            [
                'title' => 'Dinas Pendidikan Gresik Revitalisasi Sarana Prasarana 15 Sekolah Dasar di Wilayah Kepulauan Bawean',
                'slug' => 'revitalisasi-sekolah-dasar-kepulauan-bawean-gresik',
                'content' => 'Dinas Pendidikan Kabupaten Gresik merealisasikan proyek revitalisasi sarana dan prasarana sekolah untuk 15 Sekolah Dasar (SD) yang terletak di wilayah tertinggal Kepulauan Bawean. Revitalisasi ini meliputi perbaikan ruang kelas yang rusak, penyediaan fasilitas air bersih, sanitasi sekolah yang layak, serta bantuan laboratorium komputer dasar.',
                'type' => 'berita',
                'image' => 'https://images.unsplash.com/photo-1580582932707-520aed937b7b?q=80&w=800&auto=format&fit=crop',
                'created_at' => '2026-06-15 11:00:00',
            ],
            [
                'title' => 'Pelatihan Khusus Guru Pembimbing Inklusi Resmi Dibuka oleh Cabang Dinas Pendidikan Gresik',
                'slug' => 'pelatihan-guru-pembimbing-inklusi-cabdin-gresik',
                'content' => 'Guna mendukung program sekolah inklusif yang ramah anak berkebutuhan khusus, Cabang Dinas Pendidikan Wilayah Kabupaten Gresik resmi membuka workshop dan pelatihan khusus bagi ratusan guru pendamping. Pelatihan ini memfokuskan pada metode pengajaran adaptif, modifikasi kurikulum belajar, serta deteksi dini potensi dan hambatan belajar siswa berkebutuhan khusus.',
                'type' => 'berita',
                'image' => 'https://images.unsplash.com/photo-1524178232363-1fb2b075b655?q=80&w=800&auto=format&fit=crop',
                'created_at' => '2026-06-10 14:00:00',
            ],
            [
                'title' => 'Pengumuman Pengumpulan Berkas Sertifikasi Pendidik Triwulan Ke-3',
                'slug' => 'pengumuman-pengumpulan-berkas-sertifikasi-triwulan-3',
                'content' => 'Diberitahukan kepada seluruh guru PNS dan Non-PNS bersertifikasi di lingkungan Cabang Dinas Pendidikan Kabupaten Gresik untuk segera mengumpulkan berkas administrasi pencairan tunjangan profesi triwulan ke-3 tahun ini. Berkas dikumpulkan dalam bentuk softcopy melalui portal dinas dan hardcopy ke seksi Ketenagaan paling lambat akhir bulan ini.',
                'type' => 'pengumuman',
                'created_at' => '2026-08-02 08:00:00',
            ],
            // 5 Inovasi
            [
                'title' => 'Inovasi Pembelajaran Digital "Gresik Pintar" Berbasis Cloud Mulai Diterapkan di SMK Negeri se-Gresik',
                'slug' => 'inovasi-pembelajaran-digital-gresik-pintar-smk',
                'content' => 'Sebagai wujud adaptasi teknologi di era digital, Cabang Dinas Pendidikan Gresik meluncurkan inisiatif pembelajaran berbasis Cloud. Inovasi ini memungkinkan kolaborasi materi ajar antarsekolah kejuruan sehingga penyebaran kompetensi siswa menjadi lebih merata di Kabupaten Gresik.',
                'type' => 'inovasi',
                'image' => 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?q=80&w=600&auto=format&fit=crop',
                'created_at' => '2026-08-03 08:00:00',
            ],
            [
                'title' => 'Sekolah Adiwiyata Gresik Kembangkan Inovasi Eco-Brick dan Pengolahan Kompos Mandiri dari Limbah Kantin',
                'slug' => 'sekolah-adiwiyata-gresik-kembangkan-inovasi-eco-brick',
                'content' => 'Dalam rangka pelestarian lingkungan hidup, sejumlah sekolah Adiwiyata di Kabupaten Gresik memelopori pembuatan Eco-Brick dan komposter mandiri untuk mengubah limbah plastik dan sampah organik dari kantin sekolah menjadi produk guna. Inovasi ini diintegrasikan langsung ke dalam mata pelajaran IPA dan IPS.',
                'type' => 'inovasi',
                'image' => 'https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?q=80&w=600&auto=format&fit=crop',
                'created_at' => '2026-08-02 09:30:00',
            ],
            [
                'title' => 'Peluncuran Aplikasi "Si-Pinter Cabdin Gresik" untuk Memudahkan Pelayanan Mutasi Siswa secara Online',
                'slug' => 'peluncuran-aplikasi-si-pinter-cabdin-gresik-online',
                'content' => 'Guna meningkatkan akuntabilitas dan efisiensi birokrasi, Cabang Dinas Pendidikan Kabupaten Gresik meresmikan aplikasi Si-Pinter. Sistem ini mempercepat proses rekomendasi pemindahan/mutasi siswa secara online sehingga orang tua tidak perlu antre fisik di loket pelayanan.',
                'type' => 'inovasi',
                'image' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?q=80&w=600&auto=format&fit=crop',
                'created_at' => '2026-07-30 11:00:00',
            ],
            [
                'title' => 'Program SMA/SMK Double Track Gresik Berhasil Membekali Siswa dengan Keterampilan Wirausaha Mandiri',
                'slug' => 'program-sma-smk-double-track-gresik-wirausaha',
                'content' => 'Inovasi program Double Track yang digagas Cabdin Gresik berhasil mencetak ratusan wirausahawan muda dari kalangan siswa. Program ini memberikan pelatihan vokasional tambahan seperti tata boga, desain grafis, dan robotika kepada siswa SMA agar siap bekerja atau berwirausaha selepas lulus.',
                'type' => 'inovasi',
                'image' => 'https://images.unsplash.com/photo-1513258496099-48168024aec0?q=80&w=600&auto=format&fit=crop',
                'created_at' => '2026-07-27 14:00:00',
            ],
            [
                'title' => 'Penerapan Pembelajaran Sistem Hybrid dan Praktikum Virtual 3D VR di SMK Teknik Permesinan Gresik',
                'slug' => 'penerapan-pembelajaran-hybrid-praktikum-virtual-3d-vr-smk',
                'content' => 'SMK bidang teknik di Kabupaten Gresik mulai menerapkan teknologi Virtual Reality (VR) 3D untuk menunjang praktikum permesinan bubut dan las secara digital. Inovasi ini menekan risiko kecelakaan kerja praktikum sekaligus menekan biaya bahan baku material secara efisien.',
                'type' => 'inovasi',
                'image' => 'https://images.unsplash.com/photo-1581092918056-0c4c3acd3789?q=80&w=600&auto=format&fit=crop',
                'created_at' => '2026-07-24 10:15:00',
            ],
            // 5 Prestasi
            [
                'title' => 'Siswa SMA Negeri 1 Gresik Sabet Medali Emas Olimpiade Sains Nasional (OSN) 2026 Bidang Fisika',
                'slug' => 'siswa-sma-1-gresik-sabet-medali-emas-osn-2026-fisika',
                'content' => 'Prestasi membanggakan kembali diukir oleh dunia pendidikan Kabupaten Gresik. Salah satu siswa kelas XI SMA Negeri 1 Gresik berhasil meraih medali emas pada ajang bergengsi Olimpiade Sains Nasional (OSN) bidang Fisika tahun 2026 di Jakarta. Keberhasilan ini melengkapi dominasi Jawa Timur di kancah nasional.',
                'type' => 'prestasi',
                'image' => 'https://images.unsplash.com/photo-1523240795612-9a054b0db644?q=80&w=600&auto=format&fit=crop',
                'created_at' => '2026-08-04 08:00:00',
            ],
            [
                'title' => 'Tim Robotik SMKN 1 Driyorejo Gresik Juara 1 Nasional Kompetisi Robot Pintar Indonesia',
                'slug' => 'tim-robotik-smkn-1-driyorejo-juara-1-nasional-robotik',
                'content' => 'Para siswa jurusan teknik elektronika SMKN 1 Driyorejo Gresik sukses menyabet gelar Juara 1 Nasional setelah merakit robot otonom pemadam api tercepat pada Kompetisi Robot Pintar Indonesia. Robot buatan mereka dipuji dewan juri karena akurasi sensor inframerah dan kestabilan navigasi.',
                'type' => 'prestasi',
                'image' => 'https://images.unsplash.com/photo-1485827404703-89b55fcc595e?q=80&w=600&auto=format&fit=crop',
                'created_at' => '2026-08-01 10:00:00',
            ],
            [
                'title' => 'Kontingen FLS2N Kabupaten Gresik Raih Juara Umum Tingkat Provinsi Jawa Timur 2026',
                'slug' => 'kontingen-fls2n-kabupaten-gresik-juara-umum-provinsi',
                'content' => 'Kembali membawa pulang piala bergilir, kontingen Festival Lomba Seni Siswa Nasional (FLS2N) asal Kabupaten Gresik sukses dikukuhkan sebagai Juara Umum tingkat Provinsi Jawa Timur. Gelar ini diraih berkat raihan medali emas di bidang tari kreasi baru, cipta puisi, dan gitar duet.',
                'type' => 'prestasi',
                'image' => 'https://images.unsplash.com/photo-1460661419201-fd4cecdf8a8b?q=80&w=800&auto=format&fit=crop',
                'created_at' => '2026-07-29 13:30:00',
            ],
            [
                'title' => 'SMAN 1 Manyar Gresik Terpilih sebagai Sekolah Rujukan Pembelajaran Literasi Terbaik Nasional',
                'slug' => 'sman-1-manyar-gresik-sekolah-rujukan-literasi-terbaik-nasional',
                'content' => 'Kementerian Pendidikan menobatkan SMAN 1 Manyar Gresik sebagai salah satu sekolah rujukan literasi terbaik di Indonesia. Penghargaan ini diberikan atas komitmen aktif program membaca 15 menit setiap pagi, penerbitan buku antologi karya siswa-guru, serta pengelolaan perpustakaan berstandar A.',
                'type' => 'prestasi',
                'image' => 'https://images.unsplash.com/photo-1503676260728-1c00da094a0b?q=80&w=600&auto=format&fit=crop',
                'created_at' => '2026-07-26 15:45:00',
            ],
            [
                'title' => 'Siswa SLB Negeri Gresik Sukses Sabet Medali Perak Ajang Olahraga Nasional (O2SN) Disabilitas',
                'slug' => 'siswa-slb-negeri-gresik-sabet-medali-perak-o2sn-nasional',
                'content' => 'Meski memiliki keterbatasan fisik, atlet difabel asal SLB Negeri Gresik membuktikan bahwa semangat juang tak terbatas dengan memenangkan medali perak cabang olahraga atletik (lari 100m putra) tingkat nasional pada ajang O2SN disabilitas. Kepala Cabdin memberikan apresiasi khusus setibanya kontingen di Gresik.',
                'type' => 'prestasi',
                'image' => 'https://images.unsplash.com/photo-1517486808906-6ca8b3f04846?q=80&w=800&auto=format&fit=crop',
                'created_at' => '2026-07-23 09:00:00',
            ]
            ,
            // --- Sample Kegiatan (gallery) ---
            [
                'title' => 'Kegiatan Pameran Karya Siswa SD Se-Kabupaten Gresik',
                'slug' => 'pameran-karya-siswa-sd-gresik-2026',
                'content' => 'Rangkaian pameran karya siswa SD se-Kabupaten Gresik menampilkan hasil kreasi seni rupa, kerajinan tangan, dan proyek sains sederhana. Kegiatan ini melibatkan seluruh sekolah dasar untuk meningkatkan kreativitas dan apresiasi seni anak usia dini.',
                'type' => 'kegiatan',
                'image' => 'https://images.unsplash.com/photo-1503676260728-1c00da094a0b?q=80&w=800&auto=format&fit=crop',
                'created_at' => '2026-08-05 09:00:00',
            ],
            [
                'title' => 'Workshop Kreatif Guru: Metode Pengajaran Berbasis Proyek',
                'slug' => 'workshop-kreatif-guru-proyek-gresik-2026',
                'content' => 'Workshop selama dua hari bagi guru-guru di Kabupaten Gresik untuk mengembangkan metode pengajaran berbasis proyek (project-based learning). Peserta membawa serta contoh proyek siswa yang dipamerkan dalam sesi sharing.',
                'type' => 'kegiatan',
                'image' => 'https://images.unsplash.com/photo-1496307042754-b4aa456c4a2d?q=80&w=800&auto=format&fit=crop',
                'created_at' => '2026-08-03 14:00:00',
            ],
            [
                'title' => 'Jalan Sehat Bersama Komunitas Sekolah dan Masyarakat',
                'slug' => 'jalan-sehat-komunitas-sekolah-gresik-2026',
                'content' => 'Acara jalan sehat yang diikuti oleh siswa, guru, dan masyarakat setempat untuk mempromosikan gaya hidup sehat dan mempererat hubungan antar komunitas sekolah di sejumlah kecamatan.',
                'type' => 'kegiatan',
                'image' => 'https://images.unsplash.com/photo-1528901166007-378bbcb43f95?q=80&w=800&auto=format&fit=crop',
                'created_at' => '2026-08-02 07:30:00',
            ]
        ];

        foreach ($posts as $postData) {
            $created_at = $postData['created_at'] ?? null;
            unset($postData['created_at']);
            
            $post = Post::create($postData);
            if ($created_at) {
                $post->created_at = $created_at;
                $post->save();
            }
        }

        // 4. Seed Sample Services (Layanan Cabdin)
        Service::create([
            'name' => 'Rekomendasi Mutasi Siswa SMA',
            'slug' => 'rekomendasi-mutasi-siswa-sma',
            'category' => 'SMA',
            'description' => 'Pelayanan pembuatan surat rekomendasi mutasi (pindah) masuk atau keluar bagi siswa jenjang SMA antar-kabupaten/provinsi.',
            'requirements' => "1. Surat permohonan mutasi dari orang tua wali.\r\n2. Surat keterangan keluar dari sekolah asal.\r\n3. Surat keterangan bersedia menerima dari sekolah tujuan.\r\n4. Fotokopi Raport terakhir dan Akta Kelahiran.",
            'procedure' => "1. Pemohon mengajukan berkas persyaratan ke loket pelayanan Cabdin Gresik.\r\n2. Petugas melakukan verifikasi keabsahan dokumen.\r\n3. Kepala seksi memproses dan memvalidasi data.\r\n4. Surat rekomendasi ditandatangani oleh Kepala Cabang Dinas dan diserahkan ke pemohon (estimasi 1-2 hari kerja)."
        ]);

        Service::create([
            'name' => 'Izin Praktik Kerja Industri (Prakerin) SMK',
            'slug' => 'izin-prakerin-smk',
            'category' => 'SMK',
            'description' => 'Verifikasi dan pemberian surat rekomendasi izin pelaksanaan praktik kerja lapangan/industri bagi SMK di luar wilayah kabupaten.',
            'requirements' => "1. Surat permohonan dari Kepala Sekolah SMK.\r\n2. MoU / Lembar Persetujuan kerja sama dengan DUDI (Dunia Usaha Dunia Industri).\r\n3. Daftar nama siswa dan program keahlian yang akan melaksanakan prakerin.",
            'procedure' => "1. Pihak sekolah mengunggah/menyerahkan berkas usulan kerja sama prakerin.\r\n2. Seksi SMK melakukan telaah dan validasi kesesuaian kompetensi keahlian.\r\n3. Rekomendasi dikeluarkan dan dikirim ke dinas provinsi/mitra kerja."
        ]);

        Service::create([
            'name' => 'Pengajuan Izin Operasional Sekolah Baru',
            'slug' => 'pengajuan-izin-operasional-sekolah-baru',
            'category' => 'Tata Usaha',
            'description' => 'Pelayanan verifikasi lapangan dan pemberian surat rekomendasi izin operasional pendirian sekolah menengah baru (swasta).',
            'requirements' => "1. Proposal pendirian sekolah lengkap dengan studi kelayakan.\r\n2. Akta Notaris Yayasan penyelenggara.\r\n3. Sertifikat kepemilikan tanah/gedung sekolah.\r\n4. Daftar guru dan tenaga kependidikan beserta kualifikasinya.",
            'procedure' => "1. Yayasan mengajukan permohonan ke Dinas Pendidikan Provinsi melalui Cabang Dinas.\r\n2. Tim verifikator Cabdin melakukan survei lapangan untuk memeriksa fisik sekolah.\r\n3. Cabdin mengeluarkan surat rekomendasi hasil verifikasi kelayakan untuk diproses di tingkat Provinsi."
        ]);

        Service::create([
            'name' => 'Legalisir Ijazah & Piagam',
            'slug' => 'legalisir-ijazah-piagam',
            'category' => 'Tata Usaha',
            'description' => 'Pelayanan pengesahan fotokopi ijazah, STTB, surat keterangan pengganti ijazah yang hilang, atau piagam penghargaan bidang pendidikan.',
            'requirements' => "1. Ijazah/Piagam Asli.\r\n2. Fotokopi ijazah/piagam yang akan dilegalisir (maksimal 5 lembar).\r\n3. Surat Keterangan Kehilangan dari Kepolisian (jika ijazah asli hilang) disertai Surat Keterangan Pengganti Ijazah dari sekolah asal.",
            'procedure' => "1. Pemohon menyerahkan berkas dokumen asli dan fotokopi ke petugas loket.\r\n2. Petugas memeriksa kesesuaian fotokopi dengan dokumen asli.\r\n3. Penandatanganan legalisir oleh Kepala Cabang Dinas atau pejabat yang berwenang.\r\n4. Dokumen diserahkan kembali kepada pemohon."
        ]);

        // 5. Seed MKKS Contents (SMA, SMK, PK/PLK)
        MkksContent::create([
            'category' => 'SMA',
            'title' => 'Musyawarah Kerja Kepala Sekolah (MKKS) SMA Kabupaten Gresik',
            'content' => 'MKKS SMA Kabupaten Gresik merupakan wadah perkumpulan kepala sekolah menengah atas di Gresik guna berkoordinasi, berdiskusi mengenai peningkatan mutu lulusan, penyelenggaraan ujian bersama, koordinasi PPDB, serta pelaksanaan kegiatan OSIS di tingkat kabupaten.',
            'image' => null,
            'jumlah_sekolah' => 52,
            'jumlah_guru' => 1240,
            'jumlah_siswa' => 18450,
            'prestasi_unggulan' => "1. Juara 1 Olimpiade Sains Nasional (OSN) Bidang Fisika tingkat Nasional\r\n2. Medali Emas Lomba Debat Bahasa Indonesia (LDBI) tingkat Nasional\r\n3. Juara Umum Festival Lomba Seni Siswa Nasional (FLS2N) tingkat Provinsi Jawa Timur\r\n4. Juara 1 Olimpiade Penelitian Siswa Indonesia (OPSI) Bidang Sosial Humaniora tingkat Nasional"
        ]);

        MkksContent::create([
            'category' => 'SMK',
            'title' => 'Musyawarah Kerja Kepala Sekolah (MKKS) SMK Kabupaten Gresik',
            'content' => 'MKKS SMK Kabupaten Gresik berfungsi sebagai forum komunikasi kepala sekolah menengah kejuruan untuk mengembangkan kurikulum berbasis industri (link & match), penyelenggaraan Uji Kompetensi Keahlian (UKK), pameran produk inovasi siswa (LKS), serta kerja sama dengan berbagai perusahaan di Gresik.',
            'image' => null,
            'jumlah_sekolah' => 64,
            'jumlah_guru' => 1480,
            'jumlah_siswa' => 22600,
            'prestasi_unggulan' => "1. Juara 1 Lomba Kompetensi Siswa (LKS) SMK Tingkat Nasional Bidang Web Technologies\r\n2. Juara 1 Nasional Kompetisi Robot Pintar Indonesia\r\n3. Juara 2 LKS SMK Bidang Automobile Technology tingkat Nasional\r\n4. Juara 1 Lomba Karya Ilmiah Terapan SMK tingkat Nasional"
        ]);

        MkksContent::create([
            'category' => 'PK/PLK',
            'title' => 'Forum Kerja Kepala Sekolah Pendidikan Khusus (PK/PLK) Kabupaten Gresik',
            'content' => 'Wadah koordinasi bagi kepala sekolah Sekolah Luar Biasa (SLB) dan penyelenggara pendidikan inklusi di Kabupaten Gresik guna merumuskan kurikulum adaptif, pengembangan kreativitas anak berkebutuhan khusus, serta advokasi aksesibilitas pendidikan inklusif bagi seluruh lapisan masyarakat.',
            'image' => null,
            'jumlah_sekolah' => 12,
            'jumlah_guru' => 180,
            'jumlah_siswa' => 1120,
            'prestasi_unggulan' => "1. Medali Perak Lomba Keterampilan Siswa Nasional (LKSN) ABK Bidang Membatik\r\n2. Medali Perak Ajang Olahraga Nasional (O2SN) Disabilitas (Lari 100m Putra)\r\n3. Juara Harapan 1 Lomba Melukis Anak Berkebutuhan Khusus tingkat Nasional\r\n4. Juara 1 Lomba Cipta & Baca Puisi ABK tingkat Provinsi Jawa Timur"
        ]);

        $this->call(CmsSeeder::class);
        $this->call(ActivitySeeder::class);
    }
}
