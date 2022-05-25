<?php
/**
 * Educenter functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Educenter
 */

if ( ! function_exists( 'educenter_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function educenter_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Educenter, use a find and replace
		 * to change 'educenter' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'educenter', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * This theme styles the visual editor to resemble the theme style.
		*/
		add_editor_style( array( 'assets/css/editor-style.css', educenter_fonts_url() ) );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		add_image_size('educenter-slider', 1320, 600, true);   // Main Banner Slider
		add_image_size('educenter-large', 840, 450, true);
		add_image_size('educenter-gallery', 400, 290, true);
		add_image_size('educenter-team', 400, 510, true);

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'educenter' ),
			'menu-2' => esc_html__( 'Footer Menu', 'educenter' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'educenter_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );

		/**
		 * Header Default image
		 */
		add_theme_support( 'custom-header', array(
			'default-image'      => get_template_directory_uri(  ). '/assets/images/default/pexels-photo-820823.jpeg',
		) );
	}
endif;
add_action( 'after_setup_theme', 'educenter_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function educenter_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'educenter_content_width', 640 );
}
add_action( 'after_setup_theme', 'educenter_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function educenter_widgets_init() {

	register_sidebar( array(
		'name'          => esc_html__( 'Right Sidebar Widget Area', 'educenter' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'educenter' ),
		'before_widget' => '<div id="%1$s" class="widget ed-col %2$s"><div class="ed-col-wrapper">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<div class="widget-ed-title"><h2 class="widget-title">',
		'after_title'   => '</h2></div>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Left Sidebar Widget Area', 'educenter' ),
		'id'            => 'sidebar-2',
		'description'   => esc_html__( 'Add widgets here.', 'educenter' ),
		'before_widget' => '<div id="%1$s" class="widget ed-col %2$s"><div class="ed-col-wrapper">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<div class="widget-ed-title"><h2 class="widget-title">',
		'after_title'   => '</h2></div>',
	) );


	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widget Area', 'educenter' ),
		'id'            => 'footer-1',
		'description'   => esc_html__( 'Add widgets here footer widget', 'educenter' ),
		'before_widget' => '<div id="%1$s" class="widget ed-col %2$s"><div class="ed-col-wrapper">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<div class="widget-ed-title"><h2 class="widget-title">',
		'after_title'   => '</h2></div>',
	) );

	if ( class_exists( 'TP_Event' ) || class_exists( 'WPEMS' ) ) {
		register_sidebar(
			array(
				'name'          => esc_html__( 'Sidebar Events', 'educenter' ),
				'id'            => 'sidebar_events',
				'description'   => esc_html__( 'Sidebar Events', 'educenter' ),
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h4 class="widget-title">',
				'after_title'   => '</h4>',
			)
		);
	}

}
add_action( 'widgets_init', 'educenter_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function educenter_scripts() {

	$min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

	$fonts_url = educenter_fonts_url();

	if ( ! empty( $fonts_url ) ) {

		wp_enqueue_style( 'educenter-fonts', $fonts_url, array(), null );

	}

	/**
	 * Load Font Awesome CSS Library File
	*/
	wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/assets/library/fontawesome/css/all' . $min . '.css' );

	/**
	 * Load Lightslider CSS Library File
	*/
	wp_enqueue_style( 'lightslider', get_template_directory_uri() . '/assets/library/lightslider/css/lightslider' . $min . '.css' );
	
	/**
	 * Pretty Photo CSS Library File
	*/
	wp_enqueue_style( 'prettyPhoto', get_template_directory_uri() . '/assets/library/prettyphoto/css/prettyPhoto.css' );

	/**
	 * Load Theme Main CSS Library File
	*/
	wp_enqueue_style( 'educenter-style', get_stylesheet_uri() );

	if ( has_header_image() ) {
		$custom_css = '.ed-breadcrumb, .lp-archive-courses #learn-press-course.course-summary .course-summary-content .course-detail-info{ background-image: url("' . esc_url( get_header_image() ) . '"); background-repeat: no-repeat; background-position: center center; background-size: cover; }';
		wp_add_inline_style( 'educenter-style', $custom_css );
	}

	/**
	 * Load Animate CSS Library File
	*/
	wp_enqueue_style( 'educenter-responsive', get_template_directory_uri() . '/assets/css/responsive.css' );



	if ( has_header_image() ) {
		$custom_css = '#breadcrumbs{ background-image: url("' . esc_url( get_header_image() ) . '"); background-repeat: no-repeat; background-position: center center; background-size: cover; }';
		wp_add_inline_style( 'educenter-style', $custom_css );
	}
	
	
	/**
	 * Load HTML5 Library File
	*/
    wp_enqueue_script('html5', get_template_directory_uri() . '/assets/library/html5shiv/html5shiv' . $min . '.js', array('jquery'), '3.7.3', false);
    wp_script_add_data( 'html5', 'conditional', 'lt IE 9' );

    /**
     * Load Respond Library File
    */
    wp_enqueue_script('respond', get_template_directory_uri() . '/assets/library/respond/respond' . $min . '.js', array('jquery'), '1.0.0', false);
    wp_script_add_data( 'respond', 'conditional', 'lt IE 9' );

    /**
     * Load Lightslider JavScript Library File
    */
    wp_enqueue_script('lightslider', get_template_directory_uri() . '/assets/library/lightslider/js/lightslider' . $min . '.js', array('jquery'), '1.1.6', true );

    /**
     * Load Waypoints JavScript Library File
    */
    wp_enqueue_script('jquery-waypoints', get_template_directory_uri() . '/assets/library/waypoints/jquery.waypoints' . $min . '.js', array('jquery'), '4.0.0', true );

    wp_enqueue_script( 'odometer', get_template_directory_uri() . '/assets/js/odometer.js', array('jquery'), '1.0.0', true );

    /**
     * Load PrettyPhoto JavaScript File 
    */
    wp_enqueue_script('jquery-prettyPhoto', get_template_directory_uri() . '/assets/library/prettyphoto/js/jquery.prettyPhoto.js', array(), '3.1.6', true);

    /**
	 * Load Sticky Library File
	*/
	wp_enqueue_script( 'jquery-sticky', get_template_directory_uri() . '/assets/library/sticky/jquery.sticky.js', '1.0.4', true );

	/**
     * Load Theia Sticky Sidebar Library File
    */
    wp_enqueue_script('theia-sticky-sidebar', get_template_directory_uri() . '/assets/library/theia-sticky-sidebar/js/theia-sticky-sidebar' . $min . '.js', array('jquery'), '1.6.0', true );


    /**
	 * Load Default JavaScript Library File
	*/
	// wp_enqueue_script( 'educenter-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'educenter-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), '20151215', true );

	/**
	 * Load Custom Themes JavaScript Library File
	*/
	wp_enqueue_script( 'educenter-custom', get_template_directory_uri() . '/assets/js/educenter-custom.js', array('jquery'), '20151215', true );


	$headersticky = get_theme_mod( 'educenter_main_header_sticky', 0 );

	$sidebarstick = get_theme_mod( 'educenter_sidebar_sticky', 1 );

	wp_localize_script('educenter-custom', 'educenter_ajax_script', array(
        'headersticky' => $headersticky,
        'sidebarstick' => $sidebarstick
    ));

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

}
add_action( 'wp_enqueue_scripts', 'educenter_scripts' );



