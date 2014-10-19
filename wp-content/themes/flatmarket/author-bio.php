<?php
/*
*	Posts Author info template
*/
?>
<div class="author-bio">
	<div class="container-fluid">
		<div class="row-fluid">
					<div class="author-image col-md-2">
						<?php echo get_avatar( get_the_author_meta('email'), '90' ); ?>
					</div>
					<div class="author-info col-md-10">
						<p class="author-title"><?php _e("Written by", 'flatmarket'); ?> <?php the_author_link(); ?></p>
						<p class="author-description"><?php the_author_meta('description'); ?></p>
					</div>

		</div>
	</div>
</div>