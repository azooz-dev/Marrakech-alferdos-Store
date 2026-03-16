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

		// Auth Pages
		'.auth-brand': { en: 'Luxe Landscape', ar: 'لاندسكيب الفاخر' },
		'.auth-title-login': { en: 'Welcome Back', ar: 'مرحباً بعودتك' },
		'.auth-subtitle-login': { en: 'Enter your phone number to access your account', ar: 'أدخل رقم هاتفك للوصول إلى حسابك' },
		'.auth-label-phone': { en: 'Phone Number', ar: 'رقم الهاتف' },
		'.auth-btn-login': { en: 'Send OTP', ar: 'إرسال رمز التحقق' },
		'.auth-no-account': { en: 'Don\'t have an account?', ar: 'ليس لديك حساب؟' },
		'.auth-link-signup': { en: 'Sign Up', ar: 'إنشاء حساب' },
		'.auth-title-signup': { en: 'Join Luxe Landscape', ar: 'انضم إلى لاندسكيب الفاخر' },
		'.auth-subtitle-signup': { en: 'Create an account to start your luxury project', ar: 'أنشئ حساباً لبدء مشروعك الفاخر' },
		'.auth-label-name': { en: 'Full Name', ar: 'الاسم الكامل' },
		'.auth-btn-signup': { en: 'Create Account', ar: 'إنشاء حساب' },
		'.auth-agree-1': { en: 'I agree to the', ar: 'أوافق على' },
		'.auth-agree-2': { en: 'and', ar: 'و' },
		'.auth-has-account': { en: 'Already have an account?', ar: 'لديك حساب بالفعل؟' },
		'.auth-link-signin': { en: 'Sign In', ar: 'تسجيل الدخول' },
		'.auth-footer-1': { en: 'Privacy Policy', ar: 'سياسة الخصوصية' },
		'.auth-footer-2': { en: 'Terms of Service', ar: 'شروط الخدمة' },
		'.auth-footer-3': { en: 'Support', ar: 'الدعم' },

		// Projects Page
		'.projects-filter-title': { en: 'Filters', ar: 'التصفية' },
		'.projects-cat-label': { en: 'Categories', ar: 'الفئات' },
		'.projects-cta-title': { en: 'Bespoke Design', ar: 'تصميم مخصص' },
		'.projects-cta-desc': { en: 'Request a personalized landscape consultation with our lead designers.', ar: 'اطلب استشارة تصميم مخصصة مع مصممينا الرئيسيين.' },
		'.projects-cta-btn': { en: 'Book Now', ar: 'احجز الآن' },
		'.projects-hero-label': { en: 'New Collection 2024', ar: 'مجموعة جديدة 2024' },
		'.projects-hero-title': { en: 'Curated Outdoor Elegance', ar: 'أناقة خارجية منتقاة' },
		'.projects-hero-desc': { en: 'Elevate your exterior spaces with our hand-carved stone features and rare botanicals.', ar: 'ارتقِ بمساحاتك الخارجية مع منحوتاتنا الحجرية ونباتاتنا النادرة.' },
		'.projects-sort-btn': { en: 'Sort by: Featured', ar: 'ترتيب: مميز' },
		'.projects-avail-btn': { en: 'Availability', ar: 'التوفر' },
		'.projects-eco-btn': { en: 'Eco-Friendly', ar: 'صديق للبيئة' },

		// Single Product Page
		'.product-stock-badge': { en: 'In Stock', ar: 'متوفر' },
		'.product-feat-1': { en: '100% Natural Material', ar: '100٪ مواد طبيعية' },
		'.product-feat-2': { en: 'Low-Voltage Pump', ar: 'مضخة منخفضة الجهد' },
		'.product-add-to-cart-text': { en: 'Add to Cart', ar: 'أضف إلى السلة' },
		'.product-out-of-stock-text': { en: 'Out of Stock', ar: 'غير متوفر' },
		'.product-sustain-title': { en: 'Sustainability Footprint', ar: 'البصمة البيئية' },
		'.product-sustain-1': { en: 'Recycled Water Use', ar: 'استخدام المياه المعاد تدويرها' },
		'.product-sustain-2': { en: 'CO2 Offset / Unit', ar: 'تعويض الكربون / وحدة' },
		'.product-specs-title': { en: 'Technical Specifications', ar: 'المواصفات الفنية' },
		'.product-spec-label-1': { en: 'Dimensions', ar: 'الأبعاد' },
		'.product-spec-label-2': { en: 'Material', ar: 'المادة' },
		'.product-spec-label-3': { en: 'Weight', ar: 'الوزن' },
		'.product-spec-label-4': { en: 'Quality', ar: 'الجودة' },
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
			document.querySelectorAll('input[placeholder="Enter your full name"]').forEach(function(el) { el.placeholder = 'أدخل اسمك الكامل'; });
			document.querySelectorAll('input[placeholder="Project Size (sqm)"]').forEach(function(el) { el.placeholder = 'حجم المشروع (م²)'; });
			document.querySelectorAll('input[placeholder="Phone Number"]').forEach(function(el) { el.placeholder = 'رقم الهاتف'; });
			document.querySelectorAll('textarea[placeholder="Tell us about your project"]').forEach(function(el) { el.placeholder = 'أخبرنا عن مشروعك'; });
			document.querySelectorAll('input[placeholder="email@address.com"]').forEach(function(el) { el.placeholder = 'البريد@الإلكتروني.com'; });
		} else {
			document.querySelectorAll('input[placeholder]').forEach(function(el) {
				var map = {
					'الاسم الكامل': 'Full Name',
					'أدخل اسمك الكامل': 'Enter your full name',
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
