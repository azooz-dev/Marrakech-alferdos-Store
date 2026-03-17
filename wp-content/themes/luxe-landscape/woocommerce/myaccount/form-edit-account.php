<?php
/**
 * Account Profile Page (edit-account override)
 *
 * From Stitch: MyAccount-PersonalInformation.html
 *
 * @package WooCommerce\Templates
 * @version 9.9.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$user = wp_get_current_user();
do_action( 'woocommerce_before_edit_account_form' );
?>

<div class="mb-8">
	<h1 class="text-3xl font-black text-primary tracking-tight mb-2 acct-profile-title"><?php esc_html_e( 'Personal Information', 'luxe-landscape' ); ?></h1>
	<p class="text-slate-500 dark:text-slate-400 max-w-lg acct-profile-desc"><?php esc_html_e( 'Manage your biophilic sanctuary settings and update your contact preferences for a seamless luxury experience.', 'luxe-landscape' ); ?></p>
</div>

<div class="glass-card rounded-2xl p-8 shadow-xl">
	<form class="woocommerce-EditAccountForm edit-account" action="" method="post" <?php do_action( 'woocommerce_edit_account_form_tag' ); ?>>
		<?php do_action( 'woocommerce_edit_account_form_start' ); ?>

		<div class="flex-1 w-full space-y-6">
			<div class="grid grid-cols-1 md:grid-cols-1 gap-6">
				<!-- Full Name -->
				<div class="flex flex-col gap-2">
					<label class="text-sm font-bold text-slate-700 dark:text-slate-300 ml-1 acct-label-name" for="account_display_name"><?php esc_html_e( 'Full Name', 'luxe-landscape' ); ?></label>
					<input class="w-full bg-background-light dark:bg-emerald-900/20 border border-slate-200 dark:border-emerald-800/50 rounded-xl px-4 py-3.5 focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all outline-none text-slate-800 dark:text-white font-medium"
						   type="text" name="account_display_name" id="account_display_name"
						   value="<?php echo esc_attr( $user->display_name ); ?>"
						   placeholder="<?php esc_attr_e( 'e.g. Julian Montgomery', 'luxe-landscape' ); ?>" />
				</div>
			</div>

			<!-- Email Address -->
			<div class="flex flex-col gap-2">
				<label class="text-sm font-bold text-slate-700 dark:text-slate-300 ml-1 acct-label-email" for="account_email"><?php esc_html_e( 'Email Address', 'luxe-landscape' ); ?></label>
				<input class="w-full bg-background-light dark:bg-emerald-900/20 border border-slate-200 dark:border-emerald-800/50 rounded-xl px-4 py-3.5 focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all outline-none text-slate-800 dark:text-white font-medium"
					   type="email" name="account_email" id="account_email"
					   value="<?php echo esc_attr( $user->user_email ); ?>"
					   placeholder="<?php esc_attr_e( 'j.montgomery@example.com', 'luxe-landscape' ); ?>" />
			</div>

			<!-- Hidden fields for WooCommerce compatibility -->
			<input type="hidden" name="account_first_name" value="<?php echo esc_attr( $user->first_name ); ?>" />
			<input type="hidden" name="account_last_name" value="<?php echo esc_attr( $user->last_name ); ?>" />

			<?php do_action( 'woocommerce_edit_account_form' ); ?>

			<!-- Actions -->
			<div class="pt-4 flex items-center justify-between gap-4">
				<p class="text-xs text-slate-400 dark:text-slate-500 italic acct-last-updated">
					<?php
					$last_updated = get_user_meta( $user->ID, 'last_update', true );
					if ( $last_updated ) {
						printf( esc_html__( 'Last updated: %s', 'luxe-landscape' ), date_i18n( get_option( 'date_format' ), $last_updated ) );
					}
					?>
				</p>
				<div class="flex gap-3">
					<a href="<?php echo esc_url( wc_get_account_endpoint_url( 'edit-account' ) ); ?>"
					   class="px-6 py-3 rounded-xl text-sm font-bold text-slate-500 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors acct-btn-cancel">
						<?php esc_html_e( 'Cancel', 'luxe-landscape' ); ?>
					</a>
					<?php wp_nonce_field( 'save_account_details', 'save-account-details-nonce' ); ?>
					<button type="submit" name="save_account_details"
							class="bg-primary text-white px-8 py-3 rounded-xl text-sm font-bold shadow-lg hover:bg-primary/90 hover:shadow-primary/20 transition-all acct-btn-save">
						<?php esc_html_e( 'Save Changes', 'luxe-landscape' ); ?>
					</button>
				</div>
			</div>
		</div>

		<?php do_action( 'woocommerce_edit_account_form_end' ); ?>
	</form>
</div>

<!-- Security Info Cards -->
<div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
	<div class="flex items-start gap-3 p-4">
		<span class="material-symbols-outlined text-primary">encrypted</span>
		<div>
			<p class="text-sm font-bold text-slate-800 dark:text-slate-200 acct-sec-1-title"><?php esc_html_e( 'End-to-End Encryption', 'luxe-landscape' ); ?></p>
			<p class="text-xs text-slate-500 dark:text-slate-400 acct-sec-1-desc"><?php esc_html_e( 'Your personal data is encrypted and never shared with third parties.', 'luxe-landscape' ); ?></p>
		</div>
	</div>
	<div class="flex items-start gap-3 p-4">
		<span class="material-symbols-outlined text-primary">phonelink_lock</span>
		<div>
			<p class="text-sm font-bold text-slate-800 dark:text-slate-200 acct-sec-2-title"><?php esc_html_e( 'Biometric Focus', 'luxe-landscape' ); ?></p>
			<p class="text-xs text-slate-500 dark:text-slate-400 acct-sec-2-desc"><?php esc_html_e( 'Use your phone to sign in securely without remembering passwords.', 'luxe-landscape' ); ?></p>
		</div>
	</div>
	<div class="flex items-start gap-3 p-4">
		<span class="material-symbols-outlined text-primary">eco</span>
		<div>
			<p class="text-sm font-bold text-slate-800 dark:text-slate-200 acct-sec-3-title"><?php esc_html_e( 'Eco-Account', 'luxe-landscape' ); ?></p>
			<p class="text-xs text-slate-500 dark:text-slate-400 acct-sec-3-desc"><?php esc_html_e( 'For every update, we contribute to local reforestation efforts.', 'luxe-landscape' ); ?></p>
		</div>
	</div>
</div>
