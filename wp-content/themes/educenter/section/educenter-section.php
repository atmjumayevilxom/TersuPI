<?php
/**
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Educenter
 */


if ( ! function_exists( 'educenter_banner_section' ) ) :

	/**
	 * Main Banner/Slider Section
	 *
	 * @since 1.0.0
	*/
	function educenter_banner_section() { 

		$option = get_theme_mod( 'educenter_slider_options', 1 );

		if( !empty( $option ) && $option == 1 ){ ?>

		<section class="ed-slider slider-layout-2 slider-nav-<?php echo esc_attr(get_theme_mod('educenter_banner_nav_style', 1)); ?>">
			<div class="ed-slide">
				<?php
				if( get_theme_mod('educenter_homepage_slider_type', 'default') == 'default'):
					educenter_default_banner_content();
				else:
					educenter_advance_banner_content();
				endif;
				?>

			</div>
		</section>

	<?php } }

endif;

add_action( 'educenter_action_front_page','educenter_banner_section', 5 );

if( !function_exists( 'educenter_default_banner_content')):
	function educenter_default_banner_content(){
		$all_slider = get_theme_mod('educenter_banner_all_sliders');

		if( $all_slider ) {

			$banner_slider = json_decode( $all_slider );

			foreach($banner_slider as $slider){ 

				$page_id = $slider->slider_page;

			if( !empty( $page_id ) ) {

				$slider_page = new WP_Query( 'page_id='.$page_id );		

			if( $slider_page->have_posts() ) { while( $slider_page->have_posts() ) { $slider_page->the_post();

			$image_path = wp_get_attachment_image_src( get_post_thumbnail_id(), 'educenter-slider', true );

		?>
			<div class="slide">

				<img src="<?php echo esc_url( $image_path[0] ); ?>" alt="<?php the_title_attribute(); ?>">

				<div class="ed-overlay"></div>

				<div class="container">
					<div class="ed-slider-info">
						
						<h2><?php the_title(); ?></h2>

						<?php the_excerpt(); ?>

						<?php if( $slider->button_text || $slider->button_url ){ ?>
							<a class="slider-button ed-button" href="<?php echo esc_url( $slider->button_url ); ?>" class="btn primary">
								<?php echo esc_html( $slider->button_text ); ?>
							</a>
						<?php } ?>

					</div>
				</div>
			</div>

		<?php } } wp_reset_postdata(); } } }
	}
endif;

if( !function_exists( 'educenter_advance_banner_content')):
	function educenter_advance_banner_content(){
		$all_slider = get_theme_mod('educenter_banner_normal_all_sliders');

		if( $all_slider ) {

			$banner_slider = json_decode( $all_slider );

			foreach($banner_slider as $slider){ ?>
			<div class="slide">

				<img src="<?php echo esc_url( $slider->slider_img ); ?>">

				<div class="ed-overlay"></div>

				<div class="container">
					<div class="ed-slider-info">
						<?php if($slider->slider_title): ?>
						<h2><?php echo esc_html($slider->slider_title) ?></h2>
						<?php endif; ?>
						<?php if( $slider->slider_desc ): echo '<p>'. $slider->slider_desc. '</p>'; endif; ?>
						
						<?php if( $slider->button_text || $slider->button_url ){ ?>
							<a class="slider-button ed-button" href="<?php echo esc_url( $slider->button_url ); ?>" class="btn primary">
								<?php echo esc_html( $slider->button_text ); ?>
							</a>
						<?php } ?>

					</div>
				</div>
			</div>

		<?php } }
	}
endif;


if ( ! function_exists( 'educenter_features_services_section' ) ) :

	/**
	 * Features Services Section
	 *
	 * @since 1.0.0
	*/
	function educenter_features_services_section() { 

		$foption = get_theme_mod( 'educenter_fservices_area_options', 0 );

		if( !empty( $foption ) && $foption == 1 ){ ?>

			<section id="edu-features-section" class="ed-services layout-3">
				<div class="container">
					<div class="ed-service-left">
						<?php
							/**
							 * Section Main Title & SubTitle
							*/
							$title    = get_theme_mod('educenter_fservices_section_title');
							$subtitle = get_theme_mod('educenter_fservices_section_subtitle');

							educenter_section_title( $title, $subtitle );
						?>

						<div class="ed-col-holder clearfix">
							<div class="ed-service-slide cS-hidden" data-items="<?php echo esc_attr(get_theme_mod('educenter_homepage_service_slider_item', 3)); ?>">
								<?php
									if( get_theme_mod('educenter_homepage_service_type', 'default') == 'default'):
										educenter_fservice_default_content();	
									else:
										educenter_fservice_advance_content();
									endif;
								?>
								

							</div>
						</div>
					</div>
				</div>	
			</section>

	<?php } }

