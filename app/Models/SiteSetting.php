<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class SiteSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'value',
        'group',
    ];

    /**
     * Ambil nilai pengaturan berdasarkan key.
     */
    public static function get(string $key, ?string $default = null): ?string
    {
        try {
            $setting = static::where('key', $key)->first();

            return ($setting && $setting->value !== null && $setting->value !== '') ? $setting->value : $default;
        } catch (\Throwable $e) {
            return $default;
        }
    }

    /**
     * Simpan atau perbarui nilai pengaturan.
     */
    public static function set(string $key, ?string $value, string $group = 'general'): self
    {
        return static::updateOrCreate(
            ['key' => $key],
            ['value' => $value, 'group' => $group]
        );
    }

    /**
     * Ambil seluruh pengaturan dalam bentuk array key => value.
     *
     * @return array<string, string|null>
     */
    public static function getAllMapped(): array
    {
        try {
            if (! Schema::hasTable('site_settings')) {
                return [];
            }

            return static::pluck('value', 'key')->toArray();
        } catch (\Throwable $e) {
            return [];
        }
    }

    /**
     * Helper untuk memastikan URL gambar valid baik lokal (storage/images) maupun eksternal (http/https).
     */
    public static function formatImageUrl(?string $url, ?string $fallback = null): ?string
    {
        if (empty($url)) {
            return $fallback;
        }

        if (str_starts_with($url, 'http://') || str_starts_with($url, 'https://')) {
            return $url;
        }

        return asset(ltrim($url, '/'));
    }
}
