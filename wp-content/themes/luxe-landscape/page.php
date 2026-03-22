<?php
/**
 * Default Page Template
 *
 * Renders WordPress pages with the_content() so shortcodes
 * (like WooCommerce's [woocommerce_my_account]) work properly.
 *
 * @package Luxe_Landscape
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

luxe_landscape_get_header();

// Cart (and similar WC pages) render via shortcode inside the page: keep full width so
// the theme footer matches other pages (not trapped inside max-w-7xl).
$luxe_is_cart = function_exists('is_cart') && is_cart();
$main_classes = $luxe_is_cart
	? 'w-full max-w-none py-6 lg:py-10'
	: 'max-w-7xl mx-auto px-6 py-32';
?>

<main id="primary" class="<?php echo esc_attr($main_classes); ?>">
	<?php while ( have_posts() ) : the_post(); ?>
		<div <?php post_class(); ?>>
			<?php the_content(); ?>
		</div>
	<?php endwhile; ?>
</main>

<?php luxe_landscape_get_footer(); ?>
