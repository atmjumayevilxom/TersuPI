<?php
/*adding sections for category section in front page*/
$wp_customize->add_section( 'education-base-feature-column', array(
    'priority'       => 10,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Feature Column Selection', 'education-base' ),
    'panel'          => 'education-base-feature-panel'
) );

/* feature parent page selection */
$wp_customize->add_setting( 'education_base_theme_options[education-base-feature-column-1]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['education-base-feature-column-1'],
    'sanitize_callback' => 'education_base_sanitize_number'
) );
$wp_customize->add_control( 'education_base_theme_options[education-base-feature-column-1]', array(
    'label'		    => __( 'Select Page for Feature Column 1', 'education-base' ),
    'section'       => 'education-base-feature-column',
    'settings'      => 'education_base_theme_options[education-base-feature-column-1]',
    'type'	  	    => 'dropdown-pages',
    'priority'      => 10
) );

/*Feature Column 1 Background Color*/
$wp_customize->add_setting( 'education_base_theme_options[education-base-feature-column-1-color]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['education-base-feature-column-1-color'],
    'sanitize_callback' => 'sanitize_hex_color'
) );

$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'education_base_theme_options[education-base-feature-column-1-color]',
        array(
            'label'		=> __( 'Feature Column 1 Background Color', 'education-base' ),
            'section'   => 'education-base-feature-column',
            'settings'  => 'education_base_theme_options[education-base-feature-column-1-color]',
            'type'	  	=> 'color',
            'priority'      => 20
        )
    )
);

/* feature parent page selection */
$wp_customize->add_setting( 'education_base_theme_options[education-base-feature-column-2]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['education-base-feature-column-2'],
    'sanitize_callback' => 'education_base_sanitize_number'
) );
$wp_customize->add_control( 'education_base_theme_options[education-base-feature-column-2]', array(
    'label'		    => __( 'Select Page for Feature Column 2', 'education-base' ),
    'section'       => 'education-base-feature-column',
    'settings'      => 'education_base_theme_options[education-base-feature-column-2]',
    'type'	  	    => 'dropdown-pages',
    'priority'      => 30
) );

/*Feature Column 2 Background Color*/
$wp_customize->add_setting( 'education_base_theme_options[education-base-feature-column-2-color]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['education-base-feature-column-2-color'],
    'sanitize_callback' => 'sanitize_hex_color'
) );

$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'education_base_theme_options[education-base-feature-column-2-color]',
        array(
            'label'		=> __( 'Feature Column 2 Background Color', 'education-base' ),
            'section'   => 'education-base-feature-column',
            'settings'  => 'education_base_theme_options[education-base-feature-column-2-color]',
            'type'	  	=> 'color',
            'priority'      => 40
        )
    )
);

/* feature parent page selection */
$wp_customize->add_setting( 'education_base_theme_options[education-base-feature-column-3]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['education-base-feature-column-3'],
    'sanitize_callback' => 'education_base_sanitize_number'
) );
$wp_customize->add_control( 'education_base_theme_options[education-base-feature-column-3]', array(
    'label'		    => __( 'Select Page for Feature Column 3', 'education-base' ),
    'section'       => 'education-base-feature-column',
    'settings'      => 'education_base_theme_options[education-base-feature-column-3]',
    'type'	  	    => 'dropdown-pages',
    'priority'      => 40
) );

/*Feature Column 3 Background Color*/
$wp_customize->add_setting( 'education_base_theme_options[education-base-feature-column-3-color]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['education-base-feature-column-3-color'],
    'sanitize_callback' => 'sanitize_hex_color'
) );

$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'education_base_theme_options[education-base-feature-column-3-color]',
        array(
            'label'		=> __( 'Feature Column 3 Background Color', 'education-base' ),
            'section'   => 'education-base-feature-column',
            'settings'  => 'education_base_theme_options[education-base-feature-column-3-color]',
            'type'	  	=> 'color',
            'priority'      => 50
        )
    )
);