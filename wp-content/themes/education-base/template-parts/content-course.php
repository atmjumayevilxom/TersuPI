<?php
/**
 * Template part for displaying course from widgets.
 *
 * @package Acme Themes
 * @subpackage Education Base
 */
global  $education_base_read_more_text;
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('init-animate slideInUp1 post'); ?>>
    <div class="content-wrapper">

        <?php
        if ( has_post_thumbnail() ) {
            ?>
            <!--post thumbnal options-->
            <div class="post-thumb">
                <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail( 'large' ); ?>
                </a>
            </div><!-- .post-thumb-->
            <?php
        }
        else{
            $no_blog_image = 'no-image';
        }
        ?>
        <div class="entry-content">
            <div class="entry-header-title">
                <?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
				
            </div>
            <?php
            the_excerpt();
            if( !empty( $education_base_read_more_text ) ){
                ?>
                <a class="btn btn-primary" href="<?php the_permalink(); ?> ">
                    <?php echo esc_html( $education_base_read_more_text ); ?>
                </a>
                <?php
            }
            ?>
        </div><!-- .entry-content -->
    </div>
</article><!-- #post-## -->