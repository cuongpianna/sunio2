<?php
/**
 * Archive product template.
 *
 * @package sunio WordPress theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $post;

do_action( 'sunio_before_archive_product_item' );

echo '<ul class="woo-entry-inner clr">';

	// Get elements
	$elements = sunio_woo_product_elements_positioning();

	// Loop through elements
	foreach ( $elements as $element ) {

		// Image
		if ( 'image' == $element ) {

			echo '<li class="image-wrap">';
				do_action( 'sunio_before_archive_product_image' );
				if ( class_exists( 'sunio_WooCommerce_Config' ) ) {
					sunio_WooCommerce_Config::add_out_of_stock_badge();
				}
				woocommerce_show_product_loop_sale_flash();
				if ( class_exists( 'sunio_WooCommerce_Config' ) ) {
					sunio_WooCommerce_Config::loop_product_thumbnail();
				}
				do_action( 'sunio_after_archive_product_image' );
			echo '</li>';

		}

		// Category
		if ( 'category' == $element ) {

			do_action( 'sunio_before_archive_product_categories' );
			echo wp_kses_post( wc_get_product_category_list( $product->get_id(), ', ', '<li class="category">', '</li>' ) );
			do_action( 'sunio_after_archive_product_categories' );

		}

		// Title
		if ( 'title' == $element ) {

			do_action( 'sunio_before_archive_product_title' );

			echo '<li class="title">';
				do_action( 'sunio_before_archive_product_title_inner' );
				echo '<a href="'. esc_url( get_the_permalink() ) .'">'. wp_trim_words( strip_shortcodes(get_the_title(),10 )) .'</a>';
				do_action( 'sunio_after_archive_product_title_inner' );
			echo '</li>';

			do_action( 'sunio_after_archive_product_title' );

		}

		// Price/Rating
		if ( 'price-rating' == $element ) {

			do_action( 'sunio_before_archive_product_inner' );

			echo '<li class="inner">';
				do_action( 'sunio_before_archive_product_price' );
				woocommerce_template_loop_price();
				do_action( 'sunio_before_archive_product_rating' );
				woocommerce_template_loop_rating();
				do_action( 'sunio_after_archive_product_rating' );
			echo '</li>';

			do_action( 'sunio_after_archive_product_inner' );

		}

		// Description
		if ( 'description' == $element ) {

			do_action( 'sunio_before_archive_product_description' );

			if ( ( sunio_is_woo_shop() || sunio_is_woo_tax() )
				&& get_theme_mod( 'sunio_woo_grid_list', true ) ) {
				$length = get_theme_mod( 'sunio_woo_list_excerpt_length', 20 );
				$length = (int)$length;
				echo '<li class="woo-desc">';
					if ( ! $length ) {
						echo wp_kses_post( strip_shortcodes( $post->post_excerpt ) );
					} else {
						echo wp_trim_words( strip_shortcodes( $post->post_excerpt ), $length );
					}
				echo '</li>';
			}

			do_action( 'sunio_after_archive_product_description' );

		}

		// Add to cart button
		if ( 'button' == $element ) {

			do_action( 'sunio_before_archive_product_add_to_cart' );

			echo '<li class="btn-wrap clr">';

				do_action( 'sunio_before_archive_product_add_to_cart_inner' );

				woocommerce_template_loop_add_to_cart();


				do_action( 'sunio_after_archive_product_add_to_cart_inner' );

			echo '</li>';

			do_action( 'sunio_after_archive_product_add_to_cart' );

		}

	}

echo '</ul>';

do_action( 'sunio_after_archive_product_item' );