<?php
if( class_exists('woocommerce')){
	/*adding sections for store title*/
	$wp_customize->add_section( 'education-base-store-title', array(
		'priority'       => 20,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '',
		'title'          => __( 'Store Title', 'education-base' ),
		'panel'          => 'education-base-options'
	) );

	/*store title*/
	$wp_customize->add_setting( 'education_base_theme_options[education-base-store-title]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['education-base-store-title'],
		'sanitize_callback' => 'sanitize_text_field'
	) );
	$wp_customize->add_control( 'education_base_theme_options[education-base-store-title]', array(
		'label'		=> __( 'Store Title', 'education-base' ),
		'section'   => 'education-base-store-title',
		'settings'  => 'education_base_theme_options[education-base-store-title]',
		'type'	  	=> 'text',
		'priority'  => 10
	) );
}