<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Service;
use App\Models\Profile;
use App\Models\Slider;
use App\Models\Download;
use App\Models\SkmResponse;
use App\Models\Activity;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index()
    {
        // Hero Slider: ambil dari tabel sliders, fallback ke berita jika kosong
        $sliders     = Slider::where('is_active', true)->orderBy('order')->get();
        $sliderPosts = Post::orderBy('created_at', 'desc')->take(3)->get(); // fallback

        // 6 Berita terbaru
        $latestNews = Post::where('type', 'berita')->orderBy('created_at', 'desc')->paginate(6);

        // 4 Pengumuman terbaru
        $latestAnnouncements = Post::where('type', 'pengumuman')->orderBy('created_at', 'desc')->take(4)->get();

        // Gabungan Inovasi & Prestasi
        $latestInnovations  = Post::where('type', 'inovasi')->orderBy('created_at', 'desc')->take(5)->get();
        $latestAchievements = Post::where('type', 'prestasi')->orderBy('created_at', 'desc')->take(5)->get();
        $combinedPosts      = $latestInnovations->concat($latestAchievements)->sortByDesc('created_at');

        $latestAgendas = \App\Models\Agenda::where('is_published', true)->orderBy('event_date', 'asc')->where('event_date', '>=', now())->take(2)->get();
        if ($latestAgendas->count() < 2) {
            $latestAgendas = \App\Models\Agenda::where('is_published', true)->orderBy('event_date', 'desc')->take(2)->get();
        }

        $latestActivities = Activity::where('is_published', true)->orderBy('activity_date', 'desc')->take(2)->get();

        // Layanan
        $services = Service::take(6)->get();

        // Profil Sambutan & Slider Samping
        $sambutanNama  = Profile::where('key', 'sambutan_nama')->first();
        $sambutanTitle = Profile::where('key', 'sambutan_title')->first();
        $sambutanTeks  = Profile::where('key', 'sambutan_text')->first();
        $sambutanFoto  = Profile::where('key', 'sambutan_image')->first();
        $sideSlider1   = Profile::where('key', 'side_slider_1')->first();
        $sideSlider2   = Profile::where('key', 'side_slider_2')->first();
        $quoteSlide1   = Profile::where('key', 'quote_slide_1')->first();
        $quoteSlide2   = Profile::where('key', 'quote_slide_2')->first();
        $quoteSlide3   = Profile::where('key', 'quote_slide_3')->first();

        return view('public.index', compact(
            'sliders',
            'sliderPosts',
            'latestNews',
            'latestAnnouncements',
            'latestInnovations',
            'latestAchievements',
            'combinedPosts',
            'latestAgendas',
            'latestActivities',
            'services',
            'sambutanNama',
            'sambutanTitle',
            'sambutanTeks',
            'sambutanFoto',
            'sideSlider1',
            'sideSlider2',
            'quoteSlide1',
            'quoteSlide2',
            'quoteSlide3'
        ));
    }

       public function profile()
    {
        $about    = Profile::where('key', 'about')->first();
        $visiMisi = Profile::where('key', 'visi_misi')->first();
        $struktur = Profile::where('key', 'struktur')->first();
        
        $org1 = Profile::where('key', 'org_person_1')->first();
        $org2 = Profile::where('key', 'org_person_2')->first();
        $org3 = Profile::where('key', 'org_person_3')->first();
        $org4 = Profile::where('key', 'org_person_4')->first();

        return view('public.profile', compact('about', 'visiMisi', 'struktur', 'org1', 'org2', 'org3', 'org4'));
    }

    public function services(Request $request)
    {
        $category = $request->query('category');
        $query = Service::query();

        if ($category && in_array($category, ['SMA', 'SMK', 'Tata Usaha'])) {
            $query->where('category', $category);
        }

        $services = $query->orderBy('category')->orderBy('name', 'asc')->get();
        $categories = ['SMA', 'SMK', 'Tata Usaha'];
        return view('public.services.index', compact('services', 'categories', 'category'));
    }

    public function serviceDetail($slug)
    {
        $service = Service::where('slug', $slug)->firstOrFail();
        return view('public.services.show', compact('service'));
    }

    public function posts(Request $request)
    {
        $query  = Post::query();
        $type   = $request->query('type');
        $search = $request->query('search');

        if ($type && in_array($type, ['berita', 'pengumuman', 'inovasi', 'prestasi', 'kegiatan'])) {
            $query->where('type', $type);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                  ->orWhere('content', 'like', '%' . $search . '%');
            });
        }

        $posts = $query->orderBy('created_at', 'desc')->paginate(9);
        return view('public.posts.index', compact('posts', 'type', 'search'));
    }

    public function postDetail($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        $post->increment('views');
        $relatedPosts = Post::where('type', $post->type)
                            ->where('id', '!=', $post->id)
                            ->orderBy('created_at', 'desc')
                            ->take(3)
                            ->get();
        return view('public.posts.show', compact('post', 'relatedPosts'));
    }

    public function mkks($category)
    {
        $categoryName = strtoupper(str_replace('-', '/', $category));
        if (!in_array($categoryName, ['SMA', 'SMK', 'PK/PLK'])) abort(404);
        $content = \App\Models\MkksContent::where('category', $categoryName)->first();
        $schools = \App\Models\School::where('category', $categoryName)
                                     ->where('is_active', true)
                                     ->orderByDesc('jumlah_prestasi')
                                     ->get();
        $allSchools = \App\Models\School::where('is_active', true)
                                        ->orderBy('name')
                                        ->get();
        return view('public.mkks', compact('content', 'categoryName', 'schools', 'allSchools'));
    }

    public function faq()
    {
        return view('public.faq');
    }

    public function skm()
    {
        $services = \App\Models\Service::orderBy('category')->orderBy('name')->get(['id','name','category']);
        return view('public.skm', compact('services'));
    }

    public function storeSkm(Request $request)
    {
        $request->validate([
            'nama'              => 'required|string|max:150',
            'jenis_kelamin'     => 'required|in:Laki-laki,Perempuan',
            'usia'              => 'required|integer|min:10|max:120',
            'pendidikan'        => 'required|string|max:100',
            'pekerjaan'         => 'required|string|max:150',
            'layanan_diterima'  => 'required|string|max:200',
            'tanggal_pelayanan' => 'required|date|before_or_equal:today',
            'q1' => 'required|integer|between:1,4',
            'q2' => 'required|integer|between:1,4',
            'q3' => 'required|integer|between:1,4',
            'q4' => 'required|integer|between:1,4',
            'q5' => 'required|integer|between:1,4',
            'q6' => 'required|integer|between:1,4',
            'q7' => 'required|integer|between:1,4',
            'q8' => 'required|integer|between:1,4',
            'saran' => 'nullable|string|max:2000',
        ], [
            'nama.required'              => 'Nama lengkap wajib diisi.',
            'jenis_kelamin.required'     => 'Jenis kelamin wajib dipilih.',
            'usia.required'              => 'Usia wajib diisi.',
            'pendidikan.required'        => 'Pendidikan terakhir wajib dipilih.',
            'pekerjaan.required'         => 'Pekerjaan/profesi wajib diisi.',
            'layanan_diterima.required'  => 'Jenis layanan yang diterima wajib dipilih.',
            'tanggal_pelayanan.required' => 'Tanggal pelayanan wajib diisi.',
            'q*.required'               => 'Semua penilaian wajib diisi.',
        ]);

        SkmResponse::create($request->only([
            'nama','jenis_kelamin','usia','pendidikan','pekerjaan',
            'layanan_diterima','tanggal_pelayanan',
            'q1','q2','q3','q4','q5','q6','q7','q8','saran',
        ]));

        return redirect()->route('skm')->with('success', 'Terima kasih! Survei Anda berhasil dikirim. Masukan Anda sangat berarti bagi kami.');
    }

    public function download(Request $request)
    {
        $query    = Download::query();
        $category = $request->query('category');
        $search   = $request->query('search');

        if ($category) {
            $query->where('category', $category);
        }
        if ($search) {
            $query->where('title', 'like', '%' . $search . '%');
        }

        $downloads  = $query->orderBy('created_at', 'desc')->paginate(12);
        $categories = Download::select('category')->distinct()->pluck('category');

        return view('public.download', compact('downloads', 'categories', 'category', 'search'));
    }

    public function downloadFile(Download $download)
    {
        $download->increment('download_count');
        return Storage::disk('public')->download($download->file_path, $download->file_name);
    }

    public function pengaduan()
    {
        return view('public.pengaduan');
    }

    public function kontak()
    {
        return view('public.kontak');
    }

    public function kegiatan(Request $request)
    {
        $category = $request->query('kategori');
        $search   = $request->query('search');
        $query = Activity::where('is_published', true);
        if ($category) {
            $query->where('category', $category);
        }
        if ($search) {
            $query->where('title', 'like', '%'.$search.'%');
        }
        $activities = $query->orderByDesc('activity_date')->paginate(9);
        $categories = Activity::where('is_published', true)
                               ->select('category')->distinct()->pluck('category');
        return view('public.kegiatan.index', compact('activities', 'category', 'search', 'categories'));
    }

    public function kegiatanDetail($slug)
    {
        $activity = Activity::where('slug', $slug)->where('is_published', true)->firstOrFail();
        $activity->increment('views');
        $related = Activity::where('is_published', true)
                           ->where('id', '!=', $activity->id)
                           ->orderByDesc('activity_date')
                           ->take(3)->get();
        return view('public.kegiatan.show', compact('activity', 'related'));
    }
}
