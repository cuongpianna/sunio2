<?php
/**
 * Outputs correct library layout
 *
 * @package sunio WordPress theme
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
} ?>

<article class="single-library-article clr">

	<div class="entry clr"<?php sunio_schema_markup( 'entry_content' ); ?>>
		<?php the_content(); ?>
	</div>

</article>