endif;

add_action( 'educenter_fservices','educenter_features_services_section', 10 );

if( !function_exists('educenter_fservice_default_content')):
	function educenter_fservice_default_content(){

		$fservices = get_theme_mod('educenter_fservices_area_settings');

		if( $fservices ) {

			$fservices = json_decode( $fservices );

			foreach($fservices as $fservice){ 

				$page_id = $fservice->services_page;

			if( !empty( $page_id ) ) {

				$fservices_page = new WP_Query( 'page_id='.$page_id );		

			if( $fservices_page->have_posts() ) { while( $fservices_page->have_posts() ) { $fservices_page->the_post(); ?>
			<div class="col">

				<div class="icon-holder">
					<i class="fa <?php echo esc_attr( $fservice->services_icon ); ?>"></i>
				</div>

				<div class="text-holder">

					<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

					<a href="<?php the_permalink(); ?>" class="ed-button">
						<?php esc_html_e('read more','educenter'); ?>
					</a>	

				</div>

			</div>

		<?php } } wp_reset_postdata(); } } }
	}
endif;

if( !function_exists('educenter_fservice_advance_content')):
	function educenter_fservice_advance_content(){

		$fservices = get_theme_mod('educenter_fservices_area_settings_advance');

		if( $fservices ) {

			$fservices = json_decode( $fservices );

			foreach($fservices as $fservice){  ?>

				
			<div class="col">

				<div class="icon-holder">
					<i class="fa <?php echo esc_attr( $fservice->services_icon ); ?>"></i>
				</div>

				<div class="text-holder">

					<h2><a href="<?php echo esc_url($fservice->link ); ?>"><?php echo esc_html($fservice->title); ?></a></h2>

					<a href="<?php echo esc_url($fservice->link ); ?>" class="ed-button">
						<?php esc_html_e('read more','educenter'); ?>
					</a>	

				</div>

			</div>

		<?php } }
	}
endif;



if ( ! function_exists( 'educenter_aboutus_section' ) ) :

	/**
	 * AboutUs Section
	 *
	 * @since 1.0.0
	*/
	function educenter_aboutus_section() { 

		$aboutus = get_theme_mod( 'educenter_aboutus_section_area_options', 1 );

		if( !empty( $aboutus ) && $aboutus == 1 ){ ?>

			<section id="edu-aboutus-section" class="ed-about-us layout-2 clearfix">
				<div class="container">
					<div class="edu-press-wrap">
						<div class="ed-about-content">
							<?php 

								$title    = get_theme_mod('educenter_aboutus_main_title');
								$subtitle = get_theme_mod('educenter_aboutus_main_subtitle');
							
							if( !empty( $title ) ){

							?>
								<div class="ed-header">

							        <h2 class="section-header"><?php echo esc_html( $title ); ?></h2>

							        <?php if( !empty( $subtitle ) ){ ?>

							          <p><?php echo esc_html( $subtitle ); ?></p>

						        	<?php } ?>

						      	</div>

					      	<?php } ?>

							<div class="ed-about-list" id="edu-accordion">
								<?php
									$about_contents = get_theme_mod('educenter_aboutus_area_settings');
									
									if( $about_contents ) {

									$about_contents = json_decode( $about_contents );

									foreach( $about_contents as $content ) { 

										$page_id = $content->about_page;

									if( !empty( $page_id ) ) {

										$aboutus_page = new WP_Query( 'page_id='.$page_id );		

									if( $aboutus_page->have_posts() ) { while( $aboutus_page->have_posts() ) { $aboutus_page->the_post();

									$themename = wp_get_theme();

									if( !empty( $themename ) && $themename == 'Educenter' ){
								?>
									<div class="listing clearfix">
										<div class="icon-holder">
											<i class="fa <?php echo esc_attr( $content->about_icon ); ?>"></i>
										</div>
										<div class="text-holder">
											<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
											<?php the_excerpt(); ?>
										</div>
									</div>
								<?php }else{ ?>

									<h3><?php the_title(); ?></h3>
									<div><?php the_content(); ?></div>

								<?php } } } wp_reset_postdata(); } } } ?> 

							</div>
						</div>

						<?php
							$aboutimg = get_theme_mod('educenter_aboutus_page_features_image');

							if( !empty( $aboutimg ) ){
						?>
							<div class="ed-about-image">
								<img src="<?php echo esc_url( $aboutimg ); ?>" alt="<?php esc_attr_e( 'About Image', 'educenter' ); ?>">			
							</div>	

						<?php } ?>
					</div>
				</div>	
			</section>

	<?php } }

