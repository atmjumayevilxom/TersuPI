<?php
/*header logo/text display options*/
$wp_customize->add_setting( 'education_base_theme_options[education-base-header-id-display-opt]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['education-base-header-id-display-opt'],
    'sanitize_callback' => 'education_base_sanitize_select'
) );
$choices = education_base_header_id_display_opt();
$wp_customize->add_control( 'education_base_theme_options[education-base-header-id-display-opt]', array(
    'choices'  	=> $choices,
    'label'		=> __( 'Logo/Site Title-Tagline Display Options', 'education-base' ),
    'section'   => 'title_tagline',
    'settings'  => 'education_base_theme_options[education-base-header-id-display-opt]',
    'type'	  	=> 'radio',
    'priority'  => 30
) );