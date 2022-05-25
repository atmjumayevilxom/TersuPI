<?php
/**
 * Select sidebar according to the options saved
 *
 * @since Education Base 1.0.0
 *
 * @param null
 * @return string
 *
 */
if ( !function_exists('education_base_sidebar_selection') ) :
	function education_base_sidebar_selection( ) {
		wp_reset_postdata();
		$education_base_customizer_all_values = education_base_get_theme_options();
		global $post;
		if(
			isset( $education_base_customizer_all_values['education-base-sidebar-layout'] ) &&
			(
				'left-sidebar' == $education_base_customizer_all_values['education-base-sidebar-layout'] ||
				'both-sidebar' == $education_base_customizer_all_values['education-base-sidebar-layout'] ||
				'middle-col' == $education_base_customizer_all_values['education-base-sidebar-layout'] ||
				'no-sidebar' == $education_base_customizer_all_values['education-base-sidebar-layout']
			)
		){
			$education_base_body_global_class = $education_base_customizer_all_values['education-base-sidebar-layout'];
		}
		else{
			$education_base_body_global_class= 'right-sidebar';
		}

		if ( education_base_is_woocommerce_active() && ( is_product() || is_shop() || is_product_taxonomy() )) {
			if( is_product() ){
				$post_class = get_post_meta( $post->ID, 'education_base_sidebar_layout', true );
				$education_base_wc_single_product_sidebar_layout = $education_base_customizer_all_values['education-base-wc-single-product-sidebar-layout'];

				if ( 'default-sidebar' != $post_class ){
					if ( $post_class ) {
						$education_base_body_classes = $post_class;
					} else {
						$education_base_body_classes = $education_base_wc_single_product_sidebar_layout;
					}
				}
				else{
					$education_base_body_classes = $education_base_wc_single_product_sidebar_layout;

				}
			}
			else{
				if( isset( $education_base_customizer_all_values['education-base-wc-shop-archive-sidebar-layout'] ) ){
					$education_base_archive_sidebar_layout = $education_base_customizer_all_values['education-base-wc-shop-archive-sidebar-layout'];
					if(
						'right-sidebar' == $education_base_archive_sidebar_layout ||
						'left-sidebar' == $education_base_archive_sidebar_layout ||
						'both-sidebar' == $education_base_archive_sidebar_layout ||
						'middle-col' == $education_base_archive_sidebar_layout ||
						'no-sidebar' == $education_base_archive_sidebar_layout
					){
						$education_base_body_classes = $education_base_archive_sidebar_layout;
					}
					else{
						$education_base_body_classes = $education_base_body_global_class;
					}
				}
				else{
					$education_base_body_classes= $education_base_body_global_class;
				}
			}
		}
		elseif( is_front_page() ){
			if( isset( $education_base_customizer_all_values['education-base-front-page-sidebar-layout'] ) ){
				if(
					'right-sidebar' == $education_base_customizer_all_values['education-base-front-page-sidebar-layout'] ||
					'left-sidebar' == $education_base_customizer_all_values['education-base-front-page-sidebar-layout'] ||
					'both-sidebar' == $education_base_customizer_all_values['education-base-front-page-sidebar-layout'] ||
					'middle-col' == $education_base_customizer_all_values['education-base-front-page-sidebar-layout'] ||
					'no-sidebar' == $education_base_customizer_all_values['education-base-front-page-sidebar-layout']
				){
					$education_base_body_classes = $education_base_customizer_all_values['education-base-front-page-sidebar-layout'];
				}
				else{
					$education_base_body_classes = $education_base_body_global_class;
				}
			}
			else{
				$education_base_body_classes= $education_base_body_global_class;
			}
		}

		elseif ( is_singular() && isset( $post->ID ) ) {
			$post_class = get_post_meta( $post->ID, 'education_base_sidebar_layout', true );
			if ( 'default-sidebar' != $post_class ){
				if ( $post_class ) {
					$education_base_body_classes = $post_class;
				} else {
					$education_base_body_classes = $education_base_body_global_class;
				}
			}
			else{
				$education_base_body_classes = $education_base_body_global_class;
			}

		}
		elseif ( is_archive() ) {
			if( isset( $education_base_customizer_all_values['education-base-archive-sidebar-layout'] ) ){
				$education_base_archive_sidebar_layout = $education_base_customizer_all_values['education-base-archive-sidebar-layout'];
				if(
					'right-sidebar' == $education_base_archive_sidebar_layout ||
					'left-sidebar' == $education_base_archive_sidebar_layout ||
					'both-sidebar' == $education_base_archive_sidebar_layout ||
					'middle-col' == $education_base_archive_sidebar_layout ||
					'no-sidebar' == $education_base_archive_sidebar_layout
				){
					$education_base_body_classes = $education_base_archive_sidebar_layout;
				}
				else{
					$education_base_body_classes = $education_base_body_global_class;
				}
			}
			else{
				$education_base_body_classes= $education_base_body_global_class;
			}
		}
		else {
			$education_base_body_classes = $education_base_body_global_class;
		}
		return $education_base_body_classes;
	}
endif;