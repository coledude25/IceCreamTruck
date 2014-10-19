<?php
/**
 * Sidebar
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>
<div class="col-md-3 main-sidebar sidebar">
	<ul id="shop-sidebar">
	          <?php dynamic_sidebar( 'shop-sidebar' ); ?>
	</ul>
</div>