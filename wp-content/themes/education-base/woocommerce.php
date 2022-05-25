<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Acme Themes
 * @subpackage Education Base
 */
get_header();
global $education_base_customizer_all_values;
?>
    <div class="wrapper inner-main-title">
        <div class="container">
            <header class="entry-header init-animate slideInUp1">
                <h1 class="entry-title">
					
	                <?php
	                if ( isset( $education_base_customizer_all_values['education-base-store-title']) ):
		                $education_base_store_title = $education_base_customizer_all_values['education-base-store-title'];
		                echo esc_html( $education_base_store_title );
	                endif;
	                ?>
                </h1>
                <?php
                if( 1 == $education_base_customizer_all_values['education-base-show-breadcrumb'] ){
                    education_base_breadcrumbs();
                }
                ?>
            </header><!-- .entry-header -->
        </div>
    </div>
    <div id="content" class="site-content container clearfix">
	    <?php
	    $sidebar_layout = education_base_sidebar_selection(get_the_ID());
	    if( 'both-sidebar' == $sidebar_layout ) {
		    echo '<div id="primary-wrap" class="clearfix">';
	    }
	    ?>
        <div id="primary" class="content-area">
            <main id="main" class="site-main init-animate slideInUp1" role="main">
                <?php if ( have_posts() ) :
                    woocommerce_content();
                endif;
                ?>
            </main><!-- #main -->
        </div><!-- #primary -->
        <?php
        get_sidebar( 'left' );
        get_sidebar();
        if( 'both-sidebar' == $sidebar_layout ) {
	        echo '</div>';
        }
        ?>
    </div><!-- #content -->
<?php get_footer();