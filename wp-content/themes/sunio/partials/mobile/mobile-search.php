<?php
/**
 * Mobile search template.
 *
 * @package sunio WordPress theme
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Post type
$post_type = get_theme_mod( 'sunio_menu_search_source', 'any' ); ?>

<div id="mobile-menu-search" class="clr">
	<form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" class="mobile-searchform">
		<input type="search" name="s" autocomplete="off" placeholder="<?php echo esc_attr( apply_filters( 'sunio_mobile_searchform_placeholder', __( 'Search', 'sunio' ) ) ); ?>" />
		<button type="submit" class="searchform-submit">
			<i class="icon icon-magnifier"></i>
		</button>
		<?php if ( 'any' != $post_type ) { ?>
			<input type="hidden" name="post_type" value="<?php echo esc_attr( $post_type ); ?>">
		<?php } ?>
	</form>
</div><!-- .mobile-menu-search -->