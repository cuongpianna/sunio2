<?php
/**
 * Topbar content
 *
 * @package sunio WordPress theme
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Get the template
$template = get_theme_mod( 'sunio_top_bar_template' );

// Check if page is Elementor page
$elementor = get_post_meta( $template, '_elementor_edit_mode', true );

// Get content
$get_content = sunio_topbar_template_content();

// Get topbar content
$content = get_theme_mod( 'sunio_top_bar_content' );
$hotline_heading = get_theme_mod('sunio_hotline_heading');
$hotline_value = get_theme_mod('sunio_hotline_value');

$hotline_heading2 = get_theme_mod('sunio_hotline_heading2');
$hotline_value2 = get_theme_mod('sunio_hotline_value2');

$content = sunio_tm_translation( 'sunio_top_bar_content', $content );
var_dump(get_theme_mod( 'sunio_hotline_heading' ));

// Display topbar content
if ( ! empty( $template )
    || $content
    || has_nav_menu( 'topbar_menu' )
    || is_customize_preview() ) : ?>

    <div id="top-bar-content" class="<?php echo esc_attr( sunio_topbar_content_classes() ); ?>">

        <?php
        // Get topbar menu
        if ( has_nav_menu( 'topbar_menu' ) )  {
            get_template_part( 'partials/topbar/nav' );
        } ?>

        <?php
        // If template
        if ( ! empty( $template ) ) { ?>

            <div id="topbar-template">

               <?php
               // If Elementor
                if ( sunio_ELEMENTOR_ACTIVE && $elementor ) {

                    sunio_Elementor::get_topbar_content();

                }

                // If Beaver Builder
                else if ( sunio_BEAVER_BUILDER_ACTIVE && ! empty( $template ) ) {

                    echo do_shortcode( '[fl_builder_insert_layout id="' . $template . '"]' );

                }

                // Else
                else {

                    // Display template content
                    echo do_shortcode( $get_content );

                } ?>

            </div>

        <?php
        } else { ?>

            <?php
            // Check if there is content for the topbar
            if ( $content
                || is_customize_preview() ) : ?>

                <span class="topbar-content">

                    <?php
                    // Display top bar content
//                    echo do_shortcode( $content );
//                    echo $hotline_heading;
                    ?>

                    <span class="topbar-hotline-heading"><?php echo do_shortcode($hotline_heading); ?></span>
                    <span class="topbar-hotline-value"><?php echo do_shortcode($hotline_value); ?></span>

                    <?php if($hotline_heading2 != ''): ?>
                        abcs
                    <?php endif; ?>

                </span>

            <?php endif;

        } ?>

    </div><!-- #top-bar-content -->

<?php endif; ?>