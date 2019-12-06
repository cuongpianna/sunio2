var $j = jQuery.noConflict();

$j( document ).on( 'ready', function() {
	"use strict";
    // Woo off canvas
    sunioWooOffCanvas();
} );

/* ==============================================
WOOCOMMERCE OFF CANVAS
============================================== */
function sunioWooOffCanvas() {
	"use strict"

	$j( document ).on( 'click', '.sunio-off-canvas-filter', function( e ) {
		e.preventDefault();

		var innerWidth = $j( 'html' ).innerWidth();
		$j( 'html' ).css( 'overflow', 'hidden' );
		var hiddenInnerWidth = $j( 'html' ).innerWidth();
		$j( 'html' ).css( 'margin-right', hiddenInnerWidth - innerWidth );

		$j( 'body' ).addClass( 'off-canvas-enabled' );
	} );

	$j( '.sunio-off-canvas-overlay, .sunio-off-canvas-close' ).on( 'click', function() {
		$j( 'html' ).css( {
			'overflow': '',
			'margin-right': '' 
		} );

		$j( 'body' ).removeClass( 'off-canvas-enabled' );
	} );

}