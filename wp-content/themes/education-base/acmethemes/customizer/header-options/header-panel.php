<?php
/*adding header options panel*/
$wp_customize->add_panel( 'education-base-header-panel', array(
    'priority'       => 30,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Header Options', 'education-base' ),
    'description'    => __( 'Customize your awesome site header ', 'education-base' )
) );

/*
* file for header top options
*/
require education_base_file_directory('acmethemes/customizer/header-options/header-top.php');

/*
* file for header logo options
*/
require education_base_file_directory('acmethemes/customizer/header-options/header-logo.php');

/*
* file for social options
*/
require education_base_file_directory('acmethemes/customizer/header-options/social-options.php');

/*
 * file for menu options
*/
require education_base_file_directory('acmethemes/customizer/header-options/menu-options.php');

/*adding header image inside this panel*/
$wp_customize->get_section( 'header_image' )->panel = 'education-base-header-panel';
$wp_customize->get_section( 'header_image' )->description = __( 'Applied to header image of inner pages.', 'education-base' );
$wp_customize->remove_control( 'display_header_text' );

/* feature section height*/
$wp_customize->add_setting( 'education_base_theme_options[education-base-header-height]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['education-base-header-height'],
    'sanitize_callback' => 'education_base_sanitize_number'
) );

$wp_customize->add_control( 'education_base_theme_options[education-base-header-height]', array(
    'type'        => 'range',
    'priority'    => 1,
    'section'     => 'header_image',
    'label'		  => __( 'Inner Page Header Section Height', 'education-base' ),
    'description' => __( 'Control the height of Header section. The minimum height is 100px and maximium height is 500px', 'education-base' ),
    'input_attrs' => array(
        'min'   => 100,
        'max'   => 500,
        'step'  => 1,
        'class' => 'education-base-header-height',
        'style' => 'color: #0a0',
    ),
) );