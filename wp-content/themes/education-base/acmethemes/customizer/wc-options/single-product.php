<?php
/*adding sections for sidebar options */
$wp_customize->add_section( 'education-base-wc-single-product-options', array(
	'priority'       => 20,
	'capability'     => 'edit_theme_options',
	'title'          => esc_html__( 'Single Product', 'education-base' ),
	'panel'          => 'education-base-wc-panel'
) );

/*Sidebar Layout*/
$wp_customize->add_setting( 'education_base_theme_options[education-base-wc-single-product-sidebar-layout]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['education-base-wc-single-product-sidebar-layout'],
	'sanitize_callback' => 'education_base_sanitize_select'
) );
$choices = education_base_sidebar_layout();
$wp_customize->add_control( 'education_base_theme_options[education-base-wc-single-product-sidebar-layout]', array(
	'choices'  	=> $choices,
	'label'		=> esc_html__( 'Single Product Sidebar Layout', 'education-base' ),
	'section'   => 'education-base-wc-single-product-options',
	'settings'  => 'education_base_theme_options[education-base-wc-single-product-sidebar-layout]',
	'type'	  	=> 'select'
) );