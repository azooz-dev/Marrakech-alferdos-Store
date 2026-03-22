<?php

/**
 * Front Page Template
 *
 * Homepage with all 6 sections:
 * 1. Hero (GSAP animated)
 * 2. Bento Category Grid
 * 3. Trending Products Carousel
 * 4. Our Impact in Numbers (NEW)
 * 5. B2B / Wholesale Section
 * 6. Footer (via layout/footer.php)
 *
 * @package Luxe_Landscape
 */

if (! defined('ABSPATH')) {
	exit;
}

luxe_landscape_get_header();

// ==============================================================
// Get WooCommerce data (categories + products)
// ==============================================================
$categories = array();
$products   = array();

if (class_exists('WooCommerce')) {
	$categories = get_terms(array(
		'taxonomy'   => 'product_cat',
		'hide_empty' => true,
		'number'     => 4,
		'exclude'    => array(get_option('default_product_cat')),
	));

	$products = wc_get_products(array(
		'limit'   => 8,
		'orderby' => 'date',
		'order'   => 'DESC',
		'status'  => 'publish',
	));
}

// Hero background video URL from Customizer (sanitized on save with esc_url_raw)
$hero_video_url = get_theme_mod('luxe_hero_video', '');

// ==============================================================
// Bento grid layout for first 4 categories (explicit grid lines + heading size).
// Uses col-start/end + row-start/end so LTR fills the same shape as RTL (grid mirrors in RTL).
// Avoids auto-placement + grid-flow-dense gaps that showed in English only.
// ==============================================================
$category_bento_slots = array(
	array(
		'span'    => 'md:col-start-1 md:col-end-2 md:row-start-1 md:row-end-3',
		'heading' => 'text-2xl',
	),
	array(
		'span'    => 'md:col-start-2 md:col-end-5 md:row-start-1 md:row-end-2',
		'heading' => 'text-3xl',
	),
	array(
		'span'    => 'md:col-start-2 md:col-end-3 md:row-start-2 md:row-end-3',
		'heading' => 'text-xl',
	),
	array(
		'span'    => 'md:col-start-3 md:col-end-5 md:row-start-2 md:row-end-3',
		'heading' => 'text-2xl',
	),
);

?>

<!-- ====================================================
     SECTION 1: IMMERSIVE HERO (full-screen video)
     ==================================================== -->
<section class="relative min-h-screen flex items-center justify-center overflow-hidden px-6 pt-20">
	<?php if (! empty($hero_video_url)) : ?>
		<video id="hero-bg-video" class="absolute inset-0 w-full h-full object-cover -z-10" autoplay muted loop playsinline>
			<source src="<?php echo esc_url($hero_video_url, array('http', 'https')); ?>" type="video/mp4">
		</video>
	<?php else : ?>
		<div class="absolute inset-0 -z-10 bg-gradient-to-b from-slate-900 via-emerald-950/90 to-slate-900" aria-hidden="true"></div>
	<?php endif; ?>
	<div class="video-overlay absolute inset-0 -z-[5] pointer-events-none" aria-hidden="true"></div>

	<div class="relative z-10 max-w-4xl mx-auto w-full text-center space-y-8 py-16">
		<h1 class="text-5xl md:text-7xl lg:text-8xl font-bold leading-[0.95] tracking-tight text-white hero-animate-in hero-text-shadow">
			<span class="hero-title-1 block"><?php pll_e('Transform Your Space with'); ?></span>
			<span class="text-primary hero-title-accent"><?php pll_e('Maraken alferdos'); ?></span>
		</h1>
		<p class="text-lg md:text-xl text-white/90 max-w-2xl mx-auto hero-animate-in hero-subtitle hero-text-shadow">
			<?php pll_e('Experience the pinnacle of biophilic design with our ultra-premium outdoor collections, engineered for the world\'s most prestigious properties.'); ?>
		</p>
		<div class="flex flex-wrap justify-center gap-4 pt-4 hero-animate-in">
			<a href="<?php echo class_exists('WooCommerce') ? esc_url(wc_get_page_permalink('shop')) : '#'; ?>" class="bg-primary hover:bg-primary/90 text-slate-900 font-bold px-10 py-5 rounded-xl transition-all shadow-xl shadow-primary/20 inline-flex items-center gap-2">
				<span class="hero-cta-shop"><?php pll_e('Shop Collection'); ?></span> <span class="material-symbols-outlined rtl:rotate-180" aria-hidden="true">arrow_forward</span>
			</a>
			<a href="#b2b-section" class="border-2 border-white/40 hover:border-primary text-white font-bold px-10 py-5 rounded-xl transition-all">
				<span class="hero-cta-b2b"><?php pll_e('Request B2B Quote'); ?></span>
			</a>
		</div>
	</div>
	<?php if (! empty($hero_video_url)) : ?>
		<script>
			(function() {
				var v = document.getElementById('hero-bg-video');
				if (v) {
					v.playbackRate = 0.7;
				}
			})();
		</script>
	<?php endif; ?>
