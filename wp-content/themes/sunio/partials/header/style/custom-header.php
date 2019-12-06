<?php
/**
 * Custom Header Style
 *
 * @package sunio WordPress theme
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Get ID
$get_id = sunio_custom_header_template();

// Check if page is Elementor page
$elementor  = get_post_meta( $get_id, '_elementor_edit_mode', true );

// Get content
$get_content = sunio_header_template_content();

// Get classes
$classes = array( 'clr' );

// Add container class
if ( true == get_theme_mod( 'sunio_add_custom_header_container', true ) ) {
    $classes[] = 'container';
}

// Turn classes into space seperated string
$classes = implode( ' ', $classes ); ?>

<?php do_action( 'sunio_before_header_inner' ); ?>

<div id="site-header-inner" class="<?php echo esc_attr( $classes ); ?>">

    <?php
    // If Elementor
    if ( sunio_ELEMENTOR_ACTIVE && $elementor ) {

        sunio_Elementor::get_header_content();

    }

    // If Beaver Builder
    else if ( sunio_BEAVER_BUILDER_ACTIVE && ! empty( $get_id ) ) {

        echo do_shortcode( '[fl_builder_insert_layout id="' . $get_id . '"]' );

    }

    // Else
    else {

        // Display template content
        echo do_shortcode( $get_content );

    } ?>

</div>

<?php do_action( 'sunio_after_header_inner' ); ?>