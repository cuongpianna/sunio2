<?php
/**
 * Outputs page article
 *
 * @package sunio WordPress theme
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
} ?>

<div class="entry clr"<?php sunio_schema_markup( 'entry_content' ); ?>>
	<?php do_action( 'sunio_before_page_entry' ); ?>
	<?php the_content();

	wp_link_pages( array(
		'before' => '<div class="page-links">' . __( 'Pages:', 'sunio' ),
		'after'  => '</div>',
	) ); ?>
	<?php do_action( 'sunio_after_page_entry' ); ?>
</div>