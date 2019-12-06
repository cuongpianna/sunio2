<?php
/**
 * Displays post entry read more
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
$text = apply_filters( 'sunio_post_readmore_link_text', $text ); ?>

<?php do_action( 'sunio_before_blog_entry_readmore' ); ?>

<div class="blog-entry-readmore clr">
    <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( $text ); ?>"><?php echo esc_html( $text ); ?><i class="fa fa-angle-right"></i></a>
</div><!-- .blog-entry-readmore -->

<?php do_action( 'sunio_after_blog_entry_readmore' ); ?>