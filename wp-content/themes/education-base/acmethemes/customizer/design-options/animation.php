<?php
/*adding sections for header options panel*/
$wp_customize->add_section( 'education-base-animation', array(
    'priority'       => 2,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Animation', 'education-base' ),
    'panel'          => 'education-base-design-panel'
) );

/*header logo text display options*/
$wp_customize->add_setting( 'education_base_theme_options[education-base-enable-animation]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['education-base-enable-animation'],
    'sanitize_callback' => 'education_base_sanitize_checkbox'
) );
$wp_customize->add_control( 'education_base_theme_options[education-base-enable-animation]', array(
    'label'		=> __( 'Disable animation', 'education-base' ),
    'description'   => __( 'Check this to disable overall site animation effect provided by theme', 'education-base' ),
    'section'   => 'education-base-animation',
    'settings'  => 'education_base_theme_options[education-base-enable-animation]',
    'type'	  	=> 'checkbox',
    'priority'  => 10
) );