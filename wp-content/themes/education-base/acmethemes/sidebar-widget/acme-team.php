<?php
/**
 * Team Widgets
 *
 * @since Education Base 1.0.0
 *
 * @param null
 * @return array $education_base_team_column_number
 *
 */
if ( !function_exists('education_base_team_column_number') ) :
    function education_base_team_column_number() {
        $education_base_team_column_number =  array(
            1 => __( '1', 'education-base' ),
            2 => __( '2', 'education-base' ),
            3 => __( '3', 'education-base' ),
            4 =>  __( '4', 'education-base' )
        );
        return apply_filters( 'education_base_team_column_number', $education_base_team_column_number );
    }
endif;

/**
 * Class for adding Team Section Widget
 *
 * @package Acme Themes
 * @subpackage Education Base
 * @since 1.0.0
 */
if ( ! class_exists( 'Education_base_team' ) ) {

    class Education_base_team extends WP_Widget {
        /*defaults values for fields*/
        private $defaults = array(
            'unique_id'     => '', 
            'title'         => '',

            'page_id'       => '',
            'post_number' => 4,

            'at_all_page_items'=> '',
            'column_number' => 4
        );

        function __construct() {
            parent::__construct(
            /*Base ID of your widget*/
                'education_base_team',
                /*Widget name will appear in UI*/
                __('AT Team Section', 'education-base'),
                /*Widget description*/
                array( 'description' => __( 'Show Team Section.', 'education-base' ), )
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
				    $post_number    = ( isset($instance['team_number']) ? $instance['team_number'] : -1 );
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
            $instance = wp_parse_args( (array) $instance, $this->defaults );
            /*default values*/
            $unique_id = esc_attr( $instance[ 'unique_id' ] );
            $title = esc_attr( $instance[ 'title' ] );

            $page_id = absint( $instance[ 'page_id' ] );
            $post_number = absint( $instance[ 'post_number' ] );

	        $at_all_page_items      = $instance['at_all_page_items'];
	        $column_number = absint( $instance[ 'column_number' ] );

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
	        if( $page_id != 0 ){
	            ?>
                <p>
                    <label for="<?php echo $this->get_field_id( 'page_id' ); ?>"><?php _e( 'Select Page For Team', 'education-base' ); ?>:</label>
                    <br />
                    <small><?php _e( 'Select parent page and its subpages will display in the frontend. If page does not have any subpages, then selected single page will display', 'education-base' ); ?></small>
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
                <label><?php _e( 'Select Pages For Team', 'education-base' ); ?>:</label>
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
            <p>
                <label for="<?php echo $this->get_field_id( 'column_number' ); ?>"><?php _e( 'Column Number', 'education-base' ); ?>:</label>
                <select class="widefat" id="<?php echo $this->get_field_id( 'column_number' ); ?>" name="<?php echo $this->get_field_name( 'column_number' ); ?>" >
                    <?php
                    $education_base_team_column_numbers = education_base_team_column_number();
                    foreach ( $education_base_team_column_numbers as $key => $value ){
                        ?>
                        <option value="<?php echo esc_attr( $key )?>" <?php selected( $key, $column_number ); ?>><?php echo esc_html( $value );?></option>
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
            $instance = wp_parse_args( (array) $instance, $this->defaults);

            /*default values*/
            $unique_id = !empty( $instance[ 'unique_id' ] ) ? esc_attr( $instance[ 'unique_id' ] ) : esc_attr( $this->id );
            $title = apply_filters( 'widget_title', !empty( $instance['title'] ) ? $instance['title'] : '', $instance, $this->id_base );

            $page_id = absint( $instance[ 'page_id' ] );
            $post_number = absint( $instance[ 'post_number' ] );

	        $at_all_page_items    = $instance['at_all_page_items'];

            $column_number = absint( $instance[ 'column_number' ] );

            echo $args['before_widget'];
            ?>
            <section id="<?php echo esc_attr( $unique_id );?>" class="acme-widgets acme-teams">
                <div class="container">
                     <div class="main-title init-animate slideInUp1" style="visibility: visible; animation-name: slideInUp;">
                        <h2 class="widget-title">
									 <?php 
							if($_SERVER['REQUEST_URI'] == '/'){
								?>
							<span>Interaktiv Xizmatlar</span>
							<?php
							}
							if($_SERVER['REQUEST_URI'] == '/ru/'){
												?>
							<span>Интерактивные Услуги</span>
							<?php
							}if($_SERVER['REQUEST_URI'] == '/en/'){
												?>
							<span>Interactive Services</span>
							<?php
							}?>
			
						</h2><div class="line"><span class="fa fa-graduation-cap"></span></div>                    </div>
                    <div class="row">
                     
                                    <ul class="honeycomb" lang="es">
        <li class="honeycomb-cell">

            <div class="honeycomb-cell__title">Elektron kutubxona</div>
        </li>
        <li class="honeycomb-cell">
            <a href="/virtual-qabulxona/"><div class="honeycomb-cell__title">Virtual qabulxona</div></a>
        </li>
        <li class="honeycomb-cell">
			<a href="https://pf.bimm.uz/"><div class="honeycomb-cell__title">Portfolio</div></a>
        </li>
        <li class="honeycomb-cell">
			<a href="https://students.terdupi.uz"><div class="honeycomb-cell__title">Hemis Talaba</div></a>
        </li>
        <li class="honeycomb-cell">
			<a href="https://hemis.terdupi.uz"><div class="honeycomb-cell__title">Hemis O'qituvchi</div></a>
        </li>
        <li class="honeycomb-cell">
			<a href="https://my.gov.uz/oz/university-reference/passport"><div class="honeycomb-cell__title">O‘qish joyidan ma’lumotnoma olish</div></a>
        </li>
        <li class="honeycomb-cell">
			<a href="https://diplom.edu.uz/"><div class="honeycomb-cell__title">Bitiruvchilarga diplomlarni elektron olish</div></a>
        </li>
        <li class="honeycomb-cell honeycomb__placeholder"></li>
    </ul>
    <style>
 .honeycomb {
	 display: flex;
	 flex-wrap: wrap;
	 list-style: none;
	 justify-content: center;
	 align-items: center;
	 max-width: 1200px;
	 margin: 0 auto;
	 padding: 0;
	 transform: translateY(34.375px);
}
.honeycomb-cell{
	box-shadow: 10px 5px 100px #bebebe;
}
 .honeycomb-cell {
	 flex: 0 1 250px;
	 max-width: 250px;
	 height: 137.5px;
	 margin: 65.4761904762px 12.5px 25px;
	 position: relative;
	 padding: 0.5em;
	 text-align: center;
	 z-index: 1;
}
 .honeycomb-cell__title {
	 height: 100%;
	 display: flex;
	 flex-direction: column;
	 justify-content: center;
	 hyphens: auto;
	 word-break: break-word;
	 text-transform: uppercase;
	 color: #252E66;
	 font-weight: 700;
	 font-size: 1.75em;
	 transition: opacity 350ms;
}
 .honeycomb-cell__title > small {
	 font-weight: 300;
	 margin-top: 0.25em;
}
 .honeycomb-cell__image {
	 object-fit: cover;
	 object-position: center;
}
 .honeycomb-cell::before, .honeycomb-cell::after {
	 content: '';
}
 .honeycomb-cell::before, .honeycomb-cell::after, .honeycomb-cell__image {
	 top: -50%;
	 left: 0;
	 width: 100%;
	 height: 200%;
	 display: block;
	 position: absolute;
	 clip-path: polygon(50% 0%, 100% 25%, 100% 75%, 50% 100%, 0% 75%, 0% 25%);
	 z-index: -1;
}
 .honeycomb-cell::before {
	 background: #fff;
	 transform: scale(1.055);
}
 .honeycomb-cell::after {
	 background: #d3d3d3;
	 opacity: 0.5;
	 transition: opacity 350ms;
}


.honeycomb-cell:hover{
	box-shadow: 10px 5px 100px #252E66;
}

 .honeycomb__placeholder {
	 display: none;
	 opacity: 0;
	 width: 250px;
	 margin: 0 12.5px;
}
 @media (max-width: 550px) {
	 .honeycomb-cell {
		 margin: 81.25px 25px;
	}
}
 @media (min-width: 550px) and (max-width: 825px) {
	 .honeycomb-cell:nth-child(3n) {
		 margin-right: calc(50% - 125px);
		 margin-left: calc(50% - 125px);
	}
	 .honeycomb__placeholder:nth-child(3n + 5) {
		 display: block;
	}
}
 @media (min-width: 825px) and (max-width: 1100px) {
	 .honeycomb-cell:nth-child(5n + 4) {
		 margin-left: calc(50% - 275px);
	}
	 .honeycomb-cell:nth-child(5n + 5) {
		 margin-right: calc(50% - 275px);
	}
	 .honeycomb__placeholder:nth-child(5n), .honeycomb__placeholder:nth-child(5n + 3) {
		 display: block;
	}
}
 @media (min-width: 1100px) {
	 .honeycomb-cell:nth-child(7n + 5) {
		 margin-left: calc(50% - 400px);
	}
	 .honeycomb-cell:nth-child(7n + 7), .honeycomb-cell:nth-child(7n + 5):nth-last-child(2) {
		 margin-right: calc(50% - 400px);
	}
	 .honeycomb__placeholder:nth-child(7n + 7), .honeycomb__placeholder:nth-child(7n + 9), .honeycomb__placeholder:nth-child(7n + 11) {
		 display: block;
	}
}
 </style>
			<section id="courses" class="acme-widgets popular-course">
                <div class="container">
                    <div class="main-title init-animate slideInUp1" style="visibility: visible; animation-name: slideInUp;">
                        <h2 class="widget-title">
									 <?php 
							if($_SERVER['REQUEST_URI'] == '/'){
								?>
							<span>Professor O'qituvchilar</span>
							<?php
							}
							if($_SERVER['REQUEST_URI'] == '/ru/'){
												?>
							<span>Профессор Учителя</span>
							<?php
							}if($_SERVER['REQUEST_URI'] == '/en/'){
												?>
							<span>Professor Teachers</span>
							<?php
							}?>
			
						</h2><div class="line"><span class="fa fa-graduation-cap"></span></div>                    </div>
                    <div class="row">
						<body>
														  <div class="container">
															<input type="radio" name="dot" id="one">
															<input type="radio" name="dot" id="two">
															<div class="main-card">
															  <div class="cards">
																<div class="card">
																 <div class="content">
																   <div class="img">
																	 <img src="images/img1.jpg" alt="">
																   </div>
																   <div class="details">
																	 <div class="name">Andrew Neil</div>
																	 <div class="job">Web Designer</div>
																   </div>
																   <div class="media-icons">
																	 <a href="#"><i class="fab fa-facebook-f"></i></a>
																	 <a href="#"><i class="fab fa-twitter"></i></a>
																	 <a href="#"><i class="fab fa-instagram"></i></a>
																	 <a href="#"><i class="fab fa-youtube"></i></a>
																   </div>
																 </div>
																</div>
																<div class="card">
																 <div class="content">
																   <div class="img">
																	 <img src="images/img2.jpg" alt="">
																   </div>
																   <div class="details">
																	 <div class="name">Jasmine Carter</div>
																	 <div class="job">UI Designer</div>
																   </div>
																   <div class="media-icons">
																	 <a href="#"><i class="fab fa-facebook-f"></i></a>
																	 <a href="#"><i class="fab fa-twitter"></i></a>
																	 <a href="#"><i class="fab fa-instagram"></i></a>
																	 <a href="#"><i class="fab fa-youtube"></i></a>
																   </div>
																 </div>
																</div>
																<div class="card">
																 <div class="content">
																   <div class="img">
																	 <img src="images/img3.jpg" alt="">
																   </div>
																   <div class="details">
																	 <div class="name">Justin Chung</div>
																	 <div class="job">Web Devloper</div>
																   </div>
																   <div class="media-icons">
																	 <a href="#"><i class="fab fa-facebook-f"></i></a>
																	 <a href="#"><i class="fab fa-twitter"></i></a>
																	 <a href="#"><i class="fab fa-instagram"></i></a>
																	 <a href="#"><i class="fab fa-youtube"></i></a>
																   </div>
																 </div>
																</div>
															  </div>
															  <div class="cards">
																<div class="card">
																 <div class="content">
																   <div class="img">
																	 <img src="images/img4.jpg" alt="">
																   </div>
																   <div class="details">
																	 <div class="name">Appolo Reef</div>
																	 <div class="job">Web Designer</div>
																   </div>
																   <div class="media-icons">
																	 <a href="#"><i class="fab fa-facebook-f"></i></a>
																	 <a href="#"><i class="fab fa-twitter"></i></a>
																	 <a href="#"><i class="fab fa-instagram"></i></a>
																	 <a href="#"><i class="fab fa-youtube"></i></a>
																   </div>
																 </div>
																</div>
																<div class="card">
																 <div class="content">
																   <div class="img">
																	 <img src="images/img5.jpg" alt="">
																   </div>
																   <div class="details">
																	 <div class="name">Adrina Calvo</div>
																	 <div class="job">UI Designer</div>
																   </div>
																   <div class="media-icons">
																	 <a href="#"><i class="fab fa-facebook-f"></i></a>
																	 <a href="#"><i class="fab fa-twitter"></i></a>
																	 <a href="#"><i class="fab fa-instagram"></i></a>
																	 <a href="#"><i class="fab fa-youtube"></i></a>
																   </div>
																 </div>
																</div>
																<div class="card">
																 <div class="content">
																   <div class="img">
																	 <img src="images/img6.jpeg" alt="">
																   </div>
																   <div class="details">
																	 <div class="name">Nicole Lewis</div>
																	 <div class="job">Web Devloper</div>
																   </div>
																   <div class="media-icons">
																	 <a href="#"><i class="fab fa-facebook-f"></i></a>
																	 <a href="#"><i class="fab fa-twitter"></i></a>
																	 <a href="#"><i class="fab fa-instagram"></i></a>
																	 <a href="#"><i class="fab fa-youtube"></i></a>
																   </div>
																 </div>
																</div>
															  </div>
															</div>
															<div class="button">
															  <label for="one" class=" active one"></label>
															  <label for="two" class="two"></label>
															</div>
														  </div>
														</body>
											<style>
											<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>

														.container {
															max-width: 950px;
															width: 100%;
															overflow: hidden;
															padding: 80px 0;
														}

														.container .main-card {
															display: flex;
															justify-content: space-evenly;
															width: 200%;
															transition: 1s;
														}

														#two:checked~.main-card {
															margin-left: -100%;
														}

														.container .main-card .cards {
															width: calc(100% / 2 - 10px);
															display: flex;
															flex-wrap: wrap;
															margin: 0 20px;
															justify-content: space-between;
														}

														.main-card .cards .card {
															width: calc(100% / 3 - 10px);
															background: #fff;
															border-radius: 12px;
															padding: 30px;
															box-shadow: 0 5px 10px rgba(0, 0, 0, 0.25);
															transition: all 0.4s ease;
														}

														.main-card .cards .card:hover {
															transform: translateY(-15px);
														}

														.cards .card .content {
															width: 100%;
															display: flex;
															flex-direction: column;
															justify-content: center;
															align-items: center;
															text-align: center;
														}

														.cards .card .content .img {
															height: 227px;
															width: 218px;
															background: #FF676D;
															margin-bottom: 14px;
														}

														.card .content .img img {
															height: 100%;
															width: 100%;
															border: 3px solid #ffff;
															object-fit: cover;
														}

														.card .content .name {
															font-size: 20px;
															font-weight: 500;
														}

														.card .content .job {
															font-size: 20px;
															color: #FF676D;
														}

														.card .content .media-icons {
															margin-top: 10px;
															display: flex;
														}

														.media-icons a {
															text-align: center;
															line-height: 33px;
															height: 35px;
															width: 35px;
															margin: 0 4px;
															font-size: 14px;
															color: #FFF;
															border-radius: 50%;
															border: 2px solid transparent;
															background: #FF676D;
															transition: all 0.3s ease;
														}

														.media-icons a:hover {
															color: #FF676D;
															background-color: #fff;
															border-color: #FF676D;
														}

														.container .button {
															width: 100%;
															display: flex;
															justify-content: center;
															margin: 20px;
														}

														.button label {
															height: 15px;
															width: 15px;
															border-radius: 20px;
															background: #000;
															margin: 0 4px;
															cursor: pointer;
															transition: all 0.5s ease;
														}

														.button label.active {
															width: 35px;
														}

														#one:checked~.button .one {
															width: 35px;
														}

														#one:checked~.button .two {
															width: 15px;
														}

														#two:checked~.button .one {
															width: 15px;
														}

														#two:checked~.button .two {
															width: 35px;
														}

														input[type="radio"] {
															display: none;
														}

														@media (max-width: 768px) {
															.main-card .cards .card {
																margin: 20px 0 10px 0;
																width: calc(100% / 2 - 10px);
															}
														}

														@media (max-width: 600px) {
															.main-card .cards .card {
																/* margin: 20px 0 10px 0; */
																width: 100%;
															}
														}
										</style>
                    </div>
                </div>
				
            </section>
                 
                    </div>
                </div>
            </section>
            <?php
	        wp_reset_postdata();
	        echo $args['after_widget'];
        }
    } // Class Education Base_team ends here
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
if ( ! function_exists( 'education_base_team' ) ) :

    function education_base_team() {
        register_widget( 'Education_base_team' );
    }
endif;
add_action( 'widgets_init', 'education_base_team' );