<?php
/**
 * Plugin Name: House Ads
 * Plugin URI: https://github.com/mrtolix/house-ads
 * Description: Plugin to show in house ads on your post or page by shortcode
 * Version: 1.0.0
 * Author: Jose Atencio
 *
 * @package house-ads
 */

//Add admin script
function hAds_add_admin_script( $hook ) {

    global $post;

    if ( $hook == 'post-new.php' || $hook == 'post.php' ) {
        if ( 'house_ads' === $post->post_type ) {     
            wp_enqueue_script(  'hAds_admin_script', plugins_url( 'admin/js/admin.js', __FILE__ ), array('jquery') );
		    wp_register_style( 'hAds_admin_style', plugins_url( 'admin/css/admin.css', __FILE__ ) );
		    wp_enqueue_style( 'hAds_admin_style' );              
        }        
    }
}
add_action( 'admin_enqueue_scripts', 'hAds_add_admin_script', 10, 1 );


// Register style sheet.
add_action( 'wp_enqueue_scripts', 'hAds_plugin_styles' );
function hAds_plugin_styles() {
	wp_register_style( 'hAds_front_style', plugins_url( 'public/css/style.css', __FILE__ ) );
	wp_enqueue_style( 'hAds_front_style' );
}
require_once( dirname( __FILE__ ) . '/lib/inc.php' );
// Custom post
require_once( dirname( __FILE__ ) . '/core/custom_post.php' );
// Shortcode
require_once( dirname( __FILE__ ) . '/core/Shortcode.php' );