endif;

add_action( 'educenter_aboutus','educenter_aboutus_section', 15 );



if ( ! function_exists( 'educenter_calltoaction_section' ) ) :

	/**
	 * Call To Action Section
	 *
	 * @since 1.0.0
	*/
	function educenter_calltoaction_section() { 

		$cta = get_theme_mod( 'educenter_cta_area_options', 1 );

		if( !empty( $cta ) && $cta == 1 ){ 
	
			$page_id     = get_theme_mod('educenter_cta_pageid');

			if( function_exists( 'pll_register_string' ) ){

				$button_text = pll__( get_theme_mod('educenter_cta_button_text','Read More') );
			
			}else{

				$button_text = get_theme_mod('educenter_cta_button_text','Read More');

			}

			$button_url  = get_theme_mod('educenter_cta_button_url');

			
			if( function_exists( 'pll_register_string' ) ){

				$button_one_text = pll__( get_theme_mod('educenter_cta_button_one_text','Contact Us') );
			
			}else{

				$button_one_text = get_theme_mod('educenter_cta_button_one_text','Contact Us');

			}

			$button_one_url  = get_theme_mod('educenter_cta_button_two_url');

			if( !empty( $page_id ) ) {

				$cta_page = new WP_Query( 'page_id='.$page_id );		

			if( $cta_page->have_posts() ) { while( $cta_page->have_posts() ) { $cta_page->the_post();
				
				$image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large', true );

		?>
			<section id="edu-cta-section" class="ed-cta layout-1" <?php if(!empty( $page_id )) ?> style="background-image: url(<?php echo esc_url( $image[0] ); ?>)" <?php } ?>>
				
				<div class="ed-overlay"></div>
				
				<div class="container">

					<div class="ed-cta-holder">

						<div class="ed-text-holder">

							<h2><?php the_title(); ?></h2>

							<?php the_excerpt(); ?>

						</div>

						<?php if( !empty( $button_text ) ){ ?>
							<a href="<?php echo esc_url( $button_url ); ?>" class="ed-button">
								<?php echo esc_html( $button_text ); ?>
							</a>
						<?php } ?>

						<?php if( !empty( $button_one_text ) ){ ?>
							<a href="<?php echo esc_url( $button_one_url ); ?>" class="ed-button secondary-button">
								<?php echo esc_html( $button_one_text ); ?>
							</a>
						<?php } ?>

					</div>

				</div> 

			</section>
			
		<?php } } wp_reset_postdata();
			
	} }

endif;

add_action( 'educenter_calltoaction','educenter_calltoaction_section', 20 );



if ( ! function_exists( 'educenter_services_section' ) ) :

	/**
	 * Services Section
	 *
	 * @since 1.0.0
	*/
	function educenter_services_section() { 

		$services = get_theme_mod( 'educenter_services_area_options', 1 );

		if( !empty( $services ) && $services == 1 ){ ?>

			<section id="edu-services-section" class="ed-services layout-2">
				<div class="container">
					<div class="ed-service-left">
						<?php
							/**
							 * Section Main Title & SubTitle
							*/
							$title    = get_theme_mod('educenter_services_main_title');
							$subtitle = get_theme_mod('educenter_services_main_subtitle');

							educenter_section_title( $title, $subtitle );
						?>
						<div class="ed-col-holder clearfix">
							<?php

								$services = get_theme_mod('educenter_services_area_settings');
								
								if( $services ) {

								$services = json_decode( $services );

								foreach($services as $service){ 

									$page_id = $service->services_page;

									if( !empty( $page_id ) ) {

										$services_page = new WP_Query( 'page_id='.$page_id );		

									if( $services_page->have_posts() ) { while( $services_page->have_posts() ) { $services_page->the_post();

							?>
								<div class="col">

									<div class="icon-holder">
										<i class="<?php echo esc_attr( $service->services_icon ); ?>"></i>
									</div>

									<div class="text-holder">

										<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

										<?php the_excerpt(); ?>

										<a href="<?php the_permalink(); ?>" class="ed-button">
											<?php esc_html_e('read more','educenter'); ?>
										</a>

									</div>
								</div>

							<?php } } wp_reset_postdata(); } } } ?>
						</div>
					</div>
				</div>	
			</section>

	<?php } }

