<?php
/**
 * Sample implementation of the Custom Header feature.
 *
 * You can add an optional custom header image to header.php like so ...
 *
	<?php if ( get_header_image() ) : ?>
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
		<img src="<?php header_image(); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="">
	</a>
	<?php endif; // End header image check. ?>
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package Education Base
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses education_base_header_style()
 */
function education_base_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'education_base_custom_header_args', array(
		'default-image'      => get_template_directory_uri() . '/assets/img/university.jpg',
		'width'              => 1920,
		'height'             => 1280,
		'flex-height'        => true,
		'flex-width'         => true,
		'header-text'        => false
	) ) );
	register_default_headers( array(
		'default-image' => array(
			'url'           => '%s/assets/img/university.jpg',
			'thumbnail_url' => '%s/assets/img/university.jpg',
			'description'   => __( 'Default Header Image', 'education-base' ),
		),
	) );
}
add_action( 'after_setup_theme', 'education_base_custom_header_setup' );