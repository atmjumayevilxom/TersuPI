<?php
/*adding sections for sidebar options */
$wp_customize->add_section( 'education-base-wc-shop-archive-option', array(
	'priority'       => 20,
	'capability'     => 'edit_theme_options',
	'title'          => esc_html__( 'Shop Archive Sidebar Layout', 'education-base' ),
	'panel'          => 'education-base-wc-panel'
) );

/*Sidebar Layout*/
$wp_customize->add_setting( 'education_base_theme_options[education-base-wc-shop-archive-sidebar-layout]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['education-base-wc-shop-archive-sidebar-layout'],
	'sanitize_callback' => 'education_base_sanitize_select'
) );
$choices = education_base_sidebar_layout();
$wp_customize->add_control( 'education_base_theme_options[education-base-wc-shop-archive-sidebar-layout]', array(
	'choices'  	=> $choices,
	'label'		=> esc_html__( 'Shop Archive Sidebar Layout', 'education-base' ),
	'section'   => 'education-base-wc-shop-archive-option',
	'settings'  => 'education_base_theme_options[education-base-wc-shop-archive-sidebar-layout]',
	'type'	  	=> 'select'
) );

/*wc-product-column-number*/
$wp_customize->add_setting( 'education_base_theme_options[education-base-wc-product-column-number]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['education-base-wc-product-column-number'],
	'sanitize_callback' => 'absint'
) );
$wp_customize->add_control( 'education_base_theme_options[education-base-wc-product-column-number]', array(
	'label'		=> esc_html__( 'Products Per Row', 'education-base' ),
	'section'   => 'education-base-wc-shop-archive-option',
	'settings'  => 'education_base_theme_options[education-base-wc-product-column-number]',
	'type'	  	=> 'number'
) );

/*wc-shop-archive-total-product*/
$wp_customize->add_setting( 'education_base_theme_options[education-base-wc-shop-archive-total-product]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['education-base-wc-shop-archive-total-product'],
	'sanitize_callback' => 'absint'
) );
$wp_customize->add_control( 'education_base_theme_options[education-base-wc-shop-archive-total-product]', array(
	'label'		=> esc_html__( 'Total Products Per Page', 'education-base' ),
	'section'   => 'education-base-wc-shop-archive-option',
	'settings'  => 'education_base_theme_options[education-base-wc-shop-archive-total-product]',
	'type'	  	=> 'number'
) );