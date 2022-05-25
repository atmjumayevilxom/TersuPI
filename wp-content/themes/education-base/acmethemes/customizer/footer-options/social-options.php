<?php
/*adding sections for footer social options */
$wp_customize->add_section( 'education-base-footer-social', array(
    'priority'       => 20,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Social Options', 'education-base' ),
    'panel'          => 'education-base-footer-panel'
) );

/*enable social*/
$wp_customize->add_setting( 'education_base_theme_options[education-base-enable-social]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['education-base-enable-social'],
    'sanitize_callback' => 'education_base_sanitize_checkbox',
) );
$wp_customize->add_control( 'education_base_theme_options[education-base-enable-social]', array(
    'label'		=> __( 'Enable social', 'education-base' ),
    'section'   => 'education-base-footer-social',
    'settings'  => 'education_base_theme_options[education-base-enable-social]',
    'type'	  	=> 'checkbox',
    'priority'  => 10
) );