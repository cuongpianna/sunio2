<?php
/**
 * The left sidebar containing the widget area.
 *
 * @package sunio WordPress theme
 */ ?>

<?php do_action( 'sunio_before_sidebar' ); ?>

<aside id="left-sidebar" class="sidebar-container widget-area sidebar-secondary"<?php sunio_schema_markup( 'sidebar' ); ?>>

	<?php do_action( 'sunio_before_sidebar_inner' ); ?>

	<div id="left-sidebar-inner" class="clr">

		<?php
		if ( $sidebar = sunio_get_second_sidebar() ) {
			dynamic_sidebar( $sidebar );
		} ?>

	</div><!-- #sidebar-inner -->

	<?php do_action( 'sunio_after_sidebar_inner' ); ?>

</aside><!-- #sidebar -->

<?php do_action( 'sunio_after_sidebar' ); ?>