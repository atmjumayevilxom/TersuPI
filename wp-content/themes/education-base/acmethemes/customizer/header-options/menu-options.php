<?php
/*Menu Section*/
$wp_customize->add_section( 'education-base-menu-options', array(
    'priority'       => 20,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Menu Options', 'education-base' ),
    'panel'          => 'education-base-header-panel'
) );

/*enable sticky menu*/
$wp_customize->add_setting( 'education_base_theme_options[education-base-enable-sticky]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['education-base-enable-sticky'],
    'sanitize_callback' => 'education_base_sanitize_checkbox'
) );

$wp_customize->add_control( 'education_base_theme_options[education-base-enable-sticky]', array(
    'label'		=> __( 'Enable Sticky', 'education-base' ),
    'section'   => 'education-base-menu-options',
    'settings'  => 'education_base_theme_options[education-base-enable-sticky]',
    'type'	  	=> 'checkbox',
    'priority'  => 20
) );