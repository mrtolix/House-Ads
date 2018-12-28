<?php
// Add ACF to plugin
if(!function_exists( 'hAds_lib_acf_settings_path' )) {
	add_filter('acf/settings/path', 'hAds_lib_acf_settings_path');

	function hAds_lib_acf_settings_path( $path ) {

		// update path
		$path = plugin_dir_path(__FILE__) . '/lib/acf/';

		// return
		return $path;
	}	
}

if(!function_exists( 'hAds_lib_acf_settings_dir' )) {
	add_filter('acf/settings/dir', 'hAds_lib_acf_settings_dir');
	function hAds_lib_acf_settings_dir( $dir ) {
		$dir = plugins_url('/acf/',__FILE__);
		return $dir;
	}
}
// Do not show ACF in backend of WordPress if ACF doesn't exist
if( !function_exists('is_plugin_active') ) {
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
}
if(is_plugin_active('advanced-custom-fields/acf.php')){	
	add_filter('acf/settings/show_admin', '__return_true');
} elseif(is_plugin_active('advanced-custom-fields-pro/acf.php')){	
	add_filter('acf/settings/show_admin', '__return_true');
} else {
	add_filter('acf/settings/show_admin', '__return_false');
}
// Include ACF to own plugin
include_once( plugin_dir_path( __FILE__ ) . 'acf/acf.php' );