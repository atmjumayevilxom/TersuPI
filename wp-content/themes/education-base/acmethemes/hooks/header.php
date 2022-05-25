<?php
/**
 * Setting global variables for all theme options saved values
 *
 * @since Education Base 1.0.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'education_base_set_global' ) ) :
    function education_base_set_global() {
        /*Getting saved values start*/
        $education_base_saved_theme_options = education_base_get_theme_options();
        $GLOBALS['education_base_customizer_all_values'] = $education_base_saved_theme_options;
        /*Getting saved values end*/
    }
endif;
add_action( 'education_base_action_before_head', 'education_base_set_global', 0 );

/**
 * Doctype Declaration
 *
 * @since Education Base 1.0.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'education_base_doctype' ) ) :
    function education_base_doctype() {
        ?><!DOCTYPE html><html <?php language_attributes(); ?>><?php
    }
endif;
add_action( 'education_base_action_before_head', 'education_base_doctype', 10 );

/**
 * Code inside head tage but before wp_head funtion
 *
 * @since Education Base 1.0.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'education_base_before_wp_head' ) ) :

    function education_base_before_wp_head() {
        ?>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="profile" href="//gmpg.org/xfn/11">
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
		
	
        <?php
    }
endif;
add_action( 'education_base_action_before_wp_head', 'education_base_before_wp_head', 10 );

/**
 * Add body class
 *
 * @since Education Base 1.0.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'education_base_body_class' ) ) :

    function education_base_body_class( $education_base_body_classes ) {

        global $education_base_customizer_all_values;
        $education_base_enable_animation = $education_base_customizer_all_values['education-base-enable-animation'];
        /*wow*/
        /*animation*/
        if( 1 != $education_base_enable_animation ){
            $education_base_body_classes[] = 'acme-animate';
        }
        $education_base_body_classes[] = education_base_sidebar_selection();

        $education_base_enable_sticky = $education_base_customizer_all_values['education-base-enable-sticky'];
        if( 1 == $education_base_enable_sticky ){
            $education_base_body_classes[] = 'at-sticky-header';
        }

        return $education_base_body_classes;
    }
endif;
add_action( 'body_class', 'education_base_body_class', 10, 1);

