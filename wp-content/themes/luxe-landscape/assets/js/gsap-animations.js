/**
 * GSAP Animations
 *
 * Hero entrance stagger, parallax scroll on hero image,
 * mouse-follow effect on glass header.
 *
 * Requires: GSAP + ScrollTrigger (enqueued as dependencies)
 *
 * @package Luxe_Landscape
 */

document.addEventListener('DOMContentLoaded', function () {
	'use strict';

	if (typeof gsap === 'undefined') return;

	gsap.registerPlugin(ScrollTrigger);

	// =============================================
	// Hero Entrance Animation
	// =============================================
	gsap.to('.hero-animate-in', {
		opacity: 1,
		y: 0,
		duration: 1.2,
		stagger: 0.2,
		ease: 'power4.out',
		delay: 0.5
	});

	// =============================================
	// Parallax Effect on Hero Image
	// =============================================
	var heroImg = document.getElementById('hero-parallax-img');
	if (heroImg) {
		gsap.to(heroImg, {
			yPercent: 15,
			ease: 'none',
			scrollTrigger: {
				trigger: heroImg.closest('section'),
				start: 'top top',
				end: 'bottom top',
				scrub: true
			}
		});
	}

	// =============================================
	// Mouse-Follow Effect on Glass Header
	// =============================================
	var header = document.querySelector('#site-header .glass');
	if (header) {
		document.addEventListener('mousemove', function (e) {
			var xPos = (e.clientX / window.innerWidth - 0.5) * 10;
			var yPos = (e.clientY / window.innerHeight - 0.5) * 10;
			gsap.to(header, {
				x: xPos,
				y: yPos,
				duration: 1,
				ease: 'power2.out'
			});
		});
	}
});
