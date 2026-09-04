<!DOCTYPE html>
<html class="scroll-smooth" lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Ekskul Bulu Tangkis SMKN 2 Purwakarta - Agile Court')</title>
    <meta name="description" content="@yield('meta_description', 'Official portal Ekstrakurikuler Bulu Tangkis SMKN 2 Purwakarta. Asah teknik, raih mental juara, dan ukir prestasi olahraga bersama kami.')">

    <!-- Google Fonts: Montserrat (Headlines) & Inter (Body) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Montserrat:wght@600;700;800;900&display=swap" rel="stylesheet">

    <!-- Material Symbols -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">

    <!-- Theme Initialization Script (Default to Crisp Vibrant Light Theme) -->
    <script>
        if (localStorage.getItem('theme') === 'dark') {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-surface text-on-surface font-body overflow-x-hidden selection:bg-secondary-container selection:text-on-secondary-container transition-colors duration-300">

    <!-- Top Navigation Bar -->
    @include('partials.navbar')

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    @include('partials.footer')

    <!-- Native Lightbox Modal for Gallery -->
    <div id="lightbox-modal" class="fixed inset-0 z-50 bg-black/90 backdrop-blur-md hidden items-center justify-center p-4 transition-all">
        <button id="lightbox-close" class="absolute top-6 right-6 text-white bg-white/10 hover:bg-white/20 p-2 rounded-full focus:outline-none transition-colors" aria-label="Tutup">
            <span class="material-symbols-outlined text-2xl">close</span>
        </button>
        <div id="lightbox-content" class="max-w-4xl max-h-[90vh] flex flex-col items-center">
            <img id="lightbox-img" src="" alt="" class="max-h-[75vh] w-auto object-contain rounded-lg shadow-2xl border border-white/10">
            <p id="lightbox-caption" class="text-white/90 text-sm md:text-base font-medium mt-4 text-center px-4 max-w-2xl"></p>
        </div>
    </div>

    <!-- Celebratory Registration Success Modal -->
    <div id="success-modal" class="fixed inset-0 z-50 bg-black/75 backdrop-blur-sm hidden items-center justify-center p-4">
        <div id="success-card" class="bg-surface-container-lowest dark:bg-surface-container-high rounded-2xl shadow-2xl max-w-md w-full p-6 text-center border-t-4 border-secondary-container relative overflow-hidden">
            <!-- Decorative shuttlecock visual -->
            <div class="flex justify-center mb-3">
                <div id="success-shuttlecock" class="w-16 h-16 rounded-full bg-primary-container/20 flex items-center justify-center text-primary dark:text-primary-fixed">
                    <span class="material-symbols-outlined text-4xl">sports_tennis</span>
                </div>
            </div>
            <h3 class="font-headline text-2xl font-bold text-on-surface">Pendaftaran Terkirim!</h3>
            <p class="text-on-surface-variant text-sm mt-2">
                Terima kasih, <strong id="success-name" class="text-primary font-semibold">Siswa</strong>! Formulir pendaftaran ekskul telah tercatat di sistem kami.
            </p>

            <div class="bg-surface-container-low dark:bg-surface-dim p-4 rounded-xl my-4 border border-outline-variant/50 text-center">
                <span class="text-xs text-on-surface-variant uppercase tracking-wider block mb-1">Kode Pendaftaran Anda</span>
                <div class="flex items-center justify-center gap-2">
                    <span id="success-code-badge" class="font-mono text-xl font-bold text-primary dark:text-primary-fixed-dim">BDM-2026-000</span>
                    <button id="copy-code-btn" type="button" class="text-xs bg-primary/10 hover:bg-primary/20 text-primary px-2.5 py-1 rounded-md transition-colors flex items-center gap-1" title="Salin Kode">
                        <span class="material-symbols-outlined text-sm">content_copy</span> Salin
                    </button>
                </div>
                <p class="text-xs text-on-surface-variant/80 mt-2">Simpan kode ini untuk melacak status penerimaan Anda kapan saja.</p>
            </div>

            <div class="flex flex-col gap-2 mt-2">
                <a href="{{ route('register.status') }}" class="w-full bg-primary text-on-primary py-2.5 rounded-lg font-headline font-semibold text-sm hover:bg-primary-container transition-colors shadow-sm">
                    Cek Status Sekarang
                </a>
                <button id="modal-close-btn" type="button" class="w-full text-on-surface-variant hover:text-on-surface py-2 text-sm font-medium transition-colors">
                    Tutup
                </button>
            </div>
        </div>
    </div>

    @stack('scripts')
</body>
</html>
