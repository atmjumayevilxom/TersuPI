<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Educenter
 */

get_header(); ?>

<div class="content clearfix">

	<?php
		/**
		 * Breadcrumb 
		 *
	     * @since 1.0.0
	    */
		do_action( 'educenter_add_breadcrumb', 10 );
	?>

	<div class="container">

		<div id="primary" class="content-area primary-section">
			<main id="main" class="site-main">
				<section class="ed-blog">
					<div class="wrap">
						<div class="ed-blog-wrap layout-2">
							<?php
								if ( have_posts() ) : 

									/* Start the Loop */
									while ( have_posts() ) : the_post();

										/**
										 * Run the loop for the search to output the results.
										 * If you want to overload this in a child theme then include a file
										 * called content-search.php and that will be used instead.
										 */
										get_template_part( 'template-parts/content', 'search' );

									endwhile;

									the_posts_pagination( 
		                                array(
		                                    'prev_text' => esc_html__( 'Prev', 'educenter' ),
		                                    'next_text' => esc_html__( 'Next', 'educenter' ),
		                                )
		                            );

								else :

									get_template_part( 'template-parts/content', 'none' );

								endif; 
							?>
						</div>
					</div>
				</section>
			</main><!-- #main -->
		</div><!-- #primary -->

		<?php get_sidebar(); ?>

	</div>
</div>

<?php get_footer();
