<?php
/**
 * Footer content
 *
 * @since Education Base 1.0.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'education_base_footer' ) ) :

    function education_base_footer() {

        global $education_base_customizer_all_values;
        ?>
        <div class="clearfix"></div>
        <footer class="site-footer">
            <?php
            if(
            is_active_sidebar('footer-col-one') ||
            is_active_sidebar('footer-col-two') ||
            is_active_sidebar('footer-col-three') ||
            is_active_sidebar('footer-col-four')
            ) {
                ?>
                <div class="container">
                    <div class="bottom">
                        <div id="footer-top">
                            <div class="footer-columns at-fixed-width">
                                <?php
                                $footer_top_col = 'col-sm-3 init-animate slideInUp1';
                                if (is_active_sidebar('footer-col-one')) : ?>
                                    <div class="footer-sidebar <?php echo esc_attr($footer_top_col); ?>">
                                        <?php dynamic_sidebar('footer-col-one'); ?>
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
                                    </div>
                                <?php endif;
                                if (is_active_sidebar('footer-col-two')) : ?>
                                    <div class="footer-sidebar <?php echo esc_attr($footer_top_col); ?>">
                                        <?php dynamic_sidebar('footer-col-two'); ?>
										
                                    </div>
                              <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12705.51904434509!2d67.3093114!3d37.2386963!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xdd78e5326c2587ee!2sNizomiy!5e0!3m2!1sru!2s!4v1652722558857!5m2!1sru!2s" width="500" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                <?php endif; ?>
                            </div>
							
						
						
							
                        </div><!-- #foter-top -->
                    </div><!-- bottom-->
					
                </div>

                <div class="clearfix"></div>
                <?php
            }
            ?>
            <div class="copy-right">
                <div class='container'>
                    <div class="row">
                        <div class="col-sm-4 init-animate fadeInDown">
                            <?php
                            if ( 1 == $education_base_customizer_all_values['education-base-enable-social'] ) {
                                /**
                                 * Social Sharing
                                 * education_base_action_social_links
                                 * @since Education Base 1.0.0
                                 *
                                 * @hooked education_base_social_links -  10
                                 */
                                echo "<div class='text-left'>";
                                do_action('education_base_action_social_links');
                                echo "</div>";
                            }
                            ?>
                        </div>
                        <div class="col-sm-4 init-animate fadeInDown">
                            <?php
                            if( isset( $education_base_customizer_all_values['education-base-footer-copyright'] ) ): ?>
                                <p class="text-center">
                                   <a href="https://t.me/ilhomjumayev">© 2022.</a> Termiz davlat universitetining Pedagogika instituti
                                </p>
                            <?php endif;
                            ?>
                        </div>
                        <div class="col-sm-4 init-animate fadeInDown">
                            <div class="footer-copyright border text-right">
                                <div class="site-info">
                                  
                                </div><!-- .site-info -->
                            </div>
                        </div>
                    </div>
                </div>
                <a href="#page" class="sm-up-container"><i class="fa fa-angle-up sm-up"></i></a>
            </div>
        </footer>
    <?php
    }
endif;
add_action( 'education_base_action_footer', 'education_base_footer', 10 );

/**
 * Page end
 *
 * @since Education Base 1.1.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'education_base_page_end' ) ) :

    function education_base_page_end() {
        ?>
        </div><!-- #page -->
    <?php
    }
endif;
add_action( 'education_base_action_after', 'education_base_page_end', 10 );