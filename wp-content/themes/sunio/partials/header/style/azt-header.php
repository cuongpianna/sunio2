<?php
/**
 * Top Menu Header Style
 *
 * @package sunio WordPress theme
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Menu position
$position 	= get_theme_mod( 'sunio_top_header_menu_position', 'before' );

// Get classes
$classes = array( 'clr' );

// Add container class
if ( true != get_theme_mod( 'sunio_header_full_width', false ) ) {
    $classes[] = 'container';
}

// Turn classes into space seperated string
$classes = implode( ' ', $classes );

// Search style
$search = sunio_menu_search_style(); ?>

<?php
if ( 'after' == $position ) { ?>
	<div class="header-bottom clr">
		<div class="container">
			<?php get_template_part( 'partials/header/logo' ); ?>
		</div>
	</div>
<?php
} ?>

<div class="<?php echo esc_attr( sunio_top_header_classes() ); ?>">

	<?php do_action( 'sunio_before_header_inner' ); ?>

	<div id="site-header-inner" class="<?php echo esc_attr( $classes ); ?>">

		<?php
		// Search header replace
		if ( 'header_replace' == $search ) {
			get_template_part( 'partials/header/search-replace' );
		} ?>

	<div class="left clr">

			<div class="inner">
				
			</div>

		</div>
		<div class="left clr">

			<div class="inner">
				<div class="left">
					<?php get_template_part( 'partials/header/logo' ); ?>
				</div>
				<div class="right header_seach">
					<?php
						get_template_part( 'partials/header/style/vertical-header-search' );
					?>
				</div>
			</div>

		</div>
		<div class="right clr">

			<div class="inner">
				
				<?php get_template_part( 'partials/header/nav' ); ?>

				<?php get_template_part( 'partials/mobile/mobile-icon' ); ?>

			</div>
			
		</div>

	</div><!-- #site-header-inner -->

	<?php get_template_part( 'partials/mobile/mobile-dropdown' ); ?>

	<?php do_action( 'sunio_after_header_inner' ); ?>

</div><!-- .header-top -->

