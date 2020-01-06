<?php
/**
 * Single product template.
 *
 * @package sunio WordPress theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// Get elements
$elements = sunio_woo_summary_elements_positioning();

// Loop through elements
foreach ( $elements as $element ) {

	do_action( 'sunio_before_single_product_' . $element );

	// Title
	if ( 'title' == $element ) {
		woocommerce_template_single_title();
	}

	// Rating
	if ( 'rating' == $element ) {
		woocommerce_template_single_rating();
	}

	// Price
	if ( 'price' == $element ) {
	    echo '<div class="price">';
		wc_get_template_part('sunio/single-price');
		echo '</div>';
	}

	// Excerpt
	if ( 'excerpt' == $element ) {
		woocommerce_template_single_excerpt();
	}

	// Quantity & Add to cart button
	if ( 'quantity-button' == $element ) {
		woocommerce_template_single_add_to_cart();
	}

	// Meta
	if ( 'meta' == $element ) {
		woocommerce_template_single_meta();
	}

    // Reviews
    if ( 'review' == $element ) {

        do_action( 'sunio_before_archive_product_add_to_cart' );

        echo '<div class="review">';

        echo wc_get_template_part('sunio/single-review');

        echo '</div>';

    }

    if ( 'category' == $element ) {

        echo '<div class="category">';

        wc_get_template_part('sunio/single-category');

        echo '</div>';

    }

    if ( 'quantity' == $element ) {

        echo '<div class="quantity-button">';

        woocommerce_template_single_add_to_cart();

        echo '</div>';

    }

	do_action( 'sunio_after_single_product_' . $element );

}