<?php
/*
  Plugin Name: ZWoom - WooCommerce Product Image Zoom
  Plugin URI:  http://wordpress.org/extend/plugins/zwoom-woocommerce-product-image-zoom-extension-by-wisdmlabs/
  Description: Woocommerce Zoom Product image extension allows users to zoom product image on hover.
  Author: WisdmLabs, Thane, India
  Author URI:http://wisdmlabs.com
  License: GPLv2 or later
  Version: 1.1.2
  Network: true
 */
/**
 * The plugin methods will not be changed until a new release of wordpress.
 * @api
 * @author WisdmLabs, Thane, India
 * @copyright 2012-2013 WisdmLabs
 * @license GPL
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */
add_action('woocommerce_after_single_product', 'enqueuezoomscript');

add_action('wp_ajax_get_ids_of_all_attachments', 'get_ids_of_all_attachments_callback');
add_action('wp_ajax_nopriv_get_ids_of_all_attachments', 'get_ids_of_all_attachments_callback');
add_filter('woocommerce_catalog_settings' , 'wisdm_add_new_setting', 10, 1);
add_filter('plugin_action_links', 'wisdm_zoom_plugin_action_links', 10, 2);
add_action('admin_menu', 'wisdm_add_new_submenu_page');

include_once('functions.php');