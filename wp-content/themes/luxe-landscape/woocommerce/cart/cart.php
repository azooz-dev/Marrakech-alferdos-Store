<?php

/**
 * WooCommerce Cart Template Override
 *
 * @package Luxe_Landscape
 */

if (! defined('ABSPATH')) {
	exit;
}

/**
 * Do not call luxe_landscape_get_header() / luxe_landscape_get_footer() here.
 * WooCommerce loads this file via [woocommerce_cart] inside page.php; including
 * header/footer would nest them inside page.php's <main> (breaking layout + duplicating footer).
 */

do_action('woocommerce_before_cart');
?>

<div class="woocommerce-cart-page pt-40 pb-24 px-6 md:px-12 lg:px-24 max-w-screen-2xl mx-auto">

	<?php wc_print_notices(); ?>

	<?php if (WC()->cart->is_empty()) : ?>
		<div class="rounded-3xl p-12 md:p-16 text-center bg-white dark:bg-slate-800 shadow-[0_20px_40px_rgba(27,28,24,0.06)]">
			<span class="material-symbols-outlined text-7xl text-slate-300 dark:text-slate-600 mb-4 block">shopping_bag</span>
			<p class="text-slate-500 text-lg mb-8"><?php pll_e('Your cart is currently empty.'); ?></p>
			<a href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>" class="btn-primary inline-flex items-center gap-2">
				<?php pll_e('Continue Shopping'); ?>
				<span class="material-symbols-outlined">arrow_forward</span>
			</a>
		</div>
	<?php else : ?>
		<form action="<?php echo esc_url(wc_get_cart_url()); ?>" method="post" class="grid grid-cols-1 lg:grid-cols-12 gap-16 items-start">
			<?php wp_nonce_field('woocommerce-cart', 'woocommerce-cart-nonce'); ?>

			<div class="lg:col-span-8 flex flex-col gap-8">
				<?php
				foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) :
					$_product   = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
					$product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);

					if (! $_product || ! $_product->exists() || $cart_item['quantity'] <= 0 || ! apply_filters('woocommerce_cart_item_visible', true, $cart_item, $cart_item_key)) {
						continue;
					}

					$product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);
					$thumbnail         = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image('woocommerce_thumbnail', array('class' => 'w-full h-full object-cover transition-transform duration-700 group-hover:scale-105')), $cart_item, $cart_item_key);

					if ($_product->is_sold_individually()) {
						$min_quantity = 1;
						$max_quantity = 1;
					} else {
						$min_quantity = 1;
						$max_quantity = $_product->get_max_purchase_quantity();
					}
				?>
					<div class="group relative flex flex-col md:flex-row gap-8 p-6 rounded-3xl bg-white dark:bg-slate-800 transition-all duration-500 hover:shadow-[0_20px_40px_rgba(27,28,24,0.06)] overflow-hidden border border-slate-100 dark:border-slate-700">
						<div class="w-full md:w-64 h-64 overflow-hidden rounded-2xl bg-slate-100 dark:bg-slate-700 flex-shrink-0">
							<?php
							if ($product_permalink) {
								printf('<a href="%s" class="block w-full h-full">%s</a>', esc_url($product_permalink), $thumbnail);
							} else {
								echo $thumbnail; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
							}
							?>
						</div>

						<div class="flex-1 flex flex-col justify-between py-2 gap-6">
							<div class="flex justify-between items-start gap-4">
								<div>
									<h3 class="text-2xl font-display font-bold text-slate-900 dark:text-white mb-2">
										<?php
										if ($product_permalink) {
											printf('<a href="%s">%s</a>', esc_url($product_permalink), wp_kses_post(apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key)));
										} else {
											echo wp_kses_post(apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key));
										}
										?>
									</h3>
									<p class="text-slate-500 text-sm"><?php echo wp_kses_post(WC()->cart->get_product_price($_product)); ?></p>
								</div>

								<a href="<?php echo esc_url(wc_get_cart_remove_url($cart_item_key)); ?>"
									class="text-slate-400 hover:text-red-500 transition-colors p-2"
									aria-label="<?php echo esc_attr(sprintf(pll__('Remove %s from cart'), wp_strip_all_tags($_product->get_name()))); ?>"
									data-product_id="<?php echo esc_attr($product_id); ?>">
									<span class="material-symbols-outlined">delete</span>
								</a>
							</div>

							<div class="flex justify-between items-end mt-2 flex-wrap gap-4">
								<div class="wc-cart-quantity-pill">
									<button type="button" class="wc-cart-qty-btn" data-target="cart-qty-<?php echo esc_attr($cart_item_key); ?>" data-action="decrease">
										<span class="material-symbols-outlined">remove</span>
									</button>
									<input
										id="cart-qty-<?php echo esc_attr($cart_item_key); ?>"
										class="wc-cart-qty-input"
										type="number"
										name="cart[<?php echo esc_attr($cart_item_key); ?>][qty]"
										value="<?php echo esc_attr($cart_item['quantity']); ?>"
										min="<?php echo esc_attr($min_quantity); ?>"
										<?php if ($max_quantity > 0) : ?>max="<?php echo esc_attr($max_quantity); ?>" <?php endif; ?>
										aria-label="<?php echo esc_attr(sprintf(pll__('Quantity for %s'), wp_strip_all_tags($_product->get_name()))); ?>" />
									<button type="button" class="wc-cart-qty-btn" data-target="cart-qty-<?php echo esc_attr($cart_item_key); ?>" data-action="increase">
										<span class="material-symbols-outlined">add</span>
									</button>
								</div>

								<div class="text-2xl font-display font-bold text-primary">
									<?php echo wp_kses_post(WC()->cart->get_product_subtotal($_product, $cart_item['quantity'])); ?>
								</div>
							</div>
						</div>
					</div>
				<?php endforeach; ?>

				<div class="flex flex-wrap justify-between items-center gap-4">
					<a href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>" class="btn-outline inline-flex items-center gap-2">
						<span class="material-symbols-outlined">arrow_back</span>
						<?php pll_e('Continue Shopping'); ?>
					</a>

					<button type="submit" name="update_cart" value="<?php esc_attr_e('Update cart', 'luxe-landscape'); ?>" class="btn-outline">
						<?php pll_e('Update Cart'); ?>
					</button>
				</div>
			</div>

			<aside class="lg:col-span-4 sticky top-32">
				<div class="bg-white/70 dark:bg-slate-900/80 backdrop-blur-xl p-8 rounded-3xl shadow-[0_20px_40px_rgba(27,28,24,0.06)] flex flex-col gap-8 border border-white/40 dark:border-slate-700">
					<h2 class="text-2xl font-display font-bold text-primary"><?php pll_e('Order Summary'); ?></h2>

					<div class="space-y-4 font-label">
						<div class="flex justify-between text-slate-500">
							<span><?php pll_e('Subtotal'); ?></span>
							<span class="text-slate-900 dark:text-white font-semibold"><?php wc_cart_totals_subtotal_html(); ?></span>
						</div>

						<?php if (WC()->cart->needs_shipping() && WC()->cart->show_shipping()) : ?>
							<div class="flex justify-between text-slate-500">
								<span><?php pll_e('Estimated Shipping'); ?></span>
								<span class="text-slate-900 dark:text-white font-semibold"><?php wc_cart_totals_shipping_html(); ?></span>
							</div>
						<?php endif; ?>

						<?php if (wc_tax_enabled()) : ?>
							<div class="flex justify-between text-slate-500">
								<span><?php echo esc_html(WC()->countries->tax_or_vat()); ?></span>
								<span class="text-slate-900 dark:text-white font-semibold"><?php wc_cart_totals_taxes_total_html(); ?></span>
							</div>
						<?php endif; ?>

						<?php foreach (WC()->cart->get_fees() as $fee) : ?>
							<div class="flex justify-between text-slate-500">
								<span><?php echo esc_html($fee->name); ?></span>
								<span class="text-slate-900 dark:text-white font-semibold"><?php wc_cart_totals_fee_html($fee); ?></span>
							</div>
						<?php endforeach; ?>

						<div class="pt-4 border-t border-slate-200 dark:border-slate-700 flex justify-between">
							<span class="text-xl font-display font-bold text-primary"><?php pll_e('Total'); ?></span>
							<span class="text-xl font-display font-bold text-primary"><?php wc_cart_totals_order_total_html(); ?></span>
						</div>
					</div>

					<?php if (wc_coupons_enabled()) : ?>
						<div class="space-y-3">
							<label for="coupon_code" class="text-xs font-bold uppercase tracking-wider text-slate-500 font-label"><?php pll_e('Apply Atelier Code'); ?></label>
							<div class="relative flex">
								<input id="coupon_code" class="w-full h-14 bg-slate-100 dark:bg-slate-800 rounded-full px-6 border-none focus:ring-2 focus:ring-primary/20 font-label placeholder:text-slate-400 transition-all" placeholder="<?php echo esc_attr(pll__('ENTER CODE')); ?>" type="text" name="coupon_code" value="" />
								<button type="submit" name="apply_coupon" value="<?php esc_attr_e('Apply coupon', 'woocommerce'); ?>" class="absolute right-2 top-2 h-10 px-4 bg-primary text-slate-900 rounded-full text-sm font-bold tracking-tight hover:bg-primary/90 transition-colors">
									<?php pll_e('APPLY'); ?>
								</button>
							</div>
						</div>
					<?php endif; ?>

					<a href="<?php echo esc_url(wc_get_checkout_url()); ?>" class="h-16 bg-primary text-slate-900 rounded-xl font-display font-bold text-lg hover:shadow-lg transition-all active:scale-[0.98] flex items-center justify-center gap-2">
						<?php pll_e('Proceed to Checkout'); ?>
						<span class="material-symbols-outlined">arrow_forward</span>
					</a>
				</div>
			</aside>
		</form>
	<?php endif; ?>
</div>

<?php
do_action('woocommerce_after_cart');
?>
<script>
	document.addEventListener('click', function(event) {
		const btn = event.target.closest('.wc-cart-qty-btn');
		if (!btn) {
			return;
		}
		const input = document.getElementById(btn.dataset.target || '');
		if (!input) {
			return;
		}
		const min = parseInt(input.min || '1', 10);
		const max = input.max ? parseInt(input.max, 10) : 0;
		const current = parseInt(input.value || min, 10);
		const next = btn.dataset.action === 'decrease' ? current - 1 : current + 1;
		if (next < min || (max > 0 && next > max)) {
			return;
		}
		input.value = next;
	});
</script>