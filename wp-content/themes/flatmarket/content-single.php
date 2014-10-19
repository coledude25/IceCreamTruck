<?php
/**
 * @package FlatMarket
 */
global $theme_options;

$post_sidebarposition = get_post_meta( get_the_ID(), '_post_sidebarposition_value', true );
$post_socialshare_disable = get_post_meta( get_the_ID(), '_post_socialshare_disable_value', true );
$post_fullwidth  = get_post_meta( get_the_ID(), '_post_fullwidth_value', true );

if(!isset($post_sidebarposition)) {
	$post_sidebarposition = 0;
}

if($post_sidebarposition == "0") {
	$post_sidebarposition = $theme_options['post_sidebar_position'];
}

if($post_fullwidth) {

  $post_sidebarposition = 'disable';
  echo '<style>
.blog-post.blog-post-single .post-content,
.comments-area {
	padding: 15px;
}
.blog-post .post-info {
	text-align: center;
}
  </style>';
}


$post_bgcolor = get_post_meta( $post->ID, '_post_bgcolor_value', true );

$post_bgcolor_css = '';

if(isset($post_bgcolor)&&($post_bgcolor<>'')) {
  $post_bgcolor_css = 'background-color: '.$post_bgcolor;
}
else
{
  $post_bgcolor_css = '';
}

if(is_active_sidebar( 'main-sidebar' ) && ($post_sidebarposition <> 'disable') ) {
	$span_class = 'col-md-9';
}
else {
	$span_class = 'col-md-12';
}

?>

<div class="content-block">
<div class="container"<?php if($post_bgcolor_css<>'') { echo ' style="'.$post_bgcolor_css.'"'; }; ?>>
	<div class="row">
<?php if ( is_active_sidebar( 'main-sidebar' ) && ( $post_sidebarposition == 'left')) : ?>
		<div class="col-md-3 main-sidebar sidebar">
		<ul id="main-sidebar">
		  <?php dynamic_sidebar( 'main-sidebar' ); ?>
		</ul>
		</div>
		<?php endif; ?>
		<div class="<?php echo $span_class; ?>">
			<div class="blog-post blog-post-single">
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
							<div class="post-content-wrapper">
							<div class="page-item-title">
										<h1><?php the_title(); ?></h1>
									</div>
								<div class="post-content">
									
									<div class="post-info">
										<span><i class="fa fa-user"></i> <?php the_author();?></span> 
										<span><i class="fa fa-clock-o"></i><?php 
							$post_classes = get_post_class();

							if($post_classes[4] == 'format-chat') {
								_e("Chat on ", 'flatmarket');
							}
						?> <?php the_time(get_option( 'date_format' ));  ?> </span>
										<?php
												/* translators: used between list items, there is a space after the comma */
												$categories_list = get_the_category_list( __( ', ', 'flatmarket' ) );
												if ( $categories_list ) :
											?>
											
										 <span><i class="fa fa-folder"></i> <?php printf( __( '%1$s', 'flatmarket' ), $categories_list ); ?></span>
										
										<?php endif; // End if categories ?>
										<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
										 <span><i class="fa fa-comment"></i> <?php comments_popup_link( __( 'Leave a comment', 'flatmarket' ), __( '1 Comment', 'flatmarket' ), __( '% Comments', 'flatmarket' ) ); ?></span>
										<?php endif; ?>
										
										
										<?php edit_post_link( __( 'Edit', 'flatmarket' ), '<span class="edit-link"><i class="fa fa-pencil-square-o"></i> ', '</span>' ); ?>
									</div>
									
										<?php 
										if ( has_post_thumbnail() ): // check if the post has a Post Thumbnail assigned to it.
										?>
										<div class="blog-post-thumb text-center">
										
										<?php the_post_thumbnail(); ?>
										
										</div>
										<?php endif; ?>
									
									<?php if ( is_search() ) : // Only display Excerpts for Search ?>
										<div class="entry-summary">
											<?php the_excerpt(); ?>
										</div><!-- .entry-summary -->
										<?php else : ?>
										<div class="entry-content">
											<?php the_content( __( '<div class="read-more-link button alt">Continue reading...</div>', 'flatmarket' ) ); ?>
											<?php
												wp_link_pages( array(
													'before' => '<div class="page-links">' . __( 'Pages:', 'flatmarket' ),
													'after'  => '</div>',
												) );
											?>
										</div><!-- .entry-content -->
										 <?php
											/* translators: used between list items, there is a space after the comma */
											$tags_list = get_the_tag_list( '', __( ', ', 'flatmarket' ) );
											if ( $tags_list ) :
										?>
										
										<span class="tags">
											 <i class="fa fa-tags"></i>  <?php printf( __( 'Tags: %1$s', 'flatmarket' ), $tags_list ); ?>
										</span>
										<?php if(!isset($post_socialshare_disable) || !$post_socialshare_disable): ?>
											<div class="post-social"><?php _e("Share", 'flatmarket'); ?>:
											<a title="<?php _e("Share this", 'flatmarket'); ?>" href="#" class="facebook-share"> <i class="fa fa-facebook"></i> <span class="count">0</span></a>
											<a title="<?php _e("Tweet this", 'flatmarket'); ?>" href="#" class="twitter-share"> <i class="fa fa-twitter"></i> <span class="count">0</span></a>
											<a title="<?php _e("Pin this", 'flatmarket'); ?>" href="#" class="pinterest-share"> <i class="fa fa-pinterest"></i> <span class="count">0</span></a>
											</div>
										<?php endif; ?>
										<?php endif; // End if $tags_list ?>
										
										<?php endif; ?>
									</div>
					
							</div>
							
					
				</article>
				<?php if(isset($theme_options['enable_author_info'])&&($theme_options['enable_author_info'])): ?>
				<?php if ( is_single() && get_the_author_meta( 'description' ) ) : ?>
					<?php get_template_part( 'author-bio' ); ?>
				<?php endif; ?>
				<?php endif; ?>
			</div>
			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || '0' != get_comments_number() ) 
					
					comments_template();
			?>
		</div>
		<?php if ( is_active_sidebar( 'main-sidebar' ) && ( $post_sidebarposition == 'right')) : ?>
		<div class="col-md-3 main-sidebar sidebar">
		<ul id="main-sidebar">
		  <?php dynamic_sidebar( 'main-sidebar' ); ?>
		</ul>
		</div>
		<?php endif; ?>
	</div>
</div>
</div>
