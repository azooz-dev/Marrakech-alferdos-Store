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

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

luxe_landscape_get_header();

// ==============================================================
// Get WooCommerce data (categories + products)
// ==============================================================
$categories = array();
$products   = array();

if ( class_exists( 'WooCommerce' ) ) {
	$categories = get_terms( array(
		'taxonomy'   => 'product_cat',
		'hide_empty' => true,
		'number'     => 4,
		'exclude'    => array( get_option( 'default_product_cat' ) ),
	) );

	$products = wc_get_products( array(
		'limit'   => 8,
		'orderby' => 'date',
		'order'   => 'DESC',
		'status'  => 'publish',
	) );
}

// ==============================================================
// Fallback category data (from Stitch design)
// ==============================================================
$fallback_categories = array(
	array(
		'name'    => __( 'Illuminated Planters', 'luxe-landscape' ),
		'count'   => 34,
		'image'   => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBL5BL5e3uj2J57nNKmsRRixXGM2ZJApfJBvPNyWrfIrJo0C6na2_UiT2wJXJJHQMaVVDQASNoT_pN4ua0MVbBGec4xLhMrWeulVnyRDGWsSTaOpBL1HM4udj34ri6Oke3PvClyBUs-bLoBOoa3OI-Wzxzq2cALQcyDV380Y3FzqZPpddzy0JULjHqAd7txjZlZslqTvVo5jpWUs8FsBg8ZzeOgYMDjHV5Om9mu-VcjDOF6y2d3nrHcGgzzh4_3RDOahnDKxmD9ObM',
		'span'    => 'md:col-span-1 md:row-span-2',
		'heading' => 'text-2xl',
	),
	array(
		'name'    => __( 'Modern Fountains', 'luxe-landscape' ),
		'count'   => __( 'Collection 2024', 'luxe-landscape' ),
		'image'   => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBWOd9p3HIOcgeiH3kUrKSPsDhe6Cpv30bcP5FtHMedhTzYZdZC6QYJz5Ggxx57D45OZsA-HUTsKoM1glO-ytQBKHn2ZrAGMSjR1aGCDnC72MRXmKYUWXX-CyIx33ZjULkKYgod91RblT-PszLtoftaf85hyrdyyo__EKqWWA7IqF9VqI5GSdj4e4EXhJb0iAdX5asWpcIrFPInhnN-QRTvihYe0SJwa5SdiSP5uKO3ckUcKUCbYpADOs0ZPVC2pyVLGdglMvjWrVQ',
		'span'    => 'md:col-span-3 md:row-span-1',
		'heading' => 'text-3xl',
	),
	array(
		'name'    => __( 'Garden Seating', 'luxe-landscape' ),
		'count'   => '',
		'image'   => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCbI_6W3IF5Xxb6TCIEgQcO6LDvYfbmDtle8wSdmsvYaeQj64wP8DE3pZePUOcroUUV1WR_Tqby-OC4c-5ZeA73ng_qlIOYAKKjnoXuZheG4RiqaH-tLVWWAr0gvRMNBJNB60tlmysyqalH9GYLLmw1rNChYiQuOdm0WBM1GLGDgwUL5ygBauVWFytgcoi3_1T0yCZE2znuDAY7_V0uzmE61FWHwAEiypqLIWVyVyRzcYBVNQzc_M483W9Qh0J-Qx2ukIAimtKADHs',
		'span'    => 'md:col-span-1 md:row-span-1',
		'heading' => 'text-xl',
	),
	array(
		'name'    => __( 'Stone Waterfalls', 'luxe-landscape' ),
		'count'   => '',
		'image'   => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBYcy0t6uaatDbhDgDYh7hUhvroSbxRFIcSXIr9IvAwpVJzywDkMIuugVmRPxth5RQyhiIHF4rrb67RyOnQylcbtN4kJ8rs-ayjOWBrG8vQsIOAEcYKw6u89jXThgmvGhSFwMA0cZPfpKceTKuDKnzioziSe7FYy4GhQtwo4_KFGCrGAZZuKPQN_bzDCNQbhksx09_knfN97Hq8NsBhF5j1QsJUU_e6zMjnULiC7fDW4vzEBgGNcpmhmqpZlkXetPOcvxp4Pyj_gHY',
		'span'    => 'md:col-span-2 md:row-span-1',
		'heading' => 'text-2xl',
	),
);