if ( ! function_exists( 'educenter_admin_scripts' ) ) {

	/**
	 * Admin Enqueue scripts and styles.
	*/

    function educenter_admin_scripts( $hook ) {

        wp_enqueue_script('educenter-admin-script', get_template_directory_uri() . '/assets/js/educenter-admin.js', array( 'jquery', 'jquery-ui-sortable', 'customize-controls' ) );

        wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/assets/library/fontawesome/css/all.min.css' );

        wp_enqueue_style( 'educenter-admin-style', get_template_directory_uri() . '/assets/css/educenter-admin.css');    
    }

}
add_action('admin_enqueue_scripts', 'educenter_admin_scripts');
if(!function_exists('educenter_customizer_control_js')){
	function educenter_customizer_control_js(){
		wp_enqueue_script('educenter-customizer-control-script', get_template_directory_uri() . '/assets/js/educenter-customizer-control.js', array( 'jquery', 'customize-controls' ) );
	}
}
add_action( 'customize_controls_enqueue_scripts', 'educenter_customizer_control_js' );



/**
 * Fully Translation ready Multilingual Compatible with Polylang and WPML plugins.
*/

if( function_exists( 'pll_register_string' ) ){

	// Features Services Section
	pll_register_string( 'features_service_title', get_theme_mod('educenter_fservices_section_title'), 'Educenter', true );
	pll_register_string( 'features_service_subtitle', get_theme_mod('educenter_fservices_section_subtitle'), 'Educenter', true );

	// Aboutus Section
	pll_register_string( 'aboutus_title', get_theme_mod('educenter_aboutus_main_title'), 'Educenter', true );
	pll_register_string( 'aboutus_subtitle', get_theme_mod('educenter_aboutus_main_subtitle'), 'Educenter', true );

	// CTA Section
	pll_register_string( 'cta_button_text', get_theme_mod('educenter_cta_button_text'), 'Educenter', true );
	pll_register_string( 'cta_button_one_text', get_theme_mod('educenter_cta_button_one_text'), 'Educenter', true );

	// Courses Section
	pll_register_string( 'courses_section_title', get_theme_mod('educenter_courses_section_title'), 'Educenter', true );
	pll_register_string( 'courses_section_subtitle', get_theme_mod('educenter_courses_section_subtitle'), 'Educenter', true );

	// Main Courses Section
	pll_register_string( 'main_courses_section_title', get_theme_mod('educenter_services_main_title'), 'Educenter', true );
	pll_register_string( 'main_courses_section_subtitle', get_theme_mod('educenter_services_main_subtitle'), 'Educenter', true );

	// Gallery Section
	pll_register_string( 'gallery_section_title', get_theme_mod('educenter_gallery_section_title'), 'Educenter', true );
	pll_register_string( 'gallery_section_subtitle', get_theme_mod('educenter_gallery_section_subtitle'), 'Educenter', true );

	// Counter Section
	pll_register_string( 'counter_section_title', get_theme_mod('educenter_counter_section_title'), 'Educenter', true );
	pll_register_string( 'counter_section_subtitle', get_theme_mod('educenter_counter_section_subtitle'), 'Educenter', true );

	// Team Section
	pll_register_string( 'team_area_title', get_theme_mod('educenter_team_area_title'), 'Educenter', true );
	pll_register_string( 'team_area_subtitle', get_theme_mod('educenter_team_area_subtitle'), 'Educenter', true );

	// Testimonial Section
	pll_register_string( 'testimonial_title', get_theme_mod('educenter_testimonial_title'), 'Educenter', true );
	pll_register_string( 'testimonial_subtitle', get_theme_mod('educenter_testimonial_subtitle'), 'Educenter', true );

	// Blog Section
	pll_register_string( 'blog_title', get_theme_mod('educenter_blog_title'), 'Educenter', true );
	pll_register_string( 'blog_subtitle', get_theme_mod('educenter_blog_subtitle'), 'Educenter', true );

}


/**
 * Require init.
*/
require  trailingslashit( get_template_directory() ).'sparklethemes/init.php';

/** remove widgets block editor */
function educenter_widget_theme_support() {
    remove_theme_support( 'widgets-block-editor' );
}
add_action( 'after_setup_theme', 'educenter_widget_theme_support' );

/** theme breadcrumb */
if(class_exists('LearnPress')){
    remove_action( 'learn-press/before-main-content', LP()->template( 'general' )->func( 'breadcrumb' ) );
    add_action( 'learn-press/before-main-content', function(){
        do_action( 'educenter_add_breadcrumb', 10 );
    } );
}