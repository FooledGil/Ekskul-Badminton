<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatchScore extends Model
{
    use HasFactory;

    protected $fillable = [
        'tournament',
        'category',
        'team_a_name',
        'team_b_name',
        'team_a_sets',
        'team_b_sets',
        'score_details',
        'status',
        'is_active_highlight',
    ];
}
