\@extends('layouts.admin')

@section('title', 'Kelola Profil Lembaga - Cabdin Gresik')

@section('content')

{{-- Page Header --}}
<div class="pf-header">
    <div class="pf-header-icon"><i class="bi bi-person-workspace"></i></div>
    <div>
        <h2 class="pf-header-title">Profil Lembaga</h2>
        <p class="pf-header-sub">Kelola deskripsi, foto, visi misi, dan struktur organisasi lembaga.</p>
    </div>
</div>

<form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
    @csrf

    {{-- ── SECTION 1: TENTANG KAMI ── --}}
    <div class="pf-card">
        <div class="pf-card-header">
            <span class="pf-badge">1</span>
            <div>
                <h3 class="pf-section-title">Tentang Kami</h3>
                <p class="pf-section-sub">Deskripsi umum mengenai Cabang Dinas Pendidikan Wilayah Gresik.</p>
            </div>
        </div>
        <div class="pf-card-body">
            <div class="pf-two-col">

                {{-- Foto --}}
                <div class="pf-form-group">
                    <label class="pf-label">
                        <i class="bi bi-image pf-label-icon"></i> Foto Ilustrasi
                        <span class="pf-label-hint">JPG, PNG, WEBP &middot; maks 5MB</span>
                    </label>
                    <div class="pf-img-box" onclick="document.getElementById('about_image_input').click()">
                        @if($about && $about->image)
                            <img src="{{ asset('storage/' . $about->image) }}" alt="Foto Tentang Kami" id="about-preview-img" class="pf-img-thumb">
                            <div class="pf-img-overlay"><i class="bi bi-camera"></i> Ganti Foto</div>
                        @else
                            <div class="pf-img-placeholder" id="about-placeholder">
                                <i class="bi bi-image"></i>
                                <span>Belum ada foto</span>
                                <small>Klik untuk memilih</small>
                            </div>
                            <img src="" alt="" id="about-preview-img" class="pf-img-thumb" style="display:none">
                        @endif
                    </div>
                    <input type="file" id="about_image_input" name="about_image" accept="image/*" style="display:none"
                           onchange="previewImg(this,'about-preview-img','about-placeholder')">
                    <button type="button" class="pf-upload-btn" onclick="document.getElementById('about_image_input').click()">
                        <i class="bi bi-upload"></i> Pilih Foto
                    </button>
                </div>

                {{-- Teks --}}
                <div class="pf-form-group">
                    <label class="pf-label" for="about_content">
                        <i class="bi bi-text-paragraph pf-label-icon"></i> Isi Teks Tentang Kami
                    </label>
                    <textarea id="about_content" name="about_content" class="pf-textarea use-ckeditor" required>{{ old('about_content', $about ? $about->content : '') }}</textarea>
                </div>
            </div>
        </div>
    </div>

    {{-- ── SECTION 2: VISI & MISI ── --}}
    <div class="pf-card">
        <div class="pf-card-header">
            <span class="pf-badge">2</span>
            <div>
                <h3 class="pf-section-title">Visi &amp; Misi</h3>
                <p class="pf-section-sub">Rumusan visi dan misi lembaga untuk halaman publik.</p>
            </div>
        </div>
        <div class="pf-card-body">
            <div class="pf-form-group">
                <label class="pf-label" for="visi_misi_content">
                    <i class="bi bi-bullseye pf-label-icon"></i> Isi Visi &amp; Misi
                    <span class="pf-label-hint">Gunakan teks berformat untuk poin-poin yang rapi.</span>
                </label>
                <textarea id="visi_misi_content" name="visi_misi_content" class="pf-textarea use-ckeditor" style="min-height:200px" required>{{ old('visi_misi_content', $visiMisi ? $visiMisi->content : '') }}</textarea>
            </div>
        </div>
    </div>

    {{-- ── SECTION 3: STRUKTUR ORGANISASI ── --}}
    <div class="pf-card">
        <div class="pf-card-header">
            <span class="pf-badge">3</span>
            <div>
                <h3 class="pf-section-title">Struktur Organisasi</h3>
                <p class="pf-section-sub">Bagan dan deskripsi susunan organisasi Cabdin Gresik.</p>
            </div>
        </div>
        <div class="pf-card-body">
            <div class="pf-form-group" style="margin-bottom:20px">
                <label class="pf-label" for="struktur_content">
                    <i class="bi bi-card-text pf-label-icon"></i> Pengantar / Deskripsi Struktur
                </label>
                <textarea id="struktur_content" name="struktur_content" class="pf-textarea use-ckeditor" style="min-height:100px">{{ old('struktur_content', $struktur ? $struktur->content : '') }}</textarea>
            </div>

            <div class="pf-form-group">
                <label class="pf-label">
                    <i class="bi bi-diagram-3 pf-label-icon"></i> Bagan Struktur Organisasi
                    <span class="pf-label-hint">JPG, PNG &middot; maks 5MB</span>
                </label>
                <div class="pf-img-box pf-img-box--wide" onclick="document.getElementById('struktur_image_input').click()">
                    @if($struktur && $struktur->image)
                        <img src="{{ asset('storage/' . $struktur->image) }}" alt="Bagan Struktur" id="struktur-preview-img" class="pf-img-thumb" style="object-fit:contain">
                        <div class="pf-img-overlay"><i class="bi bi-camera"></i> Ganti Bagan</div>
                    @else
                        <div class="pf-img-placeholder" id="struktur-placeholder">
                            <i class="bi bi-diagram-3"></i>
                            <span>Bagan belum diunggah</span>
                            <small>Klik untuk memilih</small>
                        </div>
                        <img src="" alt="" id="struktur-preview-img" class="pf-img-thumb" style="display:none;object-fit:contain">
                    @endif
                </div>
                <input type="file" id="struktur_image_input" name="struktur_image" accept="image/*" style="display:none"
                       onchange="previewImg(this,'struktur-preview-img','struktur-placeholder')">
                <button type="button" class="pf-upload-btn" onclick="document.getElementById('struktur_image_input').click()">
                    <i class="bi bi-upload"></i> Pilih Bagan Baru
                </button>
            </div>
        </div>
    </div>

        {{-- ── SECTION 3B: PROFIL PEJABAT STRUKTURAL ── --}}
    <div class="pf-card">
        <div class="pf-card-header" style="border-bottom-color: var(--secondary);">
            <span class="pf-badge" style="background-color: var(--secondary);">3B</span>
            <div>
                <h3 class="pf-section-title">Profil Pejabat Struktural</h3>
                <p class="pf-section-sub">Tambahkan maksimal 4 profil pejabat yang akan ditampilkan 2 kolom x 2 baris di bawah bagan struktur.</p>
            </div>
        </div>
        <div class="pf-card-body">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                
                @for($i = 1; $i <= 4; $i++)
                @php
                    $orgKey = 'org' . $i;
                    $orgDataObj = $$orgKey;
                    $orgData = $orgDataObj && $orgDataObj->content ? json_decode($orgDataObj->content, true) : null;
                @endphp
                <div style="border: 1px solid var(--border); padding: 15px; border-radius: var(--radius-sm); background: #f8fafc;">
                    <h4 style="font-size: 14px; font-weight: 700; color: var(--primary); margin-bottom: 15px; border-bottom: 1px solid var(--border); padding-bottom: 8px;">Profil {{ $i }}</h4>
                    
                    <div style="display: flex; gap: 15px;">
                        <div style="flex-shrink: 0; width: 120px;">
                            <label class="pf-label" style="font-size: 11px;">Foto Resmi</label>
                            <div class="pf-img-box" style="height: 150px; cursor: pointer;" onclick="document.getElementById('org_image_input_{{ $i }}').click()">
                                @if($orgDataObj && $orgDataObj->image)
                                    <img src="{{ asset('storage/' . $orgDataObj->image) }}" id="org-preview-img-{{ $i }}" class="pf-img-thumb" style="object-fit:cover">
                                    <div class="pf-img-overlay" style="font-size: 10px;"><i class="bi bi-camera"></i> Ganti Foto</div>
                                @else
                                    <div class="pf-img-placeholder" id="org-placeholder-{{ $i }}">
                                        <i class="bi bi-person-bounding-box" style="font-size: 20px;"></i>
                                        <small style="font-size: 10px;">Klik Upload</small>
                                    </div>
                                    <img src="" id="org-preview-img-{{ $i }}" class="pf-img-thumb" style="display:none;object-fit:cover">
                                @endif
                            </div>
                            <input type="file" id="org_image_input_{{ $i }}" name="org_image_{{ $i }}" accept="image/*" style="display:none" onchange="previewImg(this,'org-preview-img-{{ $i }}','org-placeholder-{{ $i }}')">
                        </div>

                        <div style="flex-grow: 1; display: flex; flex-direction: column; gap: 10px;">
                            <div>
                                <label class="pf-label" style="font-size: 12px; margin-bottom: 4px;">Nama Lengkap & Gelar</label>
                                <input type="text" name="org_name_{{ $i }}" class="form-control" style="font-size: 13px; padding: 6px 10px;" value="{{ old('org_name_'.$i, $orgData['name'] ?? '') }}">
                            </div>
                            <div>
                                <label class="pf-label" style="font-size: 12px; margin-bottom: 4px;">Jabatan</label>
                                <input type="text" name="org_position_{{ $i }}" class="form-control" style="font-size: 13px; padding: 6px 10px;" value="{{ old('org_position_'.$i, $orgData['position'] ?? '') }}">
                            </div>
                            <div>
                                <label class="pf-label" style="font-size: 12px; margin-bottom: 4px;">NIP</label>
                                <input type="text" name="org_nip_{{ $i }}" class="form-control" style="font-size: 13px; padding: 6px 10px;" value="{{ old('org_nip_'.$i, $orgData['nip'] ?? '') }}">
                            </div>
                        </div>
                    </div>
                </div>
                @endfor

            </div>
        </div>
    </div>

    {{-- ── SECTION 4: SAMBUTAN KEPALA CABANG DINAS ── --}}
    <div class="pf-card">
        <div class="pf-card-header">
            <span class="pf-badge">4</span>
            <div>
                <h3 class="pf-section-title">Sambutan Kepala Cabang Dinas</h3>
                <p class="pf-section-sub">Kelola nama, jabatan, foto, dan isi sambutan Kepala Cabang Dinas di halaman beranda.</p>
            </div>
        </div>
        <div class="pf-card-body">
            <div class="pf-two-col" style="margin-bottom: 20px;">
                {{-- Foto --}}
                <div class="pf-form-group">
                    <label class="pf-label">
                        <i class="bi bi-person-bounding-box pf-label-icon"></i> Foto Kepala Cabdin
                        <span class="pf-label-hint">JPG, PNG, WEBP &middot; maks 5MB</span>
                    </label>
                    <div class="pf-img-box" onclick="document.getElementById('sambutan_image_input').click()">
                        @if($sambutanFoto && $sambutanFoto->image)
                            <img src="{{ asset('storage/' . $sambutanFoto->image) }}" alt="Foto Kepala Cabdin" id="sambutan-preview-img" class="pf-img-thumb">
                            <div class="pf-img-overlay"><i class="bi bi-camera"></i> Ganti Foto</div>
                        @else
                            <div class="pf-img-placeholder" id="sambutan-placeholder">
                                <i class="bi bi-person-fill" style="font-size: 34px;"></i>
                                <span>Gunakan foto bawaan</span>
                                <small>Klik untuk mengunggah baru</small>
                            </div>
                            <img src="" alt="" id="sambutan-preview-img" class="pf-img-thumb" style="display:none">
                        @endif
                    </div>
                    <input type="file" id="sambutan_image_input" name="sambutan_image" accept="image/*" style="display:none"
                           onchange="previewImg(this,'sambutan-preview-img','sambutan-placeholder')">
                    <button type="button" class="pf-upload-btn" onclick="document.getElementById('sambutan_image_input').click()">
                        <i class="bi bi-upload"></i> Pilih Foto Baru
                    </button>
                </div>

                {{-- Detail --}}
                <div style="display: flex; flex-direction: column; gap: 15px;">
                    <div class="pf-form-group">
                        <label class="pf-label" for="sambutan_nama">Nama Kepala Cabang Dinas</label>
                        <input type="text" id="sambutan_nama" name="sambutan_nama" class="pf-textarea" style="min-height: 42px; height: 42px; padding: 6px 12px;" required
                               value="{{ old('sambutan_nama', $sambutanNama ? $sambutanNama->content : 'Dr. S. Hariyanto, S.Pd., M.M.') }}">
                    </div>
                    <div class="pf-form-group">
                        <label class="pf-label" for="sambutan_title">Jabatan / Gelar</label>
                        <input type="text" id="sambutan_title" name="sambutan_title" class="pf-textarea" style="min-height: 42px; height: 42px; padding: 6px 12px;" required
                               value="{{ old('sambutan_title', $sambutanTitle ? $sambutanTitle->content : 'Kepala Cabang Dinas Pendidikan Gresik') }}">
                    </div>
                </div>
            </div>

            <div class="pf-form-group">
                <label class="pf-label" for="sambutan_text">Isi Teks Sambutan</label>
                <textarea id="sambutan_text" name="sambutan_text" class="pf-textarea use-ckeditor" style="min-height:120px" required>{{ old('sambutan_text', $sambutanTeks ? ($sambutanTeks->content) : "Assalamu’alaikum Warahmatullahi Wabarakatuh,\n\nSelamat datang di portal informasi resmi Cabang Dinas Pendidikan Wilayah Kabupaten Gresik. Kami berkomitmen memberikan pelayanan prima, transparan, dan akuntabel guna mendukung akselerasi mutu pendidikan menengah atas, kejuruan, serta pendidikan khusus di wilayah Kabupaten Gresik demi mencetak generasi unggul yang berkarakter Jawa Timur.") }}</textarea>
            </div>
        </div>
    </div>

    {{-- ── SECTION 5: SLIDE SAMPING / BANNER PROMOSI ── --}}
    <div class="pf-card">
        <div class="pf-card-header">
            <span class="pf-badge">5</span>
            <div>
                <h3 class="pf-section-title">Gambar Slide Samping</h3>
                <p class="pf-section-sub">Kelola 2 gambar yang bergeser otomatis di samping sambutan kepala dinas.</p>
            </div>
        </div>
        <div class="pf-card-body">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                {{-- Slide 1 --}}
                <div class="pf-form-group">
                    <label class="pf-label">
                        <i class="bi bi-image pf-label-icon"></i> Gambar Slide 1
                        <span class="pf-label-hint">Aspek Rasio 4:5 dianjurkan &middot; maks 5MB</span>
                    </label>
                    <div class="pf-img-box pf-img-box--wide" onclick="document.getElementById('side_slider_1_input').click()">
                        @if($sideSlider1 && $sideSlider1->image)
                            <img src="{{ asset('storage/' . $sideSlider1->image) }}" alt="Slide 1" id="slider1-preview-img" class="pf-img-thumb">
                            <div class="pf-img-overlay"><i class="bi bi-camera"></i> Ganti Gambar</div>
                        @else
                            <div class="pf-img-placeholder" id="slider1-placeholder">
                                <i class="bi bi-images" style="font-size: 34px;"></i>
                                <span>Gunakan gambar bawaan 1</span>
                                <small>Klik untuk mengunggah baru</small>
                            </div>
                            <img src="" alt="" id="slider1-preview-img" class="pf-img-thumb" style="display:none">
                        @endif
                    </div>
                    <input type="file" id="side_slider_1_input" name="side_slider_1" accept="image/*" style="display:none"
                           onchange="previewImg(this,'slider1-preview-img','slider1-placeholder')">
                    <button type="button" class="pf-upload-btn" onclick="document.getElementById('side_slider_1_input').click()">
                        <i class="bi bi-upload"></i> Pilih Gambar 1
                    </button>
                </div>

                {{-- Slide 2 --}}
                <div class="pf-form-group">
                    <label class="pf-label">
                        <i class="bi bi-image pf-label-icon"></i> Gambar Slide 2
                        <span class="pf-label-hint">Aspek Rasio 4:5 dianjurkan &middot; maks 5MB</span>
                    </label>
                    <div class="pf-img-box pf-img-box--wide" onclick="document.getElementById('side_slider_2_input').click()">
                        @if($sideSlider2 && $sideSlider2->image)
                            <img src="{{ asset('storage/' . $sideSlider2->image) }}" alt="Slide 2" id="slider2-preview-img" class="pf-img-thumb">
                            <div class="pf-img-overlay"><i class="bi bi-camera"></i> Ganti Gambar</div>
                        @else
                            <div class="pf-img-placeholder" id="slider2-placeholder">
                                <i class="bi bi-images" style="font-size: 34px;"></i>
                                <span>Gunakan gambar bawaan 2</span>
                                <small>Klik untuk mengunggah baru</small>
                            </div>
                            <img src="" alt="" id="slider2-preview-img" class="pf-img-thumb" style="display:none">
                        @endif
                    </div>
                    <input type="file" id="side_slider_2_input" name="side_slider_2" accept="image/*" style="display:none"
                           onchange="previewImg(this,'slider2-preview-img','slider2-placeholder')">
                    <button type="button" class="pf-upload-btn" onclick="document.getElementById('side_slider_2_input').click()">
                        <i class="bi bi-upload"></i> Pilih Gambar 2
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- ── SECTION 6: QUOTES SLIDER ── --}}
    <div class="pf-card">
        <div class="pf-card-header">
            <span class="pf-badge">6</span>
            <div>
                <h3 class="pf-section-title">Quotes Slider (Banner Bawah Sambutan)</h3>
                <p class="pf-section-sub">Kelola 3 kutipan inspirasi pendidikan yang akan tampil sebagai slider.</p>
            </div>
        </div>
        <div class="pf-card-body">
            @for($i=1; $i<=3; $i++)
                @php
                    $qsData = ${"quoteSlide".$i};
                    $qsContent = $qsData && $qsData->content ? json_decode($qsData->content, true) : [];
                @endphp
                <div style="border: 1px solid #e2e8f0; border-radius: 8px; padding: 15px; margin-bottom: 20px; background: #f8fafc;">
                    <h4 style="font-size: 14px; color: #0b1f3f; margin-top: 0; margin-bottom: 15px; border-bottom: 1px solid #e2e8f0; padding-bottom: 8px;"><i class="bi bi-quote"></i> Slide Kutipan {{ $i }}</h4>
                    <div style="display: grid; grid-template-columns: 200px 1fr; gap: 20px;">
                        {{-- Gambar Background --}}
                        <div class="pf-form-group">
                            <label class="pf-label">Gambar Background</label>
                            <div class="pf-img-box pf-img-box--wide" onclick="document.getElementById('qs_image_{{ $i }}_input').click()" style="height: 120px;">
                                @if($qsData && $qsData->image)
                                    <img src="{{ asset('storage/' . $qsData->image) }}" alt="QS {{ $i }}" id="qs{{ $i }}-preview-img" class="pf-img-thumb">
                                    <div class="pf-img-overlay" style="font-size:11px;"><i class="bi bi-camera"></i> Ganti</div>
                                @else
                                    <div class="pf-img-placeholder" id="qs{{ $i }}-placeholder">
                                        <i class="bi bi-image" style="font-size: 24px;"></i>
                                        <small style="font-size:10px;">Bawaan/Upload</small>
                                    </div>
                                    <img src="" alt="" id="qs{{ $i }}-preview-img" class="pf-img-thumb" style="display:none">
                                @endif
                            </div>
                            <input type="file" id="qs_image_{{ $i }}_input" name="qs_image_{{ $i }}" accept="image/*" style="display:none" onchange="previewImg(this,'qs{{ $i }}-preview-img','qs{{ $i }}-placeholder')">
                        </div>

                        {{-- Teks --}}
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                            <div class="pf-form-group">
                                <label class="pf-label">Icon Badge (opsional)</label>
                                <input type="text" name="qs_badge_icon_{{ $i }}" class="pf-textarea" style="height:35px; min-height:35px; padding:4px 10px;" placeholder="Contoh: bi-mortarboard-fill" value="{{ $qsContent['badge_icon'] ?? '' }}">
                            </div>
                            <div class="pf-form-group">
                                <label class="pf-label">Teks Badge (opsional)</label>
                                <input type="text" name="qs_badge_text_{{ $i }}" class="pf-textarea" style="height:35px; min-height:35px; padding:4px 10px;" placeholder="Contoh: Pendidikan Gresik" value="{{ $qsContent['badge_text'] ?? '' }}">
                            </div>
                            <div class="pf-form-group" style="grid-column: span 2;">
                                <label class="pf-label">Isi Kutipan / Quotes</label>
                                <textarea name="qs_quote_{{ $i }}" class="pf-textarea" style="min-height: 60px; padding:8px 10px;" placeholder="Tuliskan kutipan di sini...">{{ $qsContent['quote'] ?? '' }}</textarea>
                            </div>
                            <div class="pf-form-group">
                                <label class="pf-label">Nama Penulis</label>
                                <input type="text" name="qs_author_{{ $i }}" class="pf-textarea" style="height:35px; min-height:35px; padding:4px 10px;" placeholder="Nama tokoh..." value="{{ $qsContent['author_name'] ?? '' }}">
                            </div>
                            <div class="pf-form-group">
                                <label class="pf-label">Jabatan Penulis</label>
                                <input type="text" name="qs_title_{{ $i }}" class="pf-textarea" style="height:35px; min-height:35px; padding:4px 10px;" placeholder="Jabatan..." value="{{ $qsContent['author_title'] ?? '' }}">
                            </div>
                        </div>
                    </div>
                </div>
            @endfor
        </div>
    </div>

    {{-- Actions --}}
    <div class="pf-actions">
        <button type="submit" class="pf-btn-save">
            <i class="bi bi-floppy"></i> Simpan Perubahan
        </button>
        <a href="{{ route('admin.dashboard') }}" class="pf-btn-cancel">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>
