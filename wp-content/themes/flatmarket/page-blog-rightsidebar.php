<?php
/*
Template Name: Blog (Right sidebar)
*/

get_header(); 

$blog_sidebarposition = "right";

if(is_active_sidebar( 'main-sidebar' ) && ($blog_sidebarposition <> 'disable') ) {
	$span_class = 'col-md-9';
}
else {
	$span_class = 'col-md-12';
}
$temp = $wp_query;
$wp_query = null;

$wp_query = new WP_Query(array(
  'post_type' => 'post',
  'orderby'=> 'menu_order'
));
?>
<div class="content-block">
<div class="container">
	<div class="row">
		<?php if ( is_active_sidebar( 'main-sidebar' ) && ( $blog_sidebarposition == 'left')) : ?>
		<div class="col-md-3 main-sidebar sidebar">
		<ul id="main-sidebar">
		  <?php dynamic_sidebar( 'main-sidebar' ); ?>
		</ul>
		</div>
		<?php endif; ?>
		<div class="<?php echo $span_class; ?>">
		<div class="page-item-title">
			<h1><?php the_title(); ?></h1>
		</div>
		<?php if ( have_posts() ) : ?>

			<?php /* Start the Loop */ ?>
			<?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>

				<?php
					/* Include the Post-Format-specific template for the content.
					 * If you want to overload this in a child theme then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'content', get_post_format() );
				?>
			
			<?php endwhile; ?>
			
			
			<?php flatmarket_content_nav( 'nav-below' ); ?>
			
		<?php else : ?>

			<?php get_template_part( 'no-results', 'index' ); ?>

		<?php endif; ?>
		</div>
		<?php if ( is_active_sidebar( 'main-sidebar' ) && ( $blog_sidebarposition == 'right')) : ?>
		<div class="col-md-3 main-sidebar sidebar">
		<ul id="main-sidebar">
		  <?php dynamic_sidebar( 'main-sidebar' ); ?>
		</ul>
		</div>
		<?php endif; ?>
	</div>
</div>
</div>
<?php $wp_query = null; $wp_query = $temp;?>
<?php get_footer(); ?>