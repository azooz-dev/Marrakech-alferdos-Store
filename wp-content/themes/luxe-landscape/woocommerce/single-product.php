<?php
/**
 * WooCommerce Single Product Template Override
 *
 * Product detail page maintaining the Stitch visual identity.
 *
 * @package Luxe_Landscape
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();
?>

<?php while ( have_posts() ) : the_post(); ?>

    <?php global $product; ?>

    <div class="wc-single-product">
        <!-- Product Gallery -->
        <div class="wc-product-gallery">
            <?php if ( has_post_thumbnail() ) : ?>
                <img src="<?php echo esc_url( get_the_post_thumbnail_url( get_the_ID(), 'full' ) ); ?>"
                     alt="<?php echo esc_attr( get_the_title() ); ?>">
            <?php else : ?>
                <img src="<?php echo esc_url( wc_placeholder_img_src( 'full' ) ); ?>"
                     alt="<?php echo esc_attr( get_the_title() ); ?>">
            <?php endif; ?>

            <?php
            // Display gallery images if available
            $gallery_ids = $product->get_gallery_image_ids();
            if ( ! empty( $gallery_ids ) ) :
                ?>
                <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 0.5rem; margin-top: 0.5rem;">
                    <?php foreach ( array_slice( $gallery_ids, 0, 4 ) as $gallery_id ) : ?>
                        <img src="<?php echo esc_url( wp_get_attachment_url( $gallery_id ) ); ?>"
                             alt="<?php echo esc_attr( get_the_title() ); ?>"
                             style="border-radius: var(--radius-sm); width: 100%; height: 100px; object-fit: cover; cursor: pointer;"
                             loading="lazy">
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

        <!-- Product Info -->
        <div class="wc-product-info">
            <?php if ( $product->is_on_sale() ) : ?>
                <span class="product-card-badge" style="align-self: flex-start;">
                    <?php esc_html_e( 'Sale', 'luxe-landscape' ); ?>
                </span>
            <?php endif; ?>

            <h1 class="wc-product-title"><?php the_title(); ?></h1>

            <div class="wc-product-price">
                <?php echo wp_kses_post( $product->get_price_html() ); ?>
            </div>

            <?php if ( $product->get_short_description() ) : ?>
                <div class="wc-product-desc">
                    <?php echo wp_kses_post( $product->get_short_description() ); ?>
                </div>
            <?php endif; ?>

            <?php if ( $product->is_purchasable() && $product->is_in_stock() ) : ?>
                <form class="wc-add-to-cart-form" action="<?php echo esc_url( $product->add_to_cart_url() ); ?>" method="post" enctype="multipart/form-data">
                    <?php if ( $product->is_type( 'simple' ) ) : ?>
                        <div class="quantity">
                            <label class="sr-only" for="quantity_<?php echo esc_attr( $product->get_id() ); ?>">
                                <?php esc_html_e( 'Quantity', 'luxe-landscape' ); ?>
                            </label>
                            <input type="number"
                                   id="quantity_<?php echo esc_attr( $product->get_id() ); ?>"
                                   name="quantity"
                                   value="1"
                                   min="1"
                                   max="<?php echo esc_attr( $product->get_max_purchase_quantity() > 0 ? $product->get_max_purchase_quantity() : '' ); ?>"
                                   step="1">
                        </div>
                        <input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>">
                        <button type="submit" class="btn-primary">
                            <span class="material-symbols-outlined" aria-hidden="true">shopping_bag</span>
                            <?php esc_html_e( 'Add to Cart', 'luxe-landscape' ); ?>
                        </button>
                    <?php else : ?>
                        <a href="<?php echo esc_url( $product->add_to_cart_url() ); ?>" class="btn-primary">
                            <?php echo esc_html( $product->add_to_cart_text() ); ?>
                        </a>
                    <?php endif; ?>
                </form>
            <?php elseif ( ! $product->is_in_stock() ) : ?>
                <p style="color: #ef4444; font-weight: 700;"><?php esc_html_e( 'Out of Stock', 'luxe-landscape' ); ?></p>
            <?php endif; ?>

            <!-- Product Meta -->
            <div style="padding-top: 2rem; border-top: 1px solid var(--slate-100); margin-top: 1rem;">
                <?php if ( $product->get_sku() ) : ?>
                    <p style="color: var(--slate-500); font-size: 0.875rem; margin-bottom: 0.5rem;">
                        <strong><?php esc_html_e( 'SKU:', 'luxe-landscape' ); ?></strong>
                        <?php echo esc_html( $product->get_sku() ); ?>
                    </p>
                <?php endif; ?>

                <?php
                $categories = wc_get_product_category_list( $product->get_id(), ', ' );
                if ( $categories ) :
                    ?>
                    <p style="color: var(--slate-500); font-size: 0.875rem; margin-bottom: 0.5rem;">
                        <strong><?php esc_html_e( 'Category:', 'luxe-landscape' ); ?></strong>
                        <?php echo wp_kses_post( $categories ); ?>
                    </p>
                <?php endif; ?>

                <?php
                $tags = wc_get_product_tag_list( $product->get_id(), ', ' );
                if ( $tags ) :
                    ?>
                    <p style="color: var(--slate-500); font-size: 0.875rem;">
                        <strong><?php esc_html_e( 'Tags:', 'luxe-landscape' ); ?></strong>
                        <?php echo wp_kses_post( $tags ); ?>
                    </p>
                <?php endif; ?>
            </div>

            <!-- Product Description Tabs -->
            <?php if ( $product->get_description() ) : ?>
                <div style="margin-top: 2rem;">
                    <h3 style="font-size: 1.25rem; font-weight: 700; margin-bottom: 1rem;">
                        <?php esc_html_e( 'Description', 'luxe-landscape' ); ?>
                    </h3>
                    <div class="wc-product-desc">
                        <?php echo wp_kses_post( $product->get_description() ); ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <?php
    // Related Products
    $related_ids = wc_get_related_products( $product->get_id(), 4 );
    if ( ! empty( $related_ids ) ) :
        ?>
        <section class="trending-section" style="margin-top: 0;">
            <div class="trending-header">
                <h2><?php esc_html_e( 'You May Also Like', 'luxe-landscape' ); ?></h2>
            </div>
            <div class="products-scroll">
                <?php
                foreach ( $related_ids as $related_id ) :
                    $related_product = wc_get_product( $related_id );
                    if ( ! $related_product ) continue;

                    $related_on_sale = $related_product->is_on_sale();
                    $related_badge   = '';

                    if ( $related_on_sale && $related_product->get_regular_price() && $related_product->get_sale_price() ) {
                        $reg = floatval( $related_product->get_regular_price() );
                        $sal = floatval( $related_product->get_sale_price() );
                        if ( $reg > 0 ) {
                            $related_badge = round( ( ( $reg - $sal ) / $reg ) * 100 ) . '% OFF';
                        }
                    }
                    ?>
                    <div class="product-card">
                        <div class="product-card-image">
                            <a href="<?php echo esc_url( get_permalink( $related_id ) ); ?>">
                                <?php if ( has_post_thumbnail( $related_id ) ) : ?>
                                    <img src="<?php echo esc_url( get_the_post_thumbnail_url( $related_id, 'large' ) ); ?>"
                                         alt="<?php echo esc_attr( $related_product->get_name() ); ?>"
                                         loading="lazy">
                                <?php else : ?>
                                    <img src="<?php echo esc_url( wc_placeholder_img_src( 'large' ) ); ?>"
                                         alt="<?php echo esc_attr( $related_product->get_name() ); ?>"
                                         loading="lazy">
                                <?php endif; ?>
                            </a>
                            <?php if ( $related_on_sale && $related_badge ) : ?>
                                <span class="product-card-badge"><?php echo esc_html( $related_badge ); ?></span>
                            <?php endif; ?>
                            <?php if ( $related_product->is_purchasable() && $related_product->is_in_stock() ) : ?>
                                <a href="<?php echo esc_url( $related_product->add_to_cart_url() ); ?>"
                                   class="product-card-add"
                                   aria-label="<?php echo esc_attr( sprintf( __( 'Add "%s" to your cart', 'luxe-landscape' ), $related_product->get_name() ) ); ?>">
                                    <span class="material-symbols-outlined">add</span>
                                </a>
                            <?php endif; ?>
                        </div>
                        <a href="<?php echo esc_url( get_permalink( $related_id ) ); ?>">
                            <h4 class="product-card-title"><?php echo esc_html( $related_product->get_name() ); ?></h4>
                        </a>
                        <div class="product-card-prices">
                            <?php if ( $related_on_sale ) : ?>
                                <span class="product-card-price-old"><?php echo wp_kses_post( wc_price( $related_product->get_regular_price() ) ); ?></span>
                                <span class="product-card-price-current"><?php echo wp_kses_post( wc_price( $related_product->get_sale_price() ) ); ?></span>
                            <?php else : ?>
                                <span class="product-card-price-regular"><?php echo wp_kses_post( $related_product->get_price_html() ); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    <?php endif; ?>

<?php endwhile; ?>

<?php get_footer(); ?>
