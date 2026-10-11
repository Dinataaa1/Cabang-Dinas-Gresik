@extends('layouts.admin')
@section('title', 'Hasil Survei SKM - Cabdin Gresik')
@section('content')

<div class="pf-header">
    <div class="pf-header-icon"><i class="bi bi-clipboard2-check"></i></div>
    <div>
        <h2 class="pf-header-title">Hasil Survei Kepuasan Masyarakat (SKM)</h2>
        <p class="pf-header-sub">Rekapitulasi nilai IKM berdasarkan Permenpan RB No. 14 Tahun 2017.</p>
    </div>
</div>

{{-- IKM Score Card --}}
<div style="display:grid;grid-template-columns:1fr 3fr;gap:20px;margin-bottom:28px;">
    {{-- Nilai IKM --}}
    <div class="pf-card" style="text-align:center;padding:30px 20px;background:linear-gradient(135deg,#0b1f3f,#1e3a5f);">
        <p style="font-size:12px;font-weight:700;color:rgba(255,255,255,.5);text-transform:uppercase;letter-spacing:1px;margin:0 0 8px;">Nilai IKM</p>
        <div style="font-size:60px;font-weight:900;color:{{ $ikm >= 88.31 ? '#10b981' : ($ikm >= 76.61 ? '#3b82f6' : ($ikm >= 65 ? '#f59e0b' : '#ef4444')) }};line-height:1;">
            {{ number_format($ikm, 2) }}
        </div>
        <div style="font-size:24px;font-weight:800;color:#ffffff;margin:8px 0 4px;">Mutu: {{ $mutu }}</div>
        <div style="font-size:14px;color:rgba(255,255,255,.7);">{{ $kinerja }}</div>
        <div style="margin-top:20px;padding-top:16px;border-top:1px solid rgba(255,255,255,.1);font-size:12px;color:rgba(255,255,255,.5);">
            Berdasarkan <strong style="color:rgba(255,255,255,.8);">{{ number_format($total) }}</strong> responden
        </div>
        @if($total > 0)
        <a href="{{ route('admin.skm.report') }}" target="_blank" style="display:inline-flex;align-items:center;gap:6px;margin-top:16px;padding:8px 16px;background:#0d9488;color:white;border-radius:8px;font-size:12px;font-weight:700;text-decoration:none;">
            <i class="bi bi-printer"></i> Cetak Laporan
        </a>
        @endif
    </div>

    {{-- Nilai per Unsur --}}
    <div class="pf-card" style="padding:24px;">
        <h3 style="font-size:14px;font-weight:700;color:#0b1f3f;margin:0 0 18px;">Nilai Per Unsur Pelayanan</h3>
        @if($total > 0)
            @foreach($questions as $key => $label)
            @php $nrr = $stats[$key]['nrr'] ?? 0; $pct = ($nrr / 100) * 100; @endphp
            <div style="margin-bottom:14px;">
                <div style="display:flex;justify-content:space-between;margin-bottom:5px;">
                    <span style="font-size:12px;font-weight:600;color:#374151;">{{ $label }}</span>
                    <span style="font-size:12px;font-weight:700;color:{{ $nrr >= 88.31 ? '#10b981' : ($nrr >= 76.61 ? '#3b82f6' : '#f59e0b') }};">{{ number_format($nrr, 2) }}</span>
                </div>
                <div style="background:#f1f5f9;border-radius:20px;height:8px;overflow:hidden;">
                    <div style="width:{{ min($pct, 100) }}%;height:100%;background:{{ $nrr >= 88.31 ? '#10b981' : ($nrr >= 76.61 ? '#3b82f6' : '#f59e0b') }};border-radius:20px;transition:width .5s ease;"></div>
                </div>
            </div>
            @endforeach
        @else
            <div style="text-align:center;padding:30px;color:#94a3b8;">
                <i class="bi bi-bar-chart" style="font-size:36px;display:block;margin-bottom:10px;"></i>
                <p>Belum ada data survei yang masuk.</p>
            </div>
        @endif
    </div>
</div>

