@extends('layouts.admin')

@section('title', 'Dashboard Admin - Cabdin Gresik')

@section('content')

{{-- Page Header --}}
<div class="d-page-header">
    <div>
        <h2 class="d-page-title">Dashboard</h2>
        <p class="d-page-sub">Selamat datang, <strong>{{ Auth::user()->name }}</strong>. Berikut ringkasan data terkini.</p>
    </div>
    <div class="d-header-actions">
        <a href="{{ route('admin.posts.create', ['type' => 'berita']) }}" class="d-btn-primary">
            <i class="bi bi-pencil-square"></i> Tulis Berita
        </a>
        <a href="{{ route('admin.posts.create', ['type' => 'pengumuman']) }}" class="d-btn-ghost">
            <i class="bi bi-megaphone"></i> Pengumuman
        </a>
    </div>
</div>

{{-- Stat Cards --}}
<div class="d-stat-grid">
    <div class="d-stat-card" style="animation-delay:0s">
        <div class="d-stat-card-top">
            <div class="d-stat-icon"><i class="bi bi-newspaper"></i></div>
            <a href="{{ route('admin.posts.index', ['type'=> 'berita']) }}" class="d-stat-arrow"><i class="bi bi-arrow-right"></i></a>
        </div>
        <div class="d-stat-body">
            <div class="d-stat-value">{{ $newsCount }}</div>
            <div class="d-stat-label">Total Berita</div>
        </div>
    </div>

    <div class="d-stat-card" style="animation-delay:0.06s">
        <div class="d-stat-card-top">
            <div class="d-stat-icon"><i class="bi bi-grid-3x3-gap"></i></div>
            <a href="{{ route('admin.services.index') }}" class="d-stat-arrow"><i class="bi bi-arrow-right"></i></a>
        </div>
        <div class="d-stat-body">
            <div class="d-stat-value">{{ $servicesCount }}</div>
            <div class="d-stat-label">Layanan Publik</div>
        </div>
    </div>

    <div class="d-stat-card" style="animation-delay:0.12s">
        <div class="d-stat-card-top">
            <div class="d-stat-icon"><i class="bi bi-clipboard2-check"></i></div>
            <a href="{{ route('admin.skm.index') }}" class="d-stat-arrow"><i class="bi bi-arrow-right"></i></a>
        </div>
        <div class="d-stat-body">
            <div class="d-stat-value">{{ $skmTotal }}</div>
            <div class="d-stat-label">Hasil Survei SKM</div>
        </div>
    </div>

    <div class="d-stat-card d-stat-card--navy" style="animation-delay:0.18s">
        <div class="d-stat-card-top">
            <div class="d-stat-icon d-stat-icon--light"><i class="bi bi-eye"></i></div>
            <span class="d-stat-arrow d-stat-arrow--light"><i class="bi bi-graph-up"></i></span>
        </div>
        <div class="d-stat-body">
            <div class="d-stat-value d-stat-value--light">{{ number_format($totalViews) }}</div>
            <div class="d-stat-label d-stat-label--light">Total Tayangan</div>
        </div>
    </div>
</div>

{{-- Main content grid --}}
<div class="d-content-grid">

    {{-- Top Posts Table --}}
    <div class="d-card d-card--main" style="animation-delay:0.3s">
        <div class="d-card-header">
            <div class="d-card-header-icon"><i class="bi bi-bar-chart-line"></i></div>
            <div>
                <h3 class="d-card-title">Konten Paling Banyak Dilihat</h3>
                <p class="d-card-sub">10 konten teratas berdasarkan jumlah tayangan</p>
            </div>
        </div>

        @if($topPosts->count() > 0)
        <div class="d-table-scroll">
            <table class="d-table">
                <thead>
                    <tr>
                        <th style="width:44px">#</th>
                        <th>Judul</th>
                        <th style="width:108px;text-align:center">Kategori</th>
                        <th style="width:98px;text-align:center">Tanggal</th>
                        <th style="width:100px;text-align:right">Tayangan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($topPosts as $i => $post)
                    <tr>
                        <td>
                            @if($i === 0)
                                <span class="d-rank d-rank--1">1</span>
                            @elseif($i === 1)
                                <span class="d-rank d-rank--2">2</span>
                            @elseif($i === 2)
                                <span class="d-rank d-rank--3">3</span>
                            @else
                                <span class="d-rank-num">{{ $i+1 }}</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('posts.show', $post->slug) }}" target="_blank" class="d-post-link">
                                {{ Str::limit($post->title, 62) }}
                            </a>
                        </td>
                        <td style="text-align:center">
                            <span class="d-pill">{{ $post->type }}</span>
                        </td>
                        <td class="d-td-muted" style="text-align:center">{{ $post->created_at->format('d M Y') }}</td>
                        <td style="text-align:right">
                            <span class="d-views">
                                <i class="bi bi-eye"></i> {{ number_format($post->views) }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="d-empty">
            <i class="bi bi-inbox"></i>
            <p>Belum ada data tayangan.</p>
        </div>
        @endif
    </div>

    {{-- Quick Links Sidebar --}}
    <div class="d-card" style="animation-delay:0.36s">
        <div class="d-card-header">
            <div class="d-card-header-icon"><i class="bi bi-lightning-charge"></i></div>
            <div>
                <h3 class="d-card-title">Akses Cepat</h3>
                <p class="d-card-sub">Tindakan umum</p>
            </div>
        </div>
        <div class="d-quicklinks">
            <a href="{{ route('admin.posts.create', ['type' => 'berita']) }}" class="d-ql-item">
                <i class="bi bi-pencil-square d-ql-icon"></i>
                <div class="d-ql-text">
                    <span>Tulis Berita Baru</span>
                    <small>Tambah artikel terkini</small>
                </div>
                <i class="bi bi-chevron-right d-ql-chevron"></i>
            </a>
            <a href="{{ route('admin.posts.create', ['type' => 'pengumuman']) }}" class="d-ql-item">
                <i class="bi bi-megaphone d-ql-icon"></i>
                <div class="d-ql-text">
                    <span>Buat Pengumuman</span>
                    <small>Informasi resmi lembaga</small>
                </div>
                <i class="bi bi-chevron-right d-ql-chevron"></i>
            </a>
            <a href="{{ route('admin.posts.create', ['type' => 'kegiatan']) }}" class="d-ql-item">
                <i class="bi bi-calendar-event d-ql-icon"></i>
                <div class="d-ql-text">
                    <span>Tambah Kegiatan</span>
                    <small>Kelola galeri kegiatan</small>
                </div>
                <i class="bi bi-chevron-right d-ql-chevron"></i>
            </a>
            <a href="{{ route('admin.services.create') }}" class="d-ql-item">
                <i class="bi bi-plus-circle d-ql-icon"></i>
                <div class="d-ql-text">
                    <span>Tambah Layanan</span>
                    <small>Kelola layanan publik</small>
                </div>
                <i class="bi bi-chevron-right d-ql-chevron"></i>
            </a>
            <a href="{{ route('admin.sliders.index') }}" class="d-ql-item">
                <i class="bi bi-images d-ql-icon"></i>
                <div class="d-ql-text">
                    <span>Kelola Banner Slider</span>
                    <small>Atur gambar slider beranda</small>
                </div>
                <i class="bi bi-chevron-right d-ql-chevron"></i>
            </a>
            <a href="{{ route('admin.downloads.index') }}" class="d-ql-item">
                <i class="bi bi-download d-ql-icon"></i>
                <div class="d-ql-text">
                    <span>Kelola Pusat Unduhan</span>
                    <small>Upload file untuk publik</small>
                </div>
                <i class="bi bi-chevron-right d-ql-chevron"></i>
            </a>
            <a href="{{ route('admin.skm.index') }}" class="d-ql-item">
                <i class="bi bi-clipboard2-check d-ql-icon"></i>
                <div class="d-ql-text">
                    <span>Hasil Survei SKM</span>
                    <small>Rekap nilai IKM &amp; saran</small>
                </div>
                <i class="bi bi-chevron-right d-ql-chevron"></i>
            </a>
            <a href="{{ route('admin.profile.index') }}" class="d-ql-item">
                <i class="bi bi-person-workspace d-ql-icon"></i>
                <div class="d-ql-text">
                    <span>Edit Profil Lembaga</span>
                    <small>Visi, misi &amp; struktur</small>
                </div>
                <i class="bi bi-chevron-right d-ql-chevron"></i>
            </a>
            <a href="{{ route('admin.mkks.index') }}" class="d-ql-item">
                <i class="bi bi-building d-ql-icon"></i>
                <div class="d-ql-text">
                    <span>Kelola MKKS</span>
                    <small>Data sekolah binaan</small>
                </div>
                <i class="bi bi-chevron-right d-ql-chevron"></i>
            </a>
        </div>
    </div>

</div>

<style>
/* ─── Variables ─────────────────────────────────── */
:root {
    --navy:    #0b1f3f;
    --navy-md: #1e3a5f;
    --navy-lt: #2d5282;
    --accent:  #0d9488;
    --border:  #e8edf3;
    --bg:      #f0f4f8;
    --text:    #1e293b;
    --muted:   #64748b;
}

/* ─── Page Header ───────────────────────────────── */
.d-page-header   { display:flex; align-items:center; justify-content:space-between; margin-bottom:26px; flex-wrap:wrap; gap:12px; }
.d-page-title    { font-size:22px; font-weight:800; color:var(--navy); margin:0 0 3px; letter-spacing:-0.3px; }
.d-page-sub      { font-size:13px; color:var(--muted); margin:0; }
.d-header-actions{ display:flex; gap:9px; flex-wrap:wrap; }
.d-btn-primary   { display:inline-flex; align-items:center; gap:7px; padding:8px 16px; background:var(--navy); color:#fff; border-radius:8px; font-size:13px; font-weight:600; text-decoration:none; transition:background 0.18s; }
.d-btn-primary:hover { background:var(--navy-md); color:#fff; }
.d-btn-ghost     { display:inline-flex; align-items:center; gap:7px; padding:8px 16px; background:#fff; border:1.5px solid var(--border); color:var(--text); border-radius:8px; font-size:13px; font-weight:600; text-decoration:none; transition:border-color 0.18s; }
.d-btn-ghost:hover { border-color:#94a3b8; color:var(--navy); }

/* ─── Stat Grid ─────────────────────────────────── */
.d-stat-grid { display:grid; grid-template-columns:repeat(4,1fr); gap:14px; margin-bottom:24px; }
@media(max-width:1200px){ .d-stat-grid { grid-template-columns:repeat(3,1fr); } }
@media(max-width:700px){ .d-stat-grid { grid-template-columns:repeat(2,1fr); } }

.d-stat-card { 
    display:flex; 
    flex-direction:column; 
    justify-content:space-between; 
    background:#fff; 
    border:1px solid var(--border); 
    border-radius:14px; 
    padding:22px 20px 18px; 
    min-height:115px; 
    box-shadow:0 2px 10px rgba(11,31,63,0.04); 
    animation:d-fadeUp 0.5s cubic-bezier(0.16, 1, 0.3, 1) both; 
    transition:box-shadow 0.3s cubic-bezier(0.16, 1, 0.3, 1), transform 0.3s cubic-bezier(0.16, 1, 0.3, 1), border-color 0.3s ease; 
    overflow:hidden; 
    position:relative; 
}
.d-stat-card::after {
    content: '';
    position: absolute;
    bottom: 0; left: 0; right: 0; height: 3px;
    background: var(--navy-md);
    transform: scaleX(0);
    transform-origin: left;
    transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1);
}
.d-stat-card:hover { 
    box-shadow:0 12px 30px rgba(11,31,63,0.08); 
    transform:translateY(-5px); 
    border-color: rgba(30,58,95,0.25);
}
.d-stat-card:hover::after {
    transform: scaleX(1);
}
.d-stat-card:hover .d-stat-icon {
    transform: scale(1.08) rotate(-3deg);
    background: rgba(30,58,95,0.08);
    color: var(--navy-md);
}
@keyframes d-fadeUp { from{opacity:0;transform:translateY(14px)} to{opacity:1;transform:translateY(0)} }

.d-stat-card-top { display:flex; align-items:center; justify-content:space-between; margin-bottom:14px; }
.d-stat-icon { width:44px; height:44px; border-radius:11px; background:#f1f5f9; display:flex; align-items:center; justify-content:center; font-size:19px; color:var(--navy); flex-shrink:0; transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1); }
.d-stat-body { min-width:0; }
.d-stat-value { font-size:30px; font-weight:900; color:var(--navy); line-height:1; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; margin-bottom:5px; }
.d-stat-label { font-size:10px; font-weight:600; color:var(--muted); text-transform:uppercase; letter-spacing:0.3px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }
.d-stat-arrow { display:inline-flex; align-items:center; justify-content:center; width:26px; height:26px; border-radius:7px; background:#f1f5f9; color:var(--muted); font-size:13px; text-decoration:none; transition:all 0.15s; flex-shrink:0; }
.d-stat-arrow:hover { background:#e2e8f0; color:var(--navy); transform:translateX(2px); }
.d-stat-arrow:active { transform:scale(0.88); }

/* Navy special card */
.d-stat-card--navy { background:var(--navy); border-color:var(--navy); }
.d-stat-card--navy::after { background: var(--accent); }
.d-stat-card--navy:hover { border-color: var(--navy); box-shadow: 0 12px 30px rgba(11,31,63,0.2); }
.d-stat-card--navy:hover .d-stat-icon--light { background: rgba(255,255,255,0.2); transform: scale(1.08) rotate(-3deg); }
.d-stat-icon--light { background:rgba(255,255,255,0.12); color:#fff; }
.d-stat-value--light { color:#fff; }
.d-stat-label--light { color:rgba(255,255,255,0.55); }
.d-stat-arrow--light { background:rgba(255,255,255,0.12); color:rgba(255,255,255,0.6); cursor:default; }

/* ─── Content Grid ──────────────────────────────── */
.d-content-grid { display:grid; grid-template-columns:1fr 280px; gap:18px; align-items:start; }
@media(max-width:1100px){ .d-content-grid { grid-template-columns:1fr; } }
.d-card--main {}

/* ─── Card ──────────────────────────────────────── */
.d-card { background:#fff; border:1px solid var(--border); border-radius:12px; box-shadow:0 1px 6px rgba(0,0,0,0.04); overflow:hidden; animation:d-fadeUp 0.35s ease both; }
.d-card-header { display:flex; align-items:center; gap:12px; padding:16px 20px; border-bottom:1px solid var(--border); background:#fafbfc; }
.d-card-header-icon { width:34px; height:34px; border-radius:8px; background:var(--navy); display:flex; align-items:center; justify-content:center; color:#fff; font-size:14px; flex-shrink:0; }
.d-card-title { font-size:14px; font-weight:700; color:var(--navy); margin:0 0 2px; }
.d-card-sub   { font-size:11.5px; color:var(--muted); margin:0; }

/* ─── Table ─────────────────────────────────────── */
.d-table-scroll { overflow-x:auto; }
.d-table { width:100%; border-collapse:collapse; font-size:13px; }
.d-table thead tr { border-bottom:2px solid var(--border); }
.d-table th { padding:10px 16px; text-align:left; font-size:11.5px; font-weight:700; color:var(--muted); text-transform:uppercase; letter-spacing:0.5px; }
.d-table tbody tr { border-bottom:1px solid #f1f5f9; transition:background 0.12s; }
.d-table tbody tr:hover { background:#f8fafc; }
.d-table td { padding:11px 16px; vertical-align:middle; }
.d-td-muted { color:var(--muted); font-size:12px; }

.d-rank     { display:inline-flex; align-items:center; justify-content:center; width:24px; height:24px; border-radius:6px; font-size:11px; font-weight:800; color:#fff; }
.d-rank--1  { background:var(--navy); }
.d-rank--2  { background:#475569; }
.d-rank--3  { background:#64748b; }
.d-rank-num { color:var(--muted); font-weight:700; font-size:13px; padding-left:2px; }

.d-post-link { color:var(--navy); font-weight:600; text-decoration:none; transition:color 0.15s; }
.d-post-link:hover { color:var(--accent); }

.d-pill { display:inline-block; padding:3px 9px; border-radius:20px; font-size:10.5px; font-weight:700; text-transform:uppercase; letter-spacing:0.4px; background:#f1f5f9; color:#475569; border:1px solid #e2e8f0; }

.d-views { display:inline-flex; align-items:center; gap:5px; font-size:12px; font-weight:700; color:var(--navy); }

.d-empty { text-align:center; padding:48px 20px; color:var(--muted); }
.d-empty i { font-size:40px; display:block; margin-bottom:12px; color:#cbd5e1; }
.d-empty p { font-size:13.5px; margin:0; }

/* ─── Quick Links ───────────────────────────────── */
.d-quicklinks { padding:8px 12px 12px; }
.d-ql-item { display:flex; align-items:center; gap:11px; padding:10px 10px; border-radius:9px; text-decoration:none; color:var(--text); transition:background 0.15s; }
.d-ql-item:hover { background:#f8fafc; color:var(--navy); }
.d-ql-icon { font-size:15px; color:var(--navy); width:20px; text-align:center; flex-shrink:0; }
.d-ql-text { flex:1; }
.d-ql-text span { display:block; font-size:13px; font-weight:600; }
.d-ql-text small { display:block; font-size:11.5px; color:var(--muted); }
.d-ql-chevron { font-size:13px; color:#cbd5e1; transition:transform 0.15s,color 0.15s; }
.d-ql-item:hover .d-ql-chevron { transform:translateX(3px); color:#94a3b8; }

/* ─── Active / Ripple Effects ───────────────────── */
.d-btn-primary:active  { transform:scale(0.96); }
.d-btn-ghost:active    { transform:scale(0.96); }
.admin-menu-link       { transition:all 0.15s; }
.admin-menu-link:active { transform:scale(0.97); opacity:0.85; }
.header-visit-btn:active   { transform:scale(0.96); }
.header-logout-btn:active  { transform:scale(0.96); }

/* Quick link active */
.d-ql-item:active { transform:scale(0.98); background:#f1f5f9; }
</style>

@endsection
