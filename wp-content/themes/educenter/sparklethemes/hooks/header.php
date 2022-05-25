<?php
/**
 * Header Section Skip Area
*/
if ( ! function_exists( 'educenter_skip_links' ) ) {
	/**
	 * Skip links
	 * @since  1.0.0
	 */
	function educenter_skip_links() { ?>
			<a class="skip-link screen-reader-text" href="#content">
				<?php esc_html_e( 'Skip to content', 'educenter' ); ?>
			</a>
		<?php
	}
}
add_action( 'educenter_header_before', 'educenter_skip_links', 5 );


if ( ! function_exists( 'educenter_header_before' ) ) {
	/**
	 * Header area
	 * @since  1.0.0
	*/
	function educenter_header_before() {
		?>
			<header id="masthead header" class="site-header general-header header-layout-1" role="banner" itemscope="itemscope" itemtype="http://schema.org/WPHeader">		
		<?php
	}
}
add_action( 'educenter_header_before', 'educenter_header_before', 10 );

/**
 * Top header area
*/
if ( ! function_exists( 'educenter_top_header' ) ) {
	
	function educenter_top_header() { 

	   		$top_header_options = get_theme_mod( 'educenter_top_header', 0 );

	   		if($top_header_options == 1 ){ 
	   	?>
	   		<div class="top-header clearfix">

				<div class="container">

					<div class="contact-info left-contact">

						<?php do_action( 'educenter_top_quick', 5 ); ?>

					</div>

					<div class="right-contact clearfix">

						<?php do_action( 'educenter_social_links', 5 ); ?>
						
					</div>

				</div>

			</div>
	   		
	   	<?php } 
	}
}
add_action( 'educenter_header', 'educenter_top_header', 15 );


/**
 * Main header area
*/
if ( ! function_exists( 'educenter_main_header' ) ) {
	
	function educenter_main_header() { ?>

		<div class="bottom-header clearfix">
			<div class="container">
				<div class="header-middle-inner">
					<div class="site-branding logo">
						
						<?php the_custom_logo(); ?>

						<div class="brandinglogo-wrap">
							<h1 class="site-title">
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
									<?php bloginfo( 'name' ); ?>
								</a>
							</h1>
							<?php
								$description = get_bloginfo( 'description', 'display' );
								if ( $description || is_customize_preview() ) : ?>
									<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
							<?php endif;  ?>
						</div>

						<button class="header-nav-toggle" data-toggle-target=".header-mobile-menu"  data-toggle-body-class="showing-menu-modal" aria-expanded="false" data-set-focus=".close-nav-toggle">
				            <div class="one"></div>
				            <div class="two"></div>
				            <div class="three"></div>
						</button><!-- Mobile navbar toggler -->

					</div><!-- .site-branding -->
					
					<div class="box-header-nav main-menu-wapper">
						<?php
							wp_nav_menu( array(
									'theme_location'  => 'menu-1',
									'menu'            => 'primary-menu',
									'container'       => '',
									'container_class' => '',
									'container_id'    => '',
									'menu_class'      => 'main-menu',
								)
							);
						?>
	                </div>
				</div>
			</div>
		</div>

		<?php
	}
}
add_action( 'educenter_header', 'educenter_main_header', 20 );



if ( ! function_exists( 'educenter_header_after' ) ) {
	/**
	 * Header area
	 * @since  1.0.0
	*/
	function educenter_header_after() {
		?>
			</header><!-- #masthead -->
		<?php
	}
}
add_action( 'educenter_header_after', 'educenter_header_after', 25 );