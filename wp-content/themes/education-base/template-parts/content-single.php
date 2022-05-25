<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Acme Themes
 * @subpackage Education Base
 */
$no_blog_image = '';
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('init-animate slideInUp1'); ?>>
	
	<div class="content-wrapper">
		
		<?php
		$sidebar_layout = education_base_sidebar_selection();
		if( has_post_thumbnail() ):
			$thumbnail = 'full';
			echo '<figure class="post-thumb">';
			the_post_thumbnail( $thumbnail );
			echo "</figure>";
		else:
			$no_blog_image = 'no-image';
		endif;
		?>
		<header class="entry-header <?php echo $no_blog_image; ?>">
			<div class="entry-meta">
				<span class="day-month">
					<span class="day">
						<?php echo esc_html( get_the_date('j') ); ?>
					</span>
					<span class="month">
						<?php echo esc_html( get_the_date('M') ); ?>
					</span>
				</span>
				<span class="year">
					<?php echo esc_html( get_the_date('Y') )?>
				</span>

			</div><!-- .entry-meta -->
		</header><!-- .entry-header -->
		<div class="entry-content">

			<footer class="entry-footer">
				<?php education_base_entry_footer(); ?>
			</footer><!-- .entry-footer -->
			<?php
			the_content();
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'education-base' ),
				'after'  => '</div>',
			) );
			?>
		</div><!-- .entry-content -->
	</div>
</article><!-- #post-## -->