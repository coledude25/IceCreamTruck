<?php
/**
 * The Template for displaying all single posts.
 *
 * @package FlatMarket
 */

get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

	<?php get_template_part( 'content', 'single' ); ?>

	<?php flatmarket_content_nav( 'nav-below' ); ?>
	


<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>