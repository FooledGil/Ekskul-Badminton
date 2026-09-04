<section class="py-16 sm:py-20 bg-primary relative -mt-10 sm:-mt-16 z-20 overflow-hidden" id="pendaftaran">
    <!-- Abstract Athletic Decals & Glows -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-10 left-10 w-96 h-96 bg-primary-container rounded-full mix-blend-screen blur-3xl opacity-40"></div>
        <div class="absolute bottom-10 right-10 w-[500px] h-[500px] bg-[#00421d] rounded-full mix-blend-multiply blur-3xl opacity-50"></div>
        <div class="absolute inset-0 court-pattern opacity-10"></div>
    </div>

    <div class="max-w-3xl mx-auto px-4 sm:px-6 relative z-10">
        <div class="bg-surface-container-lowest dark:bg-surface-container-lowest rounded-2xl sm:rounded-3xl shadow-2xl p-5 sm:p-8 md:p-10 relative overflow-hidden border-t-4 border-secondary-container">
            <!-- Header of Form -->
            <div class="text-center max-w-lg mx-auto mb-6 sm:mb-8">
                <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-2xl bg-primary/10 text-primary dark:text-primary-fixed flex items-center justify-center mx-auto mb-3">
                    <span class="material-symbols-outlined text-2xl sm:text-3xl">sports_tennis</span>
                </div>
                <h2 class="font-headline text-xl sm:text-2xl md:text-3xl font-extrabold text-on-surface tracking-tight">
                    Formulir Pendaftaran Atlet Baru
                </h2>
                <p class="text-xs sm:text-sm text-on-surface-variant mt-2">
                    Siapkan dirimu menjadi bagian dari skuad badminton SMKN 2 Purwakarta angkatan 2026/2027.
                </p>
            </div>

            <!-- The Registration Form -->
            <form id="registration-form" action="{{ route('register.store') }}" method="POST" class="space-y-4 sm:space-y-5">
                @csrf

                <!-- Row 1: Name & Class -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-5">
                    <div>
                        <label for="name" class="block font-headline font-bold text-xs text-on-surface uppercase tracking-wider mb-1.5">
                            Nama Lengkap <span class="text-tertiary">*</span>
                        </label>
                        <div class="relative">
                            <input 
                                type="text" 
                                id="name" 
                                name="name" 
                                required
                                placeholder="Contoh: Muhammad Rizki"
                                class="w-full bg-surface dark:bg-surface-container border border-outline-variant rounded-xl px-3.5 sm:px-4 py-2.5 sm:py-3 text-sm text-on-surface focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-colors"
                            >
                        </div>
                    </div>

                    <div>
                        <label for="class_major" class="block font-headline font-bold text-xs text-on-surface uppercase tracking-wider mb-1.5">
                            Kelas & Jurusan <span class="text-tertiary">*</span>
                        </label>
                        <div class="relative">
                            <input 
                                type="text" 
                                id="class_major" 
                                name="class_major" 
                                required
                                placeholder="Contoh: X RPL 1 atau XI TKJ 2"
                                class="w-full bg-surface dark:bg-surface-container border border-outline-variant rounded-xl px-3.5 sm:px-4 py-2.5 sm:py-3 text-sm text-on-surface focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-colors"
                            >
                        </div>
                    </div>
                </div>

                <!-- Row 2: WhatsApp & Gender -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-5">
                    <div>
                        <label for="whatsapp_number" class="block font-headline font-bold text-xs text-on-surface uppercase tracking-wider mb-1.5">
                            Nomor WhatsApp <span class="text-tertiary">*</span>
                        </label>
                        <div class="relative">
                            <input 
                                type="tel" 
                                id="whatsapp_number" 
                                name="whatsapp_number" 
                                required
                                placeholder="08xxxxxxxxxx"
                                class="w-full bg-surface dark:bg-surface-container border border-outline-variant rounded-xl px-3.5 sm:px-4 py-2.5 sm:py-3 text-sm text-on-surface focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-colors"
                            >
                        </div>
                    </div>

                    <div>
                        <label for="gender" class="block font-headline font-bold text-xs text-on-surface uppercase tracking-wider mb-1.5">
                            Jenis Kelamin
                        </label>
                        <select 
                            id="gender" 
                            name="gender" 
                            class="w-full bg-surface dark:bg-surface-container border border-outline-variant rounded-xl px-3.5 sm:px-4 py-2.5 sm:py-3 text-sm text-on-surface focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-colors cursor-pointer"
                        >
                            <option value="L">Laki-laki (Putra)</option>
                            <option value="P">Perempuan (Putri)</option>
                        </select>
                    </div>
                </div>

                <!-- Row 3: Category & Experience -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-5">
                    <div>
                        <label for="preferred_category" class="block font-headline font-bold text-xs text-on-surface uppercase tracking-wider mb-1.5">
                            Peminatan Kategori Tanding
                        </label>
                        <select 
                            id="preferred_category" 
                            name="preferred_category" 
                            class="w-full bg-surface dark:bg-surface-container border border-outline-variant rounded-xl px-3.5 sm:px-4 py-2.5 sm:py-3 text-sm text-on-surface focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-colors cursor-pointer"
                        >
                            <option value="Tunggal Putra">Tunggal Putra</option>
                            <option value="Tunggal Putri">Tunggal Putri</option>
                            <option value="Ganda Putra">Ganda Putra</option>
                            <option value="Ganda Putri">Ganda Putri</option>
                            <option value="Ganda Campuran">Ganda Campuran</option>
                        </select>
                    </div>

                    <div>
                        <label for="experience_level" class="block font-headline font-bold text-xs text-on-surface uppercase tracking-wider mb-1.5">
                            Pengalaman Bertanding
                        </label>
                        <select 
                            id="experience_level" 
                            name="experience_level" 
                            class="w-full bg-surface dark:bg-surface-container border border-outline-variant rounded-xl px-3.5 sm:px-4 py-2.5 sm:py-3 text-sm text-on-surface focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-colors cursor-pointer"
                        >
                            <option value="Pemula">Pemula (Hobi & Mau Belajar)</option>
                            <option value="Menengah">Menengah (Bisa Teknik Dasar & Pukulan)</option>
                            <option value="Mahir / Atlet">Mahir / Pernah Ikut Turnamen / PB</option>
                        </select>
                    </div>
                </div>

                <!-- Row 4: Motivation -->
                <div>
                    <label for="motivation" class="block font-headline font-bold text-xs text-on-surface uppercase tracking-wider mb-1.5">
                        Alasan & Motivasi Mengikuti Ekskul <span class="text-tertiary">*</span>
                    </label>
                    <textarea 
                        id="motivation" 
                        name="motivation" 
                        required
                        rows="3" 
                        placeholder="Ceritakan mengapa kamu ingin bergabung dan target apa yang ingin kamu capai..."
                        class="w-full bg-surface dark:bg-surface-container border border-outline-variant rounded-xl px-3.5 sm:px-4 py-2.5 sm:py-3 text-sm text-on-surface focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-colors resize-none"
                    ></textarea>
                </div>

                <!-- Submit Button -->
                <div class="pt-2">
                    <button 
                        type="submit" 
                        class="w-full font-headline font-extrabold text-sm bg-tertiary-container hover:bg-tertiary text-on-tertiary-container py-3.5 sm:py-4 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 flex items-center justify-center gap-2 cursor-pointer active:scale-[0.99]"
                    >
                        <span class="material-symbols-outlined text-xl">send</span>
                        <span>Kirim Formulir Pendaftaran</span>
                    </button>
                </div>

                <!-- Track Status Footer -->
                <div class="text-center pt-2">
                    <p class="text-xs text-on-surface-variant">
                        Sudah mendaftar sebelumnya? 
                        <a href="{{ route('register.status') }}" class="font-headline font-bold text-primary dark:text-primary-fixed hover:underline">
                            Lacak Status Seleksi Di Sini →
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</section>
