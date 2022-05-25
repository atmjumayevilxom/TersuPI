<?php
/*adding feature options panel*/
$wp_customize->add_panel( 'education-base-feature-panel', array(
    'priority'       => 40,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Featured Section Options', 'education-base' ),
    'description'    => __( 'Customize your awesome site feature section ', 'education-base' )
) );

/*
* file for feature section enable
*/
require education_base_file_directory('acmethemes/customizer/feature-section/feature-enable.php');

/*
* file for feature slider category
*/
require education_base_file_directory('acmethemes/customizer/feature-section/feature-slider.php');

/*
* file for feature slider category
*/
require education_base_file_directory('acmethemes/customizer/feature-section/feature-columns.php');