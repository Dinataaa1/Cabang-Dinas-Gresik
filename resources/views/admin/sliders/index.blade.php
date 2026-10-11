@extends('layouts.admin')
@section('title', 'Kelola Slider Banner - Cabdin Gresik')
@section('content')

<div class="pf-header">
    <div class="pf-header-icon"><i class="bi bi-images"></i></div>
    <div>
        <h2 class="pf-header-title">Kelola Slider Banner</h2>
        <p class="pf-header-sub">Kelola gambar, judul, dan deskripsi yang tampil di hero slider halaman beranda.</p>
    </div>
</div>

<div style="display:flex;justify-content:flex-end;margin-bottom:20px;">
    <a href="{{ route('admin.sliders.create') }}" class="pf-btn-save" style="text-decoration:none;display:inline-flex;align-items:center;gap:8px;">
        <i class="bi bi-plus-circle"></i> Tambah Slider Baru
    </a>
</div>

@if($sliders->isEmpty())
    <div class="pf-card" style="text-align:center;padding:50px 20px;color:#94a3b8;">
        <i class="bi bi-image" style="font-size:48px;display:block;margin-bottom:16px;opacity:.4;"></i>
        <p style="font-size:15px;font-weight:600;">Belum ada slider. Tambahkan slide pertama Anda!</p>
    </div>
@else
    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(320px,1fr));gap:20px;">
        @foreach($sliders as $slider)
        <div class="pf-card" style="padding:0;overflow:hidden;">
            <div style="position:relative;height:180px;background:#e2e8f0;overflow:hidden;">
                @if($slider->image)
                    <img src="{{ asset('storage/'.$slider->image) }}" alt="{{ $slider->title }}"
                         style="width:100%;height:100%;object-fit:cover;">
                @else
                    <div style="display:flex;align-items:center;justify-content:center;height:100%;color:#94a3b8;">
                        <i class="bi bi-image" style="font-size:40px;"></i>
                    </div>
                @endif
                <span style="position:absolute;top:10px;left:10px;background:{{ $slider->is_active ? '#0d9488' : '#94a3b8' }};color:white;padding:3px 10px;border-radius:20px;font-size:11px;font-weight:700;">
                    {{ $slider->is_active ? 'Aktif' : 'Nonaktif' }}
                </span>
                <span style="position:absolute;top:10px;right:10px;background:rgba(0,0,0,.5);color:white;padding:3px 10px;border-radius:20px;font-size:11px;font-weight:700;">
                    Urutan: {{ $slider->order }}
                </span>
            </div>
            <div style="padding:16px 18px;">
                <h4 style="font-size:14px;font-weight:700;color:#0b1f3f;margin:0 0 4px;line-height:1.4;">{{ $slider->title }}</h4>
                @if($slider->excerpt)
                    <p style="font-size:12px;color:#64748b;margin:0 0 14px;line-height:1.5;">{{ Str::limit($slider->excerpt, 80) }}</p>
                @endif
                <div style="display:flex;gap:8px;">
                    <a href="{{ route('admin.sliders.edit', $slider) }}" style="flex:1;display:flex;align-items:center;justify-content:center;gap:6px;padding:7px;background:#f1f5f9;border-radius:8px;font-size:12px;font-weight:600;color:#0b1f3f;text-decoration:none;">
                        <i class="bi bi-pencil"></i> Edit
                    </a>
                    <form action="{{ route('admin.sliders.destroy', $slider) }}" method="POST" onsubmit="return confirm('Hapus slider ini?');">
                        @csrf @method('DELETE')
                        <button type="submit" style="padding:7px 14px;background:#fee2e2;border:none;border-radius:8px;font-size:12px;font-weight:600;color:#dc2626;cursor:pointer;">
                            <i class="bi bi-trash"></i> Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endif

@endsection
