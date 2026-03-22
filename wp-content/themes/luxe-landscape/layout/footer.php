<?php
/**
 * Footer Layout Partial
 *
 * Premium footer with trust badges, newsletter, and dark mode support.
 *
 * @package Luxe_Landscape
 */

if (!defined('ABSPATH')) {
	exit;
}
?>

<!-- Premium Footer: full-bleed background; content uses horizontal padding only (no max-width inset). -->
<footer class="w-full bg-white dark:bg-slate-950 border-t border-slate-100 dark:border-slate-900 pt-24 pb-12">
	<div class="w-full max-w-none px-6 sm:px-8 lg:px-12 xl:px-16 2xl:px-20">
		<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-12 mb-20">
			<!-- Brand + Newsletter (spans 2 cols) -->
			<div class="lg:col-span-2 space-y-8">
				<div class="flex items-center gap-2">
					<span class="material-symbols-outlined text-primary text-3xl">filter_vintage</span>
					<span class="font-bold text-xl tracking-tighter"><?php pll_e('LUXE LANDSCAPE'); ?></span>
				</div>
				<p class="text-slate-500 max-w-sm footer-tagline"><?php echo esc_html(get_theme_mod('luxe_footer_tagline', pll__('Crafting the future of biophilic luxury with factory-direct ethics and sustainable engineering.'))); ?></p>
				<div class="space-y-4">
					<h4 class="font-bold footer-newsletter-title"><?php pll_e('Subscribe to our Design Journal'); ?></h4>
					<form action="<?php echo esc_url(get_theme_mod('luxe_footer_newsletter_url', '#')); ?>" method="post" class="flex gap-2">
						<input class="bg-slate-50 dark:bg-slate-900 border-none rounded-xl px-4 py-3 flex-1" placeholder="email@address.com" type="email" name="email">
						<button type="submit" class="bg-slate-900 dark:bg-primary dark:text-slate-900 text-white px-6 rounded-xl font-bold footer-newsletter-btn"><?php pll_e('Join'); ?></button>
					</form>
				</div>
			</div>

			<!-- Collections -->
			<div>
				<h4 class="font-bold mb-6 footer-title-collections"><?php pll_e('Collections'); ?></h4>
				<?php
if (has_nav_menu('footer-collections')) {
	wp_nav_menu(array(
		'theme_location' => 'footer-collections',
		'container' => false,
		'menu_class' => 'space-y-4 text-slate-500',
		'link_before' => '',
		'link_after' => '',
	));
}
else {
?>
					<ul class="space-y-4 text-slate-500">
						<li><a class="hover:text-primary transition-colors" href="#"><?php pll_e('Outdoor Sculptures'); ?></a></li>
						<li><a class="hover:text-primary transition-colors" href="#"><?php pll_e('Vertical Gardens'); ?></a></li>
						<li><a class="hover:text-primary transition-colors" href="#"><?php pll_e('Water Features'); ?></a></li>
						<li><a class="hover:text-primary transition-colors" href="#"><?php pll_e('Premium Soil'); ?></a></li>
					</ul>
					<?php
}
?>
			</div>

			<!-- Support -->
			<div>
				<h4 class="font-bold mb-6 footer-title-support"><?php pll_e('Support'); ?></h4>
				<?php
if (has_nav_menu('footer-support')) {
	wp_nav_menu(array(
		'theme_location' => 'footer-support',
		'container' => false,
		'menu_class' => 'space-y-4 text-slate-500',
	));
}
else {
?>
					<ul class="space-y-4 text-slate-500">
						<li><a class="hover:text-primary transition-colors" href="#"><?php pll_e('Track Order'); ?></a></li>
						<li><a class="hover:text-primary transition-colors" href="#"><?php pll_e('Wholesale Portal'); ?></a></li>
						<li><a class="hover:text-primary transition-colors" href="#"><?php pll_e('Warranty Policy'); ?></a></li>
						<li><a class="hover:text-primary transition-colors" href="#"><?php pll_e('Contact Expert'); ?></a></li>
					</ul>
					<?php
}
?>
			</div>

			<!-- Social -->
			<div>
				<h4 class="font-bold mb-6 footer-title-social"><?php pll_e('Social'); ?></h4>
				<ul class="space-y-4 text-slate-500">
					<li><a class="hover:text-primary transition-colors" href="<?php echo esc_url(get_theme_mod('luxe_footer_social_instagram', '#')); ?>" target="_blank" rel="noopener">Instagram</a></li>
					<li><a class="hover:text-primary transition-colors" href="<?php echo esc_url(get_theme_mod('luxe_footer_social_pinterest', '#')); ?>" target="_blank" rel="noopener">Pinterest</a></li>
					<li><a class="hover:text-primary transition-colors" href="<?php echo esc_url(get_theme_mod('luxe_footer_social_linkedin', '#')); ?>" target="_blank" rel="noopener">LinkedIn</a></li>
					<li><a class="hover:text-primary transition-colors" href="<?php echo esc_url(get_theme_mod('luxe_footer_social_youtube', '#')); ?>" target="_blank" rel="noopener">YouTube</a></li>
				</ul>
			</div>
		</div>

		<!-- Trust Badges + Copyright -->
		<div class="border-t border-slate-100 dark:border-slate-900 pt-12 flex flex-col md:flex-row justify-between items-center gap-8">
			<div class="flex items-center gap-8 opacity-40 grayscale hover:grayscale-0 transition-all">
				<div class="flex items-center gap-2">
					<span class="material-symbols-outlined">verified_user</span>
					<span class="text-xs font-bold uppercase tracking-widest footer-badge-secure"><?php pll_e('Secure Checkout'); ?></span>
				</div>
				<div class="flex items-center gap-2">
					<span class="material-symbols-outlined">local_shipping</span>
					<span class="text-xs font-bold uppercase tracking-widest footer-badge-shipping"><?php pll_e('Fast Shipping'); ?></span>
				</div>
				<div class="flex items-center gap-2">
					<span class="material-symbols-outlined">verified</span>
					<span class="text-xs font-bold uppercase tracking-widest footer-badge-warranty"><?php pll_e('10 Year Warranty'); ?></span>
				</div>
			</div>
			<p class="text-slate-400 text-sm">© <?php echo esc_html(date('Y')); ?> <?php pll_e('Luxe Landscape Factory Group. All rights reserved.'); ?></p>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
