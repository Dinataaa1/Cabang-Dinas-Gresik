@extends('layouts.admin')
@section('title', 'Tambah Kegiatan - Cabdin Gresik')
@section('content')

<div class="pf-header" style="margin-bottom:24px;">
    <div class="pf-header-icon" style="background:linear-gradient(135deg,#0b1f3f,#1e3a5f);"><i class="bi bi-plus-circle"></i></div>
    <div>
        <h2 class="pf-header-title">Tambah Kegiatan Baru</h2>
        <p class="pf-header-sub">Unggah foto dan informasi kegiatan Cabdin Gresik</p>
    </div>
</div>

<div class="card">
    <form action="{{ route('admin.activities.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:18px;">
            <div class="form-group" style="grid-column:1/-1;">
                <label for="title">Judul Kegiatan *</label>
                <input type="text" id="title" name="title" class="form-control" value="{{ old('title') }}" placeholder="Contoh: Lomba Kreasi Seni Pelajar 2025" required>
            </div>

            <div class="form-group">
                <label for="activity_date">Tanggal Kegiatan</label>
                <input type="date" id="activity_date" name="activity_date" class="form-control" value="{{ old('activity_date') }}">
            </div>

            <div class="form-group">
                <label for="location">Lokasi Kegiatan</label>
                <input type="text" id="location" name="location" class="form-control" value="{{ old('location') }}" placeholder="Contoh: GOR Tri Dharma Gresik">
            </div>

            <div class="form-group">
                <label for="category">Kategori</label>
                <select id="category" name="category" class="form-control" required>
                    <option value="umum" {{ old('category')=='umum'?'selected':'' }}>Umum</option>
                    <option value="prestasi" {{ old('category')=='prestasi'?'selected':'' }}>Prestasi</option>
                    <option value="sosial" {{ old('category')=='sosial'?'selected':'' }}>Sosial</option>
                    <option value="olahraga" {{ old('category')=='olahraga'?'selected':'' }}>Olahraga</option>
                    <option value="seni" {{ old('category')=='seni'?'selected':'' }}>Seni & Budaya</option>
                    <option value="pendidikan" {{ old('category')=='pendidikan'?'selected':'' }}>Pendidikan</option>
                </select>
            </div>

            <div class="form-group">
                <label>Status Publikasi</label>
                <div style="margin-top:8px;display:flex;align-items:center;gap:10px;">
                    <input type="checkbox" id="is_published" name="is_published" value="1" {{ old('is_published',1)?'checked':'' }} style="width:18px;height:18px;cursor:pointer;">
                    <label for="is_published" style="font-weight:400;cursor:pointer;">Tayangkan sekarang</label>
                </div>
            </div>

            <div class="form-group" style="grid-column:1/-1;">
                <label for="description">Deskripsi / Keterangan Kegiatan</label>
                <textarea id="description" name="description" class="form-control use-ckeditor" style="min-height:200px;" placeholder="Ceritakan tentang kegiatan ini...">{{ old('description') }}</textarea>
            </div>

            <div class="form-group" style="grid-column:1/-1;">
                <label for="cover_image">Foto Sampul / Cover Utama</label>
                <input type="file" id="cover_image" name="cover_image" class="form-control" accept="image/*" onchange="previewCover(this)">
                <div id="cover-preview" style="margin-top:10px;display:none;">
                    <img id="cover-preview-img" style="max-height:200px;border-radius:10px;border:1px solid var(--border);">
                </div>
            </div>

            <div class="form-group" style="grid-column:1/-1;">
                <label for="images">Foto Galeri Kegiatan <span style="font-size:11px;color:var(--text-muted);font-weight:normal;">(Bisa pilih banyak foto sekaligus — akan tampil sebagai slideshow)</span></label>
                <input type="file" id="images" name="images[]" class="form-control" accept="image/*" multiple onchange="previewGallery(this)">
                <div id="gallery-preview" style="display:flex;gap:10px;flex-wrap:wrap;margin-top:12px;"></div>
            </div>
        </div>

        <div style="display:flex;gap:15px;margin-top:30px;">
            <button type="submit" class="btn btn-primary" style="font-weight:700;">💾 Simpan Kegiatan</button>
            <a href="{{ route('admin.activities.index') }}" class="btn btn-secondary" style="text-decoration:none; display:inline-flex; align-items:center; justify-content:center; padding:10px 20px; font-weight:700; border-radius:8px;">Batal</a>
        </div>
    </form>
</div>

<script>
function previewCover(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            document.getElementById('cover-preview-img').src = e.target.result;
            document.getElementById('cover-preview').style.display = 'block';
        };
        reader.readAsDataURL(input.files[0]);
    }
}
function previewGallery(input) {
    const container = document.getElementById('gallery-preview');
    container.innerHTML = '';
    Array.from(input.files).forEach(file => {
        const reader = new FileReader();
        reader.onload = e => {
            const img = document.createElement('img');
            img.src = e.target.result;
            img.style.cssText = 'height:90px;width:120px;object-fit:cover;border-radius:8px;border:1px solid #e2e8f0;';
            container.appendChild(img);
        };
        reader.readAsDataURL(file);
    });
}
</script>
@endsection