</form>

<style>
/* ─── Variables ─────────────────────────── */
.pf-header         { display:flex; align-items:center; gap:14px; margin-bottom:26px; }
.pf-header-icon    { width:44px; height:44px; border-radius:10px; background:#0b1f3f; display:flex; align-items:center; justify-content:center; color:#fff; font-size:20px; flex-shrink:0; }
.pf-header-title   { font-size:21px; font-weight:800; color:#0b1f3f; margin:0 0 3px; letter-spacing:-0.2px; }
.pf-header-sub     { font-size:13px; color:#64748b; margin:0; }

/* ─── Card ──────────────────────────────── */
.pf-card           { background:#fff; border:1px solid #e8edf3; border-radius:12px; box-shadow:0 1px 6px rgba(0,0,0,0.04); margin-bottom:18px; overflow:hidden; transition:box-shadow 0.2s; }
.pf-card:hover     { box-shadow:0 3px 14px rgba(0,0,0,0.07); }
.pf-card-header    { display:flex; align-items:flex-start; gap:13px; padding:18px 22px; border-bottom:1px solid #f0f4f8; background:#fafbfc; }
.pf-card-body      { padding:22px; }

.pf-badge          { display:flex; align-items:center; justify-content:center; width:30px; height:30px; border-radius:8px; background:#0b1f3f; color:#fff; font-size:13px; font-weight:800; flex-shrink:0; margin-top:2px; }
.pf-section-title  { font-size:14.5px; font-weight:700; color:#0b1f3f; margin:0 0 3px; }
.pf-section-sub    { font-size:12px; color:#64748b; margin:0; }

/* ─── Form ──────────────────────────────── */
.pf-two-col        { display:grid; grid-template-columns:260px 1fr; gap:22px; }
@media(max-width:768px){ .pf-two-col { grid-template-columns:1fr; } }
.pf-form-group     { display:flex; flex-direction:column; }
.pf-label          { display:block; font-size:12.5px; font-weight:700; color:#374151; margin-bottom:8px; }
.pf-label-icon     { color:#0b1f3f; margin-right:4px; }
.pf-label-hint     { display:block; font-size:11px; color:#94a3b8; font-weight:400; margin-top:2px; }

.pf-textarea       { width:100%; flex:1; border:1.5px solid #e2e8f0; border-radius:8px; padding:11px 13px; font-size:13.5px; color:#1e293b; resize:vertical; min-height:150px; font-family:inherit; line-height:1.65; transition:border-color 0.18s, box-shadow 0.18s; }
.pf-textarea:focus { outline:none; border-color:#0b1f3f; box-shadow:0 0 0 3px rgba(11,31,63,0.08); }

/* ─── Image Preview ─────────────────────── */
.pf-img-box        { position:relative; border:2px dashed #d1d5db; border-radius:10px; overflow:hidden; background:#f9fafb; cursor:pointer; height:155px; display:flex; align-items:center; justify-content:center; margin-bottom:10px; transition:border-color 0.18s; }
.pf-img-box--wide  { height:200px; }
.pf-img-box:hover  { border-color:#0b1f3f; }
.pf-img-placeholder{ display:flex; flex-direction:column; align-items:center; gap:5px; color:#94a3b8; text-align:center; padding:16px; }
.pf-img-placeholder i { font-size:34px; color:#cbd5e1; }
.pf-img-placeholder span { font-size:13px; font-weight:500; }
.pf-img-placeholder small { font-size:11px; color:#c4c9d0; }
.pf-img-thumb      { width:100%; height:100%; object-fit:cover; display:block; }
.pf-img-overlay    { position:absolute; inset:0; background:rgba(0,0,0,0.4); display:flex; align-items:center; justify-content:center; gap:7px; color:#fff; font-size:13px; font-weight:600; opacity:0; transition:opacity 0.18s; }
.pf-img-box:hover .pf-img-overlay { opacity:1; }

/* ─── Buttons ───────────────────────────── */
.pf-upload-btn     { display:inline-flex; align-items:center; gap:6px; padding:7px 13px; background:#f8fafc; border:1.5px solid #e2e8f0; color:#475569; border-radius:7px; font-size:12.5px; font-weight:600; cursor:pointer; transition:all 0.18s; }
.pf-upload-btn:hover { border-color:#94a3b8; color:#1e293b; }

.pf-actions        { display:flex; align-items:center; gap:11px; padding:6px 0 14px; }
.pf-btn-save       { display:inline-flex; align-items:center; gap:8px; padding:10px 22px; background:#0b1f3f; color:#fff; border:none; border-radius:9px; font-size:14px; font-weight:700; cursor:pointer; box-shadow:0 3px 12px rgba(11,31,63,0.25); transition:all 0.18s; }
.pf-btn-save:hover { background:#1e3a5f; box-shadow:0 5px 16px rgba(11,31,63,0.3); transform:translateY(-1px); }
.pf-btn-cancel     { display:inline-flex; align-items:center; gap:7px; padding:9px 16px; background:#fff; border:1.5px solid #e2e8f0; color:#64748b; border-radius:9px; font-size:13px; font-weight:600; text-decoration:none; transition:all 0.18s; }
.pf-btn-cancel:hover { border-color:#94a3b8; color:#1e293b; }
</style>

<script>
function previewImg(input, imgId, placeholderId) {
    if (!input.files || !input.files[0]) return;
    const reader = new FileReader();
    reader.onload = e => {
        const img = document.getElementById(imgId);
        const ph  = document.getElementById(placeholderId);
        img.src = e.target.result;
        img.style.display = 'block';
        if (ph) ph.style.display = 'none';
    };
    reader.readAsDataURL(input.files[0]);
}
</script>
@endsection
