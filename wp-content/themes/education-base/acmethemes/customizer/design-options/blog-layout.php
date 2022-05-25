<?php
/*adding sections for blog layout options*/
$wp_customize->add_section( 'education-base-design-blog-layout-option', array(
    'priority'       => 30,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Default Blog/Archive Layout', 'education-base' ),
    'panel'          => 'education-base-design-panel'
) );

/*blog layout*/
$wp_customize->add_setting( 'education_base_theme_options[education-base-blog-archive-layout]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['education-base-blog-archive-layout'],
    'sanitize_callback' => 'education_base_sanitize_select'
) );
$choices = education_base_blog_layout();
$wp_customize->add_control( 'education_base_theme_options[education-base-blog-archive-layout]', array(
    'choices'  	    => $choices,
    'label'		    => __( 'Default Blog/Archive Layout', 'education-base' ),
    'description'   => __( 'Image display options', 'education-base' ),
    'section'       => 'education-base-design-blog-layout-option',
    'settings'      => 'education_base_theme_options[education-base-blog-archive-layout]',
    'type'	  	    => 'select'
) );

/*Read More Text*/
$wp_customize->add_setting( 'education_base_theme_options[education-base-blog-archive-more-text]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['education-base-blog-archive-more-text'],
    'sanitize_callback' => 'sanitize_text_field'
) );
$wp_customize->add_control( 'education_base_theme_options[education-base-blog-archive-more-text]', array(
    'label'		=> __( 'Read More Text', 'education-base' ),
    'section'   => 'education-base-design-blog-layout-option',
    'settings'  => 'education_base_theme_options[education-base-blog-archive-more-text]',
    'type'	  	=> 'text'
) );