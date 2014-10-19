<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $theme_options;

$shop_sidebar_position = $theme_options['shop_sidebar_position'];

if(is_active_sidebar( 'shop-sidebar' ) && ($shop_sidebar_position <> 'disable') ) {
	$span_class = 'col-md-9';
}
else {
	$span_class = 'col-md-12';
}

get_header( 'shop' ); ?>

	<?php
		/**
		 * woocommerce_before_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action( 'woocommerce_before_main_content' );
	?>

		<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>

	


		<?php endif; ?>

		<?php do_action( 'woocommerce_archive_description' ); ?>

		<?php if ( have_posts() ) : ?>
	<div class="content-block">
	<div class="container shop shop-archive">
	<div class="row">

	<?php
		/**
		 * woocommerce_sidebar hook
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */
		if(is_active_sidebar( 'shop-sidebar' ) && ($shop_sidebar_position == 'left') ) {
			do_action( 'woocommerce_sidebar' );
		}
		
	?>
	<div class="<?php echo $span_class; ?>">
	<div class="shop-content">
	<h1 class="page-title"><?php woocommerce_page_title(); ?></h1>
			<?php
				/**
				 * woocommerce_before_shop_loop hook
				 *
				 * @hooked woocommerce_result_count - 20
				 * @hooked woocommerce_catalog_ordering - 30
				 */
				do_action( 'woocommerce_before_shop_loop' );
			?>

			<?php woocommerce_product_loop_start(); ?>

				<?php woocommerce_product_subcategories(); ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php wc_get_template_part( 'content', 'product' ); ?>

				<?php endwhile; // end of the loop. ?>

			<?php woocommerce_product_loop_end(); ?>

			<?php
				/**
				 * woocommerce_after_shop_loop hook
				 *
				 * @hooked woocommerce_pagination - 10
				 */
				do_action( 'woocommerce_after_shop_loop' );
			?>
		
		<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

			<div class="container">
			<div class="row">
			<div class="col-md-12">
				<div class="page-item-title">
					<h1 class="page-title"><?php woocommerce_page_title(); ?></h1>
				</div>
			</div>
			<div class="col-md-12">
			<div class="shop shop-archive">
			
			<div class="shop-content">
			
			<?php wc_get_template( 'loop/no-products-found.php' ); ?>
			</div>
		
			</div>
			</div>
			</div>
			</div>
		<?php endif; ?>	
	</div>
	</div>
	<?php if ( have_posts() ):?>
	<?php
		/**
		 * woocommerce_sidebar hook
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */
		if(is_active_sidebar( 'shop-sidebar' ) && ($shop_sidebar_position == 'right')) {
			do_action( 'woocommerce_sidebar' );
		}
		
	?>
	<?php endif; ?>
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