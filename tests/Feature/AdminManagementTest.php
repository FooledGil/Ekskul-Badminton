<?php

namespace Tests\Feature;

use App\Models\Achievement;
use App\Models\Gallery;
use App\Models\MatchScore;
use App\Models\Schedule;
use App\Models\SiteSetting;
use Database\Seeders\EkskulSeeder;
use Database\Seeders\SiteSettingSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AdminManagementTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed([
            SiteSettingSeeder::class,
            EkskulSeeder::class,
        ]);
    }

    public function test_admin_dashboard_renders_all_tabs(): void
    {
        $tabs = ['registrations', 'settings', 'schedules', 'achievements', 'galleries', 'scores'];

        foreach ($tabs as $tab) {
            $response = $this->get("/admin?tab={$tab}");
            $response->assertStatus(200);
            $response->assertSee('Admin Control Center');
        }
    }

    public function test_admin_can_update_settings_and_coach_profile(): void
    {
        Storage::fake('public');

        $payload = [
            'coach_name' => 'Coach Hendra Setiawan',
            'coach_title' => 'Pelatih Legendaris Nasional',
            'coach_bio' => 'Peraih medali emas Olimpiade yang kini membimbing bakat muda SMKN 2 Purwakarta.',
            'coach_certification' => 'Lisensi A BWF',
            'coach_specialization' => 'Ganda & Penempatan Bola Cepat',
            'about_tagline' => 'Akademi Badminton Unggul',
            'about_title' => 'Dedikasi Tanpa Batas Menuju Podium',
            'about_description' => 'Fasilitas dan pembinaan intensif untuk melahirkan atlet berkelas nasional.',
            'hero_title' => 'Pusat Keunggulan Bulu Tangkis',
            'hero_subtitle' => 'SMKN 2 Purwakarta Juara',
            'hero_badge' => 'Seleksi Atlet Prestasi 2026/2027',
            'hero_description' => 'Bergabunglah bersama kami dan raih prestasi membanggakan.',
            'contact_whatsapp' => '081299887766',
            'contact_instagram' => 'https://instagram.com/badminton_smkn2',
            'contact_address' => 'Komplek GOR Utama SMKN 2 Purwakarta',
            'contact_email' => 'official@smkn2purwakarta.sch.id',
            'coach_image_file' => UploadedFile::fake()->create('coach.jpg', 120, 'image/jpeg'),
            'hero_image_file' => UploadedFile::fake()->create('hero.jpg', 150, 'image/jpeg'),
        ];

        $response = $this->post('/admin/settings', $payload);
        $response->assertRedirect('/admin?tab=settings');
        $response->assertSessionHas('success');

        // Pastikan setting tersimpan di database
        $this->assertEquals('Coach Hendra Setiawan', SiteSetting::get('coach_name'));
        $this->assertEquals('Pelatih Legendaris Nasional', SiteSetting::get('coach_title'));
        $this->assertEquals('Akademi Badminton Unggul', SiteSetting::get('about_tagline'));

        // Pastikan file tersimpan di storage public
        $coachImagePath = str_replace('/storage/', '', SiteSetting::get('coach_image'));
        Storage::disk('public')->assertExists($coachImagePath);

        // Pastikan di halaman beranda menampilkan data yang baru diperbarui
        $homeResponse = $this->get('/');
        $homeResponse->assertStatus(200);
        $homeResponse->assertSee('Coach Hendra Setiawan');
        $homeResponse->assertSee('Pelatih Legendaris Nasional');
        $homeResponse->assertSee('Akademi Badminton Unggul');
        $homeResponse->assertSee('Pusat Keunggulan Bulu Tangkis');
        $homeResponse->assertSee('SMKN 2 Purwakarta Juara');
    }

    public function test_admin_can_crud_schedules(): void
    {
        // Tambah jadwal
        $postResponse = $this->post('/admin/schedules', [
            'day' => 'Kamis',
            'time_range' => '16.00 - 18.00 WIB',
            'location' => 'GOR Bulu Tangkis Sentra',
            'focus' => 'Simulasi Turnamen & Mental Bertanding',
            'is_next' => 1,
            'order' => 4,
        ]);
        $postResponse->assertRedirect('/admin?tab=schedules');

        $this->assertDatabaseHas('schedules', [
            'day' => 'Kamis',
            'focus' => 'Simulasi Turnamen & Mental Bertanding',
            'is_next' => true,
        ]);

        $schedule = Schedule::where('day', 'Kamis')->first();

        // Hapus jadwal
        $deleteResponse = $this->delete("/admin/schedules/{$schedule->id}");
        $deleteResponse->assertRedirect('/admin?tab=schedules');

        $this->assertDatabaseMissing('schedules', ['id' => $schedule->id]);
    }

    public function test_admin_can_crud_achievements(): void
    {
        Storage::fake('public');

        $payload = [
            'title' => 'Piala Menpora Cup Pelajar 2026',
            'category_name' => 'Tunggal Putri SMA/SMK',
            'year' => 2026,
            'rank' => 'Juara 1',
            'medal_type' => 'gold',
            'athlete_names' => 'Anindya Putri (XI RPL 2)',
            'image_file' => UploadedFile::fake()->create('trophy.jpg', 100, 'image/jpeg'),
        ];

        $postResponse = $this->post('/admin/achievements', $payload);
        $postResponse->assertRedirect('/admin?tab=achievements');

        $achievement = Achievement::where('title', 'Piala Menpora Cup Pelajar 2026')->first();
        $this->assertNotNull($achievement);
        $this->assertStringContainsString('/storage/uploads/achievements/', $achievement->image_url);

        // Hapus prestasi
        $deleteResponse = $this->delete("/admin/achievements/{$achievement->id}");
        $deleteResponse->assertRedirect('/admin?tab=achievements');
        $this->assertDatabaseMissing('achievements', ['id' => $achievement->id]);
    }

    public function test_admin_can_crud_galleries(): void
    {
        Storage::fake('public');

        $payload = [
            'title' => 'Selebrasi Juara Umum Bersama Pelatih',
            'category' => 'tim',
            'caption' => 'Momen tak terlupakan atlet SMKN 2 Purwakarta mengangkat trofi bergilir.',
            'span_class' => 'col-span-1 sm:col-span-2 md:col-span-2',
            'image_file' => UploadedFile::fake()->create('celebration.jpg', 120, 'image/jpeg'),
        ];

        $postResponse = $this->post('/admin/galleries', $payload);
        $postResponse->assertRedirect('/admin?tab=galleries');

        $gallery = Gallery::where('title', 'Selebrasi Juara Umum Bersama Pelatih')->first();
        $this->assertNotNull($gallery);
        $this->assertStringContainsString('/storage/uploads/gallery/', $gallery->image_url);

        // Hapus galeri
        $deleteResponse = $this->delete("/admin/galleries/{$gallery->id}");
        $deleteResponse->assertRedirect('/admin?tab=galleries');
        $this->assertDatabaseMissing('galleries', ['id' => $gallery->id]);
    }

    public function test_admin_can_crud_match_scores(): void
    {
        $payload = [
            'tournament' => 'Turnamen Bintang Pelajar Se-Jabar 2026',
            'category' => 'Ganda Putra',
            'team_a_name' => 'SMKN 2 Purwakarta (Rian / Bagas)',
            'team_b_name' => 'SMAN 2 Bandung (Kevin / Marcus Jr)',
            'team_a_sets' => 2,
            'team_b_sets' => 0,
            'score_details' => '21-17, 21-19',
            'status' => 'selesai',
            'is_active_highlight' => 1,
        ];

        $postResponse = $this->post('/admin/scores', $payload);
        $postResponse->assertRedirect('/admin?tab=scores');

        $score = MatchScore::where('tournament', 'Turnamen Bintang Pelajar Se-Jabar 2026')->first();
        $this->assertNotNull($score);
        $this->assertTrue((bool) $score->is_active_highlight);

        // Hapus skor
        $deleteResponse = $this->delete("/admin/scores/{$score->id}");
        $deleteResponse->assertRedirect('/admin?tab=scores');
        $this->assertDatabaseMissing('match_scores', ['id' => $score->id]);
    }
}
