var $j = jQuery.noConflict();

$j( document ).on( 'ready', function() {
	"use strict";
    // Edd display cart
    sunioEddDisplayCart();
} );

/* ==============================================
EddCOMMERCE DISPLAY CART
============================================== */
function sunioEddDisplayCart() {
	"use strict"

	var $overlay = $j( '.azt-cart-overlay' );

	$j( 'body' ).on( 'edd_cart_item_added', function() {
		$overlay.fadeIn();
		$j( 'body' ).addClass( 'show-cart' );

		// Close quick view modal if enabled
		var qv_modal 		= $j( '#azt-qv-wrap' ),
			qv_content 		= $j( '#azt-qv-content' );

		if ( qv_modal.length ) {	
			$j( 'html' ).css( {
				'overflow': '',
				'margin-right': '' 
			} );
			$j( 'html' ).removeClass( 'azt-qv-open' );

			qv_modal.fadeOut();
			qv_modal.removeClass( 'is-visible' );

			setTimeout( function() {
				qv_content.html( '' );
			}, 600);
		}
    } );

    $overlay.on( 'click', function() {
    	console.log("clicked");
		$j( this ).fadeOut();
		$j( 'body' ).removeClass( 'show-cart' );
	} );

	// Close on resize to avoid conflict
	$j( window ).resize( function() {
		$overlay.fadeOut();
		$j( 'body' ).removeClass( 'show-cart' );
	} );

}