<?php
/*
Plugin Name: Dazzle Store Locator
Plugin URI: https://edensolutions.co.in/
Description: A simple wordpress plugin that lets your manage your store locations so that you clients can easily locate you.
Version: 1.0
Author: Eden Solutions Team
Author URI: https://edensolutions.co.in
License: GPLv2 or later
Text Domain: dzStoreLocator
*/

add_action( 'admin_enqueue_scripts', 'dz_admin_scripts' );
function dz_admin_scripts(){
	if(!isset($_GET['page']) || ($_GET['page'] !== "dz_store_locations" && $_GET['page'] !== "dz_add_store_locations")) return;


	wp_register_style( 'dz_bootstrap-css', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css' );
	wp_register_style( 'dz_dataTables-css', '//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css' );

	wp_register_style( 'dz_custom-css', plugins_url("css/custom.css", __FILE__ ) );

	wp_register_script("dz_jquery", "https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js", array(), "", true);
	wp_register_script("dz_datatables-js", "//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js", array("dz_jquery"), "", true);
	    
	wp_register_script("dz_custom-js", plugins_url("js/custom.js", __FILE__ ), array("dz_jquery"), "", true);

    
	wp_enqueue_style( 'dz_bootstrap-css' );
	wp_enqueue_style( 'dz_dataTables-css' );
	wp_enqueue_style( 'dz_custom-css' );

    wp_enqueue_script("dz_jquery");
    wp_enqueue_script("dz_datatables-js");
    wp_enqueue_script("dz_custom-js");
}

/*__________________Admin Menu___________________________*/
add_action('admin_menu', 'dz_menu_page');
function dz_menu_page(){
	add_menu_page('Manage Store Locations', 'Manage Locations', 'manage_options', 'dz_store_locations', 'dz_admin_markup' );

	add_submenu_page('dz_store_locations', 'Add Location', 'Add Locations', 'manage_options', 'dz_add_store_locations', 'dz_admin_markup' );
}
function dz_admin_markup(){
	switch ($_GET['page']) {
		case 'dz_store_locations':
			$markup_path = plugin_dir_path( __FILE__ )."inc/dz_store_locations.php";
		break;
		
		case 'dz_add_store_locations':
			$markup_path = plugin_dir_path( __FILE__ )."inc/dz_add_store_locations.php";
		break;
	}
	include $markup_path;
}
/*__________________Admin Menu end___________________________*/



add_action("admin_post_dz_store_location_form", "dz_store_location_form");
function dz_store_location_form(){
	if(!current_user_can('edit_theme_options')) wp_die('You are not allowed to be on this page');
	check_admin_referer("dz_store_location_form_verify");

	global $wpdb;

	$table_name = $wpdb->prefix . "dz_stores";

	$data = array(
		'dz_dealer' => !empty($_POST['dz_dealer']) ? $_POST['dz_dealer'] : "",
		'dz_dealer_name' => !empty($_POST['dz_dealer_name']) ? $_POST['dz_dealer_name'] : "",
		'dz_address' => !empty($_POST['dz_address']) ? $_POST['dz_address'] : "",
		'dz_city' => !empty($_POST['dz_city']) ? $_POST['dz_city'] : "",
		'dz_state' => !empty($_POST['dz_state']) ? $_POST['dz_state'] : "",
		'dz_pin' => !empty($_POST['dz_pin']) ? $_POST['dz_pin'] : "",
		'dz_mobile' => !empty($_POST['dz_mobile']) ? $_POST['dz_mobile'] : "",
		'dz_email' => !empty($_POST['dz_email']) ? $_POST['dz_email'] : "",
		'dz_reg_no' => !empty($_POST['dz_reg_no']) ? $_POST['dz_reg_no'] : "",dz_reg_no
	);

	$wpdb->insert($table_name, $data) ? $status = 1 : $status = 0;

	wp_redirect(admin_url('admin.php?page=dz_add_store_locations&status=$status'));
}

function dz_activation(){
	global $wpdb;

	$table_name = $wpdb->prefix . "dz_stores";

	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE $table_name (
	  	`id` mediumint(9) NOT NULL AUTO_INCREMENT,
	  	`dz_dealer` varchar,
	  	`dz_dealer_name` varchar,
	  	`dz_address` varchar,
	  	`dz_city` varchar,
	  	`dz_state` varchar,
	  	`dz_pin` varchar,
	  	`dz_mobile` varchar,
	  	`dz_email` varchar,
	  	`dz_reg_no` varchar,
	  	PRIMARY KEY  (id)
	) $charset_collate;";

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );
}