</section>

<!-- ====================================================
     SECTION 2: BENTO BOX CATEGORY GRID
     ==================================================== -->
<section class="max-w-7xl mx-auto px-6 py-24">
	<div class="flex justify-between items-end mb-12">
		<div>
			<h2 class="text-4xl font-bold section-title-categories"><?php esc_html_e('Explore Our World', 'luxe-landscape'); ?></h2>
			<p class="text-slate-500 mt-2 section-subtitle-categories"><?php esc_html_e('Curated categories for professional landscaping.', 'luxe-landscape'); ?></p>
		</div>
		<a class="text-primary font-bold flex items-center gap-2 group section-link" href="<?php echo class_exists('WooCommerce') ? esc_url(wc_get_page_permalink('shop')) : '#'; ?>">
			<span class="section-link-categories"><?php esc_html_e('View All Categories', 'luxe-landscape'); ?></span>
			<span class="material-symbols-outlined group-hover:translate-x-1 transition-transform">east</span>
		</a>
	</div>

	<div class="grid grid-cols-1 md:grid-cols-4 md:grid-rows-2 md:grid-flow-dense gap-4 min-h-[600px] md:h-[800px] md:auto-rows-fr">
		<?php
		$use_wc = ! empty($categories) && ! is_wp_error($categories);
		if (! $use_wc) :
		?>
			<div class="md:col-span-4 flex items-center justify-center rounded-3xl bg-slate-100 dark:bg-slate-800/50 text-slate-500 dark:text-slate-400 p-12 text-center">
				<p><?php esc_html_e('Add product categories in WooCommerce to display them here.', 'luxe-landscape'); ?></p>
			</div>
			<?php
		else :
			foreach ($categories as $i => $cat) :
				$slot         = $category_bento_slots[$i] ?? $category_bento_slots[0];
				$cat_span     = $slot['span'];
				$cat_h        = $slot['heading'];
				$cat_name     = $cat->name;
				$cat_count    = $cat->count . ' ' . __('Products', 'luxe-landscape');
				$thumbnail_id = get_term_meta($cat->term_id, 'thumbnail_id', true);
				$cat_image    = $thumbnail_id ? wp_get_attachment_url($thumbnail_id) : (function_exists('wc_placeholder_img_src') ? wc_placeholder_img_src('full') : '');
				$cat_link     = get_term_link($cat);
				if (is_wp_error($cat_link)) {
					$cat_link = '#';
				}
			?>
				<a href="<?php echo esc_url($cat_link); ?>" class="<?php echo esc_attr($cat_span); ?> relative group overflow-hidden rounded-3xl block min-h-[280px] md:min-h-0 h-full">
					<img class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
						src="<?php echo esc_url($cat_image); ?>"
						alt="<?php echo esc_attr($cat_name); ?>">
					<div class="absolute inset-0 bento-gradient flex flex-col justify-end p-8">
						<h3 class="<?php echo esc_attr($cat_h); ?> font-bold text-white"><?php echo esc_html($cat_name); ?></h3>
						<div class="flex items-center justify-between mt-4 opacity-0 group-hover:opacity-100 transition-opacity w-fit gap-4">
							<span class="text-white/80 text-sm"><?php echo esc_html($cat_count); ?></span>
							<?php if (defined('ICL_LANGUAGE_CODE') && ICL_LANGUAGE_CODE === 'ar') : ?>
								<span class="material-symbols-outlined text-white" style="transform: scaleX(-1);">trending_flat</span>
							<?php else : ?>
								<span class="material-symbols-outlined text-white">trending_flat</span>
							<?php endif; ?>
						</div>
					</div>
				</a>
		<?php endforeach;
		endif;
		?>
	</div>
</section>

<!-- ====================================================
     SECTION 3: TRENDING PRODUCTS CAROUSEL
     ==================================================== -->
