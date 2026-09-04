<section class="py-16 sm:py-20 bg-surface-container-low dark:bg-surface-container-low relative z-10 transition-colors duration-300" id="jadwal">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 relative z-10">
        <!-- Section Header -->
        <div class="text-center max-w-2xl mx-auto mb-10 sm:mb-14">
            <div class="inline-flex items-center gap-2 text-primary dark:text-primary-fixed font-headline font-bold text-xs uppercase tracking-widest mb-2">
                <span class="material-symbols-outlined text-base">event_available</span>
                <span>Agenda Terjadwal</span>
            </div>
            <h2 class="font-headline text-2xl sm:text-3xl md:text-4xl font-extrabold text-on-surface tracking-tight">
                Jadwal Latihan Rutin
            </h2>
            <p class="text-xs sm:text-sm md:text-base text-on-surface-variant mt-2">
                Disiplin hadir tepat waktu untuk menjaga konsistensi fisik dan kematangan strategi tanding.
            </p>
        </div>

        <!-- Schedule Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-stretch">
            @foreach($schedules as $schedule)
                <div class="schedule-card bg-surface-container-lowest dark:bg-surface-container-lowest rounded-2xl p-5 sm:p-6 shadow-md border transition-all duration-300 flex flex-col justify-between relative
                    {{ $schedule->is_next ? 'border-2 border-secondary-container shadow-xl md:-translate-y-2' : 'border-outline-variant hover:shadow-xl hover:-translate-y-1' }}">
                    
                    @if($schedule->is_next)
                        <div class="absolute -top-3 left-1/2 -translate-x-1/2 bg-secondary-container text-on-secondary-container font-headline font-bold text-[11px] sm:text-xs px-3.5 py-0.5 rounded-full shadow-md flex items-center gap-1">
                            <span class="material-symbols-outlined text-sm">notifications_active</span>
                            <span>Latihan Terdekat</span>
                        </div>
                    @endif

                    <div>
                        <div class="flex items-center justify-between mb-4 mt-2">
                            <h3 class="font-headline text-xl sm:text-2xl font-black text-on-surface">
                                {{ $schedule->day }}
                            </h3>
                            <span class="w-10 h-10 rounded-xl {{ $schedule->is_next ? 'bg-secondary-container/20 text-secondary' : 'bg-surface-container text-outline' }} flex items-center justify-center">
                                <span class="material-symbols-outlined">{{ $schedule->is_next ? 'stars' : 'calendar_today' }}</span>
                            </span>
                        </div>

                        <div class="space-y-3">
                            <div class="flex items-center gap-3 text-on-surface-variant">
                                <span class="material-symbols-outlined text-primary dark:text-primary-fixed text-xl">schedule</span>
                                <span class="text-sm font-semibold text-on-surface">{{ $schedule->time_range }}</span>
                            </div>
                            <div class="flex items-center gap-3 text-on-surface-variant">
                                <span class="material-symbols-outlined text-primary dark:text-primary-fixed text-xl">location_on</span>
                                <span class="text-sm font-medium">{{ $schedule->location }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 pt-4 border-t border-outline-variant/30">
                        <span class="text-[11px] font-bold text-on-surface-variant uppercase tracking-wider block mb-1">Materi / Fokus Latihan:</span>
                        <p class="text-xs font-semibold text-primary dark:text-primary-fixed bg-primary/10 dark:bg-primary/20 p-2.5 rounded-lg border border-primary/20">
                            {{ $schedule->focus }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Venue Note -->
        <div class="mt-10 sm:mt-12 max-w-xl mx-auto bg-surface-container-lowest dark:bg-surface-container-lowest backdrop-blur-sm rounded-xl p-4 border border-outline-variant flex items-center gap-3.5 sm:gap-4 text-xs text-on-surface-variant shadow-xs">
            <span class="material-symbols-outlined text-2xl text-secondary shrink-0">info</span>
            <p>
                <strong>Catatan Perlengkapan:</strong> Seluruh atlet wajib mengenakan pakaian olahraga seragam SMKN 2, sepatu badminton non-marking sol karet, dan membawa raket pribadi.
            </p>
        </div>
    </div>
</section>
