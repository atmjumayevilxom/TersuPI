<?php
/**
 * Column Post Widgets
 *
 * @since Education Base 1.0.0
 *
 * @param null
 * @return array $education_base_posts_col__column_number
 *
 */
if ( !function_exists('education_base_posts_col__column_number') ) :
    function education_base_posts_col__column_number() {
        $education_base_posts_col__column_number =  array(
            1 => __( '1', 'education-base' ),
            2 => __( '2', 'education-base' ),
            3 => __( '3', 'education-base' ),
            4 =>  __( '4', 'education-base' )
        );
        return apply_filters( 'education_base_posts_col__column_number', $education_base_posts_col__column_number );
    }
endif;

/**
 * Custom columns of category with various options
 *
 * @package Acme Themes
 * @subpackage Education Base
 */
if ( ! class_exists( 'Education_base_posts_col' ) ) {
    /**
     * Class for adding widget
     *
     * @package Acme Themes
     * @subpackage Education_base_posts_col
     * @since 1.0.0
     */
    class Education_base_posts_col extends WP_Widget {
        
        private function defaults(){
            /*defaults values for fields*/
            $defaults = array(
                'unique_id'             => '',
                'title'                 => '',
                'education_base_cat_id' => '',
                'post_number'           => 3,
                'column_number'         => 3,
                'read_more_text'        => __( 'Read More', 'education-base' ),
                'button_text'           => __( 'View More', 'education-base' ),
                'button_url'            => ''
            );
            return $defaults;
        }
      
        function __construct() {
            parent::__construct(
            /*Base ID of your widget*/
                'education_base_posts_col',
                /*Widget name will appear in UI*/
                __('AT Posts Column', 'education-base'),
                /*Widget description*/
                array( 'description' => __( 'Show recents post or post from category', 'education-base' ), )
            );
        }

        /*Widget Backend*/
        public function form( $instance ) {
            $instance = wp_parse_args( (array) $instance, $this->defaults() );

            /*default values*/
            $unique_id = esc_attr( $instance[ 'unique_id' ] );
            $title = esc_attr( $instance[ 'title' ] );
            $education_base_selected_cat = esc_attr( $instance[ 'education_base_cat_id' ] );
            $post_number = absint( $instance[ 'post_number' ] );
            $column_number = absint( $instance[ 'column_number' ] );
            $read_more_text = esc_attr( $instance[ 'read_more_text' ] );
            $button_text = esc_attr( $instance[ 'button_text' ] );
            $button_url = esc_url( $instance[ 'button_url' ] );
            ?>
            <p>
                <label for="<?php echo $this->get_field_id( 'unique_id' ); ?>"><?php _e( 'Section ID', 'education-base' ); ?>:</label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'unique_id' ); ?>" name="<?php echo $this->get_field_name( 'unique_id' ); ?>" type="text" value="<?php echo $unique_id; ?>" />
                <br />
                <small><?php _e('Enter a Unique Section ID. You can use this ID in Menu item for enabling One Page Menu.','education-base')?></small>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', 'education-base' ); ?>:</label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('education_base_cat_id'); ?>"><?php _e('Select Category', 'education-base'); ?></label>
                <?php
                $education_base_dropown_cat = array(
                    'show_option_none'   => __('From Recent Posts','education-base'),
                    'orderby'            => 'name',
                    'order'              => 'asc',
                    'show_count'         => 1,
                    'hide_empty'         => 1,
                    'echo'               => 1,
                    'selected'           => $education_base_selected_cat,
                    'hierarchical'       => 1,
                    'name'               => $this->get_field_name('education_base_cat_id'),
                    'id'                 => $this->get_field_name('education_base_cat_id'),
                    'class'              => 'widefat',
                    'taxonomy'           => 'category',
                    'hide_if_empty'      => false,
                );
                wp_dropdown_categories($education_base_dropown_cat);
                ?>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'post_number' ); ?>"><?php _e( 'Post Number', 'education-base' ); ?>:</label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'post_number' ); ?>" name="<?php echo $this->get_field_name( 'post_number' ); ?>" type="number" value="<?php echo $post_number; ?>" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'column_number' ); ?>"><?php _e( 'Column Number', 'education-base' ); ?>:</label>
                <select class="widefat" id="<?php echo $this->get_field_id( 'column_number' ); ?>" name="<?php echo $this->get_field_name( 'column_number' ); ?>" >
                    <?php
                    $education_base_posts_col__column_numbers = education_base_posts_col__column_number();
                    foreach ( $education_base_posts_col__column_numbers as $key => $value ){
                        ?>
                        <option value="<?php echo esc_attr( $key )?>" <?php selected( $key, $column_number ); ?>><?php echo esc_html( $value );?></option>
                        <?php
                    }
                    ?>
                </select>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'read_more_text' ); ?>"><?php _e( 'Read More Text', 'education-base' ); ?>:</label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'read_more_text' ); ?>" name="<?php echo $this->get_field_name( 'read_more_text' ); ?>" type="text" value="<?php echo $read_more_text; ?>" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'button_text' ); ?>"><?php _e( 'Button Text', 'education-base' ); ?>:</label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'button_text' ); ?>" name="<?php echo $this->get_field_name( 'button_text' ); ?>" type="text" value="<?php echo $button_text; ?>" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'button_url' ); ?>"><?php _e( 'Button Link Url', 'education-base' ); ?>:</label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'button_url' ); ?>" name="<?php echo $this->get_field_name( 'button_url' ); ?>" type="text" value="<?php echo $button_url; ?>" />
            </p>
            <?php
        }

        /**
         * Function to Updating widget replacing old instances with new
         *
         * @access public
         * @since 1.0.0
         *
         * @param array $new_instance new arrays value
         * @param array $old_instance old arrays value
         * @return array
         *
         */
        public function update( $new_instance, $old_instance ) {
            $instance = $old_instance;
            $instance[ 'unique_id' ] = sanitize_key( $new_instance[ 'unique_id' ] );
            $instance[ 'title' ] = sanitize_text_field( $new_instance[ 'title' ] );
            $instance[ 'education_base_cat_id' ] = ( isset( $new_instance['education_base_cat_id'] ) ) ? esc_attr( $new_instance['education_base_cat_id'] ) : '';
            $instance[ 'post_number' ] = absint( $new_instance[ 'post_number' ] );
            $instance[ 'column_number' ] = absint( $new_instance[ 'column_number' ] );
            $instance[ 'read_more_text' ] = sanitize_text_field( $new_instance[ 'read_more_text' ] );
            $instance[ 'button_text' ] = sanitize_text_field( $new_instance[ 'button_text' ] );
            $instance[ 'button_url' ] = esc_url_raw( $new_instance[ 'button_url' ] );

            return $instance;
        }

        /**
         * Function to Creating widget front-end. This is where the action happens
         *
         * @access public
         * @since 1.0.0
         *
         * @param array $args widget setting
         * @param array $instance saved values
         * @return void
         *
         */
        public function widget($args, $instance) {
            $instance = wp_parse_args( (array) $instance, $this->defaults());
            $init_animate_content = "init-animate slideInUp1";

            /*default values*/
            $unique_id = !empty( $instance[ 'unique_id' ] ) ? esc_attr( $instance[ 'unique_id' ] ) : esc_attr( $this->id );
            $title = apply_filters( 'widget_title', !empty( $instance['title'] ) ? $instance['title'] : '', $instance, $this->id_base );
            $education_base_cat_id = esc_attr( $instance[ 'education_base_cat_id' ] );
            $post_number = absint( $instance[ 'post_number' ] );
            $column_number = absint( $instance[ 'column_number' ] );
            $read_more_text = esc_html( $instance[ 'read_more_text' ] );
            $button_text = esc_html( $instance[ 'button_text' ] );
            $button_url = esc_url( $instance[ 'button_url' ] );

            /**
             * Filter the arguments for the Recent Posts widget.
             *
             * @since 1.0.0
             *
             * @see WP_Query
             *
             */
            $education_base_cat_post_args = array(
                'posts_per_page'      => $post_number,
                'no_found_rows'       => true,
                'post_status'         => 'publish',
                'ignore_sticky_posts' => true
            );
            if( -1 != $education_base_cat_id ){
                $education_base_cat_post_args['cat'] = $education_base_cat_id;
            }
            $the_query = new WP_Query( $education_base_cat_post_args );
            echo $args['before_widget']; 
            ?>
            <section id="<?php echo esc_attr( $unique_id );?>" class="acme-widgets acme-col-posts gray-bg">
                <div class="container">
                    <?php
                    if( !empty( $title ) ) {
                        echo '<div class="main-title init-animate slideInUp1">';
                        echo $args['before_title'] .esc_html( $title ).$args['after_title'];
                        echo '</div>';
                    }
                    ?>
                    <div class="row">
                        <?php
                        global $education_base_read_more_text;
                        $education_base_read_more_text = $read_more_text;
                        if ( $the_query->have_posts() ):
                            $i = 1;
                            while( $the_query->have_posts() ):$the_query->the_post();

                                if( 1 == $column_number ){
                                    $init_animate_content .= " col-sm-12";
                                }
                                elseif( 2 == $column_number ){
                                    $init_animate_content .= " col-sm-6";
                                }
                                elseif( 3 == $column_number ){
                                    $init_animate_content .= " col-sm-12 col-md-4";
                                }
                                else{
                                    $init_animate_content .= " col-sm-12 col-md-3";
                                }
                                ?>
                                <div class="blog-item-wrapper <?php echo $init_animate_content; ?>">
                                    <?php get_template_part( 'template-parts/content', 'recents' );?>
                                </div>
                                <?php
                                if( 0 == $i % $column_number ){
                                    echo "<div class='clearfix'></div>";
                                }
                                $i++;
                            endwhile;
                        endif;
                        if( !empty( $button_url )){
                            ?>
                            <div class="clearfix"></div>
                            <div class="at-btn-wrap">
                                <a class="btn btn-primary" href="<?php echo $button_url;?>">
                                    <?php echo $button_text; ?>
                                </a>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </section>
            <?php
	        wp_reset_postdata();
	        echo $args['after_widget'];
        }
    } // Class education_base_posts_col ends here
}

if ( ! function_exists( 'education_base_posts_col' ) ) :
    /**
     * Function to Register and load the widget
     *
     * @since 1.0.0
     *
     * @param null
     * @return void
     *
     */
    function education_base_posts_col() {
        register_widget( 'Education_base_posts_col' );
    }
endif;
add_action( 'widgets_init', 'education_base_posts_col' );