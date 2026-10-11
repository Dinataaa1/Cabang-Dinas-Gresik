@extends('layouts.admin')

@section('title', 'Kelola MKKS - Cabdin Gresik')

@section('content')

<div class="pf-header">
    <div class="pf-header-icon"><i class="bi bi-building"></i></div>
    <div>
        <h2 class="pf-header-title">Manajemen Forum MKKS &amp; Data Sekolah</h2>
        <p class="pf-header-sub">Kelola konten deskripsi forum, data statistik total kabupaten (Guru, Tendik, Siswa, Prestasi), serta foto-foto galeri kegiatan per jenjang.</p>
    </div>
</div>

<div class="pf-card">
    <form action="{{ route('admin.mkks.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- SECTION 1: SMA --}}
        <div style="border-bottom: 2px solid #f1f5f9; padding-bottom: 30px; margin-bottom: 30px;">
            <h3 style="font-size: 16px; font-weight: 800; color: #0b1f3f; margin: 0 0 16px; display: flex; align-items: center; gap: 8px;">
                <span style="background: #0b1f3f; color: white; width: 26px; height: 26px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 13px;">1</span>
                Forum Komunikasi SMA (Sekolah Menengah Atas)
            </h3>

            <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 16px; margin-bottom: 16px;">
                <div class="pf-form-group" style="margin-bottom: 0;">
                    <label class="pf-label" for="sma_title">Judul Halaman</label>
                    <input type="text" id="sma_title" name="sma_title" class="pf-textarea" style="min-height: 42px; height: 42px; padding: 6px 12px;"
                           value="{{ old('sma_title', $sma ? $sma->title : '') }}" required>
                </div>
                <div class="pf-form-group" style="margin-bottom: 0;">
                    <label class="pf-label">Unggah Foto Baru (Bisa pilih banyak)</label>
                    <input type="file" name="sma_images[]" class="pf-textarea" style="padding: 8px 12px; cursor: pointer;" accept="image/*" multiple>
                </div>
            </div>

            {{-- SMA Current Images Gallery --}}
            @if($sma && !empty($sma->image))
            <div class="pf-form-group" style="margin-bottom: 16px;">
                <label class="pf-label" style="margin-bottom: 8px;">Foto Kegiatan Saat Ini <span style="font-size: 11px; color: var(--text-muted); font-weight: normal;">(Centang foto untuk menghapus)</span></label>
                <div style="display: flex; flex-wrap: wrap; gap: 12px; background: #f8fafc; padding: 14px; border-radius: 10px; border: 1px solid var(--border);">
                    @foreach((array)$sma->image as $img)
                    <label style="position: relative; cursor: pointer; display: block;">
                        <input type="checkbox" name="sma_delete_images[]" value="{{ $img }}" style="position: absolute; top: 6px; left: 6px; width: 18px; height: 18px; accent-color: #dc2626;">
                        <img src="{{ asset('storage/' . $img) }}" style="width: 120px; height: 80px; object-fit: cover; border-radius: 6px; border: 1px solid #e2e8f0; display: block;">
                        <div style="position: absolute; bottom: 4px; right: 4px; background: rgba(220, 38, 38, 0.85); color: white; font-size: 9.5px; padding: 2px 6px; border-radius: 4px; font-weight: bold;">✕ Hapus</div>
                    </label>
                    @endforeach
                </div>
            </div>
            @endif

            <div class="pf-form-group">
                <label class="pf-label" for="sma_content">Deskripsi / Selayang Pandang</label>
                <textarea id="sma_content" name="sma_content" class="pf-textarea use-ckeditor" style="min-height: 100px;" required>{{ old('sma_content', $sma ? $sma->content : '') }}</textarea>
            </div>

            {{-- Stats Grid (5 Columns) --}}
            <div style="display: grid; grid-template-columns: repeat(5, 1fr); gap: 16px; margin-bottom: 16px;">
                <div class="pf-form-group" style="margin-bottom: 0;">
                    <label class="pf-label" for="sma_jumlah_sekolah">Total Sekolah</label>
                    <input type="number" id="sma_jumlah_sekolah" name="sma_jumlah_sekolah" class="pf-textarea" style="min-height: 42px; height: 42px; padding: 6px 12px;"
                           value="{{ old('sma_jumlah_sekolah', $sma ? $sma->jumlah_sekolah : 0) }}" min="0" required>
                </div>
                <div class="pf-form-group" style="margin-bottom: 0;">
                    <label class="pf-label" for="sma_jumlah_guru">Total Guru</label>
                    <input type="number" id="sma_jumlah_guru" name="sma_jumlah_guru" class="pf-textarea" style="min-height: 42px; height: 42px; padding: 6px 12px;"
                           value="{{ old('sma_jumlah_guru', $sma ? $sma->jumlah_guru : 0) }}" min="0" required>
                </div>
                <div class="pf-form-group" style="margin-bottom: 0;">
                    <label class="pf-label" for="sma_jumlah_tendik">Total Tendik</label>
                    <input type="number" id="sma_jumlah_tendik" name="sma_jumlah_tendik" class="pf-textarea" style="min-height: 42px; height: 42px; padding: 6px 12px;"
                           value="{{ old('sma_jumlah_tendik', $sma ? $sma->jumlah_tendik : 0) }}" min="0" required>
                </div>
                <div class="pf-form-group" style="margin-bottom: 0;">
                    <label class="pf-label" for="sma_jumlah_siswa">Total Siswa</label>
                    <input type="number" id="sma_jumlah_siswa" name="sma_jumlah_siswa" class="pf-textarea" style="min-height: 42px; height: 42px; padding: 6px 12px;"
                           value="{{ old('sma_jumlah_siswa', $sma ? $sma->jumlah_siswa : 0) }}" min="0" required>
                </div>
                <div class="pf-form-group" style="margin-bottom: 0;">
                    <label class="pf-label" for="sma_jumlah_prestasi">Total Prestasi</label>
                    <input type="number" id="sma_jumlah_prestasi" name="sma_jumlah_prestasi" class="pf-textarea" style="min-height: 42px; height: 42px; padding: 6px 12px;"
                           value="{{ old('sma_jumlah_prestasi', $sma ? $sma->jumlah_prestasi : 0) }}" min="0" required>
                </div>
            </div>

            <div class="pf-form-group">
                <label class="pf-label" for="sma_prestasi_unggulan">
                    Prestasi Unggulan &amp; Kebanggaan Nasional
                    <span class="pf-label-hint">Tuliskan prestasi per baris (tekan Enter untuk membuat poin baru)</span>
                </label>
                <textarea id="sma_prestasi_unggulan" name="sma_prestasi_unggulan" class="pf-textarea use-ckeditor" style="min-height: 100px;"
                          placeholder="Contoh:&#10;Juara 1 OSN Fisika Tingkat Nasional 2026&#10;Juara Umum FLS2N Tingkat Provinsi">{{ old('sma_prestasi_unggulan', $sma ? $sma->prestasi_unggulan : '') }}</textarea>
            </div>
        </div>

        {{-- SECTION 2: SMK --}}
        <div style="border-bottom: 2px solid #f1f5f9; padding-bottom: 30px; margin-bottom: 30px;">
            <h3 style="font-size: 16px; font-weight: 800; color: #0b1f3f; margin: 0 0 16px; display: flex; align-items: center; gap: 8px;">
                <span style="background: #0b1f3f; color: white; width: 26px; height: 26px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 13px;">2</span>
                Forum Komunikasi SMK (Sekolah Menengah Kejuruan)
            </h3>

            <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 16px; margin-bottom: 16px;">
                <div class="pf-form-group" style="margin-bottom: 0;">
                    <label class="pf-label" for="smk_title">Judul Halaman</label>
                    <input type="text" id="smk_title" name="smk_title" class="pf-textarea" style="min-height: 42px; height: 42px; padding: 6px 12px;"
                           value="{{ old('smk_title', $smk ? $smk->title : '') }}" required>
                </div>
                <div class="pf-form-group" style="margin-bottom: 0;">
                    <label class="pf-label">Unggah Foto Baru (Bisa pilih banyak)</label>
                    <input type="file" name="smk_images[]" class="pf-textarea" style="padding: 8px 12px; cursor: pointer;" accept="image/*" multiple>
                </div>
            </div>

            {{-- SMK Current Images Gallery --}}
            @if($smk && !empty($smk->image))
            <div class="pf-form-group" style="margin-bottom: 16px;">
                <label class="pf-label" style="margin-bottom: 8px;">Foto Kegiatan Saat Ini <span style="font-size: 11px; color: var(--text-muted); font-weight: normal;">(Centang foto untuk menghapus)</span></label>
                <div style="display: flex; flex-wrap: wrap; gap: 12px; background: #f8fafc; padding: 14px; border-radius: 10px; border: 1px solid var(--border);">
                    @foreach((array)$smk->image as $img)
                    <label style="position: relative; cursor: pointer; display: block;">
                        <input type="checkbox" name="smk_delete_images[]" value="{{ $img }}" style="position: absolute; top: 6px; left: 6px; width: 18px; height: 18px; accent-color: #dc2626;">
                        <img src="{{ asset('storage/' . $img) }}" style="width: 120px; height: 80px; object-fit: cover; border-radius: 6px; border: 1px solid #e2e8f0; display: block;">
                        <div style="position: absolute; bottom: 4px; right: 4px; background: rgba(220, 38, 38, 0.85); color: white; font-size: 9.5px; padding: 2px 6px; border-radius: 4px; font-weight: bold;">✕ Hapus</div>
                    </label>
                    @endforeach
                </div>
            </div>
            @endif

            <div class="pf-form-group">
                <label class="pf-label" for="smk_content">Deskripsi / Selayang Pandang</label>
                <textarea id="smk_content" name="smk_content" class="pf-textarea use-ckeditor" style="min-height: 100px;" required>{{ old('smk_content', $smk ? $smk->content : '') }}</textarea>
            </div>

            {{-- Stats Grid (5 Columns) --}}
            <div style="display: grid; grid-template-columns: repeat(5, 1fr); gap: 16px; margin-bottom: 16px;">
                <div class="pf-form-group" style="margin-bottom: 0;">
                    <label class="pf-label" for="smk_jumlah_sekolah">Total Sekolah</label>
                    <input type="number" id="smk_jumlah_sekolah" name="smk_jumlah_sekolah" class="pf-textarea" style="min-height: 42px; height: 42px; padding: 6px 12px;"
                           value="{{ old('smk_jumlah_sekolah', $smk ? $smk->jumlah_sekolah : 0) }}" min="0" required>
                </div>
                <div class="pf-form-group" style="margin-bottom: 0;">
                    <label class="pf-label" for="smk_jumlah_guru">Total Guru</label>
                    <input type="number" id="smk_jumlah_guru" name="smk_jumlah_guru" class="pf-textarea" style="min-height: 42px; height: 42px; padding: 6px 12px;"
                           value="{{ old('smk_jumlah_guru', $smk ? $smk->jumlah_guru : 0) }}" min="0" required>
                </div>
                <div class="pf-form-group" style="margin-bottom: 0;">
                    <label class="pf-label" for="smk_jumlah_tendik">Total Tendik</label>
                    <input type="number" id="smk_jumlah_tendik" name="smk_jumlah_tendik" class="pf-textarea" style="min-height: 42px; height: 42px; padding: 6px 12px;"
                           value="{{ old('smk_jumlah_tendik', $smk ? $smk->jumlah_tendik : 0) }}" min="0" required>
                </div>
                <div class="pf-form-group" style="margin-bottom: 0;">
                    <label class="pf-label" for="smk_jumlah_siswa">Total Siswa</label>
                    <input type="number" id="smk_jumlah_siswa" name="smk_jumlah_siswa" class="pf-textarea" style="min-height: 42px; height: 42px; padding: 6px 12px;"
                           value="{{ old('smk_jumlah_siswa', $smk ? $smk->jumlah_siswa : 0) }}" min="0" required>
                </div>
                <div class="pf-form-group" style="margin-bottom: 0;">
                    <label class="pf-label" for="smk_jumlah_prestasi">Total Prestasi</label>
                    <input type="number" id="smk_jumlah_prestasi" name="smk_jumlah_prestasi" class="pf-textarea" style="min-height: 42px; height: 42px; padding: 6px 12px;"
                           value="{{ old('smk_jumlah_prestasi', $smk ? $smk->jumlah_prestasi : 0) }}" min="0" required>
                </div>
            </div>

            <div class="pf-form-group">
                <label class="pf-label" for="smk_prestasi_unggulan">
                    Prestasi Unggulan &amp; Kebanggaan Nasional
                    <span class="pf-label-hint">Tuliskan prestasi per baris (tekan Enter untuk membuat poin baru)</span>
                </label>
                <textarea id="smk_prestasi_unggulan" name="smk_prestasi_unggulan" class="pf-textarea use-ckeditor" style="min-height: 100px;"
                          placeholder="Contoh:&#10;Juara 1 LKS Nasional Bidang Web Technologies 2026&#10;Juara 1 Nasional Kompetisi Robot Pintar Indonesia">{{ old('smk_prestasi_unggulan', $smk ? $smk->prestasi_unggulan : '') }}</textarea>
            </div>
        </div>

        {{-- SECTION 3: PK/PLK --}}
        <div style="padding-bottom: 20px; margin-bottom: 20px;">
            <h3 style="font-size: 16px; font-weight: 800; color: #0b1f3f; margin: 0 0 16px; display: flex; align-items: center; gap: 8px;">
                <span style="background: #0b1f3f; color: white; width: 26px; height: 26px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 13px;">3</span>
                Forum Komunikasi PK/PLK (Pendidikan Khusus / SLB)
            </h3>

            <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 16px; margin-bottom: 16px;">
                <div class="pf-form-group" style="margin-bottom: 0;">
                    <label class="pf-label" for="pk_title">Judul Halaman</label>
                    <input type="text" id="pk_title" name="pk_title" class="pf-textarea" style="min-height: 42px; height: 42px; padding: 6px 12px;"
                           value="{{ old('pk_title', $pk ? $pk->title : '') }}" required>
                </div>
                <div class="pf-form-group" style="margin-bottom: 0;">
                    <label class="pf-label">Unggah Foto Baru (Bisa pilih banyak)</label>
                    <input type="file" name="pk_images[]" class="pf-textarea" style="padding: 8px 12px; cursor: pointer;" accept="image/*" multiple>
                </div>
            </div>

            {{-- PK Current Images Gallery --}}
            @if($pk && !empty($pk->image))
            <div class="pf-form-group" style="margin-bottom: 16px;">
                <label class="pf-label" style="margin-bottom: 8px;">Foto Kegiatan Saat Ini <span style="font-size: 11px; color: var(--text-muted); font-weight: normal;">(Centang foto untuk menghapus)</span></label>
                <div style="display: flex; flex-wrap: wrap; gap: 12px; background: #f8fafc; padding: 14px; border-radius: 10px; border: 1px solid var(--border);">
                    @foreach((array)$pk->image as $img)
                    <label style="position: relative; cursor: pointer; display: block;">
                        <input type="checkbox" name="pk_delete_images[]" value="{{ $img }}" style="position: absolute; top: 6px; left: 6px; width: 18px; height: 18px; accent-color: #dc2626;">
                        <img src="{{ asset('storage/' . $img) }}" style="width: 120px; height: 80px; object-fit: cover; border-radius: 6px; border: 1px solid #e2e8f0; display: block;">
                        <div style="position: absolute; bottom: 4px; right: 4px; background: rgba(220, 38, 38, 0.85); color: white; font-size: 9.5px; padding: 2px 6px; border-radius: 4px; font-weight: bold;">✕ Hapus</div>
                    </label>
                    @endforeach
                </div>
            </div>
            @endif

            <div class="pf-form-group">
                <label class="pf-label" for="pk_content">Deskripsi / Selayang Pandang</label>
                <textarea id="pk_content" name="pk_content" class="pf-textarea use-ckeditor" style="min-height: 100px;" required>{{ old('pk_content', $pk ? $pk->content : '') }}</textarea>
            </div>

            {{-- Stats Grid (5 Columns) --}}
            <div style="display: grid; grid-template-columns: repeat(5, 1fr); gap: 16px; margin-bottom: 16px;">
                <div class="pf-form-group" style="margin-bottom: 0;">
                    <label class="pf-label" for="pk_jumlah_sekolah">Total Sekolah</label>
                    <input type="number" id="pk_jumlah_sekolah" name="pk_jumlah_sekolah" class="pf-textarea" style="min-height: 42px; height: 42px; padding: 6px 12px;"
                           value="{{ old('pk_jumlah_sekolah', $pk ? $pk->jumlah_sekolah : 0) }}" min="0" required>
                </div>
                <div class="pf-form-group" style="margin-bottom: 0;">
                    <label class="pf-label" for="pk_jumlah_guru">Total Guru</label>
                    <input type="number" id="pk_jumlah_guru" name="pk_jumlah_guru" class="pf-textarea" style="min-height: 42px; height: 42px; padding: 6px 12px;"
                           value="{{ old('pk_jumlah_guru', $pk ? $pk->jumlah_guru : 0) }}" min="0" required>
                </div>
                <div class="pf-form-group" style="margin-bottom: 0;">
                    <label class="pf-label" for="pk_jumlah_tendik">Total Tendik</label>
                    <input type="number" id="pk_jumlah_tendik" name="pk_jumlah_tendik" class="pf-textarea" style="min-height: 42px; height: 42px; padding: 6px 12px;"
                           value="{{ old('pk_jumlah_tendik', $pk ? $pk->jumlah_tendik : 0) }}" min="0" required>
                </div>
                <div class="pf-form-group" style="margin-bottom: 0;">
                    <label class="pf-label" for="pk_jumlah_siswa">Total Siswa</label>
                    <input type="number" id="pk_jumlah_siswa" name="pk_jumlah_siswa" class="pf-textarea" style="min-height: 42px; height: 42px; padding: 6px 12px;"
                           value="{{ old('pk_jumlah_siswa', $pk ? $pk->jumlah_siswa : 0) }}" min="0" required>
                </div>
                <div class="pf-form-group" style="margin-bottom: 0;">
                    <label class="pf-label" for="pk_jumlah_prestasi">Total Prestasi</label>
                    <input type="number" id="pk_jumlah_prestasi" name="pk_jumlah_prestasi" class="pf-textarea" style="min-height: 42px; height: 42px; padding: 6px 12px;"
                           value="{{ old('pk_jumlah_prestasi', $pk ? $pk->jumlah_prestasi : 0) }}" min="0" required>
                </div>
            </div>

            <div class="pf-form-group">
                <label class="pf-label" for="pk_prestasi_unggulan">
                    Prestasi Unggulan &amp; Kebanggaan Nasional
                    <span class="pf-label-hint">Tuliskan prestasi per baris (tekan Enter untuk membuat poin baru)</span>
                </label>
                <textarea id="pk_prestasi_unggulan" name="pk_prestasi_unggulan" class="pf-textarea use-ckeditor" style="min-height: 100px;"
                          placeholder="Contoh:&#10;Medali Perak LKSN ABK Bidang Membatik 2026&#10;Medali Perak O2SN Disabilitas (Lari 100m) 2026">{{ old('pk_prestasi_unggulan', $pk ? $pk->prestasi_unggulan : '') }}</textarea>
            </div>
        </div>

        <div class="pf-actions">
            <button type="submit" class="pf-btn-save"><i class="bi bi-floppy"></i> Simpan Seluruh Perubahan MKKS</button>
        </div>
    </form>
</div>

@endsection
