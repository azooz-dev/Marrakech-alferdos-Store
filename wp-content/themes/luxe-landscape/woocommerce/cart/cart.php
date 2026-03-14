<?php
/**
 * WooCommerce Cart Template Override
 *
 * Cart page with Stitch-consistent styling.
 *
 * @package Luxe_Landscape
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();

do_action( 'woocommerce_before_cart' );
?>

<div class="wc-cart-section">
    <h1><?php esc_html_e( 'Your Shopping Cart', 'luxe-landscape' ); ?></h1>

    <?php wc_print_notices(); ?>

    <?php if ( WC()->cart->is_empty() ) : ?>
        <div style="text-align: center; padding: 4rem 0;">
            <span class="material-symbols-outlined" style="font-size: 4rem; color: var(--slate-300); margin-bottom: 1rem; display: block;">shopping_bag</span>
            <p style="color: var(--slate-500); font-size: 1.125rem; margin-bottom: 2rem;">
                <?php esc_html_e( 'Your cart is currently empty.', 'luxe-landscape' ); ?>
            </p>
            <a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" class="btn-primary" style="display: inline-flex;">
                <?php esc_html_e( 'Continue Shopping', 'luxe-landscape' ); ?>
                <span class="material-symbols-outlined" aria-hidden="true">arrow_forward</span>
            </a>
        </div>
    <?php else : ?>
        <form action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
            <?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>

            <table class="wc-cart-table">
                <thead>
                    <tr>
                        <th><?php esc_html_e( 'Product', 'luxe-landscape' ); ?></th>
                        <th><?php esc_html_e( 'Price', 'luxe-landscape' ); ?></th>
                        <th><?php esc_html_e( 'Quantity', 'luxe-landscape' ); ?></th>
                        <th><?php esc_html_e( 'Total', 'luxe-landscape' ); ?></th>
                        <th><span class="sr-only"><?php esc_html_e( 'Remove', 'luxe-landscape' ); ?></span></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) :
                        $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                        $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

                        if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) :
                            $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
                            ?>
                            <tr>
                                <!-- Product -->
                                <td>
                                    <div class="wc-cart-product-info">
                                        <?php
                                        $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image( 'thumbnail' ), $cart_item, $cart_item_key );
                                        if ( $product_permalink ) {
                                            printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail );
                                        } else {
                                            echo $thumbnail; // phpcs:ignore
                                        }
                                        ?>
                                        <div>
                                            <span class="wc-cart-product-name">
                                                <?php
                                                if ( $product_permalink ) {
                                                    printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) ) );
                                                } else {
                                                    echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) );
                                                }
                                                ?>
                                            </span>
                                        </div>
                                    </div>
                                </td>

                                <!-- Price -->
                                <td>
                                    <?php echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); // phpcs:ignore ?>
                                </td>

                                <!-- Quantity -->
                                <td>
                                    <div class="wc-cart-quantity">
                                        <?php
                                        if ( $_product->is_sold_individually() ) {
                                            $min_quantity = 1;
                                            $max_quantity = 1;
                                        } else {
                                            $min_quantity = 0;
                                            $max_quantity = $_product->get_max_purchase_quantity();
                                        }

                                        $product_quantity = woocommerce_quantity_input(
                                            array(
                                                'input_name'   => "cart[{$cart_item_key}][qty]",
                                                'input_value'  => $cart_item['quantity'],
                                                'max_value'    => $max_quantity,
                                                'min_value'    => $min_quantity,
                                                'product_name' => $_product->get_name(),
                                            ),
                                            $_product,
                                            false
                                        );

                                        echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // phpcs:ignore
                                        ?>
                                    </div>
                                </td>

                                <!-- Subtotal -->
                                <td>
                                    <strong><?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // phpcs:ignore ?></strong>
                                </td>

                                <!-- Remove -->
                                <td>
                                    <a href="<?php echo esc_url( wc_get_cart_remove_url( $cart_item_key ) ); ?>"
                                       class="wc-cart-remove"
                                       aria-label="<?php echo esc_attr( sprintf( __( 'Remove %s from cart', 'luxe-landscape' ), $_product->get_name() ) ); ?>"
                                       data-product_id="<?php echo esc_attr( $product_id ); ?>">
                                        <span class="material-symbols-outlined">close</span>
                                    </a>
                                </td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 2rem; flex-wrap: wrap; gap: 1rem;">
                <a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" class="btn-outline" style="display: inline-flex; align-items: center; gap: 0.5rem;">
                    <span class="material-symbols-outlined" aria-hidden="true">arrow_back</span>
                    <?php esc_html_e( 'Continue Shopping', 'luxe-landscape' ); ?>
                </a>
                <button type="submit" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'luxe-landscape' ); ?>" class="btn-outline">
                    <?php esc_html_e( 'Update Cart', 'luxe-landscape' ); ?>
                </button>
            </div>

            <!-- Cart Totals -->
            <div class="wc-cart-totals">
                <h2><?php esc_html_e( 'Cart Totals', 'luxe-landscape' ); ?></h2>

                <div class="wc-cart-totals-row">
                    <span><?php esc_html_e( 'Subtotal', 'luxe-landscape' ); ?></span>
                    <span><?php wc_cart_totals_subtotal_html(); ?></span>
                </div>

                <?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
                    <div class="wc-cart-totals-row">
                        <span><?php wc_cart_totals_coupon_label( $coupon ); ?></span>
                        <span><?php wc_cart_totals_coupon_html( $coupon ); ?></span>
                    </div>
                <?php endforeach; ?>

                <?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>
                    <div class="wc-cart-totals-row">
                        <span><?php esc_html_e( 'Shipping', 'luxe-landscape' ); ?></span>
                        <span><?php wc_cart_totals_shipping_html(); ?></span>
                    </div>
                <?php endif; ?>

                <?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
                    <div class="wc-cart-totals-row">
                        <span><?php echo esc_html( $fee->name ); ?></span>
                        <span><?php wc_cart_totals_fee_html( $fee ); ?></span>
                    </div>
                <?php endforeach; ?>

                <?php if ( wc_tax_enabled() && ! WC()->cart->display_prices_including_tax() ) : ?>
                    <?php if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) : ?>
                        <?php foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : ?>
                            <div class="wc-cart-totals-row">
                                <span><?php echo esc_html( $tax->label ); ?></span>
                                <span><?php echo wp_kses_post( $tax->formatted_amount ); ?></span>
                            </div>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <div class="wc-cart-totals-row">
                            <span><?php echo esc_html( WC()->countries->tax_or_vat() ); ?></span>
                            <span><?php wc_cart_totals_taxes_total_html(); ?></span>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>

                <div class="wc-cart-totals-row total">
                    <span><?php esc_html_e( 'Total', 'luxe-landscape' ); ?></span>
                    <span><?php wc_cart_totals_order_total_html(); ?></span>
                </div>

                <a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="btn-primary wc-checkout-btn" style="justify-content: center;">
                    <?php esc_html_e( 'Proceed to Checkout', 'luxe-landscape' ); ?>
                    <span class="material-symbols-outlined" aria-hidden="true">arrow_forward</span>
                </a>
            </div>
        </form>
    <?php endif; ?>
</div>

<?php
do_action( 'woocommerce_after_cart' );

get_footer();
?>
