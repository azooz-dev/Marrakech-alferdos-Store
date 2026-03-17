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
?>

<main class="max-w-7xl mx-auto px-6 py-32">
	<?php while ( have_posts() ) : the_post(); ?>
		<div <?php post_class(); ?>>
			<?php the_content(); ?>
		</div>
	<?php endwhile; ?>
</main>

<?php luxe_landscape_get_footer(); ?>
