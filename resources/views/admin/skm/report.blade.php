<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Laporan SKM - Cabang Dinas Pendidikan Wilayah Kabupaten Gresik</title>
<style>
  * { box-sizing: border-box; margin: 0; padding: 0; }
  body { font-family: 'Times New Roman', Times, serif; font-size: 12pt; color: #000; background: #fff; }
  .page { max-width: 210mm; margin: 0 auto; padding: 20mm 25mm; }

  /* Header */
  .kop { display: flex; align-items: center; gap: 20px; border-bottom: 3px double #000; padding-bottom: 10px; margin-bottom: 16px; }
  .kop img { width: 70px; height: 70px; object-fit: contain; }
  .kop-text { flex: 1; text-align: center; }
  .kop-text h1 { font-size: 14pt; font-weight: bold; text-transform: uppercase; line-height: 1.3; }
  .kop-text p { font-size: 10pt; margin-top: 3px; }

  /* Title */
  .report-title { text-align: center; margin: 20px 0 24px; }
  .report-title h2 { font-size: 13pt; font-weight: bold; text-decoration: underline; text-transform: uppercase; }
  .report-title p { font-size: 11pt; margin-top: 4px; }

  /* Table */
  table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
  th, td { border: 1px solid #000; padding: 6px 8px; font-size: 10.5pt; vertical-align: middle; }
  th { background: #d9d9d9; text-align: center; font-weight: bold; }
  td.center { text-align: center; }
  td.right  { text-align: right; }
  .total-row td { font-weight: bold; background: #f2f2f2; }

  /* IKM Summary */
  .ikm-box { border: 2px solid #000; padding: 14px 20px; margin-bottom: 20px; }
  .ikm-box table { border: none; margin-bottom: 0; }
  .ikm-box td { border: none; padding: 4px 10px; font-size: 11pt; }
  .ikm-value { font-size: 32pt; font-weight: bold; text-align: center; color: #000; }

  /* Info */
  .info-grid { display: grid; grid-template-columns: 160px 1fr; row-gap: 4px; margin-bottom: 20px; font-size: 11pt; }
  .info-grid span:first-child { font-weight: bold; }
  .info-grid span:first-child::after { content: ':'; margin-left: 4px; }

  /* Sign area */
  .sign-area { display: flex; justify-content: flex-end; margin-top: 30px; }
  .sign-box { text-align: center; width: 220px; }
  .sign-box p { margin-bottom: 70px; }
  .sign-box .name { font-weight: bold; border-top: 1px solid #000; padding-top: 4px; }

  /* Print */
  @media print {
    body { margin: 0; }
    .no-print { display: none !important; }
    .page { padding: 15mm 20mm; }
  }
</style>
</head>
<body>
<div class="no-print" style="background:#0b1f3f;padding:12px 24px;display:flex;gap:12px;align-items:center;justify-content:space-between;">
    <span style="color:#fff;font-family:sans-serif;font-weight:600;">Laporan SKM — Mode Pratinjau Cetak</span>
    <div style="display:flex;gap:10px;">
        <button onclick="window.print()" style="background:#0d9488;color:#fff;border:none;padding:8px 18px;border-radius:6px;font-weight:700;cursor:pointer;font-family:sans-serif;">
            🖨 Cetak / Simpan PDF
        </button>
        <a href="{{ route('admin.skm.index') }}" style="background:rgba(255,255,255,.15);color:#fff;border:none;padding:8px 18px;border-radius:6px;font-weight:700;cursor:pointer;font-family:sans-serif;text-decoration:none;">
            ← Kembali
        </a>
    </div>
</div>

<div class="page">
    {{-- KOP SURAT --}}
    <div class="kop">
        <img src="{{ asset('images/logo-jatim.svg') }}" alt="Logo Jatim" onerror="this.style.display='none'">
        <div class="kop-text">
            <h1>PEMERINTAH PROVINSI JAWA TIMUR<br>DINAS PENDIDIKAN<br>CABANG DINAS PENDIDIKAN WILAYAH KABUPATEN GRESIK</h1>
            <p>Jl. Dr. Wahidin Sudirohusodo No.229, Kembangan, Gresik, Jawa Timur 61151</p>
            <p>Telepon: (031) 39923400 | Email: cabdinkabgresik@gmail.com</p>
        </div>
    </div>

    {{-- JUDUL LAPORAN --}}
    <div class="report-title">
        <h2>Laporan Hasil Survei Kepuasan Masyarakat (SKM)</h2>
        <p>Cabang Dinas Pendidikan Wilayah Kabupaten Gresik</p>
        <p>Tahun {{ date('Y') }} &nbsp;|&nbsp; Jumlah Responden: <strong>{{ number_format($total) }}</strong></p>
    </div>

    {{-- INFORMASI UMUM --}}
    <div class="info-grid">
        <span>Unit Layanan</span><span>Cabang Dinas Pendidikan Wilayah Kabupaten Gresik</span>
        <span>Alamat</span><span>Jl. Dr. Wahidin Sudirohusodo No.229, Kembangan, Gresik</span>
        <span>Periode Survei</span><span>Tahun {{ date('Y') }}</span>
        <span>Dasar Hukum</span><span>Permenpan RB No. 14 Tahun 2017 tentang Pedoman SKM</span>
        <span>Jumlah Responden</span><span>{{ number_format($total) }} Orang</span>
        <span>Tanggal Laporan</span><span>{{ now()->isoFormat('D MMMM Y') }}</span>
    </div>

    {{-- TABEL REKAPITULASI NILAI PER UNSUR --}}
    <table>
        <thead>
            <tr>
                <th style="width:5%">No.</th>
                <th style="width:35%">Unsur Pelayanan</th>
                <th style="width:12%">Nilai Rata-rata per Unsur</th>
                <th style="width:12%">Nilai Rata-rata Tertimbang (NRR)*</th>
                <th style="width:15%">Nilai IKM per Unsur<br>(NRR × 25)</th>
                <th style="width:12%">Mutu Pelayanan</th>
            </tr>
        </thead>
        <tbody>
            @php $totalNrrAll = 0; $no = 1; @endphp
            @foreach($questions as $key => $label)
            @php
                $avg  = $stats[$key]['avg'] ?? 0;
                $nrr  = $stats[$key]['nrr'] ?? 0;
                $totalNrrAll += $nrr;
                $mutuUnsur = match(true) {
                    $nrr >= 88.31 => 'A (Sangat Baik)',
                    $nrr >= 76.61 => 'B (Baik)',
                    $nrr >= 65.00 => 'C (Cukup)',
                    default       => 'D (Kurang)',
                };
            @endphp
            <tr>
                <td class="center">{{ $no++ }}</td>
                <td>{{ $label }}</td>
                <td class="center">{{ number_format($avg, 2) }}</td>
                <td class="center">{{ number_format($avg / 8, 4) }}</td>
                <td class="center">{{ number_format($nrr, 2) }}</td>
                <td class="center">{{ $mutuUnsur }}</td>
            </tr>
            @endforeach
            <tr class="total-row">
                <td colspan="4" class="center">NILAI IKM TOTAL</td>
                <td class="center">{{ number_format($ikm, 2) }}</td>
                <td class="center">{{ $mutu }} – {{ $kinerja }}</td>
            </tr>
        </tbody>
    </table>
    <p style="font-size:9.5pt;color:#555;margin-bottom:20px;">* NRR = Nilai Rata-rata Tertimbang = Nilai Rata-rata per Unsur ÷ 8 (jumlah unsur). Nilai IKM per Unsur = NRR × 25.</p>

    {{-- TABEL DISTRIBUSI JAWABAN --}}
    <h3 style="font-size:12pt;font-weight:bold;margin-bottom:10px;">Distribusi Jawaban Responden per Unsur</h3>
    <table>
        <thead>
            <tr>
                <th rowspan="2">No.</th>
                <th rowspan="2">Unsur Pelayanan</th>
                <th colspan="4">Jumlah Jawaban per Skala</th>
                <th rowspan="2">Total Resp.</th>
            </tr>
            <tr>
                <th>Nilai 1<br>(Tidak Baik)</th>
                <th>Nilai 2<br>(Kurang Baik)</th>
                <th>Nilai 3<br>(Baik)</th>
                <th>Nilai 4<br>(Sangat Baik)</th>
            </tr>
        </thead>
        <tbody>
            @php $no2 = 1; @endphp
            @foreach($questions as $key => $label)
            <tr>
                <td class="center">{{ $no2++ }}</td>
                <td>{{ $label }}</td>
                @for($v = 1; $v <= 4; $v++)
                    <td class="center">{{ $responseDist[$key][$v] ?? 0 }}</td>
                @endfor
                <td class="center">{{ $total }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- KESIMPULAN IKM --}}
    <div class="ikm-box">
        <table>
            <tr>
                <td style="width:60%;font-size:11pt;">
                    <strong>Kesimpulan Hasil Survei:</strong><br><br>
                    Berdasarkan survei yang dilakukan terhadap <strong>{{ number_format($total) }}</strong> responden,
                    Cabang Dinas Pendidikan Wilayah Kabupaten Gresik memperoleh nilai IKM sebesar
                    <strong>{{ number_format($ikm, 2) }}</strong> dengan Mutu Pelayanan <strong>{{ $mutu }}</strong> ({{ $kinerja }}).
                    <br><br>
                    Nilai ini menunjukkan bahwa kualitas pelayanan Cabdin Gresik berada pada kategori
                    <strong>{{ $kinerja }}</strong> menurut Permenpan RB No. 14 Tahun 2017.
                </td>
                <td style="text-align:center;vertical-align:middle;">
                    <div class="ikm-value">{{ number_format($ikm, 2) }}</div>
                    <p style="font-size:14pt;font-weight:bold;margin-top:6px;">Mutu: {{ $mutu }}</p>
                    <p style="font-size:11pt;">{{ $kinerja }}</p>
                </td>
            </tr>
        </table>
    </div>

    {{-- TANDA TANGAN --}}
    <div class="sign-area">
        <div class="sign-box">
            <p>Gresik, {{ now()->isoFormat('D MMMM Y') }}<br>Kepala Cabang Dinas Pendidikan<br>Wilayah Kabupaten Gresik</p>
            <div class="name">__________________________<br>NIP. ___________________</div>
        </div>
    </div>

    <div style="margin-top:40px;border-top:1px solid #ccc;padding-top:10px;font-size:9pt;color:#888;text-align:center;">
        Laporan ini dicetak secara otomatis dari Sistem Informasi CMS Cabdin Gresik pada {{ now()->format('d/m/Y H:i') }} WIB.
        Berdasarkan PermenPANRB No. 14 Tahun 2017 tentang Pedoman Penyusunan Survei Kepuasan Masyarakat.
    </div>
</div>
</body>
</html>
