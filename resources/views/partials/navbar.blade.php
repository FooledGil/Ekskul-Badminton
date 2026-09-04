<nav class="fixed top-0 w-full z-40 bg-surface/95 dark:bg-surface/95 backdrop-blur-md shadow-xs border-b border-outline-variant/30 transition-all duration-300">
    <div class="flex justify-between items-center h-16 md:h-20 px-4 sm:px-6 max-w-7xl mx-auto">
        <!-- Brand Logo -->
        <a class="font-headline text-lg sm:text-xl md:text-2xl font-extrabold text-primary dark:text-primary-fixed-dim flex items-center gap-2.5 sm:gap-3 tracking-tight group" href="{{ route('home') }}">
            <div class="w-9 h-9 sm:w-11 sm:h-11 flex items-center justify-center shrink-0 group-hover:scale-105 transition-transform duration-200">
                <img src="{{ asset('images/logo-smkn2.png') }}" alt="Logo SMKN 2 Purwakarta" class="w-full h-full object-contain filter drop-shadow-sm">
            </div>
            <span class="flex flex-col">
                <span class="leading-none text-on-surface">SMKN 2</span>
                <span class="text-[10px] sm:text-xs uppercase tracking-widest text-primary dark:text-primary-fixed font-bold">Badminton Club</span>
            </span>
        </a>

        <!-- Desktop Navigation Links -->
        <ul class="hidden lg:flex items-center space-x-6 text-sm font-medium">
            <li>
                <a class="text-on-surface hover:text-primary dark:hover:text-primary-fixed-dim font-headline font-semibold transition-colors" href="{{ route('home') }}#beranda">
                    Beranda
                </a>
            </li>
            <li>
                <a class="text-on-surface-variant hover:text-primary dark:hover:text-primary-fixed-dim font-headline font-semibold transition-colors" href="{{ route('home') }}#scoreboard">
                    Skor Tanding
                </a>
            </li>
            <li>
                <a class="text-on-surface-variant hover:text-primary dark:hover:text-primary-fixed-dim font-headline font-semibold transition-colors" href="{{ route('home') }}#tentang">
                    Tentang Kami
                </a>
            </li>
            <li>
                <a class="text-on-surface-variant hover:text-primary dark:hover:text-primary-fixed-dim font-headline font-semibold transition-colors" href="{{ route('home') }}#jadwal">
                    Jadwal
                </a>
            </li>
            <li>
                <a class="text-on-surface-variant hover:text-primary dark:hover:text-primary-fixed-dim font-headline font-semibold transition-colors" href="{{ route('home') }}#prestasi">
                    Prestasi
                </a>
            </li>
            <li>
                <a class="text-on-surface-variant hover:text-primary dark:hover:text-primary-fixed-dim font-headline font-semibold transition-colors" href="{{ route('home') }}#galeri">
                    Galeri
                </a>
            </li>
            <li>
                <a class="text-secondary dark:text-secondary-fixed font-headline font-semibold hover:underline flex items-center gap-1" href="{{ route('register.status') }}">
                    <span class="material-symbols-outlined text-base">how_to_reg</span>
                    Cek Status
                </a>
            </li>
        </ul>

        <!-- Right Side Actions -->
        <div class="flex items-center gap-2 sm:gap-3">
            <!-- Dark Mode Switcher -->
            <button id="theme-toggle" type="button" class="w-9 h-9 sm:w-10 sm:h-10 rounded-lg bg-surface-container hover:bg-surface-container-high dark:bg-surface-container dark:hover:bg-surface-container-high flex items-center justify-center text-on-surface transition-colors cursor-pointer" aria-label="Ganti Tema">
                <span class="material-symbols-outlined dark:hidden text-lg sm:text-xl text-secondary">dark_mode</span>
                <span class="material-symbols-outlined hidden dark:inline-block text-lg sm:text-xl text-secondary-fixed">light_mode</span>
            </button>

            <!-- CTA Button (Desktop & Tablet) -->
            <a class="hidden md:inline-flex items-center gap-1.5 font-headline font-bold text-xs lg:text-sm bg-tertiary-container hover:bg-tertiary text-on-tertiary-container px-3.5 lg:px-4 py-2 lg:py-2.5 rounded-lg shadow-sm hover:shadow-md transition-all duration-200 active:scale-95" href="{{ route('home') }}#pendaftaran">
                <span class="material-symbols-outlined text-base lg:text-lg">app_registration</span>
                <span>Daftar Sekarang</span>
            </a>

            <!-- Mobile Menu Toggle Button -->
            <button id="mobile-menu-btn" type="button" class="lg:hidden text-on-surface p-2 rounded-lg hover:bg-surface-container transition-colors cursor-pointer" aria-label="Menu Navigasi">
                <span class="material-symbols-outlined text-2xl">menu</span>
            </button>
        </div>
    </div>

    <!-- Mobile Drawer / Dropdown -->
    <div id="mobile-menu" class="hidden lg:hidden bg-surface-container-lowest dark:bg-surface-container-lowest border-t border-outline-variant/30 px-6 py-4 space-y-3 shadow-xl max-h-[calc(100vh-4rem)] overflow-y-auto">
        <a class="mobile-nav-link block py-2 text-on-surface font-headline font-semibold hover:text-primary" href="{{ route('home') }}#beranda">Beranda</a>
        <a class="mobile-nav-link block py-2 text-on-surface font-headline font-semibold hover:text-primary" href="{{ route('home') }}#scoreboard">Papan Skor Tanding</a>
        <a class="mobile-nav-link block py-2 text-on-surface font-headline font-semibold hover:text-primary" href="{{ route('home') }}#tentang">Tentang Kami</a>
        <a class="mobile-nav-link block py-2 text-on-surface font-headline font-semibold hover:text-primary" href="{{ route('home') }}#jadwal">Jadwal Latihan</a>
        <a class="mobile-nav-link block py-2 text-on-surface font-headline font-semibold hover:text-primary" href="{{ route('home') }}#prestasi">Prestasi</a>
        <a class="mobile-nav-link block py-2 text-on-surface font-headline font-semibold hover:text-primary" href="{{ route('home') }}#galeri">Galeri Kegiatan</a>
        <div class="pt-2 border-t border-outline-variant/30 flex flex-col gap-2">
            <a class="mobile-nav-link flex items-center gap-2 py-2 text-secondary font-headline font-semibold" href="{{ route('register.status') }}">
                <span class="material-symbols-outlined text-base">how_to_reg</span> Cek Status Pendaftaran
            </a>
            <a class="mobile-nav-link w-full text-center font-headline font-bold text-sm bg-tertiary-container hover:bg-tertiary text-on-tertiary-container py-2.5 rounded-lg shadow-sm" href="{{ route('home') }}#pendaftaran">
                Daftar Sekarang
            </a>
        </div>
    </div>
</nav>
