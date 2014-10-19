<?php
/**
* return the space boxes. far out.
*
* @since version 1.0
* @param null
* @param null
* @return space boxes
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

class ba_SpaceBoxes_SC {

	const version = '1.0';

	function __construct() {

		add_action ('init', array($this,'register_scripts'));
		add_action('wp_enqueue_scripts', array($this,'do_jquery'));
        add_shortcode ('spaceboxes', array($this,'space_boxes_sc'));
		add_shortcode ('spaceboxes_archive', array($this,'space_box_archive_sc'));
	}

	function register_scripts(){

		wp_register_style('spaceboxes-style', plugins_url( '../css/spaceboxes.css', __FILE__ ), self::version );

		// swipebox
		wp_register_script('spaceboxes-lb',   plugins_url( '../libs/swipebox/jquery.swipebox.min.js', __FILE__ ), array('jquery'), self::version, true);

		// wookmark
		wp_register_script('spaceboxes-wook', plugins_url( '../libs/wookmark/jquery.wookmark.min.js', __FILE__ ), array('jquery'), self::version, true);
	}

	function do_jquery(){
		wp_enqueue_script('jquery');
	}

	function space_boxes_sc($atts,$content = null){

		// shortcode defaults
		$defaults = array(
			'id'			=> '',
			'columns'		=> 4,
			'itemcolumns'	=> 3,
			'lightbox' 		=> 'off', // available atts include | on
			'size'			=> 'spacebox-small', // available atts iclude | spacebox-small-nocrop, spacebox-medium, spacebox-medium-nocrop
			'layout'		=> 'stacked', //available atts include | pinterest
			'pinwidth' 		=> 300, // width of pinterest item | 300 or '50%' or '33.333%'
			'pinspace' 		=> 5, // margin in between pins
		);

		$atts 	  = shortcode_atts($defaults, $atts);

		// get the post via ID so we can access data and print it within an array to fetch
		$post = get_post($atts['id'], ARRAY_A);

		// Get the gallery shortcode out of the post content, and parse the ID's in teh gallery shortcode
		$shortcode_args = shortcode_parse_atts($this->get_match('/\[gallery\s(.*)\]/isU', $post['post_content']));

		// set gallery shortcode image id's
		$ids = $shortcode_args["ids"];

		// setup some args so we can pull only images from this content
		$args = array(
            'include'        => $ids,
            'post_status'    => 'inherit',
            'post_type'      => 'attachment',
            'post_mime_type' => 'image',
            'order'          => 'menu_order ID',
            'orderby'        => 'post__in', //required to order results based on order specified the "include" param
        );

		// fetch the image id's that the user has within the gallery shortcode
		$images = get_posts($args);

		// setup vars
		$hash 		= rand();
		$opts 		= get_option('ba_spacebox_settings');
		$lb_txt 	= isset($opts['lb_txt']) ? $opts['lb_txt'] : false;
		$lb_bg 		= isset($opts['lb_bg']) ? $opts['lb_bg'] : false;
		$accent 	= isset($opts['accent_color']) ? $opts['accent_color'] : false;
		$txtcolor 	= isset($opts['text_color']) ? $opts['text_color'] : false;

		// load lightbox stuffs on demand
		if ('on' == $atts['lightbox']){

			wp_enqueue_script('jquery');
			wp_enqueue_script('spaceboxes-lb');

			?>
			<!-- Space Boxes - Scripts -->
			<script>
				jQuery(document).ready(function(){
					jQuery('.space-boxes.space-boxes-<?php echo $hash;?> .swipebox').swipebox();
				});
			</script>

		<?php }

		if ($lb_txt || $lb_bg || $accent || $txtcolor): 
			?>
			<!-- Space Boxes - Styles -->
			<style>
				body #swipebox-action,
				body #swipebox-caption,
				body #swipebox-overlay { background: <?php echo $lb_bg;?>;border:none;}
				body #swipebox-caption { color: <?php echo $lb_txt;?> !important;border:none;text-shadow:none;}
				body .space-boxes .spacebox .swipebox:before {
					background:<?php echo $accent;?>;
				}
				body .space-boxes .spacebox {
					color:<?php echo $txtcolor;?>;
				}
			</style>
		<?php endif;

		// load styles & scripts
		wp_enqueue_style('spaceboxes-style');

		// load wookmark if pinterest layout is chosen
		if ( 'pinterest' == $atts['layout']):

			wp_enqueue_script('jquery');
			wp_enqueue_script('spaceboxes-wook');

			?>
			<script>
				jQuery(document).ready(function(){
				    jQuery('.space-boxes.space-boxes-<?php echo $hash;?>').imagesLoaded(function() {
				        var options = {
				          	autoResize: true,
				          	container: jQuery('.space-boxes.space-boxes-<?php echo $hash;?>'),
				          	offset: <?php echo $atts['pinspace'];?>,
				          	flexibleWidth: <?php echo $atts['pinwidth'];?>
				        };
				        var handler = jQuery('.space-boxes.space-boxes-<?php echo $hash;?> figure');
				        jQuery(handler).wookmark(options);
				    });
				});
			</script><?php
		endif;

		$out = '';

		// action
		$out .= sprintf('%s', do_action('spacebox_before'));

		// print the shortcode
		$out .= sprintf('<section class="clearfix space-boxes space-boxes-%s">',$hash);

			// load pinterest view if pinterest is chosen
			if ( 'pinterest' == $atts['layout']):

				foreach($images as $image):

					$getimage 		= wp_get_attachment_image($image->ID, $atts['size'], false, array('class' => 'spacebox-box-image'));
					$getimgsrc 		= wp_get_attachment_image_src($image->ID,'large');
					$img_title 	  	= $image->post_title;
					$link 			= get_post_meta($image->ID,'space_boxes_img_link', true);


					if ($link) {

						$image 		= sprintf('<a class="spacebox-outbound-link" href="%s">%s</a>',$link, $getimage);

					} else {

						if ('on' == $atts['lightbox']) {
							$image 		= sprintf('<a class="swipebox" href="%s" title="%s">%s</a>',$getimgsrc[0],$img_title,$getimage);
						} else {
							$image 		= wp_get_attachment_image($image->ID, $atts['size'], false, array('class' => 'spacebox-box-image'));
						}
					}

	               	$out 			.= sprintf('<figure class="spacebox">%s</figure>',$image);

	            endforeach;

	        // else load the info view
			else:

				$index = 0;

				// action
				$out .= sprintf('%s', do_action('spacebox_inside_top'));

				$out .= sprintf('<div class="ba-row">');

					foreach($images as $image):

						$index++;
						$count = count($images);

						$img_title 	  	= $image->post_title;
						$get_caption 	= $image->post_excerpt;
						$get_desc  		= $image->post_content;
						$getimage 		= wp_get_attachment_image($image->ID, $atts['size'], false, array('class' => 'spacebox-box-image'));
						$getimgsrc 		= wp_get_attachment_image_src($image->ID,'large');
						$link 			= get_post_meta($image->ID,'space_boxes_img_link', true);

						if ($link) {

							$image 		= sprintf('<a class="spacebox-outbound-link" href="%s">%s</a>',$link, $getimage);

						} else {

							if ('on' == $atts['lightbox']) {

								$image 		= sprintf('<a class="swipebox" href="%s" title="%s">%s</a>',$getimgsrc[0],$img_title,$getimage);

							} else {

								$image 		= wp_get_attachment_image($image->ID, $atts['size'], false, array('class' => 'spacebox-box-image'));
							}
						}

			            $title 			= $img_title ? sprintf('<h3 itemprop="title" class="spacebox-box-title">%s</h3>',$img_title) : false;
			            $caption 		= $get_caption ? sprintf('<figcaption class="spacebox-box-caption">%s</figcaption>',$get_caption) : false;

		               	$out 			.= sprintf('<figure class="spacebox col-sm-%s">%s%s%s</figure>',$atts['itemcolumns'],$image,$title,$caption);

		               	if ( ( 0 == $index % $atts['columns'] ) && ( $index < $count )) {

							$out .= sprintf('</div><div class="ba-row">');
						}

		            endforeach;

				$out .= sprintf('</div>');

				// action
				$out .= sprintf('%s', do_action('spacebox_inside_bottom'));

			endif;

        $out .= sprintf('</section>');

        // action
		$out .= sprintf('%s', do_action('spacebox_after'));

		return apply_filters('space_boxes_output',$out);

	}

	function space_box_archive_sc($atts,$content = null){
		
		wp_enqueue_script('jquery');
		// shortcode defaults
		$defaults = array(
			'category'		=> '',
			'columns'		=> 4,
			'itemcolumns'	=> 3,
		);

		$atts 	  = shortcode_atts($defaults, $atts);

		if ($atts['category']){
			$args = array(
				'post_type' => 'spaceboxes',
				'posts_per_page' => 100,
				'tax_query' => array(
					array(
						'taxonomy' => 'spacebox-categories',
						'field' => 'name',
						'terms' => array($atts['category'])
					)
				)
			);
    	} else {
			$args = array(
				'post_type' => 'spaceboxes',
				'posts_per_page' => 100,

			);
		}

		$q = new wp_query($args);

		$count = $q->post_count;

		$out = '';

		        // action
		$out .= sprintf('%s', do_action('spacebox_archive_before'));

		$out .= sprintf('<section class="space-boxes space-boxes-archive">');

			$index = 0;


		        // action
			$out .= sprintf('%s', do_action('spacebox_archive_inside_top'));

			$out .= sprintf('<div class="ba-row">');

				if ($q->have_posts()) : while($q->have_posts()) : $q->the_post();

					$index++;

					$title = sprintf('<h3 itemprop="title" class="spacebox-box-title">%s</h3>', get_the_title());
					$image = sprintf('%s', get_the_post_thumbnail(get_the_ID(), 'spacebox-small', false, array('class' => 'spacebox-box-image')));
					$link = get_post_meta(get_the_ID(),'ba_spacebox_single_link', true) ? get_post_meta(get_the_ID(),'ba_spacebox_single_link', true) : false;

					$out .= sprintf('<div class="spacebox col-sm-%s"><a class="spacebox-link" href="%s">%s%s</a></div>',$atts['itemcolumns'],$link,$image, $title);

					if ( ( 0 == $index % $atts['columns'] ) && ( $index < $count ) ) {
						$out .= sprintf('</div><div class="ba-row">');
					}

				endwhile;endif; wp_reset_query();

			$out .= sprintf('</div>');

		    // action
			$out .= sprintf('%s', do_action('spacebox_archive_inside_bottom'));

		$out .= sprintf('</section>');

		// action
		$out .= sprintf('%s', do_action('spacebox_archive_after'));

		return apply_filters('space_boxes_archive_output',$out);

	}

   	function get_match( $regex, $content ) {
        preg_match($regex, $content, $matches);
        return $matches[1];
    }
}
new ba_SpaceBoxes_SC;