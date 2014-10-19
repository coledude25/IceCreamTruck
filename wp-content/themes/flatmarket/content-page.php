<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package FlatMarket
 */

global $theme_options;
?>

<?php
  $page_fullwidth = get_post_meta( $post->ID, '_page_fullwidth_value', true );
  $page_sidebarposition = get_post_meta( $post->ID, '_page_sidebarposition_value', true );
  $page_notdisplaytitle = get_post_meta( $post->ID, '_page_notdisplaytitle_value', true );

  if(!isset($page_sidebarposition)) {
    $page_sidebarposition = 0;
  }

  if($page_sidebarposition == "0") {
    $page_sidebarposition = $theme_options['page_sidebar_position'];
  }

  if($page_fullwidth) {
      $containerclass = 'container';
  }
  else {
      $containerclass = 'container';
  }

  $page_class = get_post_meta( $post->ID, '_page_class_value', true );
  $page_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');

  $page_bgcolor = get_post_meta( $post->ID, '_page_bgcolor_value', true );

  $page_bgcolor_css = '';

  if(isset($page_bgcolor)&&($page_bgcolor<>'')) {
      $page_bgcolor_css = 'background-color: '.$page_bgcolor;
  }
  else
  {
      $page_bgcolor_css = '';
  }
  
  $parallax = '';

  if(is_array($page_image) && isset($page_image[0])) { 

      $parallax = 'parallax ';

      if($page_bgcolor_css <> '')
      {
          $page_bgcolor_css .= ';background-image: url('.$page_image[0].')'; 
      }
      else
      {
          $page_bgcolor_css = 'background-image: url('.$page_image[0].')'; 
      }
      
  }

  if(is_active_sidebar( 'main-sidebar' ) && ($page_sidebarposition <> 'disable') ) {
    $span_class = 'col-md-9';
  }
  else {
    $span_class = 'col-md-12';
  }
?>
<div class="<?php echo $parallax; ?>content-block <?php echo $page_class; ?>">
  <div class="<?php echo $containerclass; ?>" <?php if($page_bgcolor_css<>'') { echo 'style="'.$page_bgcolor_css.'"'; }; ?>>
    <div class="row">
    <div class="col-md-12">
<?php if(!$page_notdisplaytitle): ?>
      <div class="page-item-title">
        <h1><?php the_title(); ?></h1>
      </div>
      <?php endif; ?>
    </div>
      <?php if ( is_active_sidebar( 'main-sidebar' ) && ( $page_sidebarposition == 'left')) : ?>
      <div class="col-md-3 main-sidebar sidebar">
        <ul id="main-sidebar">
          <?php dynamic_sidebar( 'main-sidebar' ); ?>
        </ul>
      </div>
      <?php endif; ?>
			<div class="<?php echo $span_class;?> entry-content">
      
      <article>
				<?php the_content(); ?>
      </article>
      <?php
      // If comments are open or we have at least one comment, load up the comment template
      if ( comments_open() || '0' != get_comments_number() )
          comments_template();
      ?>
			</div>
      <?php if ( is_active_sidebar( 'main-sidebar' ) && ( $page_sidebarposition == 'right')) : ?>
      <div class="col-md-3 main-sidebar sidebar">
        <ul id="main-sidebar">
          <?php dynamic_sidebar( 'main-sidebar' ); ?>
        </ul>
      </div>
      <?php endif; ?>
    </div>
    <?php edit_post_link( __( 'Edit', 'flatmarket' ), '<span class="edit-link">', '</span>' ); ?>
  </div>
</div>