var $j = jQuery.noConflict();

$j( document ).on( 'ready', function() {
	"use strict";
	// Nav no click
	sunioNavNoClick();
} );

/* ==============================================
NAV NO CLICK
============================================== */
function sunioNavNoClick() {
	"use strict"

	$j( 'li.nav-no-click > a' ).on( 'click', function() {
		return false;
	} );

}