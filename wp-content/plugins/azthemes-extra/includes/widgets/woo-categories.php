<?php
/**
 * Woo Product Categories widget.
 *
 * @package sunio WordPress theme
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'sunio_Extra_Woo_Categories_Widget' ) ) {
    class sunio_Extra_Woo_Categories_Widget extends WP_Widget {

        /**
         * Register widget with WordPress.
         *
         * @since 1.0.0
         */
        public function __construct() {
            parent::__construct(
                'sunio_woo_categories',
                esc_html__( '&raquo; Sunio Product Categories', 'sunio-extra' ),
                array(
                    'classname'   => 'woo-categories-widget product-cat-widget',
                    'description' => esc_html__( 'Show product categories.', 'sunio-extra' ),
                    'customize_selective_refresh' => true,
                )
            );
        }

        /**
         * Front-end display of widget.
         *
         * @see WP_Widget::widget()
         * @since 1.0.0
         *
         * @param array $args     Widget arguments.
         * @param array $instance Saved values from database.
         */
        public function widget( $args, $instance ) {

            $current_cate = get_queried_object();
            $current_cate_id = $current_cate->term_id;

            $arg = array('hierarchical' => 1,
                'show_option_none' => '',
                'hide_empty' => 0,
                'parent' => $current_cate_id,
                'taxonomy' => 'product_cat');
            $sub_current_cates = get_categories($arg);

            $other_cate_args = array(
                'hierarchical' => 1,
                'show_option_none' => '',
                'hide_empty' => 0,
                'taxonomy' => 'product_cat',
                'exclude' => $current_cate_id
            );

            $other_cates = get_categories($other_cate_args);

            $args = array(
                'taxonomy' => 'product_cat',
                'hierarchical' => 1,
                'title_li' => '',
                'hide_empty' => 0,
                'exclude' => $current_cate_id
            );
            $other_cates = get_categories($args);

            // Before widget WP hook
            echo $args['before_widget']; ?>

            <div class="woo-sidebar-wrap">
                <div class="woo-sidebar-title">
                    <span class="icon fa fa-bars"></span>
                    <h3>Danh mục sản phẩm</h3>
                </div>

                <p class="woo-sidebar-current-title">
                    <?php echo single_cat_title(); ?>
                </p>

                <?php if ($sub_current_cates): ?>
                    <ul class="current-cat">
                        <?php foreach ($sub_current_cates as $value): ?>
                            <li>
                                <i class="fas fa-angle-right"></i>
                                <a href="<?php esc_url(get_term_link($value->slug, 'product_cat')); ?>">
                                    <?php esc_html_e($value->name, 'sunio'); ?>
                                </a>
                            </li>
                        <?php endforeach;
                        wp_reset_postdata(); ?>
                    </ul>
                <?php endif; ?>

                <ul class="other-cat">
                    <?php foreach ($other_cates as $cat): ?>
                        <?php if ($cat->category_parent == 0): $category_id = $cat->term_id; ?>
                            <li>
                                <a href="<?php get_term_link($cat->slug, 'product_cat'); ?>">
                                    <?php esc_html_e($cat->name, 'sunio'); ?>
                                </a>

                                <?php
                                $args2 = array(
                                    'taxonomy' => 'product_cat',
                                    'child_of' => 0,
                                    'parent' => $category_id,
                                    'hierarchical' => 1,
                                    'hide_empty' => 0
                                );
                                $sub_cats = get_categories($args2);
                                if ($sub_cats):
                                    ?>
                                    <ul class="other-cat-sub">
                                        <?php foreach ($sub_cats as $sub_category): ?>
                                            <li>
                                                <a href="<?php get_term_link($sub_category->slug, 'product_cat'); ?>">
                                                    <?php esc_html_e($sub_category->name, 'sunio'); ?>
                                                </a>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>
                            </li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            </div>

            <?php // After widget WP hook
            echo $args['after_widget'];

        }

        /**
         * Sanitize widget form values as they are saved.
         *
         * @see WP_Widget::update()
         * @since 1.0.0
         *
         * @param array $new_instance Values just sent to be saved.
         * @param array $old_instance Previously saved values from database.
         *
         * @return array Updated safe values to be saved.
         */
        public function update( $new_instance, $old_instance ) {
            $instance                      = $old_instance;
            return $instance;
        }

        /**
         * Back-end widget form.
         *
         * @see WP_Widget::form()
         * @since 1.0.0
         *
         * @param array $instance Previously saved values from database.
         */
        public function form( $instance ) {

            // Parse arguments
            $instance = wp_parse_args((array) $instance, array(
                'title'             => esc_attr__( 'Sunio Product Categories', 'sunio-extra' ),
            ) ); ?>

            <?php

        }

    }
}
register_widget( 'sunio_Extra_Woo_Categories_Widget' );