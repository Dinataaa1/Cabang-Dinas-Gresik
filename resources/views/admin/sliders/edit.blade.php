@extends('layouts.admin')
@section('title', 'Edit Slider - Cabdin Gresik')
@section('content')

<div class="pf-header">
    <div class="pf-header-icon"><i class="bi bi-pencil-square"></i></div>
    <div>
        <h2 class="pf-header-title">Edit Slider Banner</h2>
        <p class="pf-header-sub">Ubah gambar atau konten slide yang ada.</p>
    </div>
</div>

<div class="pf-card">
    <form action="{{ route('admin.sliders.update', $slider) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')

        <div class="pf-card-body">
            <div class="pf-form-group">
                <label class="pf-label">
                    <i class="bi bi-image pf-label-icon"></i> Gambar Slider
                    <span class="pf-label-hint">Biarkan kosong jika tidak ingin mengganti gambar</span>
                </label>
                <div class="pf-img-box pf-img-box--wide" onclick="document.getElementById('sliderImgInput').click()" style="max-width:100%;height:220px;">
                    @if($slider->image)
                        <img src="{{ asset('storage/'.$slider->image) }}" alt="{{ $slider->title }}" id="sliderPreviewImg" class="pf-img-thumb" style="width:100%;height:100%;object-fit:cover;">
                        <div class="pf-img-overlay"><i class="bi bi-camera"></i> Ganti Gambar</div>
                    @else
                        <div class="pf-img-placeholder" id="sliderPlaceholder">
                            <i class="bi bi-image" style="font-size:40px;"></i>
                            <span>Klik untuk memilih gambar</span>
                        </div>
                        <img src="" alt="" id="sliderPreviewImg" class="pf-img-thumb" style="display:none;width:100%;height:100%;object-fit:cover;">
                    @endif
                </div>
                <input type="file" id="sliderImgInput" name="image" accept="image/*" style="display:none;"
                       onchange="previewImg(this,'sliderPreviewImg','sliderPlaceholder')">
                <button type="button" class="pf-upload-btn" onclick="document.getElementById('sliderImgInput').click()">
                    <i class="bi bi-upload"></i> Ganti Gambar
                </button>
            </div>

            <div class="pf-form-group">
                <label class="pf-label" for="title">Judul Slider</label>
                <input type="text" id="title" name="title" class="pf-textarea" style="min-height:42px;height:42px;padding:6px 12px;"
                       value="{{ old('title', $slider->title) }}" required>
            </div>

            <div class="pf-form-group">
                <label class="pf-label" for="excerpt">Deskripsi Singkat</label>
                <textarea id="excerpt" name="excerpt" class="pf-textarea use-ckeditor" style="min-height:80px;">{{ old('excerpt', $slider->excerpt) }}</textarea>
            </div>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                <div class="pf-form-group">
                    <label class="pf-label" for="link_url">URL Tombol</label>
                    <input type="url" id="link_url" name="link_url" class="pf-textarea" style="min-height:42px;height:42px;padding:6px 12px;"
                           value="{{ old('link_url', $slider->link_url) }}">
                </div>
                <div class="pf-form-group">
                    <label class="pf-label" for="order">Urutan Tampil</label>
                    <input type="number" id="order" name="order" class="pf-textarea" style="min-height:42px;height:42px;padding:6px 12px;"
                           value="{{ old('order', $slider->order) }}" min="0">
                </div>
            </div>

            <div class="pf-form-group">
                <label style="display:flex;align-items:center;gap:10px;cursor:pointer;font-size:13px;font-weight:600;color:#374151;">
                    <input type="checkbox" name="is_active" value="1" {{ $slider->is_active ? 'checked' : '' }} style="width:17px;height:17px;accent-color:#0d9488;">
                    Aktifkan slider ini
                </label>
            </div>
        </div>

        <div class="pf-actions">
            <button type="submit" class="pf-btn-save"><i class="bi bi-floppy"></i> Simpan Perubahan</button>
            <a href="{{ route('admin.sliders.index') }}" class="pf-btn-cancel"><i class="bi bi-arrow-left"></i> Batal</a>
        </div>
    </form>
</div>

@endsection
