<?php

/**
 * Header Layout Partial
 *
 * Floating glassmorphism navigation with dark mode toggle.
 *
 * @package Luxe_Landscape
 */

if (!defined('ABSPATH')) {
	exit;
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> id="root-html" class="light">

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php wp_head(); ?>
</head>

<body <?php body_class('bg-background-light dark:bg-background-dark font-display text-slate-900 dark:text-slate-100 antialiased dark:text-alabaster'); ?>>
	<?php wp_body_open(); ?>

	<!-- Floating Glassmorphism Header -->
	<nav class="fixed top-6 left-1/2 -translate-x-1/2 z-50 w-[95%] max-w-7xl" id="site-header">
		<div class="glass rounded-full px-8 py-4 flex items-center justify-between shadow-lg glass-shimmer dark:bg-background-dark/70">
			<div class="flex items-center gap-12">
				<!-- Logo -->
				<a class="flex items-center gap-2 group" href="<?php echo esc_url(home_url('/')); ?>">
					<?php if (has_custom_logo()): ?>
						<?php the_custom_logo(); ?>
					<?php
					else: ?>
						<span class="material-symbols-outlined text-primary text-3xl">filter_vintage</span>
					<?php
					endif; ?>
				</a>

				<!-- Primary Navigation -->
				<div class="hidden md:flex items-center gap-8">
					<?php
					if (has_nav_menu('primary')) {
						wp_nav_menu(array(
							'theme_location' => 'primary',
							'container' => false,
							'items_wrap' => '%3$s',
							'walker' => new \Luxe_Landscape_Nav_Walker(),
						));
					} else {
						// Fallback navigation
					?>
						<a class="text-sm font-semibold hover:text-primary transition-colors nav-home" href="<?php echo esc_url(home_url('/')); ?>"><?php pll_e('Home'); ?></a>
						<a class="text-sm font-semibold hover:text-primary transition-colors nav-collections" href="<?php echo class_exists('WooCommerce') ? esc_url(wc_get_page_permalink('shop')) : '#'; ?>"><?php pll_e('Collections'); ?></a>
						<a class="text-sm font-semibold hover:text-primary transition-colors nav-wholesale" href="#b2b-section"><?php pll_e('Wholesale'); ?></a>
						<a class="text-sm font-semibold hover:text-primary transition-colors nav-products" href="<?php echo esc_url(site_url('/products')); ?>"><?php pll_e('Products'); ?></a>
					<?php
					}
					?>
				</div>
			</div>

			<!-- Header Actions -->
			<div class="flex items-center gap-4 md:gap-6">
				<!-- Language Toggle (AR/EN) -->
				<?php if (function_exists('pll_current_language') && function_exists('pll_the_languages')) : ?>
					<?php
					$current_lang = pll_current_language('slug');
					$target_lang  = ('ar' === $current_lang) ? 'en' : 'ar';
					$target_url   = function_exists('pll_home_url') ? pll_home_url($target_lang) : home_url('/');
					$languages    = pll_the_languages(
						array(
							'raw'           => 1,
							'hide_if_empty' => 0,
						)
					);
					if (is_array($languages) && isset($languages[$target_lang]['url'])) {
						$target_url = $languages[$target_lang]['url'];
					}
					?>
					<a class="text-xs font-bold border border-slate-200 dark:border-slate-700 rounded-full px-3 py-1.5 hover:text-primary hover:border-primary transition-all hidden md:flex items-center gap-1.5" href="<?php echo esc_url($target_url); ?>" aria-label="<?php esc_attr_e('Switch language', 'luxe-landscape'); ?>">
						<span class="material-symbols-outlined text-sm">translate</span>
						<span><?php echo esc_html(strtoupper($target_lang)); ?></span>
					</a>
				<?php endif; ?>

				<!-- Dark Mode Toggle -->
				<button class="dark-mode-toggle material-symbols-outlined hover:text-primary transition-colors !hidden md:!block" aria-label="<?php esc_attr_e('Toggle dark mode', 'luxe-landscape'); ?>">dark_mode</button>



				<!-- Search -->
				<!-- <button class="material-symbols-outlined hover:text-primary transition-colors hidden md:block" aria-label="<?php esc_attr_e('Search', 'luxe-landscape'); ?>">search</button> -->

				<!-- Account -->
				<?php if (is_user_logged_in()): ?>
					<?php if (class_exists('WooCommerce')): ?>
						<a href="<?php echo esc_url(wc_get_account_endpoint_url('edit-account')); ?>" class="material-symbols-outlined hover:text-primary transition-colors" aria-label="<?php esc_attr_e('My Account', 'luxe-landscape'); ?>">person</a>
					<?php
					else: ?>
						<button class="material-symbols-outlined hover:text-primary transition-colors" aria-label="<?php esc_attr_e('Account', 'luxe-landscape'); ?>">person</button>
					<?php
					endif; ?>
				<?php
				else: ?>
					<a href="<?php echo esc_url(site_url('/sign-in')); ?>" class="md:hidden material-symbols-outlined hover:text-primary transition-colors" aria-label="<?php esc_attr_e('Sign In', 'luxe-landscape'); ?>">person</a>

				<?php
				endif; ?>

				<!-- Cart -->
				<?php if (class_exists('WooCommerce')): ?>
					<a href="<?php echo esc_url(wc_get_cart_url()); ?>" class="relative mt-2" aria-label="<?php esc_attr_e('Cart', 'luxe-landscape'); ?>">
						<span class="material-symbols-outlined hover:text-primary transition-colors">shopping_bag</span>
						<span class="luxe-cart-count absolute -top-1 -right-1 bg-primary text-[10px] font-bold text-white size-4 flex items-center justify-center rounded-full"><?php echo esc_html(WC()->cart->get_cart_contents_count()); ?></span>
					</a>
				<?php
				else: ?>
					<div class="relative">
						<button class="material-symbols-outlined hover:text-primary transition-colors">shopping_bag</button>
						<span class="absolute -top-1 -right-1 bg-primary text-[10px] font-bold text-white size-4 flex items-center justify-center rounded-full">0</span>
					</div>
				<?php
				endif; ?>

				<!-- Mobile Menu Toggle -->
				<button class="material-symbols-outlined md:hidden hover:text-primary transition-colors" id="mobile-menu-open" aria-label="<?php esc_attr_e('Open menu', 'luxe-landscape'); ?>">menu</button>
			</div>
		</div>
	</nav>

	<!-- Mobile Navigation Overlay -->
	<div class="hidden fixed inset-0 bg-white/95 dark:bg-background-dark/95 backdrop-blur-xl z-[100] flex-col items-center justify-center gap-8" id="mobile-nav">
		<button class="absolute top-8 right-8 material-symbols-outlined text-3xl" id="mobile-menu-close" aria-label="<?php esc_attr_e('Close menu', 'luxe-landscape'); ?>">close</button>
		<a class="text-2xl font-bold hover:text-primary transition-colors" href="<?php echo esc_url(home_url('/')); ?>"><?php pll_e('Home'); ?></a>
		<a class="text-2xl font-bold hover:text-primary transition-colors" href="<?php echo class_exists('WooCommerce') ? esc_url(wc_get_page_permalink('shop')) : '#'; ?>"><?php pll_e('Collections'); ?></a>
		<a class="text-2xl font-bold hover:text-primary transition-colors" href="#b2b-section"><?php pll_e('Wholesale'); ?></a>
		<a class="text-2xl font-bold hover:text-primary transition-colors" href="<?php echo esc_url(site_url('/products')); ?>"><?php pll_e('Products'); ?></a>
		<!-- Mobile Utilities -->
		<div class="flex items-center gap-6 mt-4">
			<!-- Mobile Language Toggle -->
			<?php if (function_exists('pll_current_language') && function_exists('pll_the_languages')) : ?>
				<?php
				$current_lang_mobile = pll_current_language('slug');
				$target_lang_mobile  = ('ar' === $current_lang_mobile) ? 'en' : 'ar';
				$target_url_mobile   = function_exists('pll_home_url') ? pll_home_url($target_lang_mobile) : home_url('/');
				$languages_mobile    = pll_the_languages(
					array(
						'raw'           => 1,
						'hide_if_empty' => 0,
					)
				);
				if (is_array($languages_mobile) && isset($languages_mobile[$target_lang_mobile]['url'])) {
					$target_url_mobile = $languages_mobile[$target_lang_mobile]['url'];
				}
				?>
				<a class="text-sm font-bold border border-slate-200 dark:border-slate-700 rounded-full px-5 py-2 hover:text-primary hover:border-primary transition-all flex items-center gap-2" href="<?php echo esc_url($target_url_mobile); ?>" aria-label="<?php esc_attr_e('Switch language', 'luxe-landscape'); ?>">
					<span class="material-symbols-outlined">translate</span>
					<span><?php echo esc_html(strtoupper($target_lang_mobile)); ?></span>
				</a>
			<?php endif; ?>

			<!-- Mobile Dark Mode Toggle -->
			<button class="dark-mode-toggle material-symbols-outlined hover:text-primary transition-colors text-3xl" aria-label="<?php esc_attr_e('Toggle dark mode', 'luxe-landscape'); ?>">dark_mode</button>
		</div>
	</div>