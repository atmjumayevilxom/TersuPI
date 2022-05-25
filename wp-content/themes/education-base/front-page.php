<?php
/**
 * The front-page template file.
 *
 * @package AcmeThemes
 * @subpackage Education Base
 * @since Education Base 1.1.0
 */
get_header();

/**
 * education_base_action_front_page hook
 * @since Education Base 1.1.0
 *
 * @hooked education_base_featured_slider -  10
 * @hooked education_base_front_page -  20
 */

do_action( 'education_base_action_front_page' ); 

get_footer();