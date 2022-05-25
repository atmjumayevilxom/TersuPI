<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
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
						<div class="ed-blog-wrap layout-1">
							<?php
								while ( have_posts() ) : the_post();

									get_template_part( 'template-parts/content', 'single' );

									the_post_navigation();

									// If comments are open or we have at least one comment, load up the comment template.
									if ( comments_open() || get_comments_number() ) :
										comments_template();
									endif;

								endwhile; // End of the loop. 
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
