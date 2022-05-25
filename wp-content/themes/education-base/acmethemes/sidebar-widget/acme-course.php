<?php
/**
 * Course Widgets
 *
 * @since Education Base 1.0.0
 *
 * @param null
 * @return array $education_base_course_column_number
 *
 */
if ( !function_exists('education_base_course_column_number') ) :
    function education_base_course_column_number() {
        $education_base_course_column_number =  array(
            1 => __( '1', 'education-base' ),
            2 => __( '2', 'education-base' ),
            3 => __( '3', 'education-base' ),
            4 =>  __( '4', 'education-base' )
        );
        return apply_filters( 'education_base_course_column_number', $education_base_course_column_number );
    }
endif;

/**
 * Class for adding Course Section Widget
 *
 * @package Acme Themes
 * @subpackage Education Base
 * @since 1.0.0
 */
if ( ! class_exists( 'Education_base_course' ) ) {

    class Education_base_course extends WP_Widget {
        /*defaults values for fields*/

        private function defaults(){
            /*defaults values for fields*/
            $defaults = array(
                'unique_id'     => '',
                'title'         => '',

                'page_id'       => '',
                'post_number'   => 3,

                'at_all_page_items'=> '',
                'column_number' => 3,
                'read_more_text'=> __( 'Read More', 'education-base' )
            );
            return $defaults;
        }

        function __construct() {
            parent::__construct(
            /*Base ID of your widget*/
                'education_base_course',
                /*Widget name will appear in UI*/
                __('AT Course Section', 'education-base'),
                /*Widget description*/
                array( 'description' => __( 'Show Course Section.', 'education-base' ), )
            );
	        $this->at_migrate_parent_page_to_repeater();
        }

	    public function at_migrate_parent_page_to_repeater() {
		    if( !is_admin() ){
			    return;
		    }
		    $all_instances = $this->get_settings();
		    foreach ( $all_instances as $key => $instance ) {
			    $parent_page_id = ( isset( $instance['page_id'] )? $instance['page_id'] : 0 );
			    $post_number    = ( isset($instance['post_number']) ? $instance['post_number'] : -1 );
			    if( -1 == $post_number ){
				    $post_number    = ( isset($instance['course_number']) ? $instance['course_number'] : -1 );
			    }

			    if( $parent_page_id == 0 ){
				    continue;
			    }

			    if ( 0 != $parent_page_id ) {
				    $page_ids = array();
				    $education_base_child_page_args = array(
					    'post_parent'    => $parent_page_id,
					    'posts_per_page' => $post_number,
					    'post_type'      => 'page',
					    'no_found_rows'  => true,
					    'post_status'    => 'publish'
				    );
				    $slider_query = new WP_Query( $education_base_child_page_args );
				    if ( ! $slider_query->have_posts() ) {
					    $education_base_child_page_args = array(
						    'page_id'        => $parent_page_id,
						    'posts_per_page' => 1,
						    'post_type'      => 'page',
						    'no_found_rows'  => true,
						    'post_status'    => 'publish'
					    );
					    $slider_query = new WP_Query( $education_base_child_page_args );
				    }
				    /*The Loop*/
				    if ( $slider_query->have_posts() ):
					    $i = 0;
					    while ( $slider_query->have_posts() ):$slider_query->the_post();
						    $page_ids[$i]['page_id'] = absint( get_the_ID() );
						    $i++;
					    endwhile;
				    endif;
				    wp_reset_postdata();
				    $instance['at_all_page_items'] = $page_ids;
				    $instance['page_id'] = 0;
				    $all_instances[$key] = $instance;
			    }
		    }
		    $this->save_settings( $all_instances );
	    }

        /*Widget Backend*/
        public function form( $instance ) {
            $instance = wp_parse_args( (array) $instance, $this->defaults() );
            /*default values*/
            $unique_id = esc_attr( $instance[ 'unique_id' ] );
            $title = esc_attr( $instance[ 'title' ] );

            $page_id = absint( $instance[ 'page_id' ] );
            $post_number = absint( $instance[ 'post_number' ] );

	        $at_all_page_items      = $instance['at_all_page_items'];

	        $column_number = absint( $instance[ 'column_number' ] );
            $read_more_text = esc_attr( $instance[ 'read_more_text' ] );
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

            <!--updated code-->
	        <?php
	        if( $page_id != 0 ) {
	            ?>
                <p>
                    <label for="<?php echo $this->get_field_id( 'page_id' ); ?>"><?php _e( 'Select Parent Page For Course', 'education-base' ); ?>:</label>
                    <br />
                    <small><?php _e( 'Select parent page and its subpages will display in the frontend. If pages does not have any subpages, then selected single page will display', 'education-base' ); ?></small>
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
                    <label for="<?php echo $this->get_field_id( 'post_number' ); ?>"><?php _e( 'Post Number', 'education-base' ); ?>:</label>
                    <input class="widefat" id="<?php echo $this->get_field_id( 'post_number' ); ?>" name="<?php echo $this->get_field_name( 'post_number' ); ?>" type="number" value="<?php echo $post_number; ?>" />
                </p>
                <?php
            }
	        else{
		        ?>
                <label><?php _e( 'Select Pages For Course', 'education-base' ); ?>:</label>
                <br/>
                <small><?php _e( 'Add Page, Reorder and Remove. Please do not forget to add Featured Image and Excerpt on selected pages', 'education-base' ); ?></small>
                <div class="at-repeater">
			        <?php
			        $total_repeater = 0;
			        if  ( is_array( $at_all_page_items ) && count( $at_all_page_items ) > 0 ){
				        foreach ($at_all_page_items as $about){
					        $repeater_id  = $this->get_field_id( 'at_all_page_items') .$total_repeater.'page_id';
					        $repeater_name  = $this->get_field_name( 'at_all_page_items' ).'['.$total_repeater.']['.'page_id'.']';
					        ?>
                            <div class="repeater-table">
                                <div class="at-repeater-top">
                                    <div class="at-repeater-title-action">
                                        <button type="button" class="at-repeater-action">
                                            <span class="at-toggle-indicator" aria-hidden="true"></span>
                                        </button>
                                    </div>
                                    <div class="at-repeater-title">
                                        <h3><?php _e( 'Select Item', 'education-base' )?><span class="in-at-repeater-title"></span></h3>
                                    </div>
                                </div>
                                <div class='at-repeater-inside hidden'>
							        <?php
							        /* see more here https://codex.wordpress.org/Function_Reference/wp_dropdown_pages*/
							        $args = array(
								        'selected'         => $about['page_id'],
								        'name'             => $repeater_name,
								        'id'               => $repeater_id,
								        'class'            => 'widefat at-select',
								        'show_option_none' => __( 'Select Page', 'education-base'),
								        'option_none_value'     => 0 // string
							        );
							        wp_dropdown_pages( $args );
							        ?>
                                    <div class="at-repeater-control-actions">
                                        <button type="button" class="button-link button-link-delete at-repeater-remove"><?php _e('Remove','education-base');?></button> |
                                        <button type="button" class="button-link at-repeater-close"><?php _e('Close','education-base');?></button>
                                        <a class="button button-link at-postid alignright" target="_blank" data-href="<?php echo admin_url( 'post.php?post=POSTID&action=edit' ); ?>" href="<?php echo admin_url( 'post.php?post='.$about['page_id'].'&action=edit' ); ?>"><?php _e('Full Edit','education-base');?></a>
                                    </div>
                                </div>
                            </div>
					        <?php
					        $total_repeater = $total_repeater + 1;
				        }
			        }
			        $coder_repeater_depth = 'coderRepeaterDepth_'.'0';
			        $repeater_id  = $this->get_field_id( 'at_all_page_items') .$coder_repeater_depth.'page_id';
			        $repeater_name  = $this->get_field_name( 'at_all_page_items' ).'['.$coder_repeater_depth.']['.'page_id'.']';
			        ?>
                    <script type="text/html" class="at-code-for-repeater">
                        <div class="repeater-table">
                            <div class="at-repeater-top">
                                <div class="at-repeater-title-action">
                                    <button type="button" class="at-repeater-action">
                                        <span class="at-toggle-indicator" aria-hidden="true"></span>
                                    </button>
                                </div>
                                <div class="at-repeater-title">
                                    <h3><?php _e( 'Select Item', 'education-base' )?><span class="in-at-repeater-title"></span></h3>
                                </div>
                            </div>
                            <div class='at-repeater-inside hidden'>
						        <?php
						        /* see more here https://codex.wordpress.org/Function_Reference/wp_dropdown_pages*/
						        $args = array(
							        'selected'         => '',
							        'name'             => $repeater_name,
							        'id'               => $repeater_id,
							        'class'            => 'widefat at-select',
							        'show_option_none' => __( 'Select Page', 'education-base'),
							        'option_none_value'     => 0 // string
						        );
						        wp_dropdown_pages( $args );
						        ?>
                                <div class="at-repeater-control-actions">
                                    <button type="button" class="button-link button-link-delete at-repeater-remove"><?php _e('Remove','education-base');?></button> |
                                    <button type="button" class="button-link at-repeater-close"><?php _e('Close','education-base');?></button>
                                    <a class="button button-link at-postid alignright hidden" target="_blank" data-href="<?php echo admin_url( 'post.php?post=POSTID&action=edit' ); ?>" href=""><?php _e('Full Edit','education-base');?></a>
                                </div>
                            </div>
                        </div>

                    </script>
			        <?php
			        /*most imp for repeater*/
			        echo '<input class="at-total-repeater" type="hidden" value="'.$total_repeater.'">';
			        $add_field = __('Add Item', 'education-base');
			        echo '<span class="button-primary at-add-repeater" id="'.$coder_repeater_depth.'">'.$add_field.'</span><br/>';
			        ?>
                </div>
		        <?php
	        }
	        ?>
            <!--updated code-->

            <p>
                <label for="<?php echo $this->get_field_id( 'column_number' ); ?>"><?php _e( 'Column Number', 'education-base' ); ?>:</label>
                <select class="widefat" id="<?php echo $this->get_field_id( 'column_number' ); ?>" name="<?php echo $this->get_field_name( 'column_number' ); ?>" >
                    <?php
                    $education_base_course_column_numbers = education_base_course_column_number();
                    foreach ( $education_base_course_column_numbers as $key => $value ){
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

            $instance[ 'page_id' ] = absint( $new_instance[ 'page_id' ] );
            $instance[ 'post_number' ] = absint( $new_instance[ 'post_number' ] );

	        /*updated code*/
	        $instance['at_all_page_items']    = $new_instance['at_all_page_items'];
	        $page_ids = array();
	        foreach ($new_instance['at_all_page_items'] as $key=>$about ){
		        $page_ids[$key]['page_id'] = absint( $about['page_id'] );
	        }
	        $instance['at_all_page_items'] = $page_ids;

            $instance[ 'column_number' ] = absint( $new_instance[ 'column_number' ] );
            $instance[ 'read_more_text' ] = sanitize_text_field( $new_instance[ 'read_more_text' ] );

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
            if( isset( $args['id'] ) ){
                $education_base_sidebar_id = $args['id'];
            }
            else{
                $education_base_sidebar_id = 'education-base-home';
            }
            $init_animate_title = '';
            $init_animate_content = '';
            if ( 'education-base-home' == $education_base_sidebar_id ){
                $init_animate_title = "init-animate slideInUp1";
                $init_animate_content = "init-animate slideInUp1";
            }
            $instance = wp_parse_args( (array) $instance, $this->defaults());

            /*default values*/
            $unique_id = !empty( $instance[ 'unique_id' ] ) ? esc_attr( $instance[ 'unique_id' ] ) : esc_attr( $this->id );
            $title = apply_filters( 'widget_title', !empty( $instance['title'] ) ? $instance['title'] : '', $instance, $this->id_base );

            $page_id = absint( $instance[ 'page_id' ] );
            $post_number = absint( $instance[ 'post_number' ] );

	        $at_all_page_items    = $instance['at_all_page_items'];

	        $column_number = absint( $instance[ 'column_number' ] );
            $read_more_text = esc_html( $instance[ 'read_more_text' ] );

            echo $args['before_widget'];
            ?>
            <section id="<?php echo $unique_id;?>" class="acme-widgets popular-course">
                <div class="container">
                    <div class="main-title <?php echo esc_attr( $init_animate_title ); ?>">
                        <?php
                        if( !empty( $title ) ) {
                            echo $args['before_title'] .esc_html( $title ).$args['after_title'];
                        }
                        ?>
                    </div>
                    <div class="row">
                        <?php
                        $education_base_child_page_args = array();
                        $post_in = array();
                        if ( is_array( $at_all_page_items ) && count( $at_all_page_items ) > 0 ){
	                        foreach ( $at_all_page_items as $about ){
		                        if( isset( $about['page_id'] ) && !empty( $about['page_id'] ) ){
			                        $post_in[] = $about['page_id'];
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
                        elseif( ! empty ( $page_id ) ):
	                        $education_base_child_page_args = array(
		                        'post_parent'    => $page_id,
		                        'posts_per_page' => $post_number,
		                        'post_type'      => 'page',
		                        'no_found_rows'  => true,
		                        'post_status'    => 'publish'
	                        );
	                        $about_query = new WP_Query( $education_base_child_page_args );
	                        if ( ! $about_query->have_posts() ) {
		                        $education_base_child_page_args = array(
			                        'page_id'        => $page_id,
			                        'posts_per_page' => 1,
			                        'post_type'      => 'page',
			                        'no_found_rows'  => true,
			                        'post_status'    => 'publish'
		                        );
		                        $column_number                  = 1;
	                        }
                        endif;
                        if( !empty( $education_base_child_page_args ) ):
	                        $course_query = new WP_Query( $education_base_child_page_args );
                            /*The Loop*/
                            if ( $course_query->have_posts() ):
                                $i = 1;
                                global $education_base_read_more_text;
                                $education_base_read_more_text = $read_more_text;
                                while( $course_query->have_posts() ):$course_query->the_post();
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
                                    <div class="course-item-wrapper <?php echo $init_animate_content; ?>">
                                        <?php get_template_part( 'template-parts/content', 'course' );?>
                                    </div>
                                    <?php
                                    if( 0 == $i % $column_number ){
                                        echo "<div class='clearfix'></div>";
                                    }
                                    $i++;
                                endwhile;
                            else:
                                /*do nothing for now*/
                            endif;
                        endif;
                        wp_reset_postdata();
                    ?>
                    </div>
                </div>
            </section>
            <?php
	        wp_reset_postdata();
	        echo $args['after_widget'];
        }
    } // Class Education_base_course ends here
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
if ( ! function_exists( 'education_base_course' ) ) :

    function education_base_course() {
        register_widget( 'Education_base_course' );
    }
endif;
add_action( 'widgets_init', 'education_base_course' );