endif;

add_action( 'educenter_services','educenter_services_section', 25 );



if ( ! function_exists( 'educenter_counter_section' ) ) :

	/**
	 * Services Section
	 *
	 * @since 1.0.0
	*/
	function educenter_counter_section() { 

		$counter = get_theme_mod( 'educenter_counter_section_area_options', 1 );

		if( !empty( $counter ) && $counter == 1 ){ ?>

			<section id="edu-counter-section" data-layout="counter" class="educenter_counter_wrap" style="background-image: url(<?php echo esc_url( get_theme_mod('educenter_counter_bg_image') ); ?>); background-repeat: no-repeat; background-size: cover; background-attachment: fixed; background-position: center;">

				<div class="container">
					<?php
						/**
						 * Section Main Title & SubTitle
						*/
						$title    = get_theme_mod('educenter_counter_section_title');
						$subtitle = get_theme_mod('educenter_counter_section_subtitle');

						educenter_section_title( $title, $subtitle );
					?>
					<?php
						$counter = get_theme_mod('educenter_counter_area_settings');
						
						if(!empty( $counter )){

						$counter = json_decode( $counter );
						$i = 1;
						foreach($counter as $count){ 
					?>
						<div class="ed-col">
							<div class="educenter_counter">
                                <div class="educenter_counter-icon">
                                    <i class="<?php echo esc_attr( $count->counter_icon ); ?>"></i>
                                </div>
                                <div class="educenter_counter-count odometer odometer<?php echo esc_attr($i); ?>" data-count="<?php echo absint($count->counter_number); ?>">
                                    99
                                </div>
                                <h3 class="educenter_counter-title">
                                    <?php echo esc_html( $count->counter_title ); ?>
                                </h3>
                            </div>
						</div>
					<?php $i++; } } ?>
				</div>
			</section>

	<?php } }

endif;

add_action( 'educenter_counter','educenter_counter_section', 30 );



if ( ! function_exists( 'educenter_courses_section' ) ) :

	/**
	 * Courses Section
	 *
	 * @since 1.0.0
	*/
	function educenter_courses_section() { 

		$courses = get_theme_mod( 'educenter_courses_section_area_options', 1 );

		if( !empty( $courses ) && $courses == 1 ){ ?>

			<section id="edu-courses-section" class="ed-courses layout-2">
				<div class="container">
					<?php

						/**
						 * Section Main Title & SubTitle
						*/
						$title    = get_theme_mod('educenter_courses_section_title');
						$subtitle = get_theme_mod('educenter_courses_section_subtitle');
						$column = get_theme_mod('educenter_courses_section_column', 4);
						$view_style = get_theme_mod('educenter_courses_section_view', 'grid');
						if($view_style == 'slide'){
							$view_style = 'grid';
						}

						educenter_section_title( $title, $subtitle );
					?>

					<div class="ed-isotope">
						<div class="ed-col-wrap">
							
							<div class="isotop-active <?php if( $view_style == 'slide') echo 'ed-blog-slider cS-hidden'; ?>" data-layout="<?php echo esc_attr($view_style); ?>" data-items="<?php echo esc_attr($column);?>">
								<?php

									$courses = get_theme_mod('educenter_course_area_settings');

								if( $courses ) {

									$courses = json_decode( $courses );

									foreach($courses as $course){ 

										$page_id = $course->course_page;

									if( !empty( $page_id ) ) {

										$courses_page = new WP_Query( 'page_id='.$page_id );		

									if( $courses_page->have_posts() ) { while( $courses_page->have_posts() ) { $courses_page->the_post();

										$image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'educenter-gallery', true );
								?>

									<div class="ed-col ed-col-three">
										<div class="ed-img-holder">
											<a href="<?php the_permalink(); ?>">
												<img src="<?php echo esc_url( $image[0] ); ?>" alt="<?php the_title_attribute(); ?>">
											</a>
											<?php if( !empty( $course->course_price ) ){ ?><span class="course_price"><?php echo esc_html( $course->course_price ); ?></span><?php } ?>
										</div>
										<div class="ed-text-holder">
											<div class="ed-header-col">
												<h3 class="ed-title">
													<a href="<?php the_permalink(); ?>" >
														<?php the_title(); ?>
													</a>
												</h3>
											</div>

											<?php the_excerpt(); ?>

											<a href="<?php the_permalink(); ?>" class="ed-button">
												<?php esc_html_e('read more','educenter'); ?>
											</a>
										</div>
									</div>

								<?php } } wp_reset_postdata(); } } } ?>
								
							</div>	
						</div>
					</div>
				</div>
			</section>

	<?php } }

