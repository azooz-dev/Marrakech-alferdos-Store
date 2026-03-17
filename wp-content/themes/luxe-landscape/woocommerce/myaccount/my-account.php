<?php
/**
 * My Account Master Template Override
 *
 * Wraps all WooCommerce account content in the Stitch sidebar layout.
 * This is a PARTIAL template loaded inside the page content area —
 * header/footer are handled by the page template.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.9.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<div class="flex flex-col md:flex-row gap-8 max-w-7xl mx-auto pt-8 pb-12 px-4 md:px-10">

	<?php
	// Load shared sidebar
	load_template( get_template_directory() . '/layout/account-sidebar.php' );
	?>

	<!-- Content Area -->
	<div class="flex-1">
		<?php
		/**
		 * My Account content.
		 *
		 * @since 2.6.0
		 */
		do_action( 'woocommerce_account_content' );
		?>
	</div>

</div>
