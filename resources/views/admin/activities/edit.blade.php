@extends('layouts.admin')
@section('title', 'Edit Kegiatan - Cabdin Gresik')
@section('content')

<div class="pf-header" style="margin-bottom:24px;">
    <div class="pf-header-icon" style="background:linear-gradient(135deg,#d97706,#f59e0b);"><i class="bi bi-pencil-square"></i></div>
    <div>
        <h2 class="pf-header-title">Edit Kegiatan</h2>
        <p class="pf-header-sub">{{ Str::limit($activity->title, 60) }}</p>
    </div>
</div>

<div class="card">
    <form action="{{ route('admin.activities.update', $activity) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:18px;">
            <div class="form-group" style="grid-column:1/-1;">
                <label for="title">Judul Kegiatan *</label>
                <input type="text" id="title" name="title" class="form-control" value="{{ old('title', $activity->title) }}" required>
            </div>

            <div class="form-group">
                <label for="activity_date">Tanggal Kegiatan</label>
                <input type="date" id="activity_date" name="activity_date" class="form-control" value="{{ old('activity_date', $activity->activity_date?->format('Y-m-d')) }}">
            </div>

            <div class="form-group">
                <label for="location">Lokasi Kegiatan</label>
                <input type="text" id="location" name="location" class="form-control" value="{{ old('location', $activity->location) }}">
            </div>

            <div class="form-group">
                <label for="category">Kategori</label>
                <select id="category" name="category" class="form-control">
                    @foreach(['umum','prestasi','sosial','olahraga','seni','pendidikan'] as $cat)
                    <option value="{{ $cat }}" {{ old('category',$activity->category)==$cat?'selected':'' }}>{{ ucfirst($cat) }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Status Publikasi</label>
                <div style="margin-top:8px;display:flex;align-items:center;gap:10px;">
                    <input type="checkbox" id="is_published" name="is_published" value="1" {{ old('is_published',$activity->is_published)?'checked':'' }} style="width:18px;height:18px;cursor:pointer;">
                    <label for="is_published" style="font-weight:400;cursor:pointer;">Tayangkan ke publik</label>
                </div>
            </div>

            <div class="form-group" style="grid-column:1/-1;">
                <label for="description">Deskripsi / Keterangan Kegiatan</label>
                <textarea id="description" name="description" class="form-control use-ckeditor" style="min-height:200px;">{{ old('description', $activity->description) }}</textarea>
            </div>

            <div class="form-group" style="grid-column:1/-1;">
                <label>Foto Sampul Saat Ini</label>
                @if($activity->cover_image)
                    <div style="margin-bottom:10px;">
                        <img src="{{ Str::startsWith($activity->cover_image, ['http://', 'https://']) ? $activity->cover_image : asset('storage/'.$activity->cover_image) }}" style="max-height:180px;border-radius:10px;border:1px solid #e2e8f0;" onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1516321318423-f06f85e504b3?q=80&w=800&auto=format&fit=crop';">
                    </div>
                @endif
                <label for="cover_image">Ganti Foto Sampul (opsional)</label>
                <input type="file" id="cover_image" name="cover_image" class="form-control" accept="image/*" onchange="previewCover(this)">
                <div id="cover-preview" style="margin-top:10px;display:none;">
                    <img id="cover-preview-img" style="max-height:180px;border-radius:10px;border:1px solid #e2e8f0;">
                </div>
            </div>

            {{-- Existing Gallery Images --}}
            @if(!empty($activity->images))
            <div class="form-group" style="grid-column:1/-1;">
                <label>Foto Galeri Saat Ini <span style="font-size:11px;color:var(--text-muted);">(Centang foto untuk menghapus)</span></label>
                <div style="display:flex;flex-wrap:wrap;gap:12px;margin-top:10px;">
                    @foreach($activity->images as $img)
                    <label style="position:relative;cursor:pointer; display:block; width:140px; height:100px;">
                        <input type="checkbox" name="delete_images[]" value="{{ $img }}" style="position:absolute;top:6px;left:6px;width:18px;height:18px;accent-color:#dc2626; z-index: 10;">
                        <img src="{{ Str::startsWith($img, ['http://', 'https://']) ? $img : asset('storage/'.$img) }}" style="width:140px;height:100px;object-fit:cover;border-radius:8px;border:2px solid #e2e8f0;display:block;" onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1516321318423-f06f85e504b3?q=80&w=800&auto=format&fit=crop';">
                        <div style="position:absolute;bottom:4px;right:4px;background:rgba(220,38,38,.8);color:#fff;font-size:10px;padding:2px 6px;border-radius:4px; z-index: 10;">✕ Hapus</div>
                    </label>
                    @endforeach
                </div>
            </div>
            @endif

            <div class="form-group" style="grid-column:1/-1;">
                <label for="images">Tambah Foto Galeri Baru <span style="font-size:11px;color:var(--text-muted);">(opsional, bisa pilih banyak)</span></label>
                <input type="file" id="images" name="images[]" class="form-control" accept="image/*" multiple onchange="previewGallery(this)">
                <div id="gallery-preview" style="display:flex;gap:10px;flex-wrap:wrap;margin-top:12px;"></div>
            </div>
        </div>

        <div style="display:flex;gap:15px;margin-top:30px;">
            <button type="submit" class="btn btn-primary" style="font-weight:700;">💾 Simpan Perubahan</button>
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
