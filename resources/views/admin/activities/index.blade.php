@extends('layouts.admin')
@section('title', 'Kelola Kegiatan - Cabdin Gresik')
@section('content')

<div class="pf-header" style="margin-bottom:24px;">
    <div class="pf-header-icon" style="background:linear-gradient(135deg,#0b1f3f,#1e3a5f);"><i class="bi bi-camera"></i></div>
    <div>
        <h2 class="pf-header-title">Kelola Kegiatan</h2>
        <p class="pf-header-sub">Tambah, edit, dan hapus galeri kegiatan Cabdin Gresik</p>
    </div>
    <a href="{{ route('admin.activities.create') }}" class="btn btn-primary" style="margin-left:auto; text-decoration:none;">
        <i class="bi bi-plus-lg"></i> Tambah Kegiatan
    </a>
</div>

<div class="card" style="padding:0;overflow:hidden;">
    @if($activities->isEmpty())
        <div style="text-align:center;padding:60px 20px;color:var(--text-muted);">
            <i class="bi bi-images" style="font-size:48px;display:block;margin-bottom:16px;color:#94a3b8;"></i>
            <p>Belum ada data kegiatan. Klik <strong>Tambah Kegiatan</strong> untuk mulai.</p>
        </div>
    @else
    <table style="width:100%;border-collapse:collapse;font-size:13px;">
        <thead style="background:#f8fafc;">
            <tr style="border-bottom:2px solid #e2e8f0;">
                <th style="padding:12px 16px;text-align:left;font-weight:700;color:#64748b;text-transform:uppercase;font-size:10.5px;letter-spacing:.5px;">Kegiatan</th>
                <th style="padding:12px 16px;text-align:center;font-weight:700;color:#64748b;text-transform:uppercase;font-size:10.5px;letter-spacing:.5px;">Kategori</th>
                <th style="padding:12px 16px;text-align:center;font-weight:700;color:#64748b;text-transform:uppercase;font-size:10.5px;letter-spacing:.5px;">Tanggal</th>
                <th style="padding:12px 16px;text-align:center;font-weight:700;color:#64748b;text-transform:uppercase;font-size:10.5px;letter-spacing:.5px;">Foto</th>
                <th style="padding:12px 16px;text-align:center;font-weight:700;color:#64748b;text-transform:uppercase;font-size:10.5px;letter-spacing:.5px;">Status</th>
                <th style="padding:12px 16px;text-align:center;font-weight:700;color:#64748b;text-transform:uppercase;font-size:10.5px;letter-spacing:.5px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($activities as $activity)
            <tr style="border-bottom:1px solid #f1f5f9;transition:background .15s;" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background=''">
                <td style="padding:12px 16px;">
                    <div style="display:flex;align-items:center;gap:12px;">
                        @if($activity->cover_image_url)
                            <img src="{{ $activity->cover_image_url }}" alt="{{ $activity->title }}" style="width:56px;height:40px;object-fit:cover;border-radius:6px;border:1px solid #e2e8f0;" onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1516321318423-f06f85e504b3?q=80&w=800&auto=format&fit=crop';">
                        @else
                            <div style="width:56px;height:40px;background:#f1f5f9;border-radius:6px;display:flex;align-items:center;justify-content:center;color:#94a3b8;"><i class="bi bi-image"></i></div>
                        @endif
                        <div>
                            <div style="font-weight:700;color:#0b1f3f;font-size:13px;">{{ Str::limit($activity->title, 55) }}</div>
                            <div style="font-size:11px;color:#94a3b8;"><i class="bi bi-geo-alt"></i> {{ $activity->location ?? '-' }}</div>
                        </div>
                    </div>
                </td>
                <td style="padding:12px 16px;text-align:center;">
                    <span style="padding:3px 10px;border-radius:20px;font-size:11px;font-weight:700;background:#eff6ff;color:#1d4ed8;">{{ ucfirst($activity->category) }}</span>
                </td>
                <td style="padding:12px 16px;text-align:center;font-size:12px;color:#64748b;">{{ $activity->activity_date ? $activity->activity_date->format('d M Y') : '-' }}</td>
                <td style="padding:12px 16px;text-align:center;">
                    <span style="font-size:12px;font-weight:700;color:#0b1f3f;">{{ count($activity->images ?? []) + ($activity->cover_image ? 1 : 0) }} foto</span>
                </td>
                <td style="padding:12px 16px;text-align:center;">
                    @if($activity->is_published)
                        <span style="padding:3px 10px;border-radius:20px;font-size:11px;font-weight:700;background:#dcfce7;color:#16a34a;">Tayang</span>
                    @else
                        <span style="padding:3px 10px;border-radius:20px;font-size:11px;font-weight:700;background:#fef9c3;color:#ca8a04;">Draft</span>
                    @endif
                </td>
                <td style="padding:12px 16px;text-align:center;">
                    <div style="display:flex;gap:6px;justify-content:center;">
                        <a href="{{ route('admin.activities.edit', $activity) }}" class="btn" style="padding:5px 12px;font-size:12px;background:#f1f5f9;color:#0b1f3f;border-radius:6px;font-weight:600;text-decoration:none;"><i class="bi bi-pencil-square"></i> Edit</a>
                        <form method="POST" action="{{ route('admin.activities.destroy', $activity) }}" onsubmit="return confirm('Hapus kegiatan ini beserta seluruh fotonya?')" style="margin:0;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn" style="padding:5px 12px;font-size:12px;background:#fee2e2;color:#dc2626;border-radius:6px;font-weight:600;border:none;cursor:pointer;"><i class="bi bi-trash3"></i> Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div style="padding:16px 20px;">{{ $activities->links() }}</div>
    @endif
</div>
@endsection
