/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {

	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title, .site-description' ).css( {
					'clip': 'auto',
					'position': 'relative'
				} );
				$( '.site-title a, .site-description' ).css( {
					'color': to
				} );
			}
		} );
	} );

	jQuery(document).ready( function() {
		wp.customize.selectiveRefresh.bind( 'partial-content-rendered', function( placement ) {
			var brtl = false;
			if ($("body").hasClass('rtl')) {
				brtl = true;
			}
			var p_p_id = placement.partial.id;
			if ( p_p_id === 'educenter_slider_selective_refresh' ) {

				/**
				 * Main Banner Slider
				*/
				$(".slider-layout-2 .ed-slide").lightSlider({
					item: 1,
					slideMove: 1,
					slideMargin: 0,
					loop: true,
					auto: true,
					pager: false,
					mode: 'fade',
					useCSS: true,
					cssEasing: 'ease', //'cubic-bezier(0.25, 0, 0.25, 1)',//
					easing: 'linear', //'for jquery animation',////
					controls: true,
					slideEndAnimation:true,
					speed:2000,
					pause:5000,
					enableDrag:false,
					rtl: brtl,
				});
			}

			if( p_p_id == 'educenter_team_refresh'){
				/**
				 * Our Team Member
				*/
				$(".ed-team-wrapper").lightSlider({
					item: $(".ed-team-wrapper").data('items') || 3,
					autoWidth: false,
					slideMove: 1,
					slideMargin: 10,
					loop: true,
					controls: false,
					adaptiveHeight: false,
					pager: true,
					rtl: brtl,
					onSliderLoad: function() {
						$('.ed-team-wrapper').removeClass('cS-hidden');
					},
					responsive: [{
							breakpoint: 870,
							settings: {
								item: 2,
								slideMove: 1,
								slideMargin: 10,
							}
						},
						{
							breakpoint: 570,
							settings: {
								item: 1,
								slideMove: 1,
								slideMargin: 2,
							}
						}
					]
				});
			}

			if( p_p_id == 'educenter_testimonial_area_refresh'){
				/**
				 * Our Testimonials
				*/
				$(".ed-testimonial-wrap").lightSlider({
					item: $(".ed-testimonial-wrap").data('items') || 3,
					autoWidth: false,
					slideMove: 1,
					slideMargin: 30,
					loop: true,
					controls: false,
					adaptiveHeight: false,
					pager: true,
					rtl: brtl,
					onSliderLoad: function() {
						$('.ed-testimonial-wrap').removeClass('cS-hidden');
					},
					responsive: [{
							breakpoint: 870,
							settings: {
								item: 2,
								slideMove: 1,
								slideMargin: 20,
							}
						},
						{
							breakpoint: 570,
							settings: {
								item: 1,
								slideMove: 1,
								slideMargin: 2,
							}
						}
					]
				});
			}

			if( p_p_id == 'educenter_gallery_refresh'){
				/**
				* Gallery Light Box
				*/
				$("a[rel^='edugallery']").prettyPhoto({
					theme: 'light_rounded',
					slideshow: 5000,
					autoplay_slideshow: false,
					keyboard_shortcuts: true,
					deeplinking : false,
					default_width: 500,
					default_height: 344,
				});
			}

			if( p_p_id == 'educenter_blog_area_refresh' || p_p_id == 'educenter_courses_section_area_refresh'){
				/**
				 * Latest News Blog Area
				*/
				$(".ed-blog-slider").lightSlider({
					item: $(".ed-blog-slider").data('items') || 3,
					autoWidth: false,
					slideMove: 1,
					slideMargin: 10,
					loop: true,
					controls: false,
					adaptiveHeight: true,
					pager: true,
					rtl: brtl,
					onSliderLoad: function() {
						$('.ed-blog-slider').removeClass('cS-hidden');
					},
					responsive: [{
							breakpoint: 870,
							settings: {
								item: 2,
								slideMove: 1,
								slideMargin: 10,
							}
						},
						{
							breakpoint: 570,
							settings: {
								item: 1,
								slideMove: 1,
								slideMargin: 2,
							}
						}
					]
				});
			}
		});
	});


} )( jQuery );
