<?php
/*adding footer options panel*/
$wp_customize->add_panel( 'education-base-footer-panel', array(
    'priority'       => 80,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Footer Options', 'education-base' ),
    'description'    => __( 'Customize your awesome site footer ', 'education-base' )
) );

/*
* file for footer logo options
*/
require education_base_file_directory('acmethemes/customizer/footer-options/footer-copyright.php');

/*
* file for footer menu options
*/
require education_base_file_directory('acmethemes/customizer/footer-options/social-options.php');