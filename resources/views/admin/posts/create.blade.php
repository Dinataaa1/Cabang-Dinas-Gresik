@extends('layouts.admin')

@section('title', 'Tambah Konten Baru - Cabdin Gresik')

@section('content')
@php
    $type = request('type', 'berita');
@endphp

<div style="margin-bottom: 25px;">
    <h2 style="font-size: 22px; font-weight: 800; color: var(--primary);">Tambah {{ ucfirst($type) }} Baru</h2>
    <p style="font-size: 13px; color: var(--text-muted);">Publikasikan konten {{ $type }} baru ke website.</p>
</div>

<div class="card">
    <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="form-group">
            <label for="title">Judul {{ ucfirst($type) }}</label>
            <input type="text" id="title" name="title" class="form-control" placeholder="Masukkan judul..." value="{{ old('title') }}" required>
        </div>

        <div class="form-group">
            <label for="type">Kategori Konten</label>
            <select id="type" name="type" class="form-control" required>
                <option value="berita" {{ $type == 'berita' ? 'selected' : '' }}>Berita</option>
                <option value="pengumuman" {{ $type == 'pengumuman' ? 'selected' : '' }}>Pengumuman</option>
                <option value="inovasi" {{ $type == 'inovasi' ? 'selected' : '' }}>Inovasi</option>
                <option value="prestasi" {{ $type == 'prestasi' ? 'selected' : '' }}>Prestasi</option>
                <option value="kegiatan" {{ $type == 'kegiatan' ? 'selected' : '' }}>Kegiatan</option>
            </select>
        </div>

        <div class="form-group">
            <label for="created_at">Tanggal Publikasi <span style="font-size: 11px; color: var(--text-muted); font-weight: normal;">(Kosongkan untuk menggunakan tanggal &amp; waktu saat ini)</span></label>
            <input type="datetime-local" id="created_at" name="created_at" class="form-control" value="{{ old('created_at') }}">
        </div>

        <div class="form-group">
            <label for="image">Foto Utama / Pendukung <span style="font-size: 11px; color: var(--text-muted); font-weight: normal;">(Format: JPG, PNG, JPEG. Max: 2MB)</span></label>
            <input type="file" id="image" name="image" class="form-control" accept="image/*">
        </div>

        <div class="form-group">
            <label for="content">Isi Konten / Artikel</label>
            <textarea id="content" name="content" class="form-control use-ckeditor" style="min-height: 250px;" placeholder="Tulis isi berita di sini..." required>{{ old('content') }}</textarea>
        </div>

        <div style="display: flex; gap: 15px; margin-top: 30px;">
            <button type="submit" class="btn btn-primary" style="font-weight: 700;">
                💾 Simpan & Publikasikan
            </button>
            <a href="{{ route('admin.posts.index', ['type' => $type]) }}" class="btn btn-secondary" style="font-weight: 700;">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection
