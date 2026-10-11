<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Slider;
use App\Models\Download;
use App\Models\SkmResponse;
use Illuminate\Support\Facades\Storage;

class CmsSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Seed Default Banners/Sliders
        Slider::create([
            'title' => 'Portal Resmi Cabang Dinas Pendidikan Wilayah Kabupaten Gresik',
            'excerpt' => 'Menyajikan informasi pelayanan publik, berita sekolah, serta program kerja SMA, SMK, dan Pendidikan Khusus di Wilayah Gresik.',
            'image' => null,
            'link_url' => null,
            'order' => 0,
            'is_active' => true,
        ]);

        Slider::create([
            'title' => 'Akselerasi Mutu Pendidikan Menengah & Khusus',
            'excerpt' => 'Berkomitmen memberikan pelayanan prima, transparan, dan akuntabel demi mencetak generasi unggul yang berkarakter Jawa Timur.',
            'image' => null,
            'link_url' => null,
            'order' => 1,
            'is_active' => true,
        ]);

        // 2. Seed Default SKM Template File
        // We will create the actual template file in storage
        $templateTitle = 'Format Laporan SKM Cabdin Pendidikan (Permenpan RB No. 14 Tahun 2017)';
        $templateName = 'format_skm_cabdin_permenpan.doc';
        $templatePath = 'downloads/' . $templateName;

        // Ensure directories exist
        Storage::disk('public')->makeDirectory('downloads');

        // Create the DOC template content in HTML format (MS Word compatible)
        $docContent = $this->getSkmDocTemplate();
        Storage::disk('public')->put($templatePath, $docContent);

        Download::create([
            'title' => $templateTitle,
            'category' => 'SKM',
            'description' => 'Format resmi dokumen laporan Survei Kepuasan Masyarakat (SKM) Cabang Dinas Pendidikan sesuai aturan ASN Permenpan RB No. 14 Tahun 2017.',
            'file_path' => $templatePath,
            'file_name' => $templateName,
            'file_size' => '25 KB',
        ]);

        // 3. Seed Realistic SKM Survey Data (25 respondents)
        // Values from 1 to 4 (representing: Tidak Baik, Kurang Baik, Baik, Sangat Baik)
        $samples = [
            ['q1'=>4,'q2'=>3,'q3'=>4,'q4'=>4,'q5'=>3,'q6'=>4,'q7'=>4,'q8'=>3,'saran'=>'Pelayanan mutasi siswa sangat cepat, terima kasih Cabdin Gresik.'],
            ['q1'=>3,'q2'=>3,'q3'=>3,'q4'=>4,'q5'=>3,'q6'=>3,'q7'=>4,'q8'=>3,'saran'=>'Sarana ruang tunggu mohon ditambahkan AC agar lebih nyaman.'],
            ['q1'=>4,'q2'=>4,'q3'=>4,'q4'=>4,'q5'=>4,'q6'=>4,'q7'=>4,'q8'=>4,'saran'=>'Sangat puas dengan keramahan petugas loket.'],
            ['q1'=>3,'q2'=>3,'q3'=>2,'q4'=>4,'q5'=>3,'q6'=>3,'q7'=>3,'q8'=>2,'saran'=>'Proses legalisir ijazah agak antre di loket saat jam siang.'],
            ['q1'=>4,'q2'=>3,'q3'=>3,'q4'=>4,'q5'=>4,'q6'=>4,'q7'=>4,'q8'=>3,'saran'=>'Sistem online Si-Pinter sangat mempermudah pengurusan.'],
            ['q1'=>3,'q2'=>4,'q3'=>4,'q4'=>4,'q5'=>3,'q6'=>4,'q7'=>3,'q8'=>3,'saran'=>''],
            ['q1'=>4,'q2'=>4,'q3'=>3,'q4'=>4,'q5'=>4,'q6'=>4,'q7'=>4,'q8'=>4,'saran'=>'Pertahankan kualitas pelayanan prima ini.'],
            ['q1'=>3,'q2'=>3,'q3'=>3,'q4'=>4,'q5'=>3,'q6'=>3,'q7'=>3,'q8'=>3,'saran'=>''],
            ['q1'=>4,'q2'=>4,'q3'=>4,'q4'=>4,'q5'=>4,'q6'=>4,'q7'=>4,'q8'=>3,'saran'=>'Petugas memberikan informasi dengan sangat jelas.'],
            ['q1'=>2,'q2'=>3,'q3'=>2,'q4'=>4,'q5'=>3,'q6'=>3,'q7'=>3,'q8'=>2,'saran'=>'Parkir kendaraan roda empat mohon diperluas.'],
            ['q1'=>4,'q2'=>3,'q3'=>4,'q4'=>4,'q5'=>4,'q6'=>4,'q7'=>4,'q8'=>3,'saran'=>'Bagus sekali.'],
            ['q1'=>3,'q2'=>3,'q3'=>3,'q4'=>4,'q5'=>3,'q6'=>3,'q7'=>4,'q8'=>3,'saran'=>''],
            ['q1'=>4,'q2'=>4,'q3'=>4,'q4'=>4,'q5'=>4,'q6'=>4,'q7'=>4,'q8'=>4,'saran'=>'Sangat baik dan tidak ada pungutan biaya sama sekali.'],
            ['q1'=>3,'q2'=>2,'q3'=>3,'q4'=>4,'q5'=>3,'q6'=>3,'q7'=>3,'q8'=>3,'saran'=>''],
            ['q1'=>4,'q2'=>4,'q3'=>3,'q4'=>4,'q5'=>4,'q6'=>4,'q7'=>4,'q8'=>3,'saran'=>''],
            ['q1'=>3,'q2'=>3,'q3'=>4,'q4'=>4,'q5'=>3,'q6'=>4,'q7'=>4,'q8'=>4,'saran'=>'Respon tanggap dari seksi ketenagaan luar biasa.'],
            ['q1'=>4,'q2'=>4,'q3'=>4,'q4'=>4,'q5'=>4,'q6'=>4,'q7'=>4,'q8'=>4,'saran'=>''],
            ['q1'=>3,'q2'=>3,'q3'=>3,'q4'=>4,'q5'=>3,'q6'=>3,'q7'=>3,'q8'=>3,'saran'=>''],
            ['q1'=>4,'q2'=>3,'q3'=>4,'q4'=>4,'q5'=>4,'q6'=>4,'q7'=>4,'q8'=>3,'saran'=>''],
            ['q1'=>4,'q2'=>4,'q3'=>4,'q4'=>4,'q5'=>4,'q6'=>4,'q7'=>4,'q8'=>4,'saran'=>'Terima kasih atas pelayanannya.'],
        ];

        foreach ($samples as $sample) {
            SkmResponse::create($sample);
        }
    }

    private function getSkmDocTemplate(): string
    {
        return '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:w="urn:schemas-microsoft-com:office:word" xmlns="http://www.w3.org/TR/REC-html40">
<head>
<meta charset="utf-8">
<title>Format Laporan SKM Permenpan RB 14/2017</title>
<style>
  body { font-family: "Times New Roman", serif; font-size: 12pt; line-height: 1.5; color: #000; }
  h1 { font-size: 14pt; text-align: center; text-transform: uppercase; font-weight: bold; }
  h2 { font-size: 12pt; text-align: center; text-transform: uppercase; font-weight: bold; margin-top: 10px; }
  p { text-align: justify; margin-bottom: 8px; }
  table { width: 100%; border-collapse: collapse; margin: 15px 0; }
  th, td { border: 1px solid #000; padding: 6px 8px; font-size: 11pt; vertical-align: top; }
  th { background-color: #d9d9d9; text-align: center; font-weight: bold; }
  .center { text-align: center; }
  .bold { font-weight: bold; }
</style>
</head>
<body>
<h1>LAPORAN SURVEI KEPUASAN MASYARAKAT (SKM)<br>PADA CABANG DINAS PENDIDIKAN WILAYAH KABUPATEN GRESIK</h1>
<h2>PERIODE TAHUN 2026</h2>

<hr size="3" color="black">
<br>

<h3>I. LATAR BELAKANG</h3>
<p>Berdasarkan Peraturan Menteri Pendayagunaan Aparatur Negara dan Reformasi Birokrasi (PANRB) Nomor 14 Tahun 2017 tentang Pedoman Penyusunan Survei Kepuasan Masyarakat Unit Penyelenggara Pelayanan Publik, setiap instansi pemerintah diwajibkan untuk melakukan Survei Kepuasan Masyarakat (SKM) secara berkala guna mengukur tingkat kepuasan masyarakat penerima pelayanan.</p>

<h3>II. MAKSUD DAN TUJUAN</h3>
<p>Maksud pelaksanaan SKM adalah untuk mengetahui tingkat kinerja pelayanan secara berkala sebagai bahan evaluasi kebijakan pelayanan. Adapun tujuannya adalah mengetahui kelemahan atau kekuatan dari masing-masing unsur pelayanan, mengukur secara berkala kualitas pelayanan, dan menetapkan Indeks Kepuasan Masyarakat (IKM) unit pelayanan.</p>

<h3>III. REKAPITULASI INDEKS KEPUASAN MASYARAKAT (IKM)</h3>
<p>Berdasarkan pengolahan data kuesioner terhadap responden penerima layanan Cabang Dinas Pendidikan Wilayah Kabupaten Gresik, diperoleh rekapitulasi nilai per unsur sebagai berikut:</p>

<table>
  <thead>
    <tr>
      <th style="width: 8%">No.</th>
      <th>Unsur Pelayanan (Permenpan RB No. 14/2017)</th>
      <th style="width: 15%">Nilai Rata-rata</th>
      <th style="width: 15%">Nilai Konversi (x25)</th>
      <th style="width: 20%">Kategori Mutu</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td class="center">1</td>
      <td>Persyaratan Pelayanan (U1)</td>
      <td class="center">[Isi Nilai]</td>
      <td class="center">[Isi Konversi]</td>
      <td class="center">[Sangat Baik / Baik]</td>
    </tr>
    <tr>
      <td class="center">2</td>
      <td>Prosedur Pelayanan (U2)</td>
      <td class="center">[Isi Nilai]</td>
      <td class="center">[Isi Konversi]</td>
      <td class="center">[Sangat Baik / Baik]</td>
    </tr>
    <tr>
      <td class="center">3</td>
      <td>Waktu Pelayanan (U3)</td>
      <td class="center">[Isi Nilai]</td>
      <td class="center">[Isi Konversi]</td>
      <td class="center">[Sangat Baik / Baik]</td>
    </tr>
    <tr>
      <td class="center">4</td>
      <td>Biaya / Tarif (U4)</td>
      <td class="center">[Isi Nilai]</td>
      <td class="center">[Isi Konversi]</td>
      <td class="center">[Sangat Baik / Baik]</td>
    </tr>
    <tr>
      <td class="center">5</td>
      <td>Produk Spesifikasi Jenis Pelayanan (U5)</td>
      <td class="center">[Isi Nilai]</td>
      <td class="center">[Isi Konversi]</td>
      <td class="center">[Sangat Baik / Baik]</td>
    </tr>
    <tr>
      <td class="center">6</td>
      <td>Kompetensi Pelaksana (U6)</td>
      <td class="center">[Isi Nilai]</td>
      <td class="center">[Isi Konversi]</td>
      <td class="center">[Sangat Baik / Baik]</td>
    </tr>
    <tr>
      <td class="center">7</td>
      <td>Perilaku Pelaksana (U7)</td>
      <td class="center">[Isi Nilai]</td>
      <td class="center">[Isi Konversi]</td>
      <td class="center">[Sangat Baik / Baik]</td>
    </tr>
    <tr>
      <td class="center">8</td>
      <td>Sarana dan Prasarana (U8)</td>
      <td class="center">[Isi Nilai]</td>
      <td class="center">[Isi Konversi]</td>
      <td class="center">[Sangat Baik / Baik]</td>
    </tr>
    <tr class="bold" style="background-color: #f2f2f2;">
      <td colspan="2" class="center">NILAI INDEKS KEPUASAN MASYARAKAT (IKM) TOTAL</td>
      <td class="center">[Rata-rata]</td>
      <td class="center">[Nilai IKM]</td>
      <td class="center">[Mutu IKM]</td>
    </tr>
  </tbody>
</table>

<h3>IV. ANALISIS DAN TINDAK LANJUT</h3>
<p>Berdasarkan rekapitulasi di atas, unsur pelayanan dengan nilai terendah adalah [Nama Unsur], yang disebabkan oleh [Analisis Masalah]. Langkah tindak lanjut yang akan dilakukan adalah [Langkah Tindak Lanjut]. Sedangkan unsur dengan nilai tertinggi adalah [Nama Unsur] yang akan terus dipertahankan kualitasnya.</p>

<br><br>
<table style="border: none;">
  <tr style="border: none;">
    <td style="border: none; width: 60%;"></td>
    <td style="border: none; text-align: center;">
      Gresik, [Tanggal Laporan]<br>
      Kepala Cabang Dinas Pendidikan<br>
      Wilayah Kabupaten Gresik<br><br><br><br><br>
      <b><u>[Nama Kepala Dinas]</u></b><br>
      NIP. [NIP Kepala Dinas]
    </td>
  </tr>
</table>
</body>
</html>';
    }
}
