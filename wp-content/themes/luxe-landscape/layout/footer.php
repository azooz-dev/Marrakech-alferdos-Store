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

<!-- Premium Footer -->
<footer class="bg-white dark:bg-slate-950 border-t border-slate-100 dark:border-slate-900 pt-24 pb-12">
	<div class="max-w-7xl mx-auto px-6">
		<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-12 mb-20">
			<!-- Brand + Newsletter (spans 2 cols) -->
			<div class="lg:col-span-2 space-y-8">
				<div class="flex items-center gap-2">
					<span class="material-symbols-outlined text-primary text-3xl">filter_vintage</span>
					<span class="font-bold text-xl tracking-tighter"><?php esc_html_e('LUXE LANDSCAPE', 'luxe-landscape'); ?></span>
				</div>
				<p class="text-slate-500 max-w-sm footer-tagline"><?php echo esc_html(get_theme_mod('luxe_footer_tagline', __('Crafting the future of biophilic luxury with factory-direct ethics and sustainable engineering.', 'luxe-landscape'))); ?></p>
				<div class="space-y-4">
					<h4 class="font-bold footer-newsletter-title"><?php esc_html_e('Subscribe to our Design Journal', 'luxe-landscape'); ?></h4>
					<form action="<?php echo esc_url(get_theme_mod('luxe_footer_newsletter_url', '#')); ?>" method="post" class="flex gap-2">
						<input class="bg-slate-50 dark:bg-slate-900 border-none rounded-xl px-4 py-3 flex-1" placeholder="email@address.com" type="email" name="email">
						<button type="submit" class="bg-slate-900 dark:bg-primary dark:text-slate-900 text-white px-6 rounded-xl font-bold footer-newsletter-btn"><?php esc_html_e('Join', 'luxe-landscape'); ?></button>
					</form>
				</div>
			</div>

			<!-- Collections -->
			<div>
				<h4 class="font-bold mb-6 footer-title-collections"><?php esc_html_e('Collections', 'luxe-landscape'); ?></h4>
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
						<li><a class="hover:text-primary transition-colors" href="#"><?php esc_html_e('Outdoor Sculptures', 'luxe-landscape'); ?></a></li>
						<li><a class="hover:text-primary transition-colors" href="#"><?php esc_html_e('Vertical Gardens', 'luxe-landscape'); ?></a></li>
						<li><a class="hover:text-primary transition-colors" href="#"><?php esc_html_e('Water Features', 'luxe-landscape'); ?></a></li>
						<li><a class="hover:text-primary transition-colors" href="#"><?php esc_html_e('Premium Soil', 'luxe-landscape'); ?></a></li>
					</ul>
					<?php
}
?>
			</div>

			<!-- Support -->
			<div>
				<h4 class="font-bold mb-6 footer-title-support"><?php esc_html_e('Support', 'luxe-landscape'); ?></h4>
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
						<li><a class="hover:text-primary transition-colors" href="#"><?php esc_html_e('Track Order', 'luxe-landscape'); ?></a></li>
						<li><a class="hover:text-primary transition-colors" href="#"><?php esc_html_e('Wholesale Portal', 'luxe-landscape'); ?></a></li>
						<li><a class="hover:text-primary transition-colors" href="#"><?php esc_html_e('Warranty Policy', 'luxe-landscape'); ?></a></li>
						<li><a class="hover:text-primary transition-colors" href="#"><?php esc_html_e('Contact Expert', 'luxe-landscape'); ?></a></li>
					</ul>
					<?php
}
?>
			</div>

			<!-- Social -->
			<div>
				<h4 class="font-bold mb-6 footer-title-social"><?php esc_html_e('Social', 'luxe-landscape'); ?></h4>
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
					<span class="text-xs font-bold uppercase tracking-widest footer-badge-secure"><?php esc_html_e('Secure Checkout', 'luxe-landscape'); ?></span>
				</div>
				<div class="flex items-center gap-2">
					<span class="material-symbols-outlined">local_shipping</span>
					<span class="text-xs font-bold uppercase tracking-widest footer-badge-shipping"><?php esc_html_e('Fast Shipping', 'luxe-landscape'); ?></span>
				</div>
				<div class="flex items-center gap-2">
					<span class="material-symbols-outlined">verified</span>
					<span class="text-xs font-bold uppercase tracking-widest footer-badge-warranty"><?php esc_html_e('10 Year Warranty', 'luxe-landscape'); ?></span>
				</div>
			</div>
			<p class="text-slate-400 text-sm">© <?php echo esc_html(date('Y')); ?> <?php esc_html_e('Luxe Landscape Factory Group. All rights reserved.', 'luxe-landscape'); ?></p>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
			<div class="flex items-center gap-8 opacity-40 grayscale hover:grayscale-0 transition-all">
				<div class="flex items-center gap-2">
					<span class="material-symbols-outlined">verified_user</span>
					<span class="text-xs font-bold uppercase tracking-widest footer-badge-secure"><?php esc_html_e('Secure Checkout', 'luxe-landscape'); ?></span>
				</div>
				<div class="flex items-center gap-2">
					<span class="material-symbols-outlined">local_shipping</span>
					<span class="text-xs font-bold uppercase tracking-widest footer-badge-shipping"><?php esc_html_e('Fast Shipping', 'luxe-landscape'); ?></span>
				</div>
				<div class="flex items-center gap-2">
					<span class="material-symbols-outlined">verified</span>
					<span class="text-xs font-bold uppercase tracking-widest footer-badge-warranty"><?php esc_html_e('10 Year Warranty', 'luxe-landscape'); ?></span>
				</div>
			</div>
			<p class="text-slate-400 text-sm">© <?php echo esc_html(date('Y')); ?> <?php esc_html_e('Luxe Landscape Factory Group. All rights reserved.', 'luxe-landscape'); ?></p>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
