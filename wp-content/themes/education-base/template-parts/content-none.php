<?php
/**
 * Template part for displaying a message that posts cannot be found.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Acme Themes
 * @subpackage Education Base
 */

?>
<section class="no-results not-found init-animate slideInUp1">
	<header>
		<h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'education-base' ); ?></h1>
	</header>

	<div class="page-content">
	
		<?php
		if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p><?php printf( wp_kses( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'education-base' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

		<?php elseif ( is_search() ) : ?>
			<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'education-base' ); ?></p>
			<?php
				get_search_form();
		else : ?>

			<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'education-base' ); ?></p>
			<?php
            get_search_form();
            endif;
            ?>
	</div><!-- .page-content -->
</section><!-- .no-results -->