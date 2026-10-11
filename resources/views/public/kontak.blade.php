@extends('layouts.public')

@section('title', 'Kontak Kami - Cabang Dinas Pendidikan Wilayah Kabupaten Gresik')

@section('content')
<!-- Page Header -->
<section class="page-header" style="background: linear-gradient(135deg, var(--primary) 0%, #1e3a5f 100%); padding: 60px 0; color: white; text-align: center; margin-bottom: 40px;">
    <div class="container-wide">
        <h1 style="font-size: 32px; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 10px; text-shadow: 0 2px 4px rgba(0,0,0,0.2);">Hubungi Kami</h1>
        <p style="font-size: 16px; opacity: 0.9; max-width: 600px; margin: 0 auto;">Kami siap melayani dan mendengarkan Anda. Silakan hubungi Cabang Dinas Pendidikan Wilayah Kabupaten Gresik melalui kontak di bawah ini.</p>
    </div>
</section>

<!-- Contact Section -->
<section class="contact-section" style="padding-bottom: 60px;">
    <div class="container-wide">
        <div class="contact-grid" style="display: grid; grid-template-columns: 1fr 1.5fr; gap: 30px; align-items: stretch;">
            
            <!-- Left Column: Contact Information -->
            <div class="contact-info-col" style="display: flex; flex-direction: column; gap: 20px;">
                
                <div class="contact-card">
                    <div class="icon-box"><i class="bi bi-geo-alt-fill"></i></div>
                    <div class="info-text">
                        <h3>Alamat Kantor</h3>
                        <p>Jl. Dr. Wahidin Sudirohusodo No.229, Kembangan, Kec. Kebomas, Kab. Gresik, Jawa Timur 61124</p>
                    </div>
                </div>

                <div class="contact-card">
                    <div class="icon-box" style="background: rgba(16, 185, 129, 0.1); color: #10b981;"><i class="bi bi-telephone-fill"></i></div>
                    <div class="info-text">
                        <h3>Telepon & Layanan</h3>
                        <p>(031) 39923400</p>
                        <p class="sub-text">Layanan Pengaduan & Informasi</p>
                    </div>
                </div>

                <div class="contact-card">
                    <div class="icon-box" style="background: rgba(245, 158, 11, 0.1); color: #f59e0b;"><i class="bi bi-envelope-fill"></i></div>
                    <div class="info-text">
                        <h3>Email Resmi</h3>
                        <p>cabdinkabgresik.gmail.com</p>
                        <p class="sub-text">Untuk persuratan dan kerjasama</p>
                    </div>
                </div>

                <div class="contact-card">
                    <div class="icon-box" style="background: rgba(99, 102, 241, 0.1); color: #6366f1;"><i class="bi bi-clock-fill"></i></div>
                    <div class="info-text">
                        <h3>Jam Operasional</h3>
                        <p>Senin - Kamis: 07.30 - 16.00 WIB</p>
                        <p>Jumat: 07.30 - 15.00 WIB</p>
                        <p class="sub-text">Sabtu, Minggu & Hari Libur Nasional Tutup</p>
                    </div>
                </div>

                <!-- Social Media -->
                <div class="social-media-card" style="margin-top: 10px; padding: 25px; background: white; border-radius: var(--radius-md); box-shadow: 0 4px 15px rgba(0,0,0,0.05); border: 1px solid var(--border);">
                    <h3 style="font-size: 16px; font-weight: 700; color: var(--primary); margin-bottom: 15px; text-transform: uppercase; letter-spacing: 0.5px;">Sosial Media Kami</h3>
                    <div style="display: flex; gap: 12px; flex-wrap: wrap;">
                        <a href="https://instagram.com/cabdingresik" target="_blank" rel="noopener" class="social-btn instagram">
                            <i class="bi bi-instagram"></i> Instagram
                        </a>
                        <a href="https://tiktok.com/@cabdingresik" target="_blank" rel="noopener" class="social-btn tiktok">
                            <i class="bi bi-tiktok"></i> TikTok
                        </a>
                        <a href="https://youtube.com/cabdingresik" target="_blank" rel="noopener" class="social-btn youtube">
                            <i class="bi bi-youtube"></i> YouTube
                        </a>
                    </div>
                </div>

            </div>

            <!-- Right Column: Google Maps -->
            <div class="contact-map-col" style="background: white; border-radius: var(--radius-md); box-shadow: 0 4px 20px rgba(0,0,0,0.08); overflow: hidden; display: flex; flex-direction: column; border: 1px solid var(--border);">
                <div style="padding: 20px 25px; background: #f8fafc; border-bottom: 1px solid var(--border); display: flex; justify-content: space-between; align-items: center;">
                    <h3 style="font-size: 16px; font-weight: 700; color: var(--primary); margin: 0; display: flex; align-items: center; gap: 8px;">
                        <i class="bi bi-map-fill text-danger"></i> Lokasi Peta
                    </h3>
                    <a href="https://maps.google.com/?q=Cabang+Dinas+Pendidikan+Kabupaten+Gresik+Jl+Dr+Wahidin+Sudirohusodo+229+Kembangan+Gresik" target="_blank" rel="noopener" class="btn-map-link">
                        <i class="bi bi-geo-alt"></i> Buka di Google Maps
                    </a>
                </div>
                <div style="flex-grow: 1; min-height: 400px; width: 100%;">
                    <iframe src="https://maps.google.com/maps?q=Jl.+Dr.+Wahidin+Sudirohusodo+No.229+Kembangan+Gresik+Cabang+Dinas+Pendidikan&t=&z=16&ie=UTF8&iwloc=&output=embed" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>

        </div>
    </div>
