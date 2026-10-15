@extends('layouts.public')

@section('title', 'Beranda - Cabang Dinas Pendidikan Wilayah Kabupaten Gresik')

@section('content')

<!-- HERO SLIDER / BANNER UTAMA -->
<section class="hero-slider">
    <div class="slider-container">
        @if($sliders->isNotEmpty())
            @foreach($sliders as $index => $slide)
            <div class="slide {{ $index === 0 ? 'active' : '' }}" style="background-image: url('{{ $slide->image ? asset('storage/'.$slide->image) : 'https://images.unsplash.com/photo-1541339907198-e08756dedf3f?q=80&w=1200&auto=format&fit=crop' }}');">
                <div class="container-wide" style="height: 100%; display: flex; align-items: center;">
                    <div class="slide-content">
                        <span class="slide-category">Informasi Terbaru</span>
                        <h2 class="slide-title">{{ $slide->title }}</h2>
                        @if($slide->excerpt)
                            <p class="slide-excerpt">{{ Str::limit(strip_tags(html_entity_decode($slide->excerpt)), 150) }}</p>
                        @endif
                        @if($slide->link_url)
                            <a href="{{ $slide->link_url }}" class="btn btn-primary">Selengkapnya</a>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        @else
            @forelse($sliderPosts as $index => $post)
                <div class="slide {{ $index === 0 ? 'active' : '' }}" style="background-image: url('{{ $post->image ? (Str::startsWith($post->image, 'http') ? $post->image : asset('storage/' . $post->image)) : 'https://images.unsplash.com/photo-1541339907198-e08756dedf3f?q=80&w=1200&auto=format&fit=crop' }}');">
                    <div class="container-wide" style="height: 100%; display: flex; align-items: center;">
                        <div class="slide-content">
                            <span class="slide-category">{{ $post->type }}</span>
                            <h2 class="slide-title">{{ $post->title }}</h2>
                            <p class="slide-excerpt">{{ Str::limit(strip_tags($post->content), 120) }}</p>
                            <a href="{{ route('posts.show', $post->slug) }}" class="btn btn-primary">Baca Selengkapnya</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="slide active" style="background-image: url('https://images.unsplash.com/photo-1541339907198-e08756dedf3f?q=80&w=1200&auto=format&fit=crop');">
                    <div class="container-wide" style="height: 100%; display: flex; align-items: center;">
                        <div class="slide-content">
                            <span class="slide-category">Selamat Datang</span>
                            <h2 class="slide-title">Portal Resmi Cabang Dinas Pendidikan Wilayah Kabupaten Gresik</h2>
                            <p class="slide-excerpt">Menyajikan informasi pelayanan publik, berita sekolah, serta program kerja SMA, SMK, dan Pendidikan Khusus di Gresik.</p>
                            <a href="{{ route('profile') }}" class="btn btn-primary">Profil Kami</a>
                        </div>
                    </div>
                </div>
            @endforelse
        @endif
    </div>

    @php $slideCount = $sliders->isNotEmpty() ? $sliders->count() : $sliderPosts->count(); @endphp
    @if($slideCount > 1)
        <div class="slider-controls">
            <button class="slider-btn prev-btn">&laquo;</button>
            <button class="slider-btn next-btn">&raquo;</button>
        </div>
        <div class="slider-dots">
            @for($i = 0; $i < $slideCount; $i++)
                <span class="slider-dot {{ $i === 0 ? 'active' : '' }}" data-slide="{{ $i }}"></span>
            @endfor
        </div>
    @endif
</section>

<!-- MAIN CONTENT SECTION (SAMBUTAN & PENGUMUMAN) -->
<section class="main-section" style="padding-bottom: 20px;">
    <div class="container-wide grid-2" style="align-items: start;">
        
        <!-- KOLOM KIRI (SAMBUTAN & BERITA) -->
        <div class="col-left">
            
            <div class="card">
                <h2 class="section-title">Sambutan Kepala Cabang Dinas</h2>
                <div class="welcome-box">
                    <div class="welcome-img-container">
                        <!-- Foto Kepala Cabdin -->
                        <img src="{{ $sambutanFoto && $sambutanFoto->image ? asset('storage/' . $sambutanFoto->image) : asset('images/kepala_dinas.jpg') }}" alt="{{ $sambutanNama ? $sambutanNama->content : 'Dr. S. Hariyanto, S.Pd., M.M.' }}" style="width: 100%; height: auto; max-height: 450px; object-fit: cover; display: block; border-radius: var(--radius-md);">
                    </div>
                    <div class="welcome-text">
                        <div style="font-size: 14px; margin-bottom: 15px; color: var(--text-muted); text-align: justify; line-height: 1.7;">
                            {!! $sambutanTeks ? $sambutanTeks->content : "Assalamu’alaikum Warahmatullahi Wabarakatuh,<br><br>Selamat datang di portal informasi resmi Cabang Dinas Pendidikan Wilayah Kabupaten Gresik. Kami berkomitmen memberikan pelayanan prima, transparan, dan akuntabel guna mendukung akselerasi mutu pendidikan menengah atas, kejuruan, serta pendidikan khusus di wilayah Kabupaten Gresik demi mencetak generasi unggul yang berkarakter Jawa Timur." !!}
