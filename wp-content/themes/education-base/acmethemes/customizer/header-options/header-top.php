<?php
/*adding sections for header options*/
$wp_customize->add_section( 'education-base-header-top-option', array(
    'priority'       => 10,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Header Top', 'education-base' ),
    'panel'          => 'education-base-header-panel',
) );

/*header top left options*/
$wp_customize->add_setting( 'education_base_theme_options[education-base-enable-header-top]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['education-base-enable-header-top'],
    'sanitize_callback' => 'education_base_sanitize_checkbox',
) );
$wp_customize->add_control( 'education_base_theme_options[education-base-enable-header-top]', array(
    'label'		=> __( 'Enable Header Top Options', 'education-base' ),
    'section'   => 'education-base-header-top-option',
    'settings'  => 'education_base_theme_options[education-base-enable-header-top]',
    'type'	  	=> 'checkbox'
) );

/* number of slider*/
$wp_customize->add_setting( 'education_base_theme_options[education-base-top-header-design-options]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['education-base-top-header-design-options'],
    'sanitize_callback' => 'education_base_sanitize_select'
) );
$choices = education_base_top_header_design_options();
$wp_customize->add_control( 'education_base_theme_options[education-base-top-header-design-options]', array(
    'choices'  	=> $choices,
    'label'		=> __( 'Design Option', 'education-base' ),
    'section'   => 'education-base-header-top-option',
    'settings'  => 'education_base_theme_options[education-base-top-header-design-options]',
    'type'	  	=> 'select'
) );

/*phone number*/
$wp_customize->add_setting( 'education_base_theme_options[education-base-phone-number]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['education-base-phone-number'],
    'sanitize_callback' => 'sanitize_text_field'
) );
$wp_customize->add_control( 'education_base_theme_options[education-base-phone-number]', array(
    'label'		=> __( 'Left Side Phone Number', 'education-base' ),
    'section'   => 'education-base-header-top-option',
    'settings'  => 'education_base_theme_options[education-base-phone-number]',
    'type'	  	=> 'text'
) );

/*Email*/
$wp_customize->add_setting( 'education_base_theme_options[education-base-top-email]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['education-base-top-email'],
    'sanitize_callback' => 'sanitize_text_field'
) );
$wp_customize->add_control( 'education_base_theme_options[education-base-top-email]', array(
    'label'		=> __( 'Left Side Email', 'education-base' ),
    'section'   => 'education-base-header-top-option',
    'settings'  => 'education_base_theme_options[education-base-top-email]',
    'type'	  	=> 'text'
) );

/*Announcement title*/
$wp_customize->add_setting( 'education_base_theme_options[education-base-newsnotice-title]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['education-base-newsnotice-title'],
    'sanitize_callback' => 'sanitize_text_field'
) );
$wp_customize->add_control( 'education_base_theme_options[education-base-newsnotice-title]', array(
    'label'		=> __( 'Left Side News/Notice/Announcement Title', 'education-base' ),
    'section'   => 'education-base-header-top-option',
    'settings'  => 'education_base_theme_options[education-base-newsnotice-title]',
    'type'	  	=> 'text',
) );

/* News cat selection */
$wp_customize->add_setting( 'education_base_theme_options[education-base-newsnotice-cat]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['education-base-newsnotice-cat'],
    'sanitize_callback' => 'education_base_sanitize_number'
) );

$wp_customize->add_control(
    new Education_Base_Customize_Category_Dropdown_Control(
        $wp_customize,
        'education_base_theme_options[education-base-newsnotice-cat]',
        array(
            'label'		=> __( 'Left Side Select Category News/Notice', 'education-base' ),
            'section'   => 'education-base-header-top-option',
            'settings'  => 'education_base_theme_options[education-base-newsnotice-cat]',
            'type'	  	=> 'category_dropdown',
        )
    )
);

/*header top left options*/
$wp_customize->add_setting( 'education_base_theme_options[education-base-enable-top-social]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['education-base-enable-top-social'],
    'sanitize_callback' => 'education_base_sanitize_checkbox',
) );
$wp_customize->add_control( 'education_base_theme_options[education-base-enable-top-social]', array(
    'label'		=> __( 'Right Side Enable Social', 'education-base' ),
    'section'   => 'education-base-header-top-option',
    'settings'  => 'education_base_theme_options[education-base-enable-top-social]',
    'type'	  	=> 'checkbox'
) );

/*Button title*/
$wp_customize->add_setting( 'education_base_theme_options[education-base-button-title]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['education-base-button-title'],
    'sanitize_callback' => 'sanitize_text_field'
) );
$wp_customize->add_control( 'education_base_theme_options[education-base-button-title]', array(
    'label'		=> __( 'Right Side Button Title', 'education-base' ),
    'section'   => 'education-base-header-top-option',
    'settings'  => 'education_base_theme_options[education-base-button-title]',
    'type'	  	=> 'text',
) );

/*Button link*/
$wp_customize->add_setting( 'education_base_theme_options[education-base-button-link]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['education-base-button-link'],
    'sanitize_callback' => 'esc_url_raw'
) );
$wp_customize->add_control( 'education_base_theme_options[education-base-button-link]', array(
    'label'		=> __( 'Right Side Button Link', 'education-base' ),
    'section'   => 'education-base-header-top-option',
    'settings'  => 'education_base_theme_options[education-base-button-link]',
    'type'	  	=> 'url',
) );