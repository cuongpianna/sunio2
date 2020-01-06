<?php
global $product;
$price = $product->get_regular_price();
$min_order = get_post_meta($product->get_id(), 'min_order', true);
?>

<?php if($min_order): ?>
    <div class="min-order"><i class="fas fa-exclamation-circle"></i>  Số lượng cần mua tối thiểu là: <?php echo $min_order; ?></div>
<?php endif; ?>

