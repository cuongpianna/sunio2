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

class Woo_Products extends Widget_Base
{
    private $query = null;

    public function get_name()
    {
        return 'azt-woo_products';
    }

    public function get_title()
    {
        return __('Woo - Products', 'sunio');
    }

    public function get_icon()
    {
        // Upload "eicons.ttf" font via this site: http://bluejamesbond.github.io/CharacterMap/
        return 'azt-icon eicon-woocommerce';
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
            'posts_per_page',
            [
                'label' => __('Products Count', 'lambor-elements'),
                'type' => Controls_Manager::NUMBER,
                'default' => '8',
            ]
        );

        $this->add_control(
            'columns',
            [
                'label' => __('Columns', 'lambor-elements'),
                'type' => Controls_Manager::SELECT,
                'default' => '3',
                'options' => [
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                ],
            ]
        );


        $this->end_controls_section();


        $this->start_controls_section(
            'section_general_style',
            [
                'label' => __('General', 'lambor-elements'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );


        $this->add_control(
            'item_background_color',
            [
                'label' => __('Background Color', 'lambor-elements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sunio-product-list .item' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'item_border',
                'placeholder' => '1px',
                'selector' => '{{WRAPPER}} .rental_item',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'item_border_radius',
            [
                'label' => __('Border Radius', 'lambor-elements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .rental_item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_content_style',
            [
                'label' => __('Content', 'lambor-elements'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'category_heading',
            [
                'label' => __('Category', 'lambor-elements'),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'category_typography',
                'scheme' => Scheme_Typography::TYPOGRAPHY_4,
                'selector' => '{{WRAPPER}} .lambor_product_filter .lambor-tab ul li a',
                'fields_options' => [
                    'font_size' => [
                        'default' => [
                            'unit' => 'px',
                            'size' => '17',
                        ],
                    ],
                ],
            ]
        );

        $this->add_control(
            'product_title_heading',
            [
                'label' => __('Product Title', 'lambor-elements'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'product_title_typography',
                'scheme' => Scheme_Typography::TYPOGRAPHY_4,
                'selector' => '{{WRAPPER}} .lambor_product_filter .lambor-tab-content .content .content-heading-title h3.title a',
                'fields_options' => [
                    'font_size' => [
                        'default' => [
                            'unit' => 'px',
                            'size' => '18',
                        ],
                    ],
                    'font_weight' => [
                        'default' => 'bold',
                    ]
                ],
            ]
        );

        $this->add_control(
            'product_title_color',
            [
                'label' => esc_html__('Color', 'lambor-elements'),
                'type' => Controls_Manager::COLOR,
                'default' => '#212121',
                'selectors' => [
                    '{{WRAPPER}} .lambor_product_filter .lambor-tab-content .content .content-heading-title h3.title a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'product_title_hover_color',
            [
                'label' => esc_html__('Hover Color', 'lambor-elements'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ed8a19',
                'selectors' => [
                    '{{WRAPPER}} .lambor_product_filter .lambor-tab-content .content .content-heading-title h3.title a:hover' => 'color: {{VALUE}};',
                ],
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

        <div class="sunio-product-list columns-<?php echo  esc_attr($settings['columns']); ?>">
            <?php if ($products->have_posts()): while ($products->have_posts()): $products->the_post(); global $product;?>
            <?php
                $img = wp_get_attachment_image_src( get_post_thumbnail_id( $product->ID ), 'single-post-thumbnail')[0];
                if(!$img){
                    $img = wc_placeholder_img_src();
                }

                ?>


                <div class="item">
                    <div class="image">
                        <img src="<?php echo $img; ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
                    </div>
                    <h3 class="title">
                        <a href="<?php echo get_permalink(); ?>"><?php echo esc_html(get_the_title()); ?></a>
                    </h3>
                    <div class="price">
                        <?php echo $product->get_price_html(); ?>
                    </div>
                </div>

            <?php endwhile;
                wp_reset_postdata();endif; ?>
        </div>

        <?php
    }
}