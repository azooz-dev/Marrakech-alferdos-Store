<?php
/**
 * Header Layout Partial
 *
 * Floating glassmorphism navigation with dark mode toggle.
 *
 * @package Luxe_Landscape
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> id="root-html" class="light">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php wp_head(); ?>
</head>
<body <?php body_class( 'bg-background-light dark:bg-background-dark font-display text-slate-900 dark:text-slate-100 antialiased dark:text-alabaster' ); ?>>
<?php wp_body_open(); ?>

<!-- Floating Glassmorphism Header -->
<nav class="fixed top-6 left-1/2 -translate-x-1/2 z-50 w-[95%] max-w-7xl" id="site-header">
	<div class="glass rounded-full px-8 py-4 flex items-center justify-between shadow-lg glass-shimmer dark:bg-background-dark/70">
		<div class="flex items-center gap-12">
			<!-- Logo -->
			<a class="flex items-center gap-2 group" href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<?php if ( has_custom_logo() ) : ?>
					<?php the_custom_logo(); ?>
				<?php else : ?>
					<span class="material-symbols-outlined text-primary text-3xl">filter_vintage</span>
					<span class="font-bold text-xl tracking-tighter">LUXE <span class="text-primary/80">LANDSCAPE</span></span>
				<?php endif; ?>
			</a>

			<!-- Primary Navigation -->
			<div class="hidden md:flex items-center gap-8">
				<?php
				if ( has_nav_menu( 'primary' ) ) {
					wp_nav_menu( array(
						'theme_location' => 'primary',
						'container'      => false,
						'items_wrap'     => '%3$s',
						'walker'         => new Luxe_Landscape_Nav_Walker(),
					) );
				} else {
					// Fallback navigation
					?>
					<a class="text-sm font-semibold hover:text-primary transition-colors nav-home" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'luxe-landscape' ); ?></a>
					<a class="text-sm font-semibold hover:text-primary transition-colors nav-collections" href="<?php echo class_exists( 'WooCommerce' ) ? esc_url( wc_get_page_permalink( 'shop' ) ) : '#'; ?>"><?php esc_html_e( 'Collections', 'luxe-landscape' ); ?></a>
					<a class="text-sm font-semibold hover:text-primary transition-colors nav-wholesale" href="#b2b-section"><?php esc_html_e( 'Wholesale', 'luxe-landscape' ); ?></a>
					<a class="text-sm font-semibold hover:text-primary transition-colors nav-projects" href="#impact-stats"><?php esc_html_e( 'Projects', 'luxe-landscape' ); ?></a>
					<?php
				}
				?>
			</div>
		</div>

		<!-- Header Actions -->
		<div class="flex items-center gap-6">
			<!-- Language Toggle (AR/EN) -->
			<button class="text-xs font-bold border border-slate-200 dark:border-slate-700 rounded-full px-3 py-1.5 hover:text-primary hover:border-primary transition-all hidden md:flex items-center gap-1.5" id="lang-toggle" aria-label="<?php esc_attr_e( 'Toggle language', 'luxe-landscape' ); ?>">
				<span class="material-symbols-outlined text-sm">translate</span>
				<span id="lang-label">AR</span>
			</button>
			
			<!-- Dark Mode Toggle -->
			<button class="material-symbols-outlined hover:text-primary transition-colors" id="dark-mode-toggle" aria-label="<?php esc_attr_e( 'Toggle dark mode', 'luxe-landscape' ); ?>">dark_mode</button>

			

			<!-- Search -->
			<!-- <button class="material-symbols-outlined hover:text-primary transition-colors hidden md:block" aria-label="<?php esc_attr_e( 'Search', 'luxe-landscape' ); ?>">search</button> -->

			<!-- Account -->
			<?php if ( class_exists( 'WooCommerce' ) ) : ?>
				<a href="<?php echo esc_url( wc_get_account_endpoint_url( 'dashboard' ) ); ?>" class="material-symbols-outlined hover:text-primary transition-colors hidden md:block" aria-label="<?php esc_attr_e( 'My Account', 'luxe-landscape' ); ?>">person</a>
			<?php else : ?>
				<button class="material-symbols-outlined hover:text-primary transition-colors hidden md:block" aria-label="<?php esc_attr_e( 'Account', 'luxe-landscape' ); ?>">person</button>
			<?php endif; ?>

			<!-- Cart -->
			<?php if ( class_exists( 'WooCommerce' ) ) : ?>
				<a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="relative mt-2" aria-label="<?php esc_attr_e( 'Cart', 'luxe-landscape' ); ?>">
					<span class="material-symbols-outlined hover:text-primary transition-colors">shopping_bag</span>
					<span class="luxe-cart-count absolute -top-1 -right-1 bg-primary text-[10px] font-bold text-white size-4 flex items-center justify-center rounded-full"><?php echo esc_html( WC()->cart->get_cart_contents_count() ); ?></span>
				</a>
			<?php else : ?>
				<div class="relative">
					<button class="material-symbols-outlined hover:text-primary transition-colors">shopping_bag</button>
					<span class="absolute -top-1 -right-1 bg-primary text-[10px] font-bold text-white size-4 flex items-center justify-center rounded-full">0</span>
				</div>
			<?php endif; ?>

			<!-- Mobile Menu Toggle -->
			<button class="material-symbols-outlined md:hidden hover:text-primary transition-colors" id="mobile-menu-open" aria-label="<?php esc_attr_e( 'Open menu', 'luxe-landscape' ); ?>">menu</button>
		</div>
	</div>
</nav>

<!-- Mobile Navigation Overlay -->
<div class="hidden fixed inset-0 bg-white/95 dark:bg-background-dark/95 backdrop-blur-xl z-[100] flex-col items-center justify-center gap-8" id="mobile-nav">
	<button class="absolute top-8 right-8 material-symbols-outlined text-3xl" id="mobile-menu-close" aria-label="<?php esc_attr_e( 'Close menu', 'luxe-landscape' ); ?>">close</button>
	<a class="text-2xl font-bold hover:text-primary transition-colors" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'luxe-landscape' ); ?></a>
	<a class="text-2xl font-bold hover:text-primary transition-colors" href="<?php echo class_exists( 'WooCommerce' ) ? esc_url( wc_get_page_permalink( 'shop' ) ) : '#'; ?>"><?php esc_html_e( 'Collections', 'luxe-landscape' ); ?></a>
	<a class="text-2xl font-bold hover:text-primary transition-colors" href="#b2b-section"><?php esc_html_e( 'Wholesale', 'luxe-landscape' ); ?></a>
	<a class="text-2xl font-bold hover:text-primary transition-colors" href="#impact-stats"><?php esc_html_e( 'Projects', 'luxe-landscape' ); ?></a>
	<!-- Mobile Language Toggle -->
	<button class="text-sm font-bold border border-slate-200 dark:border-slate-700 rounded-full px-5 py-2 hover:text-primary hover:border-primary transition-all flex items-center gap-2 mt-4" id="lang-toggle-mobile" aria-label="<?php esc_attr_e( 'Toggle language', 'luxe-landscape' ); ?>">
		<span class="material-symbols-outlined">translate</span>
		<span id="lang-label-mobile">AR</span>
	</button>
</div>
