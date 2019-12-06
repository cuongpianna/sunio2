<?php
/**
 * Post single content
 *
 * @package sunio WordPress theme
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>

<?php do_action( 'sunio_before_single_post_content' ); ?>

<div class="entry-content clr"<?php sunio_schema_markup( 'entry_content' ); ?>>
	<?php the_content();

	wp_link_pages( array(
		'before'      => '<div class="page-links">' . __( 'Pages:', 'sunio' ),
		'after'       => '</div>',
		'link_before' => '<span class="page-number">',
		'link_after'  => '</span>',
	) ); ?>
</div><!-- .entry -->

<?php do_action( 'sunio_after_single_post_content' ); ?>