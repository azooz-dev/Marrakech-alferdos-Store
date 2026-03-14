/**
 * Carousel
 *
 * Arrow navigation for Trending Products carousel.
 *
 * @package Luxe_Landscape
 */

(function () {
	'use strict';

	var scrollContainer = document.getElementById('products-scroll');
	var prevBtn = document.getElementById('trending-prev');
	var nextBtn = document.getElementById('trending-next');

	if (!scrollContainer || !prevBtn || !nextBtn) return;

	// Card width (320px) + gap (2rem = 32px)
	var scrollAmount = 352;

	function updateArrowStates() {
		var isRTL = document.documentElement.dir === 'rtl';
		var maxScroll = scrollContainer.scrollWidth - scrollContainer.clientWidth;
		var scrollLeft = scrollContainer.scrollLeft;

		if (isRTL) {
			// In RTL, scrollLeft is 0 at start (right) and negative when scrolling left
			// Some browsers might differ, but Chrome/Firefox use negative values
			prevBtn.disabled = scrollLeft >= -5;
			nextBtn.disabled = scrollLeft <= -maxScroll + 5;
		} else {
			prevBtn.disabled = scrollLeft <= 5;
			nextBtn.disabled = scrollLeft >= maxScroll - 5;
		}
	}

	prevBtn.addEventListener('click', function () {
		var isRTL = document.documentElement.dir === 'rtl';
		scrollContainer.scrollBy({ 
			left: isRTL ? scrollAmount * 2 : -scrollAmount * 2, 
			behavior: 'smooth' 
		});
	});

	nextBtn.addEventListener('click', function () {
		var isRTL = document.documentElement.dir === 'rtl';
		scrollContainer.scrollBy({ 
			left: isRTL ? -scrollAmount * 2 : scrollAmount * 2, 
			behavior: 'smooth' 
		});
	});

	scrollContainer.addEventListener('scroll', updateArrowStates, { passive: true });

	// Initial state
	updateArrowStates();
})();
