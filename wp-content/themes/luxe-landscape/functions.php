<?php

/**
 * Luxe Landscape Theme Functions
 *
 * @package Luxe_Landscape
 * @version 2.0.0
 */

if (!defined('ABSPATH')) {
	exit;
}

/* ============================================
 THEME SETUP
 ============================================ */
add_action('after_setup_theme', 'luxe_landscape_setup');
function luxe_landscape_setup()
{
	add_theme_support('title-tag');
	add_theme_support('post-thumbnails');
	add_theme_support('custom-logo');
	add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script'));

	// WooCommerce
	add_theme_support('woocommerce');
	add_theme_support('wc-product-gallery-zoom');
	add_theme_support('wc-product-gallery-lightbox');
	add_theme_support('wc-product-gallery-slider');

	// Navigation menus
	register_nav_menus(array(
		'primary' => __('Primary Navigation', 'luxe-landscape'),
		'footer-collections' => __('Footer Collections', 'luxe-landscape'),
		'footer-support' => __('Footer Support', 'luxe-landscape'),
	));
}

/* ============================================
 CUSTOM HEADER/FOOTER FROM layout/ DIRECTORY
 ============================================ */
function luxe_landscape_get_header()
{
	load_template(get_template_directory() . '/layout/header.php');
}

function luxe_landscape_get_footer()
{
	load_template(get_template_directory() . '/layout/footer.php');
}

/* ============================================
 ENQUEUE STYLES
 ============================================ */
add_action('wp_enqueue_scripts', 'luxe_landscape_styles');
function luxe_landscape_styles()
{
	$theme_version = wp_get_theme()->get('Version');
	$theme_uri = get_template_directory_uri();

	// Google Fonts
	wp_enqueue_style(
		'luxe-google-fonts',
		'https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&family=IBM+Plex+Sans+Arabic:wght@300;400;500;600;700&family=Outfit:wght@300;400;500&display=swap',
		array(),
		null
	);

	// Material Symbols
	wp_enqueue_style(
		'luxe-material-symbols',
		'https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap',
		array(),
		null
	);

	// Tailwind CSS (Compiled)
	wp_enqueue_style('luxe-output', $theme_uri . '/assets/css/output.css', array(), $theme_version);

	// Theme CSS — effects (global)
	wp_enqueue_style(
		'luxe-effects',
		$theme_uri . '/assets/css/effects.css',
		array(),
		$theme_version
	);

	// WooCommerce CSS — only on WC pages
	if (class_exists('WooCommerce')) {
		wp_enqueue_style(
			'luxe-woocommerce',
			$theme_uri . '/assets/css/woocommerce.css',
			array(),
			$theme_version
		);
	}

	// RTL overrides — load always but scoped with [dir="rtl"] in CSS
	wp_enqueue_style(
		'luxe-rtl',
		$theme_uri . '/assets/css/rtl-overrides.css',
		array(),
		$theme_version
	);

	// Enqueue intl-tel-input CSS from miniOrange plugin
	if (is_page('sign-in') || is_page('sign-up')) {
		$plugin_dir_url = plugins_url('miniorange-otp-verification/');
		wp_enqueue_style('intl-tel-input', $plugin_dir_url . 'includes/css/intlTelInput.min.css', array(), '1.0.0');
	}
}

/* ============================================
 ENQUEUE SCRIPTS
 ============================================ */
