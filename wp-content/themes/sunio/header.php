<?php
/**
 * The Header for our theme.
 *
 * @package sunio WordPress theme
 */ ?>

<!DOCTYPE html>
<html class="<?php echo esc_attr( sunio_html_classes() ); ?>" <?php language_attributes(); ?><?php sunio_schema_markup( 'html' ); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<?php do_action( 'sunio_before_outer_wrap' ); ?>

	<div id="outer-wrap" class="site clr">

		<?php do_action( 'sunio_before_wrap' ); ?>

		<div id="wrap" class="clr">

			<?php do_action( 'sunio_top_bar' ); ?>

			<?php do_action( 'sunio_header' ); ?>

			<?php do_action( 'sunio_before_main' ); ?>
			
			<main id="main" class="site-main clr"<?php sunio_schema_markup( 'main' ); ?>>

				<?php do_action( 'sunio_page_header' ); ?>