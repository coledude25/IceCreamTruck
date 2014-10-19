<?php
function change_values_in_array(&$item, $key)
{
   $item = "'".$item."'";
}

function get_ids_of_all_attachments_callback()
{
      global $wpdb;
      $extract_all_urls = explode(':::::', $_POST['all_links']);
      $extract_all_urls = array_unique(array_filter($extract_all_urls));
      $copy_of_extract_all_urls = $extract_all_urls;
      $the_single_url = join("' , '", $extract_all_urls);
      $get_new_urls = array();
      $query_to_be_run = "SELECT ID, guid from $wpdb->posts WHERE guid IN ( '{$the_single_url}')";
      $postids = $wpdb->get_results($query_to_be_run);
      if ($postids)
      {
         foreach ($postids as $single_post_id)
         {
            $image_attributes = wp_get_attachment_image_src( $single_post_id->ID, 'shop_single');
            $get_new_urls[] = $image_attributes[0] . '|||||' . $single_post_id->guid;
         }
      }
      echo join(':::::', $get_new_urls);
      die(); // this is required to return a proper result
}

 function enqueuezoomscript()
{
   global $woocommerce_settings;
    if(!is_admin())
    {
	 global $post;
	 $original_image_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ) , 'shop_thumbnail');
	 $orginal_image_src_for_zoom = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ) , 'full');
	 $original_image_single_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ) , 'shop_single');
	 wp_register_script( 'original_zoom', plugins_url('/js/jquery.zoom_.js', __FILE__), array('jquery'), false, true );
	 wp_enqueue_script('original_zoom');
	 wp_register_script( 'bxsliderjs', plugins_url('/js/jquery.bxSlider_2.js', __FILE__), array('jquery'), false, true );
	 wp_enqueue_script('bxsliderjs');
	 wp_register_script( 'enqueuezoomjs', plugins_url('/js/swap_images.js', __FILE__), array('jquery'), false, true );
	 wp_enqueue_script('enqueuezoomjs');
	 wp_register_style( 'bxslidercss', plugins_url('/css/jquery.bxslider.css', __FILE__) );
	 wp_enqueue_style('bxslidercss');
	 $array_to_be_sent = array('sourceimageurl' => $original_image_src[0] , 'previous_image' => plugins_url('/images/prev.png', __FILE__), 'next_image' => plugins_url('/images/next.png', __FILE__), 'thumbnail_image_height' => get_option('woocommerce_thumbnail_image_height'), 'thumbnail_image_width' => get_option('woocommerce_thumbnail_image_width'), 'single_image_width' => get_option('woocommerce_single_image_width') , 'single_image_height' => get_option('woocommerce_single_image_height'), 'admin_ajax_url' => admin_url('admin-ajax.php'), 'sourceimageurlforzoom' => $orginal_image_src_for_zoom[0], 'sourceimagesinglesrc' => $original_image_single_src[0], 'zoomleveloption' => get_option('woocommerce_zoom_option'));
	 wp_localize_script( 'enqueuezoomjs', 'wdm_zwoom_object', $array_to_be_sent );
    }
}


function wisdm_add_new_setting($tab)
{
   $count_of_available_setting = array_search(array(
		'name' => __( 'Single Product Image', 'woocommerce' ),
		'desc' 		=> __('This is the size used by the main image on the product page.', 'woocommerce'),
		'id' 		=> 'woocommerce_single_image',
		'css' 		=> '',
		'type' 		=> 'image_width',
		'std' 		=> '300',
		'desc_tip'	=>  true,
	), $tab);
   
   $object = array(
                     'name' => __( 'Zoom Level', 'woocommerce' ), 
                     'type' => 'text',
                     'desc' => __('Set the on hover zoom level for Single Product Image. Default value is 2. If value inserted is non numeric, it will consider the default value. To disable zooming, set this value to 1'),
                     'id' => 'woocommerce_zoom_option',
                     'std' => '2',
                     'css' => 'width:30px;',
                     'desc_tip'=>  true
               );
   $tab = array_merge( array_slice($tab, 0, ((int)$count_of_available_setting + 1)), array($object) ,array_slice($tab, ((int)$count_of_available_setting + 1)));
   return $tab;
}


function wisdm_add_new_submenu_page ()
{
   add_options_page( 'ZWoom Settings', 'ZWoom', 'activate_plugins', 'zoom-extension-plugin', 'zoom_extension_plugin_options_page');
}

if ((isset($_GET['page']) && $_GET['page'] == 'zoom-extension-plugin'))
{
        add_action('admin_print_scripts', 'wdm_zoom_extension_scripts');
        add_action('admin_print_styles', 'wdm_zoom_extension_styles');
}

function wdm_zoom_extension_styles()
{
   wp_register_style('tip-tip-style' , plugins_url("/css/tipTip.css" , __FILE__));
   wp_enqueue_style('tip-tip-style');
}

function wdm_zoom_extension_scripts()
{
   wp_enqueue_script('jquery');
   wp_register_script('tip-tip-script' , plugins_url("/js/jquery.tipTip.js" , __FILE__), array('jquery'));
   wp_enqueue_script('tip-tip-script');
}

