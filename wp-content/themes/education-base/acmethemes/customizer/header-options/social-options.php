<?php
/*adding sections for header social options */
$wp_customize->add_section( 'education-base-header-social', array(
    'priority'       => 20,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Social Options', 'education-base' ),
    'panel'          => 'education-base-header-panel'
) );

/*facebook url*/
$wp_customize->add_setting( 'education_base_theme_options[education-base-facebook-url]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['education-base-facebook-url'],
    'sanitize_callback' => 'esc_url_raw',
) );
$wp_customize->add_control( 'education_base_theme_options[education-base-facebook-url]', array(
    'label'		=> __( 'Facebook url', 'education-base' ),
    'section'   => 'education-base-header-social',
    'settings'  => 'education_base_theme_options[education-base-facebook-url]',
    'type'	  	=> 'url',
    'priority'  => 10
) );

/*twitter url*/
$wp_customize->add_setting( 'education_base_theme_options[education-base-twitter-url]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['education-base-twitter-url'],
    'sanitize_callback' => 'esc_url_raw',
) );
$wp_customize->add_control( 'education_base_theme_options[education-base-twitter-url]', array(
    'label'		=> __( 'Twitter url', 'education-base' ),
    'section'   => 'education-base-header-social',
    'settings'  => 'education_base_theme_options[education-base-twitter-url]',
    'type'	  	=> 'url',
    'priority'  => 20
) );

/*youtube url*/
$wp_customize->add_setting( 'education_base_theme_options[education-base-youtube-url]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['education-base-youtube-url'],
    'sanitize_callback' => 'esc_url_raw',
) );
$wp_customize->add_control( 'education_base_theme_options[education-base-youtube-url]', array(
    'label'		=> __( 'Youtube url', 'education-base' ),
    'section'   => 'education-base-header-social',
    'settings'  => 'education_base_theme_options[education-base-youtube-url]',
    'type'	  	=> 'url',
    'priority'  => 30
) );

/*
 * plus.google url*/
$wp_customize->add_setting( 'education_base_theme_options[education-base-google-plus-url]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['education-base-google-plus-url'],
    'sanitize_callback' => 'esc_url_raw'
) );
$wp_customize->add_control( 'education_base_theme_options[education-base-google-plus-url]', array(
    'label'		=> __( 'Google Plus Url', 'education-base' ),
    'section'   => 'education-base-header-social',
    'settings'  => 'education_base_theme_options[education-base-google-plus-url]',
    'type'	  	=> 'url',
    'priority'  => 40
) );