{{-- Skala Nilai Referensi --}}
<div class="pf-card" style="margin-bottom:28px;">
    <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:0;border-radius:var(--radius-md);overflow:hidden;border:1px solid #e2e8f0;">
        @foreach([['D','Kurang','25.00 – 64.99','#ef4444'],['C','Cukup','65.00 – 76.60','#f59e0b'],['B','Baik','76.61 – 88.30','#3b82f6'],['A','Sangat Baik','88.31 – 100.00','#10b981']] as $row)
        <div style="padding:16px;text-align:center;border-right:1px solid #e2e8f0;{{ $loop->last ? 'border-right:none;' : '' }}background:{{ $mutu==$row[0] ? '#f0fdf4' : '#ffffff' }}">
            <div style="font-size:28px;font-weight:900;color:{{ $row[3] }};">{{ $row[0] }}</div>
            <div style="font-size:13px;font-weight:700;color:#374151;">{{ $row[1] }}</div>
            <div style="font-size:11px;color:#94a3b8;">{{ $row[2] }}</div>
        </div>
        @endforeach
    </div>
</div>

{{-- Saran & Masukan --}}
@if($saranList->isNotEmpty())
<div class="pf-card" style="margin-bottom:28px;">
    <div class="pf-card-header">
        <span class="pf-badge"><i class="bi bi-chat-left-text"></i></span>
        <div>
            <h3 class="pf-section-title">Saran & Masukan Terbaru</h3>
        </div>
    </div>
    <div class="pf-card-body" style="display:flex;flex-direction:column;gap:12px;">
        @foreach($saranList as $s)
        <div style="background:#f8fafc;border-radius:10px;padding:14px 16px;border-left:3px solid #0d9488;">
            <div style="display:flex;align-items:center;gap:10px;margin-bottom:8px;flex-wrap:wrap;">
                @if($s->nama)
                    <span style="font-size:12px;font-weight:700;color:#0b1f3f;"><i class="bi bi-person-fill" style="color:#0d9488;"></i> {{ $s->nama }}</span>
                @endif
                @if($s->jenis_kelamin)
                    <span style="font-size:11px;background:{{ $s->jenis_kelamin=='Laki-laki'?'#dbeafe':'#fce7f3' }};color:{{ $s->jenis_kelamin=='Laki-laki'?'#1d4ed8':'#db2777' }};padding:2px 8px;border-radius:20px;font-weight:600;">{{ $s->jenis_kelamin }}</span>
                @endif
                @if($s->pekerjaan)
                    <span style="font-size:11px;color:#64748b;"><i class="bi bi-briefcase-fill"></i> {{ $s->pekerjaan }}</span>
                @endif
                @if($s->layanan_diterima)
                    <span style="font-size:11px;background:#eff6ff;color:#1d4ed8;padding:2px 8px;border-radius:20px;font-weight:600;"><i class="bi bi-card-checklist"></i> {{ $s->layanan_diterima }}</span>
                @endif
            </div>
            <p style="font-size:13px;color:#374151;margin:0 0 6px;line-height:1.6;">{{ $s->saran }}</p>
            <span style="font-size:11px;color:#94a3b8;"><i class="bi bi-clock"></i> {{ $s->created_at->diffForHumans() }}</span>
        </div>
        @endforeach
    </div>
</div>
@endif

