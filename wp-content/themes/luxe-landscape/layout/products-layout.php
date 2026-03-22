<?php

/**
 * Shared Products Layout
 *
 * Used by WooCommerce shop and category archives.
 *
 * @package Luxe_Landscape
 */

if (! defined('ABSPATH')) {
	exit;
}

$categories = array();

if (class_exists('WooCommerce')) {
	$categories = get_terms(
		array(
			'taxonomy'   => 'product_cat',
			'hide_empty' => true,
			'exclude'    => array(get_option('default_product_cat')),
		)
	);
}

$current_cat    = is_product_category() ? get_queried_object() : null;
$current_cat_id = ($current_cat && ! is_wp_error($current_cat)) ? absint($current_cat->term_id) : 0;
$is_shop_page = function_exists('is_shop') && is_shop();
$shop_url     = home_url('/');
if (class_exists('WooCommerce')) {
	$shop_page_id = wc_get_page_id('shop');
	if ($shop_page_id > 0) {
		$shop_permalink_id = $shop_page_id;
		if (function_exists('pll_get_post')) {
			$translated_shop_id = pll_get_post($shop_page_id);
			if ($translated_shop_id) {
				$shop_permalink_id = $translated_shop_id;
			}
		}
		$shop_url = get_permalink($shop_permalink_id);
	}
}

$current_orderby = isset($_GET['orderby']) ? sanitize_text_field(wp_unslash($_GET['orderby'])) : 'menu_order';
$current_stock   = isset($_GET['stock']) ? sanitize_text_field(wp_unslash($_GET['stock'])) : '';

$sort_options = array(
	'menu_order' => pll__('Featured'),
	'price'      => pll__('Price: Low to High'),
	'price-desc' => pll__('Price: High to Low'),
	'date'       => pll__('Newest'),
);

$stock_options = array(
	''           => pll__('All'),
	'instock'    => pll__('In Stock Only'),
	'outofstock' => pll__('Out of Stock Only'),
);

$sort_label  = $sort_options[$current_orderby] ?? $sort_options['menu_order'];
$stock_label = $stock_options[$current_stock] ?? $stock_options[''];
?>