// ==============================================================
// Fallback products data (from Stitch design)
// ==============================================================
$fallback_products = array(
	array(
		'name'    => __( 'Lunar Sphere Planter', 'luxe-landscape' ),
		'price'   => '$445',
		'old'     => '$890',
		'badge'   => '50% OFF',
		'image'   => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBczq5e-n9u6tK2-lvwa6B6t4VmWGIp-TzfymPVpY_RXvqZgyH-y_hZIKlv0xgZ5YjI880zTIbwkzyDibXYQt6qYZf29deSpHJkvnfOeU43AimNr7LbgRpkircgfGJVp2jNr_d55BlCIlSd8r6sHKZzIEEBaETmBlceo-rHU-6Ucop7Dr3chlgaMKHozHCIgnSICHXq_jR9eigcv7CW_aev308IqOBETMubsFcanEHL9r1VhOs2hwY1JBrvO71hC1AYszZYIyZDurY',
	),
	array(
		'name'    => __( 'Obsidian Totem', 'luxe-landscape' ),
		'price'   => '$600',
		'old'     => '$1,200',
		'badge'   => '50% OFF',
		'image'   => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCFumv7ULRBMUB1Vj9xxodb-M1_IWOjLESPeYkhxryOvTELDN7s19r7bgGdQYZP3QOE6M_AuvnfDFjeVjw82LOAI2TG7W6G46ELbEf5WWcfi7jQeoZ-tsAlPMsD7OuKQ37Ts-EeVBEoL1BOh1Gy5pzVL90GgkuFGQ5qNQt6gM5WgyQJzSPKP2cEZIwj6qqRdX6nDQL5Ssle02_mLo33rkIm5UeV9zFKN-jGZGzXZBIgLbglWTHgLwr1odlDhhbbgqbWz6pfpaZxnro',
	),
	array(
		'name'    => __( 'Magma Fire Bowl', 'luxe-landscape' ),
		'price'   => '$1,200',
		'old'     => '$2,400',
		'badge'   => '50% OFF',
		'image'   => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCXnVwIxIQbzbHWZzh5Z4AXd_hUGLpjnenUPV_ZXSHnKmtQRTSOJIN-EZj0mCfccRn0bejmTojjHLKjCjJRyAXP8moVOM-DRpd1HIjPOw5nJuJCVEI4oBAc1wEqQ9hcp0eoDqTYrJgJRHBBsXaynX3iejSWPt5J7WqTVw7GBMIJFRBGfYvbIbzhGlAlh9q1gKUVV86mcNB-vvskCJOKnfZ9oGyquGlHpvoodk-lfGwHv-m_nxOqgpYuwzWExUDeIUcP0R3fTHsVcIY',
	),
	array(
		'name'    => __( 'Alabaster Abstract', 'luxe-landscape' ),
		'price'   => '$750',
		'old'     => '$1,500',
		'badge'   => '50% OFF',
		'image'   => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAcRvJ4uKXkd0zCC8BaKh-wjZP4bloqD12gziAlN87YltQ7DFNUDL4ap1yVOINz0IqqZgbUeAvlWjXF-S5Ks8WqzW5CRhRl5TpUqlKqrFz51JI5pxCeP82EiOpVOUZzJ9NBXvx03WM8o2jHp4hUsPaIWcN4s4F3Sobsx8wniPXMV5zfX5XXanmrBA9BWxD1ALoZs9U3gIyASVY9cPTIxzNL0BhOhato_8FF6srXBWelx0YBXcqoM13IuIEmDKm_64E0l3Bgivsxj6s',
	),
);
?>

<!-- ====================================================
     SECTION 1: IMMERSIVE HERO
     ==================================================== -->
