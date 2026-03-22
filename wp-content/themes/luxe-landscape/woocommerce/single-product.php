<?php

/**
 * WooCommerce Single Product Template Override
 *
 * Product detail page with image gallery, specs, and sustainability stats.
 * Converted from Stitch design (ProductDetails.html).
 *
 * @package Luxe_Landscape
 */

if (! defined('ABSPATH')) {
	exit;
}

luxe_landscape_get_header();
?>

<?php while (have_posts()) : the_post(); ?>

	<?php global $product; ?>

	<?php
	// Product data
	$prod_name        = $product->get_name();
	$prod_price       = $product->get_price_html();
	$prod_desc        = $product->get_description();
	$prod_short_desc  = $product->get_short_description();
	$prod_in_stock    = $product->is_in_stock();
	$prod_stock_text  = $prod_in_stock ? pll__('In Stock') : pll__('Out of Stock');

	// Product images
	$main_image_id  = $product->get_image_id();
	$main_image_url = $main_image_id ? wp_get_attachment_url($main_image_id) : wc_placeholder_img_src('full');
	$gallery_ids    = $product->get_gallery_image_ids();

	// Build gallery array
	$all_images = array($main_image_url);
	foreach ($gallery_ids as $gid) {
		$gurl = wp_get_attachment_url($gid);
		if ($gurl) {
			$all_images[] = $gurl;
		}
	}

	// Product categories for breadcrumb
	$cat_name = pll__('Collections');
	$cat_url  = class_exists('WooCommerce') ? wc_get_page_permalink('shop') : '#';
	$terms    = get_the_terms($product->get_id(), 'product_cat');
	if ($terms && ! is_wp_error($terms)) {
		$cat_name = $terms[0]->name;
		$cat_url  = get_term_link($terms[0]);
	}

	// Product attributes for specs
	$weight     = $product->get_weight();
	$dimensions = $product->get_dimensions();
	$max_purchase_quantity = $product->get_max_purchase_quantity();
	?>

	<!-- ====================================================
     SINGLE PRODUCT MAIN CONTENT
     ==================================================== -->
	<main class="max-w-7xl mx-auto px-6 py-12 mt-24">

		<!-- Breadcrumbs -->
		<nav class="flex items-center gap-2 mb-8 text-sm text-slate-500 font-medium">
			<a class="hover:text-primary transition-colors" href="<?php echo esc_url(home_url('/')); ?>"><?php pll_e('Home'); ?></a>
			<span class="material-symbols-outlined text-xs">chevron_right</span>
			<a class="hover:text-primary transition-colors" href="<?php echo esc_url($cat_url); ?>"><?php echo esc_html($cat_name); ?></a>
			<span class="material-symbols-outlined text-xs">chevron_right</span>
			<span class="text-slate-900 dark:text-white"><?php echo esc_html($prod_name); ?></span>
		</nav>

		<div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-start">

			<!-- ============================================
		     PRODUCT IMAGE GALLERY
		     ============================================ -->
			<div class="flex flex-col gap-4">
				<!-- Main Image -->
				<div class="relative group">
					<div class="aspect-[4/5] rounded-3xl overflow-hidden bg-slate-100 dark:bg-slate-800 shadow-2xl">
						<img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
							alt="<?php echo esc_attr($prod_name); ?>"
							id="main-product-image"
							src="<?php echo esc_url($main_image_url); ?>">
					</div>
				</div>
				<!-- Thumbnails -->
				<?php if (count($all_images) > 1) : ?>
					<div class="grid grid-cols-4 gap-4">
						<?php foreach ($all_images as $idx => $img_url) : ?>
							<button class="aspect-square rounded-xl overflow-hidden border-2 <?php echo $idx === 0 ? 'border-primary ring-2 ring-primary/20' : 'border-transparent hover:border-primary/50'; ?> transition-all"
								onclick="document.getElementById('main-product-image').src='<?php echo esc_url($img_url); ?>'; this.parentElement.querySelectorAll('button').forEach(b => {b.classList.remove('border-primary','ring-2','ring-primary/20'); b.classList.add('border-transparent')}); this.classList.remove('border-transparent'); this.classList.add('border-primary','ring-2','ring-primary/20');">
								<img alt="<?php echo esc_attr($prod_name); ?> - <?php echo esc_attr($idx + 1); ?>" class="w-full h-full object-cover"
									src="<?php echo esc_url($img_url); ?>">
							</button>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
			</div>

			<!-- ============================================
		     PRODUCT INFO
		     ============================================ -->
			<div class="flex flex-col gap-8">
				<!-- Title & Price -->
				<div>
					<h1 class="text-4xl md:text-5xl font-display font-bold leading-[1.1] mb-4"><?php echo esc_html($prod_name); ?></h1>
					<div class="flex items-center gap-4">
						<span class="text-3xl font-light text-primary"><?php echo wp_kses_post($prod_price); ?></span>
						<span class="px-3 py-1 <?php echo $prod_in_stock ? 'bg-primary/10 text-primary' : 'bg-red-500/10 text-red-500'; ?> text-xs font-bold rounded-full uppercase tracking-wider product-stock-badge"><?php echo esc_html($prod_stock_text); ?></span>
					</div>
				</div>

				<!-- Description -->
				<div class="space-y-4">
					<?php if ($prod_short_desc) : ?>
						<div class="text-lg text-slate-600 dark:text-slate-400 leading-relaxed italic">
							<?php echo wp_kses_post($prod_short_desc); ?>
						</div>
					<?php elseif ($prod_desc) : ?>
						<div class="text-lg text-slate-600 dark:text-slate-400 leading-relaxed italic">
							<?php echo wp_kses_post(wp_trim_words(wp_strip_all_tags($prod_desc), 50, '...')); ?>
						</div>
					<?php endif; ?>

					<div class="flex flex-wrap gap-4 pt-4 border-t border-slate-200 dark:border-slate-700">
						<div class="flex items-center gap-2 text-sm text-slate-500">
							<span class="material-symbols-outlined text-primary">eco</span>
							<span class="product-feat-1"><?php pll_e('100% Natural Material'); ?></span>
						</div>
						<div class="flex items-center gap-2 text-sm text-slate-500">
							<span class="material-symbols-outlined text-primary">energy_savings_leaf</span>
							<span class="product-feat-2"><?php pll_e('Low-Voltage Pump'); ?></span>
						</div>
					</div>
				</div>

				<!-- Action Buttons -->
				<div class="flex flex-col sm:flex-row gap-4 pt-4">
					<?php if ($product->is_purchasable() && $prod_in_stock) : ?>
						<?php if ($product->is_type('simple')) : ?>
							<form class="flex-1 flex flex-col items-start min-w-0 w-full" action="<?php echo esc_url($product->add_to_cart_url()); ?>" method="post">
								<input type="hidden" name="add-to-cart" value="<?php echo esc_attr($product->get_id()); ?>">
								<?php if (! $product->is_sold_individually()) : ?>
									<?php
									$max_qty = $max_purchase_quantity;
									$max_attr = ($max_qty > 0) ? (string) $max_qty : '';
									?>
									<div class="mb-4 flex w-fit max-w-full flex-row flex-wrap items-center gap-2 self-start">
										<label id="single-product-qty-label" class="shrink-0 text-md font-medium text-slate-600 dark:text-slate-400">
											<?php echo esc_html(pll__('Quantity')) . ': '; ?>
										</label>
										<div
											class="single-product-qty inline-flex w-fit max-w-full shrink-0 items-center gap-2.5 py-1.5 px-2.5 bg-slate-50 dark:bg-slate-800/80 border border-slate-200 dark:border-slate-700 rounded-2xl gap-2"
											data-max="<?php echo esc_attr($max_attr); ?>"
											role="group"
											aria-labelledby="single-product-qty-label">
											<button type="button" class="qty-minus size-10 flex items-center justify-center text-slate-500 hover:text-primary hover:bg-primary/5 rounded-lg transition-colors shrink-0" aria-label="<?php esc_attr_e('Decrease quantity', 'luxe-landscape'); ?>">
												<span class="material-symbols-outlined text-xl">remove</span>
											</button>
											<span class="qty-display w-12 text-center font-display font-bold text-lg text-slate-800 dark:text-slate-200 tabular-nums" aria-live="polite">1</span>
											<input type="hidden" name="quantity" value="1" class="qty-input">
											<button type="button" class="qty-plus size-10 flex items-center justify-center text-primary hover:bg-primary/5 rounded-lg transition-colors shrink-0" aria-label="<?php esc_attr_e('Increase quantity', 'luxe-landscape'); ?>">
												<span class="material-symbols-outlined text-xl">add</span>
											</button>
										</div>
									</div>
								<?php else : ?>
									<input type="hidden" name="quantity" value="1">
								<?php endif; ?>
								<div class="flex w-full flex-col sm:flex-row gap-4">
									<button type="submit" class="w-full h-14 bg-primary text-slate-900 rounded-xl font-display font-bold text-lg hover:bg-primary/90 transition-all shadow-lg shadow-primary/20 flex items-center justify-center gap-2 sm:flex-1 cursor-pointer">
										<span class="material-symbols-outlined">add_shopping_cart</span>
										<span class="product-add-to-cart-text"><?php pll_e('Add to Cart'); ?></span>
									</button>
									<button type="button" class="flex-1 h-14 border-2 border-primary text-primary rounded-xl font-display font-bold text-lg hover:bg-primary/5 transition-all flex items-center justify-center gap-2 cursor-pointer">
										<span class="material-symbols-outlined">view_in_ar</span>
										<span class="product-ar-btn-text"><?php pll_e('View in 3D / AR'); ?></span>
										<span class="material-symbols-outlined text-sm">open_in_new</span>
									</button>
								</div>
							</form>
						<?php else : ?>
							<a href="<?php echo esc_url($product->add_to_cart_url()); ?>" class="flex-1 h-14 bg-primary text-slate-900 rounded-xl font-display font-bold text-lg hover:bg-primary/90 transition-all shadow-lg shadow-primary/20 flex items-center justify-center gap-2">
								<?php echo esc_html($product->add_to_cart_text()); ?>
							</a>
							<button type="button" class="flex-1 h-14 border-2 border-primary text-primary rounded-xl font-display font-bold text-lg hover:bg-primary/5 transition-all flex items-center justify-center gap-2 cursor-pointer">
								<span class="material-symbols-outlined">view_in_ar</span>
								<span class="product-ar-btn-text"><?php pll_e('View in 3D / AR'); ?></span>
								<span class="material-symbols-outlined text-sm">open_in_new</span>
							</button>
						<?php endif; ?>
					<?php else : ?>
						<button type="button" disabled class="flex-1 h-14 bg-slate-300 text-slate-500 rounded-xl font-display font-bold text-lg cursor-not-allowed flex items-center justify-center gap-2">
							<span class="material-symbols-outlined">remove_shopping_cart</span>
							<span class="product-out-of-stock-text"><?php pll_e('Out of Stock'); ?></span>
						</button>
						<button type="button" class="flex-1 h-14 border-2 border-primary text-primary rounded-xl font-display font-bold text-lg hover:bg-primary/5 transition-all flex items-center justify-center gap-2 cursor-pointer">
							<span class="material-symbols-outlined">view_in_ar</span>
							<span class="product-ar-btn-text"><?php pll_e('View in 3D / AR'); ?></span>
							<span class="material-symbols-outlined text-sm">open_in_new</span>
						</button>
					<?php endif; ?>
				</div>

				<!-- Product Meta -->
				<div class="text-sm text-slate-500 space-y-1 pt-4 border-t border-slate-200 dark:border-slate-700">
					<?php if ($product->get_sku()) : ?>
						<p><strong><?php pll_e('SKU:'); ?></strong> <?php echo esc_html($product->get_sku()); ?></p>
					<?php endif; ?>
					<?php
					$product_cats = wc_get_product_category_list($product->get_id(), ', ');
					if ($product_cats) :
					?>
						<p><strong><?php pll_e('Category:'); ?></strong> <?php echo wp_kses_post($product_cats); ?></p>
					<?php endif; ?>
				</div>

				<!-- Sustainability Footprint -->
				<div class="bg-primary/5 dark:bg-primary/10 rounded-2xl p-6 border border-primary/10">
					<h3 class="font-display font-bold mb-4 flex items-center gap-2 product-sustain-title">
						<span class="material-symbols-outlined text-primary">nature_people</span>
						<?php pll_e('Sustainability Footprint'); ?>
					</h3>
					<div class="grid grid-cols-2 gap-4">
						<div class="bg-white dark:bg-slate-800 p-4 rounded-xl shadow-sm">
							<div class="text-2xl font-display font-bold text-primary">98%</div>
							<div class="text-xs text-slate-500 font-medium product-sustain-1"><?php pll_e('Recycled Water Use'); ?></div>
						</div>
						<div class="bg-white dark:bg-slate-800 p-4 rounded-xl shadow-sm">
							<div class="text-2xl font-display font-bold text-primary">12kg</div>
							<div class="text-xs text-slate-500 font-medium product-sustain-2"><?php pll_e('CO2 Offset / Unit'); ?></div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- ============================================
	     TECHNICAL SPECIFICATIONS
	     ============================================ -->
		<section class="mt-24">
			<h2 class="text-3xl font-display font-bold mb-12 flex items-center gap-4 product-specs-title">
				<?php pll_e('Technical Specifications'); ?>
				<div class="h-px bg-slate-200 dark:bg-slate-700 flex-1"></div>
			</h2>
			<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
				<div class="p-8 bg-white dark:bg-slate-800 border border-slate-100 dark:border-slate-700 rounded-3xl shadow-sm hover:shadow-md transition-shadow">
					<div class="size-12 rounded-2xl bg-primary/10 text-primary flex items-center justify-center mb-6">
						<span class="material-symbols-outlined">straighten</span>
					</div>
					<div class="text-sm text-slate-400 font-medium mb-1 product-spec-label-1"><?php pll_e('Dimensions'); ?></div>
					<div class="text-xl font-display font-bold text-slate-800 dark:text-white"><?php echo $dimensions ? esc_html($dimensions) : esc_html(pll__('N/A')); ?></div>
				</div>
				<div class="p-8 bg-white dark:bg-slate-800 border border-slate-100 dark:border-slate-700 rounded-3xl shadow-sm hover:shadow-md transition-shadow">
					<div class="size-12 rounded-2xl bg-primary/10 text-primary flex items-center justify-center mb-6">
						<span class="material-symbols-outlined">diamond</span>
					</div>
					<div class="text-sm text-slate-400 font-medium mb-1 product-spec-label-2"><?php pll_e('Material'); ?></div>
					<div class="text-xl font-display font-bold text-slate-800 dark:text-white"><?php pll_e('Premium Grade'); ?></div>
				</div>
				<div class="p-8 bg-white dark:bg-slate-800 border border-slate-100 dark:border-slate-700 rounded-3xl shadow-sm hover:shadow-md transition-shadow">
					<div class="size-12 rounded-2xl bg-primary/10 text-primary flex items-center justify-center mb-6">
						<span class="material-symbols-outlined">weight</span>
					</div>
					<div class="text-sm text-slate-400 font-medium mb-1 product-spec-label-3"><?php pll_e('Weight'); ?></div>
					<div class="text-xl font-display font-bold text-slate-800 dark:text-white"><?php echo $weight ? esc_html($weight . ' kg') : esc_html(pll__('N/A')); ?></div>
				</div>
				<div class="p-8 bg-white dark:bg-slate-800 border border-slate-100 dark:border-slate-700 rounded-3xl shadow-sm hover:shadow-md transition-shadow">
					<div class="size-12 rounded-2xl bg-primary/10 text-primary flex items-center justify-center mb-6">
						<span class="material-symbols-outlined">bolt</span>
					</div>
					<div class="text-sm text-slate-400 font-medium mb-1 product-spec-label-4"><?php pll_e('Quality'); ?></div>
					<div class="text-xl font-display font-bold text-slate-800 dark:text-white"><?php pll_e('Handcrafted'); ?></div>
				</div>
			</div>
		</section>

		<!-- ============================================
	     RELATED PRODUCTS
	     ============================================ -->
		<?php
		$related_ids = wc_get_related_products($product->get_id(), 4);
		if (! empty($related_ids)) :
		?>
			<section class="mt-24">
				<h2 class="text-3xl font-display font-bold mb-12 flex items-center gap-4">
					<?php pll_e('You May Also Like'); ?>
					<div class="h-px bg-slate-200 dark:bg-slate-700 flex-1"></div>
				</h2>
				<div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-8">
					<?php foreach ($related_ids as $related_id) :
						$rp = wc_get_product($related_id);
						if (! $rp) continue;
						$rp_image = get_the_post_thumbnail_url($related_id, 'large') ?: wc_placeholder_img_src('large');
					?>
						<a href="<?php echo esc_url(get_permalink($related_id)); ?>" class="group cursor-pointer block">
							<div class="relative aspect-[4/5] rounded-2xl overflow-hidden bg-slate-200 dark:bg-slate-800 mb-4 shadow-[0_10px_40px_-10px_rgba(0,0,0,0.1)]">
								<div class="absolute inset-0 bg-cover bg-center transition-transform duration-500 group-hover:scale-110"
									style="background-image: url('<?php echo esc_url($rp_image); ?>')">
								</div>
								<?php if ($rp->is_on_sale()) : ?>
									<div class="absolute bottom-4 left-4">
										<span class="bg-primary text-slate-900 text-[10px] font-bold uppercase tracking-wider px-3 py-1 rounded-full"><?php pll_e('Sale'); ?></span>
									</div>
								<?php endif; ?>
							</div>
							<h3 class="font-display text-lg font-bold group-hover:text-primary transition-colors"><?php echo esc_html($rp->get_name()); ?></h3>
							<p class="font-display font-bold text-primary"><?php echo wp_kses_post($rp->get_price_html()); ?></p>
						</a>
					<?php endforeach; ?>
				</div>
			</section>
		<?php endif; ?>

	</main>

<?php endwhile; ?>

<script>
	document.addEventListener('click', function(event) {
		const wrap = event.target.closest('.single-product-qty');
		if (!wrap) {
			return;
		}
		const minus = event.target.closest('.qty-minus');
		const plus = event.target.closest('.qty-plus');
		if (!minus && !plus) {
			return;
		}
		const input = wrap.querySelector('.qty-input');
		const display = wrap.querySelector('.qty-display');
		if (!input || !display) {
			return;
		}
		const min = 1;
		const maxStr = wrap.getAttribute('data-max') || '';
		const max = maxStr !== '' ? parseInt(maxStr, 10) : 0;
		const current = parseInt(input.value || String(min), 10) || min;
		const next = minus ? current - 1 : current + 1;
		if (next < min || (max > 0 && next > max)) {
			return;
		}
		input.value = String(next);
		display.textContent = String(next);
	});
</script>

<?php luxe_landscape_get_footer(); ?>