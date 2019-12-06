var $j = jQuery.noConflict();

$j( document ).on( 'ready', function() {
	"use strict";
	// Masonry grids
	sunioMasonryGrids();
} );

$j( window ).on( 'orientationchange', function() {
	"use strict";
	// Masonry grids
	sunioMasonryGrids();
} );

/* ==============================================
MASONRY
============================================== */
function sunioMasonryGrids() {
	"use strict"

	$j( '.blog-masonry-grid' ).each( function() {

		var $this               = $j( this ),
			$transitionDuration = '0.0',
			$layoutMode         = 'masonry';

		// Load isotope after images loaded
		$this.imagesLoaded( function() {
			$this.isotope( {
				itemSelector       : '.isotope-entry',
				transformsEnabled  : true,
				isOriginLeft       : sunioLocalize.isRTL ? false : true,
				transitionDuration : $transitionDuration + 's'
			} );
		} );

	} );

}