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
		'.nav-products': { en: 'Products', ar: 'المنتجات' },

		// Hero
		'.hero-accent-line': { en: 'Direct from Factory', ar: 'مباشرة من المصنع' },
		'.hero-title-1': { en: 'Transform Your Space with', ar: 'حوّل مساحتك مع' },
		'.hero-subtitle': { en: 'Experience the pinnacle of biophilic design with our ultra-premium outdoor collections, engineered for the world\'s most prestigious properties.', ar: 'استمتع بقمة التصميم البيوفيلي مع مجموعاتنا الخارجية الفاخرة، المصممة لأرقى العقارات في العالم.' },
		'.hero-cta-shop': { en: 'Shop Collection', ar: 'تسوق المجموعة' },
		'.hero-cta-b2b': { en: 'Request B2B Quote', ar: 'طلب عرض أسعار' },

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

		// Products Page
		'.products-filter-title': { en: 'Filters', ar: 'التصفية' },
		'.products-cat-label': { en: 'Categories', ar: 'الفئات' },
		'.products-cta-title': { en: 'Bespoke Design', ar: 'تصميم مخصص' },
		'.products-cta-desc': { en: 'Request a personalized landscape consultation with our lead designers.', ar: 'اطلب استشارة تصميم مخصصة مع مصممينا الرئيسيين.' },
		'.products-cta-btn': { en: 'Book Now', ar: 'احجز الآن' },
		'.products-hero-label': { en: 'New Collection 2024', ar: 'مجموعة جديدة 2024' },
		'.products-hero-title': { en: 'Curated Outdoor Elegance', ar: 'أناقة خارجية منتقاة' },
		'.products-hero-desc': { en: 'Elevate your exterior spaces with our hand-carved stone features and rare botanicals.', ar: 'ارتقِ بمساحاتك الخارجية مع منحوتاتنا الحجرية ونباتاتنا النادرة.' },
		'.products-sort-btn-label': { en: 'Sort by: Featured', ar: 'ترتيب حسب: مميز' },
		'.products-avail-btn-label': { en: 'Availability: All', ar: 'التوفر: الكل' },
		'.products-sort-opt-menu_order': { en: 'Featured', ar: 'مميز' },
		'.products-sort-opt-price': { en: 'Price: Low to High', ar: 'السعر: من الأقل إلى الأعلى' },
		'.products-sort-opt-price-desc': { en: 'Price: High to Low', ar: 'السعر: من الأعلى إلى الأقل' },
		'.products-sort-opt-date': { en: 'Newest', ar: 'الأحدث' },
		'.products-stock-opt-all': { en: 'All', ar: 'الكل' },
		'.products-stock-opt-instock': { en: 'In Stock Only', ar: 'المتوفر فقط' },
		'.products-stock-opt-outofstock': { en: 'Out of Stock Only', ar: 'غير المتوفر فقط' },
		'.products-eco-btn': { en: 'Eco-Friendly', ar: 'صديق للبيئة' },

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
		'.product-ar-btn-text': { en: 'View in 3D / AR', ar: 'عرض ثلاثي الأبعاد / AR' },

		// Xootix Auth
		'.auth-btn-login-text': { en: 'Login', ar: 'تسجيل الدخول' },
		'.auth-label-phone-text': { en: 'Phone', ar: 'رقم الهاتف' },
		'.auth-link-change': { en: 'Change?', ar: 'تغيير؟' },

		// My Account — Sidebar
		'.acct-sidebar-heading': { en: 'Account Settings', ar: 'إعدادات الحساب' },
		'.acct-sidebar-profile': { en: 'Profile', ar: 'الملف الشخصي' },
		'.acct-sidebar-orders': { en: 'Orders', ar: 'الطلبات' },
		'.acct-sidebar-favorites': { en: 'Favorites', ar: 'المفضلة' },
		'.acct-sidebar-addresses': { en: 'Addresses', ar: 'العناوين' },
		'.acct-sidebar-logout': { en: 'Logout', ar: 'تسجيل الخروج' },
		'.acct-support-subtitle': { en: 'Need assistance?', ar: 'تحتاج مساعدة؟' },
		'.acct-support-title': { en: 'Concierge Support', ar: 'دعم مخصص' },
		'.acct-support-btn': { en: 'Contact Specialist', ar: 'تواصل مع متخصص' },

		// My Account — Profile
		'.acct-profile-title': { en: 'Personal Information', ar: 'المعلومات الشخصية' },
		'.acct-profile-desc': { en: 'Manage your biophilic sanctuary settings and update your contact preferences for a seamless luxury experience.', ar: 'إدارة إعدادات ملاذك الطبيعي وتحديث تفضيلات الاتصال لتجربة فاخرة سلسة.' },
		'.acct-label-name': { en: 'Full Name', ar: 'الاسم الكامل' },
		'.acct-label-phone': { en: 'Phone Number', ar: 'رقم الهاتف' },
		'.acct-label-email': { en: 'Email Address', ar: 'البريد الإلكتروني' },
		'.acct-verified-badge': { en: 'Verified', ar: 'موثق' },
		'.acct-btn-cancel': { en: 'Cancel', ar: 'إلغاء' },
		'.acct-btn-save': { en: 'Save Changes', ar: 'حفظ التغييرات' },
		'.acct-sec-1-title': { en: 'End-to-End Encryption', ar: 'تشفير شامل' },
		'.acct-sec-1-desc': { en: 'Your personal data is encrypted and never shared with third parties.', ar: 'بياناتك الشخصية مشفرة ولا تتم مشاركتها مع أطراف ثالثة.' },
		'.acct-sec-2-title': { en: 'Biometric Focus', ar: 'التركيز البيومتري' },
		'.acct-sec-2-desc': { en: 'Use your phone to sign in securely without remembering passwords.', ar: 'استخدم هاتفك لتسجيل الدخول بأمان بدون حفظ كلمات المرور.' },
		'.acct-sec-3-title': { en: 'Eco-Account', ar: 'حساب صديق للبيئة' },
		'.acct-sec-3-desc': { en: 'For every update, we contribute to local reforestation efforts.', ar: 'مع كل تحديث، نساهم في جهود إعادة التشجير المحلية.' },

		// My Account — Orders
		'.acct-orders-title': { en: 'Your Orders', ar: 'طلباتك' },
		'.acct-orders-desc': { en: 'Track your biophilic sanctuary acquisitions and manage your premium landscape investments.', ar: 'تتبع مقتنيات ملاذك الطبيعي وأدر استثماراتك الفاخرة في تنسيق الحدائق.' },
		'.acct-tab-all': { en: 'All Orders', ar: 'جميع الطلبات' },
		'.acct-tab-active': { en: 'Active', ar: 'نشطة' },
		'.acct-tab-completed': { en: 'Completed', ar: 'مكتملة' },
		'.acct-order-total-label': { en: 'Total Amount', ar: 'المبلغ الإجمالي' },
		'.acct-btn-view-details': { en: 'View Details', ar: 'عرض التفاصيل' },
		'.acct-btn-track': { en: 'Track Package', ar: 'تتبع الشحنة' },

		// My Account — Favorites
		'.acct-favorites-title': { en: 'Your Favorites', ar: 'مفضلاتك' },
		'.acct-favorites-desc': { en: 'Curate your personal collection of biophilic masterpieces and luxury outdoor accents.', ar: 'اختر مجموعتك الشخصية من التحف الطبيعية ولمسات الرفاهية الخارجية.' },
		'.acct-fav-remove': { en: 'Remove', ar: 'إزالة' },
		'.acct-fav-view': { en: 'View Details', ar: 'عرض التفاصيل' },

		// My Account — Addresses
		'.acct-addresses-title': { en: 'Saved Addresses', ar: 'العناوين المحفوظة' },
		'.acct-addresses-desc': { en: 'Manage your shipping and billing locations for a seamless luxury shopping experience.', ar: 'أدر عناوين الشحن والفوترة لتجربة تسوق فاخرة سلسة.' },
		'.acct-btn-add-address': { en: 'Add New Address', ar: 'إضافة عنوان جديد' },
		'.acct-badge-shipping': { en: 'Primary Shipping', ar: 'الشحن الرئيسي' },
		'.acct-badge-billing': { en: 'Billing Address', ar: 'عنوان الفوترة' },
		'.acct-addr-home-label': { en: 'Home Estate', ar: 'المنزل' },
		'.acct-addr-office-label': { en: 'Studio Office', ar: 'المكتب' },
		'.acct-btn-edit': { en: 'Edit', ar: 'تعديل' },
		'.acct-btn-delete': { en: 'Delete', ar: 'حذف' },
		'.acct-switch-shipping': { en: 'Set as Primary Shipping Address', ar: 'تعيين كعنوان شحن رئيسي' },
		'.acct-switch-billing': { en: 'Set as Billing Address', ar: 'تعيين كعنوان فوترة' },

		// My Account — Address Modal
		'.acct-modal-title': { en: 'Add New Address', ar: 'إضافة عنوان جديد' },
		'.acct-modal-desc': { en: 'Enter your details for biophilic delivery.', ar: 'أدخل بياناتك للتسليم الطبيعي.' },
		'.acct-modal-label-tag': { en: 'Address Label', ar: 'تسمية العنوان' },
		'.acct-modal-label-name': { en: 'Full Name', ar: 'الاسم الكامل' },
		'.acct-modal-label-street': { en: 'Street Address', ar: 'عنوان الشارع' },
		'.acct-modal-label-apt': { en: 'Apartment, suite, etc. (Optional)', ar: 'شقة، جناح، إلخ (اختياري)' },
		'.acct-modal-label-city': { en: 'City', ar: 'المدينة' },
		'.acct-modal-label-state': { en: 'State/Province', ar: 'المنطقة / المحافظة' },
		'.acct-modal-label-postal': { en: 'Postal Code', ar: 'الرمز البريدي' },
		'.acct-modal-label-country': { en: 'Country', ar: 'الدولة' },
		'.acct-modal-save': { en: 'Save Address', ar: 'حفظ العنوان' },
		'.acct-modal-cancel': { en: 'Cancel', ar: 'إلغاء' },
	};

	/**
	 * Apply translations to all elements with matching classes
	 */
	function applyTranslations(lang) {
		// 1. Static Dictionary Translations (for hardcoded template text)
		Object.keys(translations).forEach(function (selector) {
			var els = document.querySelectorAll(selector);
			els.forEach(function (el) {
				el.textContent = translations[selector][lang];
			});
		});

		// 2. Dynamic ACF Data-Attribute Translations 
		// (Finds any element on the page with data-en and data-ar and swaps text)
		var dynamicEls = document.querySelectorAll('[data-en][data-ar]');
		dynamicEls.forEach(function (el) {
			el.textContent = el.getAttribute('data-' + lang);
		});

		// 3. Update placeholders on inputs
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
