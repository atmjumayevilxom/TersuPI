<?php
/*adding sections for enabling feature section in front page*/
$wp_customize->add_section( 'education-base-enable-feature', array(
    'priority'       => 10,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Enable Feature Section', 'education-base' ),
    'panel'          => 'education-base-feature-panel'
) );

/*enable feature section*/
$wp_customize->add_setting( 'education_base_theme_options[education-base-enable-feature]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['education-base-enable-feature'],
    'sanitize_callback' => 'education_base_sanitize_checkbox'
) );

$wp_customize->add_control( 'education_base_theme_options[education-base-enable-feature]', array(
    'label'		=> __( 'Enable Feature Section', 'education-base' ),
    'description'	=> sprintf( __( 'Feature section will display on front/home page. Feature Section includes Feature Slider and Feature Column.%1$s Note : Please go to %2$s "Static Front Page"%3$s setting, Select "A static page" then "Front page" and "Posts page" to enable it', 'education-base' ), '<br />','<b><a class="at-customizer" data-section="static_front_page"> ','</a></b>' ),
    'section'   => 'education-base-enable-feature',
    'settings'  => 'education_base_theme_options[education-base-enable-feature]',
    'type'	  	=> 'checkbox',
    'priority'  => 10
) );