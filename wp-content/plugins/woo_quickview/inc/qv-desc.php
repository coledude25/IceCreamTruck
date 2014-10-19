<?php global $post, $product, $woocommerce; ?>

<div id="<?php echo $this->slug; ?>_desc">
	<?php if($theSettings['popup_content_showdesc'] == 'full'){
		echo apply_filters( 'the_content', $post->post_content );
	} else {
		echo apply_filters( 'woocommerce_short_description', $post->post_excerpt );
	} ?>
</div>