<?php
/**
 * Topbar content
 *
 * @package sunio WordPress theme
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Get the template
$template = get_theme_mod('sunio_top_bar_template');

// Check if page is Elementor page
$elementor = get_post_meta($template, '_elementor_edit_mode', true);

// Get content
$get_content = sunio_topbar_template_content();

// Get topbar content
$content = get_theme_mod('sunio_top_bar_content');
$hotline_heading = get_theme_mod('sunio_hotline_heading');
$hotline_value = get_theme_mod('sunio_hotline_value', '1900 63 69 14');

$hotline_heading2 = get_theme_mod('sunio_hotline_heading2', 'SALES');
$hotline_value2 = get_theme_mod('sunio_hotline_value2', '08 96 355 777');

$content = sunio_tm_translation('sunio_top_bar_content', $content);

?>

<?php if ($hotline_heading != ''): ?>
    <div id="top-bar-content">
        <span class="topbar-content">
            <span class="topbar-hotline-heading"><?php echo $hotline_heading; ?></span>
            <span class="topbar-hotline-value"><?php echo $hotline_value; ?></span>

            <?php if(get_theme_mod('sunio_hotline_heading2', 'SALES') != ''): ?>
                <span class="topbar-content-seperate"> - </span>
                <span class="topbar-hotline-heading"><?php echo $hotline_heading2; ?></span>
                <span class="topbar-hotline-value"><?php echo $hotline_value2; ?></span>
            <?php endif; ?>

        </span>
    </div>
<?php endif; ?>