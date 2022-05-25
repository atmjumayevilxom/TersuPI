<?php
/**
 * Template Single Event post type
 */
get_header();?>
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
						/**
						 * tp_event_before_main_content hook
						 */
						do_action( 'tp_event_before_main_content' );
						?>

						<?php while ( have_posts() ) : ?>
							<?php
							the_post();
							wpems_get_template_part( 'content', 'single-event' );
							?>
						<?php endwhile; ?>

						<?php

						// If comments are open or we have at least one comment, load up the comment template
						if ( comments_open() || '0' != get_comments_number() ) :
							comments_template();
						endif;

						?>


						<?php

						/**
						 * hotel_booking_after_main_content hook
						 *
						 * @hooked tp_event_after_main_content - 10 (outputs closing divs for the content)
						 */
						do_action( 'tp_event_after_main_content' );

						/**
						 * educenter_wrapper_loop_end hook
						 *
						 * @hooked educenter_wrapper_loop_end - 10
						 * @hooked educenter_wrapper_div_close - 30
						 */
						do_action( 'educenter_wrapper_loop_end' );
						?>

						</div>
					</div>
				</section>
			</main><!-- #main -->
		</div><!-- #primary -->

		<?php get_sidebar( 'events' ); ?>

	</div>
</div>

<?php get_footer();
