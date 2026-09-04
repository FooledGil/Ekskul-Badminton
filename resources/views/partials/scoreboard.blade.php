<!-- Match Scoreboard (Based on DESIGN.md: Specialized Component) -->
<!-- Match Scoreboard (Based on DESIGN.md: Specialized Component) -->
<section class="py-8 sm:py-12 bg-surface relative -mt-4 sm:-mt-6 z-20" id="scoreboard">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="scoreboard-widget bg-[#111a14] text-white rounded-2xl sm:rounded-3xl shadow-2xl p-4 sm:p-6 md:p-8 border border-white/10 relative overflow-hidden">
            <!-- Athletic Accent Decal -->
            <div class="absolute top-0 right-0 w-64 h-full bg-primary/20 pointer-events-none blur-2xl"></div>
            <div class="absolute top-0 left-0 w-full h-1.5 bg-gradient-to-r from-primary via-secondary-container to-tertiary"></div>

            <!-- Header of Scoreboard -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 sm:gap-4 pb-4 sm:pb-6 border-b border-white/10">
                <div class="flex items-center gap-2.5 sm:gap-3">
                    <span class="w-3 h-3 rounded-full bg-emerald-400 animate-pulse shrink-0"></span>
                    <div>
                        <span class="text-[10px] sm:text-xs uppercase tracking-widest text-emerald-400 font-bold font-headline">
                            {{ $highlightMatch->tournament ?? 'Kejuaraan Pelajar Purwakarta 2026' }}
                        </span>
                        <h2 class="font-headline text-base sm:text-lg md:text-xl font-bold text-white">
                            Papan Skor Resmi: {{ $highlightMatch->category ?? 'Tunggal Putra Final' }}
                        </h2>
                    </div>
                </div>

                <div class="inline-flex items-center gap-1.5 bg-white/10 px-3 py-1 sm:py-1.5 rounded-full text-xs font-semibold text-secondary-fixed">
                    <span class="material-symbols-outlined text-sm sm:text-base">emoji_events</span>
                    <span>Status: {{ strtoupper($highlightMatch->status ?? 'SELESAI') }}</span>
                </div>
            </div>

            <!-- Teams & Sets Display (Mobile Stacked & Desktop 3-Col) -->
            <div class="grid grid-cols-1 md:grid-cols-12 gap-4 sm:gap-6 items-center py-5 sm:py-6">
                <!-- Team A (SMKN 2) -->
                <div class="md:col-span-5 flex items-center gap-3 sm:gap-4 bg-white/5 md:bg-transparent p-3 md:p-0 rounded-xl">
                    <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-xl sm:rounded-2xl bg-primary flex items-center justify-center text-white shadow-lg shrink-0">
                        <span class="material-symbols-outlined text-2xl sm:text-3xl">sports_tennis</span>
                    </div>
                    <div class="min-w-0">
                        <span class="text-[11px] font-bold text-emerald-400 uppercase tracking-wider block">Tim Tuan Rumah</span>
                        <h3 class="font-headline text-lg sm:text-xl md:text-2xl font-black text-white leading-tight truncate">
                            {{ $highlightMatch->team_a_name ?? 'SMKN 2 Purwakarta' }}
                        </h3>
                        <span class="text-xs text-white/60">Official School Squad</span>
                    </div>
                </div>

                <!-- Sets Score Center Indicator -->
                <div class="md:col-span-2 flex flex-col items-center justify-center py-2 md:py-0">
                    <div class="flex items-center gap-3 bg-black/30 px-5 py-2 rounded-2xl border border-white/10">
                        <span class="font-headline text-3xl sm:text-4xl md:text-5xl font-black text-emerald-400">
                            {{ $highlightMatch->team_a_sets ?? 2 }}
                        </span>
                        <span class="text-xl sm:text-2xl font-bold text-white/40">-</span>
                        <span class="font-headline text-3xl sm:text-4xl md:text-5xl font-black text-white/70">
                            {{ $highlightMatch->team_b_sets ?? 1 }}
                        </span>
                    </div>
                    <span class="text-[10px] sm:text-xs text-white/50 uppercase tracking-widest font-semibold mt-1.5">Skor Set</span>
                </div>

                <!-- Team B (Opponent) -->
                <div class="md:col-span-5 flex items-center justify-start md:justify-end gap-3 sm:gap-4 bg-white/5 md:bg-transparent p-3 md:p-0 rounded-xl text-left md:text-right">
                    <div class="min-w-0 order-2 md:order-1">
                        <span class="text-[11px] font-bold text-white/50 uppercase tracking-wider block">Lawan Tanding</span>
                        <h3 class="font-headline text-lg sm:text-xl md:text-2xl font-black text-white leading-tight truncate">
                            {{ $highlightMatch->team_b_name ?? 'SMAN 1 Purwakarta' }}
                        </h3>
                        <span class="text-xs text-white/60">Kandidat Finalis</span>
                    </div>
                    <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-xl sm:rounded-2xl bg-white/10 flex items-center justify-center text-white/80 shrink-0 order-1 md:order-2">
                        <span class="material-symbols-outlined text-2xl sm:text-3xl">group</span>
                    </div>
                </div>
            </div>

            <!-- Set Breakdown Details -->
            <div class="pt-4 border-t border-white/10 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 text-xs">
                <div class="flex flex-wrap items-center gap-2">
                    <span class="text-white/60 font-medium">Rincian Perolehan Poin:</span>
                    <span class="bg-primary/40 text-emerald-300 px-2.5 sm:px-3 py-1 rounded-md font-mono font-bold tracking-wider border border-emerald-500/30">
                        {{ $highlightMatch->score_details ?? '21-19 | 18-21 | 21-17' }}
                    </span>
                </div>

                <div class="flex items-center gap-2 text-white/70">
                    <span class="material-symbols-outlined text-secondary-container text-base">verified</span>
                    <span>Pemenang: <strong class="text-white">{{ $highlightMatch->team_a_name ?? 'SMKN 2 Purwakarta' }}</strong></span>
                </div>
            </div>
        </div>
    </div>
</section>
