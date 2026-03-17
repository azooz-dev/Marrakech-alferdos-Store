<?php
/**
 * Account Sidebar Navigation
 *
 * Shared sidebar used across all My Account pages.
 * Pixel-perfect from Stitch design.
 *
 * @package Luxe_Landscape
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Determine active endpoint
$current_endpoint = '';
if ( is_wc_endpoint_url( 'edit-account' ) )  $current_endpoint = 'edit-account';
elseif ( is_wc_endpoint_url( 'orders' ) )    $current_endpoint = 'orders';
elseif ( is_wc_endpoint_url( 'view-order' ) ) $current_endpoint = 'orders';
elseif ( is_wc_endpoint_url( 'favorites' ) ) $current_endpoint = 'favorites';
elseif ( is_wc_endpoint_url( 'edit-address' ) ) $current_endpoint = 'edit-address';

$sidebar_items = array(
	array(
		'endpoint' => 'edit-account',
		'icon'     => 'person',
		'label'    => __( 'Profile', 'luxe-landscape' ),
		'class'    => 'acct-sidebar-profile',
	),
	array(
		'endpoint' => 'orders',
		'icon'     => 'package',
		'label'    => __( 'Orders', 'luxe-landscape' ),
		'class'    => 'acct-sidebar-orders',
	),
	array(
		'endpoint' => 'favorites',
		'icon'     => 'favorite',
		'label'    => __( 'Favorites', 'luxe-landscape' ),
		'class'    => 'acct-sidebar-favorites',
	),
	array(
		'endpoint' => 'edit-address',
		'icon'     => 'location_on',
		'label'    => __( 'Addresses', 'luxe-landscape' ),
		'class'    => 'acct-sidebar-addresses',
	),
);
?>

<aside class="w-full md:w-64 flex-shrink-0 flex flex-col gap-2">
	<div class="glass-card rounded-xl overflow-hidden p-2">
		<div class="px-4 py-3 mb-2">
			<p class="text-xs font-bold uppercase tracking-widest text-slate-400 acct-sidebar-heading"><?php esc_html_e( 'Account Settings', 'luxe-landscape' ); ?></p>
		</div>

		<?php foreach ( $sidebar_items as $item ) :
			$is_active = ( $current_endpoint === $item['endpoint'] );
			$url = wc_get_account_endpoint_url( $item['endpoint'] );
			$active_class = $is_active
				? 'sidebar-item-active'
				: 'text-slate-600 dark:text-slate-400 hover:bg-primary/5 hover:text-primary';
		?>
			<a class="flex items-center gap-3 px-4 py-3 rounded-lg font-medium transition-all <?php echo esc_attr( $active_class ); ?>"
			   href="<?php echo esc_url( $url ); ?>">
				<span class="material-symbols-outlined text-[22px]"><?php echo esc_html( $item['icon'] ); ?></span>
				<span class="<?php echo esc_attr( $item['class'] ); ?>"><?php echo esc_html( $item['label'] ); ?></span>
			</a>
		<?php endforeach; ?>

		<div class="my-2 border-t border-slate-100 dark:border-slate-800"></div>

		<a class="flex items-center gap-3 px-4 py-3 rounded-lg font-medium text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 transition-all"
		   href="<?php echo esc_url( wc_get_account_endpoint_url( 'customer-logout' ) ); ?>">
			<span class="material-symbols-outlined text-[22px]">logout</span>
			<span class="acct-sidebar-logout"><?php esc_html_e( 'Logout', 'luxe-landscape' ); ?></span>
		</a>
	</div>

	<!-- Concierge Support Card -->
	<div class="bg-primary rounded-xl p-6 text-white relative overflow-hidden mt-4">
		<div class="relative z-10">
			<p class="text-sm font-light opacity-80 acct-support-subtitle"><?php esc_html_e( 'Need assistance?', 'luxe-landscape' ); ?></p>
			<p class="font-bold text-lg mb-4 acct-support-title"><?php esc_html_e( 'Concierge Support', 'luxe-landscape' ); ?></p>
			<button class="bg-white text-primary px-4 py-2 rounded-lg text-xs font-bold hover:bg-accent hover:text-white transition-colors acct-support-btn">
				<?php esc_html_e( 'Contact Specialist', 'luxe-landscape' ); ?>
			</button>
		</div>
		<span class="material-symbols-outlined absolute -bottom-4 -right-4 text-8xl opacity-10">nature_people</span>
	</div>
</aside>
