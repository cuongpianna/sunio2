<?php

$current_cate = get_queried_object();
if(is_tax()){
    $current_cate_id = $current_cate->term_id;
}else{
    $current_cate_id =0 ;
}

$arg = array('hierarchical' => 1,
    'show_option_none' => '',
    'hide_empty' => 0,
    'parent' => $current_cate_id,
    'taxonomy' => 'product_cat');
$sub_current_cates = get_categories($arg);

$args = array(
    'taxonomy' => 'product_cat',
    'hierarchical' => 1,
    'title_li' => '',
    'hide_empty' => 0,
    'exclude' => $current_cate_id
);
$other_cates = get_categories($args);


$single_cate_args = array(
    'taxonomy' => 'product_cat',
    'hierarchical' => 1,
    'title_li' => '',
    'hide_empty' => 0,
);
$other_single_cates = get_categories($args);

?>


<?php if (is_shop() || is_tax()): ?>
    <div class="woo-sidebar-wrap">
        <div class="woo-sidebar-title">
            <span class="icon fa fa-bars"></span>
            <h3>Danh mục sản phẩm</h3>
        </div>

        <div class="woo-sidebar-body">
            <?php if(!is_shop()): ?>
            <p class="woo-sidebar-current-title">
                <?php echo single_cat_title(); ?>
            </p>
            <?php endif; ?>

            <?php if ($sub_current_cates): ?>
                <ul class="current-cat">
                    <?php foreach ($sub_current_cates as $value): ?>
                        <li>
                            <i class="fas fa-caret-right"></i>
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
                        <?php
                        $args2 = array(
                            'taxonomy' => 'product_cat',
                            'child_of' => 0,
                            'parent' => $category_id,
                            'hierarchical' => 1,
                            'title_li' => $title,
                            'hide_empty' => 0
                        );
                        $sub_cats = get_categories($args2);
                        if ($sub_cats) {
                            $class = 'has-sub';
                        }
                        ?>
                        <li <?php if ($sub_cats): ?> class="<?php esc_attr_e($class, 'sunio'); ?>" <?php endif; ?> >
                            <a href="<?php get_term_link($cat->slug, 'product_cat'); ?>">
                                <?php esc_html_e($cat->name, 'sunio'); ?>
                            </a>

                            <?php
                            if ($sub_cats):

                                echo '<i class="fas fa-angle-right"></i>';

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
    </div>
<?php else: ?>
    <div class="woo-sidebar-wrap">
        <div class="woo-sidebar-title">
            <span class="icon fa fa-bars"></span>
            <h3>Danh mục sản phẩm</h3>
        </div>

        <div class="woo-sidebar-body">

            <ul class="other-cat">
                <?php foreach ($other_cates as $cat): ?>
                    <?php if ($cat->category_parent == 0): $category_id = $cat->term_id; ?>
                        <?php
                        $args2 = array(
                            'taxonomy' => 'product_cat',
                            'child_of' => 0,
                            'parent' => $category_id,
                            'hierarchical' => 1,
                            'title_li' => $title,
                            'hide_empty' => 0
                        );
                        $sub_cats = get_categories($args2);
                        if ($sub_cats) {
                            $class = 'has-sub';
                        }
                        ?>
                        <li <?php if ($sub_cats): ?> class="<?php esc_attr_e($class, 'sunio'); ?>" <?php endif; ?> >
                            <a href="<?php get_term_link($cat->slug, 'product_cat'); ?>">
                                <?php esc_html_e($cat->name, 'sunio'); ?>
                            </a>

                            <?php
                            if ($sub_cats):

                                echo '<i class="fas fa-angle-right"></i>';

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

        <?php echo do_shortcode('[woocommerce_recently_viewed_products]'); ?>
    </div>
<?php endif; ?>
