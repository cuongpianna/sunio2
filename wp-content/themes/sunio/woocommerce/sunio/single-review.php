<?php
global $product;
$rating_count = $product->get_rating_count();
$review_count = $product->get_review_count();
$average      = $product->get_average_rating();
?>

<?php if($average): ?>

<?php echo wc_get_rating_html( $average, $rating_count ); ?>
<div style="margin-right: 5px">(<?php echo $review_count; ?>)</div>  | <div class="review-count"><?php echo $review_count; ?>  đánh giá của khách hàng</div> <?php endif;  ?> <iframe src="https://www.facebook.com/plugins/like.php?href=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&width=450&layout=standard&action=like&size=small&share=true&height=35&appId=630614873997544" width="450" height="35" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
