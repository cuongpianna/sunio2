<?php
/**
 * The template for displaying the footer.
 *
 * @package sunio WordPress theme
 */ ?>

        </main><!-- #main -->

        <?php do_action( 'sunio_after_main' ); ?>

        <?php do_action( 'sunio_before_footer' ); ?>

        <?php
        // Elementor `footer` location
        if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'footer' ) ) { ?>

            <?php do_action( 'sunio_footer' ); ?>
            
        <?php } ?>

        <?php do_action( 'sunio_after_footer' ); ?>
                
    </div><!-- #wrap -->

    <?php do_action( 'sunio_after_wrap' ); ?>

</div><!-- #outer-wrap -->

<?php do_action( 'sunio_after_outer_wrap' ); ?>

<?php
// If is not sticky footer
if ( ! class_exists( 'sunio_Sticky_Footer' ) ) {
    get_template_part( 'partials/scroll-top' );
} ?>

<?php
// Search overlay style
if ( 'overlay' == sunio_menu_search_style() ) {
    get_template_part( 'partials/header/search-overlay' );
} ?>

<?php
// If sidebar mobile menu style
if ( 'sidebar' == sunio_mobile_menu_style() ) {
    
    // Mobile panel close button
    if ( get_theme_mod( 'sunio_mobile_menu_close_btn', true ) ) {
        get_template_part( 'partials/mobile/mobile-sidr-close' );
    } ?>

    <?php
    // Mobile Menu (if defined)
    get_template_part( 'partials/mobile/mobile-nav' ); ?>

    <?php
    // Mobile search form
    if ( get_theme_mod( 'sunio_mobile_menu_search', true ) ) {
        get_template_part( 'partials/mobile/mobile-search' );
    }

} ?>

<?php
// If full screen mobile menu style
if ( 'fullscreen' == sunio_mobile_menu_style() ) {
    get_template_part( 'partials/mobile/mobile-fullscreen' );
} ?>

<?php wp_footer(); ?>
</body>
</html>