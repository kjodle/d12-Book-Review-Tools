<?php
/*
Plugin Name: d12 Book Review Tools
Plugin URI:  https://github.com/kjodle/d12-Book-Review-Tools
Description: Adds several useful shortcodes for writing book reviews on WordPress
Version:     1.2
Author:      Kenneth John Odle
Author URI:  http://techblog.kjodle.net
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Domain Path: /lang
Text Domain: d12brt
*/

// Let's add our front end stylesheets:
function d12brt_scripts() {
	wp_register_style( 'd12brt-styles',  plugin_dir_url( __FILE__ ) . '/css/d12brt-style.css' );
	wp_enqueue_style( 'd12brt-styles' );
}
add_action( 'wp_enqueue_scripts', 'd12brt_scripts' );

// Let's add our back end stylesheets:
function d12br_admin_styles() {
	wp_enqueue_style( 'd12bradminstyle', plugins_url( '/css/d12brt-admin-style.css', __FILE__, '1.0', 'screen' ) );
}
add_action( 'admin_enqueue_scripts', 'd12br_admin_styles' );

// Add our "Spoiler" shortcode:
function spoiler_shortcode_handler() {
	$spoiler = __( 'Warning: The rest of this post contains spoilers.' , 'd12brt' );
	echo '<div class="dbr"><div class="dbr_icon"><img src="' . plugin_dir_url( __FILE__ ) . 'images/pause.png" alt="pause button" /></div>' . 
	'<div class="dbr_message">' . $spoiler . '</div>' . 
	'<div style="clear:both;"></div></div>';
}
add_shortcode( 'spoiler', 'spoiler_shortcode_handler' );

// Add our "eBook" shortcode:
function ebook_shortcode_handler() {
	$ebook = __( 'This review is based on the ebook version of this title. Page numbers are not available.' , 'd12brt' );
	echo '<div class="dbr"><div class="dbr_icon"><img src="' . plugin_dir_url( __FILE__ ) . 'images/ebook.png" alt="ebook button" /></div>' .
	'<div class="dbr_message">' . $ebook . '</div>' . 
	'<div style="clear:both;"></div></div>';
}
add_shortcode( 'ebook', 'ebook_shortcode_handler' );

// Include our update script to update from private repo
require 'update/puc.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'http://api.kjodle.net/?action=get_metadata&slug=d12-book-review-tools',
	__FILE__,
	'atticus-finch'
);

/* Register a TinyMCE button */
add_action( 'init', 'd12_book_review_buttons' );
function d12_book_review_buttons() {
	if ( current_user_can('edit_posts') && current_user_can('edit_pages') )
	{
		add_filter( "mce_external_plugins", "d12_br_add_buttons" );
		add_filter( 'mce_buttons_2', 'd12_br_register_buttons' );
	}
}
function d12_br_add_buttons( $plugin_array ) {
	$plugin_array['d12_br'] = plugins_url( 'js/d12_br.js', __FILE__ );
	return $plugin_array;
}
function d12_br_register_buttons( $buttons ) {
	array_push( $buttons, 'd12-br-button' );
	return $buttons;
}
