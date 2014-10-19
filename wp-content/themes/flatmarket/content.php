<?php
/**
 * @package FlatMarket
 */
?>

<div class="content-block blog-post clearfix">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		
				
				<div class="post-content-wrapper">
					<div class="post-content">
						<h1 class="entry-title post-header-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
						<div class="post-info">
						<span><i class="fa fa-user"></i> <?php the_author();?></span> 
						<span><i class="fa fa-clock-o"></i><?php 
							$post_classes = get_post_class();

							if($post_classes[4] == 'format-chat') {
								_e("Chat on ", 'flatmarket');
							}
						?> <?php the_time(get_option( 'date_format' ));  ?></span>
						
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
							
							
							<?php edit_post_link( __( 'Edit', 'flatmarket' ), ' <span class="edit-link"><i class="fa fa-pencil-square-o"></i> ', '</span>' ); ?>
						</div>
						
							<?php 
							if ( has_post_thumbnail() ): // check if the post has a Post Thumbnail assigned to it.
							?>
							<div class="blog-post-thumb text-center">
							<a href="<?php the_permalink(); ?>" rel="bookmark">
							<?php the_post_thumbnail('blog-thumb'); ?>
							</a>
							</div>
							<?php endif; ?>
						
						
							<div class="entry-content">
								<?php the_content( __( 'Continue reading...', 'flatmarket' ) ); ?>
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
								<i class="fa fa-tags"></i> <?php printf( __( 'Tags: %1$s', 'flatmarket' ), $tags_list ); ?>
							</span>
							<?php endif; // End if $tags_list ?>

						
						</div>
		
				</div>
			
		
	</article>
</div>