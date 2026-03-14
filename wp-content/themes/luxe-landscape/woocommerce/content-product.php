<?php
/**
 * WooCommerce Content Product Template Override
 *
 * Product card matching the Stitch "Trending Now" card design:
 * rounded image container, hover scale, sale badge, floating add-to-cart, title, price.
 *
 * @package Luxe_Landscape
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

global $product;

if ( ! is_a( $product, 'WC_Product' ) ) {
    return;
}

$is_on_sale = $product->is_on_sale();
$sale_perc  = '';

if ( $is_on_sale && $product->get_regular_price() && $product->get_sale_price() ) {
    $regular = floatval( $product->get_regular_price() );
    $sale    = floatval( $product->get_sale_price() );
    if ( $regular > 0 ) {
        $sale_perc = round( ( ( $regular - $sale ) / $regular ) * 100 ) . '% OFF';
    }
}
?>

<div <?php wc_product_class( 'product-card' ); ?>>
    <div class="product-card-image">
        <a href="<?php the_permalink(); ?>">
            <?php if ( has_post_thumbnail() ) : ?>
                <img src="<?php echo esc_url( get_the_post_thumbnail_url( get_the_ID(), 'large' ) ); ?>"
                     alt="<?php echo esc_attr( get_the_title() ); ?>"
                     loading="lazy">
            <?php else : ?>
                <img src="<?php echo esc_url( wc_placeholder_img_src( 'large' ) ); ?>"
                     alt="<?php echo esc_attr( get_the_title() ); ?>"
                     loading="lazy">
            <?php endif; ?>
        </a>

        <?php if ( $is_on_sale && $sale_perc ) : ?>
            <span class="product-card-badge"><?php echo esc_html( $sale_perc ); ?></span>
        <?php endif; ?>

        <?php if ( $product->is_purchasable() && $product->is_in_stock() ) : ?>
            <a href="<?php echo esc_url( $product->add_to_cart_url() ); ?>"
               class="product-card-add ajax_add_to_cart"
               data-product_id="<?php echo esc_attr( $product->get_id() ); ?>"
               data-product_sku="<?php echo esc_attr( $product->get_sku() ); ?>"
               aria-label="<?php echo esc_attr( sprintf( __( 'Add "%s" to your cart', 'luxe-landscape' ), get_the_title() ) ); ?>">
                <span class="material-symbols-outlined">add</span>
            </a>
        <?php endif; ?>
    </div>

    <a href="<?php the_permalink(); ?>">
        <h4 class="product-card-title"><?php the_title(); ?></h4>
    </a>

    <div class="product-card-prices">
        <?php if ( $is_on_sale ) : ?>
            <span class="product-card-price-old"><?php echo wp_kses_post( wc_price( $product->get_regular_price() ) ); ?></span>
            <span class="product-card-price-current"><?php echo wp_kses_post( wc_price( $product->get_sale_price() ) ); ?></span>
        <?php else : ?>
            <span class="product-card-price-regular"><?php echo wp_kses_post( $product->get_price_html() ); ?></span>
        <?php endif; ?>
    </div>
</div>