<main class="max-w-7xl mx-auto px-6 lg:px-12 py-8 mt-24">
	<div class="flex flex-col lg:flex-row gap-10">
		<aside class="w-full lg:w-64 flex-shrink-0">
			<div class="sticky top-28 space-y-8">
				<div class="flex items-center justify-between">
					<h2 class="font-display text-xl font-bold products-filter-title"><?php pll_e('Filters'); ?></h2>
					<span class="material-symbols-outlined cursor-pointer lg:hidden">tune</span>
				</div>

				<div class="space-y-4">
					<p class="text-xs font-bold uppercase tracking-widest text-primary/60 products-cat-label"><?php pll_e('Categories'); ?></p>
					<nav class="space-y-1">
						<?php
						$all_classes = $is_shop_page
							? 'flex items-center gap-3 px-4 py-2.5 rounded-xl bg-primary text-white transition-all group'
							: 'flex items-center gap-3 px-4 py-2.5 rounded-xl text-slate-600 dark:text-slate-400 hover:bg-primary/5 dark:hover:bg-primary/10 transition-all group';
						?>
						<a class="<?php echo esc_attr($all_classes); ?>" href="<?php echo esc_url($shop_url); ?>">
							<span class="material-symbols-outlined text-[20px] <?php echo $is_shop_page ? '' : 'text-primary/60'; ?>">grid_view</span>
							<span class="text-sm font-medium"><?php pll_e('All Collections'); ?></span>
						</a>

						<?php if (! empty($categories) && ! is_wp_error($categories)) : ?>
							<?php foreach ($categories as $cat) : ?>
								<?php
								$is_active = ($current_cat_id === absint($cat->term_id));
								$classes   = $is_active
									? 'flex items-center gap-3 px-4 py-2.5 rounded-xl bg-primary text-white transition-all group'
									: 'flex items-center gap-3 px-4 py-2.5 rounded-xl text-slate-600 dark:text-slate-400 hover:bg-primary/5 dark:hover:bg-primary/10 transition-all group';
								?>
								<a class="<?php echo esc_attr($classes); ?>" href="<?php echo esc_url(get_term_link($cat)); ?>">
									<span class="material-symbols-outlined text-[20px] <?php echo $is_active ? '' : 'text-primary/60'; ?>">potted_plant</span>
									<span class="text-sm font-medium"><?php echo esc_html($cat->name); ?></span>
									<span class="text-xs <?php echo $is_active ? 'text-white/80' : 'text-slate-400'; ?> ml-auto"><?php echo esc_html($cat->count); ?></span>
								</a>
							<?php endforeach; ?>
						<?php endif; ?>
					</nav>
				</div>

				<div class="pt-4">
					<div class="bg-primary/5 dark:bg-primary/10 p-6 rounded-2xl border border-primary/10">
						<p class="text-sm font-bold mb-2 products-cta-title"><?php pll_e('Bespoke Design'); ?></p>
						<p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed mb-4 products-cta-desc"><?php pll_e('Request a personalized landscape consultation with our lead designers.'); ?></p>
						<button class="w-full py-2 bg-primary text-slate-900 text-xs font-bold rounded-lg hover:bg-primary/90 transition-all uppercase tracking-wider products-cta-btn" type="button"><?php pll_e('Book Now'); ?></button>
					</div>
				</div>
			</div>
		</aside>

		<div class="flex-1 space-y-8">
			<section class="relative h-[320px] rounded-2xl overflow-hidden group">
				<div class="absolute inset-0 bg-cover bg-center transition-transform duration-700 group-hover:scale-105"
					style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuA0dRcANGH9TWVPdUqfOypHE7XKS6yggvbOHqwEZ5cu9ivWXAXaAG3oy_R4ZQG44gnBUtKFx2SECGcmtHG-9twew9s6W6ySjje2SJjBDsLg8hiTsoCnhz9_vkA24Qi_mg7jjCw3wXFbxH8MQz131R6yrPqvfmPK9hcE70rFNV_oULlEyT2gRXlyqrtG1a8ZEBfKH3yYWYZx_oMW_mXm0yRe_99Wbo7_OJSvtgOaOIV2WikNBGn4a7rtAnPCRSh3F053qOrtUmRUEkU')">
				</div>
				<div class="absolute inset-0 bg-gradient-to-r from-slate-900/80 via-slate-900/40 to-transparent"></div>
				<div class="absolute inset-0 flex flex-col justify-center px-12 space-y-4">
					<span class="text-primary font-bold uppercase tracking-[0.3em] text-xs products-hero-label"><?php pll_e('New Collection 2024'); ?></span>
					<h2 class="font-display text-4xl md:text-5xl font-bold text-white max-w-md products-hero-title"><?php pll_e('Curated Outdoor Elegance'); ?></h2>
					<p class="text-white/80 max-w-xs text-sm products-hero-desc"><?php pll_e('Elevate your exterior spaces with our hand-carved stone features and rare botanicals.'); ?></p>
				</div>
			</section>

			<div class="flex flex-col sm:flex-row items-center justify-between gap-4">
				<nav class="flex items-center gap-2 text-sm">
					<a class="text-slate-400 hover:text-primary transition-colors" href="<?php echo esc_url(home_url('/')); ?>"><?php pll_e('Home'); ?></a>
					<span class="material-symbols-outlined text-[14px] text-slate-400">chevron_right</span>
					<a class="text-slate-400 hover:text-primary transition-colors" href="<?php echo esc_url($shop_url); ?>"><?php pll_e('products'); ?></a>
					<?php if ($current_cat && ! is_wp_error($current_cat)) : ?>
						<span class="material-symbols-outlined text-[14px] text-slate-400">chevron_right</span>
						<span class="text-slate-900 dark:text-white font-semibold"><?php echo esc_html($current_cat->name); ?></span>
					<?php endif; ?>
				</nav>
				<div class="flex items-center gap-2 overflow-x-auto pb-2 sm:pb-0 w-full sm:w-auto no-scrollbar">
					<div class="relative filter-dropdown">
						<button class="filter-dropdown-trigger flex items-center gap-2 px-4 py-1.5 rounded-full bg-primary/5 dark:bg-primary/10 border border-primary/10 text-xs font-semibold whitespace-nowrap" type="button" aria-expanded="false" data-dropdown="sort-options">
							<span class="products-sort-btn-label"><?php echo esc_html(sprintf(pll__('Sort by: %s'), $sort_label)); ?></span>
							<span class="material-symbols-outlined text-[16px]">expand_more</span>
						</button>
						<div id="sort-options" class="filter-dropdown-menu hidden absolute z-20 mt-2 w-56 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 shadow-xl p-1">
							<?php foreach ($sort_options as $value => $label) : ?>
								<button type="button"
									class="filter-option w-full text-left px-3 py-2 rounded-lg text-xs font-medium hover:bg-primary/10 transition-colors <?php echo $current_orderby === $value ? 'bg-primary/10 text-primary' : 'text-slate-700 dark:text-slate-200'; ?>"
									data-param="orderby"
									data-value="<?php echo esc_attr($value === 'menu_order' ? '' : $value); ?>">
									<span class="products-sort-opt-<?php echo esc_attr($value); ?>"><?php echo esc_html($label); ?></span>
								</button>
							<?php endforeach; ?>
						</div>
					</div>
					<div class="relative filter-dropdown">
						<button class="filter-dropdown-trigger flex items-center gap-2 px-4 py-1.5 rounded-full bg-primary/5 dark:bg-primary/10 border border-primary/10 text-xs font-semibold whitespace-nowrap" type="button" aria-expanded="false" data-dropdown="stock-options">
							<span class="products-avail-btn-label"><?php echo esc_html(sprintf(pll__('Availability: %s'), $stock_label)); ?></span>
							<span class="material-symbols-outlined text-[16px]">expand_more</span>
						</button>
						<div id="stock-options" class="filter-dropdown-menu hidden absolute z-20 mt-2 w-56 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 shadow-xl p-1">
							<?php foreach ($stock_options as $value => $label) : ?>
								<button type="button"
									class="filter-option w-full text-left px-3 py-2 rounded-lg text-xs font-medium hover:bg-primary/10 transition-colors <?php echo $current_stock === $value ? 'bg-primary/10 text-primary' : 'text-slate-700 dark:text-slate-200'; ?>"
									data-param="stock"
									data-value="<?php echo esc_attr($value); ?>">
									<span class="products-stock-opt-<?php echo esc_attr($value === '' ? 'all' : $value); ?>"><?php echo esc_html($label); ?></span>
								</button>
							<?php endforeach; ?>
						</div>
					</div>
					<button class="flex items-center gap-2 px-4 py-1.5 rounded-full bg-primary/5 dark:bg-primary/10 border border-primary/10 text-xs font-semibold whitespace-nowrap products-eco-btn" type="button">
						<?php pll_e('Eco-Friendly'); ?>
					</button>
				</div>
			</div>

			<?php do_action('woocommerce_before_shop_loop'); ?>

			<?php if (woocommerce_product_loop()) : ?>
				<div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-8">
					<?php while (have_posts()) : ?>
						<?php the_post(); ?>
						<?php wc_get_template_part('content', 'product'); ?>
					<?php endwhile; ?>
				</div>

				<?php
				$paged = max(1, absint(get_query_var('paged')));
				$total = absint($GLOBALS['wp_query']->max_num_pages ?? 1);
				if ($total > 1) :
				?>
					<div class="flex items-center justify-center gap-4 pt-12 pb-20">
						<?php if ($paged > 1) : ?>
							<a href="<?php echo esc_url(get_pagenum_link($paged - 1)); ?>" class="w-10 h-10 rounded-full border border-slate-200 dark:border-slate-700 flex items-center justify-center hover:bg-primary hover:text-slate-900 transition-all">
								<span class="material-symbols-outlined">chevron_left</span>
							</a>
						<?php endif; ?>
						<div class="flex gap-2">
							<?php for ($p = 1; $p <= $total; $p++) : ?>
								<?php if ($p === $paged) : ?>
									<span class="w-10 h-10 rounded-full bg-primary text-slate-900 font-bold flex items-center justify-center"><?php echo esc_html($p); ?></span>
								<?php else : ?>
									<a href="<?php echo esc_url(get_pagenum_link($p)); ?>" class="w-10 h-10 rounded-full border border-slate-200 dark:border-slate-700 font-bold hover:bg-primary/5 flex items-center justify-center"><?php echo esc_html($p); ?></a>
								<?php endif; ?>
							<?php endfor; ?>
						</div>
						<?php if ($paged < $total) : ?>
							<a href="<?php echo esc_url(get_pagenum_link($paged + 1)); ?>" class="w-10 h-10 rounded-full border border-slate-200 dark:border-slate-700 flex items-center justify-center hover:bg-primary hover:text-slate-900 transition-all">
								<span class="material-symbols-outlined">chevron_right</span>
							</a>
						<?php endif; ?>
					</div>
				<?php endif; ?>
			<?php else : ?>
				<?php do_action('woocommerce_no_products_found'); ?>
			<?php endif; ?>
		</div>
	</div>
</main>