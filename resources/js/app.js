import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

gsap.registerPlugin(ScrollTrigger);

document.addEventListener('DOMContentLoaded', () => {
    // ----------------------------------------------------
    // 1. Dark Mode Toggle
    // ----------------------------------------------------
    const themeToggleBtn = document.getElementById('theme-toggle');
    if (themeToggleBtn) {
        // Initialize theme from localStorage (default to crisp light mode)
        if (localStorage.getItem('theme') === 'dark') {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }

        themeToggleBtn.addEventListener('click', () => {
            const isDark = document.documentElement.classList.toggle('dark');
            localStorage.setItem('theme', isDark ? 'dark' : 'light');
            gsap.fromTo(themeToggleBtn, { rotate: 0, scale: 0.8 }, { rotate: 360, scale: 1, duration: 0.4, ease: 'back.out(2)' });
        });
    }

    // ----------------------------------------------------
    // 2. Mobile Menu Toggle & Auto-close on Navigation
    // ----------------------------------------------------
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    if (mobileMenuBtn && mobileMenu) {
        const closeMobileMenu = () => {
            if (!mobileMenu.classList.contains('hidden')) {
                gsap.to(mobileMenu, {
                    opacity: 0,
                    y: -15,
                    duration: 0.2,
                    ease: 'power2.in',
                    onComplete: () => mobileMenu.classList.add('hidden')
                });
            }
        };

        mobileMenuBtn.addEventListener('click', () => {
            const isHidden = mobileMenu.classList.contains('hidden');
            if (isHidden) {
                mobileMenu.classList.remove('hidden');
                gsap.fromTo(mobileMenu, { opacity: 0, y: -15 }, { opacity: 1, y: 0, duration: 0.3, ease: 'power2.out' });
            } else {
                closeMobileMenu();
            }
        });

        // Close when user clicks any menu link
        document.querySelectorAll('.mobile-nav-link').forEach(link => {
            link.addEventListener('click', () => {
                closeMobileMenu();
            });
        });

        // Close on escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && !mobileMenu.classList.contains('hidden')) {
                closeMobileMenu();
            }
        });
    }

    // ----------------------------------------------------
    // 3. Hero Section Entrance Animation (GSAP Timeline)
    // ----------------------------------------------------
    const heroTl = gsap.timeline({ defaults: { ease: 'power3.out' } });

    if (document.querySelector('.hero-badge')) {
        heroTl.fromTo('.hero-badge', { opacity: 0, y: 25, scale: 0.9 }, { opacity: 1, y: 0, scale: 1, duration: 0.6 })
              .fromTo('.hero-title', { opacity: 0, y: 30 }, { opacity: 1, y: 0, duration: 0.7 }, '-=0.3')
              .fromTo('.hero-desc', { opacity: 0, y: 20 }, { opacity: 1, y: 0, duration: 0.6 }, '-=0.4')
              .fromTo('.hero-cta-group', { opacity: 0, y: 20 }, { opacity: 1, y: 0, duration: 0.5 }, '-=0.3')
              .fromTo('.hero-stats', { opacity: 0, y: 20 }, { opacity: 1, y: 0, duration: 0.6 }, '-=0.2')
              .fromTo('.hero-image-card', { opacity: 0, scale: 0.92, rotateY: 8 }, { opacity: 1, scale: 1, rotateY: 0, duration: 0.9, ease: 'back.out(1.4)' }, '-=0.8');

        // Continuous subtle float animation for the athlete hero card
        gsap.to('.hero-float-element', {
            y: -12,
            duration: 2.8,
            repeat: -1,
            yoyo: true,
            ease: 'sine.inOut'
        });
    }

    // ----------------------------------------------------
    // 4. Kinetic Number Counters (ScrollTrigger)
    // ----------------------------------------------------
    const counterElements = document.querySelectorAll('.counter-number');
    if (counterElements.length > 0) {
        ScrollTrigger.batch('.counter-number', {
            start: 'top 85%',
            once: true,
            onEnter: (elements) => {
                elements.forEach((el) => {
                    const target = parseInt(el.getAttribute('data-target') || '0', 10);
                    const suffix = el.getAttribute('data-suffix') || '';
                    const obj = { val: 0 };
                    gsap.to(obj, {
                        val: target,
                        duration: 1.8,
                        ease: 'power2.out',
                        onUpdate: () => {
                            el.textContent = Math.floor(obj.val) + suffix;
                        }
                    });
                });
            }
        });
    }

    // ----------------------------------------------------
    // 5. ScrollTrigger Stagger Reveals for Content Sections
    // ----------------------------------------------------
    // Schedule cards
    const scheduleCards = document.querySelectorAll('.schedule-card');
    if (scheduleCards.length > 0) {
        gsap.fromTo(scheduleCards, 
            { opacity: 0, y: 40 }, 
            {
                opacity: 1, 
                y: 0, 
                duration: 0.6, 
                stagger: 0.15, 
                ease: 'power2.out',
                scrollTrigger: {
                    trigger: '#jadwal',
                    start: 'top 80%',
                    once: true
                }
            }
        );
    }

    // Achievement cards
    const achievementCards = document.querySelectorAll('.achievement-card');
    if (achievementCards.length > 0) {
        gsap.fromTo(achievementCards, 
            { opacity: 0, y: 40, scale: 0.95 }, 
            {
                opacity: 1, 
                y: 0, 
                scale: 1, 
                duration: 0.6, 
                stagger: 0.12, 
                ease: 'power3.out',
                scrollTrigger: {
                    trigger: '#prestasi',
                    start: 'top 80%',
                    once: true
                }
            }
        );
    }

    // Scoreboard reveal
    const scoreboard = document.querySelector('.scoreboard-widget');
    if (scoreboard) {
        gsap.fromTo(scoreboard,
            { opacity: 0, y: 35 },
            {
                opacity: 1,
                y: 0,
                duration: 0.8,
                ease: 'back.out(1.2)',
                scrollTrigger: {
                    trigger: scoreboard,
                    start: 'top 85%',
                    once: true
                }
            }
        );
    }

    // ----------------------------------------------------
    // 6. Interactive Badminton Court Tactics Visualizer
    // ----------------------------------------------------
    const courtZones = document.querySelectorAll('.court-zone');
    const tacticTitle = document.getElementById('tactic-title');
    const tacticBadge = document.getElementById('tactic-badge');
    const tacticDesc = document.getElementById('tactic-desc');
    const tacticDrill = document.getElementById('tactic-drill');
    const shuttlecockIndicator = document.getElementById('shuttlecock-indicator');

    const tacticsData = {
        net: {
            title: 'Front Court: Netting & Net Kill',
            badge: 'Presisi & Refleks Jaring',
            desc: 'Fokus pada sentuhan halus (spinning net shot), penguasaan bola potong, dan sambaran kilat di depan net untuk memaksa lawan mengangkat bola.',
            drill: 'Drill: 100x Net Tumbling, Shadow Reflex, Quick Finger Grip Adjustment.',
            top: '20%',
            left: '50%'
        },
        mid: {
            title: 'Mid Court: Drive & Counter Attack',
            badge: 'Kecepatan & Tekanan Datar',
            desc: 'Area transisi krusial untuk adu pukulan drive horizontal cepat. Melatih ketahanan pergelangan tangan dan antisipasi pengembalian servis.',
            drill: 'Drill: Multi-shuttle Fast Drive, Side-to-Side Defense Block, Push-to-Body.',
            top: '50%',
            left: '50%'
        },
        back: {
            title: 'Back Court: Jump Smash & Clear Drop',
            badge: 'Tenaga Ledak & Penetrasi',
            desc: 'Area eksekusi serangan mematikan. Mengombinasikan lompatan vertikal penuh dengan smash tajam bersudut curam serta slicing drop shot tipuan.',
            drill: 'Drill: 3-Corner Smash Jump, High Clear Stamina, Steep Angle Slicing.',
            top: '80%',
            left: '50%'
        }
    };

    courtZones.forEach(zone => {
        const activateZone = () => {
            const zoneType = zone.getAttribute('data-zone');
            const data = tacticsData[zoneType];
            if (!data) return;

            // Highlight active zone
            courtZones.forEach(z => z.classList.remove('ring-2', 'ring-secondary-container', 'bg-primary-container/30'));
            zone.classList.add('ring-2', 'ring-secondary-container', 'bg-primary-container/30');

            // Move indicator with GSAP
            if (shuttlecockIndicator) {
                gsap.to(shuttlecockIndicator, {
                    top: data.top,
                    left: data.left,
                    duration: 0.4,
                    ease: 'power2.out'
                });
            }

            // Animate text info card
            if (tacticTitle && tacticDesc && tacticBadge && tacticDrill) {
                gsap.to(['#tactic-title', '#tactic-badge', '#tactic-desc', '#tactic-drill'], {
                    opacity: 0,
                    y: -5,
                    duration: 0.15,
                    onComplete: () => {
                        tacticTitle.textContent = data.title;
                        tacticBadge.textContent = data.badge;
                        tacticDesc.textContent = data.desc;
                        tacticDrill.textContent = data.drill;
                        gsap.to(['#tactic-title', '#tactic-badge', '#tactic-desc', '#tactic-drill'], {
                            opacity: 1,
                            y: 0,
                            duration: 0.25,
                            ease: 'power2.out'
                        });
                    }
                });
            }
        };

        zone.addEventListener('mouseenter', activateZone);
        zone.addEventListener('click', activateZone);
    });

    // ----------------------------------------------------
    // 7. Bento Gallery Filter & Native Lightbox
    // ----------------------------------------------------
    const filterButtons = document.querySelectorAll('.gallery-filter-btn');
    const galleryItems = document.querySelectorAll('.gallery-item');
    const lightboxModal = document.getElementById('lightbox-modal');
    const lightboxImg = document.getElementById('lightbox-img');
    const lightboxCaption = document.getElementById('lightbox-caption');
    const lightboxClose = document.getElementById('lightbox-close');

    filterButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            const category = btn.getAttribute('data-category');

            filterButtons.forEach(b => {
                b.classList.remove('bg-primary', 'text-on-primary', 'shadow-md');
                b.classList.add('bg-surface-container', 'text-on-surface-variant');
            });
            btn.classList.add('bg-primary', 'text-on-primary', 'shadow-md');
            btn.classList.remove('bg-surface-container', 'text-on-surface-variant');

            galleryItems.forEach(item => {
                const itemCat = item.getAttribute('data-category');
                if (category === 'semua' || itemCat === category) {
                    item.style.display = 'block';
                    gsap.fromTo(item, { opacity: 0, scale: 0.9 }, { opacity: 1, scale: 1, duration: 0.4, ease: 'power2.out' });
                } else {
                    gsap.to(item, {
                        opacity: 0,
                        scale: 0.9,
                        duration: 0.25,
                        onComplete: () => { item.style.display = 'none'; }
                    });
                }
            });
        });
    });

    // Lightbox modal trigger
    galleryItems.forEach(item => {
        item.addEventListener('click', () => {
            const img = item.querySelector('img');
            const title = item.querySelector('.gallery-title')?.textContent || 'Dokumentasi Ekskul';
            const desc = item.getAttribute('data-caption') || '';

            if (lightboxModal && lightboxImg && img) {
                lightboxImg.src = img.src;
                lightboxImg.alt = title;
                if (lightboxCaption) {
                    lightboxCaption.textContent = title + (desc ? ' — ' + desc : '');
                }
                lightboxModal.classList.remove('hidden');
                lightboxModal.classList.add('flex');
                gsap.fromTo(lightboxModal, { opacity: 0 }, { opacity: 1, duration: 0.3 });
                gsap.fromTo('#lightbox-content', { scale: 0.85, y: 20 }, { scale: 1, y: 0, duration: 0.4, ease: 'back.out(1.5)' });
            }
        });
    });

    const closeLightbox = () => {
        if (!lightboxModal) return;
        gsap.to(lightboxModal, {
            opacity: 0,
            duration: 0.2,
            onComplete: () => {
                lightboxModal.classList.add('hidden');
                lightboxModal.classList.remove('flex');
            }
        });
    };

    if (lightboxClose) lightboxClose.addEventListener('click', closeLightbox);
    if (lightboxModal) {
        lightboxModal.addEventListener('click', (e) => {
            if (e.target === lightboxModal) closeLightbox();
        });
    }
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && lightboxModal && !lightboxModal.classList.contains('hidden')) {
            closeLightbox();
        }
    });

    // ----------------------------------------------------
    // 8. Registration Form AJAX Submission & Celebration Modal
    // ----------------------------------------------------
    const regForm = document.getElementById('registration-form');
    const successModal = document.getElementById('success-modal');
    const successCodeBadge = document.getElementById('success-code-badge');
    const successNameEl = document.getElementById('success-name');
    const modalCloseBtn = document.getElementById('modal-close-btn');
    const copyCodeBtn = document.getElementById('copy-code-btn');

    if (regForm) {
        regForm.addEventListener('submit', async (e) => {
            e.preventDefault();

            const submitBtn = regForm.querySelector('button[type="submit"]');
            const originalBtnHtml = submitBtn.innerHTML;
            submitBtn.disabled = true;
            submitBtn.innerHTML = `
                <svg class="animate-spin -ml-1 mr-2 h-5 w-5 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                </svg> Mengirim Data...
            `;

            // Clear previous errors
            document.querySelectorAll('.input-error-msg').forEach(el => el.remove());
            document.querySelectorAll('.input-error-border').forEach(el => el.classList.remove('input-error-border', 'border-tertiary'));

            const formData = new FormData(regForm);

            try {
                const response = await fetch(regForm.action, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                    },
                    body: formData
                });

                const data = await response.json();

                if (response.ok && data.success) {
                    regForm.reset();

                    // Populate success modal
                    if (successCodeBadge) successCodeBadge.textContent = data.data.registration_code;
                    if (successNameEl) successNameEl.textContent = data.data.name;

                    // Show celebratory modal with GSAP
                    if (successModal) {
                        successModal.classList.remove('hidden');
                        successModal.classList.add('flex');
                        gsap.fromTo(successModal, { opacity: 0 }, { opacity: 1, duration: 0.3 });
                        gsap.fromTo('#success-card', { scale: 0.7, y: 40 }, { scale: 1, y: 0, duration: 0.5, ease: 'back.out(1.8)' });

                        // Shuttlecock bounce celebration animation
                        gsap.fromTo('#success-shuttlecock', 
                            { y: -100, rotate: -45, opacity: 0 }, 
                            { y: 0, rotate: 0, opacity: 1, duration: 0.7, ease: 'bounce.out', delay: 0.2 }
                        );
                    }
                } else if (data.already_exists) {
                    // Already registered
                    alert(`Nomor WhatsApp ini sudah terdaftar sebelumnya dengan kode: ${data.data.registration_code}.\nSilakan gunakan halaman Cek Status untuk melihat hasil seleksi.`);
                } else if (data.errors) {
                    // Display validation errors
                    for (const [field, messages] of Object.entries(data.errors)) {
                        const input = document.getElementById(field);
                        if (input) {
                            input.classList.add('input-error-border', 'border-tertiary');
                            const err = document.createElement('p');
                            err.className = 'input-error-msg text-xs text-tertiary mt-1';
                            err.textContent = messages[0];
                            input.parentNode.appendChild(err);
                        }
                    }
                } else {
                    alert(data.message || 'Terjadi kesalahan saat memproses formulir.');
                }
            } catch (err) {
                console.error('Submission error:', err);
                alert('Gagal menghubungi server. Pastikan koneksi internet stabil dan coba lagi.');
            } finally {
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalBtnHtml;
            }
        });
    }

    // Modal close
    if (modalCloseBtn && successModal) {
        modalCloseBtn.addEventListener('click', () => {
            gsap.to(successModal, {
                opacity: 0,
                duration: 0.25,
                onComplete: () => {
                    successModal.classList.add('hidden');
                    successModal.classList.remove('flex');
                }
            });
        });
    }

    // Copy Code button
    if (copyCodeBtn && successCodeBadge) {
        copyCodeBtn.addEventListener('click', () => {
            navigator.clipboard.writeText(successCodeBadge.textContent.trim());
            const orig = copyCodeBtn.innerHTML;
            copyCodeBtn.innerHTML = '<span class="material-symbols-outlined text-sm">check</span> Tersalin!';
            setTimeout(() => { copyCodeBtn.innerHTML = orig; }, 2000);
        });
    }
});
