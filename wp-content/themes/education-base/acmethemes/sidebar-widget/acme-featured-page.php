<?php
/**
 * Feature Page Column Options
 *
 * @since Education Base 1.0.0
 *
 * @param null
 * @return array $education_base_post_number
 *
 */

if ( !function_exists('education_base_fd_image_align') ) :
    function education_base_fd_image_align() {
        $education_base_fd_image_align =  array(
            1 => __( 'Left', 'education-base' ),
            2 => __( 'Right', 'education-base' )
        );
        return apply_filters( 'education_base_fd_image_align', $education_base_fd_image_align );
    }
endif;

/**
 * Class for adding Featured Column Section Widget
 *
 * @package Acme Themes
 * @subpackage Education Base
 * @since 1.0.0
 */
if ( ! class_exists( 'Education_Base_fdcolumn' ) ) {

    class Education_Base_fdcolumn extends WP_Widget {
        /*defaults values for fields*/
        private function defaults(){
            /*defaults values for fields*/
            $defaults = array(
                'unique_id'     => '',
                'page_id'       => '',
                'button_text'   => __( 'View More', 'education-base' ),
                'image_align'   => 1
            );
            return $defaults;
        }

        function __construct() {
            parent::__construct(
            /*Base ID of your widget*/
                'education_base_fdcolumn',
                /*Widget name will appear in UI*/
                __('AT Featured Page', 'education-base'),
                /*Widget description*/
                array( 'description' => __( 'Show text and image right or left', 'education-base' ), )
            );
        }

        /*Widget Backend*/
        public function form( $instance ) {
            $instance = wp_parse_args( (array) $instance, $this->defaults() );
            /*default values*/
            $unique_id = esc_attr( $instance[ 'unique_id' ] );
            $page_id = absint( $instance[ 'page_id' ] );
            $button_text = esc_attr( $instance[ 'button_text' ] );
            $image_align = absint( $instance[ 'image_align' ] );
            ?>
            <p>
                <label for="<?php echo $this->get_field_id( 'unique_id' ); ?>"><?php _e( 'Section ID', 'education-base' ); ?>:</label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'unique_id' ); ?>" name="<?php echo $this->get_field_name( 'unique_id' ); ?>" type="text" value="<?php echo $unique_id; ?>" />
                <br />
                <small><?php _e('Enter a Unique Section ID. You can use this ID in Menu item for enabling One Page Menu.','education-base')?></small>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'page_id' ); ?>"><?php _e( 'Select Feature Page', 'education-base' ); ?>:</label>
                <br />
                <small><?php _e( 'Select a Page which have featured image and excerpts.', 'education-base' ); ?></small>
                <?php
                /* see more here https://codex.wordpress.org/Function_Reference/wp_dropdown_pages*/
                $args = array(
                    'selected'              => $page_id,
                    'name'                  => $this->get_field_name( 'page_id' ),
                    'id'                    => $this->get_field_id( 'page_id' ),
                    'class'                 => 'widefat',
                    'show_option_none'      => __('Select Page','education-base'),
                    'option_none_value'     => 0 // string
                );
                wp_dropdown_pages( $args );
                ?>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'button_text' ); ?>"><?php _e( 'Button Text', 'education-base' ); ?>:</label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'button_text' ); ?>" name="<?php echo $this->get_field_name( 'button_text' ); ?>" type="text" value="<?php echo $button_text; ?>" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'image_align' ); ?>"><?php _e( 'Image Align', 'education-base' ); ?>:</label>
                <select class="widefat" id="<?php echo $this->get_field_id( 'image_align' ); ?>" name="<?php echo $this->get_field_name( 'image_align' ); ?>" >
                    <?php
                    $education_base_fd_image_aligns = education_base_fd_image_align();
                    foreach ( $education_base_fd_image_aligns as $key => $value ){
                        ?>
                        <option value="<?php echo esc_attr( $key )?>" <?php selected( $key, $image_align ); ?>><?php echo esc_html( $value );?></option>
                        <?php
                    }
                    ?>
                </select>
            </p>
            <?php
        }

        /**
         * Function to Updating widget replacing old instances with new
         *
         * @access public
         * @since 1.0
         *
         * @param array $new_instance new arrays value
         * @param array $old_instance old arrays value
         * @return array
         *
         */
        public function update( $new_instance, $old_instance ) {
            $instance = $old_instance;

            $instance[ 'unique_id' ] = sanitize_key( $new_instance[ 'unique_id' ] );
            $instance[ 'page_id' ] = absint( $new_instance[ 'page_id' ] );
            $instance[ 'button_text' ] = sanitize_text_field( $new_instance[ 'button_text' ] );
            $instance[ 'image_align' ] = absint( $new_instance[ 'image_align' ] );

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
            $instance = wp_parse_args( (array) $instance, $this->defaults() );
            
            /*default values*/
            $unique_id = !empty( $instance[ 'unique_id' ] ) ? esc_attr( $instance[ 'unique_id' ] ) : esc_attr( $this->id );
            $page_id = absint( $instance[ 'page_id' ] );
            $button_text = esc_html( $instance[ 'button_text' ] );
            $image_align = absint( $instance[ 'image_align' ] );

            echo $args['before_widget'];
            $alternate = '';

            $animation1 = 'init-animate slideInUp1 pull-right';
            $animation2 = 'init-animate slideInUp1 pull-left';

            if( 1 == $image_align){
                $animation1 = 'init-animate slideInUp1 pull-left';
                $animation2 = 'init-animate slideInUp1 pull-right';

                $alternate = 'alternate';
            }
            if( !empty ( $page_id ) ) :
                $education_base_child_page_args = array(
                    'page_id'             => $page_id,
                    'posts_per_page'      => 1,
                    'post_type'           => 'page',
                    'no_found_rows'       => true,
                    'post_status'         => 'publish'
                );
                $featured_page_query = new WP_Query( $education_base_child_page_args );
                /*The Loop*/
                if ( $featured_page_query->have_posts() ):
                    $i = 0;
                    while( $featured_page_query->have_posts() ):$featured_page_query->the_post();
                        $title = apply_filters( 'widget_title', esc_html( get_the_title()), $instance, $this->id_base );
                        ?>
                        <section id="<?php echo $unique_id;?>" class="acme-widgets acme-featured-image <?php echo $alternate; ?>">
                            <div class="container">
                                <div class="row">
                                    <div class="col-image col-md-6 <?php echo $animation1; ?>">
                                        <?php the_post_thumbnail( 'large', array( 'class' => 'col-img' ) ); ?>
                                    </div>
                                    <div class="col-md-6 <?php echo $animation2; ?>">
                                        <div class="col-details">
                                            <div class="main-title init-animate slideInUp1">
                                                <?php
                                                if( !empty( $title ) ) {
                                                    echo $args['before_title'] . esc_html( $title ) . $args['after_title'];
                                                }
                                                ?>
                                            </div>

                                            <div class="details">
                                                <div class="fs-text-desc">
                                                    <?php the_excerpt() ?>
                                                </div>
                                                <?php
                                                if( !empty( $button_text ) ){
                                                    ?>
                                                    <div class="at-btn-wrap">
                                                        <a class="btn btn-primary" href="<?php the_permalink(); ?>">
                                                            <?php echo $button_text; ?>
                                                        </a>
                                                    </div>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <?php $i++;
                    endwhile;
                endif;
            endif;
            wp_reset_postdata();
            echo $args['after_widget'];
            echo "<div class='clearfix'></div>";
        }
    } // Class Education_Base_fdcolumn ends here
}

/**
 * Function to Register and load the widget
 *
 * @since 1.0.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'education_base_fdcolumn' ) ) :

    function education_base_fdcolumn() {
        register_widget( 'Education_Base_fdcolumn' );
    }
endif;
add_action( 'widgets_init', 'education_base_fdcolumn' );