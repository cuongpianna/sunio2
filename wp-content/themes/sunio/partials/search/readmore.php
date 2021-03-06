<?php
/**
 * Search result page entry read more
 *
 * @package sunio WordPress theme
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Text
$text = esc_html__( 'Continue Reading', 'sunio' );

// Apply filters for child theming
$text = apply_filters( 'sunio_search_readmore_link_text', $text ); ?>

<div class="search-entry-readmore clr">
    <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( $text ); ?>"><?php echo esc_html( $text ); ?></a>
</div><!-- .search-entry-readmore -->