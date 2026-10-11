@extends('layouts.public')

@section('title', $service->name . ' - Layanan Cabdin Gresik')

@section('meta')
    @php
        $defaultServiceImage = url(asset('images/logo-jatim.svg'));
        $ogImage = $defaultServiceImage;
        if(!empty($service->image)) {
            if(Str::startsWith($service->image, 'http')) {
                $ogImage = $service->image;
            } elseif (\Illuminate\Support\Facades\Storage::disk('public')->exists($service->image)) {
                $ogImage = url('storage/' . $service->image);
            }
        }
    @endphp

    <meta property="og:title" content="{{ $service->name }}">
    <meta property="og:description" content="{{ Str::limit(strip_tags($service->description ?? ''), 160) }}">
    <meta property="og:image" content="{{ $ogImage }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $service->name }}">
    <meta name="twitter:description" content="{{ Str::limit(strip_tags($service->description ?? ''), 160) }}">
    <meta name="twitter:image" content="{{ $ogImage }}">
@endsection

@section('content')

<!-- PAGE HEADER -->
<section class="page-header">
    <div class="container">
        <h2>{{ $service->name }}</h2>
        <div class="breadcrumb">
            <a href="{{ route('home') }}">Beranda</a> / <a href="{{ route('services.index') }}">Layanan</a> / Detail
        </div>
    </div>
</section>

<!-- MAIN CONTENT -->
<section class="main-section" style="padding-top: 0;">
    <div class="container grid-2">
        
        <!-- KOLOM KIRI: DETAIL LAYANAN -->
        <div class="col-left">
            
            <!-- Deskripsi Layanan -->
            <div class="card" style="border-top: 4px solid var(--secondary);">
                <h3 class="section-title">Deskripsi Layanan</h3>
                <p style="font-size: 15px; color: var(--text-dark); line-height: 1.8; text-align: justify; margin-top: 15px;">
                    {{ $service->description }}
                </p>
            </div>

            <!-- Persyaratan Administrasi -->
            <div class="card">
                <h3 class="section-title">Syarat & Berkas Administrasi</h3>
                <div style="font-size: 14px; color: var(--text-dark); line-height: 1.8; margin-top: 15px; padding-left: 5px;">
                    @if($service->requirements)
                        <div style="background-color: var(--bg-main); padding: 20px; border-radius: var(--radius-sm); border-left: 4px solid var(--accent);">
                            {!! nl2br(e($service->requirements)) !!}
                        </div>
                    @else
                        <p style="color: var(--text-muted); font-style: italic;">Tidak ada persyaratan khusus yang tercatat.</p>
                    @endif
                </div>
            </div>

            <!-- Prosedur / Alur Layanan -->
            <div class="card">
                <h3 class="section-title">Prosedur & Alur Pengajuan</h3>
                <div style="font-size: 14px; color: var(--text-dark); line-height: 1.8; margin-top: 15px; padding-left: 5px;">
                    @if($service->procedure)
                        <div class="procedure-content">
                            {!! $service->procedure !!}
                        </div>
                    @else
                        <p class="text-muted">
                            Alur prosedur belum tercatat secara detail.
                        </p>
                    @endif
                </div>
            </div>

            <div style="margin-top: 20px; display: flex; gap: 12px; align-items: center; flex-wrap: wrap; justify-content: space-between;">
                <a href="{{ route('services.index') }}" class="btn btn-secondary">← Kembali ke Daftar Layanan</a>

                <div style="display: inline-flex; gap: 8px; align-items: center;">
                    <div id="share-controls-service" style="display: inline-flex; gap: 8px; align-items: center;">
                        <button type="button" class="btn btn-light" id="btn-web-share-service" title="Bagikan" style="display: none;"><i class="bi bi-share-fill"></i></button>
                        <a href="#" id="share-whatsapp-service" class="btn btn-light" title="Bagikan ke WhatsApp"><i class="bi bi-whatsapp" style="color: #25D366;"></i></a>
                        <a href="#" id="share-facebook-service" class="btn btn-light" title="Bagikan ke Facebook"><i class="bi bi-facebook" style="color: #1877F2;"></i></a>
                        <a href="#" id="share-twitter-service" class="btn btn-light" title="Bagikan ke Twitter"><i class="bi bi-twitter" style="color: #1DA1F2;"></i></a>
                        <a href="#" id="share-telegram-service" class="btn btn-light" title="Bagikan ke Telegram"><i class="bi bi-telegram" style="color: #0088cc;"></i></a>
                        <button type="button" class="btn btn-light" id="btn-copy-link-service" title="Salin tautan"><i class="bi bi-clipboard"></i></button>
                    </div>
                </div>
            </div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const shareUrl = {!! json_encode(url()->current()) !!};
        const shareTitle = {!! json_encode($service->name) !!};

        const btnWebShare = document.getElementById('btn-web-share-service');
        if (navigator.share && btnWebShare) {
            btnWebShare.style.display = 'inline-flex';
            btnWebShare.addEventListener('click', function () {
                navigator.share({ title: shareTitle, text: shareTitle, url: shareUrl }).catch(function () {});
            });
        }

        const whatsapp = document.getElementById('share-whatsapp-service');
        const facebook = document.getElementById('share-facebook-service');
        const twitter = document.getElementById('share-twitter-service');
        const telegram = document.getElementById('share-telegram-service');

        if (whatsapp) whatsapp.href = 'https://api.whatsapp.com/send?text=' + encodeURIComponent(shareTitle + ' - ' + shareUrl);
        if (facebook) facebook.href = 'https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(shareUrl);
        if (twitter) twitter.href = 'https://twitter.com/intent/tweet?text=' + encodeURIComponent(shareTitle) + '&url=' + encodeURIComponent(shareUrl);
        if (telegram) telegram.href = 'https://t.me/share/url?url=' + encodeURIComponent(shareUrl) + '&text=' + encodeURIComponent(shareTitle);

        [whatsapp, facebook, twitter, telegram].forEach(function (el) {
            if (!el) return;
            el.setAttribute('target', '_blank');
            el.setAttribute('rel', 'noopener noreferrer');
        });

        const btnCopy = document.getElementById('btn-copy-link-service');
        if (btnCopy) {
            btnCopy.addEventListener('click', function () {
                if (navigator.clipboard && navigator.clipboard.writeText) {
                    navigator.clipboard.writeText(shareUrl).then(function () { alert('Tautan disalin ke clipboard'); }).catch(function () { fallbackCopy(shareUrl); });
                } else { fallbackCopy(shareUrl); }
            });
        }

        function fallbackCopy(text) {
            const textarea = document.createElement('textarea'); textarea.value = text; textarea.style.position = 'fixed'; textarea.style.left = '-9999px'; document.body.appendChild(textarea); textarea.select();
            try { document.execCommand('copy'); alert('Tautan disalin ke clipboard'); } catch (err) { prompt('Salin tautan berikut:', text); }
            document.body.removeChild(textarea);
        }
    });
</script>

        </div>

        <!-- KOLOM KANAN: SIDEBAR -->
        <aside class="col-right">
            
            <!-- Widget Layanan Lainnya -->
            <div class="widget">
                <h3 class="widget-title"><span><i class="bi bi-folder-fill"></i></span> Layanan Lainnya</h3>
                <div class="quick-links">
                    @php
                        $otherServices = \App\Models\Service::where('id', '!=', $service->id)->take(5)->get();
                    @endphp
                    @forelse($otherServices as $other)
                        <a href="{{ route('services.show', $other->slug) }}" class="quick-link-item">
                            {{ $other->name }}
                        </a>
                    @empty
                        <span style="font-size: 13px; color: var(--text-muted);">Tidak ada layanan lainnya.</span>
                    @endforelse
                </div>
            </div>

            <!-- Widget Kontak & Bantuan -->
            <div class="widget">
                <h3 class="widget-title"><span><i class="bi bi-telephone-fill"></i></span> Bantuan Pelayanan</h3>
                <div style="font-size: 13px; line-height: 1.7; color: var(--text-muted);">
                    <p style="margin-bottom: 10px;">Jika Anda mengalami kendala atau membutuhkan informasi lebih lanjut mengenai pengajuan layanan ini, hubungi unit layanan kami:</p>
                    <ul style="list-style: none; padding-left: 0; margin-top: 10px;">
                        <li style="margin-bottom: 8px;"><i class="bi bi-geo-alt-fill text-danger" style="margin-right: 5px;"></i> <strong>Loket Pelayanan Cabdin Gresik</strong></li>
                        <li style="margin-bottom: 8px;"><i class="bi bi-telephone-fill text-success" style="margin-right: 5px;"></i> <strong>Telepon:</strong> (031) 3981234</li>
                        <li style="margin-bottom: 8px;"><i class="bi bi-envelope-fill text-primary" style="margin-right: 5px;"></i> <strong>Email:</strong> pelayanan@cabdingresik.jatimprov.go.id</li>
                        <li style="margin-bottom: 8px;"><i class="bi bi-clock-fill text-muted" style="margin-right: 5px;"></i> <strong>Jam Operasional:</strong><br>Senin - Kamis: 08:00 - 15:00 WIB<br>Jumat: 08:00 - 14:00 WIB</li>
                    </ul>
                </div>
            </div>

            <!-- Warning Anti Pungli -->
            <div class="widget" style="background-color: #fffbeb; border: 1px solid #fef3c7; border-left: 4px solid var(--accent);">
                <h4 style="color: var(--accent); font-weight: 700; font-size: 14px; margin-bottom: 8px;"><i class="bi bi-shield-slash-fill text-warning" style="margin-right: 5px;"></i> Bebas Pungutan Liar</h4>
                <p style="font-size: 12px; color: #b45309; line-height: 1.6;">
                    Seluruh proses pelayanan administrasi di Cabang Dinas Pendidikan Wilayah Kabupaten Gresik <strong>TIDAK DIPUNGUT BIAYA (GRATIS)</strong>. Laporkan jika ada tindakan pungli!
                </p>
            </div>

        </aside>

    </div>
</section>

@endsection
