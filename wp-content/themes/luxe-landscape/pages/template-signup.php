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

		<form class="space-y-6">
			<!-- Full Name -->
			<div class="space-y-2 relative">
				<label class="text-sm font-medium text-slate-700 dark:text-slate-300 ml-1 auth-label-name"><?php esc_html_e( 'Full Name', 'luxe-landscape' ); ?></label>
				<div class="relative">
					<span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-500 text-xl">person</span>
					<input id="name-input" class="w-full bg-slate-100 dark:bg-emerald-900/20 border border-slate-200 dark:border-emerald-800/50 rounded-lg py-4 pl-12 pr-4 placeholder:text-slate-400 focus:ring-2 focus:ring-primary focus:border-primary transition-all outline-none" placeholder="<?php esc_attr_e( 'Enter your full name', 'luxe-landscape' ); ?>" type="text" />
				</div>
				<!-- Inline Error Message -->
				<p id="name-error" class="hidden text-red-500 dark:text-red-400 text-sm mt-2 flex items-center gap-1 opacity-0 transition-opacity">
					<span class="material-symbols-outlined text-[16px]">error</span>
					<span class="error-text"></span>
				</p>
			</div>

			<!-- Phone Number Group -->
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
					<div class="relative flex-1">
						<span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-500 text-xl">call</span>
						<input id="phone-number-input" class="w-full bg-slate-100 dark:bg-emerald-900/20 border border-slate-200 dark:border-emerald-800/50 rounded-lg py-4 pl-12 pr-4 placeholder:text-slate-400 focus:ring-2 focus:ring-primary focus:border-primary transition-all outline-none" placeholder="512 345 678" type="tel" dir="ltr" />
					</div>
				</div>
				<!-- Inline Error Message -->
				<p id="phone-error" class="hidden text-red-500 dark:text-red-400 text-sm mt-2 flex items-center gap-1 opacity-0 transition-opacity">
					<span class="material-symbols-outlined text-[16px]">error</span>
					<span class="error-text"></span>
				</p>
			</div>

			<!-- Terms -->
			<div class="flex items-center gap-3 py-2">
				<label class="relative flex items-center cursor-pointer">
					<input class="peer h-5 w-5 cursor-pointer appearance-none rounded border border-slate-300 dark:border-slate-700 bg-slate-100 dark:bg-emerald-900/20 checked:bg-primary checked:border-primary transition-all" type="checkbox" />
					<span class="absolute text-slate-900 opacity-0 peer-checked:opacity-100 top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 pointer-events-none">
						<svg class="h-3.5 w-3.5" fill="currentColor" stroke="currentColor" stroke-width="1" viewbox="0 0 20 20">
							<path clip-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" fill-rule="evenodd"></path>
						</svg>
					</span>
				</label>
				<span class="text-sm text-slate-500 dark:text-slate-400">
					<span class="auth-agree-1"><?php esc_html_e( 'I agree to the', 'luxe-landscape' ); ?></span> <a class="text-primary hover:underline underline-offset-4 auth-footer-2" href="#"><?php esc_html_e( 'Terms', 'luxe-landscape' ); ?></a> <span class="auth-agree-2"><?php esc_html_e( 'and', 'luxe-landscape' ); ?></span> <a class="text-primary hover:underline underline-offset-4 auth-footer-1" href="#"><?php esc_html_e( 'Privacy Policy', 'luxe-landscape' ); ?></a>
				</span>
			</div>

			<!-- Action Button -->
			<button class="group relative w-full bg-primary hover:bg-primary/90 text-slate-900 font-bold py-5 rounded-lg transition-all shadow-[0_0_30px_rgba(17,212,98,0.2)] flex items-center justify-center gap-2 overflow-hidden auth-submit-signup" type="button">
				<span class="z-10 auth-btn-signup"><?php esc_html_e( 'Create Account', 'luxe-landscape' ); ?></span>
				<span class="material-symbols-outlined z-10 transition-transform group-hover:translate-x-1">arrow_forward</span>
			</button>
		</form>

		<!-- Footer Link -->
		<div class="mt-8 text-center pt-8 border-t border-slate-200 dark:border-white/5">
			<p class="text-slate-500">
				<span class="auth-has-account"><?php esc_html_e( 'Already have an account?', 'luxe-landscape' ); ?></span>
				<a class="text-primary font-semibold hover:underline underline-offset-4 ml-1 auth-link-signin" href="<?php echo esc_url( site_url( '/sign-in' ) ); ?>"><?php esc_html_e( 'Sign In', 'luxe-landscape' ); ?></a>
			</p>
		</div>
	</div>

	<!-- Decorative Image Elements -->
	<div class="mt-12 grid grid-cols-3 gap-4 opacity-70 dark:opacity-40 grayscale hover:grayscale-0 transition-all duration-700">
		<div class="h-24 rounded-lg bg-cover bg-center border border-white/5" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuCZem898hETGcg106mnWxYuUWh7DiLKv96nMPqNf_ysUitha9-tAKAxA3LZ3dvK9ouaM9CE9Etu1q6IBwrIXLYPxfXwO07pNKn4alOMLS5hOe-EYTHDLYLlXeg8WSgIaIjsdQBqYi7g6-nsW-Q0Dh5dlms60vkI1vwpB1nrXemE2YAWaIdfLYahQL3o0cghtjv5mmDiDYYw4HZYQHD2_zro8inlaEXWliJJ5HMxJ4eWoCywLfPMKdwRBO1DKwWBS-igL_b9mZd7e4U')"></div>
		<div class="h-24 rounded-lg bg-cover bg-center border border-white/5" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuCcp1LbFurOJ_rWblfKJLiI0gTL3nHCLDCt0EBfb7OJOUkzn_kZ9pZvfI4HDLtG-t1D7pyhDj8_CgIFznEgpNnUZ3bKgPBHAHlYfzx1dzr-WXefePXjcNmzRK8iY6nAqrbD1c6noem7uxZsP31lIjQ7ZtT5L8bP2wdoiPUI7NBeubl0HVtV5_StgskolStRQgxKT22R-5wiFVDtaJPifUBuTqtIRn5N4rDBH9Y5lytlFpPkCSG63mBRmVysDXBufkTXNCy5391qTlY')"></div>
		<div class="h-24 rounded-lg bg-cover bg-center border border-white/5" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuCcE3nfvkW6Q-0FDTRrZM1zOTA1NfaGKx_hp9jMuQjlF4zj3Crkr7eNTZUqHJ8VU4KeOFvXBMtKdYSijz63E2y2ww5VyByuLRvy1tTKTSs3-WWSax9xuy8SrtOE7OpgCJTqMn3aY4q_RcsII3RkxJ_VezoxjjieaTdmA2hn9ueDCKMf7Y-NKJvXJGG0Zi2twSzMnWMGa92UHg4GNk6fwLxXb_KcIV_ZOVSzmG-YCd_zC69FRjwlbD4dXOtLWFxyDSN5Y-_mGw1yEa4')"></div>
	</div>
	</main>
</div>

<?php get_footer(); ?>