function wp_mail_content_type_function()
{
	return "text/html";
}

function zoom_extension_plugin_options_page()
{
   /*** Showing Settins Saved Message ***/
   if ($_POST && $_POST['submit_zoom_level_option'] == 'Submit' && !empty($_POST['zoom_level_option']) && (filter_var($_POST['zoom_level_option'], FILTER_VALIDATE_INT) !== FALSE))
   {
      update_option('woocommerce_zoom_option', $_POST['zoom_level_option']);
      $wdm_plugin_slug = 'zwoom-woocommerce-product-image-zoom-extension-by-wisdmlabs';
   ?>
      <div class="wdm_appeal_text" style="background-color:#FFE698;padding:10px;margin-right:10px;">
	 <p style="font-weight:bold">Settings Saved.</p>
	    <strong>An Appeal:</strong>
	    We strive hard to bring you useful, high quality plugins for FREE and to provide prompt responses to all your support queries.
	    If you are happy with our work, please consider making a good faith donation, here -
	    <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=info%40wisdmlabs%2ecom&lc=US&item_name=WisdmLabs%20Plugin%20Donation&no_note=0&currency_code=USD&bn=PP%2dDonationsBF%3abtn_donateCC_LG%2egif%3aNonHostedGuest" target="_blank"> Donate now</a> 
	    and do post an encouraging review, here - <a href="http://wordpress.org/support/view/plugin-reviews/<?php echo $wdm_plugin_slug; ?>" target="_blank"> Review this plugin</a>.
	</div>
   
   <?php
   }
   elseif($_POST && $_POST['submit_zoom_level_option'] == 'Submit' && empty($_POST['zoom_level_option']))
   {?>
      <div class="error"><p style="font-weight:bold">Empty value can not be saved. Setting Zoom level to default value.</p></div>
   <?php
   }
   elseif($_POST && $_POST['submit_zoom_level_option'] == 'Submit' && filter_var($_POST['zoom_level_option'], FILTER_VALIDATE_INT) === FALSE)
   {?>
      <div class="error"><p style="font-weight:bold">Error while saving settings. Filter value must be an integer.</p></div>
   <?php
   } ?>
   <script type="text/javascript">
      jQuery(window).ready(function()
      {
	 jQuery(".inside").height(jQuery("#wisdm_main_content").height());
         jQuery(".tiptobeshown").tipTip();
      }); //end ready
   </script>
   <style type="text/css">
      .error, .updated {
	 margin-left: 0 !important;
      }
   </style>
   <div class="wrap">
      <div id="poststuff" class="metabox-holder">
	 <div class="postbox">
	    <h3 class="hndle" style="cursor: default">ZWoom Settings Page</h3>
	    <div class="inside">
	       <div id="left-side" style="float: left; margin-top: 17px;">
		     <form action="" method="POST">
			<label for="edit-zoom-level">
			   Zoom Level <img src="<?php echo plugins_url("/images/help.png" , __FILE__)?>" class="tiptobeshown" title="Set the 'on hover' zoom level for Single Product Image. Default value is 2. If value inserted is non numeric, it will consider the default value. To disable zooming, set this value to 1" style="width: 11px; height: 11px;"/>:
			</label>
			<input id="edit-zoom-level" name="zoom_level_option" type="text" value="<?php echo get_option('	woocommerce_zoom_option', '2')?>">
			<input type="submit" class="button" name="submit_zoom_level_option" value="Submit" onclick="var numberregex = /\D/i; if(document.getElementById('edit-zoom-level').value.match(numberregex)) {alert(document.getElementById('edit-zoom-level').value + ' is not a valid number. Please enter only natural number in Zoom Level field'); return false} if(document.getElementById('edit-zoom-level').value == '') {alert('Zoom Level field can not be left empty. Please fill value in this field'); return false}"/>
		     </form>
		  </div> <!-- #left-side ends here -->
		  <div id="right-side">
		     <?php
			$plugin_name = 'ZWoom - WooCommerce Product Image Zoom';
			$wdm_plugin_slug = 'zwoom-woocommerce-product-image-zoom-extension-by-wisdmlabs';
			include_once('wisdm_sidebar/wisdm_sidebar.php');
			pwe_create_wisdm_sidebar($plugin_name, $wdm_plugin_slug);
		     ?>
		  </div> <!-- #right-side ends here -->
	       </div> <!-- .inside ends here -->
	    </div> <!-- .postbox ends here -->
	 </div> <!-- #poststuff ends here -->
   </div> <!-- .wrap ends here -->
<?php
}

function wisdm_zoom_plugin_action_links($links, $file) {
    static $this_plugin;
    if (!$this_plugin) {
        $this_plugin = 'zwoom-woocommerce-product-image-zoom-extension-by-wisdmlabs/woocommerce-zoom-extension.php';
    }
    if ($file == $this_plugin) {
        $settings_link = '<a href="' . get_bloginfo('wpurl') . '/wp-admin/options-general.php?page=zoom-extension-plugin">Settings</a>';
        array_unshift($links, $settings_link);
    }
    return $links;
}
?>