<section class="relative min-h-screen flex items-center px-6 pt-20">
	<div class="max-w-7xl mx-auto w-full grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
		<!-- Hero Content -->
		<div class="lg:col-span-7 space-y-8 z-10">
			<h1 class="text-6xl md:text-8xl font-bold leading-[0.9] tracking-tight text-slate-900 dark:text-slate-100 hero-animate-in">
				<span class="hero-title-1"><?php esc_html_e( 'Transform Your Space with', 'luxe-landscape' ); ?></span> <span class="text-primary hero-title-accent"><?php esc_html_e( 'Factory-Direct', 'luxe-landscape' ); ?></span> <span class="hero-title-2"><?php esc_html_e( 'Luxury', 'luxe-landscape' ); ?></span>
			</h1>

			<p class="text-xl text-slate-600 dark:text-slate-400 max-w-xl hero-animate-in hero-subtitle">
				<?php esc_html_e( 'Experience the pinnacle of biophilic design with our ultra-premium outdoor collections, engineered for the world\'s most prestigious properties.', 'luxe-landscape' ); ?>
			</p>

			<div class="flex flex-wrap gap-4 pt-4 hero-animate-in">
				<a href="<?php echo class_exists( 'WooCommerce' ) ? esc_url( wc_get_page_permalink( 'shop' ) ) : '#'; ?>" class="bg-primary hover:bg-primary/90 text-slate-900 font-bold px-10 py-5 rounded-xl transition-all shadow-xl shadow-primary/20 flex items-center gap-2">
					<span class="hero-cta-shop"><?php esc_html_e( 'Shop Collection', 'luxe-landscape' ); ?></span> <span class="material-symbols-outlined">arrow_forward</span>
				</a>
				<a href="#b2b-section" class="border-2 border-slate-200 dark:border-slate-800 hover:border-primary font-bold px-10 py-5 rounded-xl transition-all">
					<span class="hero-cta-b2b"><?php esc_html_e( 'Request B2B Quote', 'luxe-landscape' ); ?></span>
				</a>
			</div>
		</div>

		<!-- Hero Image -->
		<div class="lg:col-span-5 relative">
			<div class="aspect-[4/5] rounded-[3rem] overflow-hidden shadow-2xl relative featured-card-hover">
				<img alt="<?php esc_attr_e( 'Luxury garden setup', 'luxe-landscape' ); ?>"
				     class="w-full h-full object-cover"
				     id="hero-parallax-img"
				     src="https://lh3.googleusercontent.com/aida-public/AB6AXuAy-xAtHG9hLVpxfj4-djwTzhKv9v3eKXP7LTo4-PvN0-ZDsknZPazaHJfESf6g7WuR_2BlDx93tWbjtumba1rZM5nADm669nR9QWYC3BjTVQibF5FO62fCOetWbcSyogI1qSIQc5jvI8eW06KGDwCXZY5bihzXkmjSR5VZA2fWjJ12IZiAPTJFXVRDs0rLgp8kvhQDGScnrDlifyl9ze-jHXv24R7DLYJfpbo1F3d1x5BWjsh-8MPn1B_G1I4YjifWrCccX3TCFgI">
				<div class="absolute bottom-6 left-6 right-6 glass p-6 rounded-2xl glass-shimmer">
					<div class="flex items-center justify-between">
						<div>
							<p class="text-xs font-bold text-primary uppercase tracking-widest hero-featured-label"><?php esc_html_e( 'Featured Piece', 'luxe-landscape' ); ?></p>
							<p class="font-bold text-lg hero-featured-name"><?php esc_html_e( 'The Zenith Fountain', 'luxe-landscape' ); ?></p>
						</div>
						<span class="text-2xl font-bold">$4,200</span>
					</div>
				</div>
			</div>
			<!-- Abstract Decorative Element -->
			<div class="absolute -top-12 -right-12 size-64 bg-primary/20 blur-[100px] -z-10 rounded-full"></div>
		</div>
	</div>
</section>

<!-- ====================================================
     SECTION 2: BENTO BOX CATEGORY GRID
     ==================================================== -->
<section class="max-w-7xl mx-auto px-6 py-24">
	<div class="flex justify-between items-end mb-12">
		<div>
			<h2 class="text-4xl font-bold section-title-categories"><?php esc_html_e( 'Explore Our World', 'luxe-landscape' ); ?></h2>
			<p class="text-slate-500 mt-2 section-subtitle-categories"><?php esc_html_e( 'Curated categories for professional landscaping.', 'luxe-landscape' ); ?></p>
		</div>
		<a class="text-primary font-bold flex items-center gap-2 group section-link" href="<?php echo class_exists( 'WooCommerce' ) ? esc_url( wc_get_page_permalink( 'shop' ) ) : '#'; ?>">
			<span class="section-link-categories"><?php esc_html_e( 'View All Categories', 'luxe-landscape' ); ?></span>
			<span class="material-symbols-outlined group-hover:translate-x-1 transition-transform">east</span>
		</a>
	</div>

	<div class="grid grid-cols-1 md:grid-cols-4 md:grid-rows-2 gap-4 h-[800px]">
		<?php
		$use_wc = ! empty( $categories ) && ! is_wp_error( $categories );
		$cat_list = $use_wc ? $categories : $fallback_categories;

		foreach ( $cat_list as $i => $cat ) :
			$fb = $fallback_categories[ $i ] ?? $fallback_categories[0];
			$cat_name  = $use_wc ? $cat->name : $fb['name'];
			$cat_count = $use_wc ? $cat->count . ' ' . __( 'Products', 'luxe-landscape' ) : ( $fb['count'] ?: '' );
			$cat_image = $fb['image'];
			$cat_span  = $fb['span'];
			$cat_h     = $fb['heading'];

			if ( $use_wc ) {
				$thumbnail_id = get_term_meta( $cat->term_id, 'thumbnail_id', true );
				if ( $thumbnail_id ) {
					$cat_image = wp_get_attachment_url( $thumbnail_id );
				}
			}
		?>
			<div class="<?php echo esc_attr( $cat_span ); ?> relative group overflow-hidden rounded-3xl">
				<img class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
				     src="<?php echo esc_url( $cat_image ); ?>"
				     alt="<?php echo esc_attr( $cat_name ); ?>">
				<div class="absolute inset-0 bento-gradient flex flex-col justify-end p-8">
					<h3 class="<?php echo esc_attr( $cat_h ); ?> font-bold text-white"><?php echo esc_html( $cat_name ); ?></h3>
					<?php if ( $cat_count ) : ?>
						<div class="flex items-center justify-between mt-4 opacity-0 group-hover:opacity-100 transition-opacity w-fit gap-4">
							<span class="text-white/80 text-sm"><?php echo esc_html( $cat_count ); ?></span>
							<span class="material-symbols-outlined text-white">trending_flat</span>
						</div>
					<?php else : ?>
						<span class="material-symbols-outlined text-white mt-2 opacity-0 group-hover:opacity-100 transition-opacity">arrow_outward</span>
					<?php endif; ?>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</section>

<!-- ====================================================
     SECTION 3: TRENDING PRODUCTS CAROUSEL
     ==================================================== -->
<section class="bg-background-light dark:bg-background-dark py-24 overflow-hidden">
	<div class="max-w-7xl mx-auto px-6 mb-12 flex items-center justify-between">
		<h2 class="text-4xl font-bold section-title-trending"><?php esc_html_e( 'Trending Now', 'luxe-landscape' ); ?></h2>
		<div class="flex gap-2">
			<button id="trending-prev" class="size-12 rounded-full border border-slate-200 dark:border-slate-700 flex items-center justify-center hover:bg-white dark:hover:bg-slate-800 transition-colors" aria-label="<?php esc_attr_e( 'Previous', 'luxe-landscape' ); ?>">
				<span class="material-symbols-outlined">chevron_left</span>
			</button>
			<button id="trending-next" class="size-12 rounded-full border border-slate-200 dark:border-slate-700 flex items-center justify-center hover:bg-white dark:hover:bg-slate-800 transition-colors" aria-label="<?php esc_attr_e( 'Next', 'luxe-landscape' ); ?>">
				<span class="material-symbols-outlined">chevron_right</span>
			</button>
		</div>
	</div>

	<div class="flex gap-8 overflow-x-auto pb-8 px-6 no-scrollbar snap-x" id="products-scroll">
		<?php
		$use_products = ! empty( $products );
		$product_list = $use_products ? $products : $fallback_products;

		foreach ( $product_list as $i => $product ) :
			$fb = $fallback_products[ $i ] ?? $fallback_products[0];

			if ( $use_products ) {
				$prod_name  = $product->get_name();
				$prod_image = wp_get_attachment_url( $product->get_image_id() ) ?: $fb['image'];
				$prod_price = wc_price( $product->get_price() );
				$prod_sale  = $product->is_on_sale() ? wc_price( $product->get_regular_price() ) : '';
				$prod_badge = $product->is_on_sale() ? __( 'SALE', 'luxe-landscape' ) : '';
				$prod_url   = get_permalink( $product->get_id() );
			} else {
				$prod_name  = $fb['name'];
				$prod_image = $fb['image'];
				$prod_price = $fb['price'];
				$prod_sale  = $fb['old'];
				$prod_badge = $fb['badge'];
				$prod_url   = '#';
			}
		?>
			<div class="min-w-[320px] snap-start group">
				<a href="<?php echo esc_url( $prod_url ); ?>">
					<div class="relative aspect-square bg-white dark:bg-slate-900 rounded-3xl overflow-hidden mb-4">
						<img class="w-full h-full object-cover transition-transform group-hover:scale-105"
						     src="<?php echo esc_url( $prod_image ); ?>"
						     alt="<?php echo esc_attr( $prod_name ); ?>">
						<?php if ( $prod_badge ) : ?>
							<span class="absolute top-4 left-4 bg-primary text-slate-900 font-bold px-3 py-1 rounded-full text-xs"><?php echo esc_html( $prod_badge ); ?></span>
						<?php endif; ?>
						<button class="absolute bottom-4 right-4 size-12 bg-slate-900 text-white rounded-full flex items-center justify-center opacity-0 translate-y-4 group-hover:opacity-100 group-hover:translate-y-0 transition-all" aria-label="<?php esc_attr_e( 'Add to cart', 'luxe-landscape' ); ?>">
							<span class="material-symbols-outlined">add</span>
						</button>
					</div>
				</a>
				<h4 class="font-bold text-lg"><?php echo esc_html( $prod_name ); ?></h4>
				<div class="flex items-center gap-3 mt-1">
					<?php if ( $prod_sale ) : ?>
						<span class="text-slate-400 line-through"><?php echo wp_kses_post( $prod_sale ); ?></span>
					<?php endif; ?>
					<span class="text-xl font-bold text-primary"><?php echo wp_kses_post( $prod_price ); ?></span>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</section>

<!-- ====================================================
     SECTION 4: OUR IMPACT IN NUMBERS (NEW)
     ==================================================== -->
<section class="bg-background-light dark:bg-background-dark py-24 overflow-hidden">
	<div class="max-w-7xl mx-auto px-6 text-center mb-16">
		<h2 class="text-4xl font-bold mb-4 section-title-impact"><?php esc_html_e( 'Our Impact in Numbers', 'luxe-landscape' ); ?></h2>
		<p class="text-slate-500 max-w-2xl mx-auto section-subtitle-impact"><?php esc_html_e( 'Quantifying our commitment to excellence and biophilic growth over the last month.', 'luxe-landscape' ); ?></p>
	</div>

	<div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8" id="impact-stats">
		<!-- Stat 1 -->
		<div class="bg-white dark:bg-[rgba(15,35,42,0.61)] p-10 rounded-[2.5rem] shadow-[0_20px_50px_rgba(0,0,0,0.04)] text-center transform hover:-translate-y-2 transition-transform duration-300">
			<div class="text-5xl font-bold text-primary mb-3 font-display">
				<span class="stat-number" data-target="120">0</span>+
			</div>
			<p class="text-slate-600 dark:text-slate-400 font-['Outfit'] font-medium text-lg impact-label-1"><?php esc_html_e( 'Luxury Projects Completed', 'luxe-landscape' ); ?></p>
		</div>
		<!-- Stat 2 -->
		<div class="bg-white dark:bg-[rgba(15,35,42,0.61)] p-10 rounded-[2.5rem] shadow-[0_20px_50px_rgba(0,0,0,0.04)] text-center transform hover:-translate-y-2 transition-transform duration-300">
			<div class="text-5xl font-bold text-primary mb-3 font-display">
				<span class="stat-number" data-target="45">0</span>
			</div>
			<p class="text-slate-600 dark:text-slate-400 font-['Outfit'] font-medium text-lg impact-label-2"><?php esc_html_e( 'New Premium Clients', 'luxe-landscape' ); ?></p>
		</div>
		<!-- Stat 3 -->
		<div class="bg-white dark:bg-[rgba(15,35,42,0.61)] p-10 rounded-[2.5rem] shadow-[0_20px_50px_rgba(0,0,0,0.04)] text-center transform hover:-translate-y-2 transition-transform duration-300">
			<div class="text-5xl font-bold text-primary mb-3 font-display">
				<span class="stat-number" data-target="1250">0</span>+
			</div>
			<p class="text-slate-600 dark:text-slate-400 font-['Outfit'] font-medium text-lg impact-label-3"><?php esc_html_e( 'Products Delivered', 'luxe-landscape' ); ?></p>
		</div>
		<!-- Stat 4 -->
		<div class="bg-white dark:bg-[rgba(15,35,42,0.61)] p-10 rounded-[2.5rem] shadow-[0_20px_50px_rgba(0,0,0,0.04)] text-center transform hover:-translate-y-2 transition-transform duration-300">
			<div class="text-5xl font-bold text-primary mb-3 font-display">
				<span class="stat-number" data-target="8">0</span>
			</div>
			<p class="text-slate-600 dark:text-slate-400 font-['Outfit'] font-medium text-lg impact-label-4"><?php esc_html_e( 'Global Partner Factories', 'luxe-landscape' ); ?></p>
		</div>
	</div>