<section class="bg-background-light dark:bg-background-dark py-24 overflow-hidden">
	<div class="max-w-7xl mx-auto px-6 mb-12 flex items-center justify-between">
		<h2 class="text-4xl font-bold section-title-trending"><?php esc_html_e('Trending Now', 'luxe-landscape'); ?></h2>
		<div class="flex gap-2">
			<button id="trending-prev" class="size-12 rounded-full border border-slate-200 dark:border-slate-700 flex items-center justify-center hover:bg-white dark:hover:bg-slate-800 transition-colors" aria-label="<?php esc_attr_e('Previous', 'luxe-landscape'); ?>">
				<span class="material-symbols-outlined">chevron_left</span>
			</button>
			<button id="trending-next" class="size-12 rounded-full border border-slate-200 dark:border-slate-700 flex items-center justify-center hover:bg-white dark:hover:bg-slate-800 transition-colors" aria-label="<?php esc_attr_e('Next', 'luxe-landscape'); ?>">
				<span class="material-symbols-outlined">chevron_right</span>
			</button>
		</div>
	</div>

	<div class="flex gap-8 overflow-x-auto pb-8 px-6 no-scrollbar snap-x" id="products-scroll">
		<?php
		if (empty($products)) :
		?>
			<div class="min-w-full flex items-center justify-center rounded-3xl bg-slate-100 dark:bg-slate-800/50 text-slate-500 dark:text-slate-400 py-16 px-8 text-center">
				<p><?php esc_html_e('Add products in WooCommerce to display them here.', 'luxe-landscape'); ?></p>
			</div>
			<?php
		else :
			foreach ($products as $product) :
				$prod_name  = $product->get_name();
				$prod_img_id = $product->get_image_id();
				$prod_image = $prod_img_id ? wp_get_attachment_url($prod_img_id) : (function_exists('wc_placeholder_img_src') ? wc_placeholder_img_src('full') : '');
				$prod_price = wc_price($product->get_price());
				$prod_sale  = $product->is_on_sale() ? wc_price($product->get_regular_price()) : '';
				$prod_badge = $product->is_on_sale() ? __('SALE', 'luxe-landscape') : '';
				$prod_url   = get_permalink($product->get_id());
				$can_ajax_add = $product->is_type('simple') && $product->is_purchasable() && $product->is_in_stock();
			?>
				<div class="min-w-[320px] snap-start group">
					<a href="<?php echo esc_url($prod_url); ?>">
						<div class="relative aspect-square bg-white dark:bg-slate-900 rounded-3xl overflow-hidden mb-4">
							<img class="w-full h-full object-cover transition-transform group-hover:scale-105"
								src="<?php echo esc_url($prod_image); ?>"
								alt="<?php echo esc_attr($prod_name); ?>">
							<?php if ($prod_badge) : ?>
								<span class="absolute top-4 left-4 bg-primary text-slate-900 font-bold px-3 py-1 rounded-full text-xs"><?php echo esc_html($prod_badge); ?></span>
							<?php endif; ?>
						</div>
					</a>
					<?php if ($can_ajax_add) : ?>
						<div class="-mt-16 mb-4 pr-4 flex justify-end relative z-10" onclick="event.preventDefault();event.stopPropagation();">
							<a
								href="<?php echo esc_url($product->add_to_cart_url()); ?>"
								class="add_to_cart_button ajax_add_to_cart size-12 bg-slate-900 text-white rounded-full flex items-center justify-center opacity-0 translate-y-4 group-hover:opacity-100 group-hover:translate-y-0 transition-all"
								data-product_id="<?php echo esc_attr($product->get_id()); ?>"
								data-product_sku="<?php echo esc_attr($product->get_sku()); ?>"
								data-quantity="1"
								aria-label="<?php echo esc_attr(sprintf(__('Add %s to cart', 'luxe-landscape'), wp_strip_all_tags($prod_name))); ?>"
								rel="nofollow">
								<span class="material-symbols-outlined">add</span>
							</a>
						</div>
					<?php endif; ?>
					<h4 class="font-bold text-lg"><?php echo esc_html($prod_name); ?></h4>
					<div class="flex items-center gap-3 mt-1">
						<?php if ($prod_sale) : ?>
							<span class="text-slate-400 line-through"><?php echo wp_kses_post($prod_sale); ?></span>
						<?php endif; ?>
						<span class="text-xl font-bold text-primary"><?php echo wp_kses_post($prod_price); ?></span>
					</div>
				</div>
		<?php endforeach;
		endif;
		?>
	</div>
