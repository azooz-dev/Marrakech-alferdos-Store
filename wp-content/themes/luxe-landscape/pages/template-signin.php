<?php
/**
 * Sign In Page Layout
 *
 * @package Luxe_Landscape
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<?php get_header(); ?>

<!-- Main Login Container (Pushed down to account for fixed header) -->
<div class="relative min-h-[calc(100vh-80px)] mt-[80px] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">

	<!-- Background Organic Shapes -->
	<div class="organic-shape w-[500px] h-[500px] bg-primary/10 -top-20 -left-20"></div>
	<div class="organic-shape w-[400px] h-[400px] bg-emerald-900/30 bottom-0 right-0"></div>
	<div class="organic-shape w-[300px] h-[300px] bg-primary/5 top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2"></div>
	
	<div class="w-full max-w-[480px] z-10 relative">

	<!-- Main Login Card -->
	<div class="glass-card rounded-2xl p-8 md:p-12 shadow-2xl">
		<div class="text-center mb-10">
			<h1 class="text-3xl font-bold mb-3 auth-title-login"><?php esc_html_e( 'Welcome Back', 'luxe-landscape' ); ?></h1>
			<p class="text-slate-500 dark:text-slate-400 text-base auth-subtitle-login"><?php esc_html_e( 'Enter your phone number to access your account', 'luxe-landscape' ); ?></p>
		</div>

		<div class="woocommerce-custom-auth-wrapper">
			<?php 
			if ( class_exists( 'WooCommerce' ) ) {
				wc_get_template( 'global/form-login.php', array(
					'message'  => '',
					'redirect' => wc_get_account_endpoint_url( 'dashboard' ),
					'hidden'   => false,
				) );
			} else {
				echo '<p class="text-red-500">WooCommerce is required for authentication.</p>';
			}
			?>
		</div>

		<div class="mt-10 pt-8 border-t border-slate-200 dark:border-white/5 text-center">
			<p class="text-slate-500 dark:text-slate-400">
				<span class="auth-no-account"><?php esc_html_e( 'Don\'t have an account?', 'luxe-landscape' ); ?></span>
				<a class="text-primary font-semibold hover:underline decoration-primary/30 underline-offset-4 ml-1 auth-link-signup" href="<?php echo esc_url( site_url( '/sign-up' ) ); ?>"><?php esc_html_e( 'Sign Up', 'luxe-landscape' ); ?></a>
			</p>
		</div>
	</div>

	<!-- Minimal Footer -->
	<div class="mt-12 flex justify-center gap-8 text-slate-400 text-xs uppercase tracking-widest font-medium">
		<a class="hover:text-primary transition-colors auth-footer-1" href="#"><?php esc_html_e( 'Privacy Policy', 'luxe-landscape' ); ?></a>
		<a class="hover:text-primary transition-colors auth-footer-2" href="#"><?php esc_html_e( 'Terms of Service', 'luxe-landscape' ); ?></a>
		<a class="hover:text-primary transition-colors auth-footer-3" href="#"><?php esc_html_e( 'Support', 'luxe-landscape' ); ?></a>
	</div>

</div>

<!-- Background Image Layer (Abstract) -->
<div class="fixed inset-0 opacity-[0.05] pointer-events-none mix-blend-overlay">
	<img alt="<?php esc_attr_e( 'Abstract dark green tropical leaves pattern', 'luxe-landscape' ); ?>" class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBLEJfFwy4ZplCv9HL3D0dBnuDQwtNt7LOvGzB2vbS-an8jHV1yImSGT4F8dRGhkjw4KXg6rrtouDMFf02D9-kAur9La9plH_qL0P0NzzPz8ywHCcr1vVc_5KtOV6EkG5ir2Kh0akOO_zxPGZBFJ4ehKjos7d6yXigMhLwckQ8MOkrAksrLuCrjqJIXcyyH1Mbf1LlzoYG5sJlbX7nZkl56euUwMzarzWCpFLBZenm82gHBaQd9W8oLbLnuoqFn2UjwicxMuGC3cMs" />
</div>

<?php wp_footer(); ?>
</body>
</html>
