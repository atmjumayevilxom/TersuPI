<?php
/*adding sections for design panel*/
$wp_customize->add_section( 'education-base-widget-title-icon', array(
	'priority'       => 2,
	'capability'     => 'edit_theme_options',
	'theme_supports' => '',
	'title'          => __( 'Widget Title Icon', 'education-base' ),
	'description'    => __( 'Remove or Change Cap Icon','education-base' ),
	'panel'          => 'education-base-design-panel'
) );

/*hide widget title icon*/
$wp_customize->add_setting( 'education_base_theme_options[education-base-disable-widget-title-icon]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['education-base-disable-widget-title-icon'],
	'sanitize_callback' => 'education_base_sanitize_checkbox',
	'transport' => 'postMessage'
) );
$wp_customize->add_control( 'education_base_theme_options[education-base-disable-widget-title-icon]', array(
	'label'		=> __( 'Disable Title Icon', 'education-base' ),
	'description'   => __( 'Check this to disable Widget Title Icon', 'education-base' ),
	'section'   => 'education-base-widget-title-icon',
	'settings'  => 'education_base_theme_options[education-base-disable-widget-title-icon]',
	'type'	  	=> 'checkbox',
	'priority'  => 10
) );

/*widget title icon*/
$wp_customize->add_setting( 'education_base_theme_options[education-base-widget-title-icon]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['education-base-widget-title-icon'],
	'sanitize_callback' => 'sanitize_text_field',
	'transport' => 'postMessage'
) );
$wp_customize->add_control( 'education_base_theme_options[education-base-widget-title-icon]', array(
	'label'		=> __( 'Title Icon', 'education-base' ),
	'description'   => sprintf( __( '%1$sRefer here%2$s for icon class. For example: %3$sfa-desktop%4$s', 'education-base' ), '<a href="'.esc_url( 'http://fontawesome.io/cheatsheet/' ).'" target="_blank">','</a>',"<code>","</code>" ),
	'section'   => 'education-base-widget-title-icon',
	'settings'  => 'education_base_theme_options[education-base-widget-title-icon]',
	'type'	  	=> 'text',
	'priority'  => 20
) );