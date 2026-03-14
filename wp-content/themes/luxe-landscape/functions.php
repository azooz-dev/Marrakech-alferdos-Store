<?php
/**
 * Luxe Landscape Theme Functions
 *
 * @package Luxe_Landscape
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

define( 'LUXE_LANDSCAPE_VERSION', '1.0.0' );
define( 'LUXE_LANDSCAPE_DIR', get_template_directory() );
define( 'LUXE_LANDSCAPE_URI', get_template_directory_uri() );

/**
 * Theme Setup
 */
function luxe_landscape_setup() {
    // Let WordPress manage the document title
    add_theme_support( 'title-tag' );

    // Enable featured images
    add_theme_support( 'post-thumbnails' );

    // Custom logo
    add_theme_support( 'custom-logo', array(
        'height'      => 60,
        'width'       => 200,
        'flex-height' => true,
        'flex-width'  => true,
    ) );

    // HTML5 markup
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ) );

    // WooCommerce Support
    add_theme_support( 'woocommerce' );
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );

    // Register Navigation Menus
    register_nav_menus( array(
        'primary'            => __( 'Primary Menu', 'luxe-landscape' ),
        'footer-collections' => __( 'Footer Collections', 'luxe-landscape' ),
        'footer-support'     => __( 'Footer Support', 'luxe-landscape' ),
    ) );

    // Content width
    if ( ! isset( $content_width ) ) {
        $content_width = 1280;
    }
}
add_action( 'after_setup_theme', 'luxe_landscape_setup' );

/**
 * Enqueue Styles and Scripts
 */
function luxe_landscape_scripts() {
    // Google Fonts - Space Grotesk
    wp_enqueue_style(
        'luxe-landscape-google-fonts',
        'https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&display=swap',
        array(),
        null
    );

    // Material Symbols Outlined
    wp_enqueue_style(
        'luxe-landscape-material-symbols',
        'https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap',
        array(),
        null
    );

    // Main Stylesheet
    wp_enqueue_style(
        'luxe-landscape-style',
        get_stylesheet_uri(),
        array( 'luxe-landscape-google-fonts', 'luxe-landscape-material-symbols' ),
        filemtime( get_stylesheet_directory() . '/style.css' )
    );

    // Main JavaScript
    wp_enqueue_script(
        'luxe-landscape-main',
        LUXE_LANDSCAPE_URI . '/assets/js/main.js',
        array(),
        filemtime( LUXE_LANDSCAPE_DIR . '/assets/js/main.js' ),
        true
    );

    // Pass WooCommerce AJAX URL if WooCommerce is active
    if ( class_exists( 'WooCommerce' ) ) {
        wp_localize_script( 'luxe-landscape-main', 'luxeLandscape', array(
            'ajaxUrl'  => admin_url( 'admin-ajax.php' ),
            'cartUrl'  => wc_get_cart_url(),
            'shopUrl'  => wc_get_page_permalink( 'shop' ),
        ) );
    }
}
add_action( 'wp_enqueue_scripts', 'luxe_landscape_scripts' );

/**
 * Register Widget Areas
 */
function luxe_landscape_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Footer Newsletter', 'luxe-landscape' ),
        'id'            => 'footer-newsletter',
        'description'   => __( 'Footer newsletter signup area.', 'luxe-landscape' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );
}
add_action( 'widgets_init', 'luxe_landscape_widgets_init' );

/**
 * Custom Walker for Primary Navigation
 */
class Luxe_Landscape_Nav_Walker extends Walker_Nav_Menu {
    public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        $output .= '<li>';
        $atts = array(
            'href'  => ! empty( $item->url ) ? $item->url : '',
            'class' => 'text-sm font-semibold hover:text-primary transition-colors',
        );

        if ( $item->current ) {
            $atts['class'] .= ' text-primary';
        }

        $attributes = '';
        foreach ( $atts as $attr => $value ) {
            if ( ! empty( $value ) ) {
                $attributes .= ' ' . $attr . '="' . esc_attr( $value ) . '"';
            }
        }

        $output .= '<a' . $attributes . '>';
        $output .= esc_html( $item->title );
        $output .= '</a>';
    }
}

/**
 * WooCommerce Cart Fragments for AJAX cart count
 */
function luxe_landscape_cart_count_fragment( $fragments ) {
    ob_start();
    ?>
    <span class="cart-count" id="luxe-cart-count"><?php echo esc_html( WC()->cart->get_cart_contents_count() ); ?></span>
    <?php
    $fragments['.cart-count'] = ob_get_clean();
    return $fragments;
}
if ( class_exists( 'WooCommerce' ) ) {
    add_filter( 'woocommerce_add_to_cart_fragments', 'luxe_landscape_cart_count_fragment' );
}

/**
 * Remove default WooCommerce wrapper
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

function luxe_landscape_wc_wrapper_start() {
    echo '<main class="wc-main-content">';
}

function luxe_landscape_wc_wrapper_end() {
    echo '</main>';
}

add_action( 'woocommerce_before_main_content', 'luxe_landscape_wc_wrapper_start', 10 );
add_action( 'woocommerce_after_main_content', 'luxe_landscape_wc_wrapper_end', 10 );

/**
 * Remove default WooCommerce sidebar
 */
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

/**
 * Customize products per row and per page
 */
add_filter( 'loop_shop_columns', function() {
    return 4;
} );

add_filter( 'loop_shop_per_page', function() {
    return 12;
} );
