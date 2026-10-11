@extends('layouts.public')

@section('title', 'Kanal Informasi & Kegiatan - Cabdin Wilayah Kabupaten Gresik')

@section('content')

<!-- PAGE HEADER -->
<section class="page-header">
    <div class="container">
        <h2>Kanal Informasi & Kegiatan</h2>
        <div class="breadcrumb">
            <a href="{{ route('home') }}">Beranda</a> / Informasi
        </div>
    </div>
</section>

<!-- MAIN CONTENT -->
<section class="main-section" style="padding-top: 0;">
    <div class="container">
        
        <!-- Filter & Search Bar -->
        <div style="display: flex; flex-wrap: wrap; gap: 20px; margin-bottom: 40px; align-items: center; justify-content: space-between; background: white; padding: 20px; border-radius: var(--radius-md); border: 1px solid var(--border); box-shadow: var(--shadow-sm);">
            
            <!-- Category Tabs -->
            <div style="display: flex; gap: 8px; flex-wrap: wrap;">
                <a href="{{ route('posts.index', ['type' => '', 'search' => $search]) }}" class="btn {{ !$type ? 'btn-primary' : 'btn-secondary' }}" style="padding: 8px 16px; font-size: 13px; border-radius: var(--radius-sm);">
                    Semua
                </a>
                <a href="{{ route('posts.index', ['type' => 'berita', 'search' => $search]) }}" class="btn {{ $type == 'berita' ? 'btn-primary' : 'btn-secondary' }}" style="padding: 8px 16px; font-size: 13px; border-radius: var(--radius-sm);">
                    Berita
                </a>
                <a href="{{ route('posts.index', ['type' => 'pengumuman', 'search' => $search]) }}" class="btn {{ $type == 'pengumuman' ? 'btn-primary' : 'btn-secondary' }}" style="padding: 8px 16px; font-size: 13px; border-radius: var(--radius-sm);">
                    Pengumuman
                </a>
                <a href="{{ route('posts.index', ['type' => 'inovasi', 'search' => $search]) }}" class="btn {{ $type == 'inovasi' ? 'btn-primary' : 'btn-secondary' }}" style="padding: 8px 16px; font-size: 13px; border-radius: var(--radius-sm);">
                    Inovasi
                </a>
                <a href="{{ route('posts.index', ['type' => 'prestasi', 'search' => $search]) }}" class="btn {{ $type == 'prestasi' ? 'btn-primary' : 'btn-secondary' }}" style="padding: 8px 16px; font-size: 13px; border-radius: var(--radius-sm);">
                    Prestasi
                </a>
                <a href="{{ route('kegiatan.index') }}" class="btn btn-secondary" style="padding: 8px 16px; font-size: 13px; border-radius: var(--radius-sm);">
                    Kegiatan
                </a>
            </div>

            <!-- Search Form -->
            <form action="{{ route('posts.index') }}" method="GET" style="display: flex; gap: 8px; width: 100%; max-width: 350px;">
                @if($type)
                    <input type="hidden" name="type" value="{{ $type }}">
                @endif
                <input type="text" name="search" value="{{ $search }}" placeholder="Cari judul atau isi konten..." class="form-control" style="font-size: 13px; padding: 8px 15px; border-radius: var(--radius-sm);">
                <button type="submit" class="btn btn-primary" style="padding: 8px 16px; font-size: 13px; border-radius: var(--radius-sm);">Cari</button>
            </form>

        </div>

        <!-- Search Status / Result Header -->
        @if($search)
            <div style="margin-bottom: 25px; font-size: 14px; color: var(--text-muted);">
                Hasil pencarian untuk kata kunci: <strong style="color: var(--primary);">"{{ $search }}"</strong> 
                @if($type)
                    pada kategori <strong style="color: var(--primary);">{{ ucfirst($type) }}</strong>
                @endif
                ({{ $posts->total() }} data ditemukan)
            </div>
        @endif

        <!-- Grid Postingan -->
        <div class="news-grid">
            @forelse($posts as $post)
                <article class="news-card">
                    <div class="news-img" style="background-image: url('{{ $post->image ? (Str::startsWith($post->image, 'http') ? $post->image : asset('storage/' . $post->image)) : 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?q=80&w=600&auto=format&fit=crop' }}');">
                        <span class="news-badge">{{ $post->type }}</span>
                    </div>
                    <div class="news-content">
                        <div class="news-meta" style="display: flex; align-items: center; gap: 12px; flex-wrap: wrap;">
                            <span><i class="bi bi-calendar-event" style="margin-right: 4px;"></i> {{ $post->created_at->format('d M Y') }}</span>
                            <span style="display: inline-flex; align-items: center; gap: 4px; color: #0369a1; font-weight: 600;">
                                <i class="bi bi-eye-fill"></i> {{ number_format($post->views) }}
                            </span>
                        </div>
                        <h3 class="news-title" style="display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">
                            <a href="{{ route('posts.show', $post->slug) }}"> {{ $post->title }}</a>
                        </h3>
                        <p class="news-snippet">{{ Str::limit(strip_tags(html_entity_decode($post->content)), 120) }}</p>
                        <a href="{{ route('posts.show', $post->slug) }}" class="read-more">Baca Selengkapnya <i class="bi bi-arrow-right" style="margin-left: 2px;"></i></a>
                    </div>
                </article>
            @empty
                <div class="card" style="grid-column: 1 / -1; text-align: center; color: var(--text-muted); padding: 50px;">
                    <i class="bi bi-search" style="font-size: 40px; display: block; margin-bottom: 15px; color: var(--text-muted);"></i>
                    Tidak ada informasi atau kegiatan yang ditemukan.
                </div>
            @endforelse
        </div>

        <!-- Custom Pagination -->
        @if($posts->hasPages())
            @php
                $posts->appends(request()->query());
            @endphp
            <div class="pagination">
                {{-- Previous Page Link --}}
                @if($posts->onFirstPage())
                    <span class="pagination-link" style="opacity: 0.5; cursor: not-allowed;">&laquo;</span>
                @else
                    <a href="{{ $posts->previousPageUrl() }}" class="pagination-link">&laquo;</a>
                @endif

                {{-- Pagination Pages --}}
                @foreach ($posts->getUrlRange(1, $posts->lastPage()) as $page => $url)
                    @if ($page == $posts->currentPage())
                        <span class="pagination-link active">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="pagination-link">{{ $page }}</a>
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if($posts->hasMorePages())
                    <a href="{{ $posts->nextPageUrl() }}" class="pagination-link">&raquo;</a>
                @else
                    <span class="pagination-link" style="opacity: 0.5; cursor: not-allowed;">&raquo;</span>
                @endif
            </div>
        @endif

    </div>
</section>

@endsection
