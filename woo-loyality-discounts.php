<?php
/**
* Plugin Name: Loyalty Discounts for WooCommerce
* Plugin URI: https://www.elliotvs.co.uk/plugins/woo-loyalty-discounts
* Description: Apply WooCommerce "loyalty" style discounts to a customers checkout, based specific rules and criteria that needs to be met by the user.
* Version: 1.2.0
* Author: RelyWP
* Author URI: http://www.relywp.com
* License: GPL12
*
* WC requires at least: 3.4
* WC tested up to: 7.6.0
*/

// Include files
include( plugin_dir_path( __FILE__ ) . 'admin/admin-options.php');
include( plugin_dir_path( __FILE__ ) . 'admin/register-settings.php');
//Apply discount functionality

// if woocommerce installed
if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
	include( plugin_dir_path( __FILE__ ) . 'inc/add_discount_total_spent.php');
	include( plugin_dir_path( __FILE__ ) . 'inc/add_discount_total_cart.php');
	include( plugin_dir_path( __FILE__ ) . 'inc/add_discount_total_items_ordered.php');
	include( plugin_dir_path( __FILE__ ) . 'inc/functions.php');
	include( plugin_dir_path( __FILE__ ) . 'wld-shortcode.php');
}

// Enqueue admin styles
function wld_admin_script_enqueue() {
	wp_enqueue_script('wld-admin-js', plugins_url('/js/admin-scripts.js', __FILE__), '', '1.0', true);
	wp_enqueue_style('wld-admin-css', plugins_url('/css/admin-styles.css', __FILE__), array(), '1.0');
}
add_action('admin_enqueue_scripts', 'wld_admin_script_enqueue');

// Enqueue front-end styles
function wld_front_end_script_enqueue() {
	wp_enqueue_style('wld-front-end-css', plugins_url('/css/styles.css', __FILE__), array(), '1.0');
}
add_action('wp_enqueue_scripts', 'wld_front_end_script_enqueue');

// Plugin Settings Link
add_filter( 'plugin_action_links', 'wld_add_settings_action_plugin', 10, 5 );
function wld_add_settings_action_plugin( $actions, $plugin_file ) 
{
	static $plugin;

	if (!isset($plugin))
		$plugin = plugin_basename(__FILE__);
	if ($plugin == $plugin_file) {
			$settings = array('settings' => '<a href="options-general.php?page=woo_loyalty_discounts">' . __('Settings', 'General') . '</a>');
    		$actions = array_merge($settings, $actions);
	}
		
	return $actions;
}

// Redirect on Activate
function wld_activation_redirect( $plugin ) {
    if( $plugin == plugin_basename( __FILE__ ) ) {
        exit( wp_redirect( admin_url( 'options-general.php?page=woo_loyalty_discounts' ) ) );
    }
}
add_action( 'activated_plugin', 'wld_activation_redirect' );