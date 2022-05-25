<?php
/**
 * The template for displaying  page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Educenter
 *
 * Template Name: Blog Template
 */

$args = array(
    'post_type' => 'post',
    'paged'     => get_query_var( 'paged' )
);

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
                        <div class="ed-blog-wrap layout-2">
                            <?php

                                query_posts( $args );

                                if ( have_posts() ) : 

                                    /* Start the Loop */
                                    while ( have_posts() ) : the_post();

                                        /*
                                         * Include the Post-Format-specific template for the content.
                                         * If you want to override this in a child theme, then include a file
                                         * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                                         */
                                        get_template_part( 'template-parts/content', get_post_format() );

                                    endwhile;

                                    the_posts_pagination( 
                                        array(
                                            'prev_text' => esc_html__( 'Prev', 'educenter' ),
                                            'next_text' => esc_html__( 'Next', 'educenter' ),
                                        )
                                    );

                                else :

                                    get_template_part( 'template-parts/content', 'none' );

                                endif; 
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
