<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    protected $fillable = [
        'registration_code',
        'name',
        'class_major',
        'whatsapp_number',
        'gender',
        'preferred_category',
        'experience_level',
        'motivation',
        'status',
        'coach_notes',
    ];

    public static function generateCode(): string
    {
        $prefix = 'BDM-'.date('Y');
        $count = static::whereYear('created_at', date('Y'))->count() + 1;

        return sprintf('%s-%03d', $prefix, $count);
    }
}
