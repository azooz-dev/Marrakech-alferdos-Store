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

	var toggle = document.getElementById('dark-mode-toggle');
	var html = document.documentElement;

	if (!toggle) return;

	// Set initial icon based on current state
	if (html.classList.contains('dark')) {
		toggle.textContent = 'light_mode';
	} else {
		toggle.textContent = 'dark_mode';
	}

	toggle.addEventListener('click', function () {
		html.classList.toggle('dark');
		var isDark = html.classList.contains('dark');
		toggle.textContent = isDark ? 'light_mode' : 'dark_mode';
		localStorage.setItem('theme', isDark ? 'dark' : 'light');
	});
})();
