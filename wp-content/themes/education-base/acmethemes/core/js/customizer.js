/**
 * customizer.js
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

    // Widget Icon
    wp.customize( 'education_base_theme_options[education-base-disable-widget-title-icon]', function( value ) {
        value.bind( function( to ) {
        	var main_title = $( '.main-title > .line > span' );
        	if( to ){
                main_title.attr('data-class',main_title.attr('class'));
                main_title.removeAttr('class')
			}
			else{
                main_title.attr('class',main_title.attr('data-class'));
                main_title.removeAttr('data-class')
            }

        } );
    } );
    wp.customize( 'education_base_theme_options[education-base-widget-title-icon]', function( value ) {
        value.bind( function( to ) {
            $( '.main-title > .line > span' ).attr( 'class','fa ' +to );
        } );
    } );
} )( jQuery );