var $j = jQuery.noConflict();

$j( document ).on( 'ready', function() {
	"use strict";
	// Custom select
	sunioCustomSelects();
} );

/* ==============================================
CUSTOM SELECT
============================================== */
function sunioCustomSelects() {
	"use strict"

	$j( sunioLocalize.customSelects ).customSelect( {
		customClass: 'theme-select'
	} );

}