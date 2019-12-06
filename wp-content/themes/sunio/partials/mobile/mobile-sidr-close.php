<?php
/**
 * Mobile Menu sidr close
 *
 * @package sunio WordPress theme
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get icon
$icon = get_theme_mod( 'sunio_mobile_menu_close_btn_icon', 'icon-close' );
$icon = apply_filters( 'sunio_mobile_menu_close_btn_icon', $icon );

// Text
$text = get_theme_mod( 'sunio_mobile_menu_close_btn_text' );
$text = sunio_tm_translation( 'sunio_mobile_menu_close_btn_text', $text );
$text = $text ? $text: esc_html__( 'Close Menu', 'sunio' ); ?>

<div id="sidr-close">
	<a href="#" class="toggle-sidr-close">
		<i class="icon <?php echo esc_attr( $icon ); ?>"></i><span class="close-text"><?php echo do_shortcode( $text ); ?></span>
	</a>
</div>