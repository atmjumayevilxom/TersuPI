<?php
/*adding theme options panel*/
$wp_customize->add_panel( 'education-base-options', array(
    'priority'       => 210,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Theme Options', 'education-base' ),
    'description'    => __( 'Customize your awesome site with theme options ', 'education-base' )
) );

/*
* file for header breadcrumb options
*/
require education_base_file_directory('acmethemes/customizer/options/breadcrumb.php');

/*
* file for header search options
*/
require education_base_file_directory('acmethemes/customizer/options/search.php');

/*
* file for header search options
*/
require education_base_file_directory('acmethemes/customizer/options/store-title.php');