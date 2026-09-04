<section class="py-16 sm:py-20 bg-surface dark:bg-surface transition-colors duration-300" id="prestasi">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <!-- Section Header -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-end mb-10 sm:mb-12 gap-4 border-b border-outline-variant/30 pb-6">
            <div>
                <div class="inline-flex items-center gap-2 text-secondary dark:text-secondary-fixed font-headline font-bold text-xs uppercase tracking-widest mb-2">
                    <span class="material-symbols-outlined text-base">military_tech</span>
                    <span>Hall of Fame & Kejuaraan</span>
                </div>
                <h2 class="font-headline text-2xl sm:text-3xl md:text-4xl font-extrabold text-on-surface tracking-tight">
                    Prestasi Membanggakan
                </h2>
                <p class="text-xs sm:text-sm md:text-base text-on-surface-variant mt-1">
                    Bukti dedikasi, keringat, dan sportivitas atlet SMKN 2 Purwakarta di berbagai gelanggang.
                </p>
            </div>
            <div class="hidden md:flex items-center gap-2 bg-secondary-container/20 px-4 py-2 rounded-xl text-secondary dark:text-secondary-fixed border border-secondary-container/30">
                <span class="material-symbols-outlined text-3xl">emoji_events</span>
                <div class="text-xs font-headline font-bold leading-tight">
                    <span>12+ Trofi</span><br>
                    <span class="text-on-surface-variant font-normal">3 Tahun Terakhir</span>
                </div>
            </div>
        </div>

        <!-- Achievements Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($achievements as $achieve)
                <div class="achievement-card bg-surface-container-lowest dark:bg-surface-container-lowest rounded-2xl overflow-hidden shadow-md border border-outline-variant hover:shadow-xl transition-all duration-300 group flex flex-col justify-between">
                    <!-- Card Media / Image Header -->
                    <div class="h-48 bg-surface-container-high dark:bg-surface-container overflow-hidden relative flex items-center justify-center">
                        @if($achieve->image_url)
                            <img 
                                src="{{ $achieve->image_url }}" 
                                alt="{{ $achieve->title }}" 
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                            >
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-primary/10 to-secondary-container/20">
                                <span class="material-symbols-outlined text-6xl text-secondary-container">trophy</span>
                            </div>
                        @endif

                        <!-- Rank Badge -->
                        <div class="absolute top-3 right-3 px-3 py-1 rounded-lg font-headline font-bold text-xs flex items-center gap-1 shadow-md
                            @if($achieve->medal_type == 'gold')
                                bg-secondary-container text-on-secondary-container
                            @elseif($achieve->medal_type == 'silver')
                                bg-slate-300 text-slate-900
                            @else
                                bg-[#CD7F32] text-white
                            @endif">
                            <span class="material-symbols-outlined text-sm">military_tech</span>
                            <span>{{ $achieve->rank }}</span>
                        </div>
                    </div>

                    <!-- Card Body -->
                    <div class="p-5 flex flex-col justify-between flex-1">
                        <div>
                            <div class="flex items-center justify-between text-xs text-primary dark:text-primary-fixed font-bold mb-1.5">
                                <span>{{ $achieve->category_name }}</span>
                                <span class="bg-primary/10 px-2 py-0.5 rounded text-[11px]">{{ $achieve->year }}</span>
                            </div>
                            <h3 class="font-headline font-bold text-base text-on-surface leading-snug">
                                {{ $achieve->title }}
                            </h3>
                        </div>

                        @if($achieve->athlete_names)
                            <div class="mt-4 pt-3 border-t border-outline-variant/30 flex items-center gap-2 text-xs text-on-surface-variant">
                                <span class="material-symbols-outlined text-sm text-outline">person</span>
                                <span class="truncate font-medium">{{ $achieve->athlete_names }}</span>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
