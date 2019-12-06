<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package sunio WordPress theme
 */

// Retunr if full width or full screen
if ( in_array( sunio_post_layout(), array( 'full-screen', 'full-width' ) ) ) {
	return;
} ?>

<?php do_action( 'sunio_before_sidebar' ); ?>

<aside id="right-sidebar" class="sidebar-container widget-area sidebar-primary"<?php sunio_schema_markup( 'sidebar' ); ?>>

	<?php do_action( 'sunio_before_sidebar_inner' ); ?>

	<div id="right-sidebar-inner" class="clr">

		<?php
		if ( $sidebar = sunio_get_sidebar() ) {
			dynamic_sidebar( $sidebar );
		} ?>

	</div><!-- #sidebar-inner -->

	<?php do_action( 'sunio_after_sidebar_inner' ); ?>

</aside><!-- #right-sidebar -->

<?php do_action( 'sunio_after_sidebar' ); ?>