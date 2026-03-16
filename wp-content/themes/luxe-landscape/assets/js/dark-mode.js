/**
 * Dark Mode Toggle
 *
 * Toggles dark class on <html>, persists to localStorage,
 * respects prefers-color-scheme.
 *
 * @package Luxe_Landscape
 */

(function () {
	'use strict';

	var toggles = document.querySelectorAll('.dark-mode-toggle');
	var html = document.documentElement;

	if (!toggles.length) return;

	toggles.forEach(function(toggle) {
		// Set initial icon based on current state
		if (html.classList.contains('dark')) {
			toggle.textContent = 'light_mode';
		} else {
			toggle.textContent = 'dark_mode';
		}

		toggle.addEventListener('click', function () {
			html.classList.toggle('dark');
			var isDark = html.classList.contains('dark');
			var newText = isDark ? 'light_mode' : 'dark_mode';
			
			toggles.forEach(function(t) {
				t.textContent = newText;
			});
			
			localStorage.setItem('theme', isDark ? 'dark' : 'light');
		});
	});
})();
