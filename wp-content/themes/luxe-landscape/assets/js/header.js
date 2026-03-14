/**
 * Header JS
 *
 * Header scroll behavior and mobile menu toggle.
 *
 * @package Luxe_Landscape
 */

(function () {
	'use strict';

	// =============================================
	// Header Scroll Effect
	// =============================================
	var header = document.getElementById('site-header');

	if (header) {
		var headerInner = header.querySelector('.glass');

		window.addEventListener('scroll', function () {
			if (window.scrollY > 50) {
				headerInner.style.boxShadow = '0 10px 40px -10px rgba(0,0,0,0.15)';
			} else {
				headerInner.style.background = '';
				headerInner.style.boxShadow = '';
			}

			// Also handle dark mode glass
			if (document.documentElement.classList.contains('dark')) {
				if (window.scrollY > 50) {
					headerInner.style.background = 'rgba(6, 42, 30, 0.9)';
				} else {
					headerInner.style.background = '';
				}
			}
		}, { passive: true });
	}

	// =============================================
	// Mobile Menu Toggle
	// =============================================
	var menuOpen = document.getElementById('mobile-menu-open');
	var menuClose = document.getElementById('mobile-menu-close');
	var mobileNav = document.getElementById('mobile-nav');

	if (menuOpen && menuClose && mobileNav) {
		menuOpen.addEventListener('click', function () {
			mobileNav.classList.remove('hidden');
			mobileNav.classList.add('flex');
			document.body.style.overflow = 'hidden';
		});

		menuClose.addEventListener('click', function () {
			mobileNav.classList.add('hidden');
			mobileNav.classList.remove('flex');
			document.body.style.overflow = '';
		});

		mobileNav.querySelectorAll('a').forEach(function (link) {
			link.addEventListener('click', function () {
				mobileNav.classList.add('hidden');
				mobileNav.classList.remove('flex');
				document.body.style.overflow = '';
			});
		});
	}
})();