</div>
                        <strong style="font-size: 14px; color: var(--primary);">- {{ $sambutanNama ? $sambutanNama->content : 'Dr. S. Hariyanto, S.Pd., M.M.' }}</strong>
                        <span style="display: block; font-size: 12px; color: var(--text-muted); margin-top: 2px;">{{ $sambutanTitle ? $sambutanTitle->content : 'Kepala Cabang Dinas Pendidikan Wilayah Kabupaten Gresik' }}</span>
                    </div>
                </div>
            </div>

            <!-- ============================================================ -->
            <!-- STATS GRID WIDGET — DATA PENDIDIKAN GRESIK                   -->
            <!-- ============================================================ -->
            <style>
            .stat-card {
                background: #ffffff;
                border: 1px solid var(--border);
                padding: 14px 12px;
                border-radius: var(--radius-md);
                display: flex;
                align-items: center;
                gap: 12px;
                cursor: default;
                position: relative;
                overflow: hidden;
                transition:
                    transform 0.28s cubic-bezier(.34,1.56,.64,1),
                    box-shadow 0.28s ease,
                    border-color 0.25s ease;
            }
            .stat-card::before {
                content: '';
                position: absolute;
                inset: 0;
                background: inherit;
                opacity: 0;
                transition: opacity 0.25s ease;
            }
            .stat-card:hover {
                transform: translateY(-5px) scale(1.03);
                box-shadow: 0 10px 30px rgba(0,0,0,0.12);
            }
            .stat-card.sma:hover   { border-color: #1e3a5f; box-shadow: 0 10px 30px rgba(30,58,95,0.18); }
            .stat-card.smk:hover   { border-color: #1a4a6b; box-shadow: 0 10px 30px rgba(26,74,107,0.18); }
            .stat-card.plk:hover   { border-color: #2e5c80; box-shadow: 0 10px 30px rgba(46,92,128,0.18); }
            .stat-card.staff:hover { border-color: #374151; box-shadow: 0 10px 30px rgba(55,65,81,0.18); }

            .stat-icon-ring {
                width: 44px;
                height: 44px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 20px;
                flex-shrink: 0;
                transition: transform 0.35s cubic-bezier(.34,1.56,.64,1), box-shadow 0.3s ease;
            }
            .stat-card:hover .stat-icon-ring {
                transform: rotate(-10deg) scale(1.18);
                box-shadow: 0 4px 14px currentColor;
            }
            .stat-num {
                font-size: 22px;
                font-weight: 900;
                line-height: 1;
                transition: color 0.25s ease;
            }
            .stat-label {
                font-size: 11px;
                font-weight: 700;
                color: var(--text-muted);
                margin-top: 3px;
                letter-spacing: 0.3px;
                text-transform: uppercase;
            }
            .stat-card:hover .stat-num { opacity: 0.85; }
            </style>

            <div class="card" style="margin-top: 20px; padding: 16px 20px; border-left: 4px solid #1e3a5f;">
                <h3 style="font-size: 12.5px; font-weight: 700; color: #1e3a5f; margin-bottom: 14px; display: flex; align-items: center; gap: 8px; text-transform: uppercase; letter-spacing: 0.6px;">
                    <i class="bi bi-bar-chart-fill"></i> Data Pendidikan Wilayah Kab. Gresik
                </h3>
                <div class="stats-grid-4">

                    <!-- SMA — Navy Blue -->
                    <div class="stat-card sma">
                        <div class="stat-icon-ring" style="background: rgba(30,58,95,0.08); color: #1e3a5f;">
                            <i class="bi bi-building-fill"></i>
                        </div>
                        <div>
                            <div class="stat-num" style="color: #1e3a5f;">52</div>
                            <div class="stat-label">SMA</div>
                        </div>
                    </div>

                    <!-- SMK — Steel Blue -->
                    <div class="stat-card smk">
                        <div class="stat-icon-ring" style="background: rgba(26,74,107,0.08); color: #1a4a6b;">
                            <i class="bi bi-building-fill"></i>
                        </div>
                        <div>
                            <div class="stat-num" style="color: #1a4a6b;">62</div>
                            <div class="stat-label">SMK</div>
                        </div>
                    </div>

                    <!-- PK/PLK — Aegean Blue -->
                    <div class="stat-card plk">
                        <div class="stat-icon-ring" style="background: rgba(46,92,128,0.08); color: #2e5c80;">
                            <i class="bi bi-building-fill"></i>
                        </div>
                        <div>
                            <div class="stat-num" style="color: #2e5c80;">8</div>
                            <div class="stat-label">PK/PLK</div>
                        </div>
                    </div>

                    <!-- Staff Cabdin — Charcoal -->
                    <div class="stat-card staff">
                        <div class="stat-icon-ring" style="background: rgba(55,65,81,0.08); color: #374151;">
                            <i class="bi bi-person-badge-fill"></i>
                        </div>
                        <div>
                            <div class="stat-num" style="color: #374151;">36</div>
                            <div class="stat-label">Staff Cabdin</div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- ============================================================ -->
            <!-- CARD QUOTES SLIDER — INSPIRASI PENDIDIKAN GRESIK             -->
            <!-- ============================================================ -->
            @php
                $quotes = [];
                for ($i = 1; $i <= 3; $i++) {
                    $qsData = ${"quoteSlide".$i};
                    if ($qsData && $qsData->content) {
                        $content = json_decode($qsData->content, true);
                        if (!empty($content)) {
                            $quotes[] = [
                                'image' => $qsData->image ? asset('storage/' . $qsData->image) : null,
                                'badge_icon' => $content['badge_icon'] ?? 'bi-star-fill',
                                'badge_text' => $content['badge_text'] ?? 'Kutipan',
                                'quote' => $content['quote'] ?? '',
                                'author_name' => $content['author_name'] ?? '',
                                'author_title' => $content['author_title'] ?? '',
                            ];
                        }
                    }
                }
                
                // Fallback jika belum diisi dari admin
                if (empty($quotes)) {
                    $quotes = [
                        [
                            'image' => 'https://images.unsplash.com/photo-1503676260728-1c00da094a0b?q=80&w=1200&auto=format&fit=crop',
                            'badge_icon' => 'bi-mortarboard-fill',
                            'badge_text' => 'Pendidikan Gresik',
                            'quote' => '"Pendidikan bukan sekadar mengisi ember, melainkan menyalakan api semangat dalam diri setiap anak bangsa."',
                            'author_name' => 'Cabang Dinas Pendidikan',
                            'author_title' => 'Wilayah Kabupaten Gresik',
                        ],
                        [
                            'image' => 'https://images.unsplash.com/photo-1580582932707-520aed937b7b?q=80&w=1200&auto=format&fit=crop',
                            'badge_icon' => 'bi-award-fill',
                            'badge_text' => 'Prestasi & Inovasi',
                            'quote' => '"Setiap siswa Gresik adalah bintang yang menunggu untuk bersinar — tugas kami memastikan mereka mendapat panggung terbaik."',
                            'author_name' => 'Dr. S. Hariyanto, S.Pd., M.M.',
                            'author_title' => 'Kepala Cabang Dinas Pendidikan Gresik',
                        ],
                        [
                            'image' => 'https://images.unsplash.com/photo-1427504494785-3a9ca7044f45?q=80&w=1200&auto=format&fit=crop',
                            'badge_icon' => 'bi-people-fill',
                            'badge_text' => 'Bersama Membangun',
                            'quote' => '"Kualitas pendidikan hari ini adalah fondasi kemajuan Kabupaten Gresik di masa mendatang. Mari bersama mewujudkannya."',
                            'author_name' => 'Dinas Pendidikan Jatim',
                            'author_title' => 'Cabang Wilayah Kabupaten Gresik',
                        ]
                    ];
                }
            @endphp
            <div class="card quotes-slider-card" id="quotes-slider-card" style="margin-top: 20px; padding: 0; overflow: hidden; height: 220px; position: relative; border-top: 4px solid var(--secondary);">
                <div class="qs-track" id="qs-track" style="position: relative; width: 100%; height: 100%;">

                    @foreach($quotes as $index => $q)
                    <div class="qs-slide {{ $index === 0 ? 'active' : '' }}" style="background-image: url('{{ $q['image'] ?? 'https://images.unsplash.com/photo-1503676260728-1c00da094a0b?q=80&w=1200&auto=format&fit=crop' }}');">
                        <div class="qs-overlay"></div>
                        <div class="qs-content">
                            @if($q['badge_text'])
                                <div class="qs-badge"><i class="bi {{ $q['badge_icon'] }}"></i> {{ $q['badge_text'] }}</div>
                            @endif
                            <blockquote class="qs-quote">
                                {!! nl2br(e($q['quote'])) !!}
                            </blockquote>
                            <div class="qs-author">
                                <span class="qs-author-name">{{ $q['author_name'] }}</span>
                                <span class="qs-author-sub">{{ $q['author_title'] }}</span>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div><!-- end .qs-track -->

                <!-- Progress Bar -->
                <div class="qs-progress-bar"><div class="qs-progress-fill" id="qs-progress-fill"></div></div>

                <!-- Dots Navigation -->
                <div class="qs-dots" id="qs-dots">
                    <span class="qs-dot active" data-idx="0"></span>
                    <span class="qs-dot" data-idx="1"></span>
                    <span class="qs-dot" data-idx="2"></span>
                </div>

                <!-- Prev / Next Buttons -->
                <button class="qs-nav qs-prev" id="qs-prev" aria-label="Sebelumnya"><i class="bi bi-chevron-left"></i></button>
                <button class="qs-nav qs-next" id="qs-next" aria-label="Berikutnya"><i class="bi bi-chevron-right"></i></button>
            </div>

            <style>
            /* ===== QUOTES SLIDER STYLES (MATCHES GREETING CARD WIDTH) ===== */
            .quotes-slider-card {
                background: #0b1f3f;
                box-shadow: var(--shadow-sm);

            }
            .qs-slide {
                position: absolute;
                inset: 0;
                background-size: cover;
                background-position: center;
                opacity: 0;
                transition: opacity 0.8s ease-in-out;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            .qs-slide.active {
                opacity: 1;
                z-index: 1;
            }
            .qs-slide.leaving {
                opacity: 0;
                z-index: 0;
            }
            .qs-overlay {
                position: absolute;
                inset: 0;
                background: linear-gradient(
                    135deg,
                    rgba(11, 31, 63, 0.88) 0%,
                    rgba(11, 31, 63, 0.75) 50%,
                    rgba(2, 89, 150, 0.65) 100-percent
                );
                background-color: rgba(11, 31, 63, 0.8);
            }
            .qs-content {
                position: relative;
                z-index: 2;
                max-width: 100%;
                padding: 0 45px;
                text-align: center;
                animation: qs-fade-up 0.6s ease both;
            }
            @keyframes qs-fade-up {
                from { opacity: 0; transform: translateY(15px); }
                to   { opacity: 1; transform: translateY(0); }
            }
            .qs-badge {
                display: inline-flex;
                align-items: center;
                gap: 5px;
                background: rgba(255,255,255,0.1);
                backdrop-filter: blur(4px);
                border: 1px solid rgba(255,255,255,0.2);
                color: #93c5fd;
                font-size: 10px;
                font-weight: 700;
                letter-spacing: 0.5px;
                text-transform: uppercase;
                padding: 3px 12px;
                border-radius: 50px;
                margin-bottom: 12px;
            }
            .qs-quote {
                font-size: clamp(13px, 1.6vw, 15px);
                font-weight: 550;
                color: #ffffff;
                line-height: 1.5;
                font-style: italic;
                margin: 0 0 12px 0;
                text-shadow: 0 1px 4px rgba(0,0,0,0.3);
                position: relative;
            }
            .qs-quote::before {
                content: '\201C';
                font-size: 50px;
                color: rgba(147, 197, 253, 0.25);
                position: absolute;
                top: -20px;
                left: -15px;
                font-style: normal;
                line-height: 1;
                font-family: Georgia, serif;
            }
            .qs-author {
                display: flex;
                flex-direction: column;
                align-items: center;
                gap: 2px;
            }
            .qs-author::before {
                content: '';
                display: block;
                width: 30px;
                height: 1.5px;
                background: linear-gradient(90deg, #3b82f6, #93c5fd);
                border-radius: 1px;
                margin-bottom: 6px;
            }
            .qs-author-name {
                font-size: 12px;
                font-weight: 700;
                color: #93c5fd;
            }
            .qs-author-sub {
                font-size: 10px;
                color: rgba(255,255,255,0.55);
                font-weight: 500;
            }
            /* Progress Bar */
            .qs-progress-bar {
                position: absolute;
                bottom: 0;
                left: 0;
                right: 0;
                height: 3px;
                background: rgba(255,255,255,0.1);
                z-index: 10;
            }
            .qs-progress-fill {
                height: 100%;
                width: 0%;
                background: linear-gradient(90deg, #3b82f6, #93c5fd);
                transition: width linear;
            }
            /* Dots */
            .qs-dots {
                position: absolute;
                bottom: 12px;
                left: 50%;
                transform: translateX(-50%);
                display: flex;
                gap: 6px;
                z-index: 10;
            }
            .qs-dot {
                width: 6px;
                height: 6px;
                border-radius: 50%;
                background: rgba(255,255,255,0.3);
                cursor: pointer;
                transition: all 0.3s ease;
            }
            .qs-dot.active {
                background: #93c5fd;
                width: 16px;
                border-radius: 3px;
            }
            /* Nav Buttons */
            .qs-nav {
                position: absolute;
                top: 50%;
                transform: translateY(-50%);
                z-index: 10;
                background: rgba(255,255,255,0.08);
                backdrop-filter: blur(4px);
                border: 1px solid rgba(255,255,255,0.15);
                color: white;
                width: 32px;
                height: 32px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                transition: all 0.3s ease;
                font-size: 12px;
            }
            .qs-nav:hover {
                background: rgba(59, 130, 246, 0.4);
                border-color: #3b82f6;
            }
            .qs-prev { left: 10px; }
            .qs-next { right: 10px; }
            @media (max-width: 768px) {
                .stats-grid-4 {
                    grid-template-columns: repeat(2, 1fr) !important;
                }
            }
            @media (max-width: 480px) {
                .stats-grid-4 {
                    grid-template-columns: 1fr !important;
                }
            }
            </style>

            <script>
            (function() {
                const DURATION = 6000;
                let current = 0;
                let timer, progressTimer;

                const slides = document.querySelectorAll('.qs-slide');
                const dots   = document.querySelectorAll('.qs-dot');
                const fill   = document.getElementById('qs-progress-fill');
                const prev   = document.getElementById('qs-prev');
                const next   = document.getElementById('qs-next');
                const total  = slides.length;

                function goTo(idx) {
                    if (total === 0) return;
                    slides[current].classList.remove('active');
                    dots[current].classList.remove('active');

                    current = (idx + total) % total;

                    slides[current].classList.add('active');
                    dots[current].classList.add('active');

                    const content = slides[current].querySelector('.qs-content');
                    if (content) {
                        content.style.animation = 'none';
                        content.offsetHeight;
                        content.style.animation = '';
                    }

                    resetProgress();
                }

                function resetProgress() {
                    clearInterval(progressTimer);
                    if (fill) {
                        fill.style.transition = 'none';
                        fill.style.width = '0%';
                        fill.offsetHeight;
                        fill.style.transition = `width ${DURATION}ms linear`;
                        fill.style.width = '100%';
                    }
                }

                function startAuto() {
                    clearInterval(timer);
                    timer = setInterval(() => goTo(current + 1), DURATION);
                    resetProgress();
                }

                function stopAuto() {
                    clearInterval(timer);
                    if (fill) {
                        const computed = getComputedStyle(fill).width;
                        const parent = fill.parentElement.offsetWidth;
                        const pct = (parseFloat(computed) / parent * 100).toFixed(1);
                        fill.style.transition = 'none';
                        fill.style.width = pct + '%';
                    }
                }

                if (prev) prev.addEventListener('click', (e) => { e.stopPropagation(); goTo(current - 1); startAuto(); });
                if (next) next.addEventListener('click', (e) => { e.stopPropagation(); goTo(current + 1); startAuto(); });

                dots.forEach(dot => {
                    dot.addEventListener('click', (e) => {
                        e.stopPropagation();
                        goTo(parseInt(dot.dataset.idx));
                        startAuto();
                    });
                });

                const section = document.getElementById('quotes-slider-card');
                if (section) {
                    section.addEventListener('mouseenter', stopAuto);
                    section.addEventListener('mouseleave', startAuto);
                }

                startAuto();
            })();

            document.addEventListener('DOMContentLoaded', function() {
                const slides = document.querySelectorAll('.side-ad-slide');
                let current = 0;
                const total = slides.length;
                if (total <= 1) return;

                function nextSlide() {
                    slides[current].style.opacity = '0';
                    slides[current].classList.remove('active');
                    current = (current + 1) % total;
                    slides[current].style.opacity = '1';
                    slides[current].classList.add('active');
                }

                setInterval(nextSlide, 4000);
            });
            </script>

        </div>

        <!-- KOLOM KANAN (SIDEBAR: PENGUMUMAN & TAUTAN) -->
        <aside class="col-right">
            
            <div class="widget" style="border-top: 4px solid var(--primary); padding: 0; overflow: hidden; background: none; box-shadow: none; margin-bottom: 30px;">
                <div class="side-ad-track" id="side-ad-track" style="position: relative; width: 100%; margin: 0 auto; aspect-ratio: 4/5; border-radius: var(--radius-md); overflow: hidden; box-shadow: var(--shadow-sm);">
                    <div class="side-ad-slide active" style="position: absolute; inset: 0; opacity: 1; transition: opacity 0.8s ease-in-out;">
                        <img src="{{ $sideSlider1 && $sideSlider1->image ? asset('storage/' . $sideSlider1->image) : asset('images/instagram_placeholder_1786066138135.jpg') }}" alt="Promo 1" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    <div class="side-ad-slide" style="position: absolute; inset: 0; opacity: 0; transition: opacity 0.8s ease-in-out;">
                        <img src="{{ $sideSlider2 && $sideSlider2->image ? asset('storage/' . $sideSlider2->image) : asset('images/instagram_placeholder_2_1786066451711.jpg') }}" alt="Promo 2" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                </div>
            </div>

            <!-- Widget Pengumuman -->
            <div class="widget" style="margin-bottom: 30px;">
                <h3 class="widget-title"><span><i class="bi bi-megaphone-fill"></i></span> Pengumuman Terbaru</h3>
                <ul class="announcement-list">
                    @forelse($latestAnnouncements->take(2) as $ann)
                        <li class="announcement-item">
                            <a href="{{ route('posts.show', $ann->slug) }}">
                                <h4 class="announcement-title">{{ $ann->title }}</h4>
                                <span class="announcement-date"><i class="bi bi-calendar-event" style="margin-right: 4px;"></i> {{ $ann->created_at->format('d M Y') }}</span>
                            </a>
                        </li>
                    @empty
                        <li style="font-size: 13px; color: var(--text-muted); text-align: center; padding: 15px 0;">
                            Tidak ada pengumuman baru.
                        </li>
                    @endforelse
                </ul>
                @if($latestAnnouncements->count() > 2)
                    <div style="text-align: center; margin-top: 15px; border-top: 1px solid var(--border); padding-top: 10px;">
                        <a href="{{ route('posts.index', ['type' => 'pengumuman']) }}" style="font-size: 12px; font-weight: 700; color: var(--secondary);">Semua Pengumuman</a>
                    </div>
                @endif
            </div>

                       <!-- Widget Agenda / Event -->
            <div class="widget" style="border-top: 4px solid var(--accent); padding: 14px 15px; margin-bottom: 30px;">
                <h3 class="widget-title" style="margin-bottom: 10px; padding-bottom: 7px;"><span><i class="bi bi-calendar-event-fill text-warning"></i></span> Acara & Kegiatan</h3>
                <div style="display: flex; flex-direction: column; gap: 11px;">
                    
                    @forelse($latestAgendas as $agenda)
                    <div style="display: flex; gap: 12px; align-items: center; border-bottom: 1px dashed var(--border); padding-bottom: 10px;">
                        <div style="position: relative; width: 90px; height: 60px; border-radius: var(--radius-sm); overflow: hidden; flex-shrink: 0; box-shadow: var(--shadow-sm); border: 1px solid var(--border);">
                            <img src="{{ $agenda->cover_image ? asset('storage/' . $agenda->cover_image) : 'https://images.unsplash.com/photo-1515187029135-18ee286d815b?q=80&w=300&auto=format&fit=crop' }}" alt="{{ $agenda->title }}" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                        <div style="flex-grow: 1;">
                            <h4 style="font-size: 12.5px; font-weight: 700; color: var(--primary); line-height: 1.35; margin-bottom: 3px; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">{{ $agenda->title }}</h4>
                            <div style="font-size: 10.5px; color: var(--text-muted); display: flex; flex-direction: column; gap: 2px;">
                                <span><i class="bi bi-calendar-event text-secondary" style="margin-right: 3px;"></i> {{ $agenda->event_date ? $agenda->event_date->format('d M Y • H:i') . ' WIB' : 'TBA' }}</span>
                                <span><i class="bi bi-geo-alt-fill text-danger" style="margin-right: 3px;"></i> {{ Str::limit($agenda->location ?? 'Cabdin Gresik', 20) }}</span>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div style="text-align: center; font-size: 12px; color: var(--text-muted); padding: 10px 0;">
                        Belum ada agenda/acara yang dijadwalkan.
                    </div>
                    @endforelse

                </div>
            </div>

                  
                </div>
            </div>

        </aside>

    </div>
</section>

<!-- SEKSI BERITA & KEGIATAN TERBARU -->
<section class="main-section" style="background-color: #f8fafc; border-top: 1px solid var(--border); border-bottom: 1px solid var(--border); padding-top: 20px; padding-bottom: 30px;">
    <div class="container-wide">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; flex-wrap: wrap; gap: 12px;">
            <h2 class="section-title" style="margin-bottom: 0;">Berita & Kegiatan Terbaru</h2>
            <a href="{{ route('posts.index', ['type' => 'berita']) }}" style="font-size: 13px; font-weight: 700; color: var(--secondary);">Lihat Semua →</a>
        </div>
        
        <div class="news-grid-3">
            @forelse($latestNews as $news)
                <article class="news-card">
                    <div class="news-img" style="background-image: url('{{ $news->image ? (Str::startsWith($news->image, 'http') ? $news->image : asset('storage/' . $news->image)) : 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?q=80&w=600&auto=format&fit=crop' }}');">
                        <span class="news-badge">{{ $news->type }}</span>
                    </div>
                    <div class="news-content">
                        <div class="news-meta" style="display: flex; align-items: center; gap: 12px; flex-wrap: wrap;">
                            <span><i class="bi bi-calendar-event" style="margin-right: 4px;"></i> {{ $news->created_at->format('d M Y') }}</span>
                            <span style="display: inline-flex; align-items: center; gap: 4px; color: #0369a1; font-weight: 600;">
                                <i class="bi bi-eye-fill"></i> {{ number_format($news->views) }}
                            </span>
                        </div>
                        <h3 class="news-title" style="display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">
                            <a href="{{ route('posts.show', $news->slug) }}">{{ $news->title }}</a>
                        </h3>
                        <p class="news-snippet">{{ Str::limit(strip_tags($news->content), 90) }}</p>
                        <a href="{{ route('posts.show', $news->slug) }}" class="read-more">Baca Selengkapnya <i class="bi bi-arrow-right" style="margin-left: 2px;"></i></a>
                    </div>
                </article>
            @empty
                <div class="card" style="grid-column: 1 / -1; text-align: center; color: var(--text-muted);">
                    Belum ada berita terbaru.
                </div>
            @endforelse
        </div>

        {{-- Pagination untuk Berita di Beranda --}}
        @if($latestNews->hasPages())
            <div class="pagination" style="margin-top: 40px; display: flex; justify-content: center; gap: 8px;">
                {{-- Previous Page Link --}}
                @if($latestNews->onFirstPage())
                    <span class="pagination-link" style="opacity: 0.5; cursor: not-allowed; padding: 8px 12px; border: 1px solid var(--border); border-radius: var(--radius-sm);">&laquo;</span>
                @else
                    <a href="{{ $latestNews->previousPageUrl() }}" class="pagination-link" style="padding: 8px 12px; border: 1px solid var(--border); border-radius: var(--radius-sm);">&laquo;</a>
                @endif

                {{-- Pagination Pages --}}
                @foreach ($latestNews->getUrlRange(1, $latestNews->lastPage()) as $page => $url)
                    @if ($page == $latestNews->currentPage())
                        <span class="pagination-link active" style="padding: 8px 12px; background-color: var(--secondary); color: white; border-radius: var(--radius-sm); font-weight: 700;">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="pagination-link" style="padding: 8px 12px; border: 1px solid var(--border); border-radius: var(--radius-sm); color: var(--primary);">{{ $page }}</a>
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if($latestNews->hasMorePages())
                    <a href="{{ $latestNews->nextPageUrl() }}" class="pagination-link" style="padding: 8px 12px; border: 1px solid var(--border); border-radius: var(--radius-sm);">&raquo;</a>
                @else
                    <span class="pagination-link" style="opacity: 0.5; cursor: not-allowed; padding: 8px 12px; border: 1px solid var(--border); border-radius: var(--radius-sm);">&raquo;</span>
                @endif
            </div>
        @endif
    </div>
</section>

<!-- SEKSI PRESTASI & INOVASI -->
<section class="main-section" style="background-color: #ffffff;">
    <div class="container-wide">
        
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; flex-wrap: wrap; gap: 12px;">
            <div>
                <h2 class="section-title" style="margin-bottom: 0;">Prestasi & Inovasi Sekolah</h2>
                <p style="font-size: 13px; color: var(--text-muted);">Karya inovatif dan prestasi kebanggaan luar biasa sekolah se-Kabupaten Gresik.</p>
            </div>
            <div style="display: flex; gap: 15px; align-items: center; flex-wrap: wrap;">
                <a href="{{ route('posts.index', ['type' => 'prestasi']) }}" style="font-size: 13px; font-weight: 700; color: var(--secondary);">Semua Prestasi</a>
                <span style="color: var(--border);">|</span>
                <a href="{{ route('posts.index', ['type' => 'inovasi']) }}" style="font-size: 13px; font-weight: 700; color: var(--secondary);">Semua Inovasi</a>
            </div>
        </div>

        <div class="merged-carousel-container" id="carousel-prestasi-inovasi" style="position: relative;">
            <div class="merged-carousel-track">
                @forelse($combinedPosts as $post)
                    <div class="merged-carousel-slide">
                        <div class="card" style="padding: 20px; cursor: pointer; transition: all 0.3s ease; margin-bottom: 0; height: 100%; display: flex; flex-direction: column;" onclick="window.location='{{ route('posts.show', $post->slug) }}'">
                            <div style="height: 180px; background-image: url('{{ $post->image ? (Str::startsWith($post->image, 'http') ? $post->image : asset('storage/' . $post->image)) : 'https://images.unsplash.com/photo-1523240795612-9a054b0db644?q=80&w=400&auto=format&fit=crop' }}'); background-size: cover; background-position: center; border-radius: var(--radius-sm); margin-bottom: 15px; position: relative; flex-shrink: 0;">
                                @if($post->type === 'inovasi')
                                    <span class="news-badge" style="top: 10px; left: 10px; background-color: var(--secondary);">Inovasi</span>
                                @else
                                    <span class="news-badge" style="top: 10px; left: 10px; background-color: var(--accent);">Prestasi</span>
                                @endif
                            </div>
                            <div style="flex-grow: 1; display: flex; flex-direction: column; justify-content: space-between;">
                                <div>
                                    <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 6px; font-size: 11px; color: var(--text-muted);">
                                        <span><i class="bi bi-calendar-event" style="margin-right: 4px;"></i> {{ $post->created_at->format('d M Y') }}</span>
                                    </div>
                                    <h4 style="font-size: 15px; font-weight: 700; color: var(--primary); margin-bottom: 8px; line-height: 1.4; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">{{ $post->title }}</h4>
                                                                        <p style="font-size: 13px; color: var(--text-muted); line-height: 1.6; text-align: justify; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; margin-bottom: 15px;">{{ Str::limit(strip_tags(html_entity_decode($post->content)), 100) }}</p>
                                </div>
                                <div style="display: flex; align-items: center; justify-content: space-between;">
                                    <span style="font-size: 12px; font-weight: 600; color: var(--secondary); display: inline-flex; align-items: center; gap: 4px;">
                                        Selengkapnya <i class="bi bi-arrow-right"></i>
                                    </span>
                                    <span style="font-size: 12px; display: inline-flex; align-items: center; gap: 4px; color: #0369a1; font-weight: 600;">
                                        <i class="bi bi-eye-fill"></i> {{ number_format($post->views) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div style="width: 100%; text-align: center; color: var(--text-muted); padding: 40px 0;">
                        Belum ada data prestasi atau inovasi.
                    </div>
                @endforelse
            </div>

            @if($combinedPosts->count() > 1)
                <div class="carousel-controls" style="position: absolute; top: 40%; width: 100%; display: flex; justify-content: space-between; pointer-events: none; z-index: 10; left: 0; padding: 0 4px;">
                    <button class="carousel-arrow prev" style="pointer-events: auto; background-color: rgba(11, 31, 63, 0.85); color: white; width: 36px; height: 36px; border-radius: 50%; border: none; display: flex; align-items: center; justify-content: center; cursor: pointer; box-shadow: var(--shadow-md);"><i class="bi bi-chevron-left"></i></button>
                    <button class="carousel-arrow next" style="pointer-events: auto; background-color: rgba(11, 31, 63, 0.85); color: white; width: 36px; height: 36px; border-radius: 50%; border: none; display: flex; align-items: center; justify-content: center; cursor: pointer; box-shadow: var(--shadow-md);"><i class="bi bi-chevron-right"></i></button>
                </div>
                
                <div class="carousel-dots" id="dots-prestasi-inovasi" style="display: flex; justify-content: center; gap: 8px; margin-top: 25px;">
                    <!-- Diisi lewat JS secara dinamis -->
                </div>
            @endif
        </div>

    </div>
</section>

<!-- Carousel Javascript -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const container = document.getElementById('carousel-prestasi-inovasi');
        if (!container) return;
        
        const track = container.querySelector('.merged-carousel-track');
        const slides = container.querySelectorAll('.merged-carousel-slide');
        const prevBtn = container.querySelector('.carousel-arrow.prev');
        const nextBtn = container.querySelector('.carousel-arrow.next');
        const dotsContainer = document.getElementById('dots-prestasi-inovasi');
        
        let currentIndex = 0;
        let autoplayInterval;

        if (slides.length === 0) return;

        function getVisibleCount() {
            if (window.innerWidth <= 768) return 1;
            if (window.innerWidth <= 992) return 2;
            return 3;
        }

        function getMaxIndex() {
            return Math.max(0, slides.length - getVisibleCount());
        }

        function createDots() {
            if (!dotsContainer) return;
            dotsContainer.innerHTML = '';
            
            const maxIdx = getMaxIndex();
            for (let i = 0; i <= maxIdx; i++) {
                const dot = document.createElement('span');
                dot.className = 'carousel-dot' + (i === currentIndex ? ' active' : '');
                dot.setAttribute('data-index', i);
                dot.addEventListener('click', function (e) {
                    e.stopPropagation();
                    slideTo(i);
                });
                dotsContainer.appendChild(dot);
            }
        }

        function slideTo(newIndex) {
            const maxIdx = getMaxIndex();
            
            if (newIndex < 0) {
                newIndex = maxIdx;
            } else if (newIndex > maxIdx) {
                newIndex = 0;
            }

            currentIndex = newIndex;
            
            if (slides.length > 0) {
                const slideWidth = slides[0].getBoundingClientRect().width;
                const offset = currentIndex * (slideWidth + 24); // 24px is gap size
                track.style.transform = `translateX(-${offset}px)`;
            }

            if (dotsContainer) {
                const dots = dotsContainer.querySelectorAll('.carousel-dot');
                dots.forEach((dot, idx) => {
                    if (idx === currentIndex) {
                        dot.classList.add('active');
                    } else {
                        dot.classList.remove('active');
                    }
                });
            }
        }

        if (nextBtn) {
            nextBtn.addEventListener('click', function (e) {
                e.stopPropagation();
                slideTo(currentIndex + 1);
            });
        }

        if (prevBtn) {
            prevBtn.addEventListener('click', function (e) {
                e.stopPropagation();
                slideTo(currentIndex - 1);
            });
        }

        function startAutoplay() {
            autoplayInterval = setInterval(function () {
                slideTo(currentIndex + 1);
            }, 6000);
        }

        function stopAutoplay() {
            clearInterval(autoplayInterval);
        }

        container.addEventListener('mouseenter', stopAutoplay);
        container.addEventListener('mouseleave', startAutoplay);

        window.addEventListener('resize', function () {
            createDots();
            const maxIdx = getMaxIndex();
            if (currentIndex > maxIdx) {
                currentIndex = maxIdx;
            }
            slideTo(currentIndex);
        });

        // Initialize
        createDots();
        slideTo(0);
        startAutoplay();
    });
</script>

@endsection
