<?php
global $product;
$price = $product->get_regular_price();
?>

<span class="price-heading">
  <?php esc_html_e('Price:', 'sunio'); ?>
</span>
<span class="price-value">
 <?php if($price): esc_html_e($price, 'sunio'); ?>
 <?php else:
     esc_html_e('Liên hệ', 'sunio');
 endif;
 ?>
</span>




