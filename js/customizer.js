/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */
( function( $ ) {
	//--FRONT PAGE COLORS
	//Who We Are section
	wp.customize('whoweare_bg',function( value ) {
		value.bind( function( newval ) {
			$('.whoweare-area').css('background-color', newval );
		} );
	});
	wp.customize('whoweare_title',function( value ) {
		value.bind( function( newval ) {
			$('.whoweare-area .widget-title').css('color', newval );
		} );
	});
	wp.customize('whoweare_body_text',function( value ) {
		value.bind( function( newval ) {
			$('.whoweare-area .container div').css('color', newval );
		} );
	});

	// Menu background
	wp.customize('menu_color',function( value ) {
		value.bind( function( newval ) {
			$('.top-bar').css('background-color', newval );
		} );
	});
	// Menu Links
	wp.customize('menu_links_color',function( value ) {
		value.bind( function( newval ) {
			$('.navbar-custom .navbar-nav > li > a').css('color', newval );
		} );
	});

	// Font sizes
	wp.customize('menu_size',function( value ) {
        value.bind( function( newval ) {
            $('.navbar-custom .navbar-nav').css('font-size', newval + 'px' );
        } );
    });	
} )( jQuery );