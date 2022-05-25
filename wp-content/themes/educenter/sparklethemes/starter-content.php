<?php
    
function educenter_starter_content_setup(){

    add_theme_support( 'starter-content', array(
        'options' => array(
            // Our Custom
            'blogdescription' => 'Just another WordPress site ',
            
        ),

        'theme_mods'  => array(
            'educenter_primary_color' => '#004A8D',
            'educenter_email_address' => 'info@example.com',
            'educenter_phone_number' => '0123456789',
            'educenter_opeening_time' => __('10AM - 10PM', 'educenter'),
            'educenter_social_facebook' => '#',
            'educenter_social_twitter' => '#',
            'educenter_social_instagram' => '#',

            'educenter_set_frontpage' => true,
            'educenter_homepage_slider_type' => 'advance',

            'educenter_banner_normal_all_sliders' => json_encode( array(
                array(
                    'slider_img' => get_template_directory_uri(  ). '/assets/images/default/pexels-photo-820823.jpeg',
                    'slider_title' => __('Welcome To Our University', 'educenter'),
                    'slider_desc' => __('Lorem ipsum dolor sit amet, consectetur adipisicing elit. Velit labore mollitia, aliquam nisi neque perspiciatis expedita, nulla deleniti…', 'educenter'),
                    'button_text' => __('Admision Open', 'educenter'),
                    'button_url' => '#'
                ),

                array(
                    'slider_img' => get_template_directory_uri(  ). '/assets/images/default/pexels-photo-267885.jpeg',
                    'slider_title' => __('Turn Your Dream Into Reality', 'educenter'),
                    'slider_desc' => __('Lorem ipsum dolor sit amet, consectetur adipisicing elit. Velit labore mollitia, aliquam nisi neque perspiciatis expedita, nulla deleniti…', 'educenter'),
                    'button_text' => __('Admision Open', 'educenter'),
                    'button_url' => '#'
                ),

                array(
                    'slider_img' => get_template_directory_uri(  ). '/assets/images/default/fatigued-young-laptop-beautiful-seductive-seat-1366717-pxhere.com.jpg',
                    'slider_title' => __('Your Success Is Our Mission', 'educenter'),
                    'slider_desc' => __('Lorem ipsum dolor sit amet, consectetur adipisicing elit. Velit labore mollitia, aliquam nisi neque perspiciatis expedita, nulla deleniti…', 'educenter'),
                    'button_text' => __('Admision Open', 'educenter'),
                    'button_url' => '#'
                ),
            )),

            // parent theme 
            'educenter_fservices_area_options' => 1,
            'educenter_homepage_service_type' => 'advance',
            'educenter_fservices_section_title' => __('Our Featured Courses', 'educenter'),
            'educenter_fservices_section_subtitle' => __('Lorem ipsum dolor sit amet, consectetur adipisicing elit. Velit labore mollitia, aliquam nisi neque perspiciatis expedita, nulla deleniti…', 'educenter'),
            'educenter_fservices_area_settings_advance' => json_encode( array(
                array(
                      'services_icon' => 'fas fa-female',
                      'title' => __('Fashion','educenter') ,
                      'link' => '#',
                ),
                
                array(
                      'services_icon' => 'fas fa-volume-up',
                      'title' => __('Music','educenter') ,
                      'link' => '#',
                ),
                
                array(
                      'services_icon' => 'fa fa-plane',
                      'title' => __('Travel','educenter') ,
                      'link' => '#',
                ))
            ),        

            /** child theme xpert */
            'education_xpert_feature_services_type' => 'advance',
            'education_xpert_feature_services_area_settings_advance' => json_encode( array(
                array(
                      'services_icon' => 'fas fa-female',
                      'title' => __('Fashion Courses','educenter') ,
                      'description' => __('Lorem ipsum dolor sit amet, consectetur adipisicing elit. Velit labore mollitia, aliquam nisi neque perspiciatis expedita, nulla deleniti…', 'educenter'),
                ),
                
                array(
                      'services_icon' => 'fas fa-volume-up',
                      'title' => __('Music & Art','educenter') ,
                      'description' => __('Lorem ipsum dolor sit amet, consectetur adipisicing elit. Velit labore mollitia, aliquam nisi neque perspiciatis expedita, nulla deleniti…', 'educenter'),
                ),
                
                array(
                      'services_icon' => 'fa fa-plane',
                      'title' => __('Travel & Tourism','educenter') ,
                      'description' => __('Lorem ipsum dolor sit amet, consectetur adipisicing elit. Velit labore mollitia, aliquam nisi neque perspiciatis expedita, nulla deleniti…', 'educenter'),
                ))),        
            /** child theme xpert */

            'educenter_aboutus_section_area_options' => false,
            'educenter_services_area_options' => false,
            'educenter_courses_section_area_options' => false,
            'educenter_gallery_area_options' => false,

            'educenter_counter_bg_image' => get_template_directory_uri(  ). '/assets/images/default/bg6.jpg',
            'educenter_counter_area_settings' => json_encode( array(
                array(
                      'counter_icon' => 'fab fa-gitter',
                      'counter_number' => '988877',
                      'counter_title' => __('Shield', 'educenter') 
                ),
                array(
                      'counter_icon' => 'fa fa-trophy',
                      'counter_number' => '10908',
                      'counter_title' => __('Trophies', 'educenter') 
                ),
                array(
                      'counter_icon' => 'fa fa-desktop',
                      'counter_number' => '8272',
                      'counter_title' => __('Online', 'educenter') 
                ),
                array(
                      'counter_icon' => 'fa fa-star',
                      'counter_number' => '123000',
                      'counter_title' => __('Passed', 'educenter') 
                ),

            ) ),

            
            'educenter_team_area_options' => false,
            'educenter_testimonial_area_options' => false,
            'educenter_blog_area_term_id' => '1',



        ),

        
    ));
}
add_action( 'after_setup_theme', 'educenter_starter_content_setup' );