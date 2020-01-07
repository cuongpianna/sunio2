<?php

namespace AztElementor\Modules\Woocommerce\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Widget_Base;
use Elementor\Utils;
use Elementor\Group_Control_Image_Size;

class Woo_Category extends Widget_Base
{

    public function get_name()
    {
        return 'azt-woo_category';
    }

    public function get_title()
    {
        return __('Woo - Categories', 'sunio-elementor-widgets');
    }

    public function get_icon()
    {
        // Upload "eicons.ttf" font via this site: http://bluejamesbond.github.io/CharacterMap/
        return 'azt-icon eicon-woocommerce';
    }

    public function get_style_depends()
    {
        return ['azt-sunio'];
    }

    public function get_categories()
    {
        return ['sunio-elements'];
    }

    protected function get_product_categories()
    {

        $product_cat = array();

        $cat_args = array(
            'orderby' => 'name',
            'order' => 'asc',
            'hide_empty' => false,
        );

        $product_categories = get_terms('product_cat', $cat_args);

        if (!empty($product_categories)) {
            foreach ($product_categories as $key => $category) {
                $product_cat[$category->slug] = $category->name;
            }
        }

        return $product_cat;
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'section_heading',
            [
                'label' => __('Product Categories', 'sunio'),
            ]
        );

        $this->add_control(
            'columns',
            [
                'label' => __('Category Count', 'lambor-elements'),
                'type' => Controls_Manager::SELECT,
                'default' => '6',
                'options' => [
                    '4' => '4',
                    '8' => '8',
                ],
            ]
        );

        $this->end_controls_section();
    }


    public function render()
    {
        $settings = $this->get_settings_for_display();
        $taxonomy = 'product_cat';
        $orderby = 'name';
        $show_count = 0;      // 1 for yes, 0 for no
        $pad_counts = 0;      // 1 for yes, 0 for no
        $hierarchical = 1;      // 1 for yes, 0 for no
        $title = '';
        $empty = 0;

        $args = array(
            'taxonomy' => $taxonomy,
            'orderby' => $orderby,
            'show_count' => $show_count,
            'pad_counts' => $pad_counts,
            'hierarchical' => $hierarchical,
            'title_li' => $title,
            'hide_empty' => $empty
        );
        $all_categories = get_categories($args);
        $count = 0;
        ?>
        <div class="woo-cateogires">
            <?php foreach ($all_categories as $cat): $category_id = $cat->term_id;
                $thumbnail_id = get_term_meta($cat->term_id, 'thumbnail_id', true);
                $link = get_term_link( (int)$category_id, 'product_cat' );
                $image_url = wp_get_attachment_url($thumbnail_id);
                if (!$image_url) {
                    $image_url = wc_placeholder_img_src();
                }
                ?>

                <div class="item">
                    <div class="image">
                        <img src="<?php echo $image_url; ?>" alt="">
                    </div>
                    <h3><a href="<?php echo esc_url($link);?>"><?php echo $cat->name; ?></a></h3>
                    <div class="desc">
                        <?php echo $cat->description;?>
                    </div>

                </div>
                <?php if ($count < $settings['columns']-1) {
                    $count++;
                } else {
                    break;
                } ?>
            <?php endforeach;
            wp_reset_postdata(); ?>
        </div>
        <?php
    }


}