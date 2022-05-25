<?php
/**
 * Class for adding Contact Section Widget
 *
 * @package Acme Themes
 * @subpackage Education Base
 * @since 1.0.0
 */
if ( ! class_exists( 'Education_base_contact' ) ) {

    class Education_base_contact extends WP_Widget {
        /*defaults values for fields*/
        private $defaults = array(
            'unique_id'     => '',
            'title'         => '',
            'shortcode'     => '',
            'page_id'       => ''
        );

        function __construct() {
            parent::__construct(
            /*Base ID of your widget*/
                'education_base_contact',
                /*Widget name will appear in UI*/
                __('AT Contact Section', 'education-base'),
                /*Widget description*/
                array( 'description' => __( 'Show Contact Section.', 'education-base' ), )
            );
        }

        /*Widget Backend*/
        public function form( $instance ) {
            $instance = wp_parse_args( (array) $instance, $this->defaults );
            /*default values*/
            $unique_id = esc_attr( $instance[ 'unique_id' ] );
            $title = esc_attr( $instance[ 'title' ] );
            $shortcode = esc_attr( $instance[ 'shortcode' ] );
            $page_id = absint( $instance[ 'page_id' ] );
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
                <label for="<?php echo $this->get_field_id( 'shortcode' ); ?>"><?php _e( 'Enter Shortcode', 'education-base' ); ?>:</label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'shortcode' ); ?>" name="<?php echo $this->get_field_name( 'shortcode' ); ?>" type="text" value="<?php echo $shortcode; ?>" />
                <small>
                    <?php
                    printf( __( 'Download contact form 7 from %1$shere%2$s', 'education-base' ), "<a target='_blank' href='".esc_url( 'https://wordpress.org/plugins/contact-form-7/' )."''>","</a>" );
                    ?>
                </small>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'page_id' ); ?>"><?php _e( 'Select Page For Contact', 'education-base' ); ?>:</label>
                <br />
                <small><?php _e( 'Select page and its title and excerpt will display in the frontend. No need of subpages.', 'education-base' ); ?></small>
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
            $instance[ 'shortcode' ] = wp_kses_post( $new_instance[ 'shortcode' ] );
            $instance[ 'page_id' ] = absint( $new_instance[ 'page_id' ] );

            return $instance;
        }

        /**
         * Function to Creating widget front-end. This is where the action happens
         *
         * @access public
         * @since 1.0
         *
         * @param array $args widget setting
         * @param array $instance saved values
         * @return void
         *
         */
        public function widget($args, $instance) {
            $animation1 = 'init-animate fadeInLeftBig1';
            $animation2 = 'init-animate fadeInRightBig1';

            $instance = wp_parse_args( (array) $instance, $this->defaults);

            /*default values*/
            $unique_id = !empty( $instance[ 'unique_id' ] ) ? esc_attr( $instance[ 'unique_id' ] ) : esc_attr( $this->id );
            $title = apply_filters( 'widget_title', !empty( $instance['title'] ) ? $instance['title'] : '', $instance, $this->id_base );
            $shortcode = wp_kses_post( $instance[ 'shortcode' ] );
            $page_id = absint( $instance[ 'page_id' ] );
            echo $args['before_widget'];
            ?>
            <section id="<?php echo $unique_id;?>" class="acme-widgets acme-contact">
                <div class="contact-form">
                    <div class="container">
                        <div class="row">
							
                            <?php
                            if( !empty( $title ) ) {
                                echo '<div class="main-title init-animate fadeInDown2">';
                                echo $args['before_title'] .esc_html( $title ).$args['after_title'];
                                echo '</div>';
                            }
                            ?>
                            <div class="col-sm-6  <?php echo $animation1; ?>">
                                <?php echo do_shortcode( $shortcode ); ?>
                            </div>
                            <?php
                            if( !empty ( $page_id ) ) :
                                $education_base_child_page_args = array(
                                    'page_id'             => $page_id,
                                    'posts_per_page'      => 1,
                                    'post_type'           => 'page',
                                    'no_found_rows'       => true,
                                    'post_status'         => 'publish'
                                );
                                $service_query = new WP_Query( $education_base_child_page_args );
                                /*The Loop*/
                                if ( $service_query->have_posts() ):
                                    while( $service_query->have_posts() ):$service_query->the_post();
                                        ?>
                                        <div class="col-sm-6  <?php echo $animation2; ?>">
                                            <?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
                                            <div class="contact-page-content">
                                                <?php
                                                the_content();
                                                ?>
                                            </div>
                                        </div>
                                        <?php
                                    endwhile;
                                endif;
                            endif;
                            ?>
                        </div>
                    </div>
                </div>
            </section>
            <?php
	        wp_reset_postdata();
	        echo $args['after_widget'];
        }
    } // Class Education_base_contact ends here
}

/**
 * Function to Register and load the widget
 *
 * @since 1.0.0
 *
 * @param null
 * @return void
 *
 */
if ( ! function_exists( 'education_base_contact' ) ) :

    function education_base_contact() {
        register_widget( 'Education_base_contact' );
    }
endif;
add_action( 'widgets_init', 'education_base_contact' );