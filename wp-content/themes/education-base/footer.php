<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Acme Themes
 * @subpackage Education Base
 */

/**
 * education_base_action_after_content hook
 * @since Education Base 1.0.0
 *
 * @hooked null
 */
do_action( 'education_base_action_after_content' );

/**
 * education_base_action_before_footer hook
 * @since Education Base 1.0.0
 *
 * @hooked null
 */
do_action( 'education_base_action_before_footer' );

/**
 * education_base_action_footer hook
 * @since Education Base 1.0.0
 *
 * @hooked education_base_footer - 10
 */
do_action( 'education_base_action_footer' );

/**
 * education_base_action_after_footer hook
 * @since Education Base 1.0.0
 *
 * @hooked null
 */
do_action( 'education_base_action_after_footer' );

/**
 * education_base_action_after hook
 * @since Education Base 1.0.0
 *
 * @hooked education_base_page_end - 10
 */
do_action( 'education_base_action_after' ); 

wp_footer();
?>
</body>
</html>