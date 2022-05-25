<?php
/*adding sections for default layout options panel*/
$wp_customize->add_section( 'education-base-archive-sidebar-layout', array(
    'priority'       => 20,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Category/Archive Sidebar Layout', 'education-base' ),
    'panel'          => 'education-base-design-panel'
) );

/*Sidebar Layout*/
$wp_customize->add_setting( 'education_base_theme_options[education-base-archive-sidebar-layout]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['education-base-archive-sidebar-layout'],
    'sanitize_callback' => 'education_base_sanitize_select'
) );
$choices = education_base_sidebar_layout();
$wp_customize->add_control( 'education_base_theme_options[education-base-archive-sidebar-layout]', array(
    'choices'  	    => $choices,
    'label'		    => __( 'Category/Archive Sidebar Layout', 'education-base' ),
    'description'   => __( 'Sidebar Layout for listing pages like category, author etc', 'education-base' ),
    'section'       => 'education-base-archive-sidebar-layout',
    'settings'      => 'education_base_theme_options[education-base-archive-sidebar-layout]',
    'type'	  	    => 'select'
) );