var $j = jQuery.noConflict();

$j( document ).on( 'ready', function() {
	"use strict";
    // Responsive Video
	sunioInitFitVids();
} );

/* ==============================================
RESPONSIVE VIDEOS
============================================== */
function sunioInitFitVids( $context ) {
	"use strict"

	$j( '.responsive-video-wrap, .responsive-audio-wrap', $context ).fitVids();

}