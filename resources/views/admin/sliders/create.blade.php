@extends('layouts.admin')
@section('title', 'Tambah Slider - Cabdin Gresik')
@section('content')

<div class="pf-header">
    <div class="pf-header-icon"><i class="bi bi-plus-circle"></i></div>
    <div>
        <h2 class="pf-header-title">Tambah Slider Banner Baru</h2>
        <p class="pf-header-sub">Unggah gambar dan atur konten slide baru untuk halaman beranda.</p>
    </div>
</div>

<div class="pf-card">
    <form action="{{ route('admin.sliders.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="pf-card-body">
            <div class="pf-form-group">
                <label class="pf-label">
                    <i class="bi bi-image pf-label-icon"></i> Gambar Slider
                    <span class="pf-label-hint">JPG, PNG, WEBP · Disarankan 1200×500px · Maks 5MB</span>
                </label>
                <div class="pf-img-box pf-img-box--wide" onclick="document.getElementById('sliderImgInput').click()" style="max-width:100%;height:220px;">
                    <div class="pf-img-placeholder" id="sliderPlaceholder">
                        <i class="bi bi-image" style="font-size:40px;"></i>
                        <span>Klik untuk memilih gambar</span>
                        <small>Format: JPG, PNG, WEBP</small>
                    </div>
                    <img src="" alt="" id="sliderPreviewImg" class="pf-img-thumb" style="display:none;width:100%;height:100%;object-fit:cover;">
                </div>
                <input type="file" id="sliderImgInput" name="image" accept="image/*" style="display:none;"
                       onchange="previewImg(this,'sliderPreviewImg','sliderPlaceholder')" required>
                <button type="button" class="pf-upload-btn" onclick="document.getElementById('sliderImgInput').click()">
                    <i class="bi bi-upload"></i> Pilih Gambar
                </button>
            </div>

            <div class="pf-form-group">
                <label class="pf-label" for="title">Judul Slider</label>
                <input type="text" id="title" name="title" class="pf-textarea" style="min-height:42px;height:42px;padding:6px 12px;"
                       value="{{ old('title') }}" placeholder="Contoh: Portal Resmi Cabdin Gresik" required>
            </div>

            <div class="pf-form-group">
                <label class="pf-label" for="excerpt">Deskripsi Singkat <span class="pf-label-hint">Maks 500 karakter (opsional)</span></label>
                <textarea id="excerpt" name="excerpt" class="pf-textarea use-ckeditor" style="min-height:80px;" placeholder="Deskripsi yang tampil di bawah judul slider...">{{ old('excerpt') }}</textarea>
            </div>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                <div class="pf-form-group">
                    <label class="pf-label" for="link_url">URL Tombol "Baca Selengkapnya" <span class="pf-label-hint">Opsional</span></label>
                    <input type="text" id="link_url" name="link_url" class="pf-textarea" style="min-height:42px;height:42px;padding:6px 12px;"
                           value="{{ old('link_url') }}" placeholder="https://...">
                </div>
                <div class="pf-form-group">
                    <label class="pf-label" for="order">Urutan Tampil</label>
                    <input type="number" id="order" name="order" class="pf-textarea" style="min-height:42px;height:42px;padding:6px 12px;"
                           value="{{ old('order', 0) }}" min="0">
                </div>
            </div>

            <div class="pf-form-group">
                <label style="display:flex;align-items:center;gap:10px;cursor:pointer;font-size:13px;font-weight:600;color:#374151;">
                    <input type="checkbox" name="is_active" value="1" checked style="width:17px;height:17px;accent-color:#0d9488;">
                    Aktifkan slider ini (tampil di beranda)
                </label>
            </div>
        </div>

        <div class="pf-actions">
            <button type="submit" class="pf-btn-save"><i class="bi bi-floppy"></i> Simpan Slider</button>
            <a href="{{ route('admin.sliders.index') }}" class="pf-btn-cancel"><i class="bi bi-arrow-left"></i> Batal</a>
        </div>
    </form>
</div>

@endsection
