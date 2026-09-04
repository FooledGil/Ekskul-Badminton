<?php

namespace Tests\Feature;

use App\Models\Achievement;
use App\Models\MatchScore;
use App\Models\Registration;
use Database\Seeders\EkskulSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EkskulFeatureTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(EkskulSeeder::class);
    }

    public function test_home_page_renders_successfully_with_data(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('SMKN 2');
        $response->assertSee('Ekskul Bulu Tangkis');
        $response->assertSee('Papan Skor Resmi');
        $response->assertSee('Bpk. Haryanto');
        $response->assertSee('Interactive Court Visualizer');
        $response->assertSee('Jadwal Latihan Rutin');
        $response->assertSee('Prestasi Membanggakan');
        $response->assertSee('Galeri Kegiatan Ekskul');
        $response->assertSee('Formulir Pendaftaran Atlet Baru');
    }

    public function test_registration_form_submission_via_ajax(): void
    {
        $payload = [
            'name' => 'Bagas Maulana',
            'class_major' => 'X RPL 1',
            'whatsapp_number' => '085711223344',
            'gender' => 'L',
            'preferred_category' => 'Ganda Putra',
            'experience_level' => 'Menengah',
            'motivation' => 'Ingin menjadi atlet andalan sekolah dan berprestasi di tingkat kabupaten Purwakarta.',
        ];

        $response = $this->postJson('/daftar', $payload);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
        ]);

        $this->assertDatabaseHas('registrations', [
            'name' => 'Bagas Maulana',
            'class_major' => 'X RPL 1',
            'whatsapp_number' => '085711223344',
            'status' => 'menunggu',
        ]);
    }

    public function test_duplicate_registration_returns_notice(): void
    {
        $payload = [
            'name' => 'Aditya Copy',
            'class_major' => 'X RPL 2',
            'whatsapp_number' => '081234567890',
            'gender' => 'L',
            'preferred_category' => 'Ganda Putra',
            'experience_level' => 'Menengah',
            'motivation' => 'Pendaftaran kedua dengan nomor kontak sama.',
        ];

        $response = $this->postJson('/daftar', $payload);

        $response->assertStatus(200);
        $response->assertJson([
            'already_exists' => true,
        ]);
    }

    public function test_check_status_search_by_code(): void
    {
        $reg = Registration::where('registration_code', 'BDM-2026-001')->first();
        $this->assertNotNull($reg);

        $response = $this->get('/cek-status?q='.$reg->registration_code);

        $response->assertStatus(200);
        $response->assertSee($reg->registration_code);
        $response->assertSee('Aditya Pratama');
        $response->assertSee('LOLOS / DITERIMA');
    }

    public function test_admin_dashboard_and_status_update(): void
    {
        $response = $this->get('/admin');
        $response->assertStatus(200);
        $response->assertSee('Manajemen Pendaftar Atlet Ekskul');
        $response->assertSee('Zahra Amalia');

        $reg = Registration::where('registration_code', 'BDM-2026-002')->first();
        $this->assertNotNull($reg);

        $updateResponse = $this->post("/admin/registrasi/{$reg->id}/status", [
            'status' => 'diterima',
            'coach_notes' => 'Lolos verifikasi. Hadir hari Sabtu pukul 08.00 WIB untuk tes fisik lapangan.',
        ]);

        $updateResponse->assertRedirect();

        $this->assertDatabaseHas('registrations', [
            'id' => $reg->id,
            'status' => 'diterima',
            'coach_notes' => 'Lolos verifikasi. Hadir hari Sabtu pukul 08.00 WIB untuk tes fisik lapangan.',
        ]);

        // Verify status page now reflects 'LOLOS / DITERIMA'
        $statusPageResponse = $this->get('/cek-status?q='.$reg->registration_code);
        $statusPageResponse->assertStatus(200);
        $statusPageResponse->assertSee('LOLOS / DITERIMA');
        $statusPageResponse->assertSee('Hadir hari Sabtu pukul 08.00 WIB untuk tes fisik lapangan.');
    }

    public function test_model_factories_create_valid_records(): void
    {
        $acceptedRegistration = Registration::factory()->accepted()->create([
            'name' => 'Atlet Berprestasi',
        ]);
        $this->assertDatabaseHas('registrations', [
            'id' => $acceptedRegistration->id,
            'status' => 'diterima',
            'name' => 'Atlet Berprestasi',
        ]);

        $customMatch = MatchScore::factory()->live()->create([
            'tournament' => 'Turnamen Antar Sekolah 2026',
        ]);
        $this->assertDatabaseHas('match_scores', [
            'id' => $customMatch->id,
            'tournament' => 'Turnamen Antar Sekolah 2026',
            'status' => 'live',
        ]);

        $customAchievement = Achievement::factory()->gold()->create([
            'title' => 'Piala Bergilir Gubernur Jabar',
        ]);
        $this->assertDatabaseHas('achievements', [
            'id' => $customAchievement->id,
            'title' => 'Piala Bergilir Gubernur Jabar',
            'medal_type' => 'gold',
        ]);
    }
}
