/**
 * Luxe Landscape - Main JavaScript
 *
 * Handles scroll-based header effects, mobile menu toggle,
 * and smooth anchor scrolling.
 *
 * @package Luxe_Landscape
 */

(function () {
    'use strict';

    // =============================================
    // Header Scroll Effect
    // =============================================
    const header = document.getElementById('site-header');

    if (header) {
        const headerInner = header.querySelector('.site-header-inner');
        let lastScrollY = 0;

        window.addEventListener('scroll', function () {
            const scrollY = window.scrollY;

            if (scrollY > 50) {
                headerInner.style.boxShadow = '0 10px 40px -10px rgba(0,0,0,0.15)';
            } else {
                headerInner.style.boxShadow = '0 10px 15px -3px rgba(0,0,0,0.1)';
            }

            lastScrollY = scrollY;
        }, { passive: true });
    }

    // =============================================
    // Mobile Menu Toggle
    // =============================================
    const mobileMenuOpen = document.getElementById('mobile-menu-open');
    const mobileMenuClose = document.getElementById('mobile-menu-close');
    const mobileNav = document.getElementById('mobile-nav');

    if (mobileMenuOpen && mobileMenuClose && mobileNav) {
        mobileMenuOpen.addEventListener('click', function () {
            mobileNav.classList.add('active');
            document.body.style.overflow = 'hidden';
        });

        mobileMenuClose.addEventListener('click', function () {
            mobileNav.classList.remove('active');
            document.body.style.overflow = '';
        });

        // Close on link click
        mobileNav.querySelectorAll('a').forEach(function (link) {
            link.addEventListener('click', function () {
                mobileNav.classList.remove('active');
                document.body.style.overflow = '';
            });
        });
    }

    // =============================================
    // Smooth Scroll for Anchor Links
    // =============================================
    document.querySelectorAll('a[href^="#"]').forEach(function (anchor) {
        anchor.addEventListener('click', function (e) {
            const targetId = this.getAttribute('href');
            if (targetId === '#') return;

            const target = document.querySelector(targetId);
            if (target) {
                e.preventDefault();
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start',
                });
            }
        });
    });

    // =============================================
    // Trending Products Carousel Navigation
    // =============================================
    const scrollContainer = document.getElementById('products-scroll');
    const prevBtn = document.getElementById('trending-prev');
    const nextBtn = document.getElementById('trending-next');

    if (scrollContainer && prevBtn && nextBtn) {
        // Card width (280px) + gap (1.25rem = 20px)
        var scrollAmount = 300;

        function updateArrowStates() {
            var maxScroll = scrollContainer.scrollWidth - scrollContainer.clientWidth;
            prevBtn.disabled = scrollContainer.scrollLeft <= 5;
            nextBtn.disabled = scrollContainer.scrollLeft >= maxScroll - 5;
        }

        prevBtn.addEventListener('click', function () {
            scrollContainer.scrollBy({ left: -scrollAmount * 2, behavior: 'smooth' });
        });

        nextBtn.addEventListener('click', function () {
            scrollContainer.scrollBy({ left: scrollAmount * 2, behavior: 'smooth' });
        });

        scrollContainer.addEventListener('scroll', updateArrowStates, { passive: true });

        // Initial state
        updateArrowStates();
    }

})();
