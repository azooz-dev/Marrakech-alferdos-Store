<?php
/**
 * My Account Dashboard Override
 *
 * This is effectively empty because we redirect dashboard to edit-account (profile).
 * If the redirect fails, show a basic welcome message.
 *
 * @package WooCommerce\Templates
 * @version 4.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$current_user = wp_get_current_user();
?>

<div class="mb-8">
	<h1 class="text-3xl font-black text-primary tracking-tight mb-2 acct-page-title">
		<?php printf( esc_html__( 'Welcome, %s', 'luxe-landscape' ), esc_html( $current_user->display_name ) ); ?>
	</h1>
	<p class="text-slate-500 max-w-lg acct-page-desc">
		<?php esc_html_e( 'Manage your biophilic sanctuary settings and preferences.', 'luxe-landscape' ); ?>
	</p>
</div>

<div class="glass-card rounded-2xl p-8 shadow-xl text-center">
	<span class="material-symbols-outlined text-6xl text-primary/30 mb-4">eco</span>
	<p class="text-slate-500">
		<?php esc_html_e( 'Use the sidebar to navigate to your profile, orders, favorites, or addresses.', 'luxe-landscape' ); ?>
	</p>
</div>
