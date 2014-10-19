<?php
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header( 'shop' ); 

global $theme_options;

$product_sidebar_position = $theme_options['product_sidebar_position'];

if(is_active_sidebar( 'shop-sidebar' ) && ($product_sidebar_position <> 'disable') ) {
	$span_class = 'col-md-9';
}
else {
	$span_class = 'col-md-12';
}

?>

	<?php
		/**
		 * woocommerce_before_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action( 'woocommerce_before_main_content' );
	?>

	<?php while ( have_posts() ) : the_post(); ?>
<div class="content-block">
<div class="container shop shop-product">
	<div class="row">
	<?php
		/**
		 * woocommerce_sidebar hook
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */
		if(is_active_sidebar( 'shop-sidebar' ) && ($product_sidebar_position == 'left') ) {
			do_action( 'woocommerce_sidebar' );
		}
		
	?>
	
	<div class="<?php echo $span_class; ?>">
	<div class="shop-content">
			<h1 class="page-title"><?php the_title(); ?></h1>
			<?php wc_get_template_part( 'content', 'single-product' ); ?>

		<?php endwhile; // end of the loop. ?>
	</div>
	</div>
	<?php
		/**
		 * woocommerce_sidebar hook
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */
		if(is_active_sidebar( 'shop-sidebar' ) && ($product_sidebar_position == 'right') ) {
			do_action( 'woocommerce_sidebar' );
		}
		
	?>
	</div></div></div>
	<?php
		/**
		 * woocommerce_after_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	?>
	
	
<?php get_footer( 'shop' ); ?>