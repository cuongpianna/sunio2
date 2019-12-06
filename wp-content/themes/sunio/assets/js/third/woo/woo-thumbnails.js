var $j = jQuery.noConflict();

$j( document ).on( 'ready', function() {
	"use strict";
    // Woo vertical thumbnails
    sunioWooThumbnails();
    //sunioWooThumbnailSlideHoriontal();
    
} );

// On load
$j( window ).on( 'load', function() {
	"use strict";
    // Woo vertical thumbnails
    sunioWooThumbnails();
    //sunioWooThumbnailSlideHoriontal();
} );

// On resize
$j( window ).on( 'resize', function() {
	"use strict";
    // Woo vertical thumbnails
    sunioWooThumbnails();
} );

function sunioWooThumbnailSlideHoriontal(){
	"use strict"
	var $thumbnails =$j('.azt-thumbnail-nav');
	//$thumbs 		= $thumbnails.find( '.flex-control-thumbs' );
	//console.log($thumbs);
	if ( $thumbnails.length > 0 ) {
		$thumbnails.slick( {
			infinite: true,
			dots: false,
			arrows: true,
			prevArrow: '<button type="button" class="slick-prev"><span class="fa fa-angle-left"></span></button>',
			nextArrow: '<button type="button" class="slick-next"><span class="fa fa-angle-right"></span></button>',
			speed: 500,
			  slidesToShow: 4,
			responsive: [
				{
					breakpoint: 960,
					settings: {
						slidesToShow: 4,
					}
				},
				{
					breakpoint: 768,
					settings: {
						slidesToShow: 3,
					}
				},
				{
					breakpoint: 480,
					settings: {
						slidesToShow: 2,
					}
				}
			]
		} );
	
	}

}
/* ==============================================
WOOCOMMERCE VERTICAL THUMBNAILS
============================================== */
function sunioWooThumbnails() {
	"use strict"

	var $thumbnails = $j( '.azt-thumbs-layout-vertical' ),
		$nav 		= $thumbnails.find( '.flex-control-nav' );

	if ( $nav.length > 0 ) {

		if ( $j( window ).width() > 768 ) {
				
			var $image_height 	= $thumbnails.find( '.flex-viewport' ).height(),
				$nav_height 	= $thumbnails.find('.flex-control-nav').height();

			if ( $nav_height > ( $image_height + 50 ) ) {
				$nav.css( {
					'max-height' : $image_height + 'px',
				} );
			}

		} else {
			$nav.css( {
				'max-height' : '',
			} );

		}

	}

}