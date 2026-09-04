<section class="py-16 sm:py-20 bg-surface-container-low dark:bg-surface-container-low pb-24 sm:pb-32 transition-colors duration-300" id="galeri">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 pt-4 sm:pt-6">
        <!-- Section Header -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-end mb-8 gap-4">
            <div>
                <div class="inline-flex items-center gap-2 text-primary dark:text-primary-fixed font-headline font-bold text-xs uppercase tracking-widest mb-2">
                    <span class="material-symbols-outlined text-base">photo_library</span>
                    <span>Dokumentasi Visual</span>
                </div>
                <h2 class="font-headline text-2xl sm:text-3xl md:text-4xl font-extrabold text-on-surface tracking-tight">
                    Galeri Kegiatan Ekskul
                </h2>
                <p class="text-xs sm:text-sm md:text-base text-on-surface-variant mt-1">
                    Kilasan aksi, kebersamaan, dan atmosfer perjuangan atlet di lapangan.
                </p>
            </div>

            <!-- Filter Categories -->
            <div class="flex flex-wrap gap-2">
                <button type="button" data-category="semua" class="gallery-filter-btn px-3.5 sm:px-4 py-2 rounded-xl text-xs font-headline font-bold bg-primary text-on-primary shadow-md transition-all cursor-pointer">
                    Semua
                </button>
                <button type="button" data-category="tim" class="gallery-filter-btn px-3.5 sm:px-4 py-2 rounded-xl text-xs font-headline font-bold bg-surface-container text-on-surface-variant hover:text-on-surface transition-all cursor-pointer">
                    Tim & Skuad
                </button>
                <button type="button" data-category="latihan" class="gallery-filter-btn px-3.5 sm:px-4 py-2 rounded-xl text-xs font-headline font-bold bg-surface-container text-on-surface-variant hover:text-on-surface transition-all cursor-pointer">
                    Latihan
                </button>
                <button type="button" data-category="pertandingan" class="gallery-filter-btn px-3.5 sm:px-4 py-2 rounded-xl text-xs font-headline font-bold bg-surface-container text-on-surface-variant hover:text-on-surface transition-all cursor-pointer">
                    Pertandingan
                </button>
            </div>
        </div>

        <!-- Bento Grid Layout -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 auto-rows-[200px] sm:auto-rows-[220px]">
            @foreach($galleries as $photo)
                <div class="gallery-item {{ $photo->span_class }} relative rounded-2xl overflow-hidden shadow-md cursor-pointer group bg-surface-container-lowest dark:bg-surface-container-lowest transition-all duration-300"
                     data-category="{{ $photo->category }}"
                     data-caption="{{ $photo->caption }}">
                    
                    <img 
                        src="{{ $photo->formatted_image_url }}" 
                        alt="{{ $photo->title }}" 
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                    >

                    <!-- Gradient Caption Overlay -->
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/25 to-transparent opacity-80 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-4 sm:p-5">
                        <span class="inline-block px-2.5 py-0.5 rounded text-[10px] uppercase font-bold tracking-wider bg-white/20 text-white w-max mb-1.5 backdrop-blur-xs">
                            {{ ucfirst($photo->category) }}
                        </span>
                        <h4 class="gallery-title font-headline font-bold text-sm sm:text-base text-white leading-snug">
                            {{ $photo->title }}
                        </h4>
                        @if($photo->caption)
                            <p class="text-xs text-white/80 line-clamp-2 mt-1 hidden sm:block">
                                {{ $photo->caption }}
                            </p>
                        @endif
                    </div>

                    <!-- Lightbox Zoom Icon -->
                    <div class="absolute top-4 right-4 w-8 h-8 sm:w-9 sm:h-9 rounded-full bg-black/40 backdrop-blur-xs text-white flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <span class="material-symbols-outlined text-base sm:text-lg">zoom_in</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
