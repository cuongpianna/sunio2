<?php
/**
 * The sidebar containing the main widgets area.
 *
 * @package AzThemes WordPress theme
 */
// Retunr if full width or full screen
$sidebar_type = get_theme_mod('lambor_sidebar_type');
$layout = get_theme_mod('lambor_woo_shop_layout', 'left-sidebar');
if ( in_array( lambor_post_layout(), array( 'full-screen', 'full-width' ) ) ) {
    return;
} ?>

<?php do_action( 'lambor_before_sidebar' ); ?>

    <aside  id="right-sidebar" class="sidebar-container widget-area sidebar-primary"<?php lambor_schema_markup( 'sidebar' ); ?>>

        <?php do_action( 'lambor_before_sidebar_inner' ); ?>

        <div id="right-sidebar-inner" class="clr">

            <?php
            if(is_shop() || is_tax()){
                if ( $sidebar_type != 'woo-sidebar' && $sidebar = lambor_get_sidebar() ) {
                    dynamic_sidebar( $sidebar );
                } elseif($sidebar = lambor_get_sidebar() && $sidebar_type='woo-sidebar'){
                    if(($layout=='left-sidebar' || $layout=='right-sidebar')){
                        wc_get_template_part('sunio/woo-sidebar');
                    }
                }
            }else{
                if ( $sidebar = lambor_get_sidebar() ) {
                    dynamic_sidebar( $sidebar );
                }
            }
            ?>


        </div><!-- #sidebar-inner -->

        <?php do_action( 'lambor_after_sidebar_inner' ); ?>

    </aside><!-- #right-sidebar -->

<?php do_action( 'lambor_after_sidebar' ); ?>