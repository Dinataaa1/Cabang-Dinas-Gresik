@extends('layouts.public')

@section('title', $post->title . ' - Cabdin Wilayah Kabupaten Gresik')

@section('meta')
    @php
        $defaultImage = 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?q=80&w=800&auto=format&fit=crop';
        $ogImage = $defaultImage;
        if(!empty($post->image)) {
            if(Str::startsWith($post->image, 'http')) {
                $ogImage = $post->image;
            } elseif (
                \Illuminate\Support\Facades\Storage::disk('public')->exists($post->image)
            ) {
                $ogImage = url('storage/' . $post->image);
            }
        }
    @endphp

    <meta property="og:title" content="{{ $post->title }}">
    <meta property="og:description" content="{{ Str::limit(strip_tags($post->content), 160) }}">
    <meta property="og:image" content="{{ $ogImage }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="article">
    <meta property="article:published_time" content="{{ $post->created_at?->toIso8601String() }}">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $post->title }}">
    <meta name="twitter:description" content="{{ Str::limit(strip_tags($post->content), 160) }}">
    <meta name="twitter:image" content="{{ $ogImage }}">
@endsection

@section('content')

<!-- PAGE HEADER -->
<section class="page-header">
    <div class="container">
        <h2>Detail Informasi</h2>
        <div class="breadcrumb">
            <a href="{{ route('home') }}">Beranda</a> / <a href="{{ route('posts.index') }}">Informasi</a> / Detail
        </div>
    </div>
</section>