endif;

add_action( 'educenter_courses','educenter_courses_section', 35 );




if ( ! function_exists( 'educenter_blog_section' ) ) :

	/**
	 * Our Latest News Blog Section
	 *
	 * @since 1.0.0
	*/
	function educenter_blog_section() { 

		$blog = get_theme_mod( 'educenter_blog_area_options', 1 );

		if( !empty( $blog ) && $blog == 1 ){ ?>

			<section id="edu-blog-section" class="ed-blog bg-layout-1">
				<div class="container">
					
					<?php
						/**
						 * Section Main Title & SubTitle
						*/
						$title    = get_theme_mod('educenter_blog_title');
						$subtitle = get_theme_mod('educenter_blog_subtitle');

						educenter_section_title( $title, $subtitle );
					?>

					<div class="ed-blog-wrap layout-2">
						<div class="ed-blog-slider cS-hidden" data-items="<?php echo esc_attr(get_theme_mod('educenter_blog_slider_item', 3) ); ?>">
							<?php

								$category = get_theme_mod( 'educenter_blog_area_term_id', 1 );

								$catid = explode(',', $category);
								$args = array(
						            'post_type' => 'post',
						            'posts_per_page' => 9,
						            'tax_query' => array(
						                array(
						                    'taxonomy' => 'category',
						                    'field' => 'term_id',
						                    'terms' => $catid
						                ),
						            ),
						        );

						        $query = new WP_Query($args);

						        while ($query->have_posts()) { $query->the_post();

			                	$image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'educenter-gallery', true );
							?>

								<div class="ed-blog-col">
									<div class="ed-blog-img">
										<a href="<?php the_permalink(); ?>">
											<img src="<?php echo esc_url( $image[0] ); ?>" alt="<?php the_title_attribute(); ?>">
										</a>
									</div>

									<div class="ed-desc-wrap">

										<div class="ed-category-list">
											<?php the_category( ', ' ); ?> 
										</div>

										<div class="ed-title">
											<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>	
										</div>

										<div class="ed-meta-wrap">
											<?php educenter_posted_on(); ?>
										</div>

										<div class="ed-content-wrap">
											<div class="ed-content">
												<?php the_excerpt(); ?>
												<a href="<?php the_permalink(); ?>" class="ed-button">
													<?php esc_html_e('read more','educenter'); ?>
												</a>
											</div>
										</div>
									</div>
								</div>

							<?php } wp_reset_postdata(); ?>
						</div>
					</div>
				</div>
			</section>

	<?php } }

endif;

add_action( 'educenter_blog','educenter_blog_section', 40 );



