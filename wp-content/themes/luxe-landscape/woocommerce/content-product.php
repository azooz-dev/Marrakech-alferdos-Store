<?php

/**
 * WooCommerce Content Product Template Override
 *
 * Product card matching the Stitch products grid design.
 * Uses inline Tailwind classes with background-image style.
 *
 * @package Luxe_Landscape
 */

if (! defined('ABSPATH')) {
	exit;
}

global $product;

if (! is_a($product, 'WC_Product')) {
	return;
}

$prod_name  = $product->get_name();
$prod_desc  = wp_trim_words($product->get_short_description(), 6, '...');
$prod_image = wp_get_attachment_url($product->get_image_id());
$prod_price = $product->get_price_html();
$prod_badge = $product->is_in_stock() ? __('In Stock', 'luxe-landscape') : '';
$prod_url   = get_permalink($product->get_id());
$can_ajax_add = $product->is_type('simple') && $product->is_purchasable() && $product->is_in_stock();

// Check for placeholder if no image
if (! $prod_image && function_exists('wc_placeholder_img_src')) {
	$prod_image = wc_placeholder_img_src('large');
}
?>

<div <?php wc_product_class('group block'); ?>>
	<div class="relative aspect-[4/5] rounded-2xl overflow-hidden bg-slate-200 dark:bg-slate-800 mb-4 shadow-[0_10px_40px_-10px_rgba(0,0,0,0.1)]">
		<a href="<?php echo esc_url($prod_url); ?>" class="absolute inset-0 block">
			<?php if ($prod_image) : ?>
				<div class="absolute inset-0 bg-cover bg-center transition-transform duration-500 group-hover:scale-110"
					style="background-image: url('<?php echo esc_url($prod_image); ?>')">
				</div>
			<?php endif; ?>
		</a>
		<button class="absolute top-4 right-4 w-10 h-10 bg-white/80 dark:bg-slate-800/80 backdrop-blur rounded-full flex items-center justify-center text-primary opacity-0 group-hover:opacity-100 transition-opacity z-10" type="button" aria-label="<?php esc_attr_e('Favorite', 'luxe-landscape'); ?>">
			<span class="material-symbols-outlined">favorite</span>
		</button>
		<?php if ($can_ajax_add) : ?>
			<a
				href="<?php echo esc_url($product->add_to_cart_url()); ?>"
				class="add_to_cart_button ajax_add_to_cart absolute bottom-4 right-4 size-12 bg-slate-900 text-white rounded-full flex items-center justify-center opacity-0 translate-y-4 group-hover:opacity-100 group-hover:translate-y-0 transition-all z-10"
				data-product_id="<?php echo esc_attr($product->get_id()); ?>"
				data-product_sku="<?php echo esc_attr($product->get_sku()); ?>"
				data-quantity="1"
				aria-label="<?php echo esc_attr(sprintf(__('Add %s to cart', 'luxe-landscape'), wp_strip_all_tags($prod_name))); ?>"
				rel="nofollow">
				<span class="material-symbols-outlined">add</span>
			</a>
		<?php endif; ?>
		<?php if ($prod_badge) : ?>
			<div class="absolute bottom-4 left-4">
				<span class="bg-primary text-slate-900 text-[10px] font-bold uppercase tracking-wider px-3 py-1 rounded-full"><?php echo esc_html($prod_badge); ?></span>
			</div>
		<?php endif; ?>
	</div>
	<h3 class="font-display text-lg font-bold group-hover:text-primary transition-colors">
		<a href="<?php echo esc_url($prod_url); ?>"><?php echo esc_html($prod_name); ?></a>
	</h3>
	<?php if ($prod_desc) : ?>
		<p class="text-slate-500 text-sm mb-2"><?php echo esc_html($prod_desc); ?></p>
	<?php endif; ?>
	<p class="font-display font-bold text-primary"><?php echo wp_kses_post($prod_price); ?></p>
</div>