<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
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

		<section class="error-404 not-found">
			
			<header class="page-header">
				<div class="tag404"><?php esc_html_e('404','educenter'); ?></div>
				<h2 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'educenter' ); ?></h2>
			</header><!-- .page-header -->

			<div class="page-content">
				<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'educenter' ); ?></p>							
			</div><!-- .page-content -->

			<div class="backhome">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" type="button">
					<span><?php esc_html_e('Back To Home','educenter'); ?></span>
				</a>
			</div><!-- .page-content -->

		</section><!-- .error-404 -->

	</div>

</div>

<?php get_footer();