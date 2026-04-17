/**
 * Obscura — Reveal Animations & Interactions
 * Vanilla JS · IntersectionObserver for scroll-triggered reveals
 */
document.addEventListener('DOMContentLoaded', () => {

    // --- Scroll Reveal ---
    const revealElements = document.querySelectorAll('.reveal');
    if (revealElements.length) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('reveal--visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.15, rootMargin: '0px 0px -40px 0px' });

        revealElements.forEach(el => observer.observe(el));
    }

    // --- Navbar scroll state ---
    const nav = document.querySelector('.nav');
    if (nav) {
        const onScroll = () => {
            nav.classList.toggle('nav--scrolled', window.scrollY > 60);
        };
        window.addEventListener('scroll', onScroll, { passive: true });
        onScroll();
    }

    // --- Smooth scroll for anchor links ---
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', (e) => {
            const target = document.querySelector(anchor.getAttribute('href'));
            if (target) {
                e.preventDefault();
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });

    // --- Auto-dismiss toast ---
    const toast = document.getElementById('toast-notification');
    if (toast) {
        setTimeout(() => {
            toast.remove();
        }, 5000);
    }
});
