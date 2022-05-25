<?php
/**
 * Main include functions ( to support child theme ) that child theme can override file too
 *
 * @since Education Base 1.0.0
 *
 * @param string $file_path, path from the theme
 * @return string full path of file inside theme
 *
 */
if( !function_exists('education_base_file_directory') ){

    function education_base_file_directory( $file_path ){
        if( file_exists( trailingslashit( get_stylesheet_directory() ) . $file_path) ) {
            return trailingslashit( get_stylesheet_directory() ) . $file_path;
        }
        else{
            return trailingslashit( get_template_directory() ) . $file_path;
        }
    }
}

/**
 * Check empty or null
 *
 * @since  Education Base 1.0.0
 *
 * @param string $str, string
 * @return boolean
 *
 */
if( !function_exists('education_base_is_null_or_empty') ){
    function education_base_is_null_or_empty( $str ){
        return ( !isset($str) || trim($str)==='' );
    }
}

/*file for library*/
require education_base_file_directory('acmethemes/library/tgm/class-tgm-plugin-activation.php');

/*
* file for customizer theme options
*/
require education_base_file_directory('acmethemes/customizer/customizer.php');

/*
* file for additional functions files
*/
require education_base_file_directory('acmethemes/functions.php');

require education_base_file_directory('acmethemes/functions/sidebar-selection.php');


/*woocommerce*/
require education_base_file_directory('acmethemes/woocommerce/functions-woocommerce.php');

require education_base_file_directory('acmethemes/woocommerce/class-woocommerce.php');

/*
* files for hooks
*/
require education_base_file_directory('acmethemes/hooks/tgm.php');

require education_base_file_directory('acmethemes/hooks/front-page.php');

require education_base_file_directory('acmethemes/hooks/slider-selection.php');

require education_base_file_directory('acmethemes/hooks/feature-columns.php');

require education_base_file_directory('acmethemes/hooks/header.php');

require education_base_file_directory('acmethemes/hooks/social-links.php');

require education_base_file_directory('acmethemes/hooks/dynamic-css.php');

require education_base_file_directory('acmethemes/hooks/footer.php');

require education_base_file_directory('acmethemes/hooks/comment-forms.php');

require education_base_file_directory('acmethemes/hooks/excerpts.php');

require education_base_file_directory('acmethemes/hooks/siteorigin-panels.php');

require education_base_file_directory('acmethemes/hooks/acme-demo-setup.php');

/*
* file for sidebar and widgets
*/
require education_base_file_directory('acmethemes/sidebar-widget/acme-course.php');

require education_base_file_directory('acmethemes/sidebar-widget/acme-contact.php');

require education_base_file_directory('acmethemes/sidebar-widget/acme-gallery.php');

require education_base_file_directory('acmethemes/sidebar-widget/acme-about.php');

require education_base_file_directory('acmethemes/sidebar-widget/acme-featured-page.php');

require education_base_file_directory('acmethemes/sidebar-widget/acme-col-posts.php');

require education_base_file_directory('acmethemes/sidebar-widget/acme-team.php');

require education_base_file_directory('acmethemes/sidebar-widget/acme-testimonial.php');

require education_base_file_directory('acmethemes/sidebar-widget/sidebar.php');

/*file for metaboxes*/
require education_base_file_directory('acmethemes/metabox/metabox.php');

require education_base_file_directory('acmethemes/metabox/metabox-defaults.php');

/*
* file for core functions imported from functions.php while downloading Underscores
*/
require education_base_file_directory('acmethemes/core.php');
require education_base_file_directory('acmethemes/gutenberg/gutenberg-init.php');


/**
 * Theme options page.
 */
if ( is_admin() ) {
    require_once education_base_file_directory('acmethemes/at-theme-info/class-at-theme-info.php');
    require_once education_base_file_directory('acmethemes/admin-notice/class-admin-notice-handler.php');
}