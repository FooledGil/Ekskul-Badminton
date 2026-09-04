<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            // Tentang Kami & Profil Pelatih
            [
                'key' => 'coach_image',
                'value' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuC24iZz2TkMujMAjQ-41I008gvmlBQqSGnQYyAFRv-AS5DYmdLg2RdJkV90qeea5KKN3B4oueVO2oNLsjqIHE_cy4OrFZsO42-znzJqFvLpEscYG-06cCqGzPXq-GR_S5yx8StNZpm_K9zCX-SquyYPNpyeFYpXMhaDqbNjhRKRHc9RGxnVQsQsslRO-AFnvQBl6Z9f7d0obzk2Q3KHkpleCXz8juiIKDAEmS1-l4l14cekEfHSflukdQ',
                'group' => 'about',
            ],
            [
                'key' => 'coach_name',
                'value' => 'Bpk. Haryanto',
                'group' => 'about',
            ],
            [
                'key' => 'coach_title',
                'value' => 'Head Coach / Pelatih Utama',
                'group' => 'about',
            ],
            [
                'key' => 'coach_bio',
                'value' => 'Mantan atlet bulu tangkis daerah dengan pengalaman membina lebih dari 10 tahun. Berdedikasi mencetak bibit unggul berprestasi dari SMKN 2 Purwakarta.',
                'group' => 'about',
            ],
            [
                'key' => 'coach_certification',
                'value' => 'Lisensi B PBSI',
                'group' => 'about',
            ],
            [
                'key' => 'coach_specialization',
                'value' => 'Tactical & Agility',
                'group' => 'about',
            ],
            [
                'key' => 'about_tagline',
                'value' => 'Profil & Visi Klub',
                'group' => 'about',
            ],
            [
                'key' => 'about_title',
                'value' => 'Mencetak Juara Melalui Disiplin',
                'group' => 'about',
            ],
            [
                'key' => 'about_description',
                'value' => 'Ekstrakurikuler Bulu Tangkis SMKN 2 Purwakarta tidak hanya melatih kekuatan fisik dan pukulan, tetapi juga membentuk mentalitas pantang menyerah serta sportivitas sejati.',
                'group' => 'about',
            ],

            // Hero Section
            [
                'key' => 'hero_badge',
                'value' => 'Pendaftaran Anggota Baru 2026/2027',
                'group' => 'hero',
            ],
            [
                'key' => 'hero_title',
                'value' => 'Ekskul Bulu Tangkis',
                'group' => 'hero',
            ],
            [
                'key' => 'hero_subtitle',
                'value' => 'SMKN 2 Purwakarta',
                'group' => 'hero',
            ],
            [
                'key' => 'hero_description',
                'value' => 'Asah Skill. Bangun Mental Juara. Bawa Nama Sekolah. Bergabunglah bersama skuad atlet kebanggaan kami untuk mencetak prestasi gemilang di kancah regional maupun nasional.',
                'group' => 'hero',
            ],
            [
                'key' => 'hero_image',
                'value' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBn99J-Gp4uw77a681QyJYVVjBXeuKMU6SLsr4lO9r-BdJgtLMvnvFFG2SJ_UFodDNOJoqLMHNWFhn2SJDRia28YKPQVKK9HOcm2hnRCpvKC-ynYNGlaE5yPwDlOIn8lnUoKZw2qsVhyXLjkJdHNCsJOoII04kZEXoCx080y4hTgbiaQB3RZAW13h1dXo6VXmZkaW_1rccOqZ4MkUe1FZii6lVfk_qqf0tpseOTT26lF8WsLFg_5GxCQA',
                'group' => 'hero',
            ],
            [
                'key' => 'hero_tag_title',
                'value' => 'Pusat Pembinaan Atlet',
                'group' => 'hero',
            ],
            [
                'key' => 'hero_tag_desc',
                'value' => 'Regenerasi Atlet O2SN & PBSI Purwakarta',
                'group' => 'hero',
            ],

            // Kontak & Lokasi
            [
                'key' => 'contact_whatsapp',
                'value' => '085711223344',
                'group' => 'contact',
            ],
            [
                'key' => 'contact_instagram',
                'value' => 'https://instagram.com',
                'group' => 'contact',
            ],
            [
                'key' => 'contact_address',
                'value' => 'Ruang Ekskul SMKN 2 Purwakarta, Jl. Jend. Sudirman No. 123, Purwakarta, Jawa Barat',
                'group' => 'contact',
            ],
            [
                'key' => 'contact_email',
                'value' => 'ekskulbadminton@smkn2purwakarta.sch.id',
                'group' => 'contact',
            ],
        ];

        foreach ($settings as $setting) {
            SiteSetting::updateOrCreate(
                ['key' => $setting['key']],
                ['value' => $setting['value'], 'group' => $setting['group']]
            );
        }
    }
}
