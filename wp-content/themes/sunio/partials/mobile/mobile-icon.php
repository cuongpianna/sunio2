<?php
/**
 * Mobile Menu icon
 *
 * @package sunio WordPress theme
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Retunr if disabled
if ( ! sunio_display_navigation() ) {
	return;
}

// Menu Location
$menu_location = apply_filters( 'sunio_main_menu_location', 'main_menu' );

// Multisite global menu
$ms_global_menu = apply_filters( 'sunio_ms_global_menu', true );

// Display if menu is defined
if ( has_nav_menu( $menu_location ) || $ms_global_menu ) :

	// Get menu icon
	$icon = get_theme_mod( 'sunio_mobile_menu_open_icon', 'fa fa-bars' );
	$icon = apply_filters( 'sunio_mobile_menu_navbar_open_icon', $icon );

	// Custom hamburger button
	$btn = get_theme_mod( 'sunio_mobile_menu_open_hamburger', 'default' );

	// Get menu text
	$text = get_theme_mod( 'sunio_mobile_menu_text' );
	$text = sunio_tm_translation( 'sunio_mobile_menu_text', $text );
//	$text = $text ? $text: esc_html__( 'Menu', 'sunio' );

	// Get close menu text
	$close_text = get_theme_mod( 'sunio_mobile_menu_close_text' );
	$close_text = sunio_tm_translation( 'sunio_mobile_menu_close_text', $close_text );
//	$close_text = $close_text ? $close_text: esc_html__( 'Close', 'sunio' );

	if ( sunio_WOOCOMMERCE_ACTIVE ) {

		// Get cart icon
		$woo_icon = get_theme_mod( 'sunio_woo_menu_icon', 'icon-handbag' );
		$woo_icon = $woo_icon ? $woo_icon : 'icon-handbag';

		// If has custom cart icon
		$custom_icon = get_theme_mod( 'sunio_woo_menu_custom_icon' );
		if ( '' != $custom_icon ) {
			$woo_icon = $custom_icon;
		}

		// Cart Icon
		$cart_icon = '<i class="'. esc_attr( $woo_icon ) .'"></i>';
		$cart_icon = apply_filters( 'sunio_menu_cart_icon_html', $cart_icon );

	}

	// Classes
	$classes = array( 'sunio-mobile-menu-icon', 'clr' );

	// Position
	if ( 'three' == get_theme_mod( 'sunio_mobile_elements_positioning', 'one' ) ) {
		$classes[] = 'mobile-left';
	} else {
		$classes[] = 'mobile-right';
	}

	// Turn classes into space seperated string
	$classes = implode( ' ', $classes ); ?>

	<div class="<?php echo esc_attr( $classes ); ?>">

		<?php do_action( 'sunio_before_mobile_icon' ); ?>

		<?php
		// If big header style
		if ( 'big' == sunio_header_style() ) { ?>
			<div class="container clr">
		<?php } ?>

		<?php do_action( 'sunio_before_mobile_icon_inner' ); ?>

		<a href="#" class="mobile-menu">
			<?php
			if ( 'default' != $btn ) { ?>
				<div class="hamburger hamburger--<?php echo esc_attr( $btn ); ?>">
					<div class="hamburger-box">
						<div class="hamburger-inner"></div>
					</div>
				</div>
			<?php
			} else { ?>
				<i class="<?php echo esc_attr( $icon ); ?>"></i>
			<?php
			}

			// Mobile menu text
			if ( get_theme_mod( 'sunio_mobile_menu_display_opening_text', true ) ) { ?>
				<span class="sunio-text"><?php echo do_shortcode( $text ); ?></span>

				<?php
				// Display close text if drop down mobile style
				if ( 'dropdown' == get_theme_mod( 'sunio_mobile_menu_style', 'sidebar' ) ) { ?>
					<span class="sunio-close-text"><?php echo do_shortcode( $close_text ); ?></span>
				<?php
				}
			} ?>
		</a>

		<?php do_action( 'sunio_after_mobile_icon_inner' ); ?>

		<?php
		// If big header style
		if ( 'big' == sunio_header_style() ) { ?>
			</div>
		<?php } ?>

		<?php do_action( 'sunio_after_mobile_icon' ); ?>

	</div><!-- #sunio-mobile-menu-navbar -->

<?php endif; ?>