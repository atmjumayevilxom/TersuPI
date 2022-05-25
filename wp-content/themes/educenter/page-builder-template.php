<?php
/**
 * Template Name: Blank Template (For Page Builders)
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

		<div id="primary" class="content-area primary-section-blank">
			<main id="main" class="site-main">
				<section class="ed-about-us layout-1 clearfix">
					<?php
						while ( have_posts() ) : the_post();

							get_template_part( 'template-parts/content', 'page' );

							// If comments are open or we have at least one comment, load up the comment template.
							if ( comments_open() || get_comments_number() ) :

								comments_template();
								
							endif;

						endwhile; // End of the loop.
					?>
				</section>
			</main><!-- #main -->
		</div><!-- #primary -->

	</div>

</div>

<?php get_footer();