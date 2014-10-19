<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to flatmarket_comment() which is
 * located in the inc/template-tags.php file.
 *
 * @package FlatMarket
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() )
	return;
?>

	<div id="comments" class="comments-area">

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
				printf( _nx( '1 comment', '%1$s comments', get_comments_number(), 'flatmarket' ),
				number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
			?>
		</h2>

		<ul class="comment-list">
			<?php
				/* Loop through and list the comments. Tell wp_list_comments()
				 * to use flatmarket_comment() to format the comments.
				 * If you want to overload this in a child theme then you can
				 * define flatmarket_comment() and that will be used instead.
				 * See flatmarket_comment() in inc/template-tags.php for more.
				 */
				wp_list_comments( array( 'callback' => 'flatmarket_comment' ) );
			?>
		</ul><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="nav-below" class="navigation-paging" role="navigation">
			<div class="container-fluid">
				<div class="row-fluid">
					<div class="nav-previous col-md-2">
					<?php previous_comments_link( __( 'Older Comments', 'flatmarket' ) ); ?>
					</div>
					<div class="col-md-8 nav-text"><?php _e("Comments navigation", 'flatmarket'); ?></div>
					<div class="nav-next col-md-2">
					<?php next_comments_link( __( 'Newer Comments', 'flatmarket' ) ); ?>
					</div>
				</div>
			</div>
		</nav>
	
		<?php endif; // check for comment navigation ?>

	<?php endif; // have_comments() ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php _e( 'Comments are closed.', 'flatmarket' ); ?></p>
	<?php endif; ?>

	<?php comment_form(array('comment_notes_after' => '')); ?>

</div><!-- #comments -->
