<?php
global $product;
$price = $product->get_regular_price();
$piece = get_post_meta($product->get_id(), 'product_unit', true)
?>

<span class="price-value">
 <?php if($price): echo wc_price($price); ?>
 <?php else:
     esc_html_e('Liên hệ', 'sunio');
 endif;
 ?>
</span>

<?php if($piece): ?>
<span class="unit">/<?php echo $piece; ?></span>
<?php endif; ?>


