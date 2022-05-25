<?php
/**
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Educenter
 */
get_header(); ?>


<?php
	
	/**
	 * Load Front Page
	 */
	do_action( 'educenter_frontpage' );

	$educenter_frontpage = get_theme_mod( 'educenter_set_frontpage' ,false);

	if( $educenter_frontpage == 1 ){
		if( wp_get_theme() != 'Hello Education' ){
			/**
			 * Main Banner/Slider Section
			 *
			 * @see educenter_banner_section() -- 5
			 *
			*/
			do_action( 'educenter_action_front_page' );
		}

		
		$educenter_home_section_order = educenter_homepage_section();
		
		foreach ( $educenter_home_section_order  as $key => $value ) {  
			switch($value):
			case 'features':
			case 'educenter_fservices_settings':
				/**
				 * Features Services Section
				 *
				 * @see educenter_features_services_section() -- 10
				 *
				*/
				do_action( 'educenter_fservices', 10 );
				break;
			case 'aboutus':
			case 'educenter_aboutus_settings':

				/**
				 * AboutUs Services Section
				 *
				 * @see educenter_aboutus_section() -- 15
				 *
				*/
				do_action( 'educenter_aboutus', 15 );
				break;
			case 'cta':
			case 'educenter_cta_settings':

				/**
				 * Call To Action Section
				 *
				 * @see educenter_calltoaction_section() -- 20
				 *
				*/
				do_action( 'educenter_calltoaction', 20 );
				break;
			case 'services':
			case 'educenter_services_settings':

				/**
				 * Services Section
				 *
				 * @see educenter_services_section() -- 25
				 *
				*/
				do_action( 'educenter_services', 25 );
				break;
			case 'counter':
			case 'educenter_counter_settings':
				/**
				 * Counter Section
				 *
				 * @see educenter_counter_section() -- 30
				 *
				*/
				do_action( 'educenter_counter', 30 );
				break;
			case 'courses':
			case 'educenter_courses_settings':

				/**
				 * Courses Section
				 *
				 * @see educenter_courses_section() -- 35
				 *
				*/
				do_action( 'educenter_courses', 35 );
				break;
			case 'ourblog':
			case 'educenter_blog_settings':
				/**
				 * Our Blog Section
				 *
				 * @see educenter_blog_section() -- 40
				 *
				*/
				do_action( 'educenter_blog', 40 );
				break;
			case 'ourteam':
			case 'educenter_team_settings':

				/**
				 * Our Team Member Section
				 *
				 * @see educenter_ourteam_section() -- 40
				 *
				*/
				do_action( 'educenter_ourteam', 45 );
				break;
			case 'gallery':
			case 'educenter_gallery_settings':

				/**
				 * Gallery Section
				 *
				 * @see educenter_gallery_section() -- 40
				 *
				*/
				do_action( 'educenter_gallery', 50 );
				break;
			case 'testimonial':
			case 'educenter_testimonial_settings':

				/**
				 * Our Testimonials Section
				 *
				 * @see educenter_testimonials_section() -- 40
				 *
				*/
				do_action( 'educenter_testimonials', 55 );
				break;
			case 'educenter_events_settings':

				/**
				 * Our Testimonials Section
				 *
				 * @see educenter_testimonials_section() -- 40
				 *
				*/
				do_action( 'educenter_wp_events', 55 );
				break;

			endswitch;

		}//endforeach about section reorder

	}


get_footer();