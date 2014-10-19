<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package FlatMarket
 */

get_header(); ?>
<div class="content-block">
<div class="container">
	<div class="row">
		<div class="col-md-12">
		<div class="page-item-title">
			<h1><?php _e( 'Oops! That page can&rsquo;t be found.', 'flatmarket' ); ?></h1>
		</div>
			<div class="page-404">
			<h1><?php _e("<span>Error</span> 404", 'flatmarket'); ?></h1>
			<h2><?php _e("Page not found", 'flatmarket'); ?></h2>
			<p><?php _e("You can try from", 'flatmarket'); ?></p>
			<a class="btn" href="<?php echo get_site_url(); ?>"><?php _e("Home page", 'flatmarket'); ?></a>
			</div>
		</div>
	</div>
</div>
</div>
<?php get_footer(); ?>