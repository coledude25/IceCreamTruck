<?php
/**
 * Single Product Meta
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $product, $theme_options;

$cat_count = sizeof( get_the_terms( $post->ID, 'product_cat' ) );
$tag_count = sizeof( get_the_terms( $post->ID, 'product_tag' ) );
?>
<div class="product_meta">

	<?php do_action( 'woocommerce_product_meta_start' ); ?>

	<?php if(isset($theme_options['shop_social_buttons_enable']) && $theme_options['shop_social_buttons_enable']): ?>
	<div class="post-social">
	<?php _e( 'Share:', 'flatmarket' ); ?> <a title="<?php _e("Share this", 'flatmarket'); ?>" href="#" class="facebook-share"> <i class="fa fa-facebook"></i> <span class="count">0</span></a>
	<a title="<?php _e("Tweet this", 'flatmarket'); ?>" href="#" class="twitter-share"> <i class="fa fa-twitter"></i> <span class="count">0</span></a>
	<a title="<?php _e("Pin this", 'flatmarket'); ?>" href="#" class="pinterest-share"> <i class="fa fa-pinterest"></i> <span class="count">0</span></a>
	</div>
	<?php endif; ?>

	<?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>

		<span class="sku_wrapper"><?php _e( '<b>SKU:</b>', 'woocommerce' ); ?> <span class="sku" itemprop="sku"><?php echo ( $sku = $product->get_sku() ) ? $sku : __( 'N/A', 'woocommerce' ); ?></span></span>

	<?php endif; ?>

	<?php echo $product->get_categories( ', ', '<span class="posted_in">' . _n( '<b>Category:</b>', 'Categories:', $cat_count, 'woocommerce' ) . ' ', '.</span>' ); ?>

	<?php echo $product->get_tags( ', ', '<span class="tagged_as">' . _n( '<b>Tag:</b>', '<b>Tags:</b>', $tag_count, 'woocommerce' ) . ' ', '.</span>' ); ?>
	


	<?php do_action( 'woocommerce_product_meta_end' ); ?>
	
</div>

