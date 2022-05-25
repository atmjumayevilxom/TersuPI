<?php
/**
 * Template part for displaying posts and search results.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Acme Themes
 * @subpackage Education Base
 */
global $education_base_customizer_all_values;
$no_blog_image = '';
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="content-wrapper">
		<?php
		if ( $education_base_customizer_all_values['education-base-blog-archive-layout'] == 'left-image' &&
			has_post_thumbnail() ) {
			$sidebar_layout = education_base_sidebar_selection();
			$thumbnail = 'full';
			?>
			<!--post thumbnal options-->
			<div class="post-thumb">
				<a href="<?php the_permalink(); ?>">
					<?php the_post_thumbnail( $thumbnail ); ?>
				</a>
			</div><!-- .post-thumb-->
			<?php
		}
		else{
			$no_blog_image = 'no-image';
		}
		if ( 'post' === get_post_type() ) : ?>
			<header class="entry-header <?php echo $no_blog_image; ?>">
				<div class="entry-meta">
					<a href="<?php the_permalink()?>">
						<span class="day-month">
						<span class="day">
							<?php echo esc_html( get_the_date('j') ); ?>
						</span>
						<span class="month">
							<?php echo esc_html( get_the_date('M') ); ?>
						</span>
					</span>
						<span class="year"><?php echo esc_html( get_the_date('Y') )?></span>
					</a>

				</div><!-- .entry-meta -->
			</header><!-- .entry-header -->
			<?php
		endif;
		?>
		<div class="entry-content">
			<div class="entry-header-title">
			
				<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
			</div>
			<footer class="entry-footer">
				<?php education_base_entry_footer(); ?>
			</footer><!-- .entry-footer -->
			<?php
			the_excerpt();
			$education_base_blog_archive_read_more = education_base_blog_archive_more_text();
			if( !empty( $education_base_blog_archive_read_more )){
				?>
				<a class="btn btn-primary" href="<?php the_permalink(); ?> ">
					<?php echo $education_base_blog_archive_read_more; ?>
				</a>
				<?php
			}
			?>
		</div><!-- .entry-content -->
	</div>
</article><!-- #post-## -->