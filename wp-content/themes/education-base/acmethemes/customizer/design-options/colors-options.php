<?php
/*customizing default colors section and adding new controls-setting too*/
$wp_customize->add_section( 'colors', array(
    'priority'       => 40,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Colors', 'education-base' ),
    'panel'          => 'education-base-design-panel'
) );

/*Primary color*/
$wp_customize->add_setting( 'education_base_theme_options[education-base-primary-color]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['education-base-primary-color'],
    'sanitize_callback' => 'sanitize_hex_color'
) );

$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'education_base_theme_options[education-base-primary-color]',
        array(
            'label'		=> __( 'Primary Color', 'education-base' ),
            'section'   => 'colors',
            'settings'  => 'education_base_theme_options[education-base-primary-color]',
            'type'	  	=> 'color'
        ) )
);

/*Header TOP color*/
$wp_customize->add_setting( 'education_base_theme_options[education-base-header-top-color]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['education-base-header-top-color'],
    'sanitize_callback' => 'sanitize_hex_color'
) );

$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'education_base_theme_options[education-base-header-top-color]',
        array(
            'label'		=> __( 'Header Top Background Color', 'education-base' ),
            'description'=> __( 'Also used as secondary color', 'education-base' ),
            'section'   => 'colors',
            'settings'  => 'education_base_theme_options[education-base-header-top-color]',
            'type'	  	=> 'color'
        )
    )
);

/* Footer Background Color*/
$wp_customize->add_setting( 'education_base_theme_options[education-base-footer-color]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['education-base-footer-color'],
    'sanitize_callback' => 'sanitize_hex_color'
) );

$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'education_base_theme_options[education-base-footer-color]',
        array(
            'label'		=> __( 'Footer Background Color', 'education-base' ),
            'section'   => 'colors',
            'settings'  => 'education_base_theme_options[education-base-footer-color]',
            'type'	  	=> 'color'
        )
    )
);

/* Footer Bottom Background Color*/
$wp_customize->add_setting( 'education_base_theme_options[education-base-footer-bottom-color]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['education-base-footer-bottom-color'],
    'sanitize_callback' => 'sanitize_hex_color'
) );

$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'education_base_theme_options[education-base-footer-bottom-color]',
        array(
            'label'		=> __( 'Footer Bottom Background Color', 'education-base' ),
            'section'   => 'colors',
            'settings'  => 'education_base_theme_options[education-base-footer-bottom-color]',
            'type'	  	=> 'color'
        )
    )
);