</section>

<!-- ====================================================
     SECTION 4: OUR IMPACT IN NUMBERS (NEW)
     ==================================================== -->
<section class="bg-background-light dark:bg-background-dark py-24 overflow-hidden">
	<div class="max-w-7xl mx-auto px-6 text-center mb-16">
		<h2 class="text-4xl font-bold mb-4 section-title-impact"><?php esc_html_e('Our Impact in Numbers', 'luxe-landscape'); ?></h2>
		<p class="text-slate-500 max-w-2xl mx-auto section-subtitle-impact"><?php esc_html_e('Quantifying our commitment to excellence and biophilic growth over the last month.', 'luxe-landscape'); ?></p>
	</div>

	<?php
	$impact_1 = absint(get_theme_mod('luxe_impact_1', 120));
	$impact_2 = absint(get_theme_mod('luxe_impact_2', 45));
	$impact_3 = absint(get_theme_mod('luxe_impact_3', 1250));
	$impact_4 = absint(get_theme_mod('luxe_impact_4', 8));
	?>
	<div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8" id="impact-stats">
		<!-- Stat 1 -->
		<div class="bg-white dark:bg-[rgba(15,35,42,0.61)] p-10 rounded-[2.5rem] shadow-[0_20px_50px_rgba(0,0,0,0.04)] text-center transform hover:-translate-y-2 transition-transform duration-300">
			<div class="text-5xl font-bold text-primary mb-3 font-display">
				<span class="stat-number" data-target="<?php echo esc_attr($impact_1); ?>">0</span>+
			</div>
			<p class="text-slate-600 dark:text-slate-400 font-['Outfit'] font-medium text-lg impact-label-1"><?php esc_html_e('Luxury Projects Completed', 'luxe-landscape'); ?></p>
		</div>
		<!-- Stat 2 -->
		<div class="bg-white dark:bg-[rgba(15,35,42,0.61)] p-10 rounded-[2.5rem] shadow-[0_20px_50px_rgba(0,0,0,0.04)] text-center transform hover:-translate-y-2 transition-transform duration-300">
			<div class="text-5xl font-bold text-primary mb-3 font-display">
				<span class="stat-number" data-target="<?php echo esc_attr($impact_2); ?>">0</span>
			</div>
			<p class="text-slate-600 dark:text-slate-400 font-['Outfit'] font-medium text-lg impact-label-2"><?php esc_html_e('New Premium Clients', 'luxe-landscape'); ?></p>
		</div>
		<!-- Stat 3 -->
		<div class="bg-white dark:bg-[rgba(15,35,42,0.61)] p-10 rounded-[2.5rem] shadow-[0_20px_50px_rgba(0,0,0,0.04)] text-center transform hover:-translate-y-2 transition-transform duration-300">
			<div class="text-5xl font-bold text-primary mb-3 font-display">
				<span class="stat-number" data-target="<?php echo esc_attr($impact_3); ?>">0</span>+
			</div>
			<p class="text-slate-600 dark:text-slate-400 font-['Outfit'] font-medium text-lg impact-label-3"><?php esc_html_e('Products Delivered', 'luxe-landscape'); ?></p>
		</div>
		<!-- Stat 4 -->
		<div class="bg-white dark:bg-[rgba(15,35,42,0.61)] p-10 rounded-[2.5rem] shadow-[0_20px_50px_rgba(0,0,0,0.04)] text-center transform hover:-translate-y-2 transition-transform duration-300">
			<div class="text-5xl font-bold text-primary mb-3 font-display">
				<span class="stat-number" data-target="<?php echo esc_attr($impact_4); ?>">0</span>
			</div>
			<p class="text-slate-600 dark:text-slate-400 font-['Outfit'] font-medium text-lg impact-label-4"><?php esc_html_e('Global Partner Factories', 'luxe-landscape'); ?></p>
		</div>
	</div>
</section>

<!-- ====================================================
     SECTION 5: B2B / WHOLESALE
     ==================================================== -->
