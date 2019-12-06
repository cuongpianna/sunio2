<?php
/**
 * Display shortcodes in front end
 *
 * @package sunio_Extra
 * @category Core
 * @author sunio
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Shortcode before the top bar
if ( ! function_exists( 'sunio_shortcode_before_top_bar' ) ) {
	function sunio_shortcode_before_top_bar() {

		if ( $meta = get_post_meta( sunio_post_id(), 'sunio_shortcode_before_top_bar', true ) ) {
			echo do_shortcode( $meta );
		}

	}
	add_action( 'sunio_before_top_bar', 'sunio_shortcode_before_top_bar', 10 );
}

// Shortcode after the top bar
if ( ! function_exists( 'sunio_shortcode_after_top_bar' ) ) {
	function sunio_shortcode_after_top_bar() {

		if ( $meta = get_post_meta( sunio_post_id(), 'sunio_shortcode_after_top_bar', true ) ) {
			echo do_shortcode( $meta );
		}

	}
	add_action( 'sunio_after_top_bar', 'sunio_shortcode_after_top_bar', 10 );
}

// Shortcode before the header
if ( ! function_exists( 'sunio_shortcode_before_header' ) ) {
	function sunio_shortcode_before_header() {

		if ( $meta = get_post_meta( sunio_post_id(), 'sunio_shortcode_before_header', true ) ) {
			echo do_shortcode( $meta );
		}

	}
	add_action( 'sunio_before_header', 'sunio_shortcode_before_header', 10 );
}

// Shortcode after the header
if ( ! function_exists( 'sunio_shortcode_after_header' ) ) {
	function sunio_shortcode_after_header() {

		if ( $meta = get_post_meta( sunio_post_id(), 'sunio_shortcode_after_header', true ) ) {
			echo do_shortcode( $meta );
		}

	}
	add_action( 'sunio_after_header', 'sunio_shortcode_after_header', 10 );
}

// Shortcode before the title
if ( ! function_exists( 'sunio_shortcode_before_title' ) ) {
	function sunio_shortcode_before_title() {

		if ( $meta = get_post_meta( sunio_post_id(), 'sunio_has_shortcode', true ) ) {
			echo do_shortcode( $meta );
		}

	}
	add_action( 'sunio_before_page_header', 'sunio_shortcode_before_title', 10 );
}

// Shortcode after the title
if ( ! function_exists( 'sunio_shortcode_after_title' ) ) {
	function sunio_shortcode_after_title() {

		if ( $meta = get_post_meta( sunio_post_id(), 'sunio_shortcode_after_title', true ) ) {
			echo do_shortcode( $meta );
		}

	}
	add_action( 'sunio_after_page_header', 'sunio_shortcode_after_title', 10 );
}

// Shortcode before the footer widgets
if ( ! function_exists( 'sunio_shortcode_before_footer_widgets' ) ) {
	function sunio_shortcode_before_footer_widgets() {

		if ( $meta = get_post_meta( sunio_post_id(), 'sunio_shortcode_before_footer_widgets', true ) ) {
			echo do_shortcode( $meta );
		}

	}
	add_action( 'sunio_before_footer_widgets', 'sunio_shortcode_before_footer_widgets', 10 );
}

// Shortcode after the footer widgets
if ( ! function_exists( 'sunio_shortcode_after_footer_widgets' ) ) {
	function sunio_shortcode_after_footer_widgets() {

		if ( $meta = get_post_meta( sunio_post_id(), 'sunio_shortcode_after_footer_widgets', true ) ) {
			echo do_shortcode( $meta );
		}

	}
	add_action( 'sunio_after_footer_widgets', 'sunio_shortcode_after_footer_widgets', 10 );
}

// Shortcode before the footer bottom
if ( ! function_exists( 'sunio_shortcode_before_footer_bottom' ) ) {
	function sunio_shortcode_before_footer_bottom() {

		if ( $meta = get_post_meta( sunio_post_id(), 'sunio_shortcode_before_footer_bottom', true ) ) {
			echo do_shortcode( $meta );
		}

	}
	add_action( 'sunio_before_footer_bottom', 'sunio_shortcode_before_footer_bottom', 10 );
}

// Shortcode after the footer bottom
if ( ! function_exists( 'sunio_shortcode_after_footer_bottom' ) ) {
	function sunio_shortcode_after_footer_bottom() {

		if ( $meta = get_post_meta( sunio_post_id(), 'sunio_shortcode_after_footer_bottom', true ) ) {
			echo do_shortcode( $meta );
		}

	}
	add_action( 'sunio_after_footer_bottom', 'sunio_shortcode_after_footer_bottom', 10 );
}