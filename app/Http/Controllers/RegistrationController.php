<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegistrationController extends Controller
{
    /**
     * Store new student registration.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'class_major' => 'required|string|max:50',
            'whatsapp_number' => 'required|string|min:8|max:20',
            'gender' => 'nullable|string|in:L,P',
            'preferred_category' => 'nullable|string',
            'experience_level' => 'nullable|string',
            'motivation' => 'required|string|min:5|max:1000',
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'class_major.required' => 'Kelas / jurusan wajib diisi.',
            'whatsapp_number.required' => 'Nomor WhatsApp wajib diisi.',
            'motivation.required' => 'Alasan mengikuti ekskul wajib diisi.',
        ]);

        if ($validator->fails()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors(),
                ], 422);
            }

            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Clean WhatsApp number
        $cleanPhone = preg_replace('/[^0-9]/', '', $request->whatsapp_number);

        // Check if phone already registered in this year
        $existing = Registration::where('whatsapp_number', $cleanPhone)
            ->whereYear('created_at', date('Y'))
            ->first();

        if ($existing) {
            $msg = 'Nomor WhatsApp ini sudah terdaftar dengan kode '.$existing->registration_code.'.';
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => $msg,
                    'data' => $existing,
                    'already_exists' => true,
                ], 200);
            }

            return redirect()->back()->with('warning', $msg);
        }

        $code = Registration::generateCode();

        $registration = Registration::create([
            'registration_code' => $code,
            'name' => $request->name,
            'class_major' => $request->class_major,
            'whatsapp_number' => $cleanPhone,
            'gender' => $request->gender ?? 'L',
            'preferred_category' => $request->preferred_category ?? 'Tunggal Putra',
            'experience_level' => $request->experience_level ?? 'Pemula',
            'motivation' => $request->motivation,
            'status' => 'menunggu',
            'coach_notes' => 'Pendaftaran online berhasil diterima. Menunggu jadwal pemanggilan seleksi fisik & wawancara.',
        ]);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Selamat! Formulir pendaftaran berhasil dikirimkan.',
                'data' => $registration,
            ]);
        }

        return redirect()->route('home')->with('success', 'Pendaftaran berhasil dikirim! Kode Anda: '.$code);
    }

    /**
     * Check registration status.
     */
    public function checkStatus(Request $request)
    {
        $query = trim($request->input('q', ''));
        $result = null;
        $searched = false;

        if (! empty($query)) {
            $searched = true;
            $cleanQuery = preg_replace('/[^0-9]/', '', $query);

            $result = Registration::where('registration_code', strtoupper($query))
                ->orWhere(function ($q) use ($cleanQuery, $query) {
                    if (! empty($cleanQuery)) {
                        $q->where('whatsapp_number', 'LIKE', "%{$cleanQuery}%");
                    }
                    $q->orWhere('name', 'LIKE', "%{$query}%");
                })
                ->first();
        }

        return view('status', compact('query', 'result', 'searched'));
    }
}
