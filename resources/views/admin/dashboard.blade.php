@extends('layouts.app')

@section('title', 'Admin Dashboard - Pengurus Ekskul Bulu Tangkis SMKN 2')

@section('content')
<div class="pt-28 pb-20 min-h-screen bg-surface dark:bg-surface-dim transition-colors duration-300">
    <div class="max-w-7xl mx-auto px-6">
        <!-- Top Title Bar -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
            <div>
                <div class="inline-flex items-center gap-2 text-primary dark:text-primary-fixed-dim text-xs font-headline font-bold uppercase tracking-wider mb-1">
                    <span class="material-symbols-outlined text-sm">shield_person</span>
                    <span>Admin Control Room</span>
                </div>
                <h1 class="font-headline text-2xl sm:text-3xl font-black text-on-surface dark:text-surface-bright">
                    Manajemen Pendaftar Atlet Ekskul
                </h1>
            </div>

            <div class="flex items-center gap-2">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-1.5 text-xs font-headline font-bold bg-surface-container dark:bg-surface-container-high px-4 py-2 rounded-xl text-on-surface hover:bg-surface-container-highest transition-colors">
                    <span class="material-symbols-outlined text-sm">visibility</span>
                    <span>Lihat Portal Publik</span>
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/30 text-emerald-800 dark:text-emerald-300 text-sm flex items-center gap-3">
                <span class="material-symbols-outlined">check_circle</span>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <!-- Summary KPI Cards -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-8">
            <div class="bg-surface-container-lowest dark:bg-surface-container p-5 rounded-2xl border border-outline-variant/40 shadow-xs">
                <span class="text-xs text-on-surface-variant font-medium block">Total Pendaftar</span>
                <div class="font-headline text-3xl font-black text-on-surface dark:text-surface-bright mt-1">
                    {{ $counts['total'] }}
                </div>
            </div>
            <div class="bg-surface-container-lowest dark:bg-surface-container p-5 rounded-2xl border border-amber-500/30 shadow-xs">
                <span class="text-xs text-amber-600 dark:text-amber-400 font-medium block">Menunggu Seleksi</span>
                <div class="font-headline text-3xl font-black text-amber-600 dark:text-amber-400 mt-1">
                    {{ $counts['menunggu'] }}
                </div>
            </div>
            <div class="bg-surface-container-lowest dark:bg-surface-container p-5 rounded-2xl border border-emerald-500/30 shadow-xs">
                <span class="text-xs text-emerald-600 dark:text-emerald-400 font-medium block">Diterima / Lolos</span>
                <div class="font-headline text-3xl font-black text-emerald-600 dark:text-emerald-400 mt-1">
                    {{ $counts['diterima'] }}
                </div>
            </div>
            <div class="bg-surface-container-lowest dark:bg-surface-container p-5 rounded-2xl border border-red-500/30 shadow-xs">
                <span class="text-xs text-red-600 dark:text-red-400 font-medium block">Belum Lolos</span>
                <div class="font-headline text-3xl font-black text-red-600 dark:text-red-400 mt-1">
                    {{ $counts['ditolak'] }}
                </div>
            </div>
        </div>

        <!-- Filter Tabs -->
        <div class="flex items-center gap-2 border-b border-outline-variant/30 pb-4 mb-6 overflow-x-auto">
            <a href="{{ route('admin.dashboard', ['status' => 'all']) }}" class="px-4 py-2 rounded-xl text-xs font-headline font-bold transition-colors whitespace-nowrap {{ $statusFilter == 'all' ? 'bg-primary text-on-primary' : 'bg-surface-container text-on-surface-variant hover:text-on-surface' }}">
                Semua ({{ $counts['total'] }})
            </a>
            <a href="{{ route('admin.dashboard', ['status' => 'menunggu']) }}" class="px-4 py-2 rounded-xl text-xs font-headline font-bold transition-colors whitespace-nowrap {{ $statusFilter == 'menunggu' ? 'bg-amber-500 text-white' : 'bg-surface-container text-on-surface-variant hover:text-on-surface' }}">
                Menunggu ({{ $counts['menunggu'] }})
            </a>
            <a href="{{ route('admin.dashboard', ['status' => 'diterima']) }}" class="px-4 py-2 rounded-xl text-xs font-headline font-bold transition-colors whitespace-nowrap {{ $statusFilter == 'diterima' ? 'bg-emerald-600 text-white' : 'bg-surface-container text-on-surface-variant hover:text-on-surface' }}">
                Diterima ({{ $counts['diterima'] }})
            </a>
            <a href="{{ route('admin.dashboard', ['status' => 'ditolak']) }}" class="px-4 py-2 rounded-xl text-xs font-headline font-bold transition-colors whitespace-nowrap {{ $statusFilter == 'ditolak' ? 'bg-red-600 text-white' : 'bg-surface-container text-on-surface-variant hover:text-on-surface' }}">
                Ditolak ({{ $counts['ditolak'] }})
            </a>
        </div>

        <!-- Candidate Cards / Table -->
        <div class="space-y-4">
            @forelse($registrations as $reg)
                <div class="bg-surface-container-lowest dark:bg-surface-container p-6 rounded-2xl border border-outline-variant/40 shadow-xs flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6">
                    <!-- Student Info -->
                    <div class="space-y-2 flex-1">
                        <div class="flex flex-wrap items-center gap-2">
                            <span class="font-mono text-xs font-bold px-2 py-0.5 rounded bg-surface-container dark:bg-surface-dim text-on-surface">
                                {{ $reg->registration_code }}
                            </span>
                            <span class="text-xs px-2.5 py-0.5 rounded-full font-bold
                                {{ $reg->status == 'diterima' ? 'bg-emerald-100 text-emerald-800 dark:bg-emerald-950 dark:text-emerald-300' : ($reg->status == 'ditolak' ? 'bg-red-100 text-red-800 dark:bg-red-950 dark:text-red-300' : 'bg-amber-100 text-amber-800 dark:bg-amber-950 dark:text-amber-300') }}">
                                {{ strtoupper($reg->status) }}
                            </span>
                            <span class="text-xs text-on-surface-variant">
                                {{ $reg->created_at->format('d M Y, H:i') }}
                            </span>
                        </div>

                        <div>
                            <h3 class="font-headline text-lg font-bold text-on-surface dark:text-surface-bright">
                                {{ $reg->name }}
                                <span class="text-xs font-normal text-on-surface-variant ml-1">({{ $reg->gender == 'L' ? 'Laki-laki' : 'Perempuan' }})</span>
                            </h3>
                            <p class="text-xs text-on-surface-variant">
                                Kelas: <strong>{{ $reg->class_major }}</strong> • Kategori: <strong>{{ $reg->preferred_category }}</strong> • Level: <strong>{{ $reg->experience_level }}</strong>
                            </p>
                        </div>

                        <div class="bg-surface dark:bg-surface-dim p-3 rounded-xl text-xs text-on-surface dark:text-surface-bright border border-outline-variant/30 max-w-2xl">
                            <strong>Motivasi:</strong> {{ $reg->motivation }}
                        </div>

                        @if($reg->coach_notes)
                            <p class="text-xs text-primary dark:text-primary-fixed-dim">
                                <strong>Catatan Pelatih:</strong> {{ $reg->coach_notes }}
                            </p>
                        @endif
                    </div>

                    <!-- Actions Form -->
                    <div class="w-full lg:w-80 shrink-0 bg-surface-container-low dark:bg-surface-dim p-4 rounded-xl border border-outline-variant/30">
                        <form action="{{ route('admin.registration.status', $reg->id) }}" method="POST" class="space-y-3">
                            @csrf
                            <div>
                                <label class="block text-[11px] font-bold text-on-surface-variant uppercase tracking-wider mb-1">
                                    Ubah Status Seleksi
                                </label>
                                <select name="status" class="w-full text-xs bg-surface-container-lowest dark:bg-surface-container border border-outline-variant/60 rounded-lg p-2 text-on-surface outline-none cursor-pointer">
                                    <option value="menunggu" {{ $reg->status == 'menunggu' ? 'selected' : '' }}>Menunggu Seleksi</option>
                                    <option value="diterima" {{ $reg->status == 'diterima' ? 'selected' : '' }}>Diterima / Lolos</option>
                                    <option value="ditolak" {{ $reg->status == 'ditolak' ? 'selected' : '' }}>Belum Lolos</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-[11px] font-bold text-on-surface-variant uppercase tracking-wider mb-1">
                                    Catatan / Instruksi Tes
                                </label>
                                <input type="text" name="coach_notes" value="{{ $reg->coach_notes }}" placeholder="Contoh: Datang hari Sabtu pkl 08.00" class="w-full text-xs bg-surface-container-lowest dark:bg-surface-container border border-outline-variant/60 rounded-lg p-2 text-on-surface outline-none">
                            </div>

                            <div class="flex items-center gap-2 pt-1">
                                <button type="submit" class="w-full bg-primary hover:bg-primary-container text-on-primary py-2 rounded-lg text-xs font-headline font-bold transition-colors shadow-xs cursor-pointer">
                                    Simpan Perubahan
                                </button>
                                <a href="https://wa.me/{{ $reg->whatsapp_number }}" target="_blank" rel="noopener noreferrer" class="bg-emerald-600 hover:bg-emerald-700 text-white p-2 rounded-lg flex items-center justify-center shrink-0" title="Kirim Pesan WhatsApp">
                                    <span class="material-symbols-outlined text-base">chat</span>
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            @empty
                <div class="bg-surface-container-lowest dark:bg-surface-container rounded-2xl p-12 text-center text-on-surface-variant">
                    <span class="material-symbols-outlined text-4xl text-outline mb-2">inbox</span>
                    <p class="font-headline font-bold">Belum ada data pendaftar pada kategori ini.</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $registrations->withQueryString()->links() }}
        </div>
    </div>
</div>
@endsection
