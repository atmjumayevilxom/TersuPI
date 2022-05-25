<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
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
		
			
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
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
		<main id="main" class="site-main" role="main">
			
		<?php
        while ( have_posts() ) : the_post();
            get_template_part( 'template-parts/content', 'single' );
            the_post_navigation();
        // If comments are open or we have at least one comment, load up the comment template.
            if ( comments_open() || get_comments_number() ) :
                comments_template();
            endif;
        endwhile; // End of the loop. ?>
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