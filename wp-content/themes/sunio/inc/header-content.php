<?php
/**
 * Header content.
 *
 * @package sunio WordPress theme
 */

// Vars
$header_style = sunio_header_style();
$position = get_theme_mod( 'sunio_mobile_elements_positioning', 'one' );
$woo_icon_visibility = get_theme_mod( 'sunio_woo_menu_icon_visibility', 'default' );

if ( sunio_WOOCOMMERCE_ACTIVE
	&& 'disabled' != $woo_icon_visibility
	&& 'two' == $position ) {
	add_action( 'sunio_header_inner_left_content', 'sunio_mobile_cart_icon', 1 );
}

if ( 'three' == $position ) {
	add_action( 'sunio_header_inner_left_content', 'sunio_mobile_icon', 1 );
}

add_action( 'sunio_header_inner_middle_content', 'sunio_header_logo', 10 );

if ( true == get_theme_mod( 'sunio_menu_social', false ) ) {
	add_action( 'sunio_header_inner_middle_content', 'sunio_header_social', 11 );
}

add_action( 'sunio_header_inner_middle_content', 'sunio_header_navigation', 12 );

if ( 'three' != $position ) {
	add_action( 'sunio_header_inner_right_content', 'sunio_mobile_icon', 99 );
}

if ( sunio_WOOCOMMERCE_ACTIVE
	&& 'disabled' != $woo_icon_visibility
	&& 'three' == $position ) {
	add_action( 'sunio_header_inner_right_content', 'sunio_mobile_cart_icon', 99 );
}

if ( sunio_WOOCOMMERCE_ACTIVE ) {
	add_action( 'sunio_before_mobile_icon_inner', 'sunio_mobile_cart_icon_medium_header', 10 );
}

if ( sunio_WOOCOMMERCE_ACTIVE
	&& 'disabled' != get_theme_mod( 'sunio_woo_menu_icon_visibility', 'default' )
	&& 'one' == get_theme_mod( 'sunio_mobile_elements_positioning', 'one' ) ) {
	add_action( 'sunio_before_mobile_icon_inner', 'sunio_mobile_cart_icon_not_medium_header', 10 );
}

/**
 * Mobile cart icon
 *
 * @since 1.5.6
 */
if ( ! function_exists( 'sunio_mobile_cart_icon' ) ) {

	function sunio_mobile_cart_icon() {

		// If bag style
		$bag = get_theme_mod( 'sunio_woo_menu_bag_style', 'no' );

		// Classes
		$classes = array( 'sunio-mobile-menu-icon', 'clr', 'woo-menu-icon' );

		// Position
		$position = get_theme_mod( 'sunio_mobile_elements_positioning', 'one' );
		if ( 'two' == $position ) {
			$classes[] = 'mobile-left';
		} else if ( 'three' == $position ) {
			$classes[] = 'mobile-right';
		}

		// Turn classes into space seperated string
		$classes = implode( ' ', $classes );

		echo '<div class="'. $classes .'">';
			if ( 'yes' == $bag ) {
				echo '<div class="bag-style">';
			}
			echo sunio_wcmenucart_menu_item();
			if ( 'yes' == $bag ) {
				echo '</div>';
			}
		echo '</div>';

	}

}

/**
 * Header logo
 *
 * @since 1.5.6
 */
if ( ! function_exists( 'sunio_header_logo' ) ) {

	function sunio_header_logo() {

		get_template_part( 'partials/header/logo' );

	}

}

/**
 * Header social
 *
 * @since 1.5.6
 */
if ( ! function_exists( 'sunio_header_social' ) ) {

	function sunio_header_social() {

		get_template_part( 'partials/header/social' );

	}

}

/**
 * Header navigation
 *
 * @since 1.5.6
 */
if ( ! function_exists( 'sunio_header_navigation' ) ) {

	function sunio_header_navigation() {

		get_template_part( 'partials/header/nav' );

	}

}

/**
 * Header navigation
 *
 * @since 1.5.6
 */
if ( ! function_exists( 'sunio_mobile_icon' ) ) {

	function sunio_mobile_icon() {

		get_template_part( 'partials/mobile/mobile-icon' );

	}

}

/**
 * Mobile cart icon for the Medium header style
 *
 * @since 1.5.6
 */
if ( ! function_exists( 'sunio_mobile_cart_icon_medium_header' ) ) {

	function sunio_mobile_cart_icon_medium_header() {
		$header_style = sunio_header_style();

		// Return if it is not medium or vertical header styles
		if ( 'medium' != $header_style
			&& 'vertical' != $header_style ) {
			return;
		}

		echo sunio_wcmenucart_menu_item();

	}

}

/**
 * Mobile cart icon if it is not the Medium header style
 *
 * @since 1.5.6
 */
if ( ! function_exists( 'sunio_mobile_cart_icon_not_medium_header' ) ) {

	function sunio_mobile_cart_icon_not_medium_header() {
		$header_style = sunio_header_style();

		// Return if medium or vertical header styles
		if ( 'medium' == $header_style
			|| 'vertical' == $header_style ) {
			return;
		}

        $logo = get_theme_mod('sunio_cart_logo');
		$quantity = WC()->cart->get_cart_contents_count( );

        if($logo){
            $html = '<div class="sunio-mobile-cart">';
                $html .= '<img src="' . $logo . '" alt="Cart">';

                $html .= '<span class="sunio-mobile-cart-quantity" >' . $quantity . '</span>';

            $html .= '</div>';
            echo $html;
        }else{
            echo sunio_wcmenucart_menu_item();
        }

	}

}