<!-- MAIN CONTENT -->
<section class="main-section" style="padding-top: 0;">
    <div class="container grid-2">
        
        <!-- KOLOM KIRI: KONTEN UTAMA -->
        <div class="col-left">
            <article class="card" style="padding: 40px; border-top: 4px solid var(--accent);">
                
                <!-- Meta Postingan -->
                <div style="display: flex; gap: 15px; align-items: center; margin-bottom: 20px; font-size: 13px; color: var(--text-muted); font-weight: 500; flex-wrap: wrap;">
                    <span class="news-badge" style="position: static; display: inline-block;">{{ $post->type }}</span>
                    <span><i class="bi bi-calendar-event" style="margin-right: 4px;"></i> {{ $post->created_at->format('d F Y') }}</span>
                    <span><i class="bi bi-person-fill" style="margin-right: 4px;"></i> Admin Cabdin</span>
                    <span style="display: inline-flex; align-items: center; gap: 5px; background: linear-gradient(135deg, #f0f9ff, #e0f2fe); color: #0369a1; padding: 3px 10px; border-radius: 20px; font-weight: 600; border: 1px solid #bae6fd;">
                        <i class="bi bi-eye-fill" style="font-size: 13px;"></i>
                        {{ number_format($post->views) }} <span style="font-weight: 400; font-size: 12px;">tayangan</span>
                    </span>
                </div>

                <!-- Judul Postingan -->
                <h1 style="font-size: 26px; font-weight: 800; color: var(--primary); line-height: 1.3; margin-bottom: 25px;">
                    {{ $post->title }}
                </h1>

                <!-- Gambar Utama -->
                <div style="margin-bottom: 30px; border-radius: var(--radius-md); overflow: hidden; max-height: 450px; border: 1px solid var(--border);">
                    <img src="{{ $post->image ? (Str::startsWith($post->image, 'http') ? $post->image : asset('storage/' . $post->image)) : 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?q=80&w=800&auto=format&fit=crop' }}" alt="{{ $post->title }}" style="width: 100%; height: auto; display: block; object-fit: cover;">
                </div>

                <!-- Isi Konten -->
                <div style="font-size: 15px; line-height: 1.8; color: var(--text-dark); text-align: justify; margin-bottom: 30px;" class="post-content">
                    {!! $post->content !!}
                </div>

                <!-- Tombol Kembali + Share -->
                <div style="border-top: 1px solid var(--border); padding-top: 20px; display: flex; justify-content: space-between; align-items: center; gap: 12px; flex-wrap: wrap;">
                    <a href="{{ route('posts.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left" style="margin-right: 4px;"></i> Kembali ke Kanal Informasi</a>

                    <div style="display: flex; align-items: center; gap: 10px;">
                        <span style="font-size: 13px; color: var(--text-muted); font-weight: 500;">Kategori: <strong style="color: var(--secondary);">{{ ucfirst($post->type) }}</strong></span>

                        <!-- Share buttons -->
                        <div id="share-controls" style="display: inline-flex; gap: 8px; align-items: center;">
                            <button type="button" class="btn btn-light" id="btn-web-share" title="Bagikan" style="display: none;"><i class="bi bi-share-fill"></i></button>
                            <a href="#" id="share-whatsapp" class="btn btn-light" title="Bagikan ke WhatsApp"><i class="bi bi-whatsapp" style="color: #25D366;"></i></a>
                            <a href="#" id="share-facebook" class="btn btn-light" title="Bagikan ke Facebook"><i class="bi bi-facebook" style="color: #1877F2;"></i></a>
                            <a href="#" id="share-twitter" class="btn btn-light" title="Bagikan ke Twitter"><i class="bi bi-twitter" style="color: #1DA1F2;"></i></a>
                            <a href="#" id="share-telegram" class="btn btn-light" title="Bagikan ke Telegram"><i class="bi bi-telegram" style="color: #0088cc;"></i></a>
                            <button type="button" class="btn btn-light" id="btn-copy-link" title="Salin tautan"><i class="bi bi-clipboard"></i></button>
                        </div>
                    </div>
                </div>

            </article>
        </div>

        <!-- KOLOM KANAN: SIDEBAR -->
        <aside class="col-right">
            
            <!-- Widget Berita Terkait -->
            <div class="widget">
                <h3 class="widget-title"><span><i class="bi bi-megaphone-fill"></i></span> {{ ucfirst($post->type) }} Terkait</h3>
                <div style="display: flex; flex-direction: column; gap: 15px;">
                    @forelse($relatedPosts as $rel)
                        <div style="display: flex; gap: 12px; align-items: center;">
                            <!-- Thumbnail Kecil -->
                            <div style="width: 60px; height: 60px; border-radius: var(--radius-sm); overflow: hidden; background-image: url('{{ $rel->image ? (Str::startsWith($rel->image, 'http') ? $rel->image : asset('storage/' . $rel->image)) : 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?q=80&w=200&auto=format&fit=crop' }}'); background-size: cover; background-position: center; flex-shrink: 0;"></div>
                            
                            <div>
                                <h4 style="font-size: 13px; font-weight: 700; line-height: 1.3; color: var(--primary); margin-bottom: 4px;">
                                    <a href="{{ route('posts.show', $rel->slug) }}">{{ Str::limit($rel->title, 50) }}</a>
                                </h4>
                                <span style="font-size: 11px; color: var(--text-muted);"><i class="bi bi-calendar-event" style="margin-right: 4px;"></i> {{ $rel->created_at->format('d M Y') }}</span>
                            </div>
                        </div>
                    @empty
                        <span style="font-size: 13px; color: var(--text-muted); text-align: center;">Tidak ada informasi terkait lainnya.</span>
                    @endforelse
                </div>
            </div>

            <!-- Widget Tautan Pintas Profil -->
            <div class="widget">
                <h3 class="widget-title"><span><i class="bi bi-bank"></i></span> Profil Lembaga</h3>
                <div class="quick-links">
                    <a href="{{ route('profile') }}#tentang-kami" class="quick-link-item">Tentang Cabdin Gresik</a>
                    <a href="{{ route('profile') }}#visi-misi" class="quick-link-item">Visi & Misi Lembaga</a>
                    <a href="{{ route('profile') }}#struktur-organisasi" class="quick-link-item">Bagan Struktur Organisasi</a>
                </div>
            </div>

        </aside>

    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const shareUrl = {!! json_encode(url()->current()) !!};
        const shareTitle = {!! json_encode($post->title) !!};

        // Web Share API
        const btnWebShare = document.getElementById('btn-web-share');
        if (navigator.share && btnWebShare) {
            btnWebShare.style.display = 'inline-flex';
            btnWebShare.addEventListener('click', function () {
                navigator.share({
                    title: shareTitle,
                    text: shareTitle,
                    url: shareUrl
                }).catch(function (err) {
                    console.debug('Share canceled or failed', err);
                });
            });
        }

        // Social links
        const whatsapp = document.getElementById('share-whatsapp');
        const facebook = document.getElementById('share-facebook');
        const twitter = document.getElementById('share-twitter');
        const telegram = document.getElementById('share-telegram');

        if (whatsapp) whatsapp.href = 'https://api.whatsapp.com/send?text=' + encodeURIComponent(shareTitle + ' - ' + shareUrl);
        if (facebook) facebook.href = 'https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(shareUrl);
        if (twitter) twitter.href = 'https://twitter.com/intent/tweet?text=' + encodeURIComponent(shareTitle) + '&url=' + encodeURIComponent(shareUrl);
        if (telegram) telegram.href = 'https://t.me/share/url?url=' + encodeURIComponent(shareUrl) + '&text=' + encodeURIComponent(shareTitle);

        // Open social links in new window
        [whatsapp, facebook, twitter, telegram].forEach(function (el) {
            if (!el) return;
            el.setAttribute('target', '_blank');
            el.setAttribute('rel', 'noopener noreferrer');
        });

        // Copy link
        const btnCopy = document.getElementById('btn-copy-link');
        if (btnCopy) {
            btnCopy.addEventListener('click', function () {
                if (navigator.clipboard && navigator.clipboard.writeText) {
                    navigator.clipboard.writeText(shareUrl).then(function () {
                        alert('Tautan disalin ke clipboard');
                    }).catch(function () {
                        fallbackCopy(shareUrl);
                    });
                } else {
                    fallbackCopy(shareUrl);
                }
            });
        }

        function fallbackCopy(text) {
            const textarea = document.createElement('textarea');
            textarea.value = text;
            textarea.style.position = 'fixed';
            textarea.style.left = '-9999px';
            document.body.appendChild(textarea);
            textarea.select();
            try {
                document.execCommand('copy');
                alert('Tautan disalin ke clipboard');
            } catch (err) {
                prompt('Salin tautan berikut:', text);
            }
            document.body.removeChild(textarea);
        }
    });
</script>

@endsection
