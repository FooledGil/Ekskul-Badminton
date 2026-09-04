@extends('layouts.app')

@section('title', 'Cek Status Pendaftaran - Ekskul Bulu Tangkis SMKN 2')

@section('content')
<div class="pt-24 sm:pt-32 pb-20 sm:pb-24 min-h-screen bg-surface dark:bg-surface transition-colors duration-300">
    <div class="max-w-4xl mx-auto px-4 sm:px-6">
        <!-- Breadcrumb / Back Link -->
        <div class="mb-5 sm:mb-6">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-1.5 text-xs font-headline font-bold text-primary dark:text-primary-fixed hover:underline">
                <span class="material-symbols-outlined text-sm">arrow_back</span>
                <span>Kembali ke Beranda</span>
            </a>
        </div>

        <!-- Header Card -->
        <div class="bg-surface-container-lowest dark:bg-surface-container-lowest rounded-2xl sm:rounded-3xl shadow-xl p-5 sm:p-8 md:p-10 border border-outline-variant relative overflow-hidden mb-6 sm:mb-8">
            <div class="absolute top-0 right-0 w-48 h-full bg-primary/10 pointer-events-none"></div>

            <div class="max-w-xl">
                <div class="inline-flex items-center gap-2 bg-secondary-container/20 text-on-secondary-container dark:text-secondary-fixed px-3 py-1 rounded-full text-xs font-bold font-headline mb-3 border border-secondary-container/30">
                    <span class="material-symbols-outlined text-sm">manage_search</span>
                    <span>Pelacakan Status Calon Atlet</span>
                </div>
                <h1 class="font-headline text-2xl sm:text-3xl md:text-4xl font-black text-on-surface tracking-tight">
                    Cek Status Pendaftaran
                </h1>
                <p class="text-xs sm:text-sm text-on-surface-variant mt-2">
                    Ketikkan Kode Pendaftaran (contoh: <code>BDM-2026-001</code>) atau Nomor WhatsApp yang Anda daftarkan.
                </p>

                <!-- Search Input Form -->
                <form action="{{ route('register.status') }}" method="GET" class="mt-6 flex flex-col sm:flex-row gap-3">
                    <div class="relative flex-1">
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-outline">search</span>
                        <input 
                            type="text" 
                            name="q" 
                            value="{{ $query }}" 
                            required
                            placeholder="Nomor WhatsApp atau Kode BDM-..."
                            class="w-full pl-11 pr-4 py-3 sm:py-3.5 bg-surface dark:bg-surface-container border border-outline-variant rounded-xl text-sm text-on-surface focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all"
                        >
                    </div>
                    <button 
                        type="submit" 
                        class="font-headline font-bold text-sm bg-primary hover:bg-primary-container text-on-primary px-6 sm:px-7 py-3 sm:py-3.5 rounded-xl shadow-md hover:shadow-lg transition-all flex items-center justify-center gap-2 cursor-pointer"
                    >
                        <span>Cari Data</span>
                        <span class="material-symbols-outlined text-base">arrow_forward</span>
                    </button>
                </form>
            </div>
        </div>

        <!-- Result Display -->
        @if($searched)
            @if($result)
                <div class="bg-surface-container-lowest dark:bg-surface-container-lowest rounded-2xl sm:rounded-3xl shadow-xl p-5 sm:p-8 border-t-4 
                    {{ $result->status == 'diterima' ? 'border-primary' : ($result->status == 'ditolak' ? 'border-tertiary' : 'border-secondary-container') }} transition-all">
                    
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 border-b border-outline-variant/30 pb-5 sm:pb-6 mb-5 sm:mb-6">
                        <div>
                            <span class="text-xs font-mono text-outline dark:text-outline-variant block mb-1">
                                Kode: <strong class="text-on-surface">{{ $result->registration_code }}</strong>
                            </span>
                            <h2 class="font-headline text-xl sm:text-2xl font-black text-on-surface">
                                {{ $result->name }}
                            </h2>
                            <p class="text-xs text-on-surface-variant mt-0.5">
                                {{ $result->class_major }} • Terdaftar pada {{ $result->created_at->format('d M Y, H:i') }} WIB
                            </p>
                        </div>

                        <!-- Status Badge -->
                        <div>
                            @if($result->status == 'diterima')
                                <div class="inline-flex items-center gap-2 bg-emerald-100 dark:bg-emerald-950 text-emerald-800 dark:text-emerald-300 px-3.5 sm:px-4 py-2 rounded-xl text-xs font-headline font-bold border border-emerald-300 dark:border-emerald-700">
                                    <span class="material-symbols-outlined text-lg">check_circle</span>
                                    <span>LOLOS / DITERIMA</span>
                                </div>
                            @elseif($result->status == 'ditolak')
                                <div class="inline-flex items-center gap-2 bg-red-100 dark:bg-red-950 text-red-800 dark:text-red-300 px-3.5 sm:px-4 py-2 rounded-xl text-xs font-headline font-bold border border-red-300 dark:border-red-700">
                                    <span class="material-symbols-outlined text-lg">cancel</span>
                                    <span>BELUM LOLOS</span>
                                </div>
                            @else
                                <div class="inline-flex items-center gap-2 bg-amber-100 dark:bg-amber-950 text-amber-800 dark:text-amber-300 px-3.5 sm:px-4 py-2 rounded-xl text-xs font-headline font-bold border border-amber-300 dark:border-amber-700">
                                    <span class="material-symbols-outlined text-lg animate-spin">sync</span>
                                    <span>MENUNGGU SELEKSI BERKAS</span>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Details Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 sm:gap-4 mb-6">
                        <div class="p-4 rounded-xl bg-surface-container-low dark:bg-surface-container border border-outline-variant/30">
                            <span class="text-[11px] text-on-surface-variant block font-medium">Kategori Peminatan</span>
                            <strong class="text-sm font-headline font-bold text-on-surface">{{ $result->preferred_category }}</strong>
                        </div>
                        <div class="p-4 rounded-xl bg-surface-container-low dark:bg-surface-container border border-outline-variant/30">
                            <span class="text-[11px] text-on-surface-variant block font-medium">Tingkat Kemampuan</span>
                            <strong class="text-sm font-headline font-bold text-on-surface">{{ $result->experience_level }}</strong>
                        </div>
                        <div class="p-4 rounded-xl bg-surface-container-low dark:bg-surface-container border border-outline-variant/30">
                            <span class="text-[11px] text-on-surface-variant block font-medium">No. Kontak Terdaftar</span>
                            <strong class="text-sm font-headline font-bold text-on-surface font-mono">{{ $result->whatsapp_number }}</strong>
                        </div>
                    </div>

                    <!-- Coach Notes Box -->
                    <div class="bg-surface-container-low dark:bg-surface-container p-4 sm:p-5 rounded-2xl border border-outline-variant/40">
                        <div class="flex items-center gap-2 text-xs font-headline font-bold text-primary dark:text-primary-fixed uppercase tracking-wider mb-2">
                            <span class="material-symbols-outlined text-base">speaker_notes</span>
                            <span>Catatan & Pengumuman dari Pelatih</span>
                        </div>
                        <p class="text-xs sm:text-sm text-on-surface leading-relaxed">
                            {{ $result->coach_notes ?? 'Data formulir telah masuk ke database panitia seleksi. Harap nantikan pembaruan jadwal tes berikutnya.' }}
                        </p>
                    </div>

                    @if($result->status == 'diterima')
                        <div class="mt-5 sm:mt-6 p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-xs text-emerald-800 dark:text-emerald-300 flex items-center gap-3">
                            <span class="material-symbols-outlined text-2xl shrink-0">sports_handball</span>
                            <p>
                                Selamat bergabung di skuad badminton! Pastikan datang ke GOR pada sesi latihan berikutnya sesuai petunjuk pelatih di atas.
                            </p>
                        </div>
                    @endif
                </div>
            @else
                <div class="bg-surface-container-lowest dark:bg-surface-container-lowest rounded-2xl sm:rounded-3xl p-6 sm:p-8 text-center border border-outline-variant">
                    <div class="w-14 h-14 sm:w-16 sm:h-16 rounded-full bg-red-100 dark:bg-red-950 text-red-600 dark:text-red-400 flex items-center justify-center mx-auto mb-4">
                        <span class="material-symbols-outlined text-3xl">search_off</span>
                    </div>
                    <h3 class="font-headline text-lg sm:text-xl font-bold text-on-surface">Data Tidak Ditemukan</h3>
                    <p class="text-xs sm:text-sm text-on-surface-variant max-w-md mx-auto mt-2">
                        Tidak ada pendaftaran yang cocok dengan pencarian "<strong>{{ $query }}</strong>". Pastikan nomor WhatsApp atau kode registrasi yang Anda masukkan sudah benar.
                    </p>
                    <div class="mt-6">
                        <a href="{{ route('home') }}#pendaftaran" class="inline-flex items-center gap-2 bg-primary text-on-primary px-6 py-2.5 rounded-xl font-headline font-semibold text-sm hover:bg-primary-container transition-colors">
                            Daftar Sebagai Calon Atlet Baru
                        </a>
                    </div>
                </div>
            @endif
        @endif
    </div>
</div>
@endsection
