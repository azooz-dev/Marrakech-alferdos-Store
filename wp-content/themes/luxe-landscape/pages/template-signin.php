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

		<form class="space-y-6">
			<div class="space-y-2 relative">
				<label class="text-sm font-medium text-slate-700 dark:text-slate-300 ml-1 auth-label-phone"><?php esc_html_e( 'Phone Number', 'luxe-landscape' ); ?></label>
				<div class="flex gap-3 relative">
					<!-- Custom Country Code Select -->
					<div class="relative w-[130px] shrink-0" id="custom-country-select">
						<input type="hidden" id="country-code-input" value="+966" />
						<button type="button" class="w-full flex items-center justify-between bg-slate-100 dark:bg-emerald-900/20 border border-slate-200 dark:border-emerald-800/50 rounded-xl px-4 py-4 focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all cursor-pointer" id="country-select-button">
							<span class="text-slate-700 dark:text-slate-300 font-medium whitespace-nowrap" id="country-select-display">+966 (SA)</span>
							<span class="material-symbols-outlined text-slate-500 text-xl transition-transform duration-200" id="country-select-icon">expand_more</span>
						</button>
						
						<!-- Dropdown Menu -->
						<div class="absolute top-full left-0 w-full mt-2 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl shadow-[0_10px_40px_-10px_rgba(0,0,0,0.1)] dark:shadow-none overflow-hidden z-50 opacity-0 invisible origin-top transition-all duration-200 scale-95" id="country-options-menu">
							<div class="max-h-[220px] overflow-y-auto w-full custom-scrollbar py-1">
								<button type="button" class="country-option w-full text-left px-4 py-3 hover:bg-slate-50 dark:hover:bg-slate-700/50 text-slate-700 dark:text-slate-300 transition-colors" data-value="+1" data-label="+1 (US)">+1 (US)</button>
								<button type="button" class="country-option w-full text-left px-4 py-3 hover:bg-slate-50 dark:hover:bg-slate-700/50 text-slate-700 dark:text-slate-300 transition-colors" data-value="+44" data-label="+44 (UK)">+44 (UK)</button>
								<button type="button" class="country-option w-full text-left px-4 py-3 hover:bg-slate-50 dark:hover:bg-slate-700/50 text-slate-700 dark:text-slate-300 transition-colors" data-value="+33" data-label="+33 (FR)">+33 (FR)</button>
								<button type="button" class="country-option w-full text-left px-4 py-3 hover:bg-slate-50 dark:hover:bg-slate-700/50 text-slate-700 dark:text-slate-300 transition-colors" data-value="+971" data-label="+971 (UAE)">+971 (UAE)</button>
								<button type="button" class="country-option w-full text-left px-4 py-3 hover:bg-slate-50 dark:hover:bg-slate-700/50 bg-slate-50 dark:bg-slate-700/30 font-medium text-primary transition-colors" data-value="+966" data-label="+966 (SA)">+966 (SA)</button>
							</div>
						</div>
					</div>
					<!-- Phone Input -->
					<div class="flex-1 relative">
						<span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-500 text-xl">call</span>
						<input id="phone-number-input" class="w-full bg-slate-100 dark:bg-emerald-900/20 border border-slate-200 dark:border-emerald-800/50 rounded-xl py-4 pl-12 pr-4 placeholder:text-slate-400 focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all" placeholder="512 345 678" type="tel" dir="ltr" />
					</div>
				</div>
				<!-- Inline Error Message -->
				<p id="phone-error" class="hidden text-red-500 dark:text-red-400 text-sm mt-2 flex items-center gap-1 opacity-0 transition-opacity">
					<span class="material-symbols-outlined text-[16px]">error</span>
					<span class="error-text"></span>
				</p>
			</div>
			
			<button class="w-full bg-primary hover:bg-primary/90 text-slate-900 font-bold py-4 rounded-xl transition-all shadow-lg shadow-primary/20 flex items-center justify-center gap-2 group auth-submit" type="button">
				<span class="auth-btn-login"><?php esc_html_e( 'Send OTP', 'luxe-landscape' ); ?></span>
				<span class="material-symbols-outlined transition-transform group-hover:translate-x-1">arrow_forward</span>
			</button>
		</form>

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
