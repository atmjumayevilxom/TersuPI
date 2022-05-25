<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Educenter
 */

?>
<!doctype html>
<html <?php language_attributes(); ?> <?php educenter_html_tag_schema(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php
if ( function_exists( 'wp_body_open' ) ) {
    wp_body_open();
} else {
    do_action( 'wp_body_open' );
}
?>
<div id="page" class="site">

	<?php
		/**
		 * @see  educenter_skip_links() - 5
		*/	
		do_action( 'educenter_header_before' ); 
	
		/**
		 * @see  educenter_top_header() - 15
		 *
		 * @see  educenter_main_header() - 20
		*/
		do_action( 'educenter_header' ); 
	
	 	do_action( 'educenter_header_after' ); 
	?>

	<div id="content" class="site-content content">