{{-- Tabel Responden --}}
<div class="pf-card">
    <div class="pf-card-header">
        <span class="pf-badge"><i class="bi bi-table"></i></span>
        <div>
            <h3 class="pf-section-title">Data Responden ({{ $total }} total)</h3>
        </div>
    </div>
    <div class="pf-card-body" style="padding:0;overflow-x:auto;">
        @if($responses->isEmpty())
            <div style="text-align:center;padding:40px;color:#94a3b8;">Belum ada data.</div>
        @else
        <table style="width:100%;border-collapse:collapse;min-width:1200px;">
            <thead>
                <tr style="background:#f8fafc;border-bottom:2px solid #e2e8f0;">
                    <th style="padding:11px 12px;text-align:left;font-size:10.5px;font-weight:700;color:#64748b;text-transform:uppercase;">#</th>
                    <th style="padding:11px 12px;text-align:left;font-size:10.5px;font-weight:700;color:#64748b;text-transform:uppercase;">Nama &amp; Identitas</th>
                    <th style="padding:11px 12px;text-align:left;font-size:10.5px;font-weight:700;color:#64748b;text-transform:uppercase;">Pekerjaan</th>
                    <th style="padding:11px 12px;text-align:left;font-size:10.5px;font-weight:700;color:#64748b;text-transform:uppercase;">Layanan Diterima</th>
                    <th style="padding:11px 12px;text-align:center;font-size:10.5px;font-weight:700;color:#64748b;text-transform:uppercase;">Tgl Pelayanan</th>
                    @foreach(['Q1','Q2','Q3','Q4','Q5','Q6','Q7','Q8'] as $q)
                        <th style="padding:11px 9px;text-align:center;font-size:10.5px;font-weight:700;color:#64748b;text-transform:uppercase;">{{ $q }}</th>
                    @endforeach
                    <th style="padding:11px 12px;text-align:center;font-size:10.5px;font-weight:700;color:#64748b;text-transform:uppercase;">IKM</th>
                    <th style="padding:11px 12px;text-align:center;font-size:10.5px;font-weight:700;color:#64748b;text-transform:uppercase;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($responses as $i => $r)
                @php $ikm_r = round(($r->q1+$r->q2+$r->q3+$r->q4+$r->q5+$r->q6+$r->q7+$r->q8) / 8 * 25, 2); @endphp
                <tr style="border-bottom:1px solid #f1f5f9;" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background=''">
                    <td style="padding:11px 12px;font-size:12px;color:#94a3b8;">{{ $responses->firstItem() + $i }}</td>
                    <td style="padding:11px 12px;">
                        <div style="font-size:13px;font-weight:700;color:#0b1f3f;">{{ $r->nama ?? '–' }}</div>
                        <div style="font-size:11px;color:#64748b;margin-top:3px;display:flex;gap:6px;flex-wrap:wrap;align-items:center;">
                            @if($r->jenis_kelamin)
                                <span style="background:{{ $r->jenis_kelamin=='Laki-laki'?'#dbeafe':'#fce7f3' }};color:{{ $r->jenis_kelamin=='Laki-laki'?'#1d4ed8':'#db2777' }};padding:1px 7px;border-radius:20px;font-weight:700;font-size:10px;">{{ $r->jenis_kelamin }}</span>
                            @endif
                            @if($r->usia) <span>{{ $r->usia }} thn</span> @endif
                            @if($r->pendidikan) <span style="color:#94a3b8;">· {{ $r->pendidikan }}</span> @endif
                        </div>
                    </td>
                    <td style="padding:11px 12px;font-size:12px;color:#374151;">{{ $r->pekerjaan ?? '–' }}</td>
                    <td style="padding:11px 12px;">
                        <div style="font-size:12px;color:#0b1f3f;font-weight:600;line-height:1.4;">{{ $r->layanan_diterima ?? '–' }}</div>
                    </td>
                    <td style="padding:11px 12px;text-align:center;font-size:11.5px;color:#64748b;">
                        {{ $r->tanggal_pelayanan ? $r->tanggal_pelayanan->format('d M Y') : '–' }}
                    </td>
                    @foreach(['q1','q2','q3','q4','q5','q6','q7','q8'] as $q)
                    @php $val = $r->$q; $bg = match($val) { 4=>'#bbf7d0', 3=>'#bfdbfe', 2=>'#fde68a', default=>'#fecaca' }; @endphp
                    <td style="padding:11px 9px;text-align:center;"><span style="background:{{ $bg }};padding:3px 7px;border-radius:6px;font-size:12px;font-weight:700;">{{ $val }}</span></td>
                    @endforeach
                    <td style="padding:11px 12px;text-align:center;font-size:13px;font-weight:700;color:#0b1f3f;">{{ $ikm_r }}</td>
                    <td style="padding:11px 12px;text-align:center;">
                        <form action="{{ route('admin.skm.destroy', $r) }}" method="POST" onsubmit="return confirm('Hapus data responden ini?');">
                            @csrf @method('DELETE')
                            <button type="submit" style="background:#fee2e2;border:none;padding:5px 10px;border-radius:6px;font-size:11px;color:#dc2626;cursor:pointer;"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div style="padding:16px 18px;">{{ $responses->links() }}</div>
        @endif
    </div>
</div>

@endsection
