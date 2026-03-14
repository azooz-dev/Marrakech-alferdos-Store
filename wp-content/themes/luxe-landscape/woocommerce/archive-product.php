<?php
/**
 * WooCommerce Archive Product Template Override
 *
 * Replaces the default WooCommerce shop page with Stitch-matching design.
 *
 * @package Luxe_Landscape
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();
?>

<div class="wc-shop-header">
    <?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
        <h1 class="section-title"><?php woocommerce_page_title(); ?></h1>
    <?php endif; ?>

    <?php
    /**
     * Hook: woocommerce_archive_description.
     */
    do_action( 'woocommerce_archive_description' );
    ?>
</div>

<main class="wc-main-content">
    <?php
    /**
     * Hook: woocommerce_before_shop_loop.
     * (Result count, ordering, etc.)
     */
    do_action( 'woocommerce_before_shop_loop' );
    ?>

    <?php if ( woocommerce_product_loop() ) : ?>
        <div class="wc-products-grid">
            <?php
            while ( have_posts() ) :
                the_post();

                /**
                 * Hook: woocommerce_shop_loop.
                 */
                do_action( 'woocommerce_shop_loop' );

                wc_get_template_part( 'content', 'product' );
            endwhile;
            ?>
        </div>

        <?php
        /**
         * Hook: woocommerce_after_shop_loop.
         * (Pagination)
         */
        do_action( 'woocommerce_after_shop_loop' );
        ?>
    <?php else : ?>
        <?php
        /**
         * Hook: woocommerce_no_products_found.
         */
        do_action( 'woocommerce_no_products_found' );
        ?>
    <?php endif; ?>
</main>

<?php get_footer(); ?>
