<?php
/*
Plugin Name: Acme Fix Images
Plugin URI: http://www.acmethemes.com/acme-fix-images/
Description: Fix image sizes after you have changed image sizes from Media Settings.
Version: 1.0.0
Author: Acme Themes
Author URI: http://www.acmethemes.com/
License: GPL
Copyright: Acme Themes
*/

/*Make sure we don't expose any info if called directly*/
if ( !function_exists( 'add_action' ) ) {
    echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
    exit;
}

/*general functions*/
require_once trailingslashit( plugin_dir_path( __FILE__ ) ) . 'inc/functions.php';

/*ajax functions*/
require_once trailingslashit( plugin_dir_path( __FILE__ ) ) . 'inc/hooks/fix-image-ajax.php';

/*Setting admin menu*/
require_once trailingslashit( plugin_dir_path( __FILE__ ) ) . 'inc/acme-admin-menu.php';

/*allow crop*/
// Thumbnail Size Thumbnail
if( false === get_option("thumbnail_crop")) {
    add_option("thumbnail_crop", "1"); }
else {
    update_option("thumbnail_crop", "1");
}

// Medium Size Thumbnail
if( false === get_option("medium_crop")) {
    add_option("medium_crop", "1"); }
else {
    update_option("medium_crop", "1");
}

// Large Size Thumbnail
if( false === get_option("large_crop")) {
    add_option("large_crop", "1"); }
else {
    update_option("large_crop", "1");
}