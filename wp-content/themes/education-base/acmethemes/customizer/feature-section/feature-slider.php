<?php
/*adding sections for category section in front page*/
$wp_customize->add_section( 'education-base-feature-page', array(
    'priority'       => 10,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Feature Slider Selection', 'education-base' ),
    'panel'          => 'education-base-feature-panel'
) );

/* feature parent all-slides selection */
$slider_pages = array();
$slider_pages_obj = get_pages();
$slider_pages[''] = esc_html__('Select Slider Page','education-base');
foreach ($slider_pages_obj as $page) {
	$slider_pages[$page->ID] = $page->post_title;
}
$wp_customize->add_setting( 'education_base_theme_options[education-base-all-slides]', array(
	'sanitize_callback' => 'education_base_sanitize_repeater',
	'default' => $defaults['education-base-all-slides']
) );
$wp_customize->add_control(
	new AT_Repeater_Control(
		$wp_customize,
		'education_base_theme_options[education-base-all-slides]',
		array(
			'label'   => __('Slider Selection','education-base'),
			'description'=> __('Select Page For Slider','education-base'),
			'section' => 'education-base-feature-page',
			'settings' => 'education_base_theme_options[education-base-all-slides]',
			'repeater_main_label' => __('Select Slide of Slider','education-base'),
			'repeater_add_control_field' => __('Add New Slide','education-base'),
			'priority'      => 10
		),
		array(
			'selectpage' => array(
				'type'        => 'select',
				'label'       => __( 'Select Page For Slide', 'education-base' ),
				'options'   => $slider_pages
			)
		)
	)
);

/*enable animation*/
$wp_customize->add_setting( 'education_base_theme_options[education-base-feature-slider-enable-animation]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['education-base-feature-slider-enable-animation'],
    'sanitize_callback' => 'education_base_sanitize_checkbox'
) );
$wp_customize->add_control( 'education_base_theme_options[education-base-feature-slider-enable-animation]', array(
    'label'		    => __( 'Enable Animation', 'education-base' ),
    'section'       => 'education-base-feature-page',
    'settings'      => 'education_base_theme_options[education-base-feature-slider-enable-animation]',
    'type'	  	    => 'checkbox',
    'priority'      => 30
) );

/*image only*/
$wp_customize->add_setting( 'education_base_theme_options[education-base-feature-slider-image-only]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['education-base-feature-slider-image-only'],
    'sanitize_callback' => 'education_base_sanitize_checkbox'
) );
$wp_customize->add_control( 'education_base_theme_options[education-base-feature-slider-image-only]', array(
    'label'		    => __( 'Display Image Only', 'education-base' ),
    'section'       => 'education-base-feature-page',
    'settings'      => 'education_base_theme_options[education-base-feature-slider-image-only]',
    'type'	  	    => 'checkbox',
    'priority'      => 40
) );

/*Image Display Behavior*/
$wp_customize->add_setting( 'education_base_theme_options[education-base-fs-image-display-options]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['education-base-fs-image-display-options'],
    'sanitize_callback' => 'education_base_sanitize_select'
) );
$choices = education_base_fs_image_display_options();
$wp_customize->add_control( 'education_base_theme_options[education-base-fs-image-display-options]', array(
    'choices'  	=> $choices,
    'label'		=> __( 'Feature Slider Image Display Options', 'education-base' ),
    'section'   => 'education-base-feature-page',
    'settings'  => 'education_base_theme_options[education-base-fs-image-display-options]',
    'type'	  	=> 'radio',
    'priority'  => 50
) );

/*know more text*/
$wp_customize->add_setting( 'education_base_theme_options[education-base-slider-know-more-text]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['education-base-slider-know-more-text'],
    'sanitize_callback' => 'sanitize_text_field'
) );
$wp_customize->add_control( 'education_base_theme_options[education-base-slider-know-more-text]', array(
    'label'		    => __( 'Slider Button Text', 'education-base' ),
    'description'   => __( 'Left empty to disable slider button ', 'education-base' ),
    'section'       => 'education-base-feature-page',
    'settings'      => 'education_base_theme_options[education-base-slider-know-more-text]',
    'type'	  	    => 'text',
    'priority'      => 220
) );