<section class="max-w-7xl mx-auto px-6 py-24" id="b2b-section">
	<div class="bg-neutral-charcoal text-white rounded-[3rem] p-12 lg:p-24 grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
		<?php
		$luxe_b2b_status = isset($_GET['luxe_b2b']) ? sanitize_text_field(wp_unslash($_GET['luxe_b2b'])) : '';
		if ($luxe_b2b_status) :
			$notice_class = $luxe_b2b_status === 'success' ? 'bg-emerald-500/20 text-emerald-200' : ($luxe_b2b_status === 'invalid' ? 'bg-amber-500/20 text-amber-200' : 'bg-red-500/20 text-red-200');
		?>
			<div class="lg:col-span-2 rounded-2xl p-4 text-center <?php echo esc_attr($notice_class); ?>">
				<?php
				if ($luxe_b2b_status === 'success') {
					esc_html_e("Thank you, we'll contact you soon.", 'luxe-landscape');
				} elseif ($luxe_b2b_status === 'invalid') {
					esc_html_e('Please fill in your name and phone.', 'luxe-landscape');
				} else {
					esc_html_e('Something went wrong. Please try again.', 'luxe-landscape');
				}
				?>
			</div>
		<?php endif; ?>
		<!-- B2B Content -->
		<div class="space-y-8">
			<span class="text-primary font-bold tracking-[0.2em] uppercase b2b-label"><?php esc_html_e('B2B & Projects', 'luxe-landscape'); ?></span>
			<h2 class="text-4xl md:text-6xl font-bold leading-tight b2b-title"><?php esc_html_e('Building a Mega Project? Get Direct Factory Pricing.', 'luxe-landscape'); ?></h2>
			<p class="text-slate-400 text-lg b2b-desc"><?php esc_html_e('We partner with architects, real estate developers, and hospitality giants to provide bespoke landscaping solutions at scale.', 'luxe-landscape'); ?></p>
			<div class="flex items-center gap-8 pt-4">
				<div class="flex flex-col">
					<span class="text-3xl font-bold text-white"><?php echo esc_html(get_theme_mod('luxe_b2b_stat_1', '500+')); ?></span>
					<span class="text-slate-500 text-sm b2b-stat-label-1"><?php esc_html_e('Hotel Projects', 'luxe-landscape'); ?></span>
				</div>
				<div class="w-px h-12 bg-slate-800"></div>
				<div class="flex flex-col">
					<span class="text-3xl font-bold text-white"><?php echo esc_html(get_theme_mod('luxe_b2b_stat_2', '15yr')); ?></span>
					<span class="text-slate-500 text-sm b2b-stat-label-2"><?php esc_html_e('Contract Life', 'luxe-landscape'); ?></span>
				</div>
			</div>
		</div>

		<!-- B2B Form -->
		<div class="bg-white/5 p-8 rounded-3xl border border-white/10 backdrop-blur-sm">
			<form class="space-y-6" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post">
				<?php wp_nonce_field('luxe_b2b_submit', 'luxe_b2b_nonce'); ?>
				<input type="hidden" name="action" value="luxe_b2b_submit" />
				<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
					<input name="luxe_b2b_name" class="w-full bg-white/5 border-white/10 rounded-xl px-4 py-4 text-white placeholder:text-slate-500 focus:ring-primary focus:border-primary" placeholder="<?php esc_attr_e('Full Name', 'luxe-landscape'); ?>" type="text" required>
					<input name="luxe_b2b_project_size" class="w-full bg-white/5 border-white/10 rounded-xl px-4 py-4 text-white placeholder:text-slate-500 focus:ring-primary focus:border-primary" placeholder="<?php esc_attr_e('Project Size (sqm)', 'luxe-landscape'); ?>" type="text">
				</div>
				<input name="luxe_b2b_phone" class="w-full bg-white/5 border-white/10 rounded-xl px-4 py-4 text-white placeholder:text-slate-500 focus:ring-primary focus:border-primary" placeholder="<?php esc_attr_e('Phone Number', 'luxe-landscape'); ?>" type="tel" required>
				<textarea name="luxe_b2b_message" class="w-full bg-white/5 border-white/10 rounded-xl px-4 py-4 text-white placeholder:text-slate-500 focus:ring-primary focus:border-primary" placeholder="<?php esc_attr_e('Tell us about your project', 'luxe-landscape'); ?>" rows="3"></textarea>
				<button class="w-full bg-primary text-slate-900 font-bold py-5 rounded-xl transition-all hover:bg-primary/90 b2b-submit" type="submit">
					<?php esc_html_e('Request Project Quote', 'luxe-landscape'); ?>
				</button>
			</form>
		</div>
	</div>
</section>

<?php luxe_landscape_get_footer(); ?>