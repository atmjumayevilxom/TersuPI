<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Educenter
 */

$image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'educenter-large', true );

$noimg = '';
if ( ! has_post_thumbnail() ) {  $noimg = 'edu-noimage'; }
$classes = array(
	'ed-blog-col',
	$noimg
);

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $classes ); ?>>
	
	<?php if ( has_post_thumbnail() ) { ?>
		<div class="ed-blog-img">
			<a href="<?php the_permalink(); ?>">
				<img src="<?php echo esc_url( $image[0] ); ?>" alt="<?php the_title_attribute(); ?>">
			</a>
		</div>
	<?php } ?>

	<div class="ed-desc-wrap">
		
		<div class="edu-singl-wrap">
			<div class="ed-category-list">
				<?php the_category( ' ' ); ?>
			</div>
			<div class="ed-title">
				<?php the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' ); ?>	
			</div>

			<div class="ed-meta-wrap">
				<?php educenter_posted_on(); ?>
			</div>
		</div>

		<div class="ed-content-wrap">
			<div class="entry-content">
				<?php
					the_content( sprintf(
						wp_kses(
							/* translators: %s: Name of current post. Only visible to screen readers */
							__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'educenter' ),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						get_the_title()
					) );

					wp_link_pages( array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'educenter' ),
						'after'  => '</div>',
					) );
				?>
			</div><!-- .entry-content -->
		</div>
		<div class="ed-bottom-wrap">
			<div class="ed-tag">
				<?php the_tags( '#', '#' ); ?>
			</div>
		</div>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->