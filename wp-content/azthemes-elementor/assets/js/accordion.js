( function( $ ) {
	var WidgetaztAccordionHandler = function( $scope, $ ) {

		var $accordion 	= $scope.find( '.azt-accordion' ),
			$data 		= $accordion.data( 'settings' );

		if ( $accordion.hasClass( 'azt-has-active-item' ) ) {
			$accordion.find( '.azt-accordion-item:nth-child('+ $data['active_item'] +')' ).addClass( 'azt-active' ).find( '.azt-accordion-content' ).slideDown( 200 );
		}

	    $accordion.find( '.azt-accordion-title' ).on( 'click', function() {
			var $this 	= $( this ),
				$parent =  $this.parent(),
				$next 	=  $this.next();
			
		    if ( 'true' == $data['multiple'] ) {
		    	$parent.toggleClass( 'azt-active' ).find( '.azt-accordion-content' ).slideToggle( 200 );
			} else {
		    	if ( $parent.hasClass( 'azt-active' ) ) {
		    		$parent.removeClass( 'azt-active' )
		    		$next.slideUp( 200 );
		    	} else {
			        $parent.parent().find( '.azt-accordion-item' ).removeClass( 'azt-active' );
			        $parent.parent().find( '.azt-accordion-content' ).slideUp( 200 );

		    		$parent.toggleClass( 'azt-active' );
		    		$next.slideToggle( 200 );
		    	}
			}

		} );
	};
	
	// Make sure we run this code under Elementor
	$( window ).on( 'elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/azt-accordion.default', WidgetaztAccordionHandler );
	} );
} )( jQuery );