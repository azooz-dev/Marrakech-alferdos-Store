<?php
/**
 * Account Addresses Page Override
 *
 * From Stitch: MyAccount-addresses.html + DialogForm-AddNewAddress.html
 *
 * @package WooCommerce\Templates
 * @version 9.9.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$customer_id = get_current_user_id();

// Get saved addresses
$billing_address = array(
	'first_name' => get_user_meta( $customer_id, 'billing_first_name', true ),
	'last_name'  => get_user_meta( $customer_id, 'billing_last_name', true ),
	'address_1'  => get_user_meta( $customer_id, 'billing_address_1', true ),
	'address_2'  => get_user_meta( $customer_id, 'billing_address_2', true ),
	'city'       => get_user_meta( $customer_id, 'billing_city', true ),
	'state'      => get_user_meta( $customer_id, 'billing_state', true ),
	'postcode'   => get_user_meta( $customer_id, 'billing_postcode', true ),
);

$shipping_address = array(
	'first_name' => get_user_meta( $customer_id, 'shipping_first_name', true ),
	'last_name'  => get_user_meta( $customer_id, 'shipping_last_name', true ),
	'address_1'  => get_user_meta( $customer_id, 'shipping_address_1', true ),
	'address_2'  => get_user_meta( $customer_id, 'shipping_address_2', true ),
	'city'       => get_user_meta( $customer_id, 'shipping_city', true ),
	'state'      => get_user_meta( $customer_id, 'shipping_state', true ),
	'postcode'   => get_user_meta( $customer_id, 'shipping_postcode', true ),
);

$has_shipping = ! empty( $shipping_address['address_1'] );
$has_billing  = ! empty( $billing_address['address_1'] );
?>

<div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8">
	<div>
		<h1 class="text-3xl font-black text-primary tracking-tight mb-2 acct-addresses-title"><?php esc_html_e( 'Saved Addresses', 'luxe-landscape' ); ?></h1>
		<p class="text-slate-500 dark:text-slate-400 max-w-lg acct-addresses-desc"><?php esc_html_e( 'Manage your shipping and billing locations for a seamless luxury shopping experience.', 'luxe-landscape' ); ?></p>
	</div>
	<button id="open-address-modal"
			class="flex items-center gap-2 bg-primary text-white px-6 py-3 rounded-xl font-bold hover:bg-primary/90 transition-all shadow-md acct-btn-add-address">
		<span class="material-symbols-outlined text-xl">add_location</span>
		<span><?php esc_html_e( 'Add New Address', 'luxe-landscape' ); ?></span>
	</button>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
	<!-- Primary Shipping Address -->
	<div class="glass-card rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-all flex flex-col">
		<div class="h-32 bg-slate-200 dark:bg-slate-800 relative">
			<div class="absolute inset-0 flex items-center justify-center opacity-40">
				<span class="material-symbols-outlined text-5xl">map</span>
			</div>
			<div class="absolute top-3 right-3 bg-primary text-white text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-wider acct-badge-shipping">
				<?php esc_html_e( 'Primary Shipping', 'luxe-landscape' ); ?>
			</div>
		</div>
		<div class="p-6 flex-grow">
			<div class="flex items-center gap-2 mb-3 text-primary">
				<span class="material-symbols-outlined">home</span>
				<h3 class="font-bold acct-addr-home-label"><?php esc_html_e( 'Home Estate', 'luxe-landscape' ); ?></h3>
			</div>
			<div class="text-slate-600 dark:text-slate-400 space-y-1 text-sm leading-relaxed">
				<?php if ( $has_shipping ) : ?>
					<p><?php echo esc_html( $shipping_address['first_name'] . ' ' . $shipping_address['last_name'] ); ?></p>
					<p><?php echo esc_html( $shipping_address['address_1'] ); ?></p>
					<?php if ( $shipping_address['address_2'] ) : ?><p><?php echo esc_html( $shipping_address['address_2'] ); ?></p><?php endif; ?>
					<p><?php echo esc_html( $shipping_address['city'] . ', ' . $shipping_address['state'] . ' ' . $shipping_address['postcode'] ); ?></p>
				<?php else : ?>
					<p>Julianne Sterling</p>
					<p>842 Verdant Valley Road</p>
					<p>Pacific Palisades, CA 90272</p>
					<p>United States</p>
				<?php endif; ?>
			</div>
		</div>
		<div class="px-6 py-4 bg-slate-50/50 dark:bg-slate-800/50 border-t border-slate-100 dark:border-slate-800 flex gap-3">
			<a href="<?php echo esc_url( wc_get_endpoint_url( 'edit-address', 'shipping' ) ); ?>"
			   class="flex-1 py-2 rounded-lg text-xs font-bold border border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-300 hover:bg-white dark:hover:bg-slate-700 transition-colors flex items-center justify-center gap-1 acct-btn-edit">
				<span class="material-symbols-outlined text-sm">edit</span> <?php esc_html_e( 'Edit', 'luxe-landscape' ); ?>
			</a>
			<button class="flex-1 py-2 rounded-lg text-xs font-bold border border-slate-200 dark:border-slate-700 text-slate-400 hover:text-red-500 hover:border-red-200 transition-colors flex items-center justify-center gap-1 acct-btn-delete">
				<span class="material-symbols-outlined text-sm">delete</span> <?php esc_html_e( 'Delete', 'luxe-landscape' ); ?>
			</button>
		</div>
	</div>

	<!-- Billing Address -->
	<div class="glass-card rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-all flex flex-col">
		<div class="h-32 bg-slate-200 dark:bg-slate-800 relative">
			<div class="absolute inset-0 flex items-center justify-center opacity-40">
				<span class="material-symbols-outlined text-5xl">map</span>
			</div>
			<div class="absolute top-3 right-3 bg-slate-500 text-white text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-wider acct-badge-billing">
				<?php esc_html_e( 'Billing Address', 'luxe-landscape' ); ?>
			</div>
		</div>
		<div class="p-6 flex-grow">
			<div class="flex items-center gap-2 mb-3 text-primary">
				<span class="material-symbols-outlined">business</span>
				<h3 class="font-bold acct-addr-office-label"><?php esc_html_e( 'Studio Office', 'luxe-landscape' ); ?></h3>
			</div>
			<div class="text-slate-600 dark:text-slate-400 space-y-1 text-sm leading-relaxed">
				<?php if ( $has_billing ) : ?>
					<p><?php echo esc_html( $billing_address['first_name'] . ' ' . $billing_address['last_name'] ); ?></p>
					<p><?php echo esc_html( $billing_address['address_1'] ); ?></p>
					<?php if ( $billing_address['address_2'] ) : ?><p><?php echo esc_html( $billing_address['address_2'] ); ?></p><?php endif; ?>
					<p><?php echo esc_html( $billing_address['city'] . ', ' . $billing_address['state'] . ' ' . $billing_address['postcode'] ); ?></p>
				<?php else : ?>
					<p>Sterling Designs LLC</p>
					<p>1200 Emerald Tower, Ste 402</p>
					<p>Los Angeles, CA 90015</p>
				<?php endif; ?>
			</div>
		</div>
		<div class="px-6 py-4 bg-slate-50/50 dark:bg-slate-800/50 border-t border-slate-100 dark:border-slate-800 flex gap-3">
			<a href="<?php echo esc_url( wc_get_endpoint_url( 'edit-address', 'billing' ) ); ?>"
			   class="flex-1 py-2 rounded-lg text-xs font-bold border border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-300 hover:bg-white dark:hover:bg-slate-700 transition-colors flex items-center justify-center gap-1 acct-btn-edit">
				<span class="material-symbols-outlined text-sm">edit</span> <?php esc_html_e( 'Edit', 'luxe-landscape' ); ?>
			</a>
			<button class="flex-1 py-2 rounded-lg text-xs font-bold border border-slate-200 dark:border-slate-700 text-slate-400 hover:text-red-500 hover:border-red-200 transition-colors flex items-center justify-center gap-1 acct-btn-delete">
				<span class="material-symbols-outlined text-sm">delete</span> <?php esc_html_e( 'Delete', 'luxe-landscape' ); ?>
			</button>
		</div>
	</div>
</div>

<!-- ========================================
     ADD NEW ADDRESS MODAL
     ======================================== -->
<div id="address-modal" class="fixed inset-0 z-50 flex items-center justify-center p-4 hidden" style="backdrop-filter: blur(8px); background-color: rgba(0,0,0,0.4);">
	<div class="bg-background-light dark:bg-background-dark w-full max-w-2xl rounded-2xl shadow-2xl overflow-hidden border border-white/20 dark:border-slate-700 max-h-[90vh] overflow-y-auto">
		<!-- Modal Header -->
		<div class="px-8 pt-8 pb-4 flex justify-between items-center">
			<div>
				<h2 class="font-display text-3xl font-bold text-primary dark:text-primary acct-modal-title"><?php esc_html_e( 'Add New Address', 'luxe-landscape' ); ?></h2>
				<p class="text-slate-500 dark:text-slate-400 text-sm mt-1 acct-modal-desc"><?php esc_html_e( 'Enter your details for biophilic delivery.', 'luxe-landscape' ); ?></p>
			</div>
			<button id="close-address-modal" class="text-slate-400 hover:text-slate-600 dark:hover:text-white transition-colors">
				<span class="material-symbols-outlined text-3xl">close</span>
			</button>
		</div>

		<!-- Form -->
		<form class="px-8 py-4 space-y-6">
			<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
				<div class="flex flex-col gap-1.5">
					<label class="text-sm font-semibold text-primary/80 dark:text-primary/60 acct-modal-label-tag"><?php esc_html_e( 'Address Label', 'luxe-landscape' ); ?></label>
					<input class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-emerald-800/50 bg-white dark:bg-emerald-900/20 focus:ring-2 focus:ring-primary focus:border-transparent outline-none transition-all dark:text-white"
						   placeholder="<?php esc_attr_e( 'e.g. Home, Office', 'luxe-landscape' ); ?>" type="text" />
				</div>
				<div class="flex flex-col gap-1.5">
					<label class="text-sm font-semibold text-primary/80 dark:text-primary/60 acct-modal-label-name"><?php esc_html_e( 'Full Name', 'luxe-landscape' ); ?></label>
					<input class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-emerald-800/50 bg-white dark:bg-emerald-900/20 focus:ring-2 focus:ring-primary focus:border-transparent outline-none transition-all dark:text-white"
						   placeholder="<?php esc_attr_e( 'Alexander Sterling', 'luxe-landscape' ); ?>" type="text" />
				</div>
			</div>

			<div class="flex flex-col gap-1.5">
				<label class="text-sm font-semibold text-primary/80 dark:text-primary/60 acct-modal-label-street"><?php esc_html_e( 'Street Address', 'luxe-landscape' ); ?></label>
				<input class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-emerald-800/50 bg-white dark:bg-emerald-900/20 focus:ring-2 focus:ring-primary focus:border-transparent outline-none transition-all dark:text-white"
					   placeholder="<?php esc_attr_e( '1245 Verdant Way', 'luxe-landscape' ); ?>" type="text" />
			</div>

			<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
				<div class="flex flex-col gap-1.5">
					<label class="text-sm font-semibold text-primary/80 dark:text-primary/60 acct-modal-label-apt"><?php esc_html_e( 'Apartment, suite, etc. (Optional)', 'luxe-landscape' ); ?></label>
					<input class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-emerald-800/50 bg-white dark:bg-emerald-900/20 focus:ring-2 focus:ring-primary focus:border-transparent outline-none transition-all dark:text-white"
						   placeholder="<?php esc_attr_e( 'Apt 4B', 'luxe-landscape' ); ?>" type="text" />
				</div>
				<div class="flex flex-col gap-1.5">
					<label class="text-sm font-semibold text-primary/80 dark:text-primary/60 acct-modal-label-city"><?php esc_html_e( 'City', 'luxe-landscape' ); ?></label>
					<input class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-emerald-800/50 bg-white dark:bg-emerald-900/20 focus:ring-2 focus:ring-primary focus:border-transparent outline-none transition-all dark:text-white"
						   placeholder="<?php esc_attr_e( 'San Francisco', 'luxe-landscape' ); ?>" type="text" />
				</div>
			</div>

			<div class="grid grid-cols-3 gap-4">
				<div class="flex flex-col gap-1.5">
					<label class="text-sm font-semibold text-primary/80 dark:text-primary/60 acct-modal-label-state"><?php esc_html_e( 'State/Province', 'luxe-landscape' ); ?></label>
					<input class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-emerald-800/50 bg-white dark:bg-emerald-900/20 focus:ring-2 focus:ring-primary focus:border-transparent outline-none transition-all dark:text-white"
						   placeholder="<?php esc_attr_e( 'CA', 'luxe-landscape' ); ?>" type="text" />
				</div>
				<div class="flex flex-col gap-1.5">
					<label class="text-sm font-semibold text-primary/80 dark:text-primary/60 acct-modal-label-postal"><?php esc_html_e( 'Postal Code', 'luxe-landscape' ); ?></label>
					<input class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-emerald-800/50 bg-white dark:bg-emerald-900/20 focus:ring-2 focus:ring-primary focus:border-transparent outline-none transition-all dark:text-white"
						   placeholder="<?php esc_attr_e( '94105', 'luxe-landscape' ); ?>" type="text" />
				</div>
			</div>

			<!-- Toggle Switches -->
			<div class="space-y-3 pt-2">
				<label class="flex items-center gap-3 cursor-pointer group">
					<div class="relative">
						<input class="peer sr-only" type="checkbox" />
						<div class="w-10 h-6 bg-slate-300 dark:bg-slate-700 rounded-full peer-checked:bg-primary transition-colors"></div>
						<div class="absolute left-1 top-1 w-4 h-4 bg-white rounded-full transition-transform peer-checked:translate-x-4 shadow-sm"></div>
					</div>
					<span class="text-sm font-medium text-slate-700 dark:text-slate-300 acct-switch-shipping"><?php esc_html_e( 'Set as Primary Shipping Address', 'luxe-landscape' ); ?></span>
				</label>
				<label class="flex items-center gap-3 cursor-pointer group">
					<div class="relative">
						<input class="peer sr-only" type="checkbox" />
						<div class="w-10 h-6 bg-slate-300 dark:bg-slate-700 rounded-full peer-checked:bg-primary transition-colors"></div>
						<div class="absolute left-1 top-1 w-4 h-4 bg-white rounded-full transition-transform peer-checked:translate-x-4 shadow-sm"></div>
					</div>
					<span class="text-sm font-medium text-slate-700 dark:text-slate-300 acct-switch-billing"><?php esc_html_e( 'Set as Billing Address', 'luxe-landscape' ); ?></span>
				</label>
			</div>
		</form>

		<!-- Modal Actions -->
		<div class="px-8 py-8 flex flex-col sm:flex-row-reverse gap-4 bg-slate-50 dark:bg-slate-800/50 mt-4">
			<button class="w-full sm:w-auto px-8 py-4 bg-primary hover:bg-primary/90 text-white font-bold rounded-xl shadow-lg shadow-primary/20 transition-all flex items-center justify-center gap-2 acct-modal-save">
				<span class="material-symbols-outlined">save</span>
				<?php esc_html_e( 'Save Address', 'luxe-landscape' ); ?>
			</button>
			<button id="cancel-address-modal" class="w-full sm:w-auto px-8 py-4 text-slate-500 dark:text-slate-400 font-medium hover:text-primary transition-colors acct-modal-cancel">
				<?php esc_html_e( 'Cancel', 'luxe-landscape' ); ?>
			</button>
		</div>
	</div>
</div>
