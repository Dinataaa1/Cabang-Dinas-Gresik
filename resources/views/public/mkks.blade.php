@extends('layouts.public')

@section('title', 'MKKS ' . $categoryName . ' - Cabdin Wilayah Kabupaten Gresik')

@section('content')

<!-- PAGE HEADER -->
<section class="page-header">
    <div class="container">
        <h2>MKKS {{ $categoryName }}</h2>
        <div class="breadcrumb">
            <a href="{{ route('home') }}">Beranda</a> / Forum Komunikasi / MKKS {{ $categoryName }}
        </div>
    </div>
</section>

<!-- MAIN CONTENT -->
<section class="main-section" style="padding-top: 0;">
    <div class="container grid-2">
        
        <!-- KOLOM KIRI: DETAIL KONTEN MKKS -->
        <div class="col-left">
            @if($content)
                <div class="card" style="border-top: 4px solid var(--secondary); padding: 30px;">
                    
                    <h3 class="section-title" style="margin-bottom: 20px; font-weight: 800; color: var(--primary);">{{ $content->title }}</h3>

                    @php
                        $allPhotos = [];
                        if ($content && !empty($content->image)) {
                            $allPhotos = (array) $content->image;
                        }
                        $photoCount = count($allPhotos);
                    @endphp

                    <!-- Gambar Representatif MKKS / Slider -->
                    <div style="margin-bottom: 25px; border-radius: var(--radius-md); overflow: hidden; max-height: 380px; border: 1px solid var(--border); box-shadow: var(--shadow-sm); position: relative; background: #0b1f3f;">
                        @if($photoCount > 0)
                            <div id="main-slider" style="position: relative; height: 380px; overflow: hidden; width: 100%;">
                                @foreach($allPhotos as $pi => $photo)
                                    <img src="{{ asset('storage/' . $photo) }}" id="main-slide-{{ $pi }}" style="position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; transition: opacity .6s ease; opacity: {{ $pi === 0 ? 1 : 0 }};">
                                @endforeach
                                @if($photoCount > 1)
                                    <button onclick="mainPrev()" style="position: absolute; left: 14px; top: 50%; transform: translateY(-50%); background: rgba(0,0,0,.55); color: #fff; border: none; border-radius: 50%; width: 38px; height: 38px; font-size: 20px; cursor: pointer; z-index: 20; display: flex; align-items: center; justify-content: center; transition: background .2s;" onmouseover="this.style.background='rgba(0,0,0,0.7)'" onmouseout="this.style.background='rgba(0,0,0,.55)'">‹</button>
                                    <button onclick="mainNext()" style="position: absolute; right: 14px; top: 50%; transform: translateY(-50%); background: rgba(0,0,0,.55); color: #fff; border: none; border-radius: 50%; width: 38px; height: 38px; font-size: 20px; cursor: pointer; z-index: 20; display: flex; align-items: center; justify-content: center; transition: background .2s;" onmouseover="this.style.background='rgba(0,0,0,0.7)'" onmouseout="this.style.background='rgba(0,0,0,.55)'">›</button>
                                @endif
                                <div style="position: absolute; bottom: 14px; left: 50%; transform: translateX(-50%); display: flex; gap: 6px; z-index: 20;">
                                    @for($pi=0; $pi<$photoCount; $pi++)
                                        <button onclick="mainGoto({{ $pi }})" id="main-dot-{{ $pi }}" style="width: 9px; height: 9px; border-radius: 50%; border: none; cursor: pointer; background: {{ $pi === 0 ? '#fff' : 'rgba(255,255,255,.45)' }}; transition: background .3s;"></button>
                                    @endfor
                                </div>
                            </div>
                        @else
                            @php
                                $defaultImages = [
                                    'SMA' => 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?q=80&w=800&auto=format&fit=crop',
                                    'SMK' => 'https://images.unsplash.com/photo-1581092921461-eab62e97a780?q=80&w=800&auto=format&fit=crop',
                                    'PK/PLK' => 'https://images.unsplash.com/photo-1517486808906-6ca8b3f04846?q=80&w=800&auto=format&fit=crop'
                                ];
                                $defaultImage = $defaultImages[$categoryName] ?? $defaultImages['SMA'];
                            @endphp
                            <img src="{{ $defaultImage }}" alt="MKKS {{ $categoryName }} Kabupaten Gresik" style="width: 100%; height: 380px; display: block; object-fit: cover;">
                        @endif
                    </div>

                    <!-- Statistik Pendidikan Kategori (5 Premium Cards) -->
                    <style>
                        #stat-cards-container {
                            display: grid;
                            grid-template-columns: repeat(5, 1fr);
                            gap: 10px;
                            margin-bottom: 10px;
                        }
                        @media (max-width: 992px) {
                            #stat-cards-container {
                                grid-template-columns: repeat(3, 1fr) !important;
                            }
                        }
                        @media (max-width: 576px) {
                            #stat-cards-container {
                                grid-template-columns: repeat(2, 1fr) !important;
                            }
                        }
                    </style>
                    <div id="stat-cards-container">
                        {{-- Card 1: Sekolah --}}
                        <div id="stat-card-sekolah" class="stat-card" style="background: #f8fafc; border: 1px solid var(--border); border-radius: 14px; padding: 18px 8px; text-align: center; border-bottom: 3px solid #0f172a; transition: all .35s cubic-bezier(.4,0,.2,1); cursor: default;">
                            <div style="font-size: 22px; margin-bottom: 8px; color: #0f172a; transition: transform .35s ease;"><i class="bi bi-bank"></i></div>
                            <div id="stat-val-sekolah" style="font-size: 19px; font-weight: 900; color: #0f172a; letter-spacing: -0.5px; transition: all .35s ease;">{{ number_format($content->jumlah_sekolah ?? 0) }}</div>
                            <div id="stat-lbl-sekolah" style="font-size: 9.5px; font-weight: 700; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.6px; margin-top: 4px;">Total Sekolah</div>
                        </div>
                        {{-- Card 2: Guru --}}
                        <div id="stat-card-guru" class="stat-card" style="background: #f8fafc; border: 1px solid var(--border); border-radius: 14px; padding: 18px 8px; text-align: center; border-bottom: 3px solid var(--primary); transition: all .35s cubic-bezier(.4,0,.2,1); cursor: default;">
                            <div style="font-size: 22px; margin-bottom: 8px; color: var(--primary); transition: transform .35s ease;"><i class="bi bi-people-fill"></i></div>
                            <div id="stat-val-guru" style="font-size: 19px; font-weight: 900; color: #0f172a; letter-spacing: -0.5px; transition: all .35s ease;">{{ number_format($content->jumlah_guru) }}</div>
                            <div id="stat-lbl-guru" style="font-size: 9.5px; font-weight: 700; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.6px; margin-top: 4px;">Total Guru</div>
                        </div>
                        {{-- Card 3: Tendik --}}
                        <div id="stat-card-tendik" class="stat-card" style="background: #f8fafc; border: 1px solid var(--border); border-radius: 14px; padding: 18px 8px; text-align: center; border-bottom: 3px solid #7c3aed; transition: all .35s cubic-bezier(.4,0,.2,1); cursor: default;">
                            <div style="font-size: 22px; margin-bottom: 8px; color: #7c3aed; transition: transform .35s ease;"><i class="bi bi-person-fill-check"></i></div>
                            <div id="stat-val-tendik" style="font-size: 19px; font-weight: 900; color: #0f172a; letter-spacing: -0.5px; transition: all .35s ease;">{{ number_format($content->jumlah_tendik ?? 0) }}</div>
                            <div id="stat-lbl-tendik" style="font-size: 9.5px; font-weight: 700; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.6px; margin-top: 4px;">Total Tendik</div>
                        </div>
                        {{-- Card 4: Siswa --}}
                        <div id="stat-card-siswa" class="stat-card" style="background: #f8fafc; border: 1px solid var(--border); border-radius: 14px; padding: 18px 8px; text-align: center; border-bottom: 3px solid #0ea5e9; transition: all .35s cubic-bezier(.4,0,.2,1); cursor: default;">
                            <div style="font-size: 22px; margin-bottom: 8px; color: #0ea5e9; transition: transform .35s ease;"><i class="bi bi-mortarboard-fill"></i></div>
                            <div id="stat-val-siswa" style="font-size: 19px; font-weight: 900; color: #0f172a; letter-spacing: -0.5px; transition: all .35s ease;">{{ number_format($content->jumlah_siswa) }}</div>
                            <div id="stat-lbl-siswa" style="font-size: 9.5px; font-weight: 700; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.6px; margin-top: 4px;">Total Siswa</div>
                        </div>
                        {{-- Card 5: Prestasi --}}
                        <div id="stat-card-prestasi" class="stat-card" style="background: #f8fafc; border: 1px solid var(--border); border-radius: 14px; padding: 18px 8px; text-align: center; border-bottom: 3px solid #d97706; transition: all .35s cubic-bezier(.4,0,.2,1); cursor: default;">
                            <div style="font-size: 22px; margin-bottom: 8px; transition: transform .35s ease;"><i class="bi bi-trophy-fill" style="color: #d97706;"></i></div>
                            <div id="stat-val-prestasi" style="font-size: 19px; font-weight: 900; color: #0f172a; letter-spacing: -0.5px; transition: all .35s ease;">{{ number_format($content->jumlah_prestasi) }}</div>
                            <div id="stat-lbl-prestasi" style="font-size: 9.5px; font-weight: 700; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.6px; margin-top: 4px;">Total Prestasi</div>
                        </div>
                    </div>

                    {{-- Context indicator: shows selected school name or reset to category --}}
                    <div id="stat-context-bar" style="display: none; justify-content: space-between; align-items: center; background: linear-gradient(135deg, #0b1f3f, #1e3a5f); color: #fff; border-radius: 10px; padding: 9px 14px; font-size: 12px; font-weight: 600; margin-bottom: 22px; animation: fadeSlideDown .3s ease;">
                        <span><i class="bi bi-building" style="margin-right: 6px; color: #fbbf24;"></i><span id="stat-context-name">—</span></span>
                        <button onclick="resetStats()" style="background: rgba(255,255,255,.18); border: 1px solid rgba(255,255,255,.3); border-radius: 6px; color: #fff; font-size: 11px; padding: 3px 10px; cursor: pointer; display: flex; align-items: center; gap: 5px; font-weight: 700; transition: background .2s;" onmouseover="this.style.background='rgba(255,255,255,.3)'" onmouseout="this.style.background='rgba(255,255,255,.18)'">
                            <i class="bi bi-arrow-counterclockwise"></i> Reset ke Total {{ $categoryName }}
                        </button>
                    </div>
                    <style>
                        @keyframes fadeSlideDown { from{opacity:0;transform:translateY(-8px)} to{opacity:1;transform:translateY(0)} }
                        .stat-card:hover { transform: translateY(-3px); box-shadow: 0 8px 20px rgba(0,0,0,.1); }
                        .stat-card.school-mode { background: #fff9e6 !important; border-color: #fde68a !important; }
                        .stat-card.school-mode .stat-val-num { color: #92400e !important; }
                        @keyframes countPop { 0%{transform:scale(.85);opacity:.4} 60%{transform:scale(1.08)} 100%{transform:scale(1);opacity:1} }
                        .pop-anim { animation: countPop .45s cubic-bezier(.4,0,.2,1) forwards; }
                    </style>

                    <!-- Deskripsi & Isi -->
                    <div style="font-size: 14.5px; line-height: 1.8; color: var(--text-dark); text-align: justify; margin-bottom: 30px;">
                        {!! nl2br(e(strip_tags($content->content))) !!}
                    </div>

                    <!-- Prestasi Unggulan Kategori -->
                    @if($content->prestasi_unggulan)
                        <div style="background: #f8fafc; border: 1px solid var(--border); border-radius: 14px; padding: 24px; border-left: 5px solid var(--secondary); margin-bottom: 28px;">
                            <h4 style="font-size: 15px; font-weight: 800; color: var(--primary); margin: 0 0 16px; display: flex; align-items: center; gap: 8px;">
                                <i class="bi bi-trophy-fill" style="color: #d97706;"></i> Prestasi Unggulan &amp; Kebanggaan Nasional
                            </h4>
                            <div style="display: flex; flex-direction: column; gap: 12px;">
                                @foreach(explode("\n", str_replace("\r", "", $content->prestasi_unggulan)) as $prestasi)
                                    @if(trim($prestasi) != '')
                                        <div style="display: flex; align-items: flex-start; gap: 10px; font-size: 13.5px; color: #334155; line-height: 1.5;">
                                            <i class="bi bi-patch-check-fill" style="color: var(--primary); font-size: 16px; margin-top: 2px;"></i>
                                            <span>{{ preg_replace('/^\d+[\.\-\s]+/', '', trim($prestasi)) }}</span>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- ── Daftar Sekolah se-Kabupaten Gresik ── -->
                    @if($schools->count() > 0)
                        <div style="margin-top: 10px;">
                            <h4 style="font-size: 15px; font-weight: 800; color: var(--primary); margin: 0 0 16px; display: flex; align-items: center; gap: 8px; padding-bottom: 12px; border-bottom: 2px solid #f1f5f9;">
                                <i class="bi bi-bank"></i> Daftar Sekolah {{ $categoryName }} se-Kabupaten Gresik
                                <span style="font-size: 11px; background: #0b1f3f; color: #fff; padding: 2px 10px; border-radius: 20px; font-weight: 700; margin-left: auto;">{{ $schools->count() }} Sekolah</span>
                            </h4>

                            {{-- Search filter --}}
                            <input type="text" id="schoolSearch" onkeyup="filterSchools()" placeholder="Cari nama sekolah..." style="width: 100%; padding: 10px 14px; border: 1px solid var(--border); border-radius: 10px; font-size: 13px; margin-bottom: 14px; outline: none; background: #f8fafc; box-sizing: border-box; transition: border-color .2s;" onfocus="this.style.borderColor='var(--primary)'" onblur="this.style.borderColor='var(--border)'">

                             <div style="border: 1px solid var(--border); border-radius: 14px; overflow: hidden; background: #fff;">
                                {{-- Responsive scroll wrapper --}}
                                <div style="overflow-x: auto; -webkit-overflow-scrolling: touch;">
                                    <div style="min-width: 860px;">
                                        {{-- Header Row (sticky) --}}
                                        <div style="display: grid; grid-template-columns: 34px 1.8fr 72px 48px 48px 75px 75px 75px 60px 78px; gap: 8px; padding: 12px 14px; background: #0b1f3f; font-size: 9.5px; font-weight: 700; color: rgba(255,255,255,.85); text-transform: uppercase; letter-spacing: 0.3px; align-items: center;">
                                            <span>#</span>
                                            <span>Nama Sekolah</span>
                                            <span style="text-align: center;">Status</span>
                                            <span style="text-align: center;">Guru</span>
                                            <span style="text-align: center;">Tendik</span>
                                            <span style="text-align: center;">Kelas X<br><small style="font-size: 8px; opacity: 0.7;">L | P</small></span>
                                            <span style="text-align: center;">Kelas XI<br><small style="font-size: 8px; opacity: 0.7;">L | P</small></span>
                                            <span style="text-align: center;">Kelas XII<br><small style="font-size: 8px; opacity: 0.7;">L | P</small></span>
                                            <span style="text-align: center;">Siswa</span>
                                            <span style="text-align: center;">Prestasi</span>
                                        </div>
                                        {{-- School Rows: max 5 rows visible (~360px), then scroll --}}
                                        <div id="schoolList" style="max-height: 360px; overflow-y: auto; scroll-behavior: smooth;">
                                            @foreach($schools as $i => $school)
                                                <div id="school-row-{{ $school->id }}" class="school-row" style="display: grid; grid-template-columns: 34px 1.8fr 72px 48px 48px 75px 75px 75px 60px 78px; gap: 8px; padding: 11px 14px; border-bottom: 1px solid #f1f5f9; align-items: center; transition: background .15s;" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background=''">
                                                    <span style="font-size: 11px; color: #94a3b8; font-weight: 600;">{{ $i+1 }}</span>
                                                    <div>
                                                        <div style="font-size: 12.5px; font-weight: 700; color: #0b1f3f; line-height: 1.3;">{{ $school->name }}</div>
                                                        @if($school->address)<div style="font-size: 10.5px; color: #94a3b8; margin-top: 2px;"><i class="bi bi-geo-alt"></i> {{ $school->address }}</div>@endif
                                                        @if($school->website)
                                                            <div style="font-size: 10.5px; margin-top: 2px;">
                                                                <a href="{{ Str::startsWith($school->website, 'http') ? $school->website : 'http://' . $school->website }}" target="_blank" style="color: #0d9488; text-decoration: none; font-weight: 600;">
                                                                    <i class="bi bi-globe"></i> {{ $school->website }}
                                                                </a>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div style="text-align: center;">
                                                        <span style="padding: 2px 7px; border-radius: 12px; font-size: 9.5px; font-weight: 700; text-transform: uppercase; background: {{ $school->status == 'Negeri' ? '#eff6ff' : '#f5f3ff' }}; color: {{ $school->status == 'Negeri' ? '#1d4ed8' : '#7c3aed' }};">{{ $school->status }}</span>
                                                    </div>
                                                    <div style="text-align: center; font-size: 12px; font-weight: 700; color: #0b1f3f;">{{ number_format($school->jumlah_guru) }}</div>
                                                    <div style="text-align: center; font-size: 12px; font-weight: 700; color: #0b1f3f;">{{ number_format($school->jumlah_tendik) }}</div>
                                                    {{-- Kelas X --}}
                                                    <div style="text-align: center;">
                                                        <div style="font-size: 12px; font-weight: 700; color: #0b1f3f;">{{ number_format($school->siswa_x_l + $school->siswa_x_p) }}</div>
                                                        <div style="font-size: 9px; color: #64748b; margin-top: 1px;"><span style="color:#0284c7;">L:{{ $school->siswa_x_l }}</span> <span style="color:#ec4899;">P:{{ $school->siswa_x_p }}</span></div>
                                                    </div>
                                                    {{-- Kelas XI --}}
                                                    <div style="text-align: center;">
                                                        <div style="font-size: 12px; font-weight: 700; color: #0b1f3f;">{{ number_format($school->siswa_xi_l + $school->siswa_xi_p) }}</div>
                                                        <div style="font-size: 9px; color: #64748b; margin-top: 1px;"><span style="color:#0284c7;">L:{{ $school->siswa_xi_l }}</span> <span style="color:#ec4899;">P:{{ $school->siswa_xi_p }}</span></div>
                                                    </div>
                                                    {{-- Kelas XII --}}
                                                    <div style="text-align: center;">
                                                        <div style="font-size: 12px; font-weight: 700; color: #0b1f3f;">{{ number_format($school->siswa_xii_l + $school->siswa_xii_p) }}</div>
                                                        <div style="font-size: 9px; color: #64748b; margin-top: 1px;"><span style="color:#0284c7;">L:{{ $school->siswa_xii_l }}</span> <span style="color:#ec4899;">P:{{ $school->siswa_xii_p }}</span></div>
                                                    </div>
                                                    <div style="text-align: center; font-size: 12px; font-weight: 700; color: #0b1f3f;">{{ number_format($school->jumlah_siswa) }}</div>
                                                    <div style="text-align: center;">
                                                        <span style="background: #fef3c7; color: #d97706; padding: 2px 8px; border-radius: 20px; font-size: 11.5px; font-weight: 700;"><i class="bi bi-trophy-fill" style="font-size: 9px;"></i> {{ $school->jumlah_prestasi }}</span>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="text-align: right; margin-top: 8px; font-size: 11px; color: #94a3b8;">Data diperbarui oleh Cabdin Pendidikan Kabupaten Gresik</div>
                        </div>
                    @endif

                </div>
            @else
                <div class="card" style="text-align: center; color: var(--text-muted); padding: 50px;">
                    <i class="bi bi-bank" style="font-size: 40px; display: block; margin-bottom: 15px; color: var(--text-muted);"></i>
                    Informasi mengenai MKKS {{ $categoryName }} belum diunggah oleh administrator.
                </div>
            @endif
        </div>

        <!-- KOLOM KANAN: SIDEBAR -->
        <aside class="col-right">

            <!-- Widget Pencarian Statistik Sekolah (filter kategori aktif) -->
            <div class="widget">
                <h3 class="widget-title"><span><i class="bi bi-search"></i></span> Cari Sekolah {{ $categoryName }}</h3>
                <div style="font-size: 12px; line-height: 1.6; color: var(--text-muted); margin-bottom: 12px;">
                    Pilih sekolah <strong>{{ $categoryName }}</strong> untuk langsung melihat statistiknya:
                </div>
                <select id="schoolLookupSelect" onchange="lookupSchoolData(this.value)" style="width:100%; padding:10px; border:1px solid var(--border); border-radius:8px; font-size:13px; background:#fff; margin-bottom:14px; outline:none; cursor:pointer;">
                    <option value="">-- Pilih Sekolah {{ $categoryName }} --</option>
                    @foreach($schools as $sch)
                        <option value="{{ $sch->id }}" data-rowid="school-row-{{ $sch->id }}" data-status="{{ $sch->status }}" data-guru="{{ $sch->jumlah_guru }}" data-tendik="{{ $sch->jumlah_tendik }}" data-siswa="{{ $sch->jumlah_siswa }}" data-xl="{{ $sch->siswa_x_l }}" data-xp="{{ $sch->siswa_x_p }}" data-xil="{{ $sch->siswa_xi_l }}" data-xip="{{ $sch->siswa_xi_p }}" data-xiil="{{ $sch->siswa_xii_l }}" data-xiip="{{ $sch->siswa_xii_p }}" data-prestasi="{{ $sch->jumlah_prestasi }}" data-address="{{ $sch->address ?? 'Alamat belum diisi' }}" data-npsn="{{ $sch->npsn ?? '-' }}" data-website="{{ $sch->website ?? '' }}">
                            {{ $sch->name }}
                        </option>
                    @endforeach
                </select>

                {{-- Statistics Display Card (starts hidden until school selected) --}}
                <div id="schoolLookupCard" style="display:none; background:#f8fafc; border:1px solid var(--border); border-radius:10px; padding:14px;">
                    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:10px;">
                        <span id="lookupStatus" style="padding:2px 8px; border-radius:12px; font-size:10px; font-weight:700; text-transform:uppercase;"></span>
                        <span id="lookupNpsn" style="font-size:11px; font-family:monospace; color:#94a3b8;"></span>
                    </div>
                    <h5 id="lookupName" style="font-size:13px; font-weight:700; color:#0b1f3f; margin:0 0 10px; line-height:1.4;"></h5>
                    
                    <div style="display:flex; flex-direction:column; gap:8px; font-size:12.5px; color:#334155; margin-bottom:10px;">
                        <div style="display:flex; justify-content:space-between;"><span style="color:#64748b;"><i class="bi bi-people-fill"></i> Guru:</span><strong id="lookupGuru" style="margin-left:auto;"></strong></div>
                        <div style="display:flex; justify-content:space-between;"><span style="color:#64748b;"><i class="bi bi-person-fill-check"></i> Tendik:</span><strong id="lookupTendik" style="margin-left:auto;"></strong></div>
                        <div style="display:flex; justify-content:space-between; border-top: 1px dashed #e2e8f0; padding-top: 6px;"><span style="color:#64748b;"><i class="bi bi-mortarboard-fill"></i> Total Siswa:</span><strong id="lookupSiswa" style="margin-left:auto;"></strong></div>
                        <div style="display:flex; justify-content:space-between; font-size: 11.5px; padding-left: 12px;"><span style="color:#94a3b8;">Kelas X (L/P):</span><span id="lookupX" style="margin-left:auto; font-weight: 600;"></span></div>
                        <div style="display:flex; justify-content:space-between; font-size: 11.5px; padding-left: 12px;"><span style="color:#94a3b8;">Kelas XI (L/P):</span><span id="lookupXI" style="margin-left:auto; font-weight: 600;"></span></div>
                        <div style="display:flex; justify-content:space-between; font-size: 11.5px; padding-left: 12px;"><span style="color:#94a3b8;">Kelas XII (L/P):</span><span id="lookupXII" style="margin-left:auto; font-weight: 600;"></span></div>
                        <div style="display:flex; justify-content:space-between; border-top: 1px dashed #e2e8f0; padding-top: 6px;"><span style="color:#64748b;"><i class="bi bi-trophy-fill" style="color:#d97706;"></i> Prestasi:</span><strong id="lookupPrestasi" style="margin-left:auto; color:#d97706;"></strong></div>
                    </div>
                    <div style="font-size:11px; color:#94a3b8; border-top:1px solid #e2e8f0; padding-top:8px; line-height:1.4;"><i class="bi bi-geo-alt"></i> <span id="lookupAddress"></span></div>
                    <div id="lookupWebsiteWrapper" style="font-size:11px; margin-top:4px; display:none;"><i class="bi bi-globe" style="color:#0d9488;"></i> <a id="lookupWebsite" href="#" target="_blank" style="color:#0d9488; text-decoration:none; font-weight:600;"></a></div>
                </div>
            </div>
            
            <!-- Widget Menu MKKS Lainnya -->
            <div class="widget">
                <h3 class="widget-title"><span><i class="bi bi-bank"></i></span> Forum MKKS Lainnya</h3>
                <div class="quick-links">
                    <a href="{{ route('mkks.show', ['category' => 'sma']) }}" class="quick-link-item {{ $categoryName == 'SMA' ? 'active' : '' }}" style="{{ $categoryName == 'SMA' ? 'background-color: var(--primary-light); color: white; border-left-color: var(--accent);' : '' }}">
                        MKKS SMA Kabupaten Gresik
                    </a>
                    <a href="{{ route('mkks.show', ['category' => 'smk']) }}" class="quick-link-item {{ $categoryName == 'SMK' ? 'active' : '' }}" style="{{ $categoryName == 'SMK' ? 'background-color: var(--primary-light); color: white; border-left-color: var(--accent);' : '' }}">
                        MKKS SMK Kabupaten Gresik
                    </a>
                    <a href="{{ route('mkks.show', ['category' => 'pk-plk']) }}" class="quick-link-item {{ $categoryName == 'PK/PLK' ? 'active' : '' }}" style="{{ $categoryName == 'PK/PLK' ? 'background-color: var(--primary-light); color: white; border-left-color: var(--accent);' : '' }}">
                        MKKS PK/PLK (SLB) Gresik
                    </a>
                </div>
            </div>

            <!-- Widget Kontak / Layanan -->
            <div class="widget">
                <h3 class="widget-title"><span><i class="bi bi-pencil-square"></i></span> Koordinasi & Kerjasama</h3>
                <div style="font-size: 13px; line-height: 1.7; color: var(--text-muted);">
                    <p style="margin-bottom: 10px;">
                        Musyawarah Kerja Kepala Sekolah merupakan mitra strategis Cabang Dinas Pendidikan Wilayah Kabupaten Gresik. 
                    </p>
                    <p>
                        Untuk informasi kegiatan bersama, kerjasama industri, atau koordinasi antar-lembaga sekolah, silakan hubungi pengurus forum masing-masing seksi melalui dinas terkait.
                    </p>
                </div>
            </div>

        </aside>

    </div>
</section>

@endsection

@section('scripts')
<script>
function filterSchools() {
    let input = document.getElementById('schoolSearch').value.toLowerCase();
    let rows = document.getElementsByClassName('school-row');
    
    for (let i = 0; i < rows.length; i++) {
        let schoolName = rows[i].getElementsByTagName('div')[0].textContent.toLowerCase();
        if (schoolName.includes(input)) {
            rows[i].style.display = "grid";
        } else {
            rows[i].style.display = "none";
        }
    }
}

const defaultStats = {
    guru: "{{ number_format($content->jumlah_guru) }}",
    tendik: "{{ number_format($content->jumlah_tendik ?? 0) }}",
    siswa: "{{ number_format($content->jumlah_siswa) }}",
    prestasi: "{{ number_format($content->jumlah_prestasi) }}"
};

function lookupSchoolData(id) {
    let select = document.getElementById('schoolLookupSelect');
    let card = document.getElementById('schoolLookupCard');
    if (!id) {
        card.style.display = 'none';
        resetStats();
        return;
    }

    let opt = select.options[select.selectedIndex];
    let name = opt.text.trim();
    let rowId = opt.getAttribute('data-rowid');
    let status = opt.getAttribute('data-status');
    let npsn = opt.getAttribute('data-npsn');
    let rawGuru = opt.getAttribute('data-guru');
    let rawTendik = opt.getAttribute('data-tendik');
    let rawSiswa = opt.getAttribute('data-siswa');
    let rawPrestasi = opt.getAttribute('data-prestasi');

    let xl = parseInt(opt.getAttribute('data-xl') || 0);
    let xp = parseInt(opt.getAttribute('data-xp') || 0);
    let xil = parseInt(opt.getAttribute('data-xil') || 0);
    let xip = parseInt(opt.getAttribute('data-xip') || 0);
    let xiil = parseInt(opt.getAttribute('data-xiil') || 0);
    let xiip = parseInt(opt.getAttribute('data-xiip') || 0);
    
    let guru = parseInt(rawGuru).toLocaleString('id-ID');
    let tendik = parseInt(rawTendik).toLocaleString('id-ID');
    let siswa = parseInt(rawSiswa).toLocaleString('id-ID');
    let prestasi = parseInt(rawPrestasi).toLocaleString('id-ID');
    let address = opt.getAttribute('data-address');
    let website = opt.getAttribute('data-website');

    // Fill sidebar card details
    document.getElementById('lookupName').innerText = name;
    document.getElementById('lookupStatus').innerText = status;
    document.getElementById('lookupNpsn').innerText = 'NPSN: ' + npsn;
    document.getElementById('lookupGuru').innerText = guru;
    document.getElementById('lookupTendik').innerText = tendik;
    document.getElementById('lookupSiswa').innerText = siswa;
    document.getElementById('lookupX').innerHTML = `<span style="color:#0284c7;">L:${xl}</span> | <span style="color:#ec4899;">P:${xp}</span> (${xl+xp})`;
    document.getElementById('lookupXI').innerHTML = `<span style="color:#0284c7;">L:${xil}</span> | <span style="color:#ec4899;">P:${xip}</span> (${xil+xip})`;
    document.getElementById('lookupXII').innerHTML = `<span style="color:#0284c7;">L:${xiil}</span> | <span style="color:#ec4899;">P:${xiip}</span> (${xiil+xiip})`;
    document.getElementById('lookupPrestasi').innerText = prestasi + ' Prestasi';
    document.getElementById('lookupAddress').innerText = address;

    let webWrapper = document.getElementById('lookupWebsiteWrapper');
    let webLink = document.getElementById('lookupWebsite');
    if (website && website.trim() !== '') {
        webLink.href = website.startsWith('http') ? website : 'http://' + website;
        webLink.innerText = website;
        webWrapper.style.display = 'block';
    } else {
        webWrapper.style.display = 'none';
    }

    let statusBadge = document.getElementById('lookupStatus');
    if (status === 'Negeri') {
        statusBadge.style.background = '#eff6ff';
        statusBadge.style.color = '#1d4ed8';
    } else {
        statusBadge.style.background = '#f5f3ff';
        statusBadge.style.color = '#7c3aed';
    }
    card.style.display = 'block';

    // ── Update 4 Stat Cards with Animation ──
    const valPrestasi = document.getElementById('stat-val-prestasi');
    const valGuru = document.getElementById('stat-val-guru');
    const valTendik = document.getElementById('stat-val-tendik');
    const valSiswa = document.getElementById('stat-val-siswa');

    // Add values
    valPrestasi.innerText = prestasi;
    valGuru.innerText = guru;
    valTendik.innerText = tendik;
    valSiswa.innerText = siswa;

    // Change labels to reflect school focus
    document.getElementById('stat-lbl-prestasi').innerText = 'Prestasi Sekolah';
    document.getElementById('stat-lbl-guru').innerText = 'Guru Sekolah';
    document.getElementById('stat-lbl-tendik').innerText = 'Tendik Sekolah';
    document.getElementById('stat-lbl-siswa').innerText = 'Siswa Sekolah';

    // Trigger pop animations by removing and adding class
    [valPrestasi, valGuru, valTendik, valSiswa].forEach(el => {
        if (el) {
            el.classList.remove('pop-anim');
            void el.offsetWidth; // Trigger reflow
            el.classList.add('pop-anim');
        }
    });

    // Add school-mode highlights to the cards
    document.querySelectorAll('.stat-card').forEach(c => {
        c.classList.add('school-mode');
    });

    // Show the context bar banner
    document.getElementById('stat-context-name').innerText = 'Menampilkan statistik: ' + name;
    document.getElementById('stat-context-bar').style.display = 'flex';

    // Scroll to row in table & highlight it
    if (rowId) {
        let row = document.getElementById(rowId);
        let listEl = document.getElementById('schoolList');
        if (row && listEl) {
            // Clear previous highlights
            document.querySelectorAll('.school-row').forEach(r => {
                r.style.background = '';
                r.style.boxShadow = '';
                r.style.outline = '';
            });
            // Scroll the schoolList container so the row is visible
            listEl.scrollTo({ top: row.offsetTop - listEl.offsetTop, behavior: 'smooth' });
            // Highlight
            row.style.background = '#fef9c3';
            row.style.outline = '2px solid #d97706';
            // Fade highlight after 2.5 seconds
            setTimeout(() => {
                row.style.background = '';
                row.style.outline = '';
            }, 2500);
        }
    }
}

function resetStats() {
    // Restore default values
    const valPrestasi = document.getElementById('stat-val-prestasi');
    const valGuru = document.getElementById('stat-val-guru');
    const valTendik = document.getElementById('stat-val-tendik');
    const valSiswa = document.getElementById('stat-val-siswa');

    valPrestasi.innerText = defaultStats.prestasi;
    valGuru.innerText = defaultStats.guru;
    valTendik.innerText = defaultStats.tendik;
    valSiswa.innerText = defaultStats.siswa;

    // Restore labels
    document.getElementById('stat-lbl-prestasi').innerText = 'Total Prestasi';
    document.getElementById('stat-lbl-guru').innerText = 'Total Guru';
    document.getElementById('stat-lbl-tendik').innerText = 'Total Tendik';
    document.getElementById('stat-lbl-siswa').innerText = 'Total Siswa';

    // Trigger pop animations
    [valPrestasi, valGuru, valTendik, valSiswa].forEach(el => {
        if (el) {
            el.classList.remove('pop-anim');
            void el.offsetWidth; // Trigger reflow
            el.classList.add('pop-anim');
        }
    });

    // Remove school-mode highlights
    document.querySelectorAll('.stat-card').forEach(c => {
        c.classList.remove('school-mode');
    });

    // Hide context bar
    document.getElementById('stat-context-bar').style.display = 'none';

    // Clear lookup select and card
    document.getElementById('schoolLookupSelect').value = '';
    document.getElementById('schoolLookupCard').style.display = 'none';
    document.getElementById('lookupWebsiteWrapper').style.display = 'none';

    // Clear active table row highlights
    document.querySelectorAll('.school-row').forEach(r => {
        r.style.background = '';
        r.style.outline = '';
    });
}

// Slider Javascript
let mainCurrent = 0;
const mainTotal = {{ $photoCount }};

function mainGoto(idx) {
    if (mainTotal <= 0) return;
    const currentSlide = document.getElementById('main-slide-' + mainCurrent);
    const currentDot = document.getElementById('main-dot-' + mainCurrent);
    if (currentSlide) currentSlide.style.opacity = '0';
    if (currentDot) currentDot.style.background = 'rgba(255,255,255,.45)';
    
    mainCurrent = idx;
    
    const nextSlide = document.getElementById('main-slide-' + mainCurrent);
    const nextDot = document.getElementById('main-dot-' + mainCurrent);
    if (nextSlide) nextSlide.style.opacity = '1';
    if (nextDot) nextDot.style.background = '#fff';
}

function mainNext() {
    if (mainTotal <= 1) return;
    mainGoto((mainCurrent + 1) % mainTotal);
}

function mainPrev() {
    if (mainTotal <= 1) return;
    mainGoto((mainCurrent - 1 + mainTotal) % mainTotal);
}

document.addEventListener('DOMContentLoaded', function() {
    if (mainTotal > 1) {
        setInterval(mainNext, 4500);
    }
});
</script>
@endsection
