<?php
/*adding sections for footer options*/
$wp_customize->add_section( 'education-base-footer-option', array(
    'priority'       => 10,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Copyright Text', 'education-base' ),
    'panel'          => 'education-base-footer-panel',
) );

/*copyright*/
$wp_customize->add_setting( 'education_base_theme_options[education-base-footer-copyright]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['education-base-footer-copyright'],
    'sanitize_callback' => 'wp_kses_post'
) );
$wp_customize->add_control( 'education_base_theme_options[education-base-footer-copyright]', array(
    'label'		=> __( 'Copyright Text', 'education-base' ),
    'section'   => 'education-base-footer-option',
    'settings'  => 'education_base_theme_options[education-base-footer-copyright]',
    'type'	  	=> 'text',
    'priority'  => 10
) );