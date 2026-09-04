@extends('layouts.app')

@section('title', 'Admin Control Center - Ekskul Bulu Tangkis SMKN 2 Purwakarta')

@section('content')
<div class="pt-24 sm:pt-28 pb-20 min-h-screen bg-surface dark:bg-surface-dim transition-colors duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        
        <!-- Header & Title Bar -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8 bg-surface-container-lowest dark:bg-surface-container p-6 rounded-3xl border border-outline-variant/40 shadow-xs">
            <div>
                <div class="inline-flex items-center gap-2 text-primary dark:text-primary-fixed-dim text-xs font-headline font-bold uppercase tracking-wider mb-1.5">
                    <span class="material-symbols-outlined text-base">admin_panel_settings</span>
                    <span>Admin Control Center</span>
                </div>
                <h1 class="font-headline text-2xl sm:text-3xl font-black text-on-surface dark:text-surface-bright tracking-tight">
                    Manajemen Pendaftar Atlet Ekskul & Konten
                </h1>
                <p class="text-xs sm:text-sm text-on-surface-variant mt-1">
                    Kelola foto pelatih, hero banner, jadwal latihan, prestasi, galeri foto, papan skor, dan verifikasi pendaftar.
                </p>
            </div>

            <div class="flex items-center gap-3">
                <a href="{{ route('home') }}" target="_blank" class="inline-flex items-center gap-2 text-xs font-headline font-bold bg-primary/10 hover:bg-primary/20 text-primary dark:text-primary-fixed px-4 py-2.5 rounded-xl transition-all border border-primary/20 shadow-xs">
                    <span class="material-symbols-outlined text-base">open_in_new</span>
                    <span>Buka Portal Utama</span>
                </a>
            </div>
        </div>

        <!-- Success Alert -->
        @if(session('success'))
            <div class="mb-6 p-4 rounded-2xl bg-emerald-500/10 border border-emerald-500/30 text-emerald-800 dark:text-emerald-300 text-sm flex items-center justify-between gap-3 shadow-xs">
                <div class="flex items-center gap-3">
                    <span class="material-symbols-outlined text-xl text-emerald-600 dark:text-emerald-400">check_circle</span>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
                <button type="button" onclick="this.parentElement.remove()" class="text-emerald-600 dark:text-emerald-400 hover:opacity-75">
                    <span class="material-symbols-outlined text-base">close</span>
                </button>
            </div>
        @endif

        @if($errors->any())
            <div class="mb-6 p-4 rounded-2xl bg-red-500/10 border border-red-500/30 text-red-800 dark:text-red-300 text-sm shadow-xs">
                <div class="flex items-center gap-2 font-bold mb-1">
                    <span class="material-symbols-outlined text-base">error</span>
                    <span>Terdapat kesalahan input:</span>
                </div>
                <ul class="list-disc list-inside text-xs space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Main Navigation Tabs -->
        <div class="flex items-center gap-2 border-b border-outline-variant/40 pb-3 mb-8 overflow-x-auto scrollbar-none">
            <a href="{{ route('admin.dashboard', ['tab' => 'registrations']) }}" 
               class="px-4 py-2.5 rounded-xl text-xs font-headline font-bold transition-all flex items-center gap-2 whitespace-nowrap {{ $tab == 'registrations' ? 'bg-primary text-on-primary shadow-sm' : 'bg-surface-container hover:bg-surface-container-high text-on-surface-variant' }}">
                <span class="material-symbols-outlined text-base">group</span>
                <span>Pendaftar Atlet ({{ $counts['total'] }})</span>
            </a>

            <a href="{{ route('admin.dashboard', ['tab' => 'settings']) }}" 
               class="px-4 py-2.5 rounded-xl text-xs font-headline font-bold transition-all flex items-center gap-2 whitespace-nowrap {{ $tab == 'settings' ? 'bg-primary text-on-primary shadow-sm' : 'bg-surface-container hover:bg-surface-container-high text-on-surface-variant' }}">
                <span class="material-symbols-outlined text-base">manage_accounts</span>
                <span>Foto & Info Pelatih (Tentang Kami)</span>
            </a>

            <a href="{{ route('admin.dashboard', ['tab' => 'schedules']) }}" 
               class="px-4 py-2.5 rounded-xl text-xs font-headline font-bold transition-all flex items-center gap-2 whitespace-nowrap {{ $tab == 'schedules' ? 'bg-primary text-on-primary shadow-sm' : 'bg-surface-container hover:bg-surface-container-high text-on-surface-variant' }}">
                <span class="material-symbols-outlined text-base">calendar_month</span>
                <span>Jadwal Latihan ({{ $schedules->count() }})</span>
            </a>

            <a href="{{ route('admin.dashboard', ['tab' => 'achievements']) }}" 
               class="px-4 py-2.5 rounded-xl text-xs font-headline font-bold transition-all flex items-center gap-2 whitespace-nowrap {{ $tab == 'achievements' ? 'bg-primary text-on-primary shadow-sm' : 'bg-surface-container hover:bg-surface-container-high text-on-surface-variant' }}">
                <span class="material-symbols-outlined text-base">military_tech</span>
                <span>Prestasi & Medali ({{ $achievements->count() }})</span>
            </a>

            <a href="{{ route('admin.dashboard', ['tab' => 'galleries']) }}" 
               class="px-4 py-2.5 rounded-xl text-xs font-headline font-bold transition-all flex items-center gap-2 whitespace-nowrap {{ $tab == 'galleries' ? 'bg-primary text-on-primary shadow-sm' : 'bg-surface-container hover:bg-surface-container-high text-on-surface-variant' }}">
                <span class="material-symbols-outlined text-base">photo_library</span>
                <span>Galeri Foto ({{ $galleries->count() }})</span>
            </a>

            <a href="{{ route('admin.dashboard', ['tab' => 'scores']) }}" 
               class="px-4 py-2.5 rounded-xl text-xs font-headline font-bold transition-all flex items-center gap-2 whitespace-nowrap {{ $tab == 'scores' ? 'bg-primary text-on-primary shadow-sm' : 'bg-surface-container hover:bg-surface-container-high text-on-surface-variant' }}">
                <span class="material-symbols-outlined text-base">sports_score</span>
                <span>Papan Skor ({{ $matchScores->count() }})</span>
            </a>
        </div>

        {{-- ========================================================================= --}}
        {{-- TAB 1: PENDAFTAR ATLET --}}
        {{-- ========================================================================= --}}
        @if($tab == 'registrations')
            <!-- KPI Summary Cards -->
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

            <!-- Status Filter Sub-tabs -->
            <div class="flex items-center gap-2 border-b border-outline-variant/30 pb-4 mb-6 overflow-x-auto">
                <a href="{{ route('admin.dashboard', ['tab' => 'registrations', 'status' => 'all']) }}" class="px-4 py-2 rounded-xl text-xs font-headline font-bold transition-colors whitespace-nowrap {{ $statusFilter == 'all' ? 'bg-primary text-on-primary' : 'bg-surface-container text-on-surface-variant hover:text-on-surface' }}">
                    Semua ({{ $counts['total'] }})
                </a>
                <a href="{{ route('admin.dashboard', ['tab' => 'registrations', 'status' => 'menunggu']) }}" class="px-4 py-2 rounded-xl text-xs font-headline font-bold transition-colors whitespace-nowrap {{ $statusFilter == 'menunggu' ? 'bg-amber-500 text-white' : 'bg-surface-container text-on-surface-variant hover:text-on-surface' }}">
                    Menunggu ({{ $counts['menunggu'] }})
                </a>
                <a href="{{ route('admin.dashboard', ['tab' => 'registrations', 'status' => 'diterima']) }}" class="px-4 py-2 rounded-xl text-xs font-headline font-bold transition-colors whitespace-nowrap {{ $statusFilter == 'diterima' ? 'bg-emerald-600 text-white' : 'bg-surface-container text-on-surface-variant hover:text-on-surface' }}">
                    Diterima ({{ $counts['diterima'] }})
                </a>
                <a href="{{ route('admin.dashboard', ['tab' => 'registrations', 'status' => 'ditolak']) }}" class="px-4 py-2 rounded-xl text-xs font-headline font-bold transition-colors whitespace-nowrap {{ $statusFilter == 'ditolak' ? 'bg-red-600 text-white' : 'bg-surface-container text-on-surface-variant hover:text-on-surface' }}">
                    Ditolak ({{ $counts['ditolak'] }})
                </a>
            </div>

            <!-- Candidate Cards List -->
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
                                <input type="hidden" name="filter" value="{{ $statusFilter }}">
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
                                    <input type="text" name="coach_notes" value="{{ $reg->coach_notes }}" placeholder="Contoh: Hadir hari Sabtu pukul 08.00" class="w-full text-xs bg-surface-container-lowest dark:bg-surface-container border border-outline-variant/60 rounded-lg p-2 text-on-surface outline-none">
                                </div>

                                <div class="flex items-center gap-2 pt-1">
                                    <button type="submit" class="w-full bg-primary hover:bg-primary-container text-on-primary py-2 rounded-lg text-xs font-headline font-bold transition-colors shadow-xs cursor-pointer">
                                        Simpan Status
                                    </button>
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $reg->whatsapp_number) }}" target="_blank" rel="noopener noreferrer" class="bg-emerald-600 hover:bg-emerald-700 text-white p-2 rounded-lg flex items-center justify-center shrink-0" title="Kirim Pesan WhatsApp">
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
        @endif

        {{-- ========================================================================= --}}
        {{-- TAB 2: PENGATURAN KONTEN & FOTO (PELATIH / TENTANG KAMI, HERO, KONTAK) --}}
        {{-- ========================================================================= --}}
        @if($tab == 'settings')
            <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf

                <!-- Section 1: Profil & Foto Pelatih ("Tentang Kami") -->
                <div class="bg-surface-container-lowest dark:bg-surface-container p-6 sm:p-8 rounded-3xl border border-outline-variant/40 shadow-xs">
                    <div class="flex items-center gap-3 border-b border-outline-variant/30 pb-4 mb-6">
                        <span class="w-10 h-10 rounded-xl bg-primary/10 text-primary flex items-center justify-center">
                            <span class="material-symbols-outlined text-2xl">sports</span>
                        </span>
                        <div>
                            <h2 class="font-headline text-lg sm:text-xl font-bold text-on-surface dark:text-surface-bright">
                                Foto & Profil Pelatih (Bagian "Tentang Kami")
                            </h2>
                            <p class="text-xs text-on-surface-variant">
                                Konfigurasikan foto avatar pelatih utama, biodata, lisensi, dan judul seksi Tentang Kami.
                            </p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                        <!-- Coach Image Preview & Upload -->
                        <div class="lg:col-span-4 flex flex-col items-center p-6 bg-surface dark:bg-surface-dim rounded-2xl border border-outline-variant/40 text-center">
                            <div class="w-32 h-32 rounded-full overflow-hidden border-4 border-primary shadow-lg mb-4 bg-surface-container relative group">
                                <img id="coach-preview" 
                                     src="{{ \App\Models\SiteSetting::formatImageUrl($settings['coach_image'] ?? null, 'https://lh3.googleusercontent.com/aida-public/AB6AXuC24iZz2TkMujMAjQ-41I008gvmlBQqSGnQYyAFRv-AS5DYmdLg2RdJkV90qeea5KKN3B4oueVO2oNLsjqIHE_cy4OrFZsO42-znzJqFvLpEscYG-06cCqGzPXq-GR_S5yx8StNZpm_K9zCX-SquyYPNpyeFYpXMhaDqbNjhRKRHc9RGxnVQsQsslRO-AFnvQBl6Z9f7d0obzk2Q3KHkpleCXz8juiIKDAEmS1-l4l14cekEfHSflukdQ') }}" 
                                     alt="Foto Pelatih" 
                                     class="w-full h-full object-cover">
                            </div>
                            <span class="text-xs font-bold text-on-surface">Foto Pelatih Saat Ini</span>
                            <span class="text-[11px] text-on-surface-variant mb-4">Format: JPG, PNG, WEBP (Maks 5MB)</span>

                            <div class="w-full space-y-3 text-left">
                                <div>
                                    <label class="block text-xs font-bold text-on-surface-variant mb-1">Unggah Berkas Gambar Baru:</label>
                                    <input type="file" name="coach_image_file" accept="image/*" 
                                           onchange="previewImage(this, 'coach-preview')"
                                           class="w-full text-xs text-on-surface file:mr-2 file:py-2 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-primary file:text-on-primary hover:file:opacity-90 cursor-pointer">
                                </div>
                                <div class="pt-2 border-t border-outline-variant/30">
                                    <label class="block text-xs font-bold text-on-surface-variant mb-1">Atau Gunakan URL Gambar Eksternal:</label>
                                    <input type="url" name="coach_image_url" value="{{ str_starts_with($settings['coach_image'] ?? '', 'http') ? $settings['coach_image'] : '' }}" placeholder="https://..." class="w-full text-xs p-2.5 rounded-lg border border-outline-variant bg-surface-container-lowest dark:bg-surface-container text-on-surface outline-none">
                                </div>
                            </div>
                        </div>

                        <!-- Coach Details Fields -->
                        <div class="lg:col-span-8 space-y-4">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-bold text-on-surface mb-1">Nama Lengkap Pelatih <span class="text-red-500">*</span></label>
                                    <input type="text" name="coach_name" value="{{ $settings['coach_name'] ?? 'Bpk. Haryanto' }}" required class="w-full text-xs p-3 rounded-xl border border-outline-variant bg-surface-container-lowest dark:bg-surface-container text-on-surface outline-none focus:border-primary">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-on-surface mb-1">Jabatan / Gelar <span class="text-red-500">*</span></label>
                                    <input type="text" name="coach_title" value="{{ $settings['coach_title'] ?? 'Head Coach / Pelatih Utama' }}" required class="w-full text-xs p-3 rounded-xl border border-outline-variant bg-surface-container-lowest dark:bg-surface-container text-on-surface outline-none focus:border-primary">
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-bold text-on-surface mb-1">Sertifikasi Pelatih</label>
                                    <input type="text" name="coach_certification" value="{{ $settings['coach_certification'] ?? 'Lisensi B PBSI' }}" class="w-full text-xs p-3 rounded-xl border border-outline-variant bg-surface-container-lowest dark:bg-surface-container text-on-surface outline-none focus:border-primary">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-on-surface mb-1">Spesialisasi Latihan</label>
                                    <input type="text" name="coach_specialization" value="{{ $settings['coach_specialization'] ?? 'Tactical & Agility' }}" class="w-full text-xs p-3 rounded-xl border border-outline-variant bg-surface-container-lowest dark:bg-surface-container text-on-surface outline-none focus:border-primary">
                                </div>
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-on-surface mb-1">Biografi Singkat Pelatih</label>
                                <textarea name="coach_bio" rows="3" class="w-full text-xs p-3 rounded-xl border border-outline-variant bg-surface-container-lowest dark:bg-surface-container text-on-surface outline-none focus:border-primary">{{ $settings['coach_bio'] ?? '' }}</textarea>
                            </div>

                            <div class="pt-4 border-t border-outline-variant/30 grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-bold text-on-surface mb-1">Tagline Seksi Tentang Kami</label>
                                    <input type="text" name="about_tagline" value="{{ $settings['about_tagline'] ?? 'Profil & Visi Klub' }}" class="w-full text-xs p-3 rounded-xl border border-outline-variant bg-surface-container-lowest dark:bg-surface-container text-on-surface outline-none focus:border-primary">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-on-surface mb-1">Judul Seksi Tentang Kami</label>
                                    <input type="text" name="about_title" value="{{ $settings['about_title'] ?? 'Mencetak Juara Melalui Disiplin' }}" class="w-full text-xs p-3 rounded-xl border border-outline-variant bg-surface-container-lowest dark:bg-surface-container text-on-surface outline-none focus:border-primary">
                                </div>
                                <div class="sm:col-span-2">
                                    <label class="block text-xs font-bold text-on-surface mb-1">Deskripsi Seksi Tentang Kami</label>
                                    <textarea name="about_description" rows="2" class="w-full text-xs p-3 rounded-xl border border-outline-variant bg-surface-container-lowest dark:bg-surface-container text-on-surface outline-none focus:border-primary">{{ $settings['about_description'] ?? '' }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section 2: Hero Banner & Gambar Atlet Smash -->
                <div class="bg-surface-container-lowest dark:bg-surface-container p-6 sm:p-8 rounded-3xl border border-outline-variant/40 shadow-xs">
                    <div class="flex items-center gap-3 border-b border-outline-variant/30 pb-4 mb-6">
                        <span class="w-10 h-10 rounded-xl bg-secondary-container/30 text-secondary dark:text-secondary-fixed flex items-center justify-center">
                            <span class="material-symbols-outlined text-2xl">sports_tennis</span>
                        </span>
                        <div>
                            <h2 class="font-headline text-lg sm:text-xl font-bold text-on-surface dark:text-surface-bright">
                                Foto Banner & Teks Utama (Hero Section)
                            </h2>
                            <p class="text-xs text-on-surface-variant">
                                Kelola foto aksi atlet smash di samping kanan beranda dan teks sambutan utama.
                            </p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                        <!-- Hero Image Preview & Upload -->
                        <div class="lg:col-span-4 flex flex-col items-center p-6 bg-surface dark:bg-surface-dim rounded-2xl border border-outline-variant/40 text-center">
                            <div class="w-full h-48 rounded-2xl overflow-hidden border-2 border-outline-variant shadow-md mb-4 bg-surface-container relative">
                                <img id="hero-preview" 
                                     src="{{ \App\Models\SiteSetting::formatImageUrl($settings['hero_image'] ?? null, 'https://lh3.googleusercontent.com/aida-public/AB6AXuBn99J-Gp4uw77a681QyJYVVjBXeuKMU6SLsr4lO9r-BdJgtLMvnvFFG2SJ_UFodDNOJoqLMHNWFhn2SJDRia28YKPQVKK9HOcm2hnRCpvKC-ynYNGlaE5yPwDlOIn8lnUoKZw2qsVhyXLjkJdHNCsJOoII04kZEXoCx080y4hTgbiaQB3RZAW13h1dXo6VXmZkaW_1rccOqZ4MkUe1FZii6lVfk_qqf0tpseOTT26lF8WsLFg_5GxCQA') }}" 
                                     alt="Hero Smash Preview" 
                                     class="w-full h-full object-cover">
                            </div>
                            <span class="text-xs font-bold text-on-surface">Foto Aksi Hero Saat Ini</span>
                            <span class="text-[11px] text-on-surface-variant mb-4">Format: JPG, PNG, WEBP (Maks 5MB)</span>

                            <div class="w-full space-y-3 text-left">
                                <div>
                                    <label class="block text-xs font-bold text-on-surface-variant mb-1">Unggah Berkas Foto Hero Baru:</label>
                                    <input type="file" name="hero_image_file" accept="image/*" 
                                           onchange="previewImage(this, 'hero-preview')"
                                           class="w-full text-xs text-on-surface file:mr-2 file:py-2 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-primary file:text-on-primary hover:file:opacity-90 cursor-pointer">
                                </div>
                                <div class="pt-2 border-t border-outline-variant/30">
                                    <label class="block text-xs font-bold text-on-surface-variant mb-1">Atau Gunakan URL Gambar Eksternal:</label>
                                    <input type="url" name="hero_image_url" value="{{ str_starts_with($settings['hero_image'] ?? '', 'http') ? $settings['hero_image'] : '' }}" placeholder="https://..." class="w-full text-xs p-2.5 rounded-lg border border-outline-variant bg-surface-container-lowest dark:bg-surface-container text-on-surface outline-none">
                                </div>
                            </div>
                        </div>

                        <!-- Hero Text Inputs -->
                        <div class="lg:col-span-8 space-y-4">
                            <div>
                                <label class="block text-xs font-bold text-on-surface mb-1">Badge Pengumuman Hero</label>
                                <input type="text" name="hero_badge" value="{{ $settings['hero_badge'] ?? 'Pendaftaran Anggota Baru 2026/2027' }}" class="w-full text-xs p-3 rounded-xl border border-outline-variant bg-surface-container-lowest dark:bg-surface-container text-on-surface outline-none focus:border-primary">
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-bold text-on-surface mb-1">Judul Utama Hero Baris 1</label>
                                    <input type="text" name="hero_title" value="{{ $settings['hero_title'] ?? 'Ekskul Bulu Tangkis' }}" class="w-full text-xs p-3 rounded-xl border border-outline-variant bg-surface-container-lowest dark:bg-surface-container text-on-surface outline-none focus:border-primary">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-on-surface mb-1">Subjudul Utama (Warna Hijau)</label>
                                    <input type="text" name="hero_subtitle" value="{{ $settings['hero_subtitle'] ?? 'SMKN 2 Purwakarta' }}" class="w-full text-xs p-3 rounded-xl border border-outline-variant bg-surface-container-lowest dark:bg-surface-container text-on-surface outline-none focus:border-primary">
                                </div>
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-on-surface mb-1">Deskripsi Sambutan Hero</label>
                                <textarea name="hero_description" rows="3" class="w-full text-xs p-3 rounded-xl border border-outline-variant bg-surface-container-lowest dark:bg-surface-container text-on-surface outline-none focus:border-primary">{{ $settings['hero_description'] ?? '' }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section 3: Kontak & Informasi Lokasi -->
                <div class="bg-surface-container-lowest dark:bg-surface-container p-6 sm:p-8 rounded-3xl border border-outline-variant/40 shadow-xs">
                    <div class="flex items-center gap-3 border-b border-outline-variant/30 pb-4 mb-6">
                        <span class="w-10 h-10 rounded-xl bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 flex items-center justify-center">
                            <span class="material-symbols-outlined text-2xl">contact_phone</span>
                        </span>
                        <div>
                            <h2 class="font-headline text-lg sm:text-xl font-bold text-on-surface dark:text-surface-bright">
                                Kontak, Sosial Media & Lokasi
                            </h2>
                            <p class="text-xs text-on-surface-variant">
                                Tautan WhatsApp, akun Instagram, dan alamat sekretariat di footer.
                            </p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-on-surface mb-1">Nomor WhatsApp Admin (contoh: 085711223344)</label>
                            <input type="text" name="contact_whatsapp" value="{{ $settings['contact_whatsapp'] ?? '085711223344' }}" class="w-full text-xs p-3 rounded-xl border border-outline-variant bg-surface-container-lowest dark:bg-surface-container text-on-surface outline-none focus:border-primary">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-on-surface mb-1">Tautan Profil Instagram</label>
                            <input type="url" name="contact_instagram" value="{{ $settings['contact_instagram'] ?? 'https://instagram.com' }}" class="w-full text-xs p-3 rounded-xl border border-outline-variant bg-surface-container-lowest dark:bg-surface-container text-on-surface outline-none focus:border-primary">
                        </div>
                        <div class="sm:col-span-2">
                            <label class="block text-xs font-bold text-on-surface mb-1">Alamat Lengkap GOR / Sekretariat</label>
                            <input type="text" name="contact_address" value="{{ $settings['contact_address'] ?? 'Ruang Ekskul SMKN 2 Purwakarta, Jl. Jend. Sudirman No. 123, Purwakarta, Jawa Barat' }}" class="w-full text-xs p-3 rounded-xl border border-outline-variant bg-surface-container-lowest dark:bg-surface-container text-on-surface outline-none focus:border-primary">
                        </div>
                        <div class="sm:col-span-2">
                            <label class="block text-xs font-bold text-on-surface mb-1">Email Resmi</label>
                            <input type="email" name="contact_email" value="{{ $settings['contact_email'] ?? 'ekskulbadminton@smkn2purwakarta.sch.id' }}" class="w-full text-xs p-3 rounded-xl border border-outline-variant bg-surface-container-lowest dark:bg-surface-container text-on-surface outline-none focus:border-primary">
                        </div>
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-primary hover:bg-primary-container text-on-primary px-8 py-3.5 rounded-xl font-headline font-bold text-sm shadow-md hover:shadow-lg transition-all flex items-center gap-2 cursor-pointer">
                        <span class="material-symbols-outlined text-xl">save</span>
                        <span>Simpan Seluruh Pengaturan Konten</span>
                    </button>
                </div>
            </form>
        @endif

        {{-- ========================================================================= --}}
        {{-- TAB 3: MANAJEMEN JADWAL LATIHAN --}}
        {{-- ========================================================================= --}}
        @if($tab == 'schedules')
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                <!-- Form Tambah Jadwal Baru -->
                <div class="lg:col-span-5 bg-surface-container-lowest dark:bg-surface-container p-6 rounded-3xl border border-outline-variant/40 shadow-xs">
                    <h3 class="font-headline text-lg font-bold text-on-surface dark:text-surface-bright mb-4 flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">add_circle</span>
                        <span>Tambah Jadwal Latihan</span>
                    </h3>

                    <form action="{{ route('admin.schedules.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-xs font-bold text-on-surface mb-1">Hari Latihan <span class="text-red-500">*</span></label>
                            <input type="text" name="day" placeholder="Contoh: Senin / Rabu / Sabtu" required class="w-full text-xs p-3 rounded-xl border border-outline-variant bg-surface dark:bg-surface-dim text-on-surface outline-none focus:border-primary">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-on-surface mb-1">Jam Latihan <span class="text-red-500">*</span></label>
                            <input type="text" name="time_range" placeholder="Contoh: 15.30 - 17.30 WIB" required class="w-full text-xs p-3 rounded-xl border border-outline-variant bg-surface dark:bg-surface-dim text-on-surface outline-none focus:border-primary">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-on-surface mb-1">Lokasi Lapangan / GOR <span class="text-red-500">*</span></label>
                            <input type="text" name="location" placeholder="Contoh: GOR Sekolah SMKN 2" required class="w-full text-xs p-3 rounded-xl border border-outline-variant bg-surface dark:bg-surface-dim text-on-surface outline-none focus:border-primary">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-on-surface mb-1">Fokus Materi Latihan <span class="text-red-500">*</span></label>
                            <input type="text" name="focus" placeholder="Contoh: Latihan Fisik & Footwork" required class="w-full text-xs p-3 rounded-xl border border-outline-variant bg-surface dark:bg-surface-dim text-on-surface outline-none focus:border-primary">
                        </div>

                        <div class="flex items-center gap-2 pt-1">
                            <input type="checkbox" id="is_next" name="is_next" value="1" class="w-4 h-4 rounded text-primary border-outline-variant cursor-pointer">
                            <label for="is_next" class="text-xs font-bold text-on-surface cursor-pointer">Tandai sebagai "Sesi Latihan Berikutnya" (Highlight)</label>
                        </div>

                        <button type="submit" class="w-full bg-primary hover:bg-primary-container text-on-primary py-3 rounded-xl text-xs font-headline font-bold transition-all shadow-xs cursor-pointer flex items-center justify-center gap-2 mt-2">
                            <span class="material-symbols-outlined text-lg">save</span>
                            <span>Simpan Jadwal Baru</span>
                        </button>
                    </form>
                </div>

                <!-- Daftar Jadwal Latihan -->
                <div class="lg:col-span-7 space-y-4">
                    <h3 class="font-headline text-lg font-bold text-on-surface dark:text-surface-bright flex items-center gap-2">
                        <span class="material-symbols-outlined text-secondary">calendar_view_day</span>
                        <span>Daftar Jadwal Mingguan ({{ $schedules->count() }})</span>
                    </h3>

                    @forelse($schedules as $item)
                        <div class="bg-surface-container-lowest dark:bg-surface-container p-5 rounded-2xl border border-outline-variant/40 shadow-xs flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 {{ $item->is_next ? 'border-l-4 border-l-secondary-container' : '' }}">
                            <div class="space-y-1">
                                <div class="flex items-center gap-2">
                                    <h4 class="font-headline font-bold text-base text-on-surface dark:text-surface-bright">{{ $item->day }}</h4>
                                    <span class="text-xs font-bold px-2 py-0.5 rounded bg-surface-container dark:bg-surface-dim text-primary">
                                        {{ $item->time_range }}
                                    </span>
                                    @if($item->is_next)
                                        <span class="text-[10px] uppercase font-bold px-2 py-0.5 rounded-full bg-secondary-container text-on-secondary-container">
                                            Sesi Berikutnya
                                        </span>
                                    @endif
                                </div>
                                <p class="text-xs text-on-surface-variant">
                                    <span class="font-medium text-on-surface">Lokasi:</span> {{ $item->location }}
                                </p>
                                <p class="text-xs text-on-surface-variant">
                                    <span class="font-medium text-on-surface">Fokus:</span> {{ $item->focus }}
                                </p>
                            </div>

                            <form action="{{ route('admin.schedules.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus jadwal ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 p-2 rounded-lg hover:bg-red-50 dark:hover:bg-red-950/30 transition-colors" title="Hapus Jadwal">
                                    <span class="material-symbols-outlined text-xl">delete</span>
                                </button>
                            </form>
                        </div>
                    @empty
                        <div class="bg-surface-container-lowest dark:bg-surface-container p-8 rounded-2xl text-center text-on-surface-variant">
                            Belum ada jadwal latihan. Tambahkan jadwal baru di form sebelah kiri.
                        </div>
                    @endforelse
                </div>
            </div>
        @endif

        {{-- ========================================================================= --}}
        {{-- TAB 4: MANAJEMEN PRESTASI --}}
        {{-- ========================================================================= --}}
        @if($tab == 'achievements')
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                <!-- Form Tambah Prestasi Baru -->
                <div class="lg:col-span-5 bg-surface-container-lowest dark:bg-surface-container p-6 rounded-3xl border border-outline-variant/40 shadow-xs">
                    <h3 class="font-headline text-lg font-bold text-on-surface dark:text-surface-bright mb-4 flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">emoji_events</span>
                        <span>Tambah Prestasi & Medali</span>
                    </h3>

                    <form action="{{ route('admin.achievements.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-xs font-bold text-on-surface mb-1">Nama Kejuaraan / Turnamen <span class="text-red-500">*</span></label>
                            <input type="text" name="title" placeholder="Contoh: Kejuaraan Pelajar Se-Kabupaten" required class="w-full text-xs p-3 rounded-xl border border-outline-variant bg-surface dark:bg-surface-dim text-on-surface outline-none focus:border-primary">
                        </div>

                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="block text-xs font-bold text-on-surface mb-1">Kategori <span class="text-red-500">*</span></label>
                                <input type="text" name="category_name" placeholder="Contoh: Tunggal Putra" required class="w-full text-xs p-3 rounded-xl border border-outline-variant bg-surface dark:bg-surface-dim text-on-surface outline-none focus:border-primary">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-on-surface mb-1">Tahun <span class="text-red-500">*</span></label>
                                <input type="number" name="year" value="{{ date('Y') }}" required class="w-full text-xs p-3 rounded-xl border border-outline-variant bg-surface dark:bg-surface-dim text-on-surface outline-none focus:border-primary">
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="block text-xs font-bold text-on-surface mb-1">Peringkat / Gelar <span class="text-red-500">*</span></label>
                                <input type="text" name="rank" placeholder="Contoh: Juara 1 / Emas" required class="w-full text-xs p-3 rounded-xl border border-outline-variant bg-surface dark:bg-surface-dim text-on-surface outline-none focus:border-primary">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-on-surface mb-1">Tipe Medali <span class="text-red-500">*</span></label>
                                <select name="medal_type" class="w-full text-xs p-3 rounded-xl border border-outline-variant bg-surface dark:bg-surface-dim text-on-surface outline-none cursor-pointer">
                                    <option value="gold">Emas (Gold)</option>
                                    <option value="silver">Perak (Silver)</option>
                                    <option value="bronze">Perunggu (Bronze)</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-on-surface mb-1">Nama Atlet / Kontingen</label>
                            <input type="text" name="athlete_names" placeholder="Contoh: Rian Ardianto (XII RPL 1)" class="w-full text-xs p-3 rounded-xl border border-outline-variant bg-surface dark:bg-surface-dim text-on-surface outline-none focus:border-primary">
                        </div>

                        <div class="pt-2 border-t border-outline-variant/30 space-y-2">
                            <label class="block text-xs font-bold text-on-surface">Foto Dokumentasi / Piagam:</label>
                            <input type="file" name="image_file" accept="image/*" class="w-full text-xs text-on-surface file:mr-2 file:py-2 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-primary file:text-on-primary hover:file:opacity-90 cursor-pointer">
                            <p class="text-[11px] text-on-surface-variant">Atau gunakan URL:</p>
                            <input type="url" name="image_url" placeholder="https://..." class="w-full text-xs p-2.5 rounded-lg border border-outline-variant bg-surface dark:bg-surface-dim text-on-surface outline-none">
                        </div>

                        <button type="submit" class="w-full bg-primary hover:bg-primary-container text-on-primary py-3 rounded-xl text-xs font-headline font-bold transition-all shadow-xs cursor-pointer flex items-center justify-center gap-2 mt-2">
                            <span class="material-symbols-outlined text-lg">save</span>
                            <span>Simpan Prestasi</span>
                        </button>
                    </form>
                </div>

                <!-- Daftar Prestasi Cards -->
                <div class="lg:col-span-7 space-y-4">
                    <h3 class="font-headline text-lg font-bold text-on-surface dark:text-surface-bright flex items-center gap-2">
                        <span class="material-symbols-outlined text-secondary">military_tech</span>
                        <span>Daftar Prestasi ({{ $achievements->count() }})</span>
                    </h3>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @forelse($achievements as $ach)
                            <div class="bg-surface-container-lowest dark:bg-surface-container rounded-2xl overflow-hidden border border-outline-variant/40 shadow-xs flex flex-col justify-between">
                                <div class="h-36 bg-surface-container relative overflow-hidden">
                                    @if($ach->formatted_image_url)
                                        <img src="{{ $ach->formatted_image_url }}" alt="{{ $ach->title }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center bg-primary/10">
                                            <span class="material-symbols-outlined text-4xl text-primary">emoji_events</span>
                                        </div>
                                    @endif
                                    <span class="absolute top-2 right-2 px-2.5 py-0.5 rounded-md text-[11px] font-bold shadow-sm
                                        {{ $ach->medal_type == 'gold' ? 'bg-secondary-container text-on-secondary-container' : ($ach->medal_type == 'silver' ? 'bg-slate-300 text-slate-900' : 'bg-amber-700 text-white') }}">
                                        {{ $ach->rank }} ({{ $ach->year }})
                                    </span>
                                </div>

                                <div class="p-4 flex-1 flex flex-col justify-between">
                                    <div>
                                        <h4 class="font-headline font-bold text-sm text-on-surface dark:text-surface-bright line-clamp-1">{{ $ach->title }}</h4>
                                        <p class="text-xs text-on-surface-variant mt-0.5">{{ $ach->category_name }}</p>
                                        @if($ach->athlete_names)
                                            <p class="text-xs text-primary font-medium mt-1">Atlet: {{ $ach->athlete_names }}</p>
                                        @endif
                                    </div>

                                    <div class="pt-3 border-t border-outline-variant/30 flex justify-end mt-3">
                                        <form action="{{ route('admin.achievements.destroy', $ach->id) }}" method="POST" onsubmit="return confirm('Hapus prestasi ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700 text-xs font-bold flex items-center gap-1">
                                                <span class="material-symbols-outlined text-base">delete</span>
                                                <span>Hapus</span>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-2 bg-surface-container-lowest dark:bg-surface-container p-8 rounded-2xl text-center text-on-surface-variant">
                                Belum ada prestasi tercatat.
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        @endif

        {{-- ========================================================================= --}}
        {{-- TAB 5: MANAJEMEN GALERI FOTO --}}
        {{-- ========================================================================= --}}
        @if($tab == 'galleries')
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                <!-- Form Tambah Foto Galeri -->
                <div class="lg:col-span-5 bg-surface-container-lowest dark:bg-surface-container p-6 rounded-3xl border border-outline-variant/40 shadow-xs">
                    <h3 class="font-headline text-lg font-bold text-on-surface dark:text-surface-bright mb-4 flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">add_photo_alternate</span>
                        <span>Tambah Foto Galeri</span>
                    </h3>

                    <form action="{{ route('admin.galleries.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-xs font-bold text-on-surface mb-1">Judul Momen / Foto <span class="text-red-500">*</span></label>
                            <input type="text" name="title" placeholder="Contoh: Latihan Drill Smash Atlet" required class="w-full text-xs p-3 rounded-xl border border-outline-variant bg-surface dark:bg-surface-dim text-on-surface outline-none focus:border-primary">
                        </div>

                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="block text-xs font-bold text-on-surface mb-1">Kategori <span class="text-red-500">*</span></label>
                                <select name="category" class="w-full text-xs p-3 rounded-xl border border-outline-variant bg-surface dark:bg-surface-dim text-on-surface outline-none cursor-pointer">
                                    <option value="latihan">Latihan</option>
                                    <option value="pertandingan">Pertandingan</option>
                                    <option value="tim">Tim & Skuad</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-on-surface mb-1">Ukuran Kartu Grid</label>
                                <select name="span_class" class="w-full text-xs p-3 rounded-xl border border-outline-variant bg-surface dark:bg-surface-dim text-on-surface outline-none cursor-pointer">
                                    <option value="col-span-1">Standar (1 Kolom)</option>
                                    <option value="col-span-1 sm:col-span-2 md:col-span-2">Lebar (2 Kolom)</option>
                                    <option value="col-span-1 sm:col-span-2 md:col-span-2 md:row-span-2">Besar / Utama (2x2)</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-on-surface mb-1">Keterangan / Caption</label>
                            <textarea name="caption" rows="2" placeholder="Ceritakan momen di balik foto ini..." class="w-full text-xs p-3 rounded-xl border border-outline-variant bg-surface dark:bg-surface-dim text-on-surface outline-none focus:border-primary"></textarea>
                        </div>

                        <div class="pt-2 border-t border-outline-variant/30 space-y-2">
                            <label class="block text-xs font-bold text-on-surface">Unggah Berkas Gambar <span class="text-red-500">*</span></label>
                            <input type="file" name="image_file" accept="image/*" class="w-full text-xs text-on-surface file:mr-2 file:py-2 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-primary file:text-on-primary hover:file:opacity-90 cursor-pointer">
                            <p class="text-[11px] text-on-surface-variant">Atau masukkan URL Gambar:</p>
                            <input type="url" name="image_url" placeholder="https://..." class="w-full text-xs p-2.5 rounded-lg border border-outline-variant bg-surface dark:bg-surface-dim text-on-surface outline-none">
                        </div>

                        <button type="submit" class="w-full bg-primary hover:bg-primary-container text-on-primary py-3 rounded-xl text-xs font-headline font-bold transition-all shadow-xs cursor-pointer flex items-center justify-center gap-2 mt-2">
                            <span class="material-symbols-outlined text-lg">upload</span>
                            <span>Unggah Foto ke Galeri</span>
                        </button>
                    </form>
                </div>

                <!-- Grid Galeri Foto -->
                <div class="lg:col-span-7 space-y-4">
                    <h3 class="font-headline text-lg font-bold text-on-surface dark:text-surface-bright flex items-center gap-2">
                        <span class="material-symbols-outlined text-secondary">collections</span>
                        <span>Foto Galeri Aktif ({{ $galleries->count() }})</span>
                    </h3>

                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                        @forelse($galleries as $photo)
                            <div class="bg-surface-container-lowest dark:bg-surface-container rounded-2xl overflow-hidden border border-outline-variant/40 shadow-xs relative group">
                                <div class="aspect-video bg-surface-container relative overflow-hidden">
                                    <img src="{{ $photo->formatted_image_url }}" alt="{{ $photo->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                    <span class="absolute top-1.5 left-1.5 px-2 py-0.5 rounded text-[9px] uppercase font-bold bg-black/60 text-white backdrop-blur-xs">
                                        {{ $photo->category }}
                                    </span>
                                </div>
                                <div class="p-3">
                                    <h5 class="font-headline font-bold text-xs text-on-surface dark:text-surface-bright line-clamp-1">{{ $photo->title }}</h5>
                                    @if($photo->caption)
                                        <p class="text-[11px] text-on-surface-variant line-clamp-1 mt-0.5">{{ $photo->caption }}</p>
                                    @endif
                                    <div class="pt-2 mt-2 border-t border-outline-variant/30 flex justify-end">
                                        <form action="{{ route('admin.galleries.destroy', $photo->id) }}" method="POST" onsubmit="return confirm('Hapus foto ini dari galeri?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700 text-xs font-bold flex items-center gap-1">
                                                <span class="material-symbols-outlined text-sm">delete</span>
                                                <span>Hapus</span>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-3 bg-surface-container-lowest dark:bg-surface-container p-8 rounded-2xl text-center text-on-surface-variant">
                                Belum ada foto di galeri.
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        @endif

        {{-- ========================================================================= --}}
        {{-- TAB 6: MANAJEMEN PAPAN SKOR --}}
        {{-- ========================================================================= --}}
        @if($tab == 'scores')
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                <!-- Form Tambah Skor Pertandingan -->
                <div class="lg:col-span-5 bg-surface-container-lowest dark:bg-surface-container p-6 rounded-3xl border border-outline-variant/40 shadow-xs">
                    <h3 class="font-headline text-lg font-bold text-on-surface dark:text-surface-bright mb-4 flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">add_circle</span>
                        <span>Tambah Hasil / Skor Tanding</span>
                    </h3>

                    <form action="{{ route('admin.scores.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-xs font-bold text-on-surface mb-1">Nama Turnamen <span class="text-red-500">*</span></label>
                            <input type="text" name="tournament" placeholder="Contoh: Grand Final Kejuaraan Pelajar" required class="w-full text-xs p-3 rounded-xl border border-outline-variant bg-surface dark:bg-surface-dim text-on-surface outline-none focus:border-primary">
                        </div>

                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="block text-xs font-bold text-on-surface mb-1">Kategori Tanding <span class="text-red-500">*</span></label>
                                <input type="text" name="category" placeholder="Contoh: Tunggal Putra" required class="w-full text-xs p-3 rounded-xl border border-outline-variant bg-surface dark:bg-surface-dim text-on-surface outline-none focus:border-primary">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-on-surface mb-1">Status Pertandingan <span class="text-red-500">*</span></label>
                                <select name="status" class="w-full text-xs p-3 rounded-xl border border-outline-variant bg-surface dark:bg-surface-dim text-on-surface outline-none cursor-pointer">
                                    <option value="selesai">Selesai</option>
                                    <option value="live">Live Match (Sedang Berlangsung)</option>
                                    <option value="mendatang">Mendatang</option>
                                </select>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="block text-xs font-bold text-on-surface mb-1">Nama Tim A <span class="text-red-500">*</span></label>
                                <input type="text" name="team_a_name" placeholder="Contoh: SMKN 2 Purwakarta" required class="w-full text-xs p-3 rounded-xl border border-outline-variant bg-surface dark:bg-surface-dim text-on-surface outline-none focus:border-primary">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-on-surface mb-1">Set Menang Tim A</label>
                                <input type="number" name="team_a_sets" value="2" min="0" max="5" required class="w-full text-xs p-3 rounded-xl border border-outline-variant bg-surface dark:bg-surface-dim text-on-surface outline-none focus:border-primary">
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="block text-xs font-bold text-on-surface mb-1">Nama Tim B (Lawan) <span class="text-red-500">*</span></label>
                                <input type="text" name="team_b_name" placeholder="Contoh: SMAN 1 Purwakarta" required class="w-full text-xs p-3 rounded-xl border border-outline-variant bg-surface dark:bg-surface-dim text-on-surface outline-none focus:border-primary">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-on-surface mb-1">Set Menang Tim B</label>
                                <input type="number" name="team_b_sets" value="1" min="0" max="5" required class="w-full text-xs p-3 rounded-xl border border-outline-variant bg-surface dark:bg-surface-dim text-on-surface outline-none focus:border-primary">
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-on-surface mb-1">Rincian Skor Per Set <span class="text-red-500">*</span></label>
                            <input type="text" name="score_details" placeholder="Contoh: 21-18, 19-21, 21-15" required class="w-full text-xs p-3 rounded-xl border border-outline-variant bg-surface dark:bg-surface-dim text-on-surface outline-none focus:border-primary">
                        </div>

                        <div class="flex items-center gap-2 pt-1">
                            <input type="checkbox" id="is_active_highlight" name="is_active_highlight" value="1" class="w-4 h-4 rounded text-primary border-outline-variant cursor-pointer">
                            <label for="is_active_highlight" class="text-xs font-bold text-on-surface cursor-pointer">Jadikan Sorotan Utama di Beranda</label>
                        </div>

                        <button type="submit" class="w-full bg-primary hover:bg-primary-container text-on-primary py-3 rounded-xl text-xs font-headline font-bold transition-all shadow-xs cursor-pointer flex items-center justify-center gap-2 mt-2">
                            <span class="material-symbols-outlined text-lg">save</span>
                            <span>Simpan Skor Pertandingan</span>
                        </button>
                    </form>
                </div>

                <!-- Daftar Skor Pertandingan -->
                <div class="lg:col-span-7 space-y-4">
                    <h3 class="font-headline text-lg font-bold text-on-surface dark:text-surface-bright flex items-center gap-2">
                        <span class="material-symbols-outlined text-secondary">scoreboard</span>
                        <span>Daftar Pertandingan ({{ $matchScores->count() }})</span>
                    </h3>

                    @forelse($matchScores as $match)
                        <div class="bg-surface-container-lowest dark:bg-surface-container p-5 rounded-2xl border border-outline-variant/40 shadow-xs flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 {{ $match->is_active_highlight ? 'border-l-4 border-l-primary' : '' }}">
                            <div class="space-y-1">
                                <div class="flex items-center gap-2">
                                    <span class="text-xs font-bold text-primary">{{ $match->tournament }}</span>
                                    <span class="text-[10px] px-2 py-0.5 rounded-full uppercase font-bold
                                        {{ $match->status == 'live' ? 'bg-red-500 text-white animate-pulse' : 'bg-surface-container text-on-surface-variant' }}">
                                        {{ $match->status }}
                                    </span>
                                    @if($match->is_active_highlight)
                                        <span class="text-[10px] bg-primary/20 text-primary px-2 py-0.5 rounded-full font-bold">
                                            Highlight
                                        </span>
                                    @endif
                                </div>
                                <h4 class="font-headline font-bold text-sm sm:text-base text-on-surface dark:text-surface-bright">
                                    {{ $match->team_a_name }} ({{ $match->team_a_sets }}) vs {{ $match->team_b_name }} ({{ $match->team_b_sets }})
                                </h4>
                                <p class="text-xs text-on-surface-variant font-mono">
                                    Skor: {{ $match->score_details }}
                                </p>
                            </div>

                            <form action="{{ route('admin.scores.destroy', $match->id) }}" method="POST" onsubmit="return confirm('Hapus skor pertandingan ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 p-2 rounded-lg hover:bg-red-50 dark:hover:bg-red-950/30 transition-colors" title="Hapus Skor">
                                    <span class="material-symbols-outlined text-xl">delete</span>
                                </button>
                            </form>
                        </div>
                    @empty
                        <div class="bg-surface-container-lowest dark:bg-surface-container p-8 rounded-2xl text-center text-on-surface-variant">
                            Belum ada catatan skor pertandingan.
                        </div>
                    @endforelse
                </div>
            </div>
        @endif

    </div>
</div>

<script>
function previewImage(input, previewId) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById(previewId).src = e.target.result;
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection
