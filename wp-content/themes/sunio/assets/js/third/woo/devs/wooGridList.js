var $j = jQuery.noConflict();

$j( document ).on( 'ready', function() {
	"use strict";
    // Woo catalog view
    sunioWooGridList();
} );

/* ==============================================
WOOCOMMERCE GRID LIST VIEW
============================================== */
function sunioWooGridList() {
	"use strict"

	if ( $j( 'body' ).hasClass( 'has-grid-list' ) ) {

		// Re-run function
		var sunioProductSlider = function() {
			if ( ! $j( 'body' ).hasClass( 'no-carousel' )
				&& $j( '.woo-entry-image.product-entry-slider' ).length) {
                setTimeout( function() {
                    $j( '.woo-entry-image.product-entry-slider' ).slick( 'unslick' );
                    sunioInitCarousel();
                }, 350 );
            }
        }

		$j( '#sunio-grid' ).on( 'click', function() {
			sunioProductSlider();

			$j( this ).addClass( 'active' );
			$j( '#sunio-list' ).removeClass( 'active' );
			Cookies.set( 'gridcookie', 'grid', { path: '' } );
			$j( '.woocommerce ul.products' ).fadeOut( 300, function() {
				$j( this ).addClass( 'grid' ).removeClass( 'list' ).fadeIn( 300 );
			} );
			return false;
		} );

		$j( '#sunio-list' ).on( 'click', function() {
			sunioProductSlider();
            
			$j( this ).addClass( 'active' );
			$j( '#sunio-grid' ).removeClass( 'active' );
			Cookies.set( 'gridcookie', 'list', { path: '' } );
			$j( '.woocommerce ul.products' ).fadeOut( 300, function() {
				$j( this ).addClass( 'list' ).removeClass( 'grid' ).fadeIn( 300 );
			} );
			return false;
		} );

		if ( Cookies.get( 'gridcookie' ) == 'grid' ) {
	        $j( '.sunio-grid-list #sunio-grid' ).addClass( 'active' );
	        $j( '.sunio-grid-list #sunio-list' ).removeClass( 'active' );
	        $j( '.woocommerce ul.products' ).addClass( 'grid' ).removeClass( 'list' );
	    }

	    if ( Cookies.get( 'gridcookie' ) == 'list' ) {
	        $j( '.sunio-grid-list #sunio-list' ).addClass( 'active' );
	        $j( '.sunio-grid-list #sunio-grid' ).removeClass( 'active' );
	        $j( '.woocommerce ul.products' ).addClass( 'list' ).removeClass( 'grid' );
	    }

	} else {

		Cookies.remove( 'gridcookie', { path: '' } );

	}

}