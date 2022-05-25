<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Acme Themes
 * @subpackage Education Base
 */

/**
 * education_base_action_before_head hook
 * @since Education Base 1.0.0
 *
 * @hooked education_base_set_global -  0
 * @hooked education_base_doctype -  10
 */

do_action( 'education_base_action_before_head' );?>
	<head>

		<?php
		/**
		 * education_base_action_before_wp_head hook
		 * @since Education Base 1.0.0
		 *
		 * @hooked education_base_before_wp_head -  10
		 */
		do_action( 'education_base_action_before_wp_head' );

		wp_head();
		?>

	</head>
<body <?php body_class();?>>

<?php
/**
 * WordPress Default Hook
 * Triggered after the opening <body> tag.
 * wp_body_open hook
 *
 * @since WordPress 5.2
 *
 */
do_action( 'wp_body_open' );
/**
 * education_base_action_before hook
 * @since Education Base 1.0.0
 *
 * @hooked education_base_site_start - 20
 */
do_action( 'education_base_action_before' );

/**
 * education_base_action_before_header hook
 * @since Education Base 1.0.0
 *
 * @hooked education_base_skip_to_content - 10
 */
do_action( 'education_base_action_before_header' );

/**
 * education_base_action_header hook
 * @since Education Base 1.0.0
 *
 * @hooked education_base_header - 10
 */
do_action( 'education_base_action_header' );

/**
 * education_base_action_after_header hook
 * @since Education Base 1.0.0
 *
 * @hooked null
 */
do_action( 'education_base_action_after_header' );

/**
 * education_base_action_before_content hook
 * @since Education Base 1.0.0
 *
 * @hooked null
 */
do_action( 'education_base_action_before_content' );