/**
 * Impact Counter
 *
 * Animated count-up numbers for the "Our Impact in Numbers" section.
 * Uses IntersectionObserver to trigger once when scrolled into view.
 *
 * @package Luxe_Landscape
 */

document.addEventListener('DOMContentLoaded', function () {
	'use strict';

	var target = document.getElementById('impact-stats');
	if (!target) return;

	var observer = new IntersectionObserver(function (entries) {
		entries.forEach(function (entry) {
			if (entry.isIntersecting) {
				animateNumbers();
				observer.unobserve(entry.target);
			}
		});
	}, { threshold: 0.5 });

	observer.observe(target);

	function animateNumbers() {
		var stats = document.querySelectorAll('.stat-number');
		stats.forEach(function (stat) {
			var targetValue = parseInt(stat.getAttribute('data-target'), 10);
			var duration = 2000; // 2 seconds
			var startTime = performance.now();

			function update(currentTime) {
				var elapsed = currentTime - startTime;
				var progress = Math.min(elapsed / duration, 1);

				// Ease out quad
				var easeProgress = progress * (2 - progress);

				var currentValue = Math.floor(easeProgress * targetValue);
				stat.textContent = currentValue.toLocaleString();

				if (progress < 1) {
					requestAnimationFrame(update);
				} else {
					stat.textContent = targetValue.toLocaleString();
				}
			}

			requestAnimationFrame(update);
		});
	}
});
