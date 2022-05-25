<?php
/**
 * Education Base functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Acme Themes
 * @subpackage Education Base
 */


/**
 *  Default Theme layout options
 *
 * @since Education Base 1.0.0
 *
 * @param null
 * @return array $education_base_theme_layout
 *
 */
if ( !function_exists('education_base_get_default_theme_options') ) :
    function education_base_get_default_theme_options() {

        $default_theme_options = array(
            /*header*/
            'education-base-enable-header-top'  => '',
            'education-base-header-height'  => 300,
            'education-base-top-header-design-options'  => 'left-curve',
            'education-base-phone-number'  => '',
            'education-base-top-email'  => '',
            'education-base-newsnotice-title'  => __( 'News', 'education-base' ),
            'education-base-newsnotice-cat'  => 0,
            'education-base-button-title'  => __( 'Apply Now', 'education-base' ),
            'education-base-button-link'  => '',
            'education-base-enable-top-social'  => '',
            'education-base-enable-sticky'  => 1,

            /*feature section options*/
            'education-base-all-slides'  => '',
            'education-base-feature-page'  => 0,
            'education-base-featured-slider-number'  => 2,
            'education-base-feature-column-1'  => 0,
            'education-base-feature-column-2'  => 0,
            'education-base-feature-column-3'  => 0,
            'education-base-feature-column-1-color'  => '#87cc00',
            'education-base-feature-column-2-color'  => '#fd5308',
            'education-base-feature-column-3-color'  => '#00adef',
            'education-base-enable-feature'  => '',
            'education-base-feature-slider-enable-animation'  => 1,
            'education-base-feature-slider-image-only'  => '',
            'education-base-fs-image-display-options'  => 'full-screen-bg',
            'education-base-slider-know-more-text'  => __( "Know More", "education-base" ),

            /*header options*/
            'education-base-header-id-display-opt' => 'title-and-tagline',
            'education-base-facebook-url'  => '',
            'education-base-twitter-url'  => '',
            'education-base-youtube-url'  => '',
            'education-base-google-plus-url'  => '',
            'education-base-enable-social'  => '',

            /*footer options*/
            'education-base-footer-copyright'  => __( '&copy; All right reserved 2016', 'education-base' ),

            /*layout/design options*/
            'education-base-sidebar-layout'  => 'right-sidebar',
            'education-base-front-page-sidebar-layout'  => 'right-sidebar',
            'education-base-archive-sidebar-layout'  => 'right-sidebar',

            'education-base-blog-archive-layout'  => 'left-image',
            'education-base-enable-animation'  => '',

            'education-base-primary-color'  => '#fd5308',
            'education-base-header-top-color'  => '#002858',
            'education-base-footer-color'  => '#003a6a',
            'education-base-footer-bottom-color'  => '#002858',

            'education-base-blog-archive-more-text'  => __( 'Read More', 'education-base' ),

            'education-base-hide-front-page-content'  => '',
            'education-base-hide-front-page-header'  => '',

            'education-base-disable-widget-title-icon'  => '',
            'education-base-widget-title-icon'  => 'fa-graduation-cap',

            /*woocommerce*/
            'education-base-wc-shop-archive-sidebar-layout'     => 'no-sidebar',
            'education-base-wc-product-column-number'           => 4,
            'education-base-wc-shop-archive-total-product'      => 16,
            'education-base-wc-single-product-sidebar-layout'   => 'no-sidebar',

            /*theme options*/
            'education-base-search-placholder'  => __( 'Search', 'education-base' ),
            'education-base-store-title'  => __( 'Store', 'education-base' ),
            'education-base-show-breadcrumb'  => 0
        );
        return apply_filters( 'education_base_default_theme_options', $default_theme_options );
    }
endif;

/**
 *  Get theme options
 *
 * @since Education Base 1.0.0
 *
 * @param null
 * @return array education_base_theme_options
 *
 */
if ( !function_exists('education_base_get_theme_options') ) :
    function education_base_get_theme_options() {

        $education_base_default_theme_options = education_base_get_default_theme_options();
        $education_base_get_theme_options = get_theme_mod( 'education_base_theme_options');
        if( is_array( $education_base_get_theme_options )){
            return array_merge( $education_base_default_theme_options ,$education_base_get_theme_options );
        }
        else{
            return $education_base_default_theme_options;
        }
    }
endif;

$education_base_saved_theme_options = education_base_get_theme_options();
$GLOBALS['education_base_customizer_all_values'] = $education_base_saved_theme_options;

/**
 * Require init.
 */
require trailingslashit( get_template_directory() ).'acmethemes/init.php';