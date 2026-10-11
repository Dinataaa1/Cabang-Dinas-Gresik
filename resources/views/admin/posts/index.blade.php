@extends('layouts.admin')

@section('title', 'Kelola Konten - Cabdin Gresik')

@section('content')
@php
    $type = request('type', 'berita');
    $titleLabel = 'Kanal ' . ucfirst($type);
    $iconMap = [
        'berita' => 'bi-newspaper',
        'pengumuman' => 'bi-megaphone',
        'inovasi' => 'bi-lightbulb',
        'prestasi' => 'bi-trophy',
        'kegiatan' => 'bi-calendar-event'
    ];
    $iconClass = $iconMap[$type] ?? 'bi-file-text';
@endphp

<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
    <div>
        <h2 style="font-size: 22px; font-weight: 800; color: var(--primary); display: inline-flex; align-items: center; gap: 8px;">
            <i class="bi {{ $iconClass }}"></i> {{ $titleLabel }}
        </h2>
        <p style="font-size: 13px; color: var(--text-muted);">Kelola postingan konten untuk halaman {{ $type }}.</p>
    </div>
    <a href="{{ route('admin.posts.create', ['type' => $type]) }}" class="btn btn-primary" style="font-weight: 700; display: inline-flex; align-items: center; gap: 6px;">
        <i class="bi bi-plus-lg"></i> Tambah {{ ucfirst($type) }} Baru
    </a>
</div>

<div class="table-responsive">
    <table class="data-table">
        <thead>
            <tr>
                <th style="width: 80px;">Foto</th>
                <th>Judul Konten</th>
                <th style="width: 120px;">Tipe</th>
                <th style="width: 100px; text-align: center;"><i class="bi bi-eye-fill"></i> Views</th>
                <th style="width: 150px;">Tanggal Dibuat</th>
                <th style="width: 180px; text-align: center;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($posts as $post)
                <tr>
                    <td>
                        @if($post->image)
                            <img src="{{ Str::startsWith($post->image, 'http') ? $post->image : asset('storage/' . $post->image) }}" alt="foto" style="width: 60px; height: 40px; object-fit: cover; border-radius: var(--radius-sm);">
                        @else
                            <div style="width: 60px; height: 40px; background-color: #e5e7eb; border-radius: var(--radius-sm); display: flex; align-items: center; justify-content: center; font-size: 10px; color: #9ca3af;"><i class="bi bi-image" style="font-size: 14px;"></i></div>
                        @endif
                    </td>
                    <td>
                        <strong style="font-size: 14px; color: var(--primary);">{{ $post->title }}</strong>
                    </td>
                    <td>
                        <span class="badge {{ $post->type == 'berita' ? 'badge-info' : 'badge-warning' }}">{{ $post->type }}</span>
                    </td>
                    <td style="text-align: center;">
                        <span style="display: inline-flex; align-items: center; gap: 4px; background: linear-gradient(135deg, #f0f9ff, #e0f2fe); color: #0369a1; padding: 3px 10px; border-radius: 20px; font-weight: 700; font-size: 12px; border: 1px solid #bae6fd;">
                            <i class="bi bi-eye-fill" style="font-size: 11px;"></i>
                            {{ number_format($post->views) }}
                        </span>
                    </td>
                    <td>{{ $post->created_at->format('d M Y H:i') }} WIB</td>
                    <td>
                        <div style="display: flex; justify-content: center; gap: 8px;">
                            <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-secondary" style="padding: 6px 10px; font-size: 11px; display: inline-flex; align-items: center; gap: 4px; background-color: #f59e0b; color: white;">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>
                            <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus konten ini?');" style="margin: 0;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" style="padding: 6px 10px; font-size: 11px; display: inline-flex; align-items: center; gap: 4px;">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center; padding: 30px; color: var(--text-muted);">
                        Belum ada konten untuk tipe <strong>{{ $type }}</strong>.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div style="margin-top: 20px;">
    {{ $posts->appends(['type' => $type])->links() }}
</div>
@endsection
