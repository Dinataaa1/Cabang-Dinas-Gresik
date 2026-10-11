<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Cabang Dinas Pendidikan Wilayah Kabupaten Gresik')</title>
    
    <!-- 1/ FAVICON / TAB BROWSER -->
     <link rel ="icon" type="image/svg+xml" href="{{ asset('images/logo-jatim.svg') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/logo-jatim-32.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('images/logo-jatim-192.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

    <!-- Meta SEO -->
    <meta name="description" content="Portal Resmi Cabang Dinas Pendidikan Wilayah Kabupaten Gresik Dinas Pendidikan Provinsi Jawa Timur. Layanan informasi SMA, SMK, dan PK-PLK wilayah Gresik.">
    <meta name="keywords" content="cabdin gresik, dinas pendidikan gresik, sma gresik, smk gresik, slb gresik, mkks gresik">
    <meta name="author" content="Cabang Dinas Pendidikan Gresik">
    <meta name="robots" content="index, follow">

      <!-- 3. PREVIEW SHARE LINK (WhatsApp, Facebook, Telegram) -->
    <meta property="og:type" content="website">
    <meta property="og:locale" content="id_ID">
    <meta property="og:site_name" content="Cabang Dinas Pendidikan Wilayah Kab. Gresik">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title', 'Cabang Dinas Pendidikan Wilayah Kabupaten Gresik')">
    <meta property="og:description" content="Portal Resmi Cabang Dinas Pendidikan Wilayah Kabupaten Gresik Dinas Pendidikan Provinsi Jawa Timur. Layanan informasi SMA, SMK, dan PK-PLK wilayah Gresik.">
    <meta property="og:image" content="{{ asset('images/logo-jatim.png') }}">
    <meta property="og:image:secure_url" content="{{ asset('images/logo-jatim.png') }}">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="512">
    <meta property="og:image:height" content="512">
    <meta property="og:image:alt" content="Logo Provinsi Jawa Timur - Cabang Dinas Pendidikan Gresik">
    <!-- 4. TWITTER / X CARD -->
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="@yield('title', 'Cabang Dinas Pendidikan Wilayah Kabupaten Gresik')">
    <meta name="twitter:description" content="Portal Resmi Cabang Dinas Pendidikan Wilayah Kabupaten Gresik Dinas Pendidikan Provinsi Jawa Timur.">
    <meta name="twitter:image" content="{{ asset('images/logo-jatim.png') }}">
    <!-- 5. GOOGLE STRUCTURED DATA / SCHEMA.ORG (Untuk Google Search Knowledge Panel & Logo Resmi) -->
    <script type="application/ld+json">
    {!! json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'GovernmentOrganization',
        'name' => 'Cabang Dinas Pendidikan Wilayah Kabupaten Gresik',
        'alternateName' => 'Cabdin Gresik - Dinas Pendidikan Provinsi Jawa Timur',
        'url' => url('/'),
        'logo' => asset('images/logo-jatim.png'),
        'image' => asset('images/logo-jatim.png'),
        'description' => "Portal Resmi Cabang Dinas Pendidikan Wilayah Kabupaten Gresik Dinas Pendidikan Provinsi Jawa Timur.",
        'address' => [
            '@type' => 'PostalAddress',
            'addressLocality' => 'Gresik',
            'addressRegion' => 'Jawa Timur',
            "addressCountry" => "ID"
        ]
    ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
    
    </script>


    <!-- Per-page Open Graph / Twitter meta -->
    @yield('meta')

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- CSS Main Stylesheet -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    <!-- TOP HEADER -->
    <header class="top-header">
        <div class="container-wide header-container">
            <div class="brand-section">
                <!-- Logo Dinas Pendidikan Jatim/Gresik -->
                <img src="{{ asset('images/logo-jatim.svg') }}" alt="Logo Provinsi Jawa Timur" class="logo-dinas">
                <div class="brand-text">
                    <h1>Cabang Dinas Pendidikan</h1>
                    <p>Wilayah Kabupaten Gresik • Dinas Pendidikan Provinsi Jawa Timur</p>
                </div>
            </div>

            <!-- WA Hotline Pengaduan -->
            <a href="https://wa.me/6282334567890?text=Assalamu%27alaikum%2C%20saya%20ingin%20menyampaikan%20pengaduan%20kepada%20Cabdin%20Pendidikan%20Gresik." target="_blank" rel="noopener" class="wa-hotline-btn" id="wa-hotline-header" aria-label="Hubungi via WhatsApp">
                <div class="wa-hotline-icon">
                    <svg viewBox="0 0 24 24" fill="currentColor" width="26" height="26">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                    </svg>
                </div>
                <div class="wa-hotline-text">
                    <span class="wa-hotline-label">Hotline Pengaduan</span>
                    <span class="wa-hotline-number">0878-5462-2309</span>
                </div>
            </a>
        </div>
    </header>

    <!-- NAVIGATION BAR -->
    <nav class="main-navbar">
        <div class="container-wide nav-container">
            <ul class="nav-links">
                <!-- Beranda -->
                <li class="nav-item {{ Route::is('home') ? 'active' : '' }}">
                    <a href="{{ route('home') }}" class="nav-link">Beranda</a>
                </li>

                <!-- Profil -->
                <li class="nav-item {{ Route::is('profile') ? 'active' : '' }}">
                    <a href="#" class="nav-link">Profil <i class="bi bi-chevron-down" style="font-size: 10px; margin-left: 2px;"></i></a>
                    <ul class="dropdown-menu">
                        <li class="dropdown-item"><a href="{{ route('profile') }}#tentang-kami">Tentang Kami</a></li>
                        <li class="dropdown-item"><a href="{{ route('profile') }}#visi-misi">Visi &amp; Misi</a></li>
                        <li class="dropdown-item"><a href="{{ route('profile') }}#struktur-organisasi">Struktur Organisasi</a></li>
                    </ul>
                </li>

                <!-- Data Pendidikan -->
                <li class="nav-item {{ Route::is('mkks.show') ? 'active' : '' }}">
                    <a href="#" class="nav-link">Data Pendidikan <i class="bi bi-chevron-down" style="font-size: 10px; margin-left: 2px;"></i></a>
                    <ul class="dropdown-menu">
                        <li class="dropdown-item">
                            <a href="{{ route('mkks.show', ['category' => 'sma']) }}">
                                Data SMA
                            </a>
                        </li>
                        <li class="dropdown-item">
                            <a href="{{ route('mkks.show', ['category' => 'smk']) }}">
                                Data SMK
                            </a>
                        </li>
                        <li class="dropdown-item">
                            <a href="{{ route('mkks.show', ['category' => 'pk-plk']) }}">
                                Data PK/PLK
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Layanan -->
                <li class="nav-item {{ Route::is('services.*') || Route::is('skm') || Route::is('pengaduan') ? 'active' : '' }}">
                    <a href="#" class="nav-link">Layanan <i class="bi bi-chevron-down" style="font-size: 10px; margin-left: 2px;"></i></a>
                    <ul class="dropdown-menu">
                        <li class="dropdown-item"><a href="{{ route('services.index') }}">Layanan Cabdin</a></li>
                        <li class="dropdown-item"><a href="{{ route('skm') }}">Survei Kepuasan Masyarakat (SKM)</a></li>
                        <li class="dropdown-item" style="border-top: 1px solid #e5e7eb; margin-top: 4px; padding-top: 4px;"><a href="{{ route('pengaduan') }}">Pengaduan Masyarakat</a></li>
                    </ul>
                </li>

                <!-- Publikasi (Berita + Pengumuman + Inovasi + Prestasi) -->
                <li class="nav-item {{ Route::is('posts.*') ? 'active' : '' }}">
                    <a href="#" class="nav-link">Publikasi <i class="bi bi-chevron-down" style="font-size: 10px; margin-left: 2px;"></i></a>
                    <ul class="dropdown-menu">
                        <li class="dropdown-item"><a href="{{ route('posts.index', ['type' => 'berita']) }}">Berita</a></li>
                        <li class="dropdown-item"><a href="{{ route('posts.index', ['type' => 'pengumuman']) }}">Pengumuman</a></li>
                        <li class="dropdown-item" style="border-top: 1px solid #e5e7eb; margin-top: 4px; padding-top: 4px;"><a href="{{ route('posts.index', ['type' => 'inovasi']) }}">Inovasi Sekolah</a></li>
                        <li class="dropdown-item"><a href="{{ route('posts.index', ['type' => 'prestasi']) }}">Prestasi Sekolah</a></li>
                         <li class="dropdown-item"><a href="{{ route('kegiatan.index') }}">Kegiatan</a></li>
                    </ul>
                </li>

                <!-- Download -->
                <li class="nav-item {{ Route::is('download') ? 'active' : '' }}">
                    <a href="{{ route('download') }}" class="nav-link">Download</a>
                </li>

                <!-- FAQ -->
                <li class="nav-item {{ Route::is('faq') ? 'active' : '' }}">
                    <a href="{{ route('faq') }}" class="nav-link">FAQ</a>
                </li>

                <li class="nav-item {{ Route::is('kontak') ? 'active' : '' }}">
                    <a href="{{ route('kontak') }}" class="nav-link">Kontak</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- CONTENT AREA -->
    <main>
        @yield('content')
    </main>

    <!-- FOOTER -->
    <footer class="main-footer">
        <div class="container-wide footer-grid">
            <div class="footer-col footer-about">
                <h3>Cabdin Wilayah Gresik</h3>
                <p>Cabang Dinas Pendidikan Wilayah Kabupaten Gresik melayani pembinaan, pengawasan, pelayanan administrasi sekolah menengah atas, kejuruan, serta pendidikan khusus di wilayah Gresik.</p>
                <p>&copy; {{ date('Y') }} Cabang Dinas Pendidikan Wilayah Kabupaten Gresik. Hak Cipta Dilindungi.</p>
            </div>
            <div class="footer-col">
                <h3>Pintasan Link</h3>
                <ul class="footer-links">
                    <li><a href="https://lapor.go.id/" target="_blank" rel="noopener">Lapor.go.id</a></li>
                    <li><a href="https://kemendikdasmen.go.id/" target="_blank" rel="noopener">Kemendikdasmen</a></li>
                    <li><a href="https://gtk.kemendikdasmengo.id/" target="_blank" rel="noopener">Gtk.Kemendikdasmen</a></li>
                      <li><a href="https://bosp.kemendikdasmengo.id/" target="_blank" rel="noopener">Bosp.Kemendikdasmen</a></li>
                    <li><a href="https://dapo.kemdikbud.go.id/" target="_blank" rel="noopener">Dapodik Pusat</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h3>Hubungi Kami</h3>
                <ul class="contact-info">
                    <li><i class="bi bi-geo-alt-fill text-warning" style="margin-right: 8px;"></i> Jl. Dr. Wahidin Sudirohusodo No.229, Kembangan, Gresik, Jawa Timur</li>
                    <li><i class="bi bi-telephone-fill text-warning" style="margin-right: 8px;"></i> (031) 39923400</li>
                    <li><i class="bi bi-envelope-fill text-warning" style="margin-right: 8px;"></i> cabdinkabgresik.gmail.com</li>
                    <li><i class="bi bi-clock-fill text-warning" style="margin-right: 8px;"></i> Senin - Jumat: 07.30 - 16.00 WIB</li>
                </ul>
            </div>

            <!-- Kolom Sosial Media -->
            <div class="footer-col footer-social-col">
                <h3>Ikuti &amp; Bagikan</h3>
                <p style="font-size: 13px; color: rgba(255,255,255,0.55); margin-bottom: 18px; line-height: 1.6;">Tetap terhubung dan bagikan informasi pendidikan Gresik melalui media sosial kami.</p>
                <div class="footer-share-box" style="border-top: none; padding-top: 0;">
                    <p style="font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.8px; color: rgba(255,255,255,0.45); margin-bottom: 12px;">Media Sosial &amp; Bagikan</p>
                    <div class="footer-share-btns">
                        <!-- Facebook -->
                        <a href="https://www.facebook.com/cabdingresik" target="_blank" rel="noopener" class="share-mini-btn share-fb-mini" title="Facebook">
                            <svg viewBox="0 0 24 24" fill="currentColor" width="16" height="16"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                        <!-- Twitter / X -->
                        <button onclick="shareTo('twitter')" class="share-mini-btn share-tw-mini" title="Bagikan ke Twitter/X">
                            <svg viewBox="0 0 24 24" fill="currentColor" width="16" height="16"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                        </button>
                        <!-- Instagram -->
                        <a href="https://www.instagram.com/cabdin.gresik" target="_blank" rel="noopener" class="share-mini-btn share-ig-mini" title="Instagram">
                            <svg viewBox="0 0 24 24" fill="currentColor" width="16" height="16"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                        </a>
                        <!-- Telegram -->
                        <button onclick="shareTo('telegram')" class="share-mini-btn share-tg-mini" title="Bagikan ke Telegram">
                            <svg viewBox="0 0 24 24" fill="currentColor" width="16" height="16"><path d="M11.944 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0a12 12 0 0 0-.056 0zm4.962 7.224c.1-.002.321.023.465.14a.506.506 0 0 1 .171.325c.016.093.036.306.02.472-.18 1.898-.962 6.502-1.36 8.627-.168.9-.499 1.201-.82 1.23-.696.065-1.225-.46-1.9-.902-1.056-.693-1.653-1.124-2.678-1.8-1.185-.78-.417-1.21.258-1.91.177-.184 3.247-2.977 3.307-3.23.007-.032.014-.15-.056-.212s-.174-.041-.249-.024c-.106.024-1.793 1.14-5.061 3.345-.48.33-.913.49-1.302.48-.428-.008-1.252-.241-1.865-.44-.752-.245-1.349-.374-1.297-.789.027-.216.325-.437.893-.663 3.498-1.524 5.83-2.529 6.998-3.014 3.332-1.386 4.025-1.627 4.476-1.635z"/></svg>
                        </button>
                        <!-- Email -->
                        <a href="mailto:cabdinkabgresik@gmail" class="share-mini-btn share-em-mini" title="Kirim Email">
                            <svg viewBox="0 0 24 24" fill="currentColor" width="16" height="16"><path d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            Dikelola secara resmi oleh Tim IT Cabang Dinas Pendidikan Wilayah Kabupaten Gresik.
        </div>
    </footer>

    <!-- Share Script -->
    <script>
    function shareTo(platform) {
        const url = encodeURIComponent(window.location.href);
        const title = encodeURIComponent(document.title);
        const shareUrls = {
            facebook: `https://www.facebook.com/sharer/sharer.php?u=${url}`,
            twitter:  `https://twitter.com/intent/tweet?url=${url}&text=${title}`,
            telegram: `https://t.me/share/url?url=${url}&text=${title}`
        };
        if (shareUrls[platform]) {
            window.open(shareUrls[platform], '_blank', 'width=600,height=500,noopener,noreferrer');
        }
    }
    </script>

    <!-- Slider Javascript -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const slides = document.querySelectorAll('.hero-slider .slide');
            const dots = document.querySelectorAll('.hero-slider .slider-dot');
            const prevBtn = document.querySelector('.hero-slider .prev-btn');
            const nextBtn = document.querySelector('.hero-slider .next-btn');
            let currentSlide = 0;
            let slideInterval;

            if (slides.length <= 1) return;

            function showSlide(index) {
                slides[currentSlide].classList.remove('active');
                if (dots.length > 0) dots[currentSlide].classList.remove('active');
                
                currentSlide = (index + slides.length) % slides.length;
                
                slides[currentSlide].classList.add('active');
                if (dots.length > 0) dots[currentSlide].classList.add('active');
            }

            function nextSlide() {
                showSlide(currentSlide + 1);
            }

            function prevSlide() {
                showSlide(currentSlide - 1);
            }

            function startSlideShow() {
                slideInterval = setInterval(nextSlide, 5000);
            }

            function resetSlideShow() {
                clearInterval(slideInterval);
                startSlideShow();
            }

            if (nextBtn) {
                nextBtn.addEventListener('click', () => {
                    nextSlide();
                    resetSlideShow();
                });
            }

            if (prevBtn) {
                prevBtn.addEventListener('click', () => {
                    prevSlide();
                    resetSlideShow();
                });
            }

            dots.forEach((dot, index) => {
                dot.addEventListener('click', () => {
                    showSlide(index);
                    resetSlideShow();
                });
            });

            startSlideShow();

        });
        </script>

    @yield('scripts')

</body>
</html>
