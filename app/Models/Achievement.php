<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category_name',
        'year',
        'rank',
        'medal_type',
        'image_url',
        'athlete_names',
    ];
}
