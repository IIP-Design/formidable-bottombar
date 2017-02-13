<?php
/*
Plugin Name: Formidable Bottombar
Description: Uses a shortcode to show an email sign up form along the bottom of a page
Version: 0.0.1
Plugin URI: http://formidablepro.com/
Author URI: https://github.com/sc0ttius
Author: Scott Gustas
*/

function frmbottombar_autoloader( $class_name ) {

	// Only load Frm classes here
	if ( ! preg_match( '/^FormidableBottombar.+$/', $class_name ) ) {
		return;
	}

	$path = dirname( __FILE__ ) . '/classes/' . $class_name .'.php';
	if ( file_exists( $path ) ) {
		include( $path );
	}
}

// Add the autoloader
spl_autoload_register('frmbottombar_autoloader');

// Load hooks
new FormidableBottombarApp();
