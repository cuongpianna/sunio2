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
use Elementor\Plugin;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Woo_Single_Product extends Widget_Base
{
    private $query = null;

    public function get_name()
    {
        return 'azt-woo_single_product';
    }

    public function get_title()
    {
        return __('Woo - Single Products', 'sunio');
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

    public function get_script_depends()
    {
        return ['azt-woo_single_product'];
    }

    public function get_categories()
    {
        return ['sunio-elements'];
    }

    public function get_query()
    {
        return $this->query;
    }

    protected function get_product_categories()
    {

        $product_cat = array();

        $cat_args = array(
            'hide_empty' => false,
            'parent' => ''
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
            'section_woo_products',
            [
                'label' => __('Content', 'lambor-elements'),
            ]
        );

        $this->add_control(
            'category_filter',
            [
                'label' => __('Select Categories', 'lambor-elements'),
                'type' => Controls_Manager::SELECT,
                'multiple' => true,
                'default' => 'audi',
                'options' => $this->get_product_categories(),

            ]
        );


        $this->add_control(
            'order_by',
            [
                'label' => __('Order by', 'lambor-elements'),
                'type' => Controls_Manager::SELECT,
                'default' => 'id',
                'options' => [
                    'id' => __('ID', 'lambor-elements'),
                    'total_sales' => __('Total Sales', 'lambor-elements'),
                    'rating' => __('Rating', 'lambor-elements'),
                    'price' => __('Price', 'lambor-elements'),
                ],

            ]
        );

        $this->add_control(
            'order',
            [
                'label' => __('Order', 'lambor-elements'),
                'type' => Controls_Manager::SELECT,
                'default' => 'DESC',
                'options' => [
                    'DESC' => __('Decrease', 'lambor-elements'),
                    'ASC' => __('Ascending', 'lambor-elements'),

                ],

            ]
        );

        $this->add_control(
            'total_post',
            [
                'label' => __('Total posts', 'lambor-elements'),
                'type' => Controls_Manager::NUMBER,
                'default' => '4',
            ]
        );

        $this->end_controls_section();

    }


    public function render()
    {
        $settings = $this->get_settings();

        $cat = $settings['category_filter'];

        $args_basic = array(
            'post_type' => 'product',
            'post_status' => 'publish',
            'posts_per_page' => $settings['total_post'],
            'order' => 'DESC',
        );


        $args_filters = array(
            'tax_query' => array(
                'relation' => 'AND',
                array(
                    'taxonomy' => 'product_cat',
                    'field' => 'slug',
                    'terms' => $cat,
                ),
            ),

        );

        if ($settings['order_by'] == 'id') {

            $args_orderby = array('orderby' => 'id');

        } else if ($settings['orderby'] == 'total_sales') {

            $args_orderby = array('orderby' => 'meta_value_num', 'meta_key' => 'total_sales');

        } else if ($settings['order_by'] == 'rating') {
            $args_orderby = array('orderby' => 'meta_value_num', 'meta_key' => '_wc_average_rating');

        } else if ($settings['order_by'] == 'price') {

            $args_orderby = array('orderby' => 'meta_value_num', 'meta_key' => '_regular_price');
        }

        $args_product_new = array_merge_recursive($args_basic, $args_orderby, $args_filters);
        $products = new \WP_Query($args_product_new);

        ?>

        <div class="sunio-single-product owl-carousel owl-theme">
            <?php if ($products->have_posts()): while ($products->have_posts()): $products->the_post(); global $product;?>
                <div class="item sunio-item">
                    <?php
                    $img = wp_get_attachment_image_src( get_post_thumbnail_id( $product->get_id() ), 'single-post-thumbnail')[0];
                    if(!$img){
                        $img = wc_placeholder_img_src();
                    }

                    $min_order = get_post_meta($product->get_id(), 'min_order', true);
                    $p_unit = get_post_meta($product->get_id(), 'product_unit', true);
                    ?>

                    <div class="avatar-wrap">
                        <img src="<?php echo esc_attr($img)?>" alt="<?php echo get_the_title(); ?>">
                    </div>

                    <div class="content-wrap">
                        <h3 class="title"><?php echo get_the_title(); ?></h3>

                        <div class="price-wrap">
                            <?php wc_get_template_part('sunio/sunio-price'); ?>
                        </div>

                        <?php if($min_order): ?>
                        <div class="min-order-wrap">
                            <span class="min-order">
                                <?php echo $min_order . ' ' . $p_unit; ?>
                            </span>
                            <span class="unit">(Min. Order)</span>
                        </div>

                            <a href="<?php echo get_permalink(); ?>" class="product-link">View Detail</a>

                            <div class="product-thumnails">
                                <?php $attachment_ids = $product->get_gallery_image_ids();?>
                                <div class="owl-carousel owl-theme">
                                    <?php
                                        foreach ($attachment_ids as $attachment_id) {
                                            $image_link = wp_get_attachment_url($attachment_id);
                                            $image_title = esc_attr(get_the_title($attachment_id)); ?>
                                            
                                            <div class="item">
                                                <img src="<?php echo $image_link; ?>" alt="<?php echo $image_title; ?>">
                                            </div>
                                            
                                        <?php }
                                    ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endwhile;wp_reset_postdata();endif; ?>
        </div>

        <?php
    }
}