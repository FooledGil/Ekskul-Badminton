<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use App\Models\Gallery;
use App\Models\MatchScore;
use App\Models\Registration;
use App\Models\Schedule;

class HomeController extends Controller
{
    public function index()
    {
        $schedules = Schedule::orderBy('order')->get();
        $achievements = Achievement::orderBy('year', 'desc')->get();
        $galleries = Gallery::all();
        $matchScores = MatchScore::orderBy('id', 'desc')->get();
        $highlightMatch = MatchScore::where('is_active_highlight', true)->first() ?? $matchScores->first();

        $stats = [
            'active_members' => 24 + Registration::where('status', 'diterima')->count(),
            'total_achievements' => $achievements->count() + 8,
            'sessions_per_week' => $schedules->count(),
            'championship_win_rate' => 88,
        ];

        return view('home', compact(
            'schedules',
            'achievements',
            'galleries',
            'matchScores',
            'highlightMatch',
            'stats'
        ));
    }
}
