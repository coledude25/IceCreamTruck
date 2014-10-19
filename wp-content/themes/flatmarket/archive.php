<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package FlatMarket
 */

get_header();

global $theme_options;

$archive_sidebarposition = $theme_options['archive_sidebar_position'];

if(is_active_sidebar( 'main-sidebar' ) && ($archive_sidebarposition <> 'disable') ) {
	$span_class = 'col-md-9';
}
else {
	$span_class = 'col-md-12';
}

?>


<div class="content-block">
<div class="container">
	<div class="row">
	<div class="col-md-12">
<div class="page-item-title">
	<h1>
      <?php
						if ( is_category() ) :
							printf( __( 'Category Archives: %s', 'flatmarket' ), '<span>' . single_cat_title( '', false ) . '</span>' );

						elseif ( is_tag() ) :
							printf( __( 'Tag Archives: %s', 'flatmarket' ), '<span>' . single_tag_title( '', false ) . '</span>' );

						elseif ( is_author() ) :
							/* Queue the first post, that way we know
							 * what author we're dealing with (if that is the case).
							*/
							the_post();
							printf( __( 'Author Archives: %s', 'flatmarket' ), '<span class="vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' );
							/* Since we called the_post() above, we need to
							 * rewind the loop back to the beginning that way
							 * we can run the loop properly, in full.
							 */
							rewind_posts();

						elseif ( is_day() ) :
							printf( __( 'Daily Archives: %s', 'flatmarket' ), '<span>' . get_the_date() . '</span>' );

						elseif ( is_month() ) :
							printf( __( 'Monthly Archives: %s', 'flatmarket' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );

						elseif ( is_year() ) :
							printf( __( 'Yearly Archives: %s', 'flatmarket' ), '<span>' . get_the_date( 'Y' ) . '</span>' );

						elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
							_e( 'Asides', 'flatmarket' );

						elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
							_e( 'Images', 'flatmarket');

						elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
							_e( 'Videos', 'flatmarket' );

						elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
							_e( 'Quotes', 'flatmarket' );

						elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
							_e( 'Links', 'flatmarket' );

						else :
							_e( 'Archives', 'flatmarket' );

						endif;
					?>
					</h1>
</div>
</div>
<?php if ( is_active_sidebar( 'main-sidebar' ) && ( $archive_sidebarposition == 'left')) : ?>
		<div class="col-md-3 main-sidebar sidebar">
		<ul id="main-sidebar">
		  <?php dynamic_sidebar( 'main-sidebar' ); ?>
		</ul>
		</div>
		<?php endif; ?>
		<div class="<?php echo $span_class; ?>">

<?php
	if ( is_category() ) :
		// show an optional category description
		$category_description = category_description();
		if ( ! empty( $category_description ) ) :
			echo '<div class="container">
<div class="row">
<div class="col-md-12">'.apply_filters( 'category_archive_meta', '<div class="taxonomy-description">' . $category_description . '</div>' ).'		</div>
</div>
</div>';
		endif;

	elseif ( is_tag() ) :
		// show an optional tag description
		$tag_description = tag_description();
		if ( ! empty( $tag_description ) ) :
			echo '<div class="container">
<div class="row">
<div class="col-md-12">'.apply_filters( 'tag_archive_meta', '<div class="taxonomy-description">' . $tag_description . '</div>' ).'		</div>
</div>
</div>';
		endif;

	endif;
?>
			<?php if ( have_posts() ) : ?>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php
						/* Include the Post-Format-specific template for the content.
						 * If you want to overload this in a child theme then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'content', get_post_format() );
					?>

				<?php endwhile; ?>

			<?php else : ?>

				<?php get_template_part( 'no-results', 'archive' ); ?>

			<?php endif; ?>
		</div>
		<?php if ( is_active_sidebar( 'main-sidebar' ) && ( $archive_sidebarposition == 'right')) : ?>
		<div class="col-md-3 main-sidebar sidebar">
		<ul id="main-sidebar">
		  <?php dynamic_sidebar( 'main-sidebar' ); ?>
		</ul>
		</div>
		<?php endif; ?>
	</div>
</div>
</div>
<?php get_footer(); ?>