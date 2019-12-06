<?php
/**
 * Search result page entry content
 *
 * @package sunio WordPress theme
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post;

// Excerpt length
$length = apply_filters( 'sunio_search_results_excerpt_length', '30' ); ?>

<div class="search-entry-summary clr"<?php sunio_schema_markup( 'entry_content' ); ?>>
    <p>
	    <?php
	    // Display excerpt
	    if ( has_excerpt( $post->ID ) ) {
		    the_excerpt();
		}

		// Display custom excerpt
		else {
		    echo wp_trim_words( strip_shortcodes( $post->post_content ), $length );
		} ?>
    </p>
</div><!-- .search-entry-summary -->