/**
 * Start site div
 *
 * @since Education Base 1.0.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'education_base_site_start' ) ) :

    function education_base_site_start() {
        ?>
        <div class="site" id="page">
        <?php
    }
endif;
add_action( 'education_base_action_before', 'education_base_site_start', 20 );

/**
 * Skip to content
 *
 * @since Education Base 1.0.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'education_base_skip_to_content' ) ) :

    function education_base_skip_to_content() {
        ?>
        <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'education-base' ); ?></a>
        <?php
    }
endif;
add_action( 'education_base_action_before_header', 'education_base_skip_to_content', 10 );

/**
 * Main header
 *
 * @since Education Base 1.0.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'education_base_header' ) ) :
    function education_base_header() {
        echo "<div class='education-base-main-header-wrapper'>";
        global $education_base_customizer_all_values;
        $education_base_enable_header_top = $education_base_customizer_all_values['education-base-enable-header-top'];
        $education_base_top_header_design_options = $education_base_customizer_all_values['education-base-top-header-design-options'];
        if( 1 == $education_base_enable_header_top ){
            ?>
			<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
            <div class="top-header <?php echo esc_attr( $education_base_top_header_design_options ); ?>">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6 text-left">
							<span class="top-phone">
								<a  href="#"><img width="22px", height="22px", style="margin-left:2px;" src="/wp-content/uploads/2022/05/gerb.png"></a>
								<a  href="#"><img width="22px", height="22px", style="margin-left:2px;" src="/wp-content/uploads/2022/05/logo-1.png"></a>
								<a  href="#"><img width="22px", height="22px" src="/wp-content/uploads/2022/05/madhiya.png"></a>
							
							</span>
                            <span class="top-phone"><i class="fa fa-phone"></i>+998 76 221 93 71</span>
							<a class="top-email" href="mailto:info@terdupi.uz">
								<i class="fa fa-envelope-o"></i>info@terdupi.uz</a>
							<div class="top-header-latest-posts">
                                                <div class="bn-title">
													<a  href="https://www.tersupi.uz/virtual-qabulxona/"><i class="fa fa-graduation-cap"></i>Virtual qabulxona</a>                                                
												</div>
												<div class="bn-title">
													<a  href="https://www.tersupi.uz/interaktiv-xizmatlar/"><i class="fa fa-book"></i>Interaktiv Xizmatlar</a>                                                
												</div>
                                                <div class="news-notice-content">
													
													
                                                                                                            
                                                                                                            
                                                                                                            
                                                        <span class="news-content" style="display: inline;">
                                                            <a href="https://hemis.terdupi.uz/dashboard/login" title="Hemis O'qtuvchi">
                                                                <i class="fa fa-home"></i>Hemis O'qtuvchi                                                           </a>
                                                        </span><span class="news-content" style="display: none;">
                                                            <a href="https://students.terdupi.uz/dashboard/login" title="Hemis Talaba">
																<i class="fa fa-graduation-cap"></i>Hemis Talaba                                                           </a>
                                                        </span><span class="news-content" style="display: none;">
                                                            <a href="https://students.terdupi.uz/dashboard/contract" title="Shartnoma Olish">
																<i class="fa fa-bars"></i>Shartnoma Olish                                                            </a>
                                                        </span></div>
                                            </div> <!-- .header-latest-posts -->
                                                                </div>
                        <div class="col-sm-6 text-right">
                                    <ul class="socials init-animate animated" >
                            <li class="facebook">
								<a href="https://www.facebook.com/terdupi.uz/" title="Facebook" target="_blank"><i class="fab fa-facebook-f" aria-hidden="true"></i></a>
							</li>
										<li class="twitter">
								<a href="#" title="instagram" target="_blank"><i class="fab fa-instagram"></i></a>

							</li>
										<li class="youtube">
								<a href="https://www.youtube.com/channel/UCwyV2-5fNHAQvalh2pJPaDA" title="Youtube" target="_blank"><i class="fab fa-youtube"></i></a>
							</li>
										<li class="google-plus">
								<a href="http://75" title="Google Plus" target="_blank"><i class="fab fa-google-plus"></i></a>
							</li>
                        </ul>
<!--                                         <a class="read-more" href="http://75">Uzb</a> -->
						 <?php 
							if($_SERVER['REQUEST_URI'] == '/'){
								?>
							 <select name="cars" id="cars" class="read-more" onchange="location = this.value;">
								<option value="/">UZB</option>
								<option value="/ru">RU</option>
								<option value="/en">ENG</option>
				           </select>
							<?php
							}
							if($_SERVER['REQUEST_URI'] == '/ru/'){
								?>
							 <select name="cars" id="cars" class="read-more" onchange="location = this.value;">
								<option value="/ru">RU</option>
								<option value="/">UZB</option>
								<option value="/en">ENG</option>
				           </select>
							<?php
							}
							if($_SERVER['REQUEST_URI'] == '/en/'){
								?>
							 <select name="cars" id="cars" class="read-more" onchange="location = this.value;">
								 <option value="/en">ENG</option>
								<option value="/ru">RU</option>
								<option value="/">UZB</option>
							
				           </select>
							<?php
							}
							?>
								
						</div>
                                                     
                    </div>
                </div>
            </div>
			
            <?php
        }

         $education_base_nav_class = '';
         $education_base_enable_sticky = $education_base_customizer_all_values['education-base-enable-sticky'];
         if( 1 == $education_base_enable_sticky ){
            $education_base_nav_class .= ' education-base-sticky';
        }
        ?>
        <div class="navbar at-navbar <?php echo $education_base_nav_class; ?>" id="navbar" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"><i class="fa fa-bars"></i></button>
                    <?php
                    if ( 'disable' != $education_base_customizer_all_values['education-base-header-id-display-opt'] ):
                        if ( 'logo-only' == $education_base_customizer_all_values['education-base-header-id-display-opt'] && function_exists( 'the_custom_logo' ) ):
                            if ( function_exists( 'the_custom_logo' ) ) :
                                    the_custom_logo();
                            else :
                            endif;
                        else:/*else is title-only or title-and-tagline*/
                            if ( is_front_page() && is_home() ) : ?>
                                <h1 class="site-title">
                                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
                                </h1>
                            <?php else : ?>
                                <p class="site-title">
                                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
                                </p>
                            <?php endif;
                            if ( 'title-and-tagline' == $education_base_customizer_all_values['education-base-header-id-display-opt'] ):
                                $description = get_bloginfo( 'description', 'display' );
                                if ( $description || is_customize_preview() ) : ?>
                                    <p class="site-description"><?php echo esc_html( $description ); ?></p>
                                <?php endif;
                            endif;
                        endif;
                    endif;
                    ?>
                </div>
                <div class="main-navigation navbar-collapse collapse">
                    <?php
                    if( is_front_page() && !is_home() && has_nav_menu( 'one-page') ){
                        wp_nav_menu(
                            array(
                                'theme_location' => 'one-page',
                                'menu_id' => 'primary-menu',
                                'menu_class' => 'nav navbar-nav navbar-right acme-one-page',
                            )
                        );
                    }
                    else{
                         wp_nav_menu(
                            array(
                                'theme_location' => 'primary',
                                'menu_id' => 'primary-menu',
                                'menu_class' => 'nav navbar-nav navbar-right acme-normal-page',
                            )
                        );
                    }
                   ?>
                </div>
                <!--/.nav-collapse -->
            </div>
        </div>
        <?php
        echo "</div>";
    }
endif;
add_action( 'education_base_action_header', 'education_base_header', 10 );
