<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\MkksController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\DownloadController;
use App\Http\Controllers\Admin\SkmController;
use App\Http\Controllers\Admin\SchoolController;
use App\Http\Controllers\Admin\ActivityController;

// ─── Rute Publik ───────────────────────────────────────────────────────────────
Route::get('/', [PublicController::class, 'index'])->name('home');
Route::get('/profil', [PublicController::class, 'profile'])->name('profile');
Route::get('/layanan', [PublicController::class, 'services'])->name('services.index');
Route::get('/layanan/{slug}', [PublicController::class, 'serviceDetail'])->name('services.show');
Route::get('/informasi', [PublicController::class, 'posts'])->name('posts.index');
Route::get('/informasi/detail/{slug}', [PublicController::class, 'postDetail'])->name('posts.show');
Route::get('/mkks/{category}', [PublicController::class, 'mkks'])->name('mkks.show');
Route::get('/kegiatan', [PublicController::class, 'kegiatan'])->name('kegiatan.index');
Route::get('/kegiatan/{slug}', [PublicController::class, 'kegiatanDetail'])->name('kegiatan.show');
Route::get('/faq', [PublicController::class, 'faq'])->name('faq');
Route::get('/pengaduan', [PublicController::class, 'pengaduan'])->name('pengaduan');
Route::get('/kontak', [PublicController::class, 'kontak'])->name('kontak');

// SKM
Route::get('/skm', [PublicController::class, 'skm'])->name('skm');
Route::post('/skm', [PublicController::class, 'storeSkm'])->name('skm.store');

// Download
Route::get('/download', [PublicController::class, 'download'])->name('download');
Route::get('/download/{download}/file', [PublicController::class, 'downloadFile'])->name('download.file');

// ─── Autentikasi Admin ─────────────────────────────────────────────────────────
Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

Route::get('/login', function () {
    return redirect()->route('admin.login');
})->name('login');

// ─── Admin CMS (protected) ─────────────────────────────────────────────────────
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {

    // Dashboard
    Route::get('/', function () {
        $postsCount         = \App\Models\Post::count();
        $newsCount          = \App\Models\Post::where('type', 'berita')->count();
        $announcementsCount = \App\Models\Post::where('type', 'pengumuman')->count();
        $servicesCount      = \App\Models\Service::count();
        $totalViews         = \App\Models\Post::sum('views');
        $topPosts           = \App\Models\Post::orderBy('views', 'desc')->take(10)->get();
        $skmTotal           = \App\Models\SkmResponse::count();
        $downloadCount      = \App\Models\Download::count();
        $sliderCount        = \App\Models\Slider::count();
        return view('admin.dashboard', compact(
            'postsCount', 'newsCount', 'announcementsCount', 'servicesCount',
            'totalViews', 'topPosts', 'skmTotal', 'downloadCount', 'sliderCount'
        ));
    })->name('dashboard');

    // Berita & Informasi
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

    // Layanan Cabdin
    Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
    Route::get('/services/create', [ServiceController::class, 'create'])->name('services.create');
    Route::post('/services', [ServiceController::class, 'store'])->name('services.store');
    Route::get('/services/{service}/edit', [ServiceController::class, 'edit'])->name('services.edit');
    Route::put('/services/{service}', [ServiceController::class, 'update'])->name('services.update');
    Route::delete('/services/{service}', [ServiceController::class, 'destroy'])->name('services.destroy');

    // Profil Lembaga
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // MKKS
    Route::get('/mkks', [MkksController::class, 'index'])->name('mkks.index');
    Route::post('/mkks', [MkksController::class, 'update'])->name('mkks.update');

    // Kelola Data Sekolah (per kategori SMA/SMK/PK/PLK)
    Route::get('/schools', [SchoolController::class, 'index'])->name('schools.index');
    Route::get('/schools/create', [SchoolController::class, 'create'])->name('schools.create');
    Route::post('/schools', [SchoolController::class, 'store'])->name('schools.store');
    Route::get('/schools/{school}/edit', [SchoolController::class, 'edit'])->name('schools.edit');
    Route::put('/schools/{school}', [SchoolController::class, 'update'])->name('schools.update');
    Route::delete('/schools/{school}', [SchoolController::class, 'destroy'])->name('schools.destroy');

    // Kelola Kegiatan
    Route::get('/activities', [ActivityController::class, 'index'])->name('activities.index');
    Route::get('/activities/create', [ActivityController::class, 'create'])->name('activities.create');
    Route::post('/activities', [ActivityController::class, 'store'])->name('activities.store');
    Route::get('/activities/{activity}/edit', [ActivityController::class, 'edit'])->name('activities.edit');
    Route::put('/activities/{activity}', [ActivityController::class, 'update'])->name('activities.update');
    Route::delete('/activities/{activity}', [ActivityController::class, 'destroy'])->name('activities.destroy');

    // Kelola Agenda
    Route::resource('/agendas', \App\Http\Controllers\Admin\AgendaController::class)->except(['show']);

    // Kelola Slider Banner
    Route::resource('/sliders', SliderController::class)->except(['show']);

    // Kelola Download
    Route::get('/downloads', [DownloadController::class, 'index'])->name('downloads.index');
    Route::post('/downloads', [DownloadController::class, 'store'])->name('downloads.store');
    Route::delete('/downloads/{download}', [DownloadController::class, 'destroy'])->name('downloads.destroy');

    // SKM
    Route::get('/skm', [SkmController::class, 'index'])->name('skm.index');
    Route::get('/skm/laporan', [SkmController::class, 'report'])->name('skm.report');
    Route::delete('/skm/{skmResponse}', [SkmController::class, 'destroy'])->name('skm.destroy');

    // Kelola Admin
    Route::get('/users', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [\App\Http\Controllers\Admin\UserController::class, 'create'])->name('users.create');
    Route::post('/users', [\App\Http\Controllers\Admin\UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}/edit', [\App\Http\Controllers\Admin\UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [\App\Http\Controllers\Admin\UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [\App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('users.destroy');

    // Temp debug: show counts per post type and recent 'kegiatan' entries
    Route::get('/posts-debug', function () {
        $types = ['berita','pengumuman','inovasi','prestasi','kegiatan'];
        $counts = [];
        foreach ($types as $t) {
            $counts[$t] = \App\Models\Post::where('type', $t)->count();
        }
        $recentKegiatan = \App\Models\Post::where('type', 'kegiatan')->orderBy('created_at', 'desc')->take(10)->get(['id','title','slug','created_at']);
        return response()->json(['counts' => $counts, 'recent_kegiatan' => $recentKegiatan]);
    })->name('admin.posts.debug');
});
