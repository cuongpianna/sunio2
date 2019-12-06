<?php

$taxonomy = 'product_cat';
$orderby = 'name';
$show_count = 0;
$pad_counts = 0;
$hierarchical = 1;
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
?>


<div class="woo-sidebar-wrap">
    <div class="sidebar-title"><span class="icon fa fa-bars"></span>
        <h3>Danh mục sản phẩm</h3></div>

    <p class="sidebar-subtitle"><?php echo single_cat_title(); ?></p>

    <ul class="woo-sidebar">
        <?php foreach ($all_categories as $cat): ?>
            <?php if ($cat->category_parent == 0): $category_id = $cat->term_id; ?>
                <li><a href="<?php get_term_link($cat->slug, 'product_cat') ?>"> <?php echo $cat->name; ?> </a>
                    <?php
                    $args2 = array(
                        'taxonomy' => $taxonomy,
                        'child_of' => 0,
                        'parent' => $category_id,
                        'orderby' => $orderby,
                        'show_count' => $show_count,
                        'pad_counts' => $pad_counts,
                        'hierarchical' => $hierarchical,
                        'title_li' => $title,
                        'hide_empty' => $empty
                    );
                    $sub_cats = get_categories($args2);
                    if ($sub_cats): ?>
                        <ul class="sub_category">
                            <?php
                            foreach ($sub_cats as $sub_category): ?>
                                <li><a href="<?php get_term_link($sub_category->slug, 'product_cat') ?>"><?php echo $sub_category->name; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>



                </li>
            <?php endif; ?>
        <?php endforeach; ?>
    </ul>
</div>