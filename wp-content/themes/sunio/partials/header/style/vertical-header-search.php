<?php
/**
 * Search Form for The Vertical Header Style
 *
 * @package sunio WordPress theme
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Post type
$post_type = get_theme_mod( 'sunio_menu_search_source', 'any' ); ?>

<div id="vertical-searchform" class="header-searchform-wrap clr">
	<form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" class="header-searchform">
		<input type="search" name="s" placeholder="Search" autocomplete="off" value="" />
		<button class="search-submit"><i class="icon-magnifier"></i></button>
		<div class="search-bg"></div>
		<?php if ( 'any' != $post_type ) { ?>
			<input type="hidden" name="post_type" value="<?php echo esc_attr( $post_type ); ?>">
		<?php } ?>
	</form>
</div><!-- #vertical-searchform -->