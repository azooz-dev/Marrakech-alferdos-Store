<?php

/**
 * WooCommerce Shop Archive Template
 *
 * @package Luxe_Landscape
 */

if (! defined('ABSPATH')) {
	exit;
}

luxe_landscape_get_header();
load_template(get_template_directory() . '/layout/products-layout.php');
luxe_landscape_get_footer();
