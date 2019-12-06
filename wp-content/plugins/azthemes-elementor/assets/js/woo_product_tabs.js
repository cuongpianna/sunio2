( function( $ ) {
	var WidgetaztWooTabsHandler = function( $scope, $ ) {
		var $wootabs = $scope.find( '.azt-product-filter' );
	    $wootabs.find('.azt-tabs li a').off('click').on( 'click', function() {
			var $this 	= $( this ),tabvals=$this.data('slug');

			$('.azt-tabs').find('li a').removeClass('active');
			$this.addClass('active');

			$('.azt-tabs-content').find('div').removeClass('active');
			$('#'+tabvals).addClass('active');
			return false;
		});
		
	};
	
	// Make sure we run this code under Elementor
	$( window ).on( 'elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/azt-woo_products_tabs.default', WidgetaztWooTabsHandler );
	} );
} )( jQuery );