if ( ! function_exists( 'educenter_ourteam_section' ) ) :

	/**
	 * Our Team Section
	 *
	 * @since 1.0.0
	*/
	function educenter_ourteam_section() { 

		$ourteam = get_theme_mod( 'educenter_team_area_options', 1 );

		if( !empty( $ourteam ) && $ourteam == 1 ){ ?>

			<section id="edu-team-section" class="ed-team-member">
				<div class="container">

					<?php
						/**
						 * Section Main Title & SubTitle
						*/
						$title    = get_theme_mod('educenter_team_area_title');
						$subtitle = get_theme_mod('educenter_team_area_subtitle');

						educenter_section_title( $title, $subtitle );
					?>

					<div class="ed-team-wrapper cS-hidden" data-items="<?php echo esc_attr( get_theme_mod('educenter_team_area_slider_item', 3) );?>">
						<?php

							$teams = get_theme_mod('educenter_team_area_settings');

							if( $teams ){

							$teams = json_decode( $teams );

							foreach($teams as $team){ 

								$page_id = $team->team_page;

							if( !empty( $page_id ) ) {

								$teams_page = new WP_Query( 'page_id='.$page_id );		

							if( $teams_page->have_posts() ) { while( $teams_page->have_posts() ) { $teams_page->the_post();

								$image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'educenter-team', true );
						?>
							<div class="ed-team-col">
								<div class="ed-inner-wrap ncS-hidden">

									<div class="ed-img">
										<img src="<?php echo esc_url( $image[0] ); ?>" alt="<?php the_title_attribute(); ?>">
									</div>

									<div class="ed-text-holder">
									    <div class="ed-team-header">
									    	<h3 class="ed-team-title">
									    		<a href="<?php the_permalink(); ?>">
									    			<?php the_title(); ?>
								    			</a>
								    		</h3>
										    <span class="ed-team-post"><?php echo esc_html( $team->team_position ); ?></span>
									    </div>
									</div>
								</div>
							</div>

						<?php } } wp_reset_postdata(); } } } ?>
					</div>	
				</div>
			</section>

	<?php } }

endif;

add_action( 'educenter_ourteam','educenter_ourteam_section', 45 );



if ( ! function_exists( 'educenter_gallery_section' ) ) :

	/**
	 * Gallery Section
	 *
	 * @since 1.0.0
	*/
	function educenter_gallery_section() { 

		$gallery = get_theme_mod( 'educenter_gallery_area_options', 1 );
		$is_full_width = get_theme_mod('educenter_gallery_section_full_width', false);
		if( !empty( $gallery ) && $gallery == 1 ){ 

			$allgallery = get_theme_mod('educenter_gallery_image');

			if( !empty( $allgallery ) ){ ?>

				<section id="edu-gallery-section" class="ed-gallery clearfix">
					<?php if(!$is_full_width): ?>
					<div class="container">
					<?php endif; ?>	

						<?php
							/**
							 * Section Main Title & SubTitle
							*/
							$title    = get_theme_mod('educenter_gallery_section_title');
							$subtitle = get_theme_mod('educenter_gallery_section_subtitle');
							$column = get_theme_mod('educenter_gallery_section_column', 3);
							educenter_section_title( $title, $subtitle );
						?>

						<div class="ed-gallery-wrapper grid-<?php echo esc_attr($column); ?>">
							
							<?php 
								$allgallery = explode(',', $allgallery);
								$gap = get_theme_mod('educenter_gallery_section_column_gap', 'gap');
								foreach ($allgallery as $gallery) {

									$image = wp_get_attachment_image_src( $gallery, 'educenter-gallery', true);
									$large = wp_get_attachment_image_src( $gallery, 'original', true);
									$caption = wp_get_attachment_caption($gallery);
							?>
								<div class="ed-gallery-item <?php echo esc_attr($gap); ?>">
									<div class="ed-gallery-item-wrapper">
										<div class="ed-gallery-inner">
											<a href="<?php echo esc_url( $large[0] ); ?>" title="<?php echo esc_html($caption); ?>" rel="edugallery[edu]" class="ed-btn-wrap">
												<div class="ed-gallery-head">
													<img src="<?php echo esc_url( $image[0] ); ?>" alt="<?php esc_attr_e( 'Gallery Image', 'educenter' ); ?>">
												</div>
												<div class="caption">
													<?php echo esc_html($caption); ?>
												</div>

												<div class="ed-gallery-button">
													<span class="ed-btn">
														<i class="far fa-image"></i>
													</span>
												</div>
											</a>
										</div>
									</div>
								</div>

							<?php } ?>

						</div>	
						<?php if(!$is_full_width): ?>
					</div>
					<?php endif; ?>
				</section>

	<?php } } }

endif;

add_action( 'educenter_gallery','educenter_gallery_section', 50 );



