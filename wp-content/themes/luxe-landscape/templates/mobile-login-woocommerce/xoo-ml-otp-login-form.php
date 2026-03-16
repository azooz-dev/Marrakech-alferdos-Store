<?php
/**
 * Login Form with OTP
 *
 * This template can be overridden by copying it to yourtheme/templates/mobile-login-woocommerce/xoo-ml-otp-login-form.php
 *
 * @version 2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<button type="button" class="xoo-ml-open-lwo-btn button btn <?php echo esc_attr( implode( ' ', $args['button_class'] ) ); ?> ">
    <span class="auth-btn-login-text"><?php _e( 'Login', 'mobile-login-woocommerce' ); ?></span>
</button>

<div class="xoo-ml-lwo-form-placeholder" <?php if( $args['login_first'] !== 'yes' ): ?> style="display: none;" <?php endif; ?> >

	<?php echo xoo_ml_get_phone_input_field( $args );  ?>

	<input type="hidden" name="redirect" value="<?php echo esc_attr( $args['redirect'] ); ?>">

	<input type="hidden" name="xoo-ml-login-with-otp" value="1">

	<button type="submit" class="xoo-ml-login-otp-btn <?php echo esc_attr( implode( ' ', $args['button_class'] ) ); ?> ">
        <span class="auth-btn-login-text"><?php _e( 'Login', 'mobile-login-woocommerce' ); ?></span>
    </button>

</div>
