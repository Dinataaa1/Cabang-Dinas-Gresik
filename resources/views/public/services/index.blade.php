@extends('layouts.public')

@section('title', 'Layanan Publik - Cabang Dinas Pendidikan Wilayah Kabupaten Gresik')

@section('content')

<!-- PAGE HEADER -->
<section style="background: linear-gradient(135deg, var(--primary), var(--primary-light)); color: white; padding: 40px 0; text-align: center; border-bottom: 4px solid var(--secondary);">
    <div class="container">
        <div style="font-size: 40px; margin-bottom: 12px;"><i class="bi bi-briefcase-fill" style="color: var(--accent-light);"></i></div>
        <h2 style="font-size: 26px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px;">Layanan Publik</h2>
        <p style="font-size: 13.5px; color: rgba(255,255,255,0.7); margin-top: 6px;">
            Daftar standar pelayanan administrasi pendidikan menengah atas, kejuruan, dan tata usaha
        </p>
        <div style="font-size: 13.5px; color: rgba(255,255,255,0.6); margin-top: 10px;">
            <a href="{{ route('home') }}" style="color: #93c5fd; font-weight: 600;">Beranda</a> / Layanan
        </div>
    </div>
</section>

<!-- MAIN CONTENT -->
<section class="main-section" style="background-color: #f8fafc; padding: 40px 0;">
    <div class="container-wide" style="max-width: 1100px; margin: 0 auto; padding: 0 4%;">

        <!-- Maklumat Pelayanan -->
        <div style="background: #ffffff; border-radius: var(--radius-md); border: 1px solid var(--border); box-shadow: var(--shadow-sm); padding: 24px; margin-bottom: 30px; border-left: 5px solid var(--secondary);">
            <h3 style="color: var(--primary); margin: 0 0 10px; font-weight: 800; font-size: 16px; display: flex; align-items: center; gap: 8px;">
                <i class="bi bi-shield-check-fill" style="color: var(--secondary);"></i> Maklumat Pelayanan Cabdin Wilayah Gresik
            </h3>
            <p style="color: var(--text-muted); font-size: 13px; line-height: 1.7; text-align: justify; margin: 0; font-style: italic;">
                "Dengan ini kami menyatakan sanggup menyelenggarakan pelayanan sesuai dengan Standar Pelayanan yang telah ditetapkan serta berkomitmen memberikan pelayanan yang profesional, cepat, mudah, transparan, akuntabel, dan bebas dari praktik korupsi, kolusi, serta nepotisme."
            </p>
        </div>

        <!-- Filter Kategori Tabs -->
        <div style="display: flex; gap: 10px; flex-wrap: wrap; margin-bottom: 24px; justify-content: center;">
            <a href="{{ route('services.index') }}" 
               style="padding: 10px 24px; border-radius: 30px; font-size: 13px; font-weight: 700; text-decoration: none; border: 1px solid var(--border); transition: all 0.25s; {{ !($category ?? null) ? 'background: #0b1f3f; color: #f8fafc; border-color: #0b1f3f; box-shadow: 0 4px 12px rgba(11,31,63,0.15);' : 'background: #f8fafc; color: #0b1f3f;' }}">
                <i class="bi bi-grid-3x3-gap-fill" style="margin-right: 6px;"></i> Semua Layanan
            </a>
            @foreach($categories as $cat)
                @php
                    $theme = match($cat) {
                        'SMA' => ['#0b1f3f', 'bi-mortarboard-fill'],
                        'SMK' => ['#0f172a', 'bi-tools'],
                        'Tata Usaha' => ['#1e3a5f', 'bi-clipboard2-data-fill'],
                        default => ['#0b1f3f', 'bi-briefcase-fill']
                    };
                    $isActive = ($category ?? '') == $cat;
                @endphp
                <a href="{{ route('services.index', ['category' => $cat]) }}" 
                   style="padding: 10px 24px; border-radius: 30px; font-size: 13px; font-weight: 700; text-decoration: none; border: 1px solid var(--border); transition: all 0.25s; {{ $isActive ? 'background: '.$theme[0].'; color: #f8fafc; border-color: '.$theme[0].'; box-shadow: 0 4px 12px rgba(0,0,0,0.15);' : 'background: #f8fafc; color: #0f172a;' }}"
                   onmouseover="if(!{{ $isActive ? 'true' : 'false' }}) { this.style.borderColor='{{ $theme[0] }}'; this.style.color='{{ $theme[0] }}'; }"
                   onmouseout="if(!{{ $isActive ? 'true' : 'false' }}) { this.style.borderColor='var(--border)'; this.style.color='#0f172a'; }">
                    <i class="bi {{ $theme[1] }}" style="margin-right: 6px;"></i> Layanan {{ $cat }}
                </a>
            @endforeach
        </div>

        <!-- Services Grid -->
        @if($services->isEmpty())
            <div style="background: #fff; border: 1px solid var(--border); border-radius: var(--radius-md); padding: 50px 20px; text-align: center; color: var(--text-muted); box-shadow: var(--shadow-sm);">
                <i class="bi bi-journal-x" style="font-size: 40px; display: block; margin-bottom: 12px; opacity: .4;"></i>
                <p style="font-size: 14px; font-weight: 600;">Belum ada standar pelayanan untuk kategori ini.</p>
            </div>
        @else
            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(min(100%, 300px), 1fr)); gap: 20px;">
                @foreach($services as $index => $service)
                    @php
                        $theme = match($service->category) {
                            'SMA' => ['#0b1f3f', 'bi-mortarboard-fill', '#f1f5f9', '#facc15', '#713f12'],
                            'SMK' => ['#0f172a', 'bi-tools', '#f8fafc', '#3b82f6', '#ffffff'],
                            'Tata Usaha' => ['#1e3a5f', 'bi-clipboard2-data-fill', '#f1f5f9', '#111827', '#ffffff'],
                            default => ['#0b1f3f', 'bi-briefcase-fill', '#f8fafc', '#e5e7eb', '#111827']
                        };
                    @endphp
                    <div style="background: #ffffff; border: 1px solid var(--border); border-radius: 16px; padding: 24px; box-shadow: var(--shadow-sm); display: flex; flex-direction: column; justify-content: space-between; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); border-top: 4px solid {{ $theme[0] }}; position: relative; overflow: hidden;"
                         onmouseover="this.style.transform='translateY(-4px)';this.style.boxShadow='0 12px 30px rgba(0,0,0,.08)'" onmouseout="this.style.transform='';this.style.boxShadow='var(--shadow-sm)'">
                        
                        <div>
                            {{-- Top Row --}}
                            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 16px;">
                                <div style="width: 46px; height: 46px; border-radius: 12px; background: {{ $theme[2] }}; display: flex; align-items: center; justify-content: center; color: {{ $theme[0] }}; font-size: 20px; border: 1px solid var(--border);">
                                    <i class="bi {{ $theme[1] }}"></i>
                                </div>
                                <span style="background: {{ $theme[3] }}; color: {{ $theme[4] }}; padding: 3px 12px; border-radius: 20px; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.3px; border: 1px solid var(--border);">
                                    {{ $service->category }}
                                </span>
                            </div>

                            {{-- Title & Desc --}}
                            <h3 style="font-size: 15px; font-weight: 800; color: #0b1f3f; margin: 0 0 8px; line-height: 1.4; min-height: 42px;">
                                {{ $service->name }}
                            </h3>
                            <p style="font-size: 12.5px; color: var(--text-muted); line-height: 1.6; margin: 0 0 20px; text-align: justify;">
                                {{ Str::limit(strip_tags($service->description), 110) }}
                            </p>
                        </div>

                        {{-- Action Button --}}
                        <a href="{{ route('services.show', $service->slug) }}" 
                                    style="display: flex; align-items: center; justify-content: center; gap: 6px; width: 100%; padding: 10px; border-radius: 10px; background: var(--secondary); color: #ffffff; font-size: 13px; font-weight: 700; text-decoration: none; transition: all 0.2s;"
                                    onmouseover="this.style.background='#0f766e';" onmouseout="this.style.background='var(--secondary)';">
                            Detail Persyaratan <i class="bi bi-arrow-right-short" style="font-size: 18px;"></i>
                        </a>
                    </div>
                @endforeach
            </div>
        @endif

    </div>
</section>

@endsection
