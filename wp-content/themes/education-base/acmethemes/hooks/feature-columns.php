<?php
/**
 * Display Feature Columns
 *
 * @since Education Base 1.0.0
 *
 * @return void
 *
 */
if ( !function_exists('education_base_feature_column') ) :
    function education_base_feature_column() {
        global $education_base_customizer_all_values;
        $education_base_feature_column_1 = $education_base_customizer_all_values['education-base-feature-column-1'];
        $education_base_feature_column_1_color = $education_base_customizer_all_values['education-base-feature-column-1-color'];
        $education_base_feature_column_2 = $education_base_customizer_all_values['education-base-feature-column-2'];
        $education_base_feature_column_2_color = $education_base_customizer_all_values['education-base-feature-column-2-color'];
        $education_base_feature_column_3 = $education_base_customizer_all_values['education-base-feature-column-3'];
        $education_base_feature_column_3_color = $education_base_customizer_all_values['education-base-feature-column-3-color'];
        $post_in = array();
        if( 0 != $education_base_feature_column_1 ){
            $post_in[] = $education_base_feature_column_1;
        }
        if( 0 != $education_base_feature_column_2 ){
            $post_in[] = $education_base_feature_column_2;
        }
        if( 0 != $education_base_feature_column_3 ){
            $post_in[] = $education_base_feature_column_3;
        }
        if( !empty( $post_in ) ) :
            ?>
            <!--feature columns-->
            <section class="feature-column">
                <div class="container">
                    <div class="row">
                        <?php
                        $education_base_child_page_args = array(
                            'post__in'         => $post_in,
                            'orderby'             => 'post__in',
                            'posts_per_page'      => 3,
                            'post_type'           => 'page',
                            'no_found_rows'       => true,
                            'post_status'         => 'publish'
                        );
                        $feature_columns_query = new WP_Query( $education_base_child_page_args );
                        $feature_columns_number = $feature_columns_query->post_count;
                        /*The Loop*/
                        if ( $feature_columns_query->have_posts() ):
                        $i = 1;
                        while( $feature_columns_query->have_posts() ):$feature_columns_query->the_post();
                            $clearfix = '';
                            if( 1 == $feature_columns_number ){
                                $b_col = "col-sm-12";
                            }
                            elseif( 3 == $feature_columns_number ){
                                $b_col = "col-sm-4";
                            }
                            elseif( 4 == $feature_columns_number ){
                                $b_col = "col-sm-3";
                            }
                            else{
                                $b_col = "col-sm-6";
                            }
                            if( 1 == $i ){
                                $bg_color = $education_base_feature_column_1_color;
                            }
                            elseif ( 2 == $i ){
                                $bg_color = $education_base_feature_column_2_color;
                            }
                            elseif ( 3 == $i ){
                                $bg_color = $education_base_feature_column_3_color;
                            }
                            else{
                                $bg_color = $education_base_feature_column_3_color;
                            }
                            $init_animate_content = "init-animate slideInUp1";
                            ?>
                            <div class="feature-col <?php echo esc_attr( $b_col ); ?>" style="background-color: <?php echo esc_attr( $bg_color );?>">
                                <div class="feature-col-item <?php echo esc_attr( $init_animate_content )?>">
                                    <?php 
                                    the_title( sprintf( '<h4><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' );
                                    the_excerpt(); 
                                    ?>
								
                                </div>
                            </div>
                            <?php
                            echo $clearfix;
                            $i++;
                        endwhile;
                        ?>
                    </div>
                    <?php
                    else:
                        /*do nothing for now*/
                    endif;
                    wp_reset_postdata();
                    ?>
                </div>
            </section>
            <?php
        endif;
        ?>
        <div class="clearfix"></div>
        <?php
    }
endif;
add_action( 'education_base_action_feature_slider', 'education_base_feature_column', 20 );