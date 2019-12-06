<?php
/**
 * The Events Calendar plugin template.
 *
 * @package sunio WordPress theme
 */

get_header(); ?>

	<?php do_action( 'sunio_before_content_wrap' ); ?>

	<div id="content-wrap" class="container clr">

		<?php do_action( 'sunio_before_primary' ); ?>

		<div id="primary" class="content-area clr">

			<?php do_action( 'sunio_before_content' ); ?>

			<div id="content" class="site-content clr">

				<?php do_action( 'sunio_before_content_inner' ); ?>

					<div id="sunio-tribe-events">
						<?php tribe_events_before_html(); ?>
						<?php tribe_get_view(); ?>
						<?php tribe_events_after_html(); ?>
					</div>

				<?php do_action( 'sunio_after_content_inner' ); ?>

			</div><!-- #content -->

			<?php do_action( 'sunio_after_content' ); ?>

		</div><!-- #primary -->

		<?php do_action( 'sunio_after_primary' ); ?>

	</div><!-- #content-wrap -->

	<?php do_action( 'sunio_after_content_wrap' ); ?>

<?php get_footer(); ?>