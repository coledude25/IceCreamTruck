<?php
/**
 * Loop Price
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product;
?>
<span class="price">
<?php if ( $price_html = $product->get_price_html() ) : ?>
	<?php echo $price_html; ?>
<?php endif; ?>
</span>