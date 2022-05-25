<?php
/*adding sections for Search Placeholder*/
$wp_customize->add_section( 'education-base-search', array(
    'priority'       => 20,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Search', 'education-base' ),
    'panel'          => 'education-base-options'
) );

/*Search Placeholder*/
$wp_customize->add_setting( 'education_base_theme_options[education-base-search-placholder]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['education-base-search-placholder'],
    'sanitize_callback' => 'sanitize_text_field'
) );
$wp_customize->add_control( 'education_base_theme_options[education-base-search-placholder]', array(
    'label'		=> __( 'Search Placeholder', 'education-base' ),
    'section'   => 'education-base-search',
    'settings'  => 'education_base_theme_options[education-base-search-placholder]',
    'type'	  	=> 'text',
    'priority'  => 10
) );