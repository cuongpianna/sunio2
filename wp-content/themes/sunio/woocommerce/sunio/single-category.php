<?php
global $product, $post;
?>

<span class="categories"><?php esc_html_e('Categories:', 'sunio'); ?></span>

<?php echo wp_kses_post( wc_get_product_category_list( $product->get_id(), ', ', '<span class="category-tein">', '</span>' ) );?>
