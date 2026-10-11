@extends('layouts.admin')
@section('title', 'Kelola Agenda / Acara - Cabdin Gresik')
@section('content')

<div class="pf-header" style="margin-bottom:24px;">
    <div class="pf-header-icon" style="background:linear-gradient(135deg,#0b1f3f,#1e3a5f);"><i class="bi bi-calendar-event"></i></div>
    <div>
        <h2 class="pf-header-title">Kelola Agenda & Acara</h2>
        <p class="pf-header-sub">Tambah, edit, dan hapus jadwal acara untuk sidebar beranda</p>
    </div>
    <a href="{{ route('admin.agendas.create') }}" class="btn btn-primary" style="margin-left:auto; text-decoration:none;">
        <i class="bi bi-plus-lg"></i> Tambah Agenda
    </a>
</div>

<div class="card" style="padding:0;overflow:hidden;">
    @if(session('success'))
        <div style="padding:12px 20px; background:#dcfce7; color:#16a34a; font-weight:600; font-size:13px; border-bottom:1px solid #bbf7d0;">
            {{ session('success') }}
        </div>
    @endif

    @if($agendas->isEmpty())
        <div style="text-align:center;padding:60px 20px;color:var(--text-muted);">
            <i class="bi bi-calendar-x" style="font-size:48px;display:block;margin-bottom:16px;color:#94a3b8;"></i>
            <p>Belum ada jadwal acara. Klik <strong>Tambah Agenda</strong> untuk mulai.</p>
        </div>
    @else
    <table style="width:100%;border-collapse:collapse;font-size:13px;">
        <thead style="background:#f8fafc;">
            <tr style="border-bottom:2px solid #e2e8f0;">
                <th style="padding:12px 16px;text-align:left;font-weight:700;color:#64748b;text-transform:uppercase;font-size:10.5px;letter-spacing:.5px;">Judul Acara</th>
                <th style="padding:12px 16px;text-align:center;font-weight:700;color:#64748b;text-transform:uppercase;font-size:10.5px;letter-spacing:.5px;">Jadwal / Waktu</th>
                <th style="padding:12px 16px;text-align:center;font-weight:700;color:#64748b;text-transform:uppercase;font-size:10.5px;letter-spacing:.5px;">Lokasi</th>
                <th style="padding:12px 16px;text-align:center;font-weight:700;color:#64748b;text-transform:uppercase;font-size:10.5px;letter-spacing:.5px;">Status</th>
                <th style="padding:12px 16px;text-align:center;font-weight:700;color:#64748b;text-transform:uppercase;font-size:10.5px;letter-spacing:.5px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($agendas as $agenda)
            <tr style="border-bottom:1px solid #f1f5f9;transition:background .15s;" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background=''">
                <td style="padding:12px 16px;">
                    <div style="display:flex;align-items:center;gap:12px;">
                        @if($agenda->cover_image)
                            <img src="{{ asset('storage/'.$agenda->cover_image) }}" style="width:56px;height:40px;object-fit:cover;border-radius:6px;border:1px solid #e2e8f0;">
                        @else
                            <div style="width:56px;height:40px;background:#f1f5f9;border-radius:6px;display:flex;align-items:center;justify-content:center;color:#94a3b8;"><i class="bi bi-calendar"></i></div>
                        @endif
                        <div style="font-weight:700;color:#0b1f3f;font-size:13px;">{{ Str::limit($agenda->title, 55) }}</div>
                    </div>
                </td>
                <td style="padding:12px 16px;text-align:center;font-size:12px;color:#64748b;">
                    {{ $agenda->event_date ? $agenda->event_date->format('d M Y • H:i') . ' WIB' : '-' }}
                </td>
                <td style="padding:12px 16px;text-align:center;font-size:12px;color:#64748b;">
                    <i class="bi bi-geo-alt text-danger"></i> {{ $agenda->location ?? '-' }}
                </td>
                <td style="padding:12px 16px;text-align:center;">
                    @if($agenda->is_published)
                        <span style="padding:3px 10px;border-radius:20px;font-size:11px;font-weight:700;background:#dcfce7;color:#16a34a;">Tayang</span>
                    @else
                        <span style="padding:3px 10px;border-radius:20px;font-size:11px;font-weight:700;background:#fef9c3;color:#ca8a04;">Draft</span>
                    @endif
                </td>
                <td style="padding:12px 16px;text-align:center;">
                    <div style="display:flex;gap:6px;justify-content:center;">
                        <a href="{{ route('admin.agendas.edit', $agenda) }}" class="btn" style="padding:5px 12px;font-size:12px;background:#f1f5f9;color:#0b1f3f;border-radius:6px;font-weight:600;text-decoration:none;">
                            <i class="bi bi-pencil-square"></i> Edit
                        </a>
                        <form method="POST" action="{{ route('admin.agendas.destroy', $agenda) }}" onsubmit="return confirm('Hapus agenda ini?')" style="margin:0;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn" style="padding:5px 12px;font-size:12px;background:#fee2e2;color:#dc2626;border-radius:6px;font-weight:600;border:none;cursor:pointer;">
                                <i class="bi bi-trash3"></i> Hapus
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div style="padding:16px 20px;">{{ $agendas->links() }}</div>
    @endif
</div>
@endsection