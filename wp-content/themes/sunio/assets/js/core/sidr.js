var $j 		= jQuery.noConflict(),
	$window = $j( window );

$j( document ).on( 'ready', function() {
	"use strict";
	// Mobile menu
	sunioMobileMenu();
} );

/* ==============================================
MOBILE SCRIPT
============================================== */
function sunioMobileMenu( event ) {
	"use strict"

	if ( typeof sunioLocalize.sidrSource !== 'undefined'
		&& $j( 'body' ).hasClass( 'sidebar-mobile' ) ) {

		// Add sidr
		$j( '.mobile-menu' ).sidr( {
			name     : 'sidr',
			source   : sunioLocalize.sidrSource,
			side     : sunioLocalize.sidrSide,
			displace : sunioLocalize.sidrDisplace,
			speed    : 300,
			renaming : true,
			bind     : 'click',
			
			onOpen   : function onOpen() {

				// Class of the custom opening button
				$j( '.mobile-menu > .hamburger' ).addClass( 'is-active' );

				// Declare useful vars
				var $hasChildren = $j( '.sidr-class-menu-item-has-children' );

				// Add dropdown toggle (plus)
				$hasChildren.children( 'a' ).append( '<span class="sidr-class-dropdown-toggle"></span>' );

				// Toggle dropdowns
				var $sidrDropdownTarget = $j( '.sidr-class-dropdown-toggle' );

				// Check localization
				if ( sunioLocalize.sidrDropdownTarget == 'link' ) {
					$sidrDropdownTarget = $j( 'li.sidr-class-menu-item-has-children > a' );
				}

				// Add toggle click event
				$sidrDropdownTarget.on( 'click', function( event ) {

					// Define toggle vars
					if ( sunioLocalize.sidrDropdownTarget == 'link' ) {
						var $toggleParentLi   = $j( this ).parent( 'li' );
					} else {
						var $toggleParentLink = $j( this ).parent( 'a' ),
							$toggleParentLi   = $toggleParentLink.parent( 'li' );
					}

					// Get parent items and dropdown
					var $allParentLis = $toggleParentLi.parents( 'li' ),
						$dropdown     = $toggleParentLi.children( 'ul' );

					// Toogle items
					if ( ! $toggleParentLi.hasClass( 'active' ) ) {
						$hasChildren.not( $allParentLis ).removeClass( 'active' ).children( 'ul' ).slideUp( 'fast' );
						$toggleParentLi.addClass( 'active' ).children( 'ul' ).slideDown( 'fast' );
					} else {
						$toggleParentLi.removeClass( 'active' ).children( 'ul' ).slideUp( 'fast' );
					}

					// Return false
					return false;

				} );

				// Add light overlay to content
				$j( 'body' ).append( '<div class="sunio-sidr-overlay"></div>' );
				$j( '.sunio-sidr-overlay' ).fadeIn( 300 );

				// Close sidr when clicking overlay
				$j( '.sunio-sidr-overlay' ).on( 'click', function() {
					$j.sidr( 'close', 'sidr' );
					return false;
				} );

				// Close on resize
				$window.resize( function() {
					if ( $window.width() >= 960 ) {
						$j.sidr( 'close', 'sidr' );
						$j( '.mobile-menu > .hamburger' ).removeClass( 'is-active' );
					}
				} );

			},
			onClose : function onClose() {

				// Remove class of the custom opening button
				$j( '.mobile-menu > .hamburger' ).removeClass( 'is-active' );

				// Remove active dropdowns
				$j( '.sidr-class-menu-item-has-children.active' ).removeClass( 'active' ).children( 'ul' ).hide();
				
				// FadeOut overlay
				$j( '.sunio-sidr-overlay' ).fadeOut( 300, function() {
					$j( this ).remove();
				} );
			}

		} );

        // Replace Font Awesome icons class
		$j( '#sidr [class*="sidr-class-fa"]' ).attr( 'class', function( i, c ) {
			c = c.replace( 'sidr-class-fa', 'fa' );
			c = c.replace( 'sidr-class-fa-', 'fa-' );
			return c;
		} );

        // Replace Simple Line Icons class
		$j( '#sidr [class*="sidr-class-icon"]' ).attr( 'class', function( i, c ) {
			c = c.replace( 'sidr-class-icon-', 'icon-' );
			return c;
		} );

		// Close sidr when clicking on close button
		$j( 'a.sidr-class-toggle-sidr-close' ).on( 'click', function() {
			$j.sidr( 'close', 'sidr' );
			$j( '.mobile-menu > .hamburger' ).removeClass( 'is-active' );
			return false;
		} );

		// Close when clicking local scroll link
		$j( '.sidr-class-dropdown-menu a[href*="#"]:not([href="#"]), .sidr-class-menu-item > a[href*="#"]:not([href="#"])' ).on( 'click', function() {
			$j.sidr( 'close', 'sidr' );
			$j( '.mobile-menu > .hamburger' ).removeClass( 'is-active' );
		} );

		// If disable link
		$j( 'li.sidr-class-nav-no-click > a' ).on( 'click', function() {
			return false;
		} );

	}

}