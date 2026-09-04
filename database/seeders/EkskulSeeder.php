<?php

namespace Database\Seeders;

use App\Models\Achievement;
use App\Models\Gallery;
use App\Models\MatchScore;
use App\Models\Registration;
use App\Models\Schedule;
use Illuminate\Database\Seeder;

class EkskulSeeder extends Seeder
{
    public function run(): void
    {
        // Schedules
        Schedule::truncate();
        Schedule::create([
            'day' => 'Senin',
            'time_range' => '15.30 - 17.30 WIB',
            'location' => 'GOR Sekolah SMKN 2',
            'focus' => 'Latihan Fisik & Dasar (Footwork, Stamina, Shadow)',
            'is_next' => false,
            'order' => 1,
        ]);
        Schedule::create([
            'day' => 'Rabu',
            'time_range' => '15.30 - 17.30 WIB',
            'location' => 'GOR Sekolah SMKN 2',
            'focus' => 'Teknik & Pola Permainan (Netting, Dropshot, Smash)',
            'is_next' => false,
            'order' => 2,
        ]);
        Schedule::create([
            'day' => 'Sabtu',
            'time_range' => '08.00 - 11.00 WIB',
            'location' => 'GOR PBSI Kabupaten Purwakarta',
            'focus' => 'Sparing & Simulasi Pertandingan Resmi',
            'is_next' => true,
            'order' => 3,
        ]);

        // Achievements
        Achievement::truncate();
        Achievement::create([
            'title' => 'Kejuaraan Pelajar Tingkat Kabupaten',
            'category_name' => 'Tunggal Putra - 2025',
            'year' => 2025,
            'rank' => 'Juara 1',
            'medal_type' => 'gold',
            'athlete_names' => 'Rian Ardianto (XII RPL 1)',
            'image_url' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDUZW-Spv-GY5dmqUAEH968OWh6LTwE9NHsOUNvbSbIvGJUtKLDYbOICVAxegZwuETuCBXZdxYuAfcOpSb355c7HbzPdNHMe79BIlL9eiCvf3_QAQDWe3W-PrdV5ghE9mR0TwN4ndiGlqNMPywBhioC7AZyXrN2JMQf3b1tLlyHCndhIBzZriizzBUmYqWVGeeq930SWrd4eHQDkjuDuBABcudtB72lhFiw__54UNtIG5z8F63TvkFFUw',
        ]);
        Achievement::create([
            'title' => 'O2SN Tingkat Provinsi Jawa Barat',
            'category_name' => 'Ganda Putri - 2024',
            'year' => 2024,
            'rank' => 'Juara 2',
            'medal_type' => 'silver',
            'athlete_names' => 'Siti Nurhaliza & Nurul Fadilah (XI DKV)',
            'image_url' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuArD1aFdxxu-GA4EJFWgAfuI53mvAb9k6v3Mn-xhOIk1HFSAQlc7LKU21g4QNNOW-XVZeI5wHTj4gOk3y_NXy69R8MbgERVGoWiKfFzknBwaQ8nawxN3JpIFZ7h8JHzHx-YjtqPpThZ70PV8GYsTkGoih6aNXvurPi13h_csiVAjmeS8zGXzM0wzBZVLtkeMDAT3QsnBMi6RObuGPo1kla3xybDsrVI1NCFbRq1GewwO9dbXxwSCnNfXw',
        ]);
        Achievement::create([
            'title' => 'Liga Antar Sekolah Se-Purwakarta',
            'category_name' => 'Beregu Campuran - 2024',
            'year' => 2024,
            'rank' => 'Juara 1',
            'medal_type' => 'gold',
            'athlete_names' => 'Tim Beregu Campuran SMKN 2',
            'image_url' => null,
        ]);
        Achievement::create([
            'title' => 'Kejuaraan Terbuka PBSI Purwakarta',
            'category_name' => 'Tunggal Putra - 2023',
            'year' => 2023,
            'rank' => 'Juara 3',
            'medal_type' => 'bronze',
            'athlete_names' => 'Dimas Aditya (Alumni 2024)',
            'image_url' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDaIPlg6-J2kb833QmQBO7SzHUFQeWpPplnIS7mznAGJL4IKhYHnI4lIgWfGdOShAU0pObILY_VciFnTKlo3WDhSZf0DW-EwFLbrwFFS7oJFaAnIS8y6ou7ht9edq6AZ7xG_RkwN1-cCLdtb0Wsfo_GA9zwuKChcYH8zwzwSYFniz2IjzWalw0oaMZCya0Pgkr-3BVYwgNhmFEMG3L7LXS4sohxNILGIjt0xm-8q9LRilzMgcv3stQfPQ',
        ]);

        // Galleries
        Gallery::truncate();
        Gallery::create([
            'title' => 'Foto Tim Angkatan 2024',
            'caption' => 'Kompak dan bersemangat, skuad atlet bulu tangkis SMKN 2 Purwakarta bersama pelatih.',
            'category' => 'tim',
            'image_url' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCAQkLVOexixIEo_rumoopCYb3VzjdK-gH9fN93uVyoTHH2g8HmuWPASw3kkowwqi33pqUWpV4wbMsTBJhRTJCAjKh-bGPnEIFfvr8Ojnvc0JaVWyWwHj3Rnb4n8E0lL-faBRD5vSaHJgNW6VLJAnd9KR5diqPS_v_dF7TxB7AYFyvwZ5iVKnAnfU1FKHe6hUy8umVM7Kbx5ES-9qbGet6gyByvB7qgPCf-OJ2rqdIrdsXSe5-etgk7YQ',
            'span_class' => 'col-span-1 sm:col-span-2 md:col-span-2 md:row-span-2',
        ]);
        Gallery::create([
            'title' => 'Fokus Sentuhan Racket',
            'caption' => 'Penyempurnaan grip dan kontrol shuttlecock di area jaring/net.',
            'category' => 'latihan',
            'image_url' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuC6cSXJ0-wjrwRN0REt2h_o1YhPosy-km2ZSHcdl6qlC1gVBZ_WF9kxc_YavmmpgZZfcO3t_WnlrVVrIeAvOYY--up3L9xYxDIELuwMrjwN5LQg4fm4aKdpIzhVZIVOfEc8vNpD0f8bWoGEpoZN32dTpMqAT2C8gV8hjqEWCpEbwxtjojr3o-h031GzuN2vjHksxmfa7Zhi4MkHVdV1VPiPGh5rUs-NJyIPEGPbsjDJmTCmqxO6iaVDpQ',
            'span_class' => 'col-span-1 md:col-span-1 md:row-span-1',
        ]);
        Gallery::create([
            'title' => 'Jump Smash Power Drill',
            'caption' => 'Lompatan vertikal eksplosif atlet dalam mengincar smash tajam.',
            'category' => 'latihan',
            'image_url' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCjh4jyTU84WyHY0NEppmXzli5zaa5yLvU9EuZvxHczkZIaSQc4AxoDWnnig8Ik02PsklCy2fg61B7yk1EQers76vZT_zazbVIj_JmccJxELMcYN_u_JGNucNLF8-AI5qFjU4OMZFsqYW4F8JnI2UMdnxYALXeBx_8TwJgcvsFDNzXsJJLOeYDutmVC4npas5s1-kJGGt-LtGpcOxUtcT_3F0ZO4sHeQvRVzgASlyuOXtMEgU6Xp_loxA',
            'span_class' => 'col-span-1 md:col-span-1 md:row-span-1',
        ]);
        Gallery::create([
            'title' => 'Semangat Kebersamaan & Istirahat',
            'caption' => 'Menjalin persaudaraan dan sportivitas tinggi usai latihan keras.',
            'category' => 'pertandingan',
            'image_url' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDhO1rZBOx4FvLwQA0Ue5OCBWoYanvRA5F1gcFWuwVSUhJAnG15THLJr1rrjRNq0lmdVMJs2ozBt2nmm1Eby18pL8GPv2GArxSZeY1DQjamFBvwGHqjf0EtbB8mltsDXn2_HkJh9yAYMOG0WjpXRdl8TDdKblxVJ_IBxA_gh9uTmlB5xeQUL5AcTfzMWsNN3WerHZE8HNDGS7MbHs6vezEiUkOHcIky5d5NMS-G1s8DWXbSoFsmTFmHQg',
            'span_class' => 'col-span-1 sm:col-span-2 md:col-span-2 md:row-span-1',
        ]);

        // Match Scores
        MatchScore::truncate();
        MatchScore::create([
            'tournament' => 'Grand Final Kejuaraan Pelajar Purwakarta 2026',
            'category' => 'Tunggal Putra',
            'team_a_name' => 'SMKN 2 Purwakarta (Rian A.)',
            'team_b_name' => 'SMAN 1 Purwakarta (Fajar K.)',
            'team_a_sets' => 2,
            'team_b_sets' => 1,
            'score_details' => '21-19 | 18-21 | 21-17',
            'status' => 'selesai',
            'is_active_highlight' => true,
        ]);
        MatchScore::create([
            'tournament' => 'Semifinal O2SN Tingkat Wilayah II',
            'category' => 'Ganda Putri',
            'team_a_name' => 'SMKN 2 Purwakarta (Siti / Nurul)',
            'team_b_name' => 'SMKN 1 Campaka (Dina / Lia)',
            'team_a_sets' => 2,
            'team_b_sets' => 0,
            'score_details' => '21-14 | 21-12',
            'status' => 'selesai',
            'is_active_highlight' => false,
        ]);

        // Sample Registrations
        Registration::truncate();
        Registration::create([
            'registration_code' => 'BDM-2026-001',
            'name' => 'Aditya Pratama',
            'class_major' => 'X RPL 2',
            'whatsapp_number' => '081234567890',
            'gender' => 'L',
            'preferred_category' => 'Tunggal Putra',
            'experience_level' => 'Menengah',
            'motivation' => 'Ingin mengembangkan bakat bulu tangkis dan mengharumkan nama sekolah di ajang O2SN tingkat provinsi.',
            'status' => 'diterima',
            'coach_notes' => 'Lolos verifikasi berkas awal. Silakan datang ke GOR hari Sabtu pukul 08.00 WIB untuk tes fisik dan penyerahan jersey tim.',
        ]);
        Registration::create([
            'registration_code' => 'BDM-2026-002',
            'name' => 'Zahra Amalia',
            'class_major' => 'X AKL 1',
            'whatsapp_number' => '081298765432',
            'gender' => 'P',
            'preferred_category' => 'Ganda Putri',
            'experience_level' => 'Pemula',
            'motivation' => 'Ingin menambah relasi pertemanan, menjaga kebugaran jasmani, dan belajar teknik dasar servis & smash yang benar.',
            'status' => 'menunggu',
            'coach_notes' => 'Data formulir sudah diterima. Menunggu jadwal seleksi gelombang 1 pada Sabtu mendatang.',
        ]);
    }
}
