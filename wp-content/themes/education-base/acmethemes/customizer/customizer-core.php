<?php
/**
 * Top Header Design Options
 *
 * @since Education Base 1.0.0
 *
 * @param null
 * @return array $education_base_top_header_design_options
 *
 */
if ( !function_exists('education_base_top_header_design_options') ) :
    function education_base_top_header_design_options() {
        $education_base_top_header_design_options =  array(
            'normal' => __( 'Normal', 'education-base' ),
            'left-curve' => __( 'Left Curve', 'education-base' )
        );
        return apply_filters( 'education_base_top_header_design_options', $education_base_top_header_design_options );
    }
endif;

/**
 * Featured Slider Number
 *
 * @since Education Base 1.0.0
 *
 * @param null
 * @return array $education_base_featured_slider_number
 *
 */
if ( !function_exists('education_base_featured_slider_number') ) :
    function education_base_featured_slider_number() {
        $education_base_featured_slider_number =  array(
            1 => __( '1', 'education-base' ),
            2 => __( '2', 'education-base' ),
            3 => __( '3', 'education-base' )
        );
        return apply_filters( 'education_base_featured_slider_number', $education_base_featured_slider_number );
    }
endif;

/**
 * Featured Slider Image Options
 *
 * @since Education Base 1.0.0
 *
 * @param null
 * @return array $education_base_fs_image_display_options
 *
 */
if ( !function_exists('education_base_fs_image_display_options') ) :
    function education_base_fs_image_display_options() {
        $education_base_fs_image_display_options =  array(
            'full-screen-bg' => __( 'Full Screen Background', 'education-base' ),
            'responsive-img' => __( 'Responsive Image', 'education-base' )
        );
        return apply_filters( 'education_base_fs_image_display_options', $education_base_fs_image_display_options );
    }
endif;

/**
 * Header logo/text display options alternative
 *
 * @since Education Base 1.0.0
 *
 * @param null
 * @return array $education_base_header_id_display_opt
 *
 */
if ( !function_exists('education_base_header_id_display_opt') ) :
    function education_base_header_id_display_opt() {
        $education_base_header_id_display_opt =  array(
            'logo-only' => __( 'Logo Only ( First Select Logo Above )', 'education-base' ),
            'title-only' => __( 'Site Title Only', 'education-base' ),
            'title-and-tagline' =>  __( 'Site Title and Tagline', 'education-base' ),
            'disable' => __( 'Disable', 'education-base' )
        );
        return apply_filters( 'education_base_header_id_display_opt', $education_base_header_id_display_opt );
    }
endif;

/**
 * Sidebar layout options
 *
 * @since Education Base 1.0.0
 *
 * @param null
 * @return array $education_base_sidebar_layout
 *
 */
if ( !function_exists('education_base_sidebar_layout') ) :
    function education_base_sidebar_layout() {
        $education_base_sidebar_layout =  array(
	        'right-sidebar' => __( 'Right Sidebar', 'education-base' ),
	        'left-sidebar'  => __( 'Left Sidebar' , 'education-base' ),
	        'both-sidebar'  => __( 'Both Sidebar' , 'education-base' ),
	        'middle-col'  => __( 'Middle Column' , 'education-base' ),
	        'no-sidebar'    => __( 'No Sidebar', 'education-base' )
        );
        return apply_filters( 'education_base_sidebar_layout', $education_base_sidebar_layout );
    }
endif;

/**
 * Blog layout options
 *
 * @since Education Base 1.0.0
 *
 * @param null
 * @return array $education_base_blog_layout
 *
 */
if ( !function_exists('education_base_blog_layout') ) :
    function education_base_blog_layout() {
        $education_base_blog_layout =  array(
            'left-image' => __( 'Show Image', 'education-base' ),
            'no-image' => __( 'No Image', 'education-base' )
        );
        return apply_filters( 'education_base_blog_layout', $education_base_blog_layout );
    }
endif;

function education_base_update_slider_logic() {
	if( !is_admin() ){
		return false;
	}
	$education_base_get_theme_options = education_base_get_theme_options();
	$education_base_enable_feature = $education_base_get_theme_options['education-base-enable-feature'];
	$education_base_feature_page = $education_base_get_theme_options['education-base-feature-page'];
	$education_base_featured_slider_number = $education_base_get_theme_options['education-base-featured-slider-number'];
	if( 1 == $education_base_enable_feature ){
		if( 0 != $education_base_feature_page ){
			$page_ids = array();
			$education_base_child_page_args = array(
				'post_parent'         => $education_base_feature_page,
				'posts_per_page'      => $education_base_featured_slider_number,
				'post_type'           => 'page',
				'no_found_rows'       => true,
				'post_status'         => 'publish'
			);
			$slider_query = new WP_Query( $education_base_child_page_args );
			if ( !$slider_query->have_posts() ){
				$education_base_child_page_args = array(
					'page_id'         => $education_base_feature_page,
					'posts_per_page'      => 1,
					'post_type'           => 'page',
					'no_found_rows'       => true,
					'post_status'         => 'publish'
				);
				$slider_query = new WP_Query( $education_base_child_page_args );
			}
			/*The Loop*/
			if ( $slider_query->have_posts() ):
				while( $slider_query->have_posts() ):$slider_query->the_post();
					$page_ids[]['selectpage'] = absint(get_the_ID());
				endwhile;
			endif;
			wp_reset_postdata();
			$education_base_get_theme_options['education-base-all-slides'] = json_encode( $page_ids );
			$education_base_get_theme_options['education-base-feature-page'] = 0;
			set_theme_mod( 'education_base_theme_options', $education_base_get_theme_options );
		}
	}
}
add_action( 'after_setup_theme', 'education_base_update_slider_logic' );