<?php
/*adding sections for breadcrumb */
$wp_customize->add_section( 'education-base-breadcrumb-options', array(
    'priority'       => 20,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Breadcrumb Options', 'education-base' ),
    'panel'          => 'education-base-options'
) );

/*show breadcrumb*/
$wp_customize->add_setting( 'education_base_theme_options[education-base-show-breadcrumb]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['education-base-show-breadcrumb'],
    'sanitize_callback' => 'education_base_sanitize_checkbox'
) );

$wp_customize->add_control( 'education_base_theme_options[education-base-show-breadcrumb]', array(
    'label'		=> __( 'Enable Breadcrumb', 'education-base' ),
    'section'   => 'education-base-breadcrumb-options',
    'settings'  => 'education_base_theme_options[education-base-show-breadcrumb]',
    'type'	  	=> 'checkbox',
    'priority'  => 10
) );