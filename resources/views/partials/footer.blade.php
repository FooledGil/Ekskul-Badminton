<footer class="w-full pt-16 pb-12 bg-[#141414] text-white/80 border-t border-white/10 relative z-10 transition-colors">
    <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-12 gap-10">
        <!-- Col 1: Brand & Bio -->
        <div class="md:col-span-5 space-y-4">
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 flex items-center justify-center shrink-0">
                    <img src="{{ asset('images/logo-smkn2.png') }}" alt="Logo SMKN 2 Purwakarta" class="w-full h-full object-contain filter drop-shadow-md">
                </div>
                <div>
                    <h3 class="font-headline font-black text-xl text-white tracking-tight leading-tight">SMKN 2 BADMINTON</h3>
                    <span class="text-xs uppercase tracking-widest text-emerald-400 font-bold font-headline">Agile Court Community</span>
                </div>
            </div>
            <p class="text-xs sm:text-sm text-white/70 max-w-sm leading-relaxed">
                Membina generasi muda berkarakter tangguh, memiliki sportivitas tinggi, serta siap berprestasi mengharumkan nama sekolah di ajang kejuaraan bulu tangkis pelajar.
            </p>
            <div class="flex items-center gap-3 pt-2">
                <a href="{{ $siteSettings['contact_instagram'] ?? 'https://instagram.com' }}" target="_blank" rel="noopener noreferrer" class="w-9 h-9 rounded-lg bg-white/10 hover:bg-primary text-white flex items-center justify-center transition-colors" title="Instagram">
                    <span class="material-symbols-outlined text-lg">photo_camera</span>
                </a>
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $siteSettings['contact_whatsapp'] ?? '6285711223344') }}" target="_blank" rel="noopener noreferrer" class="w-9 h-9 rounded-lg bg-white/10 hover:bg-primary text-white flex items-center justify-center transition-colors" title="WhatsApp Admin">
                    <span class="material-symbols-outlined text-lg">chat</span>
                </a>
            </div>
        </div>

        <!-- Col 2: Navigation Links -->
        <div class="md:col-span-3 space-y-3">
            <h4 class="font-headline font-bold text-xs uppercase tracking-widest text-white border-b border-white/10 pb-2">
                Tautan Cepat
            </h4>
            <ul class="space-y-2 text-xs sm:text-sm">
                <li><a href="{{ route('home') }}#beranda" class="hover:text-emerald-400 transition-colors">Beranda</a></li>
                <li><a href="{{ route('home') }}#scoreboard" class="hover:text-emerald-400 transition-colors">Papan Skor Tanding</a></li>
                <li><a href="{{ route('home') }}#tentang" class="hover:text-emerald-400 transition-colors">Tentang & Taktik Lapangan</a></li>
                <li><a href="{{ route('home') }}#jadwal" class="hover:text-emerald-400 transition-colors">Jadwal Latihan</a></li>
                <li><a href="{{ route('home') }}#prestasi" class="hover:text-emerald-400 transition-colors">Daftar Prestasi</a></li>
                <li><a href="{{ route('home') }}#galeri" class="hover:text-emerald-400 transition-colors">Galeri Foto</a></li>
                <li><a href="{{ route('register.status') }}" class="text-secondary-fixed hover:underline font-bold">Cek Status Registrasi</a></li>
            </ul>
        </div>

        <!-- Col 3: Address & Admin Link -->
        <div class="md:col-span-4 space-y-3">
            <h4 class="font-headline font-bold text-xs uppercase tracking-widest text-white border-b border-white/10 pb-2">
                Sekretariat & GOR
            </h4>
            <address class="not-italic text-xs sm:text-sm text-white/70 space-y-2.5">
                <p class="flex items-start gap-2.5">
                    <span class="material-symbols-outlined text-emerald-400 text-lg shrink-0 mt-0.5">location_on</span>
                    <span>{{ $siteSettings['contact_address'] ?? 'GOR Bulu Tangkis SMKN 2 Purwakarta, Jl. Jend. Sudirman No. 123, Kab. Purwakarta, Jawa Barat' }}</span>
                </p>
                <p class="flex items-center gap-2.5">
                    <span class="material-symbols-outlined text-emerald-400 text-lg shrink-0">mail</span>
                    <span>{{ $siteSettings['contact_email'] ?? 'badminton@smkn2purwakarta.sch.id' }}</span>
                </p>
            </address>

            <div class="pt-4 border-t border-white/10">
                <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-1.5 text-xs text-white/50 hover:text-white transition-colors">
                    <span class="material-symbols-outlined text-sm">admin_panel_settings</span>
                    <span>Portal Pembina / Admin</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Copyright -->
    <div class="max-w-7xl mx-auto px-6 mt-12 pt-6 border-t border-white/10 text-center text-xs text-white/50 flex flex-col sm:flex-row justify-between items-center gap-2">
        <p>© 2026 Ekstrakurikuler Bulu Tangkis SMKN 2 Purwakarta. All Rights Reserved.</p>
        <p class="text-white/40">Powered by Laravel, Tailwind CSS & GSAP Animation</p>
    </div>
</footer>
