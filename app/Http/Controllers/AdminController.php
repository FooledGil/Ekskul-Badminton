<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard(Request $request)
    {
        $statusFilter = $request->input('status', 'all');

        $query = Registration::orderBy('created_at', 'desc');
        if ($statusFilter !== 'all') {
            $query->where('status', $statusFilter);
        }
        $registrations = $query->paginate(15);

        $counts = [
            'total' => Registration::count(),
            'menunggu' => Registration::where('status', 'menunggu')->count(),
            'diterima' => Registration::where('status', 'diterima')->count(),
            'ditolak' => Registration::where('status', 'ditolak')->count(),
        ];

        return view('admin.dashboard', compact('registrations', 'counts', 'statusFilter'));
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

        return redirect()->back()->with('success', 'Status pendaftaran berhasil diperbarui.');
    }
}
