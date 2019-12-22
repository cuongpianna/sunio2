<?php
global $product;
$rating_count = $product->get_rating_count();
$review_count = $product->get_review_count();
$average      = $product->get_average_rating();
?>

<?php if($average): ?>

<?php echo wc_get_rating_html( $average, $rating_count ); ?>
<div style="margin-right: 5px">(<?php echo $review_count; ?>)</div>  | <div class="review-count"><?php echo $review_count; ?>  customer reviews</div>

<?php endif;  ?>