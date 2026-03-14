<?php
/**
 * Theme Header
 *
 * Floating glassmorphism navigation bar.
 *
 * @package Luxe_Landscape
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class( 'bg-background-light font-display antialiased' ); ?>>
<?php wp_body_open(); ?>

<!-- Floating Glassmorphism Header -->
<nav class="site-header-nav" id="site-header" role="navigation" aria-label="<?php esc_attr_e( 'Primary Navigation', 'luxe-landscape' ); ?>">
    <div class="glass site-header-inner">
        <div class="header-left">
            <a class="site-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                <span class="material-symbols-outlined" aria-hidden="true">filter_vintage</span>
                <span class="site-logo-text">LUXE <span class="highlight">LANDSCAPE</span></span>
            </a>
            <div class="primary-nav">
                <?php
                if ( has_nav_menu( 'primary' ) ) {
                    wp_nav_menu( array(
                        'theme_location' => 'primary',
                        'container'      => false,
                        'items_wrap'     => '<ul>%3$s</ul>',
                        'walker'         => new Luxe_Landscape_Nav_Walker(),
                        'depth'          => 1,
                    ) );
                } else {
                    // Fallback navigation matching Stitch design
                    ?>
                    <ul>
                        <li><a class="text-sm font-semibold hover:text-primary transition-colors" href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a></li>
                        <li><a class="text-sm font-semibold hover:text-primary transition-colors" href="<?php echo class_exists( 'WooCommerce' ) ? esc_url( wc_get_page_permalink( 'shop' ) ) : '#'; ?>">Collections</a></li>
                        <li><a class="text-sm font-semibold hover:text-primary transition-colors" href="#">Wholesale</a></li>
                        <li><a class="text-sm font-semibold hover:text-primary transition-colors" href="#">Projects</a></li>
                    </ul>
                    <?php
                }
                ?>
            </div>
        </div>
        <div class="header-actions">
            <button type="button" aria-label="<?php esc_attr_e( 'Search', 'luxe-landscape' ); ?>">
                <span class="material-symbols-outlined">search</span>
            </button>
            <?php if ( class_exists( 'WooCommerce' ) ) : ?>
                <a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" aria-label="<?php esc_attr_e( 'My Account', 'luxe-landscape' ); ?>">
                    <span class="material-symbols-outlined">person</span>
                </a>
                <div class="cart-icon-wrapper">
                    <a href="<?php echo esc_url( wc_get_cart_url() ); ?>" aria-label="<?php esc_attr_e( 'Shopping Cart', 'luxe-landscape' ); ?>">
                        <span class="material-symbols-outlined">shopping_bag</span>
                    </a>
                    <span class="cart-count" id="luxe-cart-count"><?php echo esc_html( WC()->cart->get_cart_contents_count() ); ?></span>
                </div>
            <?php else : ?>
                <button type="button" aria-label="<?php esc_attr_e( 'Account', 'luxe-landscape' ); ?>">
                    <span class="material-symbols-outlined">person</span>
                </button>
                <div class="cart-icon-wrapper">
                    <button type="button" aria-label="<?php esc_attr_e( 'Cart', 'luxe-landscape' ); ?>">
                        <span class="material-symbols-outlined">shopping_bag</span>
                    </button>
                    <span class="cart-count">0</span>
                </div>
            <?php endif; ?>

            <!-- Mobile Menu Toggle -->
            <button class="mobile-menu-toggle" type="button" id="mobile-menu-open" aria-label="<?php esc_attr_e( 'Open Menu', 'luxe-landscape' ); ?>">
                <span class="material-symbols-outlined">menu</span>
            </button>
        </div>
    </div>
</nav>

<!-- Mobile Navigation Overlay -->
<div class="mobile-nav" id="mobile-nav">
    <button class="mobile-nav-close" type="button" id="mobile-menu-close" aria-label="<?php esc_attr_e( 'Close Menu', 'luxe-landscape' ); ?>">
        <span class="material-symbols-outlined">close</span>
    </button>
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a>
    <?php if ( class_exists( 'WooCommerce' ) ) : ?>
        <a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>">Collections</a>
    <?php else : ?>
        <a href="#">Collections</a>
    <?php endif; ?>
    <a href="#">Wholesale</a>
    <a href="#">Projects</a>
</div>
