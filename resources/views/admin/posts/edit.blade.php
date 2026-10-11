@extends('layouts.admin')

@section('title', 'Edit Konten - Cabdin Gresik')

@section('content')
<div style="margin-bottom: 25px;">
    <h2 style="font-size: 22px; font-weight: 800; color: var(--primary);">Edit Konten</h2>
    <p style="font-size: 13px; color: var(--text-muted);">Ubah data konten yang sudah dipublikasikan.</p>
</div>

<div class="card">
    <form action="{{ route('admin.posts.update', $post) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="title">Judul Konten</label>
            <input type="text" id="title" name="title" class="form-control" placeholder="Masukkan judul..." value="{{ old('title', $post->title) }}" required>
        </div>

        <div class="form-group">
            <label for="type">Kategori Konten</label>
            <select id="type" name="type" class="form-control" required>
                <option value="berita" {{ old('type', $post->type) == 'berita' ? 'selected' : '' }}>Berita</option>
                <option value="pengumuman" {{ old('type', $post->type) == 'pengumuman' ? 'selected' : '' }}>Pengumuman</option>
                <option value="inovasi" {{ old('type', $post->type) == 'inovasi' ? 'selected' : '' }}>Inovasi</option>
                <option value="prestasi" {{ old('type', $post->type) == 'prestasi' ? 'selected' : '' }}>Prestasi</option>
                <option value="kegiatan" {{ old('type', $post->type) == 'kegiatan' ? 'selected' : '' }}>Kegiatan</option>
            </select>
        </div>

        <div class="form-group">
            <label for="created_at">Tanggal Publikasi</label>
            <input type="datetime-local" id="created_at" name="created_at" class="form-control" required value="{{ old('created_at', $post->created_at ? $post->created_at->format('Y-m-d\TH:i') : '') }}">
        </div>

        <div class="form-group">
            <label>Foto Saat Ini</label>
            <div style="margin-bottom: 10px;">
                @if($post->image)
                    <img src="{{ Str::startsWith($post->image, 'http') ? $post->image : asset('storage/' . $post->image) }}" alt="foto" style="max-width: 200px; border-radius: var(--radius-sm); border: 1px solid var(--border); display: block;">
                @else
                    <span style="font-size: 13px; color: var(--text-muted); font-style: italic;">Tidak ada foto terupload.</span>
                @endif
            </div>
            <label for="image">Ganti Foto <span style="font-size: 11px; color: var(--text-muted); font-weight: normal;">(Biarkan kosong jika tidak ingin mengubah foto)</span></label>
            <input type="file" id="image" name="image" class="form-control" accept="image/*">
        </div>

        <div class="form-group">
            <label for="content">Isi Konten / Artikel</label>
            <textarea id="content" name="content" class="form-control use-ckeditor" style="min-height: 250px;" placeholder="Tulis isi berita di sini..." required>{{ old('content', $post->content) }}</textarea>
        </div>

        <div style="display: flex; gap: 15px; margin-top: 30px;">
            <button type="submit" class="btn btn-primary" style="font-weight: 700;">
                💾 Perbarui Konten
            </button>
            <a href="{{ route('admin.posts.index', ['type' => $post->type]) }}" class="btn btn-secondary" style="font-weight: 700;">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection
