@extends('layouts.public')
@section('title', 'Kegiatan - Cabdin Wilayah Kabupaten Gresik')
@section('content')

<section class="page-header">
    <div class="container">
        <h2>Galeri Kegiatan</h2>
        <div class="breadcrumb"><a href="{{ route('home') }}">Beranda</a> / Kegiatan</div>
    </div>
</section>

<section class="main-section">
    <div class="container">

        {{-- Filter & Search Bar --}}
        <div style="display:flex;flex-wrap:wrap;gap:12px;align-items:center;margin-bottom:32px;">
            <form method="GET" action="{{ route('kegiatan.index') }}" style="display:flex;gap:10px;flex-wrap:wrap;flex:1;">
                <input type="text" name="search" value="{{ $search }}" placeholder="Cari kegiatan..." style="padding:10px 16px;border:1px solid var(--border);border-radius:10px;font-size:13px;outline:none;flex:1;min-width:180px; box-sizing:border-box;">
                <select name="kategori" style="padding:10px 14px;border:1px solid var(--border);border-radius:10px;font-size:13px;background:#fff;outline:none;">
                    <option value="">Semua Kategori</option>
                    @foreach(['umum','prestasi','sosial','olahraga','seni','pendidikan'] as $cat)
                        <option value="{{ $cat }}" {{ $category==$cat?'selected':'' }}>{{ ucfirst($cat) }}</option>
                    @endforeach
                </select>
                <button type="submit" style="padding:10px 20px;background:var(--primary);color:#fff;border:none;border-radius:10px;font-size:13px;font-weight:700;cursor:pointer;">Cari</button>
                @if($search || $category)
                    <a href="{{ route('kegiatan.index') }}" style="padding:10px 16px;background:#f1f5f9;color:#64748b;border-radius:10px;font-size:13px;font-weight:600;text-decoration:none; display:inline-flex; align-items:center; justify-content:center;">Reset</a>
                @endif
            </form>
        </div>

        @if($activities->isEmpty())
            <div style="text-align:center;padding:80px 20px;color:var(--text-muted);">
                <i class="bi bi-images" style="font-size:56px;display:block;margin-bottom:16px; color:#cbd5e1;"></i>
                <p>Belum ada kegiatan yang ditemukan.</p>
            </div>
        @else
        {{-- Gallery Grid --}}
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(min(100%, 280px),1fr));gap:24px;">
            @foreach($activities as $activity)
            <div class="activity-card" style="border-radius:16px;overflow:hidden;box-shadow:0 2px 12px rgba(0,0,0,.08);background:#fff;transition:all .3s cubic-bezier(.4,0,.2,1);border:1px solid #f1f5f9;" onmouseover="this.style.transform='translateY(-5px)';this.style.boxShadow='0 12px 32px rgba(0,0,0,.14)'" onmouseout="this.style.transform='';this.style.boxShadow='0 2px 12px rgba(0,0,0,.08)'">
                
                {{-- Card Slideshow/Cover --}}
                <div style="position:relative;height:220px;overflow:hidden;background:#f1f5f9;">
                    @php
                        $allPhotos = $activity->all_photos;
                        $photoCount = count($allPhotos);
                    @endphp

                    @if($photoCount > 0)
                        @foreach($allPhotos as $pi => $photo)
                        <img src="{{ $photo }}" class="card-slide-img" id="slide-{{ $activity->id }}-{{ $pi }}" alt="{{ $activity->title }}" style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;transition:opacity .5s ease;opacity:{{ $pi===0?1:0 }};" onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1516321318423-f06f85e504b3?q=80&w=800&auto=format&fit=crop';">
                        @endforeach

                        @if($photoCount > 1)
                        {{-- Navigation dots --}}
                        <div style="position:absolute;bottom:10px;left:50%;transform:translateX(-50%);display:flex;gap:5px;z-index:10;">
                            @for($pi=0;$pi<$photoCount;$pi++)
                            <button onclick="showSlide({{ $activity->id }},{{ $pi }},{{ $photoCount }})" id="dot-{{ $activity->id }}-{{ $pi }}" style="width:7px;height:7px;border-radius:50%;border:none;cursor:pointer;background:{{ $pi===0?'#fff':'rgba(255,255,255,.5)' }};transition:background .3s;"></button>
                            @endfor
                        </div>
                        {{-- Arrows --}}
                        <button onclick="prevSlide({{ $activity->id }},{{ $photoCount }})" style="position:absolute;left:8px;top:50%;transform:translateY(-50%);background:rgba(0,0,0,.45);color:#fff;border:none;border-radius:50%;width:28px;height:28px;cursor:pointer;font-size:14px;display:flex;align-items:center;justify-content:center;z-index:10; border:none;">‹</button>
                        <button onclick="nextSlide({{ $activity->id }},{{ $photoCount }})" style="position:absolute;right:8px;top:50%;transform:translateY(-50%);background:rgba(0,0,0,.45);color:#fff;border:none;border-radius:50%;width:28px;height:28px;cursor:pointer;font-size:14px;display:flex;align-items:center;justify-content:center;z-index:10; border:none;">›</button>
                        @endif
                    @else
                        <div style="display:flex;align-items:center;justify-content:center;height:100%;color:#cbd5e1;font-size:40px;"><i class="bi bi-image"></i></div>
                    @endif

                    {{-- Category Badge --}}
                    <div style="position:absolute;top:10px;right:10px;z-index:10;">
                        <span style="background:rgba(11,31,63,.85);color:#fff;padding:3px 10px;border-radius:20px;font-size:10.5px;font-weight:700;backdrop-filter:blur(4px);">{{ ucfirst($activity->category) }}</span>
                    </div>

                    {{-- Photo count badge --}}
                    @if($photoCount > 1)
                    <div style="position:absolute;top:10px;left:10px;z-index:10;">
                        <span style="background:rgba(0,0,0,.5);color:#fff;padding:3px 8px;border-radius:20px;font-size:10px;font-weight:600;"><i class="bi bi-images"></i> {{ $photoCount }}</span>
                    </div>
                    @endif
                </div>

                {{-- Card Body --}}
                <div style="padding:18px;">
                    <h3 style="font-size:15px;font-weight:800;color:#0b1f3f;margin:0 0 8px;line-height:1.4;">{{ $activity->title }}</h3>
                    <div style="display:flex;gap:14px;font-size:11.5px;color:#94a3b8;margin-bottom:10px;flex-wrap:wrap;">
                        @if($activity->activity_date)
                            <span><i class="bi bi-calendar3"></i> {{ $activity->activity_date->format('d M Y') }}</span>
                        @endif
                        @if($activity->location)
                            <span><i class="bi bi-geo-alt"></i> {{ $activity->location }}</span>
                        @endif
                        <span><i class="bi bi-eye"></i> {{ number_format($activity->views) }} tayangan</span>
                    </div>
                    @if($activity->description)
                    <p style="font-size:12.5px;color:#64748b;line-height:1.6;margin:0 0 14px;">{!! Str::limit(strip_tags($activity->description), 120) !!}</p>
                    @endif
                    <a href="{{ route('kegiatan.show', $activity->slug) }}" style="display:inline-flex;align-items:center;gap:6px;font-size:12.5px;font-weight:700;color:var(--primary);text-decoration:none;transition:gap .2s;" onmouseover="this.style.gap='10px'" onmouseout="this.style.gap='6px'">Lihat Detail <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>
            @endforeach
        </div>

        <div style="margin-top:32px;">{{ $activities->links() }}</div>
        @endif
    </div>
</section>

@endsection

@section('scripts')
<script>
const slideIndex = {};
function showSlide(id, idx, total) {
    for (let i=0;i<total;i++) {
        const img = document.getElementById(`slide-${id}-${i}`);
        const dot = document.getElementById(`dot-${id}-${i}`);
        if(img) img.style.opacity = i===idx ? '1' : '0';
        if(dot) dot.style.background = i===idx ? '#fff' : 'rgba(255,255,255,.5)';
    }
    slideIndex[id] = idx;
}
function nextSlide(id, total) {
    const cur = slideIndex[id] ?? 0;
    showSlide(id, (cur+1)%total, total);
}
function prevSlide(id, total) {
    const cur = slideIndex[id] ?? 0;
    showSlide(id, (cur-1+total)%total, total);
}
// Auto-play each card
document.querySelectorAll('.activity-card').forEach(card => {
    const firstSlide = card.querySelector('.card-slide-img');
    if (!firstSlide) return;
    const id = firstSlide.id.split('-')[1];
    const total = card.querySelectorAll('.card-slide-img').length;
    if (total <= 1) return;
    slideIndex[id] = 0;
    setInterval(() => nextSlide(id, total), 3500);
});
</script>
@endsection
