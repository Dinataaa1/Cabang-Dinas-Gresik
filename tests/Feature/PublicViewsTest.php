<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Database\Seeders\DatabaseSeeder;

class PublicViewsTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(DatabaseSeeder::class);
    }

    public function test_home_page_returns_successful_response(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Sambutan Kepala Cabang Dinas');
    }

    public function test_profile_page_returns_successful_response(): void
    {
        $response = $this->get('/profil');
        $response->assertStatus(200);
        $response->assertSee('Tentang Kami');
    }

    public function test_profile_page_displays_about_image_when_present(): void
    {
        Storage::fake('public');

        $aboutImagePath = 'profiles/about-sample.jpg';
        Storage::disk('public')->put($aboutImagePath, 'fake-image-content');

        $about = \App\Models\Profile::where('key', 'about')->first();
        $about->update(['image' => $aboutImagePath]);

        $response = $this->get('/profil');
        $response->assertStatus(200);
        $response->assertSee(asset('storage/' . $aboutImagePath), false);
    }

    public function test_services_index_page_returns_successful_response(): void
    {
        $response = $this->get('/layanan');
        $response->assertStatus(200);
        $response->assertSee('Layanan Publik');
        $response->assertSee('Rekomendasi Mutasi Siswa');
    }

    public function test_service_detail_page_returns_successful_response(): void
    {
        $response = $this->get('/layanan/rekomendasi-mutasi-siswa');
        $response->assertStatus(200);
        $response->assertSee('Rekomendasi Mutasi Siswa');
        $response->assertSee('Syarat');
        $response->assertSee('Berkas Administrasi');
    }

    public function test_posts_index_page_returns_successful_response(): void
    {
        $response = $this->get('/informasi');
        $response->assertStatus(200);
        $response->assertSee('Kanal Informasi & Kegiatan');
    }

    public function test_post_detail_page_returns_successful_response(): void
    {
        $response = $this->get('/informasi/detail/sdn-1-gresik-raih-adiwiyata-mandiri-2026');
        $response->assertStatus(200);
        $response->assertSee('SDN 1 Gresik Raih Penghargaan Bergengsi');
    }

    public function test_mkks_pages_return_successful_response(): void
    {
        $responseSma = $this->get('/mkks/sma');
        $responseSma->assertStatus(200);
        $responseSma->assertSee('MKKS SMA');

        $responseSmk = $this->get('/mkks/smk');
        $responseSmk->assertStatus(200);
        $responseSmk->assertSee('MKKS SMK');

        $responsePk = $this->get('/mkks/pk-plk');
        $responsePk->assertStatus(200);
        $responsePk->assertSee('MKKS PK/PLK');
    }
}
