// Typing animation for hero
function initTypingEffect() {
    const el = document.getElementById('typing-text');
    if (!el) return;

    const phrases = [
        'WEB DEVELOPER',
        'MAHASISWA'
    ];

    let phraseIndex = 0;
    let charIndex = 0;
    let isDeleting = false;

    function type() {
        const current = phrases[phraseIndex];
        if (isDeleting) {
            el.textContent = current.substring(0, charIndex - 1);
            charIndex--;
        } else {
            el.textContent = current.substring(0, charIndex + 1);
            charIndex++;
        }

        if (!isDeleting && charIndex === current.length) {
            setTimeout(() => { isDeleting = true; }, 1800);
            setTimeout(type, 1900);
            return;
        }

        if (isDeleting && charIndex === 0) {
            isDeleting = false;
            phraseIndex = (phraseIndex + 1) % phrases.length;
        }

        setTimeout(type, isDeleting ? 60 : 90);
    }

    type();
}

// Mobile menu toggle
function initMobileMenu() {
    const menuBtn = document.getElementById('mobile-menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    if (!menuBtn || !mobileMenu) return;

    menuBtn.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
        const icon = menuBtn.querySelector('svg');
        icon.innerHTML = mobileMenu.classList.contains('hidden')
            ? '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>'
            : '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>';
    });

    mobileMenu.querySelectorAll('a').forEach(link => {
        link.addEventListener('click', () => {
            mobileMenu.classList.add('hidden');
        });
    });
}

// Scroll reveal animations
function initScrollReveal() {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-slide-up');
                entry.target.style.opacity = '1';
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.08, rootMargin: '0px 0px -40px 0px' });

    document.querySelectorAll('.scroll-reveal').forEach(el => {
        el.style.opacity = '0';
        observer.observe(el);
    });
}

// Smooth scroll
function initSmoothScroll() {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const id = this.getAttribute('href');
            if (id === '#') return;
            const target = document.querySelector(id);
            if (target) {
                e.preventDefault();
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });
}

// Navbar styling on scroll
function initNavbar() {
    const navbar = document.getElementById('navbar');
    if (!navbar) return;
    window.addEventListener('scroll', () => {
        if (window.scrollY > 60) {
            navbar.classList.add('bg-dark-900/90', 'backdrop-blur-md', 'border-b', 'border-primary-900/50');
        } else {
            navbar.classList.remove('bg-dark-900/90', 'backdrop-blur-md', 'border-b', 'border-primary-900/50');
        }
    });
}

// Animate number counter for stats
function initCounters() {
    document.querySelectorAll('[data-count]').forEach(el => {
        const target = parseInt(el.dataset.count);
        let current = 0;
        const increment = Math.ceil(target / 40);
        const timer = setInterval(() => {
            current += increment;
            if (current >= target) { current = target; clearInterval(timer); }
            el.textContent = current;
        }, 30);
    });
}

// Matrix rain particles (subtle background)
function initMatrixRain() {
    const canvas = document.getElementById('matrix-canvas');
    if (!canvas) return;

    const ctx = canvas.getContext('2d');
    canvas.width = canvas.offsetWidth;
    canvas.height = canvas.offsetHeight;

    const chars = '01アイウエオカキクケコサシスセソタチツテト';
    const cols = Math.floor(canvas.width / 20);
    const drops = Array(cols).fill(1);

    setInterval(() => {
        ctx.fillStyle = 'rgba(10, 14, 26, 0.05)';
        ctx.fillRect(0, 0, canvas.width, canvas.height);
        ctx.fillStyle = 'rgba(6, 182, 212, 0.15)';
        ctx.font = '12px monospace';
        drops.forEach((y, i) => {
            const char = chars[Math.floor(Math.random() * chars.length)];
            ctx.fillText(char, i * 20, y * 20);
            if (y * 20 > canvas.height && Math.random() > 0.975) drops[i] = 0;
            drops[i]++;
        });
    }, 80);

    window.addEventListener('resize', () => {
        canvas.width = canvas.offsetWidth;
        canvas.height = canvas.offsetHeight;
    });
}

document.addEventListener('DOMContentLoaded', () => {
    initTypingEffect();
    initMobileMenu();
    initScrollReveal();
    initSmoothScroll();
    initNavbar();
    initMatrixRain();

    // Init counters when about section enters viewport
    const aboutSection = document.getElementById('about');
    if (aboutSection) {
        const counterObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    initCounters();
                    counterObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.3 });
        counterObserver.observe(aboutSection);
    }
});
