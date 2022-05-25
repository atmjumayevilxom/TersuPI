<?php
/**
 * Display default slider
 *
 * @since Education Base 1.0.0
 *
 * @param int $post_id
 * @return void
 *
 */
if ( !function_exists('education_base_default_slider') ) :
    function education_base_default_slider(){
        global $education_base_customizer_all_values;
        $bg_image_style = '';
        if ( get_header_image() ) :
            $bg_image_style .= 'background-image:url(' . esc_url( get_header_image() ) . ');background-repeat:no-repeat;background-size:cover;background-position:center;';
        else:
            $bg_image_style .= 'background-image:url(' . esc_url( get_template_directory_uri()."/assets/img/startup-slider.jpg" ) . ');background-repeat:no-repeat;background-size:cover;background-position:center;';
        endif; // End header image check.

        $education_base_slider_know_more_text = $education_base_customizer_all_values['education-base-slider-know-more-text'];

        $text_align = 'text-left';
        $animation1 = 'init-animate slideInUp';
        $animation2 = 'init-animate slideInUp';
        $animation3 = 'init-animate slideInUp';
        ?>
        <div class="image-slider-wrapper home-fullscreen ">
            <div class="acme-owl-carausel">
                <div class="item" style="<?php echo $bg_image_style; ?>">
                    <div class="slider-content <?php echo $text_align;?>">
                        <div class="container">
						
                            <div class="banner-title <?php echo $animation1;?>">
                                <?php _e('Education Base','education-base' );?>
                            </div>
                            <div class="image-slider-caption <?php echo $animation2;?>">
                                <?php _e('The modern Educational WordPress Theme','education-base' );?>
                            </div>
                            <?php
                            if( !empty( $education_base_slider_know_more_text) ){
                                ?>
                                <a href="<?php the_permalink()?>" class="<?php echo $animation3;?> btn btn-primary outline-outward banner-btn">
                                    <?php echo esc_html( $education_base_slider_know_more_text ); ?>
                                </a>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <?php
    }
endif;

/**
 * Featured Slider display
 *
 * @since Education Base 1.0.0
 *
 * @param null
 * @return void
 */

if ( ! function_exists( 'education_base_feature_slider' ) ) :

    function education_base_feature_slider( ){
        global $education_base_customizer_all_values;

        /*previous values*/
        $education_base_feature_page = $education_base_customizer_all_values['education-base-feature-page'];
	    $education_base_featured_slider_number = $education_base_customizer_all_values['education-base-featured-slider-number'];

        $education_base_all_slides = json_decode( $education_base_customizer_all_values['education-base-all-slides'] );


        $education_base_feature_slider_enable_animation = $education_base_customizer_all_values['education-base-feature-slider-enable-animation'];
        $education_base_feature_slider_image_only = $education_base_customizer_all_values['education-base-feature-slider-image-only'];
        $education_base_fs_image_display_options = $education_base_customizer_all_values['education-base-fs-image-display-options'];
        $education_base_slider_know_more_text = $education_base_customizer_all_values['education-base-slider-know-more-text'];

	    $post_in = array();
	    $education_base_child_page_args = array();
	    if( is_array( $education_base_all_slides )){
		    foreach ( $education_base_all_slides as $slide ){
			    if( isset( $slide->selectpage ) && !empty( $slide->selectpage ) ){
				    $post_in[] = $slide->selectpage;
			    }
		    }
	    }
	    if( !empty( $post_in )) :
		    $education_base_child_page_args = array(
			    'post__in'         => $post_in,
			    'orderby'             => 'post__in',
			    'posts_per_page'      => count( $post_in ),
			    'post_type'           => 'page',
			    'no_found_rows'       => true,
			    'post_status'         => 'publish'
		    );
        else:
	        if( 0 != $education_base_feature_page ) :
		        $education_base_child_page_args = array(
			        'post_parent'         => $education_base_feature_page,
			        'posts_per_page'      => $education_base_featured_slider_number,
			        'post_type'           => 'page',
			        'no_found_rows'       => true,
			        'post_status'         => 'publish'
		        );
		        $slider_query = new WP_Query( $education_base_child_page_args );
		        if ( !$slider_query->have_posts() ){
			        $education_base_child_page_args = array(
				        'page_id'         => $education_base_feature_page,
				        'posts_per_page'      => 1,
				        'post_type'           => 'page',
				        'no_found_rows'       => true,
				        'post_status'         => 'publish'
			        );
		        }
	        endif;
        endif;

        if( !empty( $education_base_child_page_args )) :

            $slider_query = new WP_Query( $education_base_child_page_args );
            /*The Loop*/
            if ( $slider_query->have_posts() ):
                ?>
                <div class="image-slider-wrapper home-fullscreen <?php echo $education_base_fs_image_display_options; ?>">
                    <div class="acme-owl-carausel">
                        <?php
                        $slider_index = 1;
                        $animation1 = '';
                        $animation2 = '';
                        $animation3 = '';
                        $bg_image_style = '';
                        if( 1 == $education_base_feature_slider_enable_animation ){
                            $animation1 = 'init-animate slideInUp1';
                            $animation2 = 'init-animate slideInUp2';
                            $animation3 = 'init-animate slideInUp3';
                        }
                        while( $slider_query->have_posts() ):$slider_query->the_post();
                            $text_align = 'text-left';

                            if (has_post_thumbnail()) {
                                $image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
                            }
                            else {
                                $image_url[0] = get_template_directory_uri().'/assets/img/startup-slider.jpg';
                            }
                            if( 'full-screen-bg' == $education_base_fs_image_display_options ){
                                $bg_image_style = 'background-image:url(' . esc_url( $image_url[0] ) . ');background-repeat:no-repeat;background-size:cover;background-position:center;';
                            }
                            ?>
                            <div class="item" style="<?php echo $bg_image_style; ?>">
                                <?php
                                if( 'responsive-img' == $education_base_fs_image_display_options ){
                                    echo '<img src="'.esc_url( $image_url[0] ).'"/>';
                                }
                                if( 1 != $education_base_feature_slider_image_only ){
                                ?>
                                    <div class="slider-content <?php echo $text_align;?>">
                                        <div class="container">
                                            <div class="banner-title <?php echo $animation1;?>"><?php the_title()?></div>
                                            <div class="image-slider-caption <?php echo $animation2;?>">
                                                <?php the_excerpt();?>
                                            </div>
                                            <?php
                                            if( !empty( $education_base_slider_know_more_text) ){
                                                ?>
                                                <a href="<?php the_permalink()?>" class="<?php echo $animation3;?> btn btn-primary outline-outward banner-btn">
                                                    <?php echo esc_html( $education_base_slider_know_more_text ); ?>
                                                </a>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                            <?php
                            $slider_index ++;
                            if( 3 < $slider_index ){
                                $slider_index = 1;
                            }
                        endwhile;
                        ?>
                    </div>
                </div>
                <?php
            endif;
        else:
            education_base_default_slider();
        endif;
        wp_reset_postdata();
    }
endif;
add_action( 'education_base_action_feature_slider', 'education_base_feature_slider', 0 );