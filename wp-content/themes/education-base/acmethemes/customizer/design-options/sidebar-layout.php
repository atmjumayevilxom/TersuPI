<?php
/*adding sections for sidebar options */
$wp_customize->add_section( 'education-base-design-sidebar-layout-option', array(
    'priority'       => 20,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Default Page/Post Sidebar Layout', 'education-base' ),
    'panel'          => 'education-base-design-panel'
) );

/*Sidebar Layout*/
$wp_customize->add_setting( 'education_base_theme_options[education-base-sidebar-layout]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['education-base-sidebar-layout'],
    'sanitize_callback' => 'education_base_sanitize_select'
) );
$choices = education_base_sidebar_layout();
$wp_customize->add_control( 'education_base_theme_options[education-base-sidebar-layout]', array(
    'choices'  	=> $choices,
    'label'		=> __( 'Default Page/Post Sidebar Layout', 'education-base' ),
    'description'=> __( 'Single Page/Post Sidebar', 'education-base' ),
    'section'   => 'education-base-design-sidebar-layout-option',
    'settings'  => 'education_base_theme_options[education-base-sidebar-layout]',
    'type'	  	=> 'select'
) );