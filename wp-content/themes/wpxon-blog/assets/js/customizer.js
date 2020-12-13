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
			$( '.logo-area' ).html( '<a class="logo-index" href="#">'+ to +'</a>' );
		} );
	} );
 
	// link color  
	wp.customize( 'link_color', function( value ) {
		value.bind( function( to ) {
			$( 'body a' ).css( 'cssText','color:'+to+' !important' );
		} );
	} );

	// link hover color  
	wp.customize( 'link_hvr_color', function( value ) {
		value.bind( function( to ) {
			$( 'body a:hover' ).css( 'cssText','color:'+to+' !important' );
		} );
	} );

	// logo 
	wp.customize( 'custom_logo', function( value ) {
		value.bind( function( to ) {
			$( '.logo-area a img' ).attr( 'src',to );
		} );
	} );
  
	// header default text
	wp.customize( 'header_default_text', function( value ) {
	  value.bind( function( to ) {
	    $( '.page-title' ).html( to );
	  } );
	} );
	// copyright text
	wp.customize( 'v_copyright_text', function( value ) {
	  value.bind( function( to ) {
	    $( '.footer-logo-wrap p' ).html( to );
	  } );
	} );
	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			var cl = '#'+to; 
			$( '.page-title-wrap h1' ).css( 'color', cl );  
		} );
	} );
} )( jQuery );