</section>

<style>
    .contact-card {
        background: #ffffff;
        border: 1px solid var(--border);
        border-radius: var(--radius-md);
        padding: 20px;
        display: flex;
        gap: 16px;
        align-items: flex-start;
        box-shadow: 0 2px 10px rgba(0,0,0,0.02);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .contact-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.06);
    }
    .contact-card .icon-box {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        background: rgba(3, 105, 161, 0.1);
        color: #0369a1;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        flex-shrink: 0;
    }
    .contact-card .info-text {
        flex-grow: 1;
    }
    .contact-card .info-text h3 {
        font-size: 14px;
        font-weight: 700;
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 6px;
    }
    .contact-card .info-text p {
        font-size: 15px;
        font-weight: 600;
        color: var(--primary);
        line-height: 1.4;
        margin: 0 0 2px 0;
    }
    .contact-card .info-text p.sub-text {
        font-size: 12px;
        font-weight: 400;
        color: var(--text-muted);
        margin-top: 4px;
    }

    .social-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 16px;
        border-radius: 50px;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
        border: 1px solid transparent;
    }
    .social-btn.instagram { background: #fff0f5; color: #e1306c; border-color: #fce4ec; }
    .social-btn.instagram:hover { background: #e1306c; color: white; }
    
    .social-btn.tiktok { background: #f1f5f9; color: #000000; border-color: #e2e8f0; }
    .social-btn.tiktok:hover { background: #000000; color: white; }

    .social-btn.youtube { background: #fff1f2; color: #ff0000; border-color: #ffe4e6; }
    .social-btn.youtube:hover { background: #ff0000; color: white; }

    .btn-map-link {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 12px;
        font-weight: 600;
        color: #0369a1;
        background: rgba(3, 105, 161, 0.1);
        padding: 6px 12px;
        border-radius: 4px;
        text-decoration: none;
        transition: all 0.2s ease;
    }
    .btn-map-link:hover {
        background: #0369a1;
        color: white;
    }

    @media (max-width: 992px) {
        .contact-grid { grid-template-columns: 1fr !important; }
        .contact-map-col { min-height: 400px; }
    }
</style>
@endsection