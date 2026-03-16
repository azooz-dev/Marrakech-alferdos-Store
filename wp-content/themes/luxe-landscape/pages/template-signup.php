<?php
/**
 * Sign Up Page Layout
 *
 * @package Luxe_Landscape
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<?php get_header(); ?>

<!-- Main Sign Up Container (Pushed down to account for fixed header) -->
<div class="relative min-h-[calc(100vh-80px)] mt-[80px] flex items-center justify-center p-6 lg:p-12 overflow-x-hidden">

	<!-- Background Organic Shapes -->
	<div class="organic-shape w-[500px] h-[500px] bg-primary/20 rounded-full -top-40 -left-20"></div>
	<div class="organic-shape w-[400px] h-[400px] bg-emerald-900/40 rounded-full -bottom-20 -right-20"></div>
	<div class="organic-shape w-[300px] h-[300px] bg-primary/10 rounded-full top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2"></div>
	
	<main class="w-full max-w-[520px] z-10 py-12 relative">

	<!-- Signup Card -->
	<div class="glass-card rounded-xl p-10 shadow-2xl">
		<div class="mb-8">
			<h2 class="text-3xl font-bold mb-2 auth-title-signup"><?php esc_html_e( 'Join Luxe Landscape', 'luxe-landscape' ); ?></h2>
			<p class="text-slate-500 dark:text-slate-400 auth-subtitle-signup"><?php esc_html_e( 'Create an account to start your luxury project', 'luxe-landscape' ); ?></p>
		</div>

		<div class="woocommerce-custom-auth-wrapper auth-mode-register space-y-6">
			<?php 
			if ( class_exists( 'WooCommerce' ) ) {
				wc_get_template( 'myaccount/form-login.php' );
			} else {
				echo '<p class="text-red-500">WooCommerce is required for registration.</p>';
			}
			?>
		</div>
		<!-- Footer Link -->
		<div class="mt-8 text-center pt-8 border-t border-slate-200 dark:border-white/5">
			<p class="text-slate-500">
				<span class="auth-has-account"><?php esc_html_e( 'Already have an account?', 'luxe-landscape' ); ?></span>
				<a class="text-primary font-semibold hover:underline underline-offset-4 ml-1 auth-link-signin" href="<?php echo esc_url( site_url( '/sign-in' ) ); ?>"><?php esc_html_e( 'Sign In', 'luxe-landscape' ); ?></a>
			</p>
		</div>
	</div>
	</main>
</div>

<?php get_footer(); ?>