if ( ! function_exists( 'educenter_testimonials_section' ) ) :

	/**
	 * Testimonials Section
	 *
	 * @since 1.0.0
	*/
	function educenter_testimonials_section() { 

		$testimonial = get_theme_mod( 'educenter_testimonial_area_options', 1 );

		if( !empty( $testimonial ) && $testimonial == 1 ){ ?>

			<section id="edu-testimonials-section" class="ed-testimonials layout-2">
				<div class="container">
					<?php
						/**
						 * Section Main Title & SubTitle
						*/
						$title    = get_theme_mod('educenter_testimonial_title');
						$subtitle = get_theme_mod('educenter_testimonial_subtitle');

						educenter_section_title( $title, $subtitle );
					?>
					<div class="ed-testimonial-wrap layout-1 cS-hidden" data-items="<?php echo esc_attr(get_theme_mod('educenter_testimonial_slider_item', 3)); ?>">
						<?php

							$testimonials = get_theme_mod('educenter_testimonial_area_settings');

						if( $testimonials ){

							$testimonials = json_decode( $testimonials );

							foreach($testimonials as $testimonial){ 

								$page_id = $testimonial->testimonial_page;

							if( !empty( $page_id ) ) {

								$testimonial_page = new WP_Query( 'page_id='.$page_id );		

							if( $testimonial_page->have_posts() ) { while( $testimonial_page->have_posts() ) { $testimonial_page->the_post();
						?>
							<div class="ed-test-slide">

								<div class="ed-img-holder">
									<?php the_post_thumbnail( 'thumbnail' ); ?>
								</div>

								<div class="ed-text-holder">

									<h3><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>

									<span>
										<?php the_excerpt(); ?>
									</span>

								</div>
							</div>
						<?php } } wp_reset_postdata(); } } } ?>
					</div>
				</div>
			</section>

	<?php } }

endif;

add_action( 'educenter_testimonials','educenter_testimonials_section', 55 );

if ( ! function_exists( 'educenter_wp_events_section' ) ) :

	/**
	 * Testimonials Section
	 *
	 * @since 1.0.0
	*/
	function educenter_wp_events_section() { 
		if ( !( class_exists( 'TP_Event' ) || class_exists( 'WPEMS' ) ) ) return;
		$wp_events = get_theme_mod( 'educenter_events_area_options', 1 );

		if( !empty( $wp_events ) && $wp_events == 1 ){ ?>

			<section id="edu-wp-events-section" class="ed-testimonials layout-2">
				<div class="container">
					<?php
						/**
						 * Section Main Title & SubTitle
						*/
						$title    = get_theme_mod('educenter_events_area_title');
						$subtitle = get_theme_mod('educenter_events_area_subtitle');
						$is_tab_enable = get_theme_mod('educenter_events_show_tab', 1);
						$tabs = get_theme_mod( 'educenter_events_category', 'all');
						if( $tabs == 'all' ):
							$default_tab       = array( 'happening', 'upcoming', 'expired' );
						else:
							$default_tab       = array( $tabs );
						endif;

						$default_tab_title = array(
							'happening' => esc_html__( 'Happening', 'educenter' ),
							'upcoming'  => esc_html__( 'Upcoming', 'educenter' ),
							'expired'   => esc_html__( 'Expired', 'educenter' )
						);
						$output_tab        = array();

						foreach ( $default_tab as $tab_key ) {
							$output_tab[ $tab_key ] = $default_tab_title[ $tab_key ];
						}
						

						educenter_section_title( $title, $subtitle );
					?>
					<div class="list-tab-event">
						<?php if($is_tab_enable): ?>
						<ul class="nav nav-tabs">
							<?php
							$first_tab = true;
							foreach ( $output_tab as $k => $v ) {
								if ( $first_tab ) {
									$first_tab = false;
									echo '<li class="active"><a href="#tab-' . ( $k ) . '" data-toggle="tab">' . ( $v ) . '</a></li>';
								} else {
									echo '<li><a href="#tab-' . ( $k ) . '" data-toggle="tab">' . ( $v ) . '</a></li>';
								}
								?>
								<?php
							}
							?>
						</ul>
						<?php endif; ?>

						<div class="tab-content educenter-list-event">
							<?php
							if($tabs != 'all'):
								$args = array('default_active_tab' => $tabs );
							else:
								$args = array('default_active_tab' => 'happening');
							endif;

							foreach ( $output_tab as $type => $title ) :
								if(!$is_tab_enable) $args = array('default_active_tab' => $type );
								get_template_part( 'wp-events-manager/archive-event', $type, $args );
							endforeach;
							?>
						</div>
					</div>
					
				</div>
			</section>

	<?php } }

endif;

add_action( 'educenter_wp_events','educenter_wp_events_section', 55 );