<?php
/**
 * products Page Layout
 *
 * Product listing page with sidebar filters, hero banner, and product grid.
 * Converted from Stitch design (products.html).
 *
 * @package Luxe_Landscape
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

luxe_landscape_get_header();

// ==============================================================
// Get WooCommerce data
// ==============================================================
$categories = array();
$products   = array();
$paged      = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;

if ( class_exists( 'WooCommerce' ) ) {
	$categories = get_terms( array(
		'taxonomy'   => 'product_cat',
		'hide_empty' => true,
		'exclude'    => array( get_option( 'default_product_cat' ) ),
	) );

	$products = wc_get_products( array(
		'limit'   => 9,
		'orderby' => 'date',
		'order'   => 'DESC',
		'status'  => 'publish',
		'page'    => $paged,
		'paginate' => true,
	) );
}

// ==============================================================
// Fallback data (from Stitch design)
// ==============================================================
$fallback_categories = array(
	array( 'name' => __( 'All Collections', 'luxe-landscape' ), 'icon' => 'grid_view', 'active' => true ),
	array( 'name' => __( 'Luxury Planters', 'luxe-landscape' ), 'icon' => 'potted_plant', 'active' => false ),
	array( 'name' => __( 'Water Features', 'luxe-landscape' ), 'icon' => 'waves', 'active' => false ),
	array( 'name' => __( 'Fountains', 'luxe-landscape' ), 'icon' => 'water_drop', 'active' => false ),
	array( 'name' => __( 'Sculptures', 'luxe-landscape' ), 'icon' => 'architecture', 'active' => false ),
);

$fallback_products = array(
	array(
		'name'  => __( 'Zenith Concrete Planter', 'luxe-landscape' ),
		'desc'  => __( 'Hand-cast architectural vessel', 'luxe-landscape' ),
		'price' => '$1,250.00',
		'badge' => __( 'In Stock', 'luxe-landscape' ),
		'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCHtkOYh47qSYTlmqJPgTcomi-zlcq3cpuUho0fLatIPpsU-zBzzgpHH5knKBsVKseHE9LZ6-uIuyJZgbqJFctHcXYrBRzYeOa75CCtqs4cen-u--2li7yeYc1_-_MVOXECl5SDd8kn0dUEFLLFpgICpsyLqWBwz42DxsNosYb9Ip5VnQchI3DKpMl1t4fdVl42kHMyoXl_LZvX0q_D8lgpsVQkcaquqR4LWmEjeI4HR_wcLuF3pIqE8NfrvEpDQJIzgVbvuIIr11s',
	),
	array(
		'name'  => __( 'Solis Tiered Fountain', 'luxe-landscape' ),
		'desc'  => __( 'Honed basalt with silent pump', 'luxe-landscape' ),
		'price' => '$4,800.00',
		'badge' => '',
		'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuD5ceY6YD0y9wytgL-Yr0pW0G0wHRxCUaN0NcP_HTPO2vutfYkwBz0X40lKRKUP2I-o68UaqkhlmI2qoTyMjL3ewQQsw7iWVhkrv8w1Uyhnn5zK3t4EnT3J-va1T9n2FQMHNegSz-16zXThcfaFw0_DeAw8Mx1SX1dpvnX5UhyVKm1klMD5SrnRF3gKWyTE12__ueHNCNiSstDE0g5O81p8pCKr73pFxiUaviJ57cYSCafr0YQvV2eObQEKsw1iAxTqlrxOqkuQHjI',
	),
	array(
		'name'  => __( 'Glass Cascade Wall', 'luxe-landscape' ),
		'desc'  => __( 'Tempered glass and slate frame', 'luxe-landscape' ),
		'price' => '$12,400.00',
		'badge' => '',
		'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBisxU--2zGHDXvx7zRc-eofhdiDVuaTKvnpEMBqxPxhFDldc7JCv5ldou9hFH-updsVEDW9WIz-OsozF-Q2WTJyKwwQDeiA7n3n2RqlMVPwvKAiLlA-RUl2MAsWSvW7no4_CVTttmr8XZV3ffNnry9xLy0aT6gzvOS9rfvZwTrufAzXeuGYHDM96LXWWr2K7KjHv7FNi1kRYhSqhP4OrTV0qPRVlkmW6ApADpItrJEpwj5Lh3wigJuarwFIXolg4Lg7uOpJesVCgE',
	),
	array(
		'name'  => __( 'Artisan Terracotta Trio', 'luxe-landscape' ),
		'desc'  => __( 'Hand-painted organic finishes', 'luxe-landscape' ),
		'price' => '$890.00',
		'badge' => '',
		'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBAh3cjO3WgxdZ8MQxhi3hRXzD0kZgQQO73NCSwzX1mUvNoY1-Yl1YJgtqfIbGz0KndjvEg8MuoHX1oOJgJET4ZG4IoDhRwXJ1YoYMVDij6rzDXxRzNTIzr2csJQr7g8gNMNyUv3YofYkdDajEtu47VTUK0SiN7BSX8EJkldsB3y1X7ORpmmNcxztWcQDPuxU7VoPvepVo8fh2AxhUW_qJfKyANtqFhi_B2yzUTzxkEl8nXtW8gDvH9t_YWh2U3qtkvXaZMezdJQ_U',
	),
	array(
		'name'  => __( 'Carrara Muse Fountain', 'luxe-landscape' ),
		'desc'  => __( 'Solid Carrara marble sculpture', 'luxe-landscape' ),
		'price' => '$34,000.00',
		'badge' => __( 'Rare Piece', 'luxe-landscape' ),
		'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCdov57q2leUFhd_FufrzeS83Uhbb_BQuvTh0MxC9egIJeF6FIMksnaVMY0h7bfbpHCzhC6FqzhJe6UjVQTiJWkjEI_QyL0O-dNMNzgN75GTkNjViaFqzdHTvQmRW4j14GeG-4nuv0BguJ7pwnJpvhD8Of8rswRmpGRoZRYzf0g1Q2kde4OBD6wTQkj8pN6WII9p16o3aPkTfCIsXCUztQ3NipAYXIBl5x7QY5suEJsJHfsHVPai2dlBXNHpmMSsEWVnQxrysrRrpE',
	),
	array(
		'name'  => __( 'Obsidian Flow Basin', 'luxe-landscape' ),
		'desc'  => __( 'Powder-coated steel and river stone', 'luxe-landscape' ),
		'price' => '$2,100.00',
		'badge' => '',
		'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuB6eVzGsi-0VyTKDaCOEtb_NwbAsB-5SOKrQuMDXnbmSnl8m_kQgGyEXW1hsgmWLuXkt32p1VhmojyWfq4-cwsjDcRERn0ohAFabye0QCUiuPJI0OuL4vxwNHq8C9zB38QIa4j5cDbx_qxW9VD95CDOu-ph0OosSS71vB5OmfNMYpoxvEE_zrQegyfYWIidLxW4p6NqZHnr-4GWigdPRZFuYgat3pIdUQ4tcLQUCkUtjRvyOzpL0US9VjfvLomLGRF0xa-ACMBPyZA',
	),
);
?>

<!-- ====================================================
     products PAGE MAIN CONTENT
     ==================================================== -->
<main class="max-w-7xl mx-auto px-6 lg:px-12 py-8 mt-24">
	<div class="flex flex-col lg:flex-row gap-10">

		<!-- ============================================
		     SIDEBAR FILTERS
		     ============================================ -->
		<aside class="w-full lg:w-64 flex-shrink-0">
			<div class="sticky top-28 space-y-8">
				<div class="flex items-center justify-between">
					<h2 class="font-display text-xl font-bold products-filter-title"><?php esc_html_e( 'Filters', 'luxe-landscape' ); ?></h2>
					<span class="material-symbols-outlined cursor-pointer lg:hidden">tune</span>
				</div>

				<!-- Categories -->
				<div class="space-y-4">
					<p class="text-xs font-bold uppercase tracking-widest text-primary/60 products-cat-label"><?php esc_html_e( 'Categories', 'luxe-landscape' ); ?></p>
					<nav class="space-y-1">
						<?php
						$use_wc_cats = ! empty( $categories ) && ! is_wp_error( $categories );
						if ( $use_wc_cats ) :
							// "All" link
							$shop_url = class_exists( 'WooCommerce' ) ? wc_get_page_permalink( 'shop' ) : '#';
							?>
							<a class="flex items-center gap-3 px-4 py-2.5 rounded-xl bg-primary text-white transition-all group" href="<?php echo esc_url( $shop_url ); ?>">
								<span class="material-symbols-outlined text-[20px]">grid_view</span>
								<span class="text-sm font-medium"><?php esc_html_e( 'All Collections', 'luxe-landscape' ); ?></span>
							</a>
							<?php foreach ( $categories as $cat ) : ?>
								<a class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-slate-600 dark:text-slate-400 hover:bg-primary/5 dark:hover:bg-primary/10 transition-all group" href="<?php echo esc_url( get_term_link( $cat ) ); ?>">
									<span class="material-symbols-outlined text-[20px] text-primary/60">potted_plant</span>
									<span class="text-sm font-medium"><?php echo esc_html( $cat->name ); ?></span>
									<span class="text-xs text-slate-400 ml-auto"><?php echo esc_html( $cat->count ); ?></span>
								</a>
							<?php endforeach; ?>
						<?php else :
							// Fallback static categories
							foreach ( $fallback_categories as $fcat ) :
								$active_class = $fcat['active'] ? 'bg-primary text-white' : 'text-slate-600 dark:text-slate-400 hover:bg-primary/5 dark:hover:bg-primary/10';
								?>
								<a class="flex items-center gap-3 px-4 py-2.5 rounded-xl <?php echo esc_attr( $active_class ); ?> transition-all group" href="#">
									<span class="material-symbols-outlined text-[20px] <?php echo $fcat['active'] ? '' : 'text-primary/60'; ?>"><?php echo esc_html( $fcat['icon'] ); ?></span>
									<span class="text-sm font-medium"><?php echo esc_html( $fcat['name'] ); ?></span>
								</a>
							<?php endforeach;
						endif;
						?>
					</nav>
				</div>

				<!-- Bespoke Design CTA -->
				<div class="pt-4">
					<div class="bg-primary/5 dark:bg-primary/10 p-6 rounded-2xl border border-primary/10">
						<p class="text-sm font-bold mb-2 products-cta-title"><?php esc_html_e( 'Bespoke Design', 'luxe-landscape' ); ?></p>
						<p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed mb-4 products-cta-desc"><?php esc_html_e( 'Request a personalized landscape consultation with our lead designers.', 'luxe-landscape' ); ?></p>
						<button class="w-full py-2 bg-primary text-slate-900 text-xs font-bold rounded-lg hover:bg-primary/90 transition-all uppercase tracking-wider products-cta-btn"><?php esc_html_e( 'Book Now', 'luxe-landscape' ); ?></button>
					</div>
				</div>
			</div>
		</aside>

		<!-- ============================================
		     PRODUCT FEED
		     ============================================ -->
		<div class="flex-1 space-y-8">

			<!-- Hero Banner -->
			<section class="relative h-[320px] rounded-2xl overflow-hidden group">
				<div class="absolute inset-0 bg-cover bg-center transition-transform duration-700 group-hover:scale-105"
					 style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuA0dRcANGH9TWVPdUqfOypHE7XKS6yggvbOHqwEZ5cu9ivWXAXaAG3oy_R4ZQG44gnBUtKFx2SECGcmtHG-9twew9s6W6ySjje2SJjBDsLg8hiTsoCnhz9_vkA24Qi_mg7jjCw3wXFbxH8MQz131R6yrPqvfmPK9hcE70rFNV_oULlEyT2gRXlyqrtG1a8ZEBfKH3yYWYZx_oMW_mXm0yRe_99Wbo7_OJSvtgOaOIV2WikNBGn4a7rtAnPCRSh3F053qOrtUmRUEkU')">
				</div>
				<div class="absolute inset-0 bg-gradient-to-r from-slate-900/80 via-slate-900/40 to-transparent"></div>
				<div class="absolute inset-0 flex flex-col justify-center px-12 space-y-4">
					<span class="text-primary font-bold uppercase tracking-[0.3em] text-xs products-hero-label"><?php esc_html_e( 'New Collection 2024', 'luxe-landscape' ); ?></span>
					<h2 class="font-display text-4xl md:text-5xl font-bold text-white max-w-md products-hero-title"><?php esc_html_e( 'Curated Outdoor Elegance', 'luxe-landscape' ); ?></h2>
					<p class="text-white/80 max-w-xs text-sm products-hero-desc"><?php esc_html_e( 'Elevate your exterior spaces with our hand-carved stone features and rare botanicals.', 'luxe-landscape' ); ?></p>
				</div>
			</section>

			<!-- Breadcrumbs & Quick Filters -->
			<div class="flex flex-col sm:flex-row items-center justify-between gap-4">
				<nav class="flex items-center gap-2 text-sm">
					<a class="text-slate-400 hover:text-primary transition-colors" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'luxe-landscape' ); ?></a>
					<span class="material-symbols-outlined text-[14px] text-slate-400">chevron_right</span>
					<span class="text-slate-900 dark:text-white font-semibold"><?php esc_html_e( 'products', 'luxe-landscape' ); ?></span>
				</nav>
				<div class="flex items-center gap-2 overflow-x-auto pb-2 sm:pb-0 w-full sm:w-auto no-scrollbar">
					<button class="flex items-center gap-2 px-4 py-1.5 rounded-full bg-primary/5 dark:bg-primary/10 border border-primary/10 text-xs font-semibold whitespace-nowrap products-sort-btn">
						<?php esc_html_e( 'Sort by: Featured', 'luxe-landscape' ); ?> <span class="material-symbols-outlined text-[16px]">expand_more</span>
					</button>
					<button class="flex items-center gap-2 px-4 py-1.5 rounded-full bg-primary/5 dark:bg-primary/10 border border-primary/10 text-xs font-semibold whitespace-nowrap products-avail-btn">
						<?php esc_html_e( 'Availability', 'luxe-landscape' ); ?> <span class="material-symbols-outlined text-[16px]">expand_more</span>
					</button>
					<button class="flex items-center gap-2 px-4 py-1.5 rounded-full bg-primary/5 dark:bg-primary/10 border border-primary/10 text-xs font-semibold whitespace-nowrap products-eco-btn">
						<?php esc_html_e( 'Eco-Friendly', 'luxe-landscape' ); ?>
					</button>
				</div>
			</div>

			<!-- Product Grid -->
			<div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-8">
				<?php
				$use_wc_products = is_object( $products ) && ! empty( $products->products );
				$product_list    = $use_wc_products ? $products->products : $fallback_products;

				foreach ( $product_list as $i => $product ) :
					if ( $use_wc_products ) {
						$prod_name  = $product->get_name();
						$prod_desc  = wp_trim_words( $product->get_short_description(), 6, '...' );
						$prod_image = wp_get_attachment_url( $product->get_image_id() ) ?: '';
						$prod_price = wc_price( $product->get_price() );
						$prod_url   = get_permalink( $product->get_id() );
						$prod_badge = $product->is_in_stock() ? __( 'In Stock', 'luxe-landscape' ) : '';
						$badge_rare = '';
					} else {
						$fb = $fallback_products[ $i ] ?? $fallback_products[0];
						$prod_name  = $fb['name'];
						$prod_desc  = $fb['desc'];
						$prod_image = $fb['image'];
						$prod_price = $fb['price'];
						$prod_url   = '#';
						$prod_badge = $fb['badge'];
						$badge_rare = ( $prod_badge === __( 'Rare Piece', 'luxe-landscape' ) );
					}
				?>
					<a href="<?php echo esc_url( $prod_url ); ?>" class="group cursor-pointer block">
						<div class="relative aspect-[4/5] rounded-2xl overflow-hidden bg-slate-200 dark:bg-slate-800 mb-4 shadow-[0_10px_40px_-10px_rgba(0,0,0,0.1)]">
							<?php if ( $prod_image ) : ?>
								<div class="absolute inset-0 bg-cover bg-center transition-transform duration-500 group-hover:scale-110"
									 style="background-image: url('<?php echo esc_url( $prod_image ); ?>')">
								</div>
							<?php endif; ?>
							<button class="absolute top-4 right-4 w-10 h-10 bg-white/80 dark:bg-slate-800/80 backdrop-blur rounded-full flex items-center justify-center text-primary opacity-0 group-hover:opacity-100 transition-opacity">
								<span class="material-symbols-outlined">favorite</span>
							</button>
							<?php if ( $prod_badge ) : ?>
								<div class="absolute bottom-4 left-4">
									<span class="<?php echo $badge_rare ? 'bg-amber-400 text-slate-900' : 'bg-primary text-slate-900'; ?> text-[10px] font-bold uppercase tracking-wider px-3 py-1 rounded-full"><?php echo esc_html( $prod_badge ); ?></span>
								</div>
							<?php endif; ?>
						</div>
						<h3 class="font-display text-lg font-bold group-hover:text-primary transition-colors"><?php echo esc_html( $prod_name ); ?></h3>
						<?php if ( $prod_desc ) : ?>
							<p class="text-slate-500 text-sm mb-2"><?php echo esc_html( $prod_desc ); ?></p>
						<?php endif; ?>
						<p class="font-display font-bold text-primary"><?php echo wp_kses_post( $prod_price ); ?></p>
					</a>
				<?php endforeach; ?>
			</div>

			<!-- Pagination -->
			<?php
			$max_pages = $use_wc_products ? $products->max_num_pages : 3;
			if ( $max_pages > 1 ) :
			?>
			<div class="flex items-center justify-center gap-4 pt-12 pb-20">
				<?php if ( $paged > 1 ) : ?>
					<a href="<?php echo esc_url( get_pagenum_link( $paged - 1 ) ); ?>" class="w-10 h-10 rounded-full border border-slate-200 dark:border-slate-700 flex items-center justify-center hover:bg-primary hover:text-slate-900 transition-all">
						<span class="material-symbols-outlined">chevron_left</span>
					</a>
				<?php endif; ?>
				<div class="flex gap-2">
					<?php for ( $p = 1; $p <= $max_pages; $p++ ) : ?>
						<?php if ( $p == $paged ) : ?>
							<span class="w-10 h-10 rounded-full bg-primary text-slate-900 font-bold flex items-center justify-center"><?php echo esc_html( $p ); ?></span>
						<?php else : ?>
							<a href="<?php echo esc_url( get_pagenum_link( $p ) ); ?>" class="w-10 h-10 rounded-full border border-slate-200 dark:border-slate-700 font-bold hover:bg-primary/5 flex items-center justify-center"><?php echo esc_html( $p ); ?></a>
						<?php endif; ?>
					<?php endfor; ?>
				</div>
				<?php if ( $paged < $max_pages ) : ?>
					<a href="<?php echo esc_url( get_pagenum_link( $paged + 1 ) ); ?>" class="w-10 h-10 rounded-full border border-slate-200 dark:border-slate-700 flex items-center justify-center hover:bg-primary hover:text-slate-900 transition-all">
						<span class="material-symbols-outlined">chevron_right</span>
					</a>
				<?php endif; ?>
			</div>
			<?php endif; ?>

		</div>
	</div>
</main>

<?php luxe_landscape_get_footer(); ?>
