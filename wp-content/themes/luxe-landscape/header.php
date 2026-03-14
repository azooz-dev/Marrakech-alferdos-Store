<?php
/**
 * Header template redirector
 *
 * WordPress requires header.php in root for get_header() calls.
 * Actual header is in layout/header.php.
 *
 * @package Luxe_Landscape
 */

require get_template_directory() . '/layout/header.php';