add_action('wp_enqueue_scripts', 'luxe_landscape_scripts');
function luxe_landscape_scripts()
{
	$theme_version = wp_get_theme()->get('Version');
	$theme_uri = get_template_directory_uri();

	// GSAP + ScrollTrigger (from CDN)
	wp_enqueue_script('gsap', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js', array(), '3.12.2', true);
	wp_enqueue_script('gsap-scroll-trigger', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js', array('gsap'), '3.12.2', true);

	// Global JS
	wp_enqueue_script('luxe-header', $theme_uri . '/assets/js/header.js', array(), $theme_version, true);
	wp_enqueue_script('luxe-dark-mode', $theme_uri . '/assets/js/dark-mode.js', array(), $theme_version, true);
	wp_enqueue_script('luxe-smooth-scroll', $theme_uri . '/assets/js/smooth-scroll.js', array(), $theme_version, true);

	// Front page only JS
	if (is_front_page()) {
		wp_enqueue_script('luxe-gsap-animations', $theme_uri . '/assets/js/gsap-animations.js', array('gsap', 'gsap-scroll-trigger'), $theme_version, true);
		wp_enqueue_script('luxe-impact-counter', $theme_uri . '/assets/js/impact-counter.js', array(), $theme_version, true);
		wp_enqueue_script('luxe-carousel', $theme_uri . '/assets/js/carousel.js', array(), $theme_version, true);
	}

	// Products archive filter dropdowns
	if (function_exists('is_shop') && (is_shop() || is_product_category())) {
		wp_enqueue_script('luxe-products-filter', $theme_uri . '/assets/js/products-filter.js', array(), $theme_version, true);
	}

	// Enqueue intl-tel-input JS and init script
	if (is_page('sign-in') || is_page('sign-up')) {
		$plugin_dir_url = plugins_url('miniorange-otp-verification/');
		wp_enqueue_script('intl-tel-input', $plugin_dir_url . 'includes/js/intlTelInput.min.js', array('jquery'), '1.0.0', true);
		wp_enqueue_script('luxe-auth-phone', $theme_uri . '/assets/js/auth-phone.js', array('intl-tel-input', 'jquery'), $theme_version, true);
		wp_localize_script('luxe-auth-phone', 'luxePhoneData', array(
			'utilsUrl' => $plugin_dir_url . 'includes/js/intlTelInput.min.js'
		));
	}

	// WooCommerce AJAX & Auth Data
	if (class_exists('WooCommerce')) {
		$ajax_data = array(
			'ajaxUrl' => admin_url('admin-ajax.php'),
			'nonce' => wp_create_nonce('luxe_nonce'),
			'isRTL' => is_rtl(),
		);
		wp_localize_script('luxe-header', 'luxeAjax', $ajax_data);
	}
}

/* ============================================
 DARK MODE: Add class to <html> tag
 ============================================ */
add_action('wp_head', 'luxe_landscape_dark_mode_init', 0);
function luxe_landscape_dark_mode_init()
{
?>
	<script>
		(function() {
			var theme = localStorage.getItem('theme');
			if (theme === 'dark' || (!theme && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
				document.documentElement.classList.add('dark');
			}
		})();
	</script>
<?php
}

/* ============================================
 WOOCOMMERCE CUSTOMIZATIONS
 ============================================ */
if (class_exists('WooCommerce')) {
	// Remove default WC wrappers
	remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
	remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

	// Custom wrappers
	add_action('woocommerce_before_main_content', function () {
		echo '<main class="wc-main">';
	}, 10);
	add_action('woocommerce_after_main_content', function () {
		echo '</main>';
	}, 10);

	// Products per row + per page
	add_filter('loop_shop_columns', function () {
		return 3;
	});
	add_filter('loop_shop_per_page', function () {
		return 12;
	});

	// Remove native WooCommerce sorting dropdown from shop/category archives
	remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
	// Remove native WooCommerce result count text (e.g. "Showing the single result")
	remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);

	// Remove sidebar
	remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
}

/* ============================================
 PRODUCTS ARCHIVE STOCK FILTER
 ============================================ */
add_action('pre_get_posts', 'luxe_filter_products_by_stock');
function luxe_filter_products_by_stock($query)
{
	if (is_admin() || ! $query->is_main_query() || ! class_exists('WooCommerce')) {
		return;
	}

	if (!(function_exists('is_shop') && (is_shop() || is_product_category()))) {
		return;
	}

	$stock = isset($_GET['stock']) ? sanitize_text_field(wp_unslash($_GET['stock'])) : '';
	if ($stock !== 'instock' && $stock !== 'outofstock') {
		return;
	}

	$meta_query = (array) $query->get('meta_query');
	$meta_query[] = array(
		'key'     => '_stock_status',
		'value'   => $stock,
		'compare' => '=',
	);

	$query->set('meta_query', $meta_query);
}

/* ============================================
 AJAX CART FRAGMENT (Dynamic cart count)
 ============================================ */
add_filter('woocommerce_add_to_cart_fragments', 'luxe_landscape_cart_count_fragment');
function luxe_landscape_cart_count_fragment($fragments)
{
	if (class_exists('WooCommerce')) {
		$count = WC()->cart->get_cart_contents_count();
		$fragments['.luxe-cart-count'] = '<span class="luxe-cart-count absolute -top-1 -right-1 bg-primary text-[10px] font-bold text-white size-4 flex items-center justify-center rounded-full">' . esc_html($count) . '</span>';
	}
	return $fragments;
}

/* ============================================
 CUSTOM NAV WALKER
 ============================================ */
class Luxe_Landscape_Nav_Walker extends Walker_Nav_Menu
{
	public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
	{
		$output .= '<a class="text-sm font-semibold hover:text-primary transition-colors" href="' . esc_url($item->url) . '">' . esc_html($item->title) . '</a>';
	}

	public function start_lvl(&$output, $depth = 0, $args = null) {}
	public function end_lvl(&$output, $depth = 0, $args = null) {}
}

/* ============================================
 ROUTE PROTECTION & REDIRECTS
 ============================================ */
add_action('template_redirect', 'luxe_landscape_protect_routes');
function luxe_landscape_protect_routes()
{
	// If the user IS logged in...
	if (is_user_logged_in()) {
		// Prevent them from visiting the custom Sign In or Sign Up pages
		if (is_page_template('template-signin.php') || is_page_template('template-signup.php') || is_page('sign-in') || is_page('sign-up')) {
			$redirect = class_exists('WooCommerce') ? wc_get_account_endpoint_url('edit-account') : home_url('/');
			wp_safe_redirect($redirect);
			exit;
		}
	}
	// If the user IS NOT logged in (Guest)...
	else {
		if (class_exists('WooCommerce')) {
			// Prevent them from visiting the My Account page
			if (is_account_page()) {
				wp_safe_redirect(home_url('/sign-in'));
				exit;
			}
		}
	}
}

/* ============================================
 WOOCOMMERCE MY ACCOUNT CUSTOMIZATION
 ============================================ */
if (class_exists('WooCommerce')) {
	// 1. Register custom "favorites" endpoint
	add_action('init', function () {
		add_rewrite_endpoint('favorites', EP_ROOT | EP_PAGES);

		// Flush rewrite rules on registration to ensure the new endpoint works
		if (!get_option('luxe_favorites_endpoint_flushed')) {
			flush_rewrite_rules();
			update_option('luxe_favorites_endpoint_flushed', 1);
		}
	});

	add_filter('query_vars', function ($vars) {
		$vars[] = 'favorites';
		return $vars;
	}, 10);

	// 1b. Ensure WooCommerce recognizes it
	add_filter('woocommerce_get_query_vars', function ($vars) {
		$vars['favorites'] = 'favorites';
		return $vars;
	});

	// 2. Override My Account menu items to match Stitch sidebar
	add_filter('woocommerce_account_menu_items', function ($items) {
		$new_items = array(
			'edit-account' => __('Profile', 'luxe-landscape'),
			'orders' => __('Orders', 'luxe-landscape'),
			'favorites' => __('Favorites', 'luxe-landscape'),
			'edit-address' => __('Addresses', 'luxe-landscape'),
			'customer-logout' => __('Logout', 'luxe-landscape'),
		);
		return $new_items;
	});

	// 3. Redirect dashboard to edit-account (profile)
	add_action('template_redirect', function () {
		global $wp_query;
		$is_favorites = isset($wp_query->query_vars['favorites']);

		if (is_account_page() && !is_wc_endpoint_url() && !$is_favorites && is_user_logged_in()) {
			wp_safe_redirect(wc_get_account_endpoint_url('edit-account'));
			exit;
		}
	}, 1);

	// 4. Add favorites endpoint content
	add_action('woocommerce_account_favorites_endpoint', function () {
		load_template(get_template_directory() . '/pages/account-favorites.php');
	});

	// 5. Enqueue account.js on My Account pages
	add_action('wp_enqueue_scripts', function () {
		if (is_account_page()) {
			$theme_uri = get_template_directory_uri();
			$theme_version = wp_get_theme()->get('Version');
			wp_enqueue_script('luxe-account', $theme_uri . '/assets/js/account.js', array(), $theme_version, true);
		}
	});
}

// Rename WooCommerce Labels
add_filter('gettext', function ($translated_text, $text, $domain) {
	if ($domain === 'woocommerce') {
		switch ($text) {
			case 'Username or email address':
				$translated_text = 'Phone Number';
				break;
			case 'Email address':
				$translated_text = 'Phone Number';
				break;
		}
	}
	return $translated_text;
}, 20, 3);

/* ============================================
 CUSTOMIZER: Footer Settings
 ============================================ */
add_action('customize_register', 'luxe_landscape_footer_customizer');
function luxe_landscape_footer_customizer($wp_customize)
{
	// --- Section ---
	$wp_customize->add_section('luxe_footer_settings', array(
		'title' => __('Footer Settings', 'luxe-landscape'),
		'priority' => 160,
	));

	// --- Tagline ---
	$wp_customize->add_setting('luxe_footer_tagline', array(
		'default' => 'Crafting the future of biophilic luxury with factory-direct ethics and sustainable engineering.',
		'sanitize_callback' => 'sanitize_text_field',
	));
	$wp_customize->add_control('luxe_footer_tagline', array(
		'type' => 'textarea',
		'section' => 'luxe_footer_settings',
		'label' => __('Footer Tagline', 'luxe-landscape'),
	));

	// --- Social Links ---
	$socials = array(
		'instagram' => 'Instagram URL',
		'pinterest' => 'Pinterest URL',
		'linkedin' => 'LinkedIn URL',
		'youtube' => 'YouTube URL',
	);
	foreach ($socials as $key => $label_text) {
		$wp_customize->add_setting('luxe_footer_social_' . $key, array(
			'default' => '#',
			'sanitize_callback' => 'esc_url_raw',
		));
		$wp_customize->add_control('luxe_footer_social_' . $key, array(
			'type' => 'url',
			'section' => 'luxe_footer_settings',
			'label' => __($label_text, 'luxe-landscape'),
		));
	}

	// --- Newsletter Form Action URL ---
	$wp_customize->add_setting('luxe_footer_newsletter_url', array(
		'default' => '#',
		'sanitize_callback' => 'esc_url_raw',
	));
	$wp_customize->add_control('luxe_footer_newsletter_url', array(
		'type' => 'url',
		'section' => 'luxe_footer_settings',
		'label' => __('Newsletter Form Action URL (e.g. Mailchimp)', 'luxe-landscape'),
	));
}

/* ============================================
 CUSTOMIZER: Homepage Settings
 ============================================ */
add_action('customize_register', 'luxe_landscape_homepage_customizer');
function luxe_landscape_homepage_customizer($wp_customize)
{
	$wp_customize->add_section('luxe_homepage_settings', array(
		'title'    => __('Homepage Dynamic Content', 'luxe-landscape'),
		'priority' => 165,
	));

	// --- Hero: background video ---
	$wp_customize->add_setting('luxe_hero_video', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	));
	$wp_customize->add_control(new WP_Customize_Upload_Control($wp_customize, 'luxe_hero_video', array(
		'label'       => __('Hero Background Video', 'luxe-landscape'),
		'description' => __('Upload an MP4 video for the homepage hero background.', 'luxe-landscape'),
		'section'     => 'luxe_homepage_settings',
	)));

	// --- Impact Stats (4 numbers) ---
	$impact_defaults = array(120, 45, 1250, 8);
	for ($i = 1; $i <= 4; $i++) {
		$wp_customize->add_setting('luxe_impact_' . $i, array(
			'default'           => $impact_defaults[$i - 1],
			'sanitize_callback'  => 'absint',
		));
		$wp_customize->add_control('luxe_impact_' . $i, array(
			'type'    => 'number',
			'section' => 'luxe_homepage_settings',
			'label'   => sprintf(__('Impact Stat %d', 'luxe-landscape'), $i),
			'input_attrs' => array('min' => 0, 'step' => 1),
		));
	}

	// --- B2B Stats (2 values) ---
	$wp_customize->add_setting('luxe_b2b_stat_1', array(
		'default'           => '500+',
		'sanitize_callback' => 'sanitize_text_field',
	));
	$wp_customize->add_control('luxe_b2b_stat_1', array(
		'type'    => 'text',
		'section' => 'luxe_homepage_settings',
		'label'   => __('B2B Stat 1 (e.g. 500+)', 'luxe-landscape'),
	));
	$wp_customize->add_setting('luxe_b2b_stat_2', array(
		'default'           => '15yr',
		'sanitize_callback' => 'sanitize_text_field',
	));
	$wp_customize->add_control('luxe_b2b_stat_2', array(
		'type'    => 'text',
		'section' => 'luxe_homepage_settings',
		'label'   => __('B2B Stat 2 (e.g. 15yr)', 'luxe-landscape'),
	));
}

/* ============================================
 B2B FORM HANDLER (admin_post)
 ============================================ */
add_action('admin_post_nopriv_luxe_b2b_submit', 'luxe_handle_b2b_submit');
add_action('admin_post_luxe_b2b_submit', 'luxe_handle_b2b_submit');
function luxe_handle_b2b_submit()
{
	if (!isset($_POST['luxe_b2b_nonce']) || !wp_verify_nonce($_POST['luxe_b2b_nonce'], 'luxe_b2b_submit')) {
		wp_safe_redirect(add_query_arg('luxe_b2b', 'error', home_url('/')));
		exit;
	}
	$name         = isset($_POST['luxe_b2b_name']) ? sanitize_text_field(wp_unslash($_POST['luxe_b2b_name'])) : '';
	$project_size = isset($_POST['luxe_b2b_project_size']) ? sanitize_text_field(wp_unslash($_POST['luxe_b2b_project_size'])) : '';
	$phone        = isset($_POST['luxe_b2b_phone']) ? sanitize_text_field(wp_unslash($_POST['luxe_b2b_phone'])) : '';
	$message      = isset($_POST['luxe_b2b_message']) ? sanitize_textarea_field(wp_unslash($_POST['luxe_b2b_message'])) : '';

	if (empty($name) || empty($phone)) {
		wp_safe_redirect(add_query_arg('luxe_b2b', 'invalid', home_url('/')));
		exit;
	}

	$subject = sprintf(__('B2B Quote Request from %s', 'luxe-landscape'), get_bloginfo('name'));
	$body    = sprintf(
		"%s: %s\n%s: %s\n%s: %s\n%s:\n%s",
		__('Name', 'luxe-landscape'),
		$name,
		__('Project Size (sqm)', 'luxe-landscape'),
		$project_size,
		__('Phone', 'luxe-landscape'),
		$phone,
		__('Message', 'luxe-landscape'),
		wp_strip_all_tags($message)
	);
	wp_mail(get_option('admin_email'), $subject, $body);

	wp_safe_redirect(add_query_arg('luxe_b2b', 'success', home_url('/')));
	exit;
}

/* ============================================
 POLYLANG STRING TRANSLATIONS
 ============================================ */
if (!function_exists('pll__')) {
	function pll__($string)
	{
		return __($string, 'luxe-landscape');
	}
}

if (!function_exists('pll_e')) {
	function pll_e($string)
	{
		echo esc_html(pll__($string));
	}
}

add_action('init', 'luxe_landscape_register_polylang_strings', 20);
function luxe_landscape_register_polylang_strings()
{
	if (!function_exists('pll_register_string')) {
		return;
	}

	$groups = array(
		'Header' => array(
			'Home',
			'Collections',
			'Wholesale',
			'Products',
			'Switch language',
			'Toggle dark mode',
			'My Account',
			'Account',
			'Sign In',
			'Cart',
			'Open menu',
			'Close menu',
		),
		'Home Hero' => array(
			'Direct from Factory',
			'Transform Your Space with',
			'Maraken alferdos',
			'Luxury',
			'Experience the pinnacle of biophilic design with our ultra-premium outdoor collections, engineered for the world\'s most prestigious properties.',
			'Shop Collection',
			'Request B2B Quote',
			'Featured Piece',
			'Luxury garden setup',
			'Set featured product in Customizer → Homepage Settings.',
			'Featured Piece',
			'Luxury garden setup',
			'Set featured product in Customizer → Homepage Settings.',
			'Featured Piece',
			'Luxury garden setup',
			'Set featured product in Customizer → Homepage Settings.',
			'Featured Piece',
			'Luxury garden setup',
			'Set featured product in Customizer → Homepage Settings.',
			'Featured Piece',
			'Luxury garden setup',
			'Set featured product in Customizer → Homepage Settings.',
		),
		'Home Categories' => array(
			'Explore Our World',
			'Curated categories for professional landscaping.',
			'View All Categories',
			'Products',
			'Add product categories in WooCommerce to display them here.',
			'Illuminated Planters',
			'Modern Fountains',
			'Collection 2024',
			'Garden Seating',
			'Stone Waterfalls',
		),
		'Home Trending' => array(
			'Trending Now',
			'Previous',
			'Next',
			'Add products in WooCommerce to display them here.',
			'SALE',
			'Add to cart',
		),
		'Home Impact' => array(
			'Our Impact in Numbers',
			'Quantifying our commitment to excellence and biophilic growth over the last month.',
			'Luxury Projects Completed',
			'New Premium Clients',
			'Products Delivered',
			'Global Partner Factories',
		),
		'Home B2B' => array(
			'B2B & Projects',
			'Building a Mega Project? Get Direct Factory Pricing.',
			'We partner with architects, real estate developers, and hospitality giants to provide bespoke landscaping solutions at scale.',
			'Hotel Projects',
			'Contract Life',
			'Full Name',
			'Project Size (sqm)',
			'Phone Number',
			'Tell us about your project',
			'Request Project Quote',
			'Thank you, we\'ll contact you soon.',
			'Please fill in your name and phone.',
			'Something went wrong. Please try again.',
		),
		'Products Page' => array(
			'Filters',
			'Categories',
			'All Collections',
			'Bespoke Design',
			'Request a personalized landscape consultation with our lead designers.',
			'Book Now',
			'New Collection 2024',
			'Curated Outdoor Elegance',
			'Elevate your exterior spaces with our hand-carved stone features and rare botanicals.',
			'products',
			'Sort by: %s',
			'Availability: %s',
			'Eco-Friendly',
			'Featured',
			'Price: Low to High',
			'Price: High to Low',
			'Newest',
			'All',
			'In Stock Only',
			'Out of Stock Only',
		),
		'Single Product' => array(
			'In Stock',
			'Out of Stock',
			'Quantity',
			'100% Natural Material',
			'Low-Voltage Pump',
			'Add to Cart',
			'View in 3D / AR',
			'SKU:',
			'Category:',
			'Sustainability Footprint',
			'Recycled Water Use',
			'CO2 Offset / Unit',
			'Technical Specifications',
			'Dimensions',
			'Material',
			'Weight',
			'Quality',
			'Premium Grade',
			'Handcrafted',
			'N/A',
			'You May Also Like',
			'Sale',
		),
		'Footer' => array(
			'LUXE LANDSCAPE',
			'Crafting the future of biophilic luxury with factory-direct ethics and sustainable engineering.',
			'Subscribe to our Design Journal',
			'Join',
			'Support',
			'Social',
			'Outdoor Sculptures',
			'Vertical Gardens',
			'Water Features',
			'Premium Soil',
			'Track Order',
			'Wholesale Portal',
			'Warranty Policy',
			'Contact Expert',
			'Secure Checkout',
			'Fast Shipping',
			'10 Year Warranty',
			'Luxe Landscape Factory Group. All rights reserved.',
		),
	);

	foreach ($groups as $group => $strings) {
		foreach ($strings as $string) {
			pll_register_string($group . ': ' . $string, $string, $group);
		}
	}
}

add_filter('gettext', 'luxe_landscape_polylang_gettext_bridge', 15, 3);
function luxe_landscape_polylang_gettext_bridge($translated_text, $text, $domain)
{
	if ($domain !== 'luxe-landscape' || !function_exists('pll__')) {
		return $translated_text;
	}

	return pll__($text);
}
