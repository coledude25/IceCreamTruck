<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package FlatMarket
 */
?>
<?php 
global $theme_options;
?>
<?php if ( is_active_sidebar( 'footer-sidebar' ) ) : ?>
<div class="footer-sidebar sidebar container">
  <ul id="footer-sidebar">
    <?php dynamic_sidebar( 'footer-sidebar' ); ?>
  </ul>
</div>
<?php endif; ?>

<div class="container-fluid">
<div class="row">
<div class="footer-sidebar-2-wrapper">
<div class="footer-sidebar-2 sidebar container footer-container">
<?php if ( is_active_sidebar( 'footer-sidebar-2' ) ) : ?>
  <ul id="footer-sidebar-2" class="clearfix">
    <?php dynamic_sidebar( 'footer-sidebar-2' ); ?>
  </ul>
<?php endif; ?>
      
      <div class="line"></div>
      <div class="footer-social">
               <span>
            <?php

            $social_services_arr = Array("facebook", "vk","twitter", "google-plus", "linkedin", "dribbble", "instagram", "tumblr", "pinterest", "vimeo-square", "youtube", "skype");

            foreach( $social_services_arr as $ss_data ){
              if(isset($theme_options[$ss_data]) && (trim($theme_options[$ss_data])) <> '') {
                $social_service_url = $theme_options[$ss_data];
                $social_service = $ss_data;
                echo '<a href="'.$social_service_url.'" target="_blank" class="a-'.$social_service.'"><i class="fa fa-'.$social_service.'"></i></a>';
              }
            }

            ?>
              </span>
      </div>
    
</div>
      
</div>


<footer>
<div class="container">
<div class="row">
    <div class="col-md-6 copyright">
    <?php echo $theme_options['footer_copyright_editor']; ?>
    </div>
    <div class="col-md-6">
         <div class="payment-icons">
          <?php
          if(isset($theme_options['footer_payment_icons'])) {
            foreach( $theme_options['footer_payment_icons'] as $footer_payment_icon ){

              echo '<img src="'.get_stylesheet_directory_uri().'/img/payment/'.$footer_payment_icon.'.png" alt="'.$footer_payment_icon.'"/>';
            }
          }

          ?>
          </div>
    </div>
</div>
</div>
<a id="top-link" href="#top"></a>
</footer>
</div>
</div>
<?php wp_footer(); ?>

</body>
</html>