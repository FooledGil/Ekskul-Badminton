<header class="relative pt-24 sm:pt-32 pb-16 sm:pb-20 md:pb-28 overflow-hidden bg-gradient-to-b from-surface-container-low via-surface to-surface dark:from-surface-container-low dark:via-surface dark:to-surface transition-colors duration-300" id="beranda">
    <!-- Sporty Decal & Court Lines Background -->
    <div class="absolute top-0 right-0 w-full sm:w-3/4 h-full bg-primary/5 dark:bg-primary-fixed/5 pointer-events-none court-pattern opacity-60"></div>
    <div class="absolute -top-20 -left-20 w-72 sm:w-80 h-72 sm:h-80 bg-primary/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center relative z-10">
        <!-- Left Content -->
        <div class="lg:col-span-7 flex flex-col items-start space-y-5 sm:space-y-6">
            <!-- Badge -->
            <div class="hero-badge inline-flex items-center gap-2 bg-secondary-container/20 text-on-secondary-container dark:text-secondary-fixed px-3 sm:px-3.5 py-1.5 rounded-full font-headline font-bold text-[11px] sm:text-xs uppercase tracking-wider border border-secondary-container/50">
                <span class="w-2.5 h-2.5 rounded-full bg-secondary-container animate-ping"></span>
                <span>{{ $siteSettings['hero_badge'] ?? 'Pendaftaran Anggota Baru 2026/2027' }}</span>
            </div>

            <!-- Main Title -->
            <h1 class="hero-title font-headline text-3xl sm:text-5xl lg:text-6xl font-black text-on-surface uppercase tracking-tight leading-tight sm:leading-none">
                {{ $siteSettings['hero_title'] ?? 'Ekskul Bulu Tangkis' }} <br>
                <span class="text-primary dark:text-primary-fixed block sm:inline-block">{{ $siteSettings['hero_subtitle'] ?? 'SMKN 2 Purwakarta' }}</span>
            </h1>

            <!-- Subtitle -->
            <p class="hero-desc text-sm sm:text-base md:text-lg text-on-surface-variant max-w-xl border-l-4 border-secondary-container pl-3.5 sm:pl-4 leading-relaxed font-medium">
                {{ $siteSettings['hero_description'] ?? 'Asah Skill. Bangun Mental Juara. Bawa Nama Sekolah. Bergabunglah bersama skuad atlet kebanggaan kami untuk mencetak prestasi gemilang di kancah regional maupun nasional.' }}
            </p>

            <!-- CTA Group (Mobile-first full-width stack, row on sm) -->
            <div class="hero-cta-group flex flex-col sm:flex-row items-stretch sm:items-center gap-3 sm:gap-4 pt-2 w-full sm:w-auto">
                <a class="font-headline font-bold text-sm bg-primary hover:bg-primary-container text-on-primary px-6 sm:px-7 py-3 sm:py-3.5 rounded-xl shadow-md hover:shadow-xl transition-all duration-300 flex items-center justify-center gap-2 active:scale-95" href="#pendaftaran">
                    <span class="material-symbols-outlined text-xl">how_to_reg</span>
                    <span>Gabung Sekarang</span>
                </a>
                <a class="font-headline font-semibold text-sm bg-surface-container-lowest dark:bg-surface-container text-on-surface border-2 border-outline-variant hover:border-primary px-5 sm:px-6 py-3 sm:py-3.5 rounded-xl hover:bg-primary/5 transition-all duration-300 flex items-center justify-center gap-2 shadow-xs" href="#jadwal">
                    <span class="material-symbols-outlined text-xl text-primary">calendar_month</span>
                    <span>Jadwal Latihan</span>
                </a>
                <a class="font-headline font-semibold text-sm bg-secondary-container/15 hover:bg-secondary-container/30 text-secondary dark:text-secondary-fixed px-4 py-3 sm:py-3.5 rounded-xl transition-colors flex items-center justify-center gap-1.5 border border-secondary-container/30" href="{{ route('register.status') }}">
                    <span class="material-symbols-outlined text-lg">search_check</span>
                    <span>Cek Status</span>
                </a>
            </div>

            <!-- Kinetic Stats Counter -->
            <div class="hero-stats grid grid-cols-2 sm:grid-cols-4 gap-4 sm:gap-6 pt-6 w-full border-t border-outline-variant/40 mt-4">
                <div class="bg-surface-container-lowest/60 dark:bg-surface-container/50 p-3 rounded-xl border border-outline-variant/30">
                    <div class="font-headline text-2xl sm:text-3xl font-black text-on-surface counter-number" data-target="{{ $stats['active_members'] }}" data-suffix="+">
                        0+
                    </div>
                    <div class="text-xs text-on-surface-variant font-semibold mt-0.5">Anggota Aktif</div>
                </div>
                <div class="bg-surface-container-lowest/60 dark:bg-surface-container/50 p-3 rounded-xl border border-outline-variant/30">
                    <div class="font-headline text-2xl sm:text-3xl font-black text-secondary dark:text-secondary-fixed counter-number" data-target="{{ $stats['total_achievements'] }}" data-suffix="+">
                        0+
                    </div>
                    <div class="text-xs text-on-surface-variant font-semibold mt-0.5">Piala Prestasi</div>
                </div>
                <div class="bg-surface-container-lowest/60 dark:bg-surface-container/50 p-3 rounded-xl border border-outline-variant/30">
                    <div class="font-headline text-2xl sm:text-3xl font-black text-on-surface counter-number" data-target="{{ $stats['sessions_per_week'] }}" data-suffix="x">
                        0x
                    </div>
                    <div class="text-xs text-on-surface-variant font-semibold mt-0.5">Sesi / Minggu</div>
                </div>
                <div class="bg-surface-container-lowest/60 dark:bg-surface-container/50 p-3 rounded-xl border border-outline-variant/30">
                    <div class="font-headline text-2xl sm:text-3xl font-black text-primary dark:text-primary-fixed counter-number" data-target="{{ $stats['championship_win_rate'] }}" data-suffix="%">
                        0%
                    </div>
                    <div class="text-xs text-on-surface-variant font-semibold mt-0.5">Kemenangan</div>
                </div>
            </div>
        </div>

        <!-- Right Visual Showcase -->
        <div class="lg:col-span-5 relative mt-4 lg:mt-0">
            <div class="hero-image-card hero-float-element relative h-[320px] sm:h-[450px] lg:h-[480px] w-full overflow-hidden rounded-2xl sm:rounded-3xl shadow-2xl border-4 border-surface-container-lowest dark:border-surface-container">
                <!-- Multiply Overlay for Athletic Tone -->
                <div class="absolute inset-0 bg-primary/10 z-10 mix-blend-multiply pointer-events-none"></div>
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent z-10 pointer-events-none"></div>

                <img 
                    src="{{ \App\Models\SiteSetting::formatImageUrl($siteSettings['hero_image'] ?? null, 'https://lh3.googleusercontent.com/aida-public/AB6AXuBn99J-Gp4uw77a681QyJYVVjBXeuKMU6SLsr4lO9r-BdJgtLMvnvFFG2SJ_UFodDNOJoqLMHNWFhn2SJDRia28YKPQVKK9HOcm2hnRCpvKC-ynYNGlaE5yPwDlOIn8lnUoKZw2qsVhyXLjkJdHNCsJOoII04kZEXoCx080y4hTgbiaQB3RZAW13h1dXo6VXmZkaW_1rccOqZ4MkUe1FZii6lVfk_qqf0tpseOTT26lF8WsLFg_5GxCQA') }}" 
                    alt="Pemain bulu tangkis SMKN 2 Purwakarta jump smash" 
                    class="w-full h-full object-cover object-top origin-center scale-100 sm:scale-105 transition-transform duration-700 hover:scale-110"
                >

                <!-- Floating Trophy Tag -->
                <div class="absolute bottom-4 sm:bottom-6 left-4 sm:left-6 right-4 sm:right-6 z-20 bg-surface-container-lowest/95 dark:bg-surface-container/95 backdrop-blur-md p-3.5 sm:p-4 rounded-xl shadow-xl border-l-4 border-secondary-container">
                    <div class="flex items-center gap-3">
                        <span class="w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-secondary-container text-on-secondary-container flex items-center justify-center font-bold shrink-0">
                            <span class="material-symbols-outlined text-xl sm:text-2xl">trophy</span>
                        </span>
                        <div>
                            <h4 class="font-headline font-bold text-xs sm:text-sm text-on-surface">Pusat Pembinaan Atlet</h4>
                            <p class="text-[11px] sm:text-xs text-on-surface-variant font-medium">Regenerasi Atlet O2SN & PBSI Purwakarta</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