</section>

<!-- ====================================================
     SECTION 5: B2B / WHOLESALE
     ==================================================== -->
<section class="max-w-7xl mx-auto px-6 py-24" id="b2b-section">
	<div class="bg-neutral-charcoal text-white rounded-[3rem] p-12 lg:p-24 grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
		<!-- B2B Content -->
		<div class="space-y-8">
			<span class="text-primary font-bold tracking-[0.2em] uppercase b2b-label"><?php esc_html_e( 'B2B & Projects', 'luxe-landscape' ); ?></span>
			<h2 class="text-4xl md:text-6xl font-bold leading-tight b2b-title"><?php esc_html_e( 'Building a Mega Project? Get Direct Factory Pricing.', 'luxe-landscape' ); ?></h2>
			<p class="text-slate-400 text-lg b2b-desc"><?php esc_html_e( 'We partner with architects, real estate developers, and hospitality giants to provide bespoke landscaping solutions at scale.', 'luxe-landscape' ); ?></p>
			<div class="flex items-center gap-8 pt-4">
				<div class="flex flex-col">
					<span class="text-3xl font-bold text-white">500+</span>
					<span class="text-slate-500 text-sm b2b-stat-label-1"><?php esc_html_e( 'Hotel Projects', 'luxe-landscape' ); ?></span>
				</div>
				<div class="w-px h-12 bg-slate-800"></div>
				<div class="flex flex-col">
					<span class="text-3xl font-bold text-white">15yr</span>
					<span class="text-slate-500 text-sm b2b-stat-label-2"><?php esc_html_e( 'Contract Life', 'luxe-landscape' ); ?></span>
				</div>
			</div>
		</div>

		<!-- B2B Form -->
		<div class="bg-white/5 p-8 rounded-3xl border border-white/10 backdrop-blur-sm">
			<form class="space-y-6">
				<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
					<input class="w-full bg-white/5 border-white/10 rounded-xl px-4 py-4 text-white placeholder:text-slate-500 focus:ring-primary focus:border-primary" placeholder="<?php esc_attr_e( 'Full Name', 'luxe-landscape' ); ?>" type="text">
					<input class="w-full bg-white/5 border-white/10 rounded-xl px-4 py-4 text-white placeholder:text-slate-500 focus:ring-primary focus:border-primary" placeholder="<?php esc_attr_e( 'Project Size (sqm)', 'luxe-landscape' ); ?>" type="text">
				</div>
				<input class="w-full bg-white/5 border-white/10 rounded-xl px-4 py-4 text-white placeholder:text-slate-500 focus:ring-primary focus:border-primary" placeholder="<?php esc_attr_e( 'Phone Number', 'luxe-landscape' ); ?>" type="tel">
				<textarea class="w-full bg-white/5 border-white/10 rounded-xl px-4 py-4 text-white placeholder:text-slate-500 focus:ring-primary focus:border-primary" placeholder="<?php esc_attr_e( 'Tell us about your project', 'luxe-landscape' ); ?>" rows="3"></textarea>
				<button class="w-full bg-primary text-slate-900 font-bold py-5 rounded-xl transition-all hover:bg-primary/90 b2b-submit" type="submit">
					<?php esc_html_e( 'Request Project Quote', 'luxe-landscape' ); ?>
				</button>
			</form>
		</div>
	</div>
</section>

<?php luxe_landscape_get_footer(); ?>
