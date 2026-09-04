<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use App\Models\Gallery;
use App\Models\MatchScore;
use App\Models\Registration;
use App\Models\Schedule;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard(Request $request)
    {
        $tab = $request->input('tab', 'registrations');
        $statusFilter = $request->input('status', 'all');

        // Data Registrasi
        $regQuery = Registration::orderBy('created_at', 'desc');
        if ($statusFilter !== 'all') {
            $regQuery->where('status', $statusFilter);
        }
        $registrations = $regQuery->paginate(15);

        $counts = [
            'total' => Registration::count(),
            'menunggu' => Registration::where('status', 'menunggu')->count(),
            'diterima' => Registration::where('status', 'diterima')->count(),
            'ditolak' => Registration::where('status', 'ditolak')->count(),
        ];

        // Data Modul Lainnya
        $schedules = Schedule::orderBy('order')->get();
        $achievements = Achievement::orderBy('year', 'desc')->get();
        $galleries = Gallery::orderBy('id', 'desc')->get();
        $matchScores = MatchScore::orderBy('id', 'desc')->get();
        $settings = SiteSetting::getAllMapped();

        return view('admin.dashboard', compact(
            'tab',
            'statusFilter',
            'registrations',
            'counts',
            'schedules',
            'achievements',
            'galleries',
            'matchScores',
            'settings'
        ));
    }

    public function updateStatus(Request $request, $id)
    {
        $registration = Registration::findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|in:menunggu,diterima,ditolak',
            'coach_notes' => 'nullable|string|max:500',
        ]);

        $registration->update($validated);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Status pendaftaran berhasil diperbarui!',
                'registration' => $registration,
            ]);
        }

        return redirect()->route('admin.dashboard', ['tab' => 'registrations', 'status' => $request->input('filter', 'all')])
            ->with('success', 'Status pendaftaran berhasil diperbarui.');
    }

    /**
     * Update Pengaturan Beranda & Tentang Kami (termasuk foto pelatih & hero).
     */
    public function updateSettings(Request $request)
    {
        $request->validate([
            'coach_name' => 'required|string|max:255',
            'coach_title' => 'required|string|max:255',
            'coach_bio' => 'nullable|string|max:1000',
            'coach_certification' => 'nullable|string|max:255',
            'coach_specialization' => 'nullable|string|max:255',
            'coach_image_file' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'coach_image_url' => 'nullable|string|max:1000',

            'about_tagline' => 'nullable|string|max:255',
            'about_title' => 'nullable|string|max:255',
            'about_description' => 'nullable|string|max:1000',

            'hero_title' => 'nullable|string|max:255',
            'hero_subtitle' => 'nullable|string|max:255',
            'hero_badge' => 'nullable|string|max:255',
            'hero_description' => 'nullable|string|max:1000',
            'hero_image_file' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'hero_image_url' => 'nullable|string|max:1000',

            'contact_whatsapp' => 'nullable|string|max:50',
            'contact_instagram' => 'nullable|string|max:255',
            'contact_address' => 'nullable|string|max:500',
            'contact_email' => 'nullable|string|max:255',
        ]);

        // Simpan nilai teks
        $textFields = [
            'coach_name' => 'about',
            'coach_title' => 'about',
            'coach_bio' => 'about',
            'coach_certification' => 'about',
            'coach_specialization' => 'about',
            'about_tagline' => 'about',
            'about_title' => 'about',
            'about_description' => 'about',

            'hero_title' => 'hero',
            'hero_subtitle' => 'hero',
            'hero_badge' => 'hero',
            'hero_description' => 'hero',

            'contact_whatsapp' => 'contact',
            'contact_instagram' => 'contact',
            'contact_address' => 'contact',
            'contact_email' => 'contact',
        ];

        foreach ($textFields as $field => $group) {
            if ($request->has($field)) {
                SiteSetting::set($field, $request->input($field), $group);
            }
        }

        // Upload Foto Pelatih
        if ($request->hasFile('coach_image_file')) {
            $path = $request->file('coach_image_file')->store('uploads/coach', 'public');
            SiteSetting::set('coach_image', '/storage/'.$path, 'about');
        } elseif ($request->filled('coach_image_url')) {
            SiteSetting::set('coach_image', $request->input('coach_image_url'), 'about');
        }

        // Upload Foto Hero
        if ($request->hasFile('hero_image_file')) {
            $path = $request->file('hero_image_file')->store('uploads/hero', 'public');
            SiteSetting::set('hero_image', '/storage/'.$path, 'hero');
        } elseif ($request->filled('hero_image_url')) {
            SiteSetting::set('hero_image', $request->input('hero_image_url'), 'hero');
        }

        return redirect()->route('admin.dashboard', ['tab' => 'settings'])
            ->with('success', 'Pengaturan konten dan foto berhasil diperbarui!');
    }

    /**
     * Manajemen Jadwal Latihan
     */
    public function storeSchedule(Request $request)
    {
        $validated = $request->validate([
            'day' => 'required|string|max:50',
            'time_range' => 'required|string|max:100',
            'location' => 'required|string|max:255',
            'focus' => 'required|string|max:255',
            'is_next' => 'nullable|boolean',
            'order' => 'nullable|integer',
        ]);

        $validated['is_next'] = $request->boolean('is_next');
        $validated['order'] = $validated['order'] ?? (Schedule::max('order') + 1);

        if ($validated['is_next']) {
            Schedule::where('is_next', true)->update(['is_next' => false]);
        }

        Schedule::create($validated);

        return redirect()->route('admin.dashboard', ['tab' => 'schedules'])
            ->with('success', 'Jadwal latihan baru berhasil ditambahkan.');
    }

    public function updateSchedule(Request $request, $id)
    {
        $schedule = Schedule::findOrFail($id);

        $validated = $request->validate([
            'day' => 'required|string|max:50',
            'time_range' => 'required|string|max:100',
            'location' => 'required|string|max:255',
            'focus' => 'required|string|max:255',
            'is_next' => 'nullable|boolean',
            'order' => 'nullable|integer',
        ]);

        $validated['is_next'] = $request->boolean('is_next');

        if ($validated['is_next']) {
            Schedule::where('id', '!=', $id)->update(['is_next' => false]);
        }

        $schedule->update($validated);

        return redirect()->route('admin.dashboard', ['tab' => 'schedules'])
            ->with('success', 'Jadwal latihan berhasil diperbarui.');
    }

    public function destroySchedule($id)
    {
        $schedule = Schedule::findOrFail($id);
        $schedule->delete();

        return redirect()->route('admin.dashboard', ['tab' => 'schedules'])
            ->with('success', 'Jadwal latihan berhasil dihapus.');
    }

    /**
     * Manajemen Prestasi
     */
    public function storeAchievement(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_name' => 'required|string|max:255',
            'year' => 'required|integer|min:2000|max:2099',
            'rank' => 'required|string|max:100',
            'medal_type' => 'required|in:gold,silver,bronze',
            'athlete_names' => 'nullable|string|max:255',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'image_url' => 'nullable|string|max:1000',
        ]);

        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->store('uploads/achievements', 'public');
            $validated['image_url'] = '/storage/'.$path;
        }

        unset($validated['image_file']);
        Achievement::create($validated);

        return redirect()->route('admin.dashboard', ['tab' => 'achievements'])
            ->with('success', 'Data prestasi baru berhasil disimpan.');
    }

    public function updateAchievement(Request $request, $id)
    {
        $achievement = Achievement::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_name' => 'required|string|max:255',
            'year' => 'required|integer|min:2000|max:2099',
            'rank' => 'required|string|max:100',
            'medal_type' => 'required|in:gold,silver,bronze',
            'athlete_names' => 'nullable|string|max:255',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'image_url' => 'nullable|string|max:1000',
        ]);

        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->store('uploads/achievements', 'public');
            $validated['image_url'] = '/storage/'.$path;
        }

        unset($validated['image_file']);
        $achievement->update($validated);

        return redirect()->route('admin.dashboard', ['tab' => 'achievements'])
            ->with('success', 'Data prestasi berhasil diperbarui.');
    }

    public function destroyAchievement($id)
    {
        $achievement = Achievement::findOrFail($id);
        $achievement->delete();

        return redirect()->route('admin.dashboard', ['tab' => 'achievements'])
            ->with('success', 'Data prestasi berhasil dihapus.');
    }

    /**
     * Manajemen Galeri
     */
    public function storeGallery(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|in:tim,latihan,pertandingan',
            'caption' => 'nullable|string|max:500',
            'span_class' => 'nullable|string|max:100',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'image_url' => 'nullable|string|max:1000',
        ]);

        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->store('uploads/gallery', 'public');
            $validated['image_url'] = '/storage/'.$path;
        } elseif (! $request->filled('image_url')) {
            return back()->withErrors(['image_file' => 'Wajib mengunggah gambar atau memasukkan URL gambar.']);
        }

        unset($validated['image_file']);
        $validated['span_class'] = $validated['span_class'] ?? 'col-span-1';

        Gallery::create($validated);

        return redirect()->route('admin.dashboard', ['tab' => 'galleries'])
            ->with('success', 'Foto galeri baru berhasil ditambahkan.');
    }

    public function updateGallery(Request $request, $id)
    {
        $gallery = Gallery::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|in:tim,latihan,pertandingan',
            'caption' => 'nullable|string|max:500',
            'span_class' => 'nullable|string|max:100',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'image_url' => 'nullable|string|max:1000',
        ]);

        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->store('uploads/gallery', 'public');
            $validated['image_url'] = '/storage/'.$path;
        }

        unset($validated['image_file']);
        $gallery->update($validated);

        return redirect()->route('admin.dashboard', ['tab' => 'galleries'])
            ->with('success', 'Data foto galeri berhasil diperbarui.');
    }

    public function destroyGallery($id)
    {
        $gallery = Gallery::findOrFail($id);
        $gallery->delete();

        return redirect()->route('admin.dashboard', ['tab' => 'galleries'])
            ->with('success', 'Foto galeri berhasil dihapus.');
    }

    /**
     * Manajemen Skor Pertandingan
     */
    public function storeScore(Request $request)
    {
        $validated = $request->validate([
            'tournament' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'team_a_name' => 'required|string|max:255',
            'team_b_name' => 'required|string|max:255',
            'team_a_sets' => 'required|integer|min:0|max:5',
            'team_b_sets' => 'required|integer|min:0|max:5',
            'score_details' => 'required|string|max:255',
            'status' => 'required|in:live,selesai,mendatang',
            'is_active_highlight' => 'nullable|boolean',
        ]);

        $validated['is_active_highlight'] = $request->boolean('is_active_highlight');

        if ($validated['is_active_highlight']) {
            MatchScore::where('is_active_highlight', true)->update(['is_active_highlight' => false]);
        }

        MatchScore::create($validated);

        return redirect()->route('admin.dashboard', ['tab' => 'scores'])
            ->with('success', 'Skor pertandingan baru berhasil disimpan.');
    }

    public function updateScore(Request $request, $id)
    {
        $match = MatchScore::findOrFail($id);

        $validated = $request->validate([
            'tournament' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'team_a_name' => 'required|string|max:255',
            'team_b_name' => 'required|string|max:255',
            'team_a_sets' => 'required|integer|min:0|max:5',
            'team_b_sets' => 'required|integer|min:0|max:5',
            'score_details' => 'required|string|max:255',
            'status' => 'required|in:live,selesai,mendatang',
            'is_active_highlight' => 'nullable|boolean',
        ]);

        $validated['is_active_highlight'] = $request->boolean('is_active_highlight');

        if ($validated['is_active_highlight']) {
            MatchScore::where('id', '!=', $id)->update(['is_active_highlight' => false]);
        }

        $match->update($validated);

        return redirect()->route('admin.dashboard', ['tab' => 'scores'])
            ->with('success', 'Data skor pertandingan berhasil diperbarui.');
    }

    public function destroyScore($id)
    {
        $match = MatchScore::findOrFail($id);
        $match->delete();

        return redirect()->route('admin.dashboard', ['tab' => 'scores'])
            ->with('success', 'Data skor pertandingan berhasil dihapus.');
    }
}
