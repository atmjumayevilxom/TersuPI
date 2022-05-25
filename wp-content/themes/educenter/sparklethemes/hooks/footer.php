<?php
/**
 * Footer Area Before
*/
if ( ! function_exists( 'educenter_footer_before' ) ) {
	function educenter_footer_before(){ ?>
		<footer id="footer" class="footer ed-footer" itemscope="itemscope" itemtype="http://schema.org/WPFooter">
	<?php
	}
}
add_action( 'educenter_footer_before', 'educenter_footer_before', 5 );

/**
 * Footer Area Goto Top
*/
if ( ! function_exists( 'educenter_footer_gototop' ) ) {
	function educenter_footer_gototop(){ ?>
		<a class="goToTop" href="#" id="scrollTop">
			<i class="fa fa-angle-up"></i>
			<span><?php esc_html_e('Top','educenter'); ?></span>
		</a>
	<?php
	}
}
add_action( 'educenter_footer_before', 'educenter_footer_gototop', 6 );

/**
 * Educenter Footer Widget Area
*/
if ( ! function_exists( 'educenter_footer_widget_area' ) ) {

	function educenter_footer_widget_area(){ ?>
			
			<div class="top-footer layout-1">
				<div class="container">
					<div class="ed-footer-holder ed-col-4">
						<?php if ( is_active_sidebar( 'footer-1' ) ) {  dynamic_sidebar( 'footer-1' );  } ?>
					</div>
				</div>
			</div>

	    <?php 
	}
}
add_action( 'educenter_footer_widget', 'educenter_footer_widget_area', 10 );

/**
 * Top Footer Area
*/
if ( ! function_exists( 'educenter_button_footer_before' ) ) {

	function educenter_button_footer_before(){ ?>

			<div class="bottom-footer clearfix">

				<div class="container">

					<div class="footer-bottom-left">

						<p><?php do_action( 'educenter_copyright', 5 ); ?> <?php the_privacy_policy_link(); ?></p>

					</div>

					<div class="footer-bottom-right">
						<?php
							if( has_nav_menu( 'menu-2' ) ){
								wp_nav_menu( array(
									'theme_location' => 'menu-2',
									'menu_id'        => 'footer-menu',
									'depth'          => 1,
								) );
							}
						?>
					</div>

				</div>

			</div>
			
		<?php
	}
}
add_action( 'educenter_button_footer', 'educenter_button_footer_before', 15 );

/**
 * Footer Area After
*/
if ( ! function_exists( 'educenter_footer_after' ) ) {

	function educenter_footer_after(){ ?>

		</footer>

	<?php
	}
}
add_action( 'educenter_footer_after', 'educenter_footer_after', 25 );