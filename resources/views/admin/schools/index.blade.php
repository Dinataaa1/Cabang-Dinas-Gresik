@extends('layouts.admin')

@section('title', 'Kelola Data Sekolah - Cabdin Gresik')

@section('content')

<div class="pf-header">
    <div class="pf-header-icon"><i class="bi bi-bank"></i></div>
    <div>
        <h2 class="pf-header-title">Data Sekolah Kabupaten Gresik</h2>
        <p class="pf-header-sub">Kelola daftar sekolah, data guru, siswa, dan jumlah prestasi per kategori jenjang.</p>
    </div>
</div>

{{-- Category Tab --}}
<div style="display: flex; gap: 6px; margin-bottom: 20px; flex-wrap: wrap;">
    @foreach($categories as $cat)
        <a href="{{ route('admin.schools.index', ['category' => $cat]) }}"
           style="padding: 9px 20px; border-radius: 30px; font-size: 13px; font-weight: 700; text-decoration: none; border: 1.5px solid {{ $category == $cat ? '#0b1f3f' : 'var(--border)' }}; background: {{ $category == $cat ? '#0b1f3f' : '#fff' }}; color: {{ $category == $cat ? '#fff' : '#475569' }}; transition: all .2s;">
            {{ $cat }}
        </a>
    @endforeach
</div>

{{-- Summary Stats --}}
<div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 14px; margin-bottom: 24px;">
    @php $statCards = [['label' => 'Total Sekolah', 'value' => $totals->total_sekolah ?? 0, 'icon' => 'bi-bank'], ['label' => 'Total Guru', 'value' => number_format($totals->total_guru ?? 0), 'icon' => 'bi-people-fill'], ['label' => 'Total Siswa', 'value' => number_format($totals->total_siswa ?? 0), 'icon' => 'bi-mortarboard-fill'], ['label' => 'Total Prestasi', 'value' => number_format($totals->total_prestasi ?? 0), 'icon' => 'bi-trophy-fill']]; @endphp
    @foreach($statCards as $s)
        <div style="background: #fff; border: 1px solid var(--border); border-radius: 14px; padding: 16px 18px; border-bottom: 3px solid #0b1f3f;">
            <div style="font-size: 22px; color: #0b1f3f; margin-bottom: 8px;"><i class="bi {{ $s['icon'] }}"></i></div>
            <div style="font-size: 22px; font-weight: 900; color: #0b1f3f;">{{ $s['value'] }}</div>
            <div style="font-size: 10px; font-weight: 700; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.5px; margin-top: 3px;">{{ $s['label'] }}</div>
        </div>
    @endforeach
</div>

{{-- Actions --}}
<div style="display: flex; justify-content: flex-end; margin-bottom: 16px;">
    <a href="{{ route('admin.schools.create', ['category' => $category]) }}" class="pf-btn-save" style="text-decoration: none; display: inline-flex; align-items: center; gap: 8px;">
        <i class="bi bi-plus-circle"></i> Tambah Sekolah {{ $category }}
    </a>
</div>

{{-- Table --}}
<div class="pf-card" style="padding: 0; overflow: hidden;">
    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="background: #f8fafc; border-bottom: 2px solid #e2e8f0;">
                <th style="padding: 12px 16px; text-align: left; font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase; width: 36px;">#</th>
                <th style="padding: 12px 16px; text-align: left; font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase;">Nama Sekolah</th>
                <th style="padding: 12px 16px; text-align: left; font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase; width: 80px;">NPSN</th>
                <th style="padding: 12px 16px; text-align: left; font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase; width: 80px;">Status</th>
                <th style="padding: 12px 16px; text-align: center; font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase; width: 70px;">Guru</th>
                <th style="padding: 12px 16px; text-align: center; font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase; width: 70px;">Tendik</th>
                <th style="padding: 12px 16px; text-align: center; font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase; width: 80px;">Siswa</th>
                <th style="padding: 12px 16px; text-align: center; font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase; width: 80px;">Prestasi</th>
                <th style="padding: 12px 16px; text-align: center; font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase; width: 150px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($schools as $i => $school)
                <tr style="border-bottom: 1px solid #f1f5f9;" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background=''">
                    <td style="padding: 12px 16px; font-size: 12px; color: #94a3b8;">{{ $schools->firstItem() + $i }}</td>
                    <td style="padding: 12px 16px;">
                        <div style="font-size: 13.5px; font-weight: 700; color: #0b1f3f;">{{ $school->name }}</div>
                        @if($school->address)
                            <div style="font-size: 11px; color: #94a3b8; margin-top: 2px;"><i class="bi bi-geo-alt"></i> {{ Str::limit($school->address, 50) }}</div>
                        @endif
                    </td>
                    <td style="padding: 12px 16px; font-size: 12px; color: #475569; font-family: monospace;">{{ $school->npsn ?? '-' }}</td>
                    <td style="padding: 12px 16px;">
                        <span style="padding: 3px 10px; border-radius: 20px; font-size: 11px; font-weight: 700; background: {{ $school->status == 'Negeri' ? '#eff6ff' : '#f5f3ff' }}; color: {{ $school->status == 'Negeri' ? '#1d4ed8' : '#7c3aed' }};">
                            {{ $school->status }}
                        </span>
                    </td>
                    <td style="padding: 12px 16px; text-align: center; font-size: 13px; font-weight: 700; color: #0b1f3f;">{{ number_format($school->jumlah_guru) }}</td>
                    <td style="padding: 12px 16px; text-align: center; font-size: 13px; font-weight: 700; color: #0b1f3f;">{{ number_format($school->jumlah_tendik) }}</td>
                    <td style="padding: 12px 16px; text-align: center; font-size: 13px; font-weight: 700; color: #0b1f3f;">{{ number_format($school->jumlah_siswa) }}</td>
                    <td style="padding: 12px 16px; text-align: center;">
                        <span style="background: #fef3c7; color: #d97706; padding: 3px 10px; border-radius: 20px; font-size: 12px; font-weight: 700;">
                            <i class="bi bi-trophy-fill" style="font-size: 10px;"></i> {{ $school->jumlah_prestasi }}
                        </span>
                    </td>
                    <td style="padding: 12px 16px; text-align: center;">
                        <div style="display: flex; justify-content: center; gap: 6px;">
                            <a href="{{ route('admin.schools.edit', $school) }}" style="padding: 5px 10px; background: #fff8e6; border-radius: 7px; font-size: 12px; font-weight: 600; color: #d97706; text-decoration: none; display: inline-flex; align-items: center; gap: 4px;">
                                <i class="bi bi-pencil"></i> Edit
                            </a>
                            <form action="{{ route('admin.schools.destroy', $school) }}" method="POST" onsubmit="return confirm('Hapus sekolah ini?');" style="margin: 0;">
                                @csrf @method('DELETE')
                                <button type="submit" style="padding: 5px 10px; background: #fee2e2; border: none; border-radius: 7px; font-size: 12px; font-weight: 600; color: #dc2626; cursor: pointer; display: inline-flex; align-items: center; gap: 4px;">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" style="text-align: center; padding: 40px; color: #94a3b8;">
                        <i class="bi bi-bank" style="font-size: 32px; display: block; margin-bottom: 10px; opacity: .4;"></i>
                        Belum ada data sekolah untuk kategori {{ $category }}.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
    @if($schools->hasPages())
        <div style="padding: 14px 16px; border-top: 1px solid #e2e8f0;">
            {{ $schools->appends(['category' => $category])->links() }}
        </div>
    @endif
</div>

@endsection
