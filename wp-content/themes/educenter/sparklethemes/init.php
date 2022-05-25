<?php
/**
 * Main Custom admin functions area
 *
 * @since SparklewpThemes
 *
 * @param Educenter
 *
*/


/**
 * Load Custom Admin functions that act independently of the theme functions.
*/
require get_theme_file_path('sparklethemes/functions.php');

/**
 * Custom functions that act independently of the theme header.
*/
require get_theme_file_path('sparklethemes/core/custom-header.php');

/**
 * Custom functions that act independently of the theme templates.
*/
require get_theme_file_path('sparklethemes/core/template-functions.php');

/**
 * Custom template tags for this theme.
*/
require get_theme_file_path('sparklethemes/core/template-tags.php');

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {

   require get_theme_file_path('sparklethemes/core/jetpack.php');

}

/**
 * Customizer additions.
*/
require get_theme_file_path('sparklethemes/customizer/customizer.php');

/**
 * Load widget all section file.
*/
require get_theme_file_path('section/educenter-section.php');

/**
 * Load Header Hook File.
*/
require get_theme_file_path('sparklethemes/hooks/header.php');

/**
 * Load Footer Hook File.
*/
require get_theme_file_path('sparklethemes/hooks/footer.php');

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {

    require get_theme_file_path('sparklethemes/core/woocommerce.php');

}

/**
 * Dunamic CSS Color Options file.
*/
require get_theme_file_path('sparklethemes/dynamic-css.php');

/**
 * Load Admin Welcome Page.
 */
if ( is_admin() ) {

	require get_template_directory() . '/welcome/welcome.php';

}

/**
 * Load in customizer upgrade to pro
*/
require get_theme_file_path('sparklethemes/customizer/customizer-pro/class-customize.php');

/**
 * Mobile Menu
 */
require get_theme_file_path('sparklethemes/mobile-menu/init.php');
require get_theme_file_path('sparklethemes/starter-content.php');

if ( class_exists( 'TP_Event' ) || class_exists( 'WPEMS' ) ) {
    require get_theme_file_path('sparklethemes/wp-event-manager-functions.php');
}