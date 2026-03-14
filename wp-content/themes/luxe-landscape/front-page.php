<?php
/**
 * Front Page Template
 *
 * Homepage layout: Hero, Bento Categories, Trending Products, B2B Section.
 * All sections replicate the Stitch "Biophilic Luxury Homepage" design.
 *
 * @package Luxe_Landscape
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();
?>

<!-- ============================================
     IMMERSIVE HERO SECTION
     ============================================ -->
<section class="hero-section" id="hero">
    <div class="hero-container">
        <div class="hero-content">
            <div class="hero-badge">
                <span class="material-symbols-outlined" aria-hidden="true">verified</span>
                DIRECT FROM MANUFACTURER
            </div>
            <h1 class="hero-title">
                Transform Your Space with <span class="accent">Factory-Direct</span> Luxury
            </h1>
            <p class="hero-subtitle">
                Experience the pinnacle of biophilic design with our ultra-premium outdoor collections, engineered for the world's most prestigious properties.
            </p>
            <div class="hero-cta-group">
                <a href="<?php echo class_exists( 'WooCommerce' ) ? esc_url( wc_get_page_permalink( 'shop' ) ) : '#'; ?>" class="btn-primary">
                    Shop Collection <span class="material-symbols-outlined" aria-hidden="true">arrow_forward</span>
                </a>
                <a href="#b2b-section" class="btn-outline">
                    Request B2B Quote
                </a>
            </div>
        </div>
        <div class="hero-image-wrapper">
            <div class="hero-image-container">
                <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuA7yFil32fSgzFV1KkbG57c2pF-3JVeFbsE5O5uqh6YnFRqm_vunm0G5PM_Wa2HCNKiXCXOigdkVwKqrxOBr9sAHepbxmTfPc1XOC5-2SXhvh328BWpRQwN59F3XtHfSQ5k_CUaieRT4fbxsCy6UmGzs_iTrj0kLUNJJRyWVhmt2hm6wbzGL0BGkqbhDglCW06DTCdexBCssBPxVUWv55iBSAgmxxN1TbmB_JcquOA89OGHmVE_l6arvfvmXisaIO0wb7rcvDyOcqM"
                     alt="<?php esc_attr_e( 'Luxury biophilic garden setup with premium outdoor furniture and lush greenery', 'luxe-landscape' ); ?>"
                     width="640" height="800"
                     loading="eager">
                <div class="hero-featured-overlay glass">
                    <div class="overlay-inner">
                        <div>
                            <p class="hero-featured-label">Featured Piece</p>
                            <p class="hero-featured-name">The Zenith Fountain</p>
                        </div>
                        <span class="hero-featured-price">$4,200</span>
                    </div>
                </div>
            </div>
            <div class="hero-glow" aria-hidden="true"></div>
        </div>
    </div>
</section>

<!-- ============================================
     BENTO BOX CATEGORY GRID
     ============================================ -->
<section class="categories-section" id="categories">
    <div class="section-header">
        <div>
            <h2 class="section-title">Explore Our World</h2>
            <p class="section-subtitle">Curated categories for professional landscaping.</p>
        </div>
        <a class="section-link" href="<?php echo class_exists( 'WooCommerce' ) ? esc_url( wc_get_page_permalink( 'shop' ) ) : '#'; ?>">
            View All Categories <span class="material-symbols-outlined" aria-hidden="true">east</span>
        </a>
    </div>
    <div class="bento-grid">
        <?php
        // Attempt to use WooCommerce product categories if available
        $categories = array();
        if ( class_exists( 'WooCommerce' ) ) {
            $cat_args = array(
                'taxonomy'   => 'product_cat',
                'orderby'    => 'count',
                'order'      => 'DESC',
                'hide_empty' => false,
                'number'     => 4,
                'exclude'    => array( get_option( 'default_product_cat' ) ),
            );
            $categories = get_terms( $cat_args );
        }

        // Define the bento grid layout with fallback data from Stitch
        $bento_cells = array(
            array(
                'class'   => 'bento-cell bento-cell-tall',
                'title'   => 'Illuminated Planters',
                'title_class' => 'bento-cell-title',
                'image'   => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBL5BL5e3uj2J57nNKmsRRixXGM2ZJApfJBvPNyWrfIrJo0C6na2_UiT2wJXJJHQMaVVDQASNoT_pN4ua0MVbBGec4xLhMrWeulVnyRDGWsSTaOpBL1HM4udj34ri6Oke3PvClyBUs-bLoBOoa3OI-Wzxzq2cALQcyDV380Y3FzqZPpddzy0JULjHqAd7txjZlZslqTvVo5jpWUs8FsBg8ZzeOgYMDjHV5Om9mu-VcjDOF6y2d3nrHcGgzzh4_3RDOahnDKxmD9ObM',
                'padding' => 'p-8',
            ),
            array(
                'class'   => 'bento-cell bento-cell-wide-top',
                'title'   => 'Modern Fountains',
                'title_class' => 'bento-cell-title large',
                'image'   => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBWOd9p3HIOcgeiH3kUrKSPsDhe6Cpv30bcP5FtHMedhTzYZdZC6QYJz5Ggxx57D45OZsA-HUTsKoM1glO-ytQBKHn2ZrAGMSjR1aGCDnC72MRXmKYUWXX-CyIx33ZjULkKYgod91RblT-PszLtoftaf85hyrdyyo__EKqWWA7IqF9VqI5GSdj4e4EXhJb0iAdX5asWpcIrFPInhnN-QRTvihYe0SJwa5SdiSP5uKO3ckUcKUCbYpADOs0ZPVC2pyVLGdglMvjWrVQ',
                'padding' => 'p-8',
            ),
            array(
                'class'   => 'bento-cell bento-cell-square',
                'title'   => 'Garden Seating',
                'title_class' => 'bento-cell-title',
                'image'   => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCbI_6W3IF5Xxb6TCIEgQcO6LDvYfbmDtle8wSdmsvYaeQj64wP8DE3pZePUOcroUUV1WR_Tqby-OC4c-5ZeA73ng_qlIOYAKKjnoXuZheG4RiqaH-tLVWWAr0gvRMNBJNB60tlmysyqalH9GYLLmw1rNChYiQuOdm0WBM1GLGDgwUL5ygBauVWFytgcoi3_1T0yCZE2znuDAY7_V0uzmE61FWHwAEiypqLIWVyVyRzcYBVNQzc_M483W9Qh0J-Qx2ukIAimtKADHs',
                'padding' => 'p-6',
            ),
            array(
                'class'   => 'bento-cell bento-cell-wide-bottom',
                'title'   => 'Stone Waterfalls',
                'title_class' => 'bento-cell-title',
                'image'   => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBYcy0t6uaatDbhDgDYh7hUhvroSbxRFIcSXIr9IvAwpVJzywDkMIuugVmRPxth5RQyhiIHF4rrb67RyOnQylcbtN4kJ8rs-ayjOWBrG8vQsIOAEcYKw6u89jXThgmvGhSFwMA0cZPfpKceTKuDKnzioziSe7FYy4GhQtwo4_KFGCrGAZZuKPQN_bzDCNQbhksx09_knfN97Hq8NsBhF5j1QsJUU_e6zMjnULiC7fDW4vzEBgGNcpmhmqpZlkXetPOcvxp4Pyj_gHY',
                'padding' => 'p-8',
            ),
        );

        foreach ( $bento_cells as $i => $cell ) :
            $title = $cell['title'];
            $image = $cell['image'];
            $link  = '#';

            // Use WooCommerce category data if available
            if ( ! empty( $categories ) && ! is_wp_error( $categories ) && isset( $categories[ $i ] ) ) {
                $cat   = $categories[ $i ];
                $title = $cat->name;
                $link  = get_term_link( $cat );

                // Use category thumbnail if set
                $thumb_id = get_term_meta( $cat->term_id, 'thumbnail_id', true );
                if ( $thumb_id ) {
                    $thumb_url = wp_get_attachment_url( $thumb_id );
                    if ( $thumb_url ) {
                        $image = $thumb_url;
                    }
                }
            }
            ?>
            <a href="<?php echo esc_url( $link ); ?>" class="<?php echo esc_attr( $cell['class'] ); ?>">
                <img src="<?php echo esc_url( $image ); ?>"
                     alt="<?php echo esc_attr( $title ); ?>"
                     loading="lazy">
                <div class="bento-cell-overlay bento-gradient" style="padding: <?php echo $cell['padding'] === 'p-6' ? '1.5rem' : '2rem'; ?>;">
                    <h3 class="<?php echo esc_attr( $cell['title_class'] ); ?>"><?php echo esc_html( $title ); ?></h3>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
</section>

<!-- ============================================
     TRENDING PRODUCTS CAROUSEL
     ============================================ -->
<section class="trending-section" id="trending">
    <div class="trending-header">
        <h2>Trending Now</h2>
        <div class="trending-nav-arrows">
            <button type="button" class="trending-nav-arrow" id="trending-prev" aria-label="<?php esc_attr_e( 'Previous products', 'luxe-landscape' ); ?>">
                <span class="material-symbols-outlined" aria-hidden="true">chevron_left</span>
            </button>
            <button type="button" class="trending-nav-arrow" id="trending-next" aria-label="<?php esc_attr_e( 'Next products', 'luxe-landscape' ); ?>">
                <span class="material-symbols-outlined" aria-hidden="true">chevron_right</span>
            </button>
        </div>
    </div>
    <div class="products-scroll-wrapper">
    <div class="products-scroll" id="products-scroll">
        <?php
        if ( class_exists( 'WooCommerce' ) ) {
            // Query WooCommerce products
            $args = array(
                'post_type'      => 'product',
                'posts_per_page' => 8,
                'post_status'    => 'publish',
                'orderby'        => 'date',
                'order'          => 'DESC',
            );

            // Try "trending" tag first, fallback to latest
            $trending_args = array_merge( $args, array(
                'tax_query' => array(
                    array(
                        'taxonomy' => 'product_tag',
                        'field'    => 'slug',
                        'terms'    => 'trending',
                    ),
                ),
            ) );

            $trending_query = new WP_Query( $trending_args );

            if ( ! $trending_query->have_posts() ) {
                $trending_query = new WP_Query( $args );
            }

            if ( $trending_query->have_posts() ) :
                while ( $trending_query->have_posts() ) :
                    $trending_query->the_post();
                    global $product;

                    if ( ! $product ) {
                        continue;
                    }

                    $image_url   = get_the_post_thumbnail_url( get_the_ID(), 'large' );
                    $is_on_sale  = $product->is_on_sale();
                    $sale_perc   = '';

                    if ( $is_on_sale && $product->get_regular_price() && $product->get_sale_price() ) {
                        $regular = floatval( $product->get_regular_price() );
                        $sale    = floatval( $product->get_sale_price() );
                        if ( $regular > 0 ) {
                            $sale_perc = round( ( ( $regular - $sale ) / $regular ) * 100 ) . '% OFF';
                        }
                    }
                    ?>
                    <div class="product-card">
                        <div class="product-card-image">
                            <?php if ( $image_url ) : ?>
                                <img src="<?php echo esc_url( $image_url ); ?>"
                                     alt="<?php echo esc_attr( get_the_title() ); ?>"
                                     loading="lazy">
                            <?php else : ?>
                                <img src="<?php echo esc_url( wc_placeholder_img_src( 'large' ) ); ?>"
                                     alt="<?php echo esc_attr( get_the_title() ); ?>"
                                     loading="lazy">
                            <?php endif; ?>

                            <?php if ( $is_on_sale && $sale_perc ) : ?>
                                <span class="product-card-badge"><?php echo esc_html( $sale_perc ); ?></span>
                            <?php endif; ?>

                            <a href="<?php echo esc_url( '?add-to-cart=' . get_the_ID() ); ?>"
                               class="product-card-add"
                               aria-label="<?php esc_attr_e( 'Add to cart', 'luxe-landscape' ); ?>"
                               data-product_id="<?php echo esc_attr( get_the_ID() ); ?>">
                                <span class="material-symbols-outlined">add</span>
                            </a>
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
                    <?php
                endwhile;
                wp_reset_postdata();
            endif;
        }

        // If WooCommerce is not active or no products found, show static fallback
        if ( ! class_exists( 'WooCommerce' ) || ! isset( $trending_query ) || ! $trending_query->have_posts() ) :
            $static_products = array(
                array(
                    'name'      => 'Lunar Sphere Planter',
                    'old_price' => '$890',
                    'new_price' => '$445',
                    'badge'     => '50% OFF',
                    'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBczq5e-n9u6tK2-lvwa6B6t4VmWGIp-TzfymPVpY_RXvqZgyH-y_hZIKlv0xgZ5YjI880zTIbwkzyDibXYQt6qYZf29deSpHJkvnfOeU43AimNr7LbgRpkircgfGJVp2jNr_d55BlCIlSd8r6sHKZzIEEBaETmBlceo-rHU-6Ucop7Dr3chlgaMKHozHCIgnSICHXq_jR9eigcv7CW_aev308IqOBETMubsFcanEHL9r1VhOs2hwY1JBrvO71hC1AYszZYIyZDurY',
                ),
                array(
                    'name'      => 'Obsidian Totem',
                    'old_price' => '',
                    'new_price' => '$1,250',
                    'badge'     => '',
                    'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuD-V8j-NiTz_Tz9n-ZuadKlU52YSM9nZkFQ8HLI86Y5WUJyXiLzW2KTrwXb5xc2VcwdwuRTr3Rx3HcKj08JIMbkJ1qDNuxwAp8T0Hb4mVQ5K0G5wCfDSbEMwQC3P_6Q2vd7KgjWTVg7NxeFCPsDGNlvIulD2qnhMQRDf3dWvjmN9fUjU5Rv65H3QgYlTpMONOKBqfAVn9n9_T_U7EjyBPJKuCJEb6o2hM8_cTnREDBXRhBQ3f8v_dMbKQaRVbWqfIIWjSQMfRmc',
                ),
                array(
                    'name'      => 'Magma Fire Bowl',
                    'old_price' => '$2,100',
                    'new_price' => '$1,680',
                    'badge'     => '20% OFF',
                    'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBDtJ9NZaYcQaI3_OWO_bYaOHPgJyT8V1JvkWPEqopZOYpSJfvjq1lWAKDLNPFx-qKIaZY-wQ4kGGq2M89PH31aiqBLPFr7gLqQjI1OaELjJu9NqftpHNHUkXwZdkmTJPZ8GX9WVkDghQ6MQsM2e64CuHwZTmKJYNs2vwn8A9R_3xnfgqXjz8nGAVBhJieLkiW-YLOVLGJULWLvdLPQUUH_3wh0wL-XjSTJ9xc2AMfF_NU7qHNKPaSCCRqNdIbG3LWyFNhCdgxWk',
                ),
                array(
                    'name'      => 'Alabaster Abstract',
                    'old_price' => '',
                    'new_price' => '$3,400',
                    'badge'     => '',
                    'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAkGZmZeB7_wdyqJjHalfhxnL5FJqRBz5k1VqhA2pU2SvIfkdlp3lT5JTjYXOEcrU1Lx3RMVZ2PWKB29YVCWw43dZqI3pj_31Hrc5pU95HhvIjGmZo7mJw2OHiMRbTAGl-vsMi21AYCaEOSgaJnIxS7vBhU0pZJTI_1vCmk3uXiDAYYMBdnJKLmYCk1M-r9EBLJixGX8QjsHnPGa_gQxNEFtILHn4xJF-nB5_WJjmcMylHq1TuCBVhz2s50lxlpEAjCpOzuKLptZU',
                ),
            );

            foreach ( $static_products as $sp ) : ?>
                <div class="product-card">
                    <div class="product-card-image">
                        <img src="<?php echo esc_url( $sp['image'] ); ?>"
                             alt="<?php echo esc_attr( $sp['name'] ); ?>"
                             loading="lazy">
                        <?php if ( ! empty( $sp['badge'] ) ) : ?>
                            <span class="product-card-badge"><?php echo esc_html( $sp['badge'] ); ?></span>
                        <?php endif; ?>
                        <button class="product-card-add" aria-label="<?php esc_attr_e( 'Add to cart', 'luxe-landscape' ); ?>">
                            <span class="material-symbols-outlined">add</span>
                        </button>
                    </div>
                    <h4 class="product-card-title"><?php echo esc_html( $sp['name'] ); ?></h4>
                    <div class="product-card-prices">
                        <?php if ( ! empty( $sp['old_price'] ) ) : ?>
                            <span class="product-card-price-old"><?php echo esc_html( $sp['old_price'] ); ?></span>
                            <span class="product-card-price-current"><?php echo esc_html( $sp['new_price'] ); ?></span>
                        <?php else : ?>
                            <span class="product-card-price-regular"><?php echo esc_html( $sp['new_price'] ); ?></span>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach;
        endif;
        ?>
    </div>
    </div><!-- .products-scroll-wrapper -->
</section>

<!-- ============================================
     B2B / WHOLESALE SECTION
     ============================================ -->
<section class="b2b-section" id="b2b-section">
    <div class="b2b-card">
        <div class="b2b-content">
            <span class="b2b-label">B2B &amp; Projects</span>
            <h2 class="b2b-title">Building a Mega Project? Get Direct Factory Pricing.</h2>
            <p class="b2b-desc">We partner with architects, real estate developers, and hospitality giants to provide bespoke landscaping solutions at scale.</p>
            <div class="b2b-stats">
                <div>
                    <span class="b2b-stat-value">500+</span>
                    <span class="b2b-stat-label">Hotel Projects</span>
                </div>
                <div class="b2b-stat-divider" aria-hidden="true"></div>
                <div>
                    <span class="b2b-stat-value">15yr</span>
                    <span class="b2b-stat-label">Contract Life</span>
                </div>
            </div>
        </div>
        <div class="b2b-form-wrapper">
            <form class="b2b-form" action="#" method="post">
                <div class="b2b-form-row">
                    <input type="text" name="full_name" placeholder="Full Name" required>
                    <input type="text" name="project_size" placeholder="Project Size (sqm)">
                </div>
                <input type="tel" name="phone" placeholder="Phone Number">
                <textarea name="project_details" rows="3" placeholder="Tell us about your project"></textarea>
                <button type="submit" class="b2b-form-submit">Request Project Quote</button>
            </form>
        </div>
    </div>
</section>

<?php get_footer(); ?>
