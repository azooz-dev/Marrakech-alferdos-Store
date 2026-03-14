/**
 * Language Toggle (AR / EN)
 *
 * Toggles between Arabic (RTL) and English (LTR).
 * - Flips `dir` attribute on <html>
 * - Swaps translatable text via `data-en` / `data-ar` attributes
 * - Updates button label
 * - Persists preference in localStorage
 *
 * @package Luxe_Landscape
 */

(function () {
	'use strict';

	var html = document.documentElement;
	var toggleBtn = document.getElementById('lang-toggle');
	var toggleBtnMobile = document.getElementById('lang-toggle-mobile');
	var label = document.getElementById('lang-label');
	var labelMobile = document.getElementById('lang-label-mobile');

	// All translatable elements must have data-en="..." data-ar="..."
	// The toggle swaps textContent between them.

	// Translation map: selector → { en, ar }
	var translations = {
		// Navigation
		'.nav-home': { en: 'Home', ar: 'الرئيسية' },
		'.nav-collections': { en: 'Collections', ar: 'المجموعات' },
		'.nav-wholesale': { en: 'Wholesale', ar: 'الجملة' },
		'.nav-projects': { en: 'Projects', ar: 'المشاريع' },

		// Hero
		'.hero-badge-text': { en: 'DIRECT FROM MANUFACTURER', ar: 'مباشرة من المصنع' },
		'.hero-title-1': { en: 'Transform Your Space with', ar: 'حوّل مساحتك مع' },
		'.hero-title-accent': { en: 'Factory-Direct', ar: 'فخامة المصنع' },
		'.hero-title-2': { en: 'Luxury', ar: 'المباشرة' },
		'.hero-subtitle': { en: 'Experience the pinnacle of biophilic design with our ultra-premium outdoor collections, engineered for the world\'s most prestigious properties.', ar: 'استمتع بقمة التصميم البيوفيلي مع مجموعاتنا الخارجية الفاخرة، المصممة لأرقى العقارات في العالم.' },
		'.hero-cta-shop': { en: 'Shop Collection', ar: 'تسوق المجموعة' },
		'.hero-cta-b2b': { en: 'Request B2B Quote', ar: 'طلب عرض أسعار' },
		'.hero-featured-label': { en: 'Featured Piece', ar: 'القطعة المميزة' },
		'.hero-featured-name': { en: 'The Zenith Fountain', ar: 'نافورة زينيث' },

		// Categories
		'.section-title-categories': { en: 'Explore Our World', ar: 'استكشف عالمنا' },
		'.section-subtitle-categories': { en: 'Curated categories for professional landscaping.', ar: 'فئات منسقة لتنسيق الحدائق الاحترافي.' },
		'.section-link-categories': { en: 'View All Categories', ar: 'عرض جميع الفئات' },

		// Trending
		'.section-title-trending': { en: 'Trending Now', ar: 'الرائج الآن' },

		// Impact
		'.section-title-impact': { en: 'Our Impact in Numbers', ar: 'تأثيرنا بالأرقام' },
		'.section-subtitle-impact': { en: 'Quantifying our commitment to excellence and biophilic growth over the last month.', ar: 'قياس التزامنا بالتميز والنمو البيوفيلي خلال الشهر الماضي.' },
		'.impact-label-1': { en: 'Luxury Projects Completed', ar: 'مشاريع فاخرة مكتملة' },
		'.impact-label-2': { en: 'New Premium Clients', ar: 'عملاء مميزون جدد' },
		'.impact-label-3': { en: 'Products Delivered', ar: 'منتجات تم تسليمها' },
		'.impact-label-4': { en: 'Global Partner Factories', ar: 'مصانع شريكة عالمية' },

		// B2B
		'.b2b-label': { en: 'B2B & Projects', ar: 'الأعمال والمشاريع' },
		'.b2b-title': { en: 'Building a Mega Project? Get Direct Factory Pricing.', ar: 'تبني مشروعاً ضخماً؟ احصل على أسعار المصنع المباشرة.' },
		'.b2b-desc': { en: 'We partner with architects, real estate developers, and hospitality giants to provide bespoke landscaping solutions at scale.', ar: 'نتعاون مع المهندسين المعماريين ومطوري العقارات وعمالقة الضيافة لتقديم حلول تنسيق حدائق مخصصة على نطاق واسع.' },
		'.b2b-stat-label-1': { en: 'Hotel Projects', ar: 'مشاريع فندقية' },
		'.b2b-stat-label-2': { en: 'Contract Life', ar: 'عمر العقد' },
		'.b2b-submit': { en: 'Request Project Quote', ar: 'طلب عرض سعر للمشروع' },

		// Footer
		'.footer-tagline': { en: 'Crafting the future of biophilic luxury with factory-direct ethics and sustainable engineering.', ar: 'نصنع مستقبل الفخامة البيوفيلية بأخلاق المصنع المباشرة والهندسة المستدامة.' },
		'.footer-newsletter-title': { en: 'Subscribe to our Design Journal', ar: 'اشترك في مجلة التصميم' },
		'.footer-newsletter-btn': { en: 'Join', ar: 'اشترك' },
		'.footer-title-collections': { en: 'Collections', ar: 'المجموعات' },
		'.footer-title-support': { en: 'Support', ar: 'الدعم' },
		'.footer-title-social': { en: 'Social', ar: 'التواصل' },
		'.footer-badge-secure': { en: 'Secure Checkout', ar: 'دفع آمن' },
		'.footer-badge-shipping': { en: 'Fast Shipping', ar: 'شحن سريع' },
		'.footer-badge-warranty': { en: 'Year Warranty', ar: 'ضمان سنوات' },
	};

	/**
	 * Apply translations to all elements with matching classes
	 */
	function applyTranslations(lang) {
		Object.keys(translations).forEach(function (selector) {
			var els = document.querySelectorAll(selector);
			els.forEach(function (el) {
				el.textContent = translations[selector][lang];
			});
		});

		// Update placeholders on inputs
		if (lang === 'ar') {
			document.querySelectorAll('input[placeholder="Full Name"]').forEach(function(el) { el.placeholder = 'الاسم الكامل'; });
			document.querySelectorAll('input[placeholder="Project Size (sqm)"]').forEach(function(el) { el.placeholder = 'حجم المشروع (م²)'; });
			document.querySelectorAll('input[placeholder="Phone Number"]').forEach(function(el) { el.placeholder = 'رقم الهاتف'; });
			document.querySelectorAll('textarea[placeholder="Tell us about your project"]').forEach(function(el) { el.placeholder = 'أخبرنا عن مشروعك'; });
			document.querySelectorAll('input[placeholder="email@address.com"]').forEach(function(el) { el.placeholder = 'البريد@الإلكتروني.com'; });
		} else {
			document.querySelectorAll('input[placeholder]').forEach(function(el) {
				var map = {
					'الاسم الكامل': 'Full Name',
					'حجم المشروع (م²)': 'Project Size (sqm)',
					'رقم الهاتف': 'Phone Number',
					'أخبرنا عن مشروعك': 'Tell us about your project',
					'البريد@الإلكتروني.com': 'email@address.com'
				};
				if (map[el.placeholder]) el.placeholder = map[el.placeholder];
			});
			document.querySelectorAll('textarea[placeholder]').forEach(function(el) {
				if (el.placeholder === 'أخبرنا عن مشروعك') el.placeholder = 'Tell us about your project';
			});
		}
	}

	function setLanguage(lang) {
		if (lang === 'ar') {
			html.setAttribute('dir', 'rtl');
			html.setAttribute('lang', 'ar');
			if (label) label.textContent = 'EN';
			if (labelMobile) labelMobile.textContent = 'EN';
		} else {
			html.setAttribute('dir', 'ltr');
			html.setAttribute('lang', 'en');
			if (label) label.textContent = 'AR';
			if (labelMobile) labelMobile.textContent = 'AR';
		}
		applyTranslations(lang);
		localStorage.setItem('lang', lang);

		// Trigger carousel update if it exists
		var scroll = document.getElementById('products-scroll');
		if (scroll) {
			scroll.dispatchEvent(new Event('scroll'));
		}
	}

	function toggleLang() {
		var current = localStorage.getItem('lang') || 'en';
		setLanguage(current === 'en' ? 'ar' : 'en');
	}

	// Init: check saved preference
	var saved = localStorage.getItem('lang');
	if (saved === 'ar') {
		setLanguage('ar');
	}

	// Bind click events
	if (toggleBtn) toggleBtn.addEventListener('click', toggleLang);
	if (toggleBtnMobile) toggleBtnMobile.addEventListener('click', toggleLang);
})();
