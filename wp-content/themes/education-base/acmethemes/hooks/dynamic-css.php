<?php
/**
 * Dynamic css
 *
 * @since Education Base 1.0.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'education_base_dynamic_css' ) ) :

    function education_base_dynamic_css() {

        $education_base_customizer_all_values = education_base_get_theme_options();
        /*Color options */
        $education_base_header_height = esc_attr( $education_base_customizer_all_values['education-base-header-height'] );
        $education_base_primary_color = esc_attr( $education_base_customizer_all_values['education-base-primary-color'] );
        $education_base_header_top_color = esc_attr( $education_base_customizer_all_values['education-base-header-top-color'] );
        $education_base_footer_color = esc_attr( $education_base_customizer_all_values['education-base-footer-color'] );
        $education_base_footer_bottom_color = esc_attr( $education_base_customizer_all_values['education-base-footer-bottom-color'] );

        /*animation*/
        $education_base_enable_animation = $education_base_customizer_all_values['education-base-enable-animation'];

        $custom_css = '';
        /*animation*/
        if( 1 == $education_base_enable_animation ){
            $custom_css .= "
             .init-animate {
                visibility: visible !important;
             }
             ";
        }
        /*background*/
        $bg_image_url ='';
        if( get_header_image() ){
            $bg_image_url = esc_url( get_header_image() );
        }
        $custom_css .= "
              .inner-main-title {
                background-image:url('{$bg_image_url}');
                background-repeat:no-repeat;
                background-size:cover;
                background-attachment:fixed;
                background-position: center; 
                height: {$education_base_header_height}px;
            }";
        /*color*/
        $custom_css .= "
            .top-header,
            article.post .entry-header .year,
            .wpcf7-form input.wpcf7-submit ::before ,
            .btn-primary::before {
                background-color: {$education_base_header_top_color};
            }";
        $custom_css .= "
            .site-footer{
                background-color: {$education_base_footer_color};
            }";
        $custom_css .= "
            .copy-right{
                background-color: {$education_base_footer_bottom_color};
            }";
        $custom_css .= "
            a:hover,
            a:active,
            a:focus,
            .widget li a:hover,
            .posted-on a:hover,
            .author.vcard a:hover,
            .cat-links a:hover,
            .comments-link a:hover,
            .edit-link a:hover,
            .tags-links a:hover,
            .byline a:hover,
             .widget li a:focus,
            .posted-on a:focus,
            .author.vcard a:focus,
            .cat-links a:focus,
            .comments-link a:focus,
            .edit-link a:focus,
            .tags-links a:focus,
            .byline a:focus,
            .main-navigation .acme-normal-page .current_page_item >a,
            .main-navigation .acme-normal-page .current-menu-item >a,
            .main-navigation .active a,
            .main-navigation .navbar-nav >li a:hover,
            .main-navigation .navbar-nav >li a:focus,
            .team-item h3 a:hover,
            .team-item h3 a:focus,
            .news-notice-content .news-content a:hover,
            .news-notice-content .news-content a:focus,
            .circle .fa{
                color: {$education_base_primary_color};
            }";

        /*background color*/
        $custom_css .= "
            .navbar .navbar-toggle:hover,
            .navbar .navbar-toggle:focus,
            .main-navigation .current_page_ancestor > a:before,
            .comment-form .form-submit input,
            .btn-primary,
            .line > span,
            .wpcf7-form input.wpcf7-submit,
            .wpcf7-form input.wpcf7-submit:hover,
            .owl-buttons > div i:hover,
            article.post .entry-header,
            .sm-up-container,
            .read-more,
            .testimonial-content,
            .round-icon,
            .round-icon:hover{
                background-color: {$education_base_primary_color};
                color:#fff;
            }";

        /*borders*/
        $custom_css .= "
            .blog article.sticky,
            .top-header .read-more,
            .circle{
                border: 2px solid {$education_base_primary_color};
            }";
        wp_add_inline_style( 'education-base-style', $custom_css );
    }
endif;
add_action( 'wp_enqueue_scripts', 'education_base_dynamic_css', 99 );