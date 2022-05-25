<?php
/**
 * Front page hook for all WordPress Conditions
 *
 * @since Education Base 1.0.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'education_base_featured_slider' ) ) :

    function education_base_featured_slider() {
        global $education_base_customizer_all_values;

        $education_base_enable_feature = $education_base_customizer_all_values['education-base-enable-feature'];
        if( is_front_page() && 1 == $education_base_enable_feature && !is_home() ) :
            do_action( 'education_base_action_feature_slider' );
        endif;
    }
endif;
add_action( 'education_base_action_front_page', 'education_base_featured_slider', 10 );

if ( ! function_exists( 'education_base_front_page' ) ) :

    function education_base_front_page() {
        global $education_base_customizer_all_values;

        $education_base_hide_front_page_content = $education_base_customizer_all_values['education-base-hide-front-page-content'];

        /*show widget in front page, now user are not force to use front page*/
        if( is_active_sidebar( 'education-base-home' ) && !is_home() ){
            dynamic_sidebar( 'education-base-home' );
        }
        if ( 'posts' == get_option( 'show_on_front' ) ) {
            include( get_home_template() );
        }
        else {
            if( 1 != $education_base_hide_front_page_content ){
                include( get_page_template() );
            }
        }
    }

endif;
add_action( 'education_base_action_front_page', 'education_base_front_page', 20 );

