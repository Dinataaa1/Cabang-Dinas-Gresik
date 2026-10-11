@extends('layouts.public')
@section('title', $activity->title . ' - Cabdin Gresik')

@section('meta')
    @php
        $defaultActivityImage = 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?q=80&w=800&auto=format&fit=crop';
        $ogImage = $defaultActivityImage;
        if(!empty($activity->cover_image)) {
            if(Str::startsWith($activity->cover_image, 'http')) {
                $ogImage = $activity->cover_image;
            } elseif (\Illuminate\Support\Facades\Storage::disk('public')->exists($activity->cover_image)) {
                $ogImage = url('storage/'.$activity->cover_image);
            }
        }
    @endphp

    <meta property="og:title" content="{{ $activity->title }}">
    <meta property="og:description" content="{{ Str::limit(strip_tags($activity->description ?? ''), 160) }}">
    <meta property="og:image" content="{{ $ogImage }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="article">
    @if($activity->activity_date)
        <meta property="article:published_time" content="{{ $activity->activity_date->toIso8601String() }}">
    @endif

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $activity->title }}">
    <meta name="twitter:description" content="{{ Str::limit(strip_tags($activity->description ?? ''), 160) }}">
    <meta name="twitter:image" content="{{ $ogImage }}">
@endsection
@section('content')

<section class="page-header">
    <div class="container">
        <h2>{{ $activity->title }}</h2>
        <div class="breadcrumb"><a href="{{ route('home') }}">Beranda</a> / <a href="{{ route('kegiatan.index') }}">Kegiatan</a> / {{ Str::limit($activity->title,40) }}</div>
    </div>
</section>

<section class="main-section" style="padding-top:0;">
    <div class="container grid-2">

        <div class="col-left">
            {{-- Main Slider --}}
            @php
                $allPhotos = [];
                if($activity->cover_image) $allPhotos[] = asset('storage/'.$activity->cover_image);
                foreach($activity->images ?? [] as $img) $allPhotos[] = asset('storage/'.$img);
                $photoCount = count($allPhotos);
            @endphp

            @if($photoCount > 0)
            <div class="card" style="padding:0;overflow:hidden;border-radius:16px;margin-bottom:24px;">
                <div style="position:relative;background:#0b1f3f;">
                    {{-- Main slider --}}
                    <div id="main-slider" style="position:relative;height:420px;overflow:hidden;">
                        @foreach($allPhotos as $pi => $photo)
                        <img src="{{ $photo }}" id="main-slide-{{ $pi }}" style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;transition:opacity .6s ease;opacity:{{ $pi===0?1:0 }};">
                        @endforeach
                        @if($photoCount > 1)
                        <button onclick="mainPrev()" style="position:absolute;left:14px;top:50%;transform:translateY(-50%);background:rgba(0,0,0,.55);color:#fff;border:none;border-radius:50%;width:38px;height:38px;font-size:20px;cursor:pointer;z-index:20;display:flex;align-items:center;justify-content:center;">‹</button>
                        <button onclick="mainNext()" style="position:absolute;right:14px;top:50%;transform:translateY(-50%);background:rgba(0,0,0,.55);color:#fff;border:none;border-radius:50%;width:38px;height:38px;font-size:20px;cursor:pointer;z-index:20;display:flex;align-items:center;justify-content:center;">›</button>
                        @endif
                        <div style="position:absolute;bottom:14px;left:50%;transform:translateX(-50%);display:flex;gap:6px;z-index:20;">
                            @for($pi=0;$pi<$photoCount;$pi++)
                            <button onclick="mainGoto({{ $pi }})" id="main-dot-{{ $pi }}" style="width:9px;height:9px;border-radius:50%;border:none;cursor:pointer;background:{{ $pi===0?'#fff':'rgba(255,255,255,.45)' }};transition:background .3s;"></button>
                            @endfor
                        </div>
                    </div>

                    {{-- Thumbnail strip --}}
                    @if($photoCount > 1)
                    <div id="thumb-strip" style="display:flex;gap:8px;padding:12px;background:#111827;overflow-x:auto;scrollbar-width:none; max-width: 100%;">
                        @foreach($allPhotos as $pi => $photo)
                        <img src="{{ $photo }}" onclick="mainGoto({{ $pi }})" id="thumb-{{ $pi }}" style="height:62px;min-width:90px;object-fit:cover;border-radius:6px;cursor:pointer;border:2px solid {{ $pi===0?'#f59e0b':'transparent' }};transition:border-color .2s;opacity:{{ $pi===0?1:.65 }};">
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
            @endif

            {{-- Content --}}
            <div class="card" style="border-top:4px solid var(--secondary);padding:28px;">
                <div style="display:flex;flex-wrap:wrap;gap:14px;margin-bottom:20px;font-size:12.5px;color:#64748b;">
                    <span style="background:#eff6ff;color:#1d4ed8;padding:4px 12px;border-radius:20px;font-weight:700;">{{ ucfirst($activity->category) }}</span>
                    @if($activity->activity_date)
                    <span><i class="bi bi-calendar3"></i> {{ $activity->activity_date->format('d F Y') }}</span>
                    @endif
                    @if($activity->location)
                    <span><i class="bi bi-geo-alt-fill"></i> {{ $activity->location }}</span>
                    @endif
                    <span><i class="bi bi-eye"></i> {{ number_format($activity->views) }}</span>
                </div>

                <h2 style="font-size:22px;font-weight:900;color:#0b1f3f;margin:0 0 20px;line-height:1.3;">{{ $activity->title }}</h2>

                @if($activity->description)
                <div style="font-size:14.5px;line-height:1.85;color:#334155;">
                    {!! $activity->description !!}
                </div>
                @endif
            
                <div style="margin-top:18px; display:flex; gap:12px; align-items:center; justify-content:space-between; flex-wrap:wrap;">
                    <a href="{{ route('kegiatan.index') }}" class="btn btn-secondary">← Kembali ke Daftar Kegiatan</a>

                    <div id="share-controls-activity" style="display:inline-flex; gap:8px; align-items:center;">
                        <button type="button" class="btn btn-light" id="btn-web-share-activity" title="Bagikan" style="display:none;"><i class="bi bi-share-fill"></i></button>
                        <a href="#" id="share-whatsapp-activity" class="btn btn-light" title="Bagikan ke WhatsApp"><i class="bi bi-whatsapp" style="color:#25D366;"></i></a>
                        <a href="#" id="share-facebook-activity" class="btn btn-light" title="Bagikan ke Facebook"><i class="bi bi-facebook" style="color:#1877F2;"></i></a>
                        <a href="#" id="share-twitter-activity" class="btn btn-light" title="Bagikan ke Twitter"><i class="bi bi-twitter" style="color:#1DA1F2;"></i></a>
                        <a href="#" id="share-telegram-activity" class="btn btn-light" title="Bagikan ke Telegram"><i class="bi bi-telegram" style="color:#0088cc;"></i></a>
                        <button type="button" class="btn btn-light" id="btn-copy-link-activity" title="Salin tautan"><i class="bi bi-clipboard"></i></button>
                    </div>
                </div>
            </div>
        </div>

        <aside class="col-right">
            <div class="widget">
                <h3 class="widget-title"><span><i class="bi bi-images"></i></span> Kegiatan Lainnya</h3>
                @forelse($related as $rel)
                <a href="{{ route('kegiatan.show', $rel->slug) }}" style="display:flex;gap:12px;padding:10px 0;border-bottom:1px solid #f1f5f9;text-decoration:none;" onmouseover="this.style.opacity='.8'" onmouseout="this.style.opacity='1'">
                    <div style="flex-shrink:0;">
                        @if($rel->cover_image)
                            <img src="{{ asset('storage/'.$rel->cover_image) }}" style="width:70px;height:50px;object-fit:cover;border-radius:8px;">
                        @else
                            <div style="width:70px;height:50px;background:#f1f5f9;border-radius:8px;display:flex;align-items:center;justify-content:center;color:#cbd5e1;"><i class="bi bi-image"></i></div>
                        @endif
                    </div>
                    <div>
                        <div style="font-size:12.5px;font-weight:700;color:#0b1f3f;line-height:1.35;">{{ Str::limit($rel->title,55) }}</div>
                        <div style="font-size:11px;color:#94a3b8;margin-top:3px;">{{ $rel->activity_date?->format('d M Y') }}</div>
                    </div>
                </a>
                @empty
                <p style="font-size:12px;color:var(--text-muted);">Belum ada kegiatan lainnya.</p>
                @endforelse
                <a href="{{ route('kegiatan.index') }}" style="display:block;margin-top:14px;text-align:center;font-size:12.5px;font-weight:700;color:var(--primary);text-decoration:none;">Lihat Semua Kegiatan →</a>
            </div>
        </aside>

    </div>
</section>

@endsection

@section('scripts')
<script>
let mainCurrent = 0;
const mainTotal = {{ $photoCount }};
function mainGoto(idx) {
    document.getElementById('main-slide-' + mainCurrent).style.opacity = '0';
    document.getElementById('main-dot-' + mainCurrent).style.background = 'rgba(255,255,255,.45)';
    const thumb = document.getElementById('thumb-' + mainCurrent);
    if(thumb) { thumb.style.borderColor='transparent'; thumb.style.opacity='.65'; }
    mainCurrent = idx;
    document.getElementById('main-slide-' + mainCurrent).style.opacity = '1';
    document.getElementById('main-dot-' + mainCurrent).style.background = '#fff';
    const newThumb = document.getElementById('thumb-' + mainCurrent);
    if(newThumb) { newThumb.style.borderColor='#f59e0b'; newThumb.style.opacity='1'; newThumb.scrollIntoView({behavior:'smooth',block:'nearest',inline:'center'}); }
}
function mainNext() { mainGoto((mainCurrent+1)%mainTotal); }
function mainPrev() { mainGoto((mainCurrent-1+mainTotal)%mainTotal); }
// Auto-play
if(mainTotal > 1) setInterval(mainNext, 4500);

(function(){
    const shareUrl = {!! json_encode(url()->current()) !!};
    const shareTitle = {!! json_encode($activity->title) !!};

    const btnWeb = document.getElementById('btn-web-share-activity');
    if (navigator.share && btnWeb) { btnWeb.style.display='inline-flex'; btnWeb.addEventListener('click', ()=> navigator.share({title:shareTitle,text:shareTitle,url:shareUrl}).catch(()=>{})); }

    const whatsapp = document.getElementById('share-whatsapp-activity');
    const facebook = document.getElementById('share-facebook-activity');
    const twitter = document.getElementById('share-twitter-activity');
    const telegram = document.getElementById('share-telegram-activity');

    if (whatsapp) whatsapp.href = 'https://api.whatsapp.com/send?text=' + encodeURIComponent(shareTitle + ' - ' + shareUrl);
    if (facebook) facebook.href = 'https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(shareUrl);
    if (twitter) twitter.href = 'https://twitter.com/intent/tweet?text=' + encodeURIComponent(shareTitle) + '&url=' + encodeURIComponent(shareUrl);
    if (telegram) telegram.href = 'https://t.me/share/url?url=' + encodeURIComponent(shareUrl) + '&text=' + encodeURIComponent(shareTitle);

    [whatsapp,facebook,twitter,telegram].forEach(el=>{ if(!el) return; el.setAttribute('target','_blank'); el.setAttribute('rel','noopener noreferrer'); });

    const btnCopy = document.getElementById('btn-copy-link-activity');
    if (btnCopy) btnCopy.addEventListener('click', function(){ if(navigator.clipboard && navigator.clipboard.writeText){ navigator.clipboard.writeText(shareUrl).then(()=> alert('Tautan disalin ke clipboard')).catch(()=> fallbackCopy(shareUrl)); } else fallbackCopy(shareUrl); });

    function fallbackCopy(text){ const t = document.createElement('textarea'); t.value=text; t.style.position='fixed'; t.style.left='-9999px'; document.body.appendChild(t); t.select(); try{ document.execCommand('copy'); alert('Tautan disalin ke clipboard'); }catch(e){ prompt('Salin tautan berikut:', text); } document.body.removeChild(t); }
})();
</script>
@endsection
