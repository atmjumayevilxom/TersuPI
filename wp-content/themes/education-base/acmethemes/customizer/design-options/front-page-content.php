<?php
/*active callback function for front-page-header*/
if ( !function_exists('education_base_active_callback_front_page_header') ) :
    function education_base_active_callback_front_page_header() {
        $education_base_customizer_all_values = education_base_get_theme_options();
        if( 1 != $education_base_customizer_all_values['education-base-hide-front-page-content'] ){
            return true;
        }
        return false;
    }
endif;

/*adding sections for footer social options */
$wp_customize->add_section( 'education-base-front-page-content', array(
    'priority'       => 20,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Front Page Content Options', 'education-base' ),
    'panel'          => 'education-base-design-panel'
) );

/*hide front page content*/
$wp_customize->add_setting( 'education_base_theme_options[education-base-hide-front-page-content]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['education-base-hide-front-page-content'],
    'sanitize_callback' => 'education_base_sanitize_checkbox',
) );
$wp_customize->add_control( 'education_base_theme_options[education-base-hide-front-page-content]', array(
    'label'		 => __( 'Hide Front Page Content', 'education-base' ),
    'description'=> __( 'You may want to hide front page content and want to show only Feature section and Home Widgets. Check this to hide front page content.', 'education-base' ),
    'section'   => 'education-base-front-page-content',
    'settings'  => 'education_base_theme_options[education-base-hide-front-page-content]',
    'type'	  	=> 'checkbox',
    'priority'  => 10
) );

/*hide front page header*/
$wp_customize->add_setting( 'education_base_theme_options[education-base-hide-front-page-header]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['education-base-hide-front-page-header'],
    'sanitize_callback' => 'education_base_sanitize_checkbox',
) );
$wp_customize->add_control( 'education_base_theme_options[education-base-hide-front-page-header]', array(
    'label'		 => __( 'Hide Front Page Header', 'education-base' ),
    'description'=> __( 'You may want to hide front page header and want to show only Feature section and Home Widgets. Check this to hide front page Header.', 'education-base' ),
    'section'   => 'education-base-front-page-content',
    'settings'  => 'education_base_theme_options[education-base-hide-front-page-header]',
    'type'	  	=> 'checkbox',
    'priority'  => 20,
    'active_callback'   => 'education_base_active_callback_front_page_header'
) );