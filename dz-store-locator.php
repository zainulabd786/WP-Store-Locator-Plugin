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
	if(!isset($_GET['page']) || $_GET['page'] !== "dz_store_locations") return;

	wp_register_style( 'dz_bootstrap-css', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css' );
	wp_register_style( 'dz_dataTables-css', '//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css' );

	wp_register_script("dz_jquery", "https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js", array(), "", true);
	wp_register_script("dz_datatables-js", "//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js", array("dz_jquery"), "", true);
	    
	wp_register_script("dz_custom-js", plugins_url("js/custom.js", __FILE__ ), array("dz_jquery"), "", true);

    
	wp_enqueue_style( 'dz_bootstrap-css' );
	wp_enqueue_style( 'dz_dataTables-css' );

    wp_enqueue_script("dz_jquery");
    wp_enqueue_script("dz_datatables-js");
    wp_enqueue_script("dz_custom-js");
}

/*__________________Admin Menu___________________________*/
add_action('admin_menu', 'dz_menu_page');
function dz_menu_page(){
	add_menu_page('Manage Store Locations', 'Manage Locations', 'manage_options', 'dz_store_locations', 'dz_admin_markup' );
}
function dz_admin_markup(){
	include plugin_dir_path( __FILE__ )."inc/dz_admin_markup.php";
}
/*__________________Admin Menu end___________________________*/