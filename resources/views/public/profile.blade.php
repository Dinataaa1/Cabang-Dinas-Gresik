@extends('layouts.public')

@section('title', 'Profil Lembaga - Cabdin Wilayah Kabupaten Gresik')

@section('content')

<!-- PAGE HEADER -->
<section class="page-header">
    <div class="container">
        <h2>Profil Lembaga</h2>
        <div class="breadcrumb">
            <a href="{{ route('home') }}">Beranda</a> / Profil
        </div>
    </div>
</section>

<!-- MAIN CONTENT -->
<section class="main-section" style="padding-top: 0;">
    <div class="container">
        <style>
            @media (max-width: 768px) {
                .content-box {
                    padding: 20px 16px !important;
                    margin-bottom: 24px !important;
                }
            }
        </style>

        <!-- SECTION 1: TENTANG KAMI -->
        <div class="content-box" id="tentang-kami">
            <h2 class="section-title">Tentang Kami</h2>

            @if($about && $about->image)
                <div class="about-layout">
                    <div class="about-media">
                        <img src="{{ asset('storage/' . $about->image) }}" alt="Foto Tentang Kami" class="about-image">
                    </div>
                    <div class="rich-content about-text">
                        @if($about->content)
                            {!! $about->content !!}
                        @else
                            <p class="empty-content">
                                Informasi profil tentang kami belum ditambahkan oleh administrator.
                            </p>
                        @endif
                    </div>
                </div>
            @else
                <div class="rich-content">
                    @if($about && $about->content)
                        {!! $about->content !!}
                    @else
                        <p class="empty-content">
                            Informasi profil tentang kami belum ditambahkan oleh administrator.
                        </p>
                    @endif
                </div>
            @endif
        </div>


    <!-- SECTION 2: VISI & MISI -->
    <div class="content-box" id="visi-misi">
        <h2 class="section-title">Visi & Misi</h2>

        <div class="rich-content">
            @if($visiMisi && $visiMisi->content)
                {!! $visiMisi->content !!}
            @else
                <p class="empty-content">
                    Informasi visi & misi belum ditambahkan oleh administrator.
                </p>
            @endif
        </div>
    </div>


    <!-- SECTION 3: STRUKTUR ORGANISASI -->
    <div class="content-box" id="struktur-organisasi">
        <h2 class="section-title">Struktur Organisasi</h2>

        <div class="rich-content">
            @if($struktur && $struktur->content)
                {!! $struktur->content !!}
            @endif

            <!-- Profil Pejabat Struktural Grid (2x2) -->
            <div style="margin-top: 35px; margin-bottom: 50px; max-width: 1000px; margin-left: auto; margin-right: auto;">
                <style>
                    .org-grid {
                        display: grid;
                        grid-template-columns: 1fr 1fr;
                        gap: 22px;
                    }
                    .org-card-hover {
                        display: flex;
                        gap: 18px;
                        background: #fffbfb;
                        border: 1px solid #e2e8f0;
                        border-radius: 8px;
                        padding: 16px;
                        box-shadow: 0 2px 6px rgba(0,0,0,0.05);
                        transition: transform 0.2s ease, box-shadow 0.2s ease;
                        border-bottom: 4px solid #0d9488;
                        font-family: 'Inter', sans-serif;
                    }
                    .org-card-hover:hover {
                        transform: translateY(-3px);
                        box-shadow: 0 8px 20px rgba(13, 148, 136, 0.12);
                        border-bottom-color: #0b1f3f;
                    }
                    .org-img-box {
                        width: 120px;
                        height: 155px;
                        border-radius: 5px;
                        overflow: hidden;
                        flex-shrink: 0;
                        border: 1px solid #e2e8f0;
                    }
                    .org-info {
                        display: flex;
                        flex-direction: column;
                        justify-content: center;
                        align-items: flex-start;
                        gap: 3px;
                    }
                    .org-jabatan {
                        font-size: 12px;
                        font-weight: 700;
                        color: #0d9488;
                        text-transform: uppercase;
                        letter-spacing: 0.7px;
                        margin: 0 !important;
                    }
                    .org-nama {
                        font-size: 17px;
                        font-weight: 400;
                        color: #374151;
                        margin: 0 !important;
                        line-height: 1.25;
                    }
                    .org-nip {
                        font-size: 13px;
                        font-weight: 400;
                        color: #9ca3af;
                        margin: 0 !important;
                    }
                    @media (max-width: 768px) {
                        .org-grid { grid-template-columns: 1fr; }
                        .org-card-hover { flex-direction: column; align-items: center; text-align: center; border-bottom: 4px solid #0d9488; }
                        .org-info { align-items: center; }
                    }
                </style>

                <div class="org-grid">
                    @foreach([$org1, $org2, $org3, $org4] as $org)
                        @if($org && $org->content)
                            @php
                                $data = json_decode($org->content, true);
                            @endphp
                            @if(!empty($data['name']) || !empty($data['position']))
                            <div class="org-card-hover">
                                <div class="org-img-box">
                                    <img src="{{ $org->image ? asset('storage/' . $org->image) : asset('images/kepala_dinas.jpg') }}" alt="{{ $data['name'] ?? 'Foto Pejabat' }}" style="width: 100%; height: 100%; object-fit: cover;">
                                </div>
                                <div class="org-info">
                                    <div class="org-jabatan">{{ $data['position'] ?? 'Jabatan' }}</div>
                                    <div class="org-nama">{{ $data['name'] ?? 'Nama Lengkap' }}</div>
                                    @if(!empty($data['nip']))
                                    <div class="org-nip">NIP. {{ $data['nip'] }}</div>
                                    @endif
                                </div>
                            </div>
                            @endif
                        @endif
                    @endforeach
                </div>
            </div>

            @if($struktur && $struktur->image)
                <div style="text-align: center; margin-top: 20px;">
                    <img
                        src="{{ asset('storage/' . $struktur->image) }}"
                        alt="Struktur Organisasi Cabang Dinas Pendidikan Kabupaten Gresik"
                        class="struktur-img"
                        style="max-width: 100%; border: 3px solid var(--border); box-shadow: var(--shadow-md);"
                    >

                    <p style="font-size: 12px; color: var(--text-muted); margin-top: 10px; font-weight: 500;">
                        Bagan Struktur Organisasi Cabang Dinas Pendidikan Wilayah Kabupaten Gresik.
                    </p>
                </div>
            @else
                <div style="padding: 30px; background-color: var(--bg-main); text-align: center; border-radius: var(--radius-sm); color: var(--text-muted); font-style: italic; margin-top: 20px;">
                    Bagan struktur organisasi belum diunggah oleh administrator.
                </div>
            @endif
        </div>
    </div>

    </div>
</section>

@endsection