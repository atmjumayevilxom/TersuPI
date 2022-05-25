<?php
/**
 * Hook get template archive event
 */
if ( ! function_exists( 'educenter_archive_event_template' ) ) {
	function educenter_archive_event_template( $template ) {
		if ( is_front_page( ) || get_post_type() == 'tp_event' && is_post_type_archive( 'tp_event' ) || is_tax( 'tp_event_category' ) ) {
			$GLOBALS['educenter_happening_events'] = educenter_get_happening_events();
			$GLOBALS['educenter_upcoming_events']  = educenter_get_upcoming_events();
			$GLOBALS['educenter_expired_events']   = educenter_get_expired_events();
		}

		return $template;
	}
}
add_action( 'template_include', 'educenter_archive_event_template' );

//Filter post_status tp_event
if ( ! function_exists( 'educenter_get_upcoming_events' ) ) {
	function educenter_get_upcoming_events( $args = array() ) {
		if ( is_tax( 'tp_event_category' ) ) {
			if ( version_compare( WPEMS_VER, '2.1.5', '>=' ) ) {
				$args = wp_parse_args(
					$args,
					array(
						'post_type'  => 'tp_event',
						'meta_query' => array(
							array(
								'key'     => 'tp_event_status',
								'value'   => 'upcoming',
								'compare' => '=',
							),
						),
						'tax_query'  => array(
							array(
								'taxonomy' => 'tp_event_category',
								'field'    => 'slug',
								'terms'    => get_query_var( 'term' ),
							)
						),
					)
				);
			} else {
				$args = wp_parse_args(
					$args,
					array(
						'post_type'   => 'tp_event',
						'post_status' => 'tp-event-upcoming',
						'tax_query'   => array(
							array(
								'taxonomy' => 'tp_event_category',
								'field'    => 'slug',
								'terms'    => get_query_var( 'term' ),
							)
						),
					)
				);
			}
		} else {
			if ( version_compare( WPEMS_VER, '2.1.5', '>=' ) ) {
				$args = wp_parse_args(
					$args,
					array(
						'post_type'  => 'tp_event',
						'meta_query' => array(
							array(
								'key'     => 'tp_event_status',
								'value'   => 'upcoming',
								'compare' => '=',
							),
						),
					)
				);
			} else {
				$args = wp_parse_args(
					$args,
					array(
						'post_type'   => 'tp_event',
						'post_status' => 'tp-event-upcoming',
					)
				);
			}
		}


		return new WP_Query( $args );
	}
}

if ( ! function_exists( 'educenter_get_expired_events' ) ) {
	function educenter_get_expired_events( $args = array() ) {
		if ( is_tax( 'tp_event_category' ) ) {
			if ( version_compare( WPEMS_VER, '2.1.5', '>=' ) ) {
				$args = wp_parse_args(
					$args,
					array(
						'post_type'  => 'tp_event',
						'meta_query' => array(
							array(
								'key'     => 'tp_event_status',
								'value'   => 'expired',
								'compare' => '=',
							),
						),
						'tax_query'  => array(
							array(
								'taxonomy' => 'tp_event_category',
								'field'    => 'slug',
								'terms'    => get_query_var( 'term' ),
							)
						),
					)
				);
			} else {
				$args = wp_parse_args(
					$args,
					array(
						'post_type'   => 'tp_event',
						'post_status' => 'tp-event-expired',
						'tax_query'   => array(
							array(
								'taxonomy' => 'tp_event_category',
								'field'    => 'slug',
								'terms'    => get_query_var( 'term' ),
							)
						),
					)
				);
			}
		} else {
			if ( version_compare( WPEMS_VER, '2.1.5', '>=' ) ) {
				$args = wp_parse_args(
					$args,
					array(
						'post_type'  => 'tp_event',
						'meta_query' => array(
							array(
								'key'     => 'tp_event_status',
								'value'   => 'expired',
								'compare' => '=',
							),
						),
					)
				);
			} else {
				$args = wp_parse_args(
					$args,
					array(
						'post_type'   => 'tp_event',
						'post_status' => 'tp-event-expired',
					)
				);
			}
		}

		return new WP_Query( $args );
	}
}

if ( ! function_exists( 'educenter_get_happening_events' ) ) {
	function educenter_get_happening_events( $args = array() ) {
		if ( is_tax( 'tp_event_category' ) ) {
			if ( version_compare( WPEMS_VER, '2.1.5', '>=' ) ) {
				$args = wp_parse_args(
					$args,
					array(
						'post_type'  => 'tp_event',
						'meta_query' => array(
							array(
								'key'     => 'tp_event_status',
								'value'   => 'happening',
								'compare' => '=',
							),
						),
						'tax_query'  => array(
							array(
								'taxonomy' => 'tp_event_category',
								'field'    => 'slug',
								'terms'    => get_query_var( 'term' ),
							)
						),
					)
				);
			} else {
				$args = wp_parse_args(
					$args,
					array(
						'post_type'   => 'tp_event',
						'post_status' => 'tp-event-happenning',
						'tax_query'   => array(
							array(
								'taxonomy' => 'tp_event_category',
								'field'    => 'slug',
								'terms'    => get_query_var( 'term' ),
							)
						),
					)
				);
			}
		} else {
			if ( version_compare( WPEMS_VER, '2.1.5', '>=' ) ) {
				$args = wp_parse_args(
					$args,
					array(
						'post_type'  => 'tp_event',
						'meta_query' => array(
							array(
								'key'     => 'tp_event_status',
								'value'   => 'happening',
								'compare' => '=',
							),
						),
					)
				);
			} else {
				$args = wp_parse_args(
					$args,
					array(
						'post_type'   => 'tp_event',
						'post_status' => 'tp-event-happenning',
					)
				);
			}
		}

		return new WP_Query( $args );
	}
}

/**
 * Display feature image
 *
 * @param $attachment_id
 * @param $size_type
 * @param $width
 * @param $height
 * @param $alt
 * @param $title
 *
 * @return string
 */
if ( ! function_exists( 'educenter_get_feature_image' ) ) {
	function educenter_get_feature_image( $attachment_id, $size_type = null, $width = null, $height = null, $alt = null, $title = null, $no_lazyload = null ) {

		if ( ! $size_type ) {
			$size_type = 'full';
		}
		$style = '';
		if ( $width && $height ) {
			$src   = wp_get_attachment_image_src( $attachment_id, array( $width, $height ) );
			$style = ' width="' . $width . '" height="' . $height . '"';
		} else {
			$src = wp_get_attachment_image_src( $attachment_id, $size_type );
			if ( ! empty( $src[1] ) && ! empty( $src[2] ) ) {
				$style = ' width="' . $src[1] . '" height="' . $src[2] . '"';
			}
		}

		if ( ! $alt ) {
			$alt = get_post_meta( $attachment_id, '_wp_attachment_image_alt', true ) ? get_post_meta( $attachment_id, '_wp_attachment_image_alt', true ) : get_the_title( $attachment_id );
		}
		if ( $no_lazyload == 1 ) {
			$style .= ' data-skip-lazy';
		}
		if ( ! $title ) {
			$title = get_the_title( $attachment_id );
		}

		if ( empty( $src ) ) {
			return '<img src="' . esc_url( get_template_directory_uri(  ) . '/assets/images/demo_image.png' ) . '" alt="' . esc_attr( $alt ) . '" title="' . esc_attr( $title ) . '" ' . $style . '>';
		}

		return '<img src="' . esc_url( $src[0] ) . '" alt="' . esc_attr( $alt ) . '" title="' . esc_attr( $title ) . '" ' . $style . '>';

	}
}

/**
 * Custom excerpt
 *
 * @param $limit
 *
 * @return array|mixed|string|void
 */
function educenter_excerpt( $limit ) {
	$excerpt = explode( ' ', get_the_excerpt(), $limit );
	if ( count( $excerpt ) >= $limit ) {
		array_pop( $excerpt );
		$excerpt = implode( " ", $excerpt ) . '...';
	} else {
		$excerpt = implode( " ", $excerpt );
	}
	$excerpt = preg_replace( '`\[[^\]]*\]`', '', $excerpt );

	return '<p>' . wp_strip_all_tags( $excerpt ) . '</p>';
}

/**
 * Get login page url
 *
 * @return false|string
 */
if ( ! function_exists( 'educenter_get_login_page_url' ) ) {
	function educenter_get_login_page_url() {
		if ( $page = get_option( 'thimpress_events_login_page_id' ) ) {
			return get_permalink( $page );
		}
		return wp_login_url();
	}
}

/**
 * Filter register link
 *
 * @param $register_url
 *
 * @return string|void
 */
if ( ! function_exists( 'educenter_get_register_url' ) ) {
	function educenter_get_register_url() {
		$register_page_id = get_option('thimpress_events_register_page_id');
		if($register_page_id){
			return get_permalink($register_page_id);
		}

		$url = add_query_arg( 'action', 'register', educenter_get_login_page_url() );
		return $url;
	}
}

/**
 * Filter forgot password link
 *
 * @param $forget password link
 *
 * @return string|void
 */
if ( ! function_exists( 'educenter_get_forgot_password_link' ) ) {
	function educenter_get_forgot_password_link() {
		$register_page_id = get_option('thimpress_events_forgot_password_page_id');
		if($register_page_id){
			return get_permalink($register_page_id);
		}
		return '';
	}
}
/**
 * Remove action single event
 */
remove_action( 'tp_event_after_loop_event_item', 'event_auth_register' );
remove_action( 'tp_event_after_single_event', 'wpems_single_event_register' );
remove_action( 'tp_event_after_single_event', 'event_auth_register' );
remove_action( 'tp_event_after_single_event', 'tp_event_single_event_register' );