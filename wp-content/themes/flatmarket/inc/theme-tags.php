<?php
/**
 * Custom template tags for this theme.
 * @package FlatMarket
 */

if ( ! function_exists( 'flatmarket_content_nav' ) ) :
/**
 * Display navigation to next/previous pages when applicable
 */
function flatmarket_content_nav( $nav_id ) {
	global $wp_query, $post;

	// Don't print empty markup on single pages if there's nowhere to navigate.
	if ( is_single() ) {
		$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
		$next = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous )
			return;
	}

	// Don't print empty markup in archives if there's only one page.
	if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) )
		return;

	$nav_class = ( is_single() ) ? 'navigation-post navigation-paging' : 'navigation-paging';

	?>
	<nav role="navigation" id="<?php echo esc_attr( $nav_id ); ?>" class="<?php echo $nav_class; ?>">
	
	<?php if ( is_single() ) : // navigation links for single posts ?>
	<div class="container">
	<div class="row">
		<div class="col-md-2">
		<?php previous_post_link( '<div class="nav-previous">%link</div>', '<span class="meta-nav">' . _x( '', 'Previous post link', 'flatmarket' ) . '</span>' ); ?>
		</div>
		<div class="col-md-8 nav-text"><?php _e("Posts navigation", 'flatmarket'); ?></div>
		<div class="col-md-2">
		<?php next_post_link( '<div class="nav-next">%link</div>', '<span class="meta-nav">' . _x( '', 'Next post link', 'flatmarket' ) . '</span>' ); ?>
		</div>
	</div>
	</div>
	<?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages ?>

		<div class="row"><div class="nav-previous col-md-2">
		<?php if ( get_next_posts_link() ) : ?>
		<?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'flatmarket' ) ); ?>
		<?php endif; ?>
		</div>
		<div class="col-md-8 nav-text"><?php _e("Posts navigation", 'flatmarket'); ?></div>
		<div class="nav-next col-md-2">
		<?php if ( get_previous_posts_link() ) : ?>
		<?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'flatmarket' ) ); ?>
		<?php endif; ?>
		</div>
		</div>

	<?php endif; ?>

	</nav><!-- #<?php echo esc_html( $nav_id ); ?> -->
	<?php
}
endif; // flatmarket_content_nav

if ( ! function_exists( 'flatmarket_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 */
function flatmarket_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;

	if ( 'pingback' == $comment->comment_type || 'trackback' == $comment->comment_type ) : ?>

	<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
		<div class="comment-body">
			<?php _e( 'Pingback:', 'flatmarket' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( 'Edit', 'flatmarket' ), '<span class="edit-link">', '</span>' ); ?>
		</div>

	<?php else : ?>

	<li id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?>>
		<article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
			
			<div class="comment-meta clearfix">
				<div class="reply">
					<?php edit_comment_link( __( 'Edit', 'flatmarket' ), '', '' ); ?>
					<?php comment_reply_link( array_merge( $args, array( 'add_below' => 'div-comment', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
				</div><!-- .reply -->
				<div class="comment-author vcard">
					
					<?php if ( 0 != $args['avatar_size'] ) echo get_avatar( $comment, 60 ); ?>

				</div><!-- .comment-author -->

				<div class="comment-metadata">
					<?php printf( __( '%s <span class="says">says: </span>', 'flatmarket' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
					
					<div class="date"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><time datetime="<?php comment_time( 'c' ); ?>"><?php printf( _x( '%1$s at %2$s', '1: date, 2: time', 'flatmarket' ), get_comment_date(), get_comment_time() ); ?></time></a></div>

					<?php if ( '0' == $comment->comment_approved ) : ?>
					<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'flatmarket' ); ?></p>
					<?php endif; ?>
					<div class="comment-content">
						<?php comment_text(); ?>
					</div>
				</div><!-- .comment-metadata -->

				
			</div><!-- .comment-meta -->

			

			
		</article><!-- .comment-body -->

	<?php
	endif;
}
endif; // ends check for flatmarket_comment()

if ( ! function_exists( 'flatmarket_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function flatmarket_posted_on() {
	
	printf( __( 'Posted on <a href="'.get_day_link(get_post_time('Y'), get_post_time('m'), get_post_time('j')).'" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a><span class="byline"> by <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>', 'flatmarket' ),
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'flatmarket' ), get_the_author() ) ),
		get_the_author()
	);
}
endif;
