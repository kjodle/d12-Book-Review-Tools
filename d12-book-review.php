<?php
/*
Plugin Name: d12 Book Review Tools
Plugin URI:  https://github.com/kjodle/d12-Book-Review-Tools
Description: Adds several useful shortcodes for writing book reviews on WordPress
Version:     1.0
Author:      Kenneth John Odle
Author URI:  http://techblog.kjodle.net
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Domain Path: /lang
Text Domain: d12brt
*/

function d12brt_scripts() {
	wp_register_style( 'd12brt-styles',  plugin_dir_url( __FILE__ ) . 'd12brt-style.css' );
	wp_enqueue_style( 'd12brt-styles' );
}
add_action( 'wp_enqueue_scripts', 'd12brt_scripts' );

function spoiler_shortcode_handler() {
	$spoiler = __( 'Warning: The rest of this post contains spoilers.' , 'd12brt' );
	echo '<div><p id="spoiler_notice"><img id="d12brtspoil" src="' . plugin_dir_url( __FILE__ ) . 'images/pause.png" alt="pause button" />' . 
	$spoiler . 
	'</p></div><div style="clear:both;"></div>';
}
add_shortcode( 'spoiler', 'spoiler_shortcode_handler' );

function ebook_shortcode_handler() {
	$ebook = __( 'This review is based on the ebook version of this title. Page numbers are not available.' , 'd12brt' );
	echo '<div><p id="ebook_notice"><img id="d12brtebook" src="' . plugin_dir_url( __FILE__ ) . 'images/ebook.png" alt="ebook button" />' .
	$ebook . 
	'</p></div><div style="clear:both;"></div>';
}
add_shortcode( 'ebook', 'ebook_shortcode_handler' );
