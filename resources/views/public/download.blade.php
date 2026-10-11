@extends('layouts.public')

@section('title', 'Download - Cabang Dinas Pendidikan Wilayah Kab. Gresik')

@section('content')

<!-- PAGE HEADER -->
<section style="background: linear-gradient(135deg, var(--primary), var(--primary-light)); color: white; padding: 40px 0; text-align: center; border-bottom: 4px solid var(--secondary);">
    <div class="container">
        <div style="font-size: 40px; margin-bottom: 12px;"><i class="bi bi-cloud-arrow-down-fill" style="color: var(--accent-light);"></i></div>
        <h2 style="font-size: 26px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px;">Pusat Unduhan Dokumen</h2>
        <p style="font-size: 13.5px; color: rgba(255,255,255,0.7); margin-top: 6px;">
            Unduh formulir, regulasi, dan dokumen resmi Cabang Dinas Pendidikan Wilayah Kab. Gresik
        </p>
        <div style="font-size: 13.5px; color: rgba(255,255,255,0.6); margin-top: 10px;">
            <a href="{{ route('home') }}" style="color: #93c5fd; font-weight: 600;">Beranda</a> / Download
        </div>
    </div>
</section>

<!-- MAIN CONTENT -->
<section class="main-section" style="background-color: #f8fafc; padding: 40px 0;">
    <div class="container-wide" style="max-width: 1100px; margin: 0 auto; padding: 0 4%;">

        <!-- Search & Filter Bar -->
        <form action="{{ route('download') }}" method="GET" style="background: #ffffff; padding: 18px 20px; border-radius: var(--radius-md); border: 1px solid var(--border); box-shadow: var(--shadow-sm); margin-bottom: 24px; display: flex; gap: 12px; flex-wrap: wrap; align-items: center;">
            <div style="position: relative; flex: 1; min-width: 200px;">
                <input type="text" name="search" placeholder="Cari nama dokumen..."
                       value="{{ $search ?? '' }}"
                       style="width: 100%; padding: 10px 14px 10px 38px; border: 1px solid var(--border); border-radius: var(--radius-sm); font-size: 13.5px; outline: none; transition: border-color 0.25s ease;">
                <i class="bi bi-search" style="position: absolute; left: 13px; top: 50%; transform: translateY(-50%); color: var(--text-muted);"></i>
            </div>
            <div style="display: flex; gap: 8px; flex-wrap: wrap;">
                <a href="{{ route('download') }}" style="padding: 9px 16px; border-radius: var(--radius-sm); font-size: 13px; font-weight: 600; text-decoration: none; border: 1px solid var(--border); {{ !($category ?? null) ? 'background: var(--primary); color: white; border-color: var(--primary);' : 'background: #fff; color: var(--text-dark);' }}">
                    Semua
                </a>
                @foreach(['Formulir','Regulasi','Laporan','Panduan','SKM'] as $cat)
                <a href="{{ route('download', ['category' => $cat]) }}" style="padding: 9px 16px; border-radius: var(--radius-sm); font-size: 13px; font-weight: 600; text-decoration: none; border: 1px solid var(--border); {{ ($category ?? '') == $cat ? 'background: var(--primary); color: white; border-color: var(--primary);' : 'background: #fff; color: var(--text-dark);' }}">
                    {{ $cat }}
                </a>
                @endforeach
            </div>
        </form>

        <!-- Results Count -->
        <div style="margin-bottom: 16px; font-size: 13px; color: var(--text-muted);">
            Menampilkan <strong style="color: var(--primary);">{{ $downloads->total() }}</strong> dokumen
            @if($category ?? null) dalam kategori <strong style="color: var(--primary);">{{ $category }}</strong> @endif
            @if($search ?? null) untuk pencarian "<strong style="color: var(--primary);">{{ $search }}</strong>" @endif
        </div>

        <!-- Download Cards -->
        @if($downloads->isEmpty())
            <div style="background: #fff; border: 1px solid var(--border); border-radius: var(--radius-md); padding: 60px 20px; text-align: center; color: var(--text-muted); box-shadow: var(--shadow-sm);">
                <i class="bi bi-file-earmark-x" style="font-size: 50px; display: block; margin-bottom: 16px; opacity: .3;"></i>
                <p style="font-size: 15px; font-weight: 600;">Belum ada dokumen yang tersedia.</p>
                <p style="font-size: 13px;">Dokumen akan ditambahkan segera oleh admin.</p>
            </div>
        @else
            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 18px;">
                @foreach($downloads as $dl)
                @php
                    $ext = pathinfo($dl->file_name, PATHINFO_EXTENSION);
                    $iconData = match(strtolower($ext)) {
                        'pdf'        => ['bi-file-earmark-pdf-fill', '#dc2626', '#fef2f2'],
                        'doc','docx' => ['bi-file-earmark-word-fill', '#2563eb', '#eff6ff'],
                        'xls','xlsx' => ['bi-file-earmark-excel-fill', '#16a34a', '#f0fdf4'],
                        'zip'        => ['bi-file-earmark-zip-fill', '#d97706', '#fffbeb'],
                        default      => ['bi-file-earmark-fill', '#6b7280', '#f9fafb'],
                    };
                @endphp
                <div style="background: #ffffff; border: 1px solid var(--border); border-radius: var(--radius-md); padding: 20px; box-shadow: var(--shadow-sm); display: flex; gap: 16px; align-items: flex-start; transition: all 0.25s ease;"
                     onmouseover="this.style.transform='translateY(-3px)';this.style.boxShadow='0 8px 25px rgba(0,0,0,.08)'" onmouseout="this.style.transform='';this.style.boxShadow='var(--shadow-sm)'">
                    {{-- Icon --}}
                    <div style="width: 50px; height: 50px; border-radius: 12px; background: {{ $iconData[2] }}; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                        <i class="bi {{ $iconData[0] }}" style="font-size: 24px; color: {{ $iconData[1] }};"></i>
                    </div>
                    {{-- Info --}}
                    <div style="flex: 1; min-width: 0;">
                        <h4 style="font-size: 14px; font-weight: 700; color: var(--primary); margin: 0 0 4px; line-height: 1.4;">{{ $dl->title }}</h4>
                        @if($dl->description)
                            <p style="font-size: 12px; color: var(--text-muted); margin: 0 0 8px; line-height: 1.5;">{{ $dl->description }}</p>
                        @endif
                        <div style="display: flex; align-items: center; gap: 12px; flex-wrap: wrap; margin-bottom: 10px;">
                            <span style="background: {{ $iconData[2] }}; color: {{ $iconData[1] }}; padding: 2px 10px; border-radius: 20px; font-size: 11px; font-weight: 700; text-transform: uppercase;">{{ strtoupper($ext) }}</span>
                            <span style="font-size: 11px; color: var(--text-muted);"><i class="bi bi-hdd" style="margin-right: 3px;"></i> {{ $dl->file_size }}</span>
                            <span style="font-size: 11px; color: var(--text-muted);"><i class="bi bi-download" style="margin-right: 3px;"></i> {{ number_format($dl->download_count) }}x</span>
                            <span style="font-size: 11px; color: var(--text-muted);"><i class="bi bi-calendar3" style="margin-right: 3px;"></i> {{ $dl->created_at->format('d M Y') }}</span>
                        </div>
                        <a href="{{ route('download.file', $dl) }}" style="display: inline-flex; align-items: center; gap: 6px; padding: 7px 16px; background: var(--primary); color: white; border-radius: var(--radius-sm); font-size: 12px; font-weight: 700; text-decoration: none; transition: all 0.2s;"
                           onmouseover="this.style.background='var(--secondary)'" onmouseout="this.style.background='var(--primary)'">
                            <i class="bi bi-cloud-download"></i> Unduh File
                        </a>
                    </div>
                </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            @if($downloads->hasPages())
            <div style="margin-top: 30px; display: flex; justify-content: center; gap: 8px;">
                @if($downloads->onFirstPage())
                    <span style="opacity: 0.4; padding: 8px 12px; border: 1px solid var(--border); border-radius: var(--radius-sm);">&laquo;</span>
                @else
                    <a href="{{ $downloads->previousPageUrl() }}" style="padding: 8px 12px; border: 1px solid var(--border); border-radius: var(--radius-sm); text-decoration: none; color: var(--primary);">&laquo;</a>
                @endif
                @foreach($downloads->getUrlRange(1, $downloads->lastPage()) as $page => $url)
                    @if($page == $downloads->currentPage())
                        <span style="padding: 8px 12px; background: var(--secondary); color: white; border-radius: var(--radius-sm); font-weight: 700;">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" style="padding: 8px 12px; border: 1px solid var(--border); border-radius: var(--radius-sm); text-decoration: none; color: var(--primary);">{{ $page }}</a>
                    @endif
                @endforeach
                @if($downloads->hasMorePages())
                    <a href="{{ $downloads->nextPageUrl() }}" style="padding: 8px 12px; border: 1px solid var(--border); border-radius: var(--radius-sm); text-decoration: none; color: var(--primary);">&raquo;</a>
                @else
                    <span style="opacity: 0.4; padding: 8px 12px; border: 1px solid var(--border); border-radius: var(--radius-sm);">&raquo;</span>
                @endif
            </div>
            @endif
        @endif

    </div>
</section>

@endsection
