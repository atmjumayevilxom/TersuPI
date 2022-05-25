<?php
/*adding theme options panel*/
$wp_customize->add_panel( 'education-base-wc-panel', array(
	'priority'       => 100,
	'capability'     => 'edit_theme_options',
	'title'          => esc_html__( 'WooCommerce Options', 'education-base' )
) );

/*
* file for shop archive
*/
require_once education_base_file_directory('acmethemes/customizer/wc-options/shop-archive.php');

/*
* file for single product
*/
require_once education_base_file_directory('acmethemes/customizer/wc-options/single-product.php');