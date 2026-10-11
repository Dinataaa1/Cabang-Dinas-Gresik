@extends('layouts.admin')

@section('title', 'Edit Layanan - Cabdin Gresik')

@section('content')

<div class="pf-header">
    <div class="pf-header-icon"><i class="bi bi-pencil-square"></i></div>
    <div>
        <h2 class="pf-header-title">Edit Layanan</h2>
        <p class="pf-header-sub">Ubah alur pengajuan, persyaratan, kategori, atau deskripsi layanan publik.</p>
    </div>
</div>

<div class="pf-card">
    <form action="{{ route('admin.services.update', $service) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="pf-card-body">
            <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 16px;">
                <div class="pf-form-group">
                    <label class="pf-label" for="name">Nama Layanan</label>
                    <input type="text" id="name" name="name" class="pf-textarea" style="min-height: 42px; height: 42px; padding: 6px 12px;"
                           placeholder="Contoh: Rekomendasi Mutasi Masuk Siswa SMA" value="{{ old('name', $service->name) }}" required>
                </div>
                <div class="pf-form-group">
                    <label class="pf-label" for="category">Kategori Bidang</label>
                    <select id="category" name="category" class="pf-textarea" style="min-height: 42px; height: 42px; padding: 6px 12px;" required>
                        @foreach($categories as $cat)
                            <option value="{{ $cat }}" {{ old('category', $service->category) == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="pf-form-group">
                <label class="pf-label" for="description">Deskripsi Layanan</label>
                <textarea id="description" name="description" class="pf-textarea use-ckeditor" style="min-height: 80px;" 
                          placeholder="Jelaskan mengenai deskripsi singkat layanan ini..." required>{{ old('description', $service->description) }}</textarea>
            </div>

            <div class="pf-form-group">
                <label class="pf-label" for="requirements">
                    Persyaratan Dokumen 
                    <span class="pf-label-hint">Gunakan baris baru (Enter) untuk memisahkan setiap poin persyaratan</span>
                </label>
                <textarea id="requirements" name="requirements" class="pf-textarea use-ckeditor" style="min-height: 120px;" 
                          placeholder="Masukkan persyaratan dokumen..." required>{{ old('requirements', $service->requirements) }}</textarea>
            </div>

            <div class="pf-form-group">
                <label class="pf-label" for="procedure">
                    Prosedur / Alur Pelayanan 
                    <span class="pf-label-hint">Gunakan baris baru (Enter) untuk memisahkan setiap tahapan pengajuan</span>
                </label>
                <textarea id="procedure" name="procedure" class="pf-textarea use-ckeditor" style="min-height: 120px;" 
                          placeholder="Masukkan alur/tahapan pengajuan pelayanan..." required>{{ old('procedure', $service->procedure) }}</textarea>
            </div>
        </div>

        <div class="pf-actions">
            <button type="submit" class="pf-btn-save"><i class="bi bi-floppy"></i> Perbarui Layanan</button>
            <a href="{{ route('admin.services.index') }}" class="pf-btn-cancel"><i class="bi bi-arrow-left"></i> Batal</a>
        </div>
    </form>
</div>

@endsection
