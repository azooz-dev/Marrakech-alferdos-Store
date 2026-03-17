<?php
/**
 * Account Orders Page
 *
 * From Stitch: MyAccount-orders.html
 * This overrides the WooCommerce orders endpoint content.
 *
 * @package WooCommerce\Templates
 * @version 9.9.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$customer_orders = wc_get_orders( array(
	'customer' => get_current_user_id(),
	'limit'    => 10,
	'orderby'  => 'date',
	'order'    => 'DESC',
	'status'   => array( 'wc-processing', 'wc-completed', 'wc-on-hold', 'wc-pending' ),
) );

// Fallback data
$fallback_orders = array(
	array(
		'id'       => 'LX-88293',
		'status'   => 'Shipped',
		'name'     => __( 'Zenith Tiered Stone Fountain', 'luxe-landscape' ),
		'qty'      => '1 • Color: Basalt Grey',
		'date'     => 'Oct 12, 2023',
		'total'    => '$2,450.00',
		'image'    => 'https://lh3.googleusercontent.com/aida-public/AB6AXuB2mKdMZPs3G_ixrglA1usM5VwpTiHwN455aoOxlFw8CDT5g_PE7YT9QXmXwoxWdLXdimvat-2G6fBiaXTqeF9U_dn6liWu19ZjH0gxotgJywgaAt5nn7y8C0Nwob0xqJLp8NH7qIUCMZAihVlzlkSZy-pwlFZIZ8sbPve41IquHZOisXYHUvI2ElEiR8qS0ZF5zYB82cy1WCqrndRIrSnOuR0NhFAiPZ_EBVo6SE2_jj98qv_yvdfvyW3JH8c92h8lkDh5WJvC9i8',
		'badge_bg' => 'bg-emerald-100 text-emerald-700',
	),
	array(
		'id'       => 'LX-88104',
		'status'   => 'Delivered',
		'name'     => __( 'Artisan Terracotta Planter Set', 'luxe-landscape' ),
		'qty'      => '3 • Size: Large',
		'date'     => 'Sept 28, 2023',
		'total'    => '$875.00',
		'image'    => 'https://lh3.googleusercontent.com/aida-public/AB6AXuB4nqMN2PetrM4g2J8KSHwkh_YMD-cP-bwCuQMXAWDvc-jbN5kX2um-iy-mII85btJ-l1EVvwC2hKudspJrulNmkahcjfNKMPzrVWBKewIjBRND2mTUKzZgaBLEE1R0BUpVI65DRoUlxI3IoG5x2P9GPAApTbjCiukmeuXuGG2prppyAirsEOEwCNDUJHB9zGGrcdEiaulP--EZ0iOI53coekTAZQWgkCRvOewukI4TBcvP5wgpfNqIpZlqoyi0kcWcQrQzeWrBrnM',
		'badge_bg' => 'bg-slate-100 text-slate-600',
	),
);

$has_orders = ! empty( $customer_orders );
?>

<div class="mb-8">
	<h1 class="text-3xl font-black text-primary tracking-tight mb-2 acct-orders-title"><?php esc_html_e( 'Your Orders', 'luxe-landscape' ); ?></h1>
	<p class="text-slate-500 dark:text-slate-400 max-w-lg acct-orders-desc"><?php esc_html_e( 'Track your biophilic sanctuary acquisitions and manage your premium landscape investments.', 'luxe-landscape' ); ?></p>
</div>

<div class="space-y-6">
	<!-- Tabs -->
	<div class="flex gap-8 border-b border-slate-200 dark:border-slate-700 px-2">
		<button class="pb-4 text-sm font-bold text-primary border-b-2 border-primary acct-tab-all" data-tab="all"><?php esc_html_e( 'All Orders', 'luxe-landscape' ); ?></button>
		<button class="pb-4 text-sm font-medium text-slate-400 hover:text-primary transition-colors acct-tab-active" data-tab="active"><?php esc_html_e( 'Active', 'luxe-landscape' ); ?></button>
		<button class="pb-4 text-sm font-medium text-slate-400 hover:text-primary transition-colors acct-tab-completed" data-tab="completed"><?php esc_html_e( 'Completed', 'luxe-landscape' ); ?></button>
	</div>

	<!-- Order Cards -->
	<div class="space-y-4" id="orders-list">
		<?php if ( $has_orders ) : ?>
			<?php foreach ( $customer_orders as $order ) :
				$order_id     = $order->get_id();
				$order_status = wc_get_order_status_name( $order->get_status() );
				$order_items  = $order->get_items();
				$first_item   = reset( $order_items );
				$product      = $first_item ? $first_item->get_product() : null;
				$product_name = $first_item ? $first_item->get_name() : '';
				$product_qty  = $first_item ? $first_item->get_quantity() : 0;
				$product_img  = $product ? wp_get_attachment_url( $product->get_image_id() ) : '';
				$order_date   = $order->get_date_created() ? $order->get_date_created()->date_i18n( get_option( 'date_format' ) ) : '';
				$order_total  = $order->get_formatted_order_total();

				// Status badge color
				$badge_bg = 'bg-slate-100 text-slate-600 dark:bg-slate-700 dark:text-slate-300';
				if ( in_array( $order->get_status(), array( 'processing', 'on-hold' ) ) ) {
					$badge_bg = 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/40 dark:text-emerald-400';
				} elseif ( $order->get_status() === 'completed' ) {
					$badge_bg = 'bg-slate-100 text-slate-600 dark:bg-slate-700 dark:text-slate-300';
				}

				$is_active = in_array( $order->get_status(), array( 'processing', 'on-hold', 'pending' ) );
			?>
				<div class="glass-card rounded-2xl p-6 shadow-sm hover:shadow-md transition-shadow order-card"
					 data-status="<?php echo $is_active ? 'active' : 'completed'; ?>">
					<div class="flex flex-col lg:flex-row justify-between gap-6">
						<div class="flex gap-6">
							<div class="size-24 rounded-xl bg-slate-100 dark:bg-slate-800 flex-shrink-0 overflow-hidden border border-slate-200 dark:border-slate-700">
								<?php if ( $product_img ) : ?>
									<img alt="<?php echo esc_attr( $product_name ); ?>" class="w-full h-full object-cover" src="<?php echo esc_url( $product_img ); ?>" />
								<?php else : ?>
									<div class="w-full h-full flex items-center justify-center">
										<span class="material-symbols-outlined text-3xl text-slate-300">package</span>
									</div>
								<?php endif; ?>
							</div>
							<div class="flex flex-col justify-between py-1">
								<div>
									<div class="flex items-center gap-2 mb-1">
										<span class="px-2.5 py-0.5 rounded-full <?php echo esc_attr( $badge_bg ); ?> text-[10px] font-bold uppercase tracking-wider"><?php echo esc_html( $order_status ); ?></span>
										<span class="text-xs text-slate-400">Order #<?php echo esc_html( $order_id ); ?></span>
									</div>
									<h3 class="text-lg font-bold text-slate-800 dark:text-white"><?php echo esc_html( $product_name ); ?></h3>
									<p class="text-sm text-slate-500 dark:text-slate-400"><?php printf( esc_html__( 'Quantity: %s', 'luxe-landscape' ), $product_qty ); ?></p>
								</div>
								<p class="text-xs text-slate-400 italic"><?php printf( esc_html__( 'Placed on %s', 'luxe-landscape' ), $order_date ); ?></p>
							</div>
						</div>
						<div class="flex flex-col justify-between items-end gap-4">
							<div class="text-right">
								<p class="text-xs text-slate-400 font-medium uppercase tracking-widest acct-order-total-label"><?php esc_html_e( 'Total Amount', 'luxe-landscape' ); ?></p>
								<p class="text-xl font-black text-primary"><?php echo wp_kses_post( $order_total ); ?></p>
							</div>
							<div class="flex gap-3">
								<a href="<?php echo esc_url( $order->get_view_order_url() ); ?>"
								   class="px-5 py-2.5 rounded-xl text-xs font-bold text-slate-600 dark:text-slate-300 border border-slate-200 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors acct-btn-view-details">
									<?php esc_html_e( 'View Details', 'luxe-landscape' ); ?>
								</a>
							</div>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		<?php else : ?>
			<!-- Fallback static data -->
			<?php foreach ( $fallback_orders as $fb_order ) : ?>
				<div class="glass-card rounded-2xl p-6 shadow-sm hover:shadow-md transition-shadow order-card" data-status="all">
					<div class="flex flex-col lg:flex-row justify-between gap-6">
						<div class="flex gap-6">
							<div class="size-24 rounded-xl bg-slate-100 dark:bg-slate-800 flex-shrink-0 overflow-hidden border border-slate-200 dark:border-slate-700">
								<img alt="<?php echo esc_attr( $fb_order['name'] ); ?>" class="w-full h-full object-cover" src="<?php echo esc_url( $fb_order['image'] ); ?>" />
							</div>
							<div class="flex flex-col justify-between py-1">
								<div>
									<div class="flex items-center gap-2 mb-1">
										<span class="px-2.5 py-0.5 rounded-full <?php echo esc_attr( $fb_order['badge_bg'] ); ?> text-[10px] font-bold uppercase tracking-wider"><?php echo esc_html( $fb_order['status'] ); ?></span>
										<span class="text-xs text-slate-400"><?php printf( esc_html__( 'Order #%s', 'luxe-landscape' ), $fb_order['id'] ); ?></span>
									</div>
									<h3 class="text-lg font-bold text-slate-800 dark:text-white"><?php echo esc_html( $fb_order['name'] ); ?></h3>
									<p class="text-sm text-slate-500 dark:text-slate-400"><?php printf( esc_html__( 'Quantity: %s', 'luxe-landscape' ), $fb_order['qty'] ); ?></p>
								</div>
								<p class="text-xs text-slate-400 italic"><?php printf( esc_html__( 'Placed on %s', 'luxe-landscape' ), $fb_order['date'] ); ?></p>
							</div>
						</div>
						<div class="flex flex-col justify-between items-end gap-4">
							<div class="text-right">
								<p class="text-xs text-slate-400 font-medium uppercase tracking-widest acct-order-total-label"><?php esc_html_e( 'Total Amount', 'luxe-landscape' ); ?></p>
								<p class="text-xl font-black text-primary"><?php echo esc_html( $fb_order['total'] ); ?></p>
							</div>
							<div class="flex gap-3">
								<button class="px-5 py-2.5 rounded-xl text-xs font-bold bg-primary text-white shadow-lg shadow-primary/10 hover:bg-primary/90 transition-all acct-btn-track open-track-modal cursor-pointer"><?php esc_html_e( 'Track Package', 'luxe-landscape' ); ?></button>
							</div>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		<?php endif; ?>
	</div>
</div>

<!-- Track Order Modal -->
<div id="track-modal" class="fixed inset-0 z-[100] flex items-center justify-center opacity-0 pointer-events-none transition-all duration-300 px-4">
	<!-- Modal Container -->
	<div id="track-modal-panel" class="bg-white dark:bg-slate-900 w-full max-w-[520px] rounded-3xl shadow-2xl overflow-hidden flex flex-col border border-white/20 transform scale-95 translate-y-4 opacity-0 transition-all duration-300">
		<!-- Header -->
		<header class="flex items-center justify-between px-8 py-6 border-b border-slate-100 dark:border-slate-800">
			<div class="flex items-center gap-3">
				<div class="bg-primary/10 p-2 rounded-lg">
					<span class="material-symbols-outlined text-primary text-2xl">local_shipping</span>
				</div>
				<h2 class="text-slate-900 dark:text-slate-100 text-xl font-bold tracking-tight"><?php printf( esc_html__( 'Track Order %s', 'luxe-landscape' ), '#LX-88293' ); ?></h2>
			</div>
			<button id="close-track-modal" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 transition-colors p-1 cursor-pointer">
				<span class="material-symbols-outlined text-2xl">close</span>
			</button>
		</header>
		<!-- Scrollable Content -->
		<div class="overflow-y-auto max-h-[75vh] custom-scrollbar">
			<!-- Order Status Timeline -->
			<section class="p-8">
				<h3 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-6"><?php esc_html_e( 'Delivery Progress', 'luxe-landscape' ); ?></h3>
				<div class="space-y-0">
					<!-- Step 1: Completed -->
					<div class="flex gap-4">
						<div class="flex flex-col items-center">
							<div class="z-10 flex items-center justify-center w-8 h-8 rounded-full bg-primary text-white">
								<span class="material-symbols-outlined text-sm">check</span>
							</div>
							<div class="w-0.5 h-10 bg-primary"></div>
						</div>
						<div class="pb-6">
							<p class="text-slate-900 dark:text-slate-100 font-semibold leading-tight"><?php esc_html_e( 'Order Placed', 'luxe-landscape' ); ?></p>
							<p class="text-slate-500 dark:text-slate-400 text-sm mt-1">Oct 10, 2023 • 10:00 AM</p>
						</div>
					</div>
					<!-- Step 2: Completed -->
					<div class="flex gap-4">
						<div class="flex flex-col items-center">
							<div class="z-10 flex items-center justify-center w-8 h-8 rounded-full bg-primary text-white">
								<span class="material-symbols-outlined text-sm">check</span>
							</div>
							<div class="w-0.5 h-10 bg-primary"></div>
						</div>
						<div class="pb-6">
							<p class="text-slate-900 dark:text-slate-100 font-semibold leading-tight"><?php esc_html_e( 'Processing', 'luxe-landscape' ); ?></p>
							<p class="text-slate-500 dark:text-slate-400 text-sm mt-1">Oct 11, 2023 • 02:30 PM</p>
						</div>
					</div>
					<!-- Step 3: Current -->
					<div class="flex gap-4">
						<div class="flex flex-col items-center">
							<div class="z-10 flex items-center justify-center w-8 h-8 rounded-full bg-primary border-4 border-primary/20 text-white ring-4 ring-primary/10">
								<span class="material-symbols-outlined text-sm">local_shipping</span>
							</div>
							<div class="w-0.5 h-10 bg-slate-200 dark:bg-slate-700"></div>
						</div>
						<div class="pb-6">
							<p class="text-primary font-bold leading-tight"><?php esc_html_e( 'Shipped', 'luxe-landscape' ); ?></p>
							<p class="text-slate-500 dark:text-slate-400 text-sm mt-1 font-medium italic">Oct 13, 2023 • 09:15 AM (In Transit)</p>
						</div>
					</div>
					<!-- Step 4: Pending -->
					<div class="flex gap-4">
						<div class="flex flex-col items-center">
							<div class="z-10 flex items-center justify-center w-8 h-8 rounded-full bg-slate-100 dark:bg-slate-800 text-slate-400">
								<span class="material-symbols-outlined text-sm">schedule</span>
							</div>
							<div class="w-0.5 h-10 bg-slate-200 dark:bg-slate-700"></div>
						</div>
						<div class="pb-6">
							<p class="text-slate-400 dark:text-slate-500 font-medium leading-tight"><?php esc_html_e( 'Out for Delivery', 'luxe-landscape' ); ?></p>
							<p class="text-slate-400 dark:text-slate-600 text-sm mt-1">Estimated Oct 14</p>
						</div>
					</div>
					<!-- Step 5: Pending -->
					<div class="flex gap-4">
						<div class="flex flex-col items-center">
							<div class="z-10 flex items-center justify-center w-8 h-8 rounded-full bg-slate-100 dark:bg-slate-800 text-slate-400">
								<span class="material-symbols-outlined text-sm">inventory_2</span>
							</div>
						</div>
						<div class="pb-2">
							<p class="text-slate-400 dark:text-slate-500 font-medium leading-tight"><?php esc_html_e( 'Delivered', 'luxe-landscape' ); ?></p>
							<p class="text-slate-400 dark:text-slate-600 text-sm mt-1">Estimated Oct 15</p>
						</div>
					</div>
				</div>
			</section>
			<hr class="mx-8 border-slate-100 dark:border-slate-800" />
			<!-- Delivery Details -->
			<section class="p-8">
				<h3 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-4"><?php esc_html_e( 'Delivery Details', 'luxe-landscape' ); ?></h3>
				<div class="grid grid-cols-1 gap-4 bg-slate-50 dark:bg-slate-800/50 p-5 rounded-2xl border border-slate-100 dark:border-slate-800">
					<div class="flex justify-between items-center">
						<span class="text-slate-500 dark:text-slate-400 text-sm"><?php esc_html_e( 'Carrier', 'luxe-landscape' ); ?></span>
						<span class="text-slate-900 dark:text-slate-100 font-semibold text-sm">DHL Express</span>
					</div>
					<div class="flex justify-between items-center">
						<span class="text-slate-500 dark:text-slate-400 text-sm"><?php esc_html_e( 'Tracking Number', 'luxe-landscape' ); ?></span>
						<div class="flex items-center gap-2">
							<span id="tracking-number" class="text-slate-900 dark:text-slate-100 font-semibold text-sm">9283746501</span>
							<button class="text-primary hover:text-primary/80 transition-colors cursor-pointer copy-tracking" data-target="tracking-number">
								<span class="material-symbols-outlined text-lg">content_copy</span>
							</button>
						</div>
					</div>
					<div class="flex justify-between items-center">
						<span class="text-slate-500 dark:text-slate-400 text-sm"><?php esc_html_e( 'Estimated Arrival', 'luxe-landscape' ); ?></span>
						<span class="text-primary font-bold text-sm">Oct 15, 2023</span>
					</div>
				</div>
			</section>
			<hr class="mx-8 border-slate-100 dark:border-slate-800" />
			<!-- Order Summary (Mini) -->
			<section class="p-8 pb-10">
				<h3 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-4"><?php esc_html_e( 'Items in Order', 'luxe-landscape' ); ?></h3>
				<div class="flex items-center gap-4 group text-left">
					<div class="h-20 w-20 rounded-xl overflow-hidden bg-slate-100 flex-shrink-0 border border-slate-100 dark:border-slate-800">
						<img alt="Zenith Tiered Stone Fountain" class="h-full w-full object-cover transition-transform group-hover:scale-110 duration-500" src="https://lh3.googleusercontent.com/aida-public/AB6AXuB2mKdMZPs3G_ixrglA1usM5VwpTiHwN455aoOxlFw8CDT5g_PE7YT9QXmXwoxWdLXdimvat-2G6fBiaXTqeF9U_dn6liWu19ZjH0gxotgJywgaAt5nn7y8C0Nwob0xqJLp8NH7qIUCMZAihVlzlkSZy-pwlFZIZ8sbPve41IquHZOisXYHUvI2ElEiR8qS0ZF5zYB82cy1WCqrndRIrSnOuR0NhFAiPZ_EBVo6SE2_jj98qv_yvdfvyW3JH8c92h8lkDh5WJvC9i8" />
					</div>
					<div class="flex flex-col">
						<p class="text-slate-900 dark:text-slate-100 font-bold text-base leading-snug">Zenith Tiered Stone Fountain</p>
						<p class="text-slate-500 dark:text-slate-400 text-sm mt-1">Quantity: 1 • Slate Gray</p>
					</div>
					<div class="ml-auto">
						<p class="text-slate-900 dark:text-slate-100 font-bold">$1,249.00</p>
					</div>
				</div>
			</section>
		</div>
		<!-- Footer Action -->
		<footer class="px-8 py-6 bg-slate-50 dark:bg-slate-800/30 border-t border-slate-100 dark:border-slate-800 flex gap-3">
			<button class="flex-1 py-3 px-6 rounded-xl bg-primary text-white font-bold text-sm hover:bg-primary/90 transition-all shadow-lg shadow-primary/20 cursor-pointer">
				<?php esc_html_e( 'Track on DHL Website', 'luxe-landscape' ); ?>
			</button>
			<button class="py-3 px-4 rounded-xl border border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-300 font-bold text-sm hover:bg-white dark:hover:bg-slate-800 transition-all cursor-pointer">
				<?php esc_html_e( 'Help', 'luxe-landscape' ); ?>
			</button>
		</footer>
	</div>
</div>
