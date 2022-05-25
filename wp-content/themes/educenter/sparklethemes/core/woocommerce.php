<?php
/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package Educenter
 */

/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)-in-3.0.0
 *
 * @return void
 */
function educenter_woocommerce_setup() {

	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );

}
add_action( 'after_setup_theme', 'educenter_woocommerce_setup' );


/**
 * Load Educenter woocommerce Action and Filter.
*/
remove_action( 'woocommerce_before_main_content','woocommerce_breadcrumb', 20 );

add_filter( 'woocommerce_show_page_title', '__return_false' );

remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);


/**
 * Load educenter woocommerce Action and Filter.
*/
if (!function_exists('educenter_woocommerce_breadcrumb')) {
  
  function educenter_woocommerce_breadcrumb(){

    do_action( 'educenter_woocommerce' );

  }
}
add_action( 'woocommerce_before_main_content','educenter_woocommerce_breadcrumb', 9 );

/**
 * WooCommerce add content primary div function
*/
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
if (!function_exists('educenter_woocommerce_output_content_wrapper')) {
    function educenter_woocommerce_output_content_wrapper(){ ?>
    	<div class="container">
			<div id="primary" class="content-area primary-section">
				<main id="main" class="site-main">
    <?php }
}
add_action( 'woocommerce_before_main_content', 'educenter_woocommerce_output_content_wrapper', 10 );

remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
if (!function_exists('educenter_woocommerce_output_content_wrapper_end')) {
    function educenter_woocommerce_output_content_wrapper_end(){ ?>
          		</main>
          		
          	</div>

          	<?php get_sidebar('woocommerce'); ?>
        </div>
    <?php }
}
add_action( 'woocommerce_after_main_content', 'educenter_woocommerce_output_content_wrapper_end', 10 );
remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );


/**
 * Woo Commerce Number of row filter Function
*/
add_filter('loop_shop_columns', 'educenter_loop_columns');
if (!function_exists('educenter_loop_columns')) {
    function educenter_loop_columns() {
        return 3;
    }
}

add_action( 'body_class', 'educenter_woo_body_class');
if (!function_exists('educenter_woo_body_class')) {
    function educenter_woo_body_class( $class ) {
           $class[] = 'columns-'.intval(educenter_loop_columns());
           return $class;
    }
}

/**
 * WooCommerce display related product.
*/
if (!function_exists('educenter_related_products_args')) {
  function educenter_related_products_args( $args ) {
      $args['posts_per_page']   = 6;
      $args['columns']          = 3;
      return $args;
  }
}
add_filter( 'woocommerce_output_related_products_args', 'educenter_related_products_args' );

/**
 * WooCommerce display upsell product.
*/
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
if ( ! function_exists( 'educenter_woocommerce_upsell_display' ) ) {
  function educenter_woocommerce_upsell_display() {
      woocommerce_upsell_display( 6, 3 ); 
  }
}
add_action( 'woocommerce_after_single_product_summary', 'educenter_woocommerce_upsell_display', 15 );
