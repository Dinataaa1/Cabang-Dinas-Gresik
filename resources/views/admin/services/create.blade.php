@extends('layouts.admin')

@section('title', 'Tambah Layanan Baru - Cabdin Gresik')

@section('content')

<div class="pf-header">
    <div class="pf-header-icon"><i class="bi bi-plus-circle"></i></div>
    <div>
        <h2 class="pf-header-title">Tambah Layanan Baru</h2>
        <p class="pf-header-sub">Daftarkan jenis pelayanan baru untuk SMA, SMK, atau Tata Usaha.</p>
    </div>
</div>

<div class="pf-card">
    <form action="{{ route('admin.services.store') }}" method="POST">
        @csrf

        <div class="pf-card-body">
            <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 16px;">
                <div class="pf-form-group">
                    <label class="pf-label" for="name">Nama Layanan</label>
                    <input type="text" id="name" name="name" class="pf-textarea" style="min-height: 42px; height: 42px; padding: 6px 12px;"
                           placeholder="Contoh: Rekomendasi Mutasi Masuk Siswa SMA" value="{{ old('name') }}" required>
                </div>
                <div class="pf-form-group">
                    <label class="pf-label" for="category">Kategori Bidang</label>
                    <select id="category" name="category" class="pf-textarea" style="min-height: 42px; height: 42px; padding: 6px 12px;" required>
                        @foreach($categories as $cat)
                            <option value="{{ $cat }}" {{ old('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="pf-form-group">
                <label class="pf-label" for="description">Deskripsi Layanan</label>
                <textarea id="description" name="description" class="pf-textarea use-ckeditor" style="min-height: 80px;" 
                          placeholder="Jelaskan mengenai deskripsi singkat layanan ini..." required>{{ old('description') }}</textarea>
            </div>

            <div class="pf-form-group">
                <label class="pf-label" for="requirements">
                    Persyaratan Dokumen 
                    <span class="pf-label-hint">Gunakan baris baru (Enter) untuk memisahkan setiap poin persyaratan</span>
                </label>
                <textarea id="requirements" name="requirements" class="pf-textarea use-ckeditor" style="min-height: 120px;" 
                          placeholder="Contoh:&#10;1. Surat pengantar dari sekolah asal&#10;2. Fotokopi Raport terakhir&#10;3. Rekomendasi Cabdin asal">{{ old('requirements') }}</textarea>
            </div>

            <div class="pf-form-group">
                <label class="pf-label" for="procedure">
                    Prosedur / Alur Pelayanan 
                    <span class="pf-label-hint">Gunakan baris baru (Enter) untuk memisahkan setiap tahapan pengajuan</span>
                </label>
                <textarea id="procedure" name="procedure" class="pf-textarea use-ckeditor" style="min-height: 120px;" 
                          placeholder="Contoh:&#10;1. Pemohon membawa berkas ke loket layanan&#10;2. Petugas memverifikasi kelayakan dokumen&#10;3. Kepala Seksi memberikan persetujuan">{{ old('procedure') }}</textarea>
            </div>
        </div>

        <div class="pf-actions">
            <button type="submit" class="pf-btn-save"><i class="bi bi-floppy"></i> Simpan Layanan</button>
            <a href="{{ route('admin.services.index') }}" class="pf-btn-cancel"><i class="bi bi-arrow-left"></i> Batal</a>
        </div>
    </form>
</div>

@endsection
