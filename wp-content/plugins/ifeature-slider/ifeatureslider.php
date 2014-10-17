<?php
/*
Plugin Name: iFeature Slider Free
Plugin URI: 
Version: 1.0
Description: A Wordpress slider built with a great User Experience and Design in mind. This plugin provides a beautiful, simple, and easy to use slider. 
Author: CyberChimps inc.
Auther URI: http://cyberchimps.com/
License: Copyright by CyberChimps inc. You are free to use this plugin on any WordPress blog.
*/
if ( ! class_exists( 'IfeatureSlider' ) ) {
	class IfeatureSlider {

		private $shortcode = 'if_slider',
			$title = 'iFeature Slider',
			$slug = 'ifeatureslider',
			$meta_imgs = '_if_slider_imgs',
			$meta_options = '_if_options',
			$_slider = false,
			$slider_count = 0,
			$slider_array = array(),
			$plugin_url, $post_id, $s_options;

		public function __construct() {
			$this->plugin_url = plugins_url( '/', __FILE__ );

			// check slider for free version
			$this->if_slider_check();
			add_action( 'init', array( $this, 'create_post_types' ) );
			add_action( 'init', array( $this, 'mce_shortcode_button' ) );

			//add_action( 'admin_menu', array( $this, 'add_admin_menu'));
			add_shortcode( $this->shortcode, array( $this, 'plugin_shortcode' ) );

			// Add slider metaboxes
			add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
			// Custom columns
			add_action( 'manage_if_slider_posts_custom_column', array( $this, 'custom_column' ), 10, 2 );
			add_filter( 'manage_edit-if_slider_columns', array( $this, 'slideshow_columns' ) );
			add_filter( 'bulk_actions-edit-if_slider', array( $this, 'custom_bulk_actions' ) );

			add_action( 'admin_enqueue_scripts', array( $this, 'register_admin_scripts' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'slider_styles' ), 90 );
			add_action( 'wp_enqueue_scripts', array( $this, 'slider_scripts' ), 91 );

			add_action( 'admin_head-post.php', array( $this, 'hide_publishing_actions' ) );
			add_action( 'admin_head-post-new.php', array( $this, 'hide_publishing_actions' ) );

			add_action( 'wp_ajax_if_slider_load', array( $this, 'if_slider_load' ) );
			add_action( 'admin_notices', array( $this, 'if_slider_admin_notice' ) );

			$this->update_slider_post();
		}

		public function register_admin_scripts( $page ) {
			global $post_type;
			if ( $post_type === $this->shortcode && ( 'post.php' === $page || 'post-new.php' === $page ) ) {
				wp_enqueue_style( 'bootstrap-responsive', $this->plugin_url . 'css/bootstrap.css' );
				wp_enqueue_style( 'cyberchimps-responsive', $this->plugin_url . 'css/cyberchimps-responsive.min.css' );
				wp_enqueue_style( 'plugin_option_styles', $this->plugin_url . 'css/options-style.css' );
			}

			wp_enqueue_media();
			wp_enqueue_style( 'if-slider-admin-styles', $this->plugin_url . 'css/admin.css', array(), 1 );
			wp_register_script( 'if-slider-admin-script', $this->plugin_url . 'js/admin.js', array( 'jquery' ), 1 );
			wp_dequeue_script( 'autosave' );
			wp_enqueue_script( 'jquery-ui-sortable' );
			wp_enqueue_script( 'if-slider-admin-script' );
		}

		public function slider_scripts() {
			wp_enqueue_script( 'jquery' );
			wp_enqueue_script( 'if-script', $this->plugin_url . 'js/if-slider.js', array(), '1.0.0', true );
		}

		public function slider_styles() {
			wp_enqueue_style( 'if-style', $this->plugin_url . 'css/if-slider.css' );
		}

		public function custom_bulk_actions( $actions ) {
			unset( $actions['edit'] );

			//unset( $actions[ 'trash' ] );
			return $actions;
		}

		public function hide_publishing_actions() {
			global $post;
			if ( $post->post_type == $this->shortcode ) {

				echo '<style type="text/css">';
				if ( $this->_slider ) {
					echo ' #post-body';
				} else {
					echo ' #misc-publishing-actions,#minor-publishing-actions';
				}
				echo '{
                            display:none;
                        }';
				echo '</style>';
			}
		}

		/**
		 * @desc add shortcode for slider
		 */
		public function plugin_shortcode( $atts = array() ) {
			$id            = (int) $atts['id'];
			$this->post_id = $id;
			$slides        = $this->get_slides( $id );
			$slide_count   = count( $slides );
			if ( ! $slides ) {
				echo 'Invalid slider id';
			} else {
				$mrtop           = 20;
				$this->s_options = $this->get_options();
				if ( isset( $this->s_options['s_auto'] ) ) {
					$auto = 'auto';
				} else {
					$auto = '';
				}
				$this->slider_count ++;
				$si = $this->slider_count;

				$idd      = 'ifeatureslider-' . $si;
				$opts     = $this->s_options;
				$delay    = (float) $opts['s_delay'] * 1000;
				$duration = (float) $opts['t_time'] * 1000;
				if ( $delay < $duration ) {
					$delay = $duration;
				}
				$autot = isset( $opts['s_auto'] ) ? 'true' : 'false';
				if ( $autot === 'true' ) {
					$auto = 'auto';
				} else {
					$auto = '';
				}
				$this->slider_array[] = array(
					'id'       => $idd,
					'duration' => $duration,
					'delay'    => $delay,
					'auto'     => $autot,
					'count'    => $slide_count
				);

				ob_start();
				include 'ifeature-front-slider.php';
				$content = ob_get_contents();
				ob_end_clean();
				add_action( 'wp_footer', array( $this, 'front_end_script' ), 50 );

				return $content;
			}
		}

		public function mce_shortcode_button() {
			add_filter( "mce_external_plugins", array( $this, "if_add_buttons" ) );
			add_filter( 'mce_buttons', array( $this, 'if_register_buttons' ) );
		}

		function if_add_buttons( $plugin_array ) {
			$plugin_array['mce_if_slider'] = $this->plugin_url . 'js/mce_btn.js';

			return $plugin_array;
		}

		function if_register_buttons( $buttons ) {
			array_push( $buttons, 'if_slider' );

			return $buttons;
		}

		public function front_end_script() {
			?>
			<script>
				jQuery(window).resize(function (e) {
					iFeatureSlider_Resize();
				});

				function iFeatureSlider_Resize() {
					var _ifwrapper = _ifslider.find('div'),
						_ww = _ifwrapper.width(),
						_ul = _ifwrapper.find('ul'),
						_li = _ifwrapper.find('li'),
						len = _li.length;
					_fw = _ww * len;
					_ul.css('width', _fw + 'px');
					_li.css({width: _ww + 'px', display: 'block'});

				}

				var _ifslider = jQuery('.ifeatureslider');
				iFeatureSlider_Resize();
				<?php foreach( $this->slider_array as $options ){ ?>
				jQuery('#<?php echo $options['id']; ?>').iFeatureSlider({
					duration:<?php echo $options['duration']; ?>,
					delay:<?php echo $options['delay']; ?>,
					auto:<?php echo $options['auto']; ?>,
					imgs:<?php echo $options['count']; ?>
				});
				<?php } ?>
			</script>
		<?php
		}

		public function update_slider_post() {
			global $post_type;
			$post_type = isset( $_POST['post_type'] ) ? $_POST['post_type'] : $post_type;
			if ( $post_type !== $this->shortcode ) {
				return false;
			} else {
				$this->if_slider_check();
			}

			if ( ! isset( $_POST['if_slider_imgs'] ) ) {
				return false;
			}
			if ( isset( $_POST['save'] ) || isset( $_POST['publish'] ) ) {
				if ( $this->_slider ) {
					return false;
				}

				$imgs = $_POST['if_slider_imgs'];
				if ( ! $imgs ) {
					return false;
				}
				foreach ( $imgs as $img ) {
					if ( ! $img ) {
						continue;
					}
					$array[] = $img;
				}
				if ( count( $array ) > 2 ) {
					$array = array( $array[0], $array[1] );
				}
				update_post_meta( $_POST['post_ID'], $this->meta_imgs, $array );
				update_post_meta( $_POST['post_ID'], $this->meta_options, $_POST['if_slider_options'] );
			}
		}

		public function get_options() {
			$opts = get_post_meta( $this->post_id, $this->meta_options );

			return isset( $opts[0] ) ? $opts[0] : array();
		}

		public function get_slides( $id, $size = '' ) {
			$meta       = get_post_meta( $id, $this->meta_imgs );
			$data       = isset( $meta[0] ) ? $meta[0] : '';
			$upload_dir = wp_upload_dir();
			$path       = $upload_dir['baseurl'] . '/';
			if ( ! $data ) {
				return false;
			}

			if ( $size ) {
				foreach ( $data as $i => $dt ) {
					$img[ $i ]['img'] = wp_get_attachment_link( $dt, $size );
					$img[ $i ]['id']  = $dt;
				}
			} else {
				foreach ( $data as $i => $dt ) {
					$meta = wp_get_attachment_metadata( $dt );
					if ( $size ) {
						$arr = $meta['sizes'][ $size ];
					} else {
						$arr = $meta;
					}

					$img[ $i ]['img']    = $path . $arr['file'];
					$img[ $i ]['id']     = $dt;
					$img[ $i ]['width']  = $arr['width'];
					$img[ $i ]['height'] = $arr['height'];
					$img[ $i ]['title']  = $meta['image_meta']['title'];
				}
			}

			return $img;
		}

		/**
		 * @desc create new post type
		 */
		public function create_post_types() {
			register_post_type( 'if_slider',
			                    array(
				                    'labels'              => array(
					                    'name'               => __( $this->title, 'if_slider' ),
					                    'singular_name'      => __( 'Slider', 'if_slider' ),
					                    'add_new'            => __( 'Add Slider', 'if_slider' ),
					                    'add_new_item'       => __( 'Add New Slider', 'if_slider' ),
					                    'edit_item'          => __( 'Edit Slider', 'if_slider' ),
					                    'new_item'           => __( 'New Slider', 'if_slider' ),
					                    'view_item'          => __( 'View Slider', 'if_slider' ),
					                    'search_items'       => __( 'Search Sliders', 'if_slider' ),
					                    'not_found'          => __( 'No Slider found', 'if_slider' ),
					                    'not_found_in_trash' => __( 'No slider found in Trash', 'if_slider' )
				                    ),
				                    'supports'            => array( 'title' ),
				                    'public'              => false,
				                    'exclude_from_search' => true,
				                    'show_ui'             => true,
				                    'menu_position'       => 24,
				                    'can_export'          => false // Exclude from export
			                    )
			);
		}

		// Modify columns
		public function slideshow_columns( $columns ) {
			$columns              = array();
			$columns['title']     = __( 'Name', 'if_slider' );
			$columns['slides']    = __( 'Slides', 'if_slider' );
			$columns['id']        = __( 'ID', 'if_slider' );
			$columns['shortcode'] = __( 'Shortcode', 'if_slider' );

			return $columns;
		}

		// Add content to custom columns
		public function custom_column( $column_name, $post_id ) {
			if ( $column_name == 'slides' ) {
				$da = get_post_meta( $post_id, '_if_slider_imgs' );
				if ( $da ) {
					$val = count( $da[0] );
				} else {
					$val = 0;
				}
				echo '<div style="text-align:center; max-width:40px;">' . $val . '</div>';
			}
			if ( $column_name == 'id' ) {
				$post = get_post( $post_id );
				echo $post->post_name;
			}
			if ( $column_name == 'shortcode' ) {
				$post = get_post( $post_id );
				echo '[if_slider id="' . $post->ID . '"]';
			}
		}

		public function add_meta_boxes() {
			add_meta_box(
				'if_slider-slides-metabox',
				__( 'Slides <small>( Drag slide to rearrange )</small>', 'if_slider' ),
				array( $this, 'render_slides_meta_box' ),
				'if_slider',
				'normal',
				'high'
			);

			add_meta_box(
				'if_slider-options-metabox',
				__( 'Options', 'if_slider' ),
				array( $this, 'render_options_meta_box' ),
				'if_slider',
				'side',
				'high'
			);

			add_meta_box(
				'if_slider-shortcode-metabox',
				__( 'Shortcode', 'if_slider' ),
				array( $this, 'render_shortcode_meta_box' ),
				'if_slider',
				'side',
				'high'
			);

		}

		public function render_shortcode_meta_box( $post ) {
			?>
			<div class="cc-main-content">
				<input type="text" value="[<?php echo $this->shortcode . ' id=&quot;' . $post->ID . '&quot;'; ?>]" name="shortcode"/>
			</div>
		<?php
		}

		public function render_options_meta_box( $post ) {
			$this->post_id = $post->ID;
			$opts          = $this->get_options();

			$d = isset( $opts['s_delay'] ) ? $opts['s_delay'] : 3;
			$t = isset( $opts['t_time'] ) ? $opts['t_time'] : 1;
			$c = isset( $opts['s_auto'] ) ? 'checked="checked"' : '';
			if ( empty( $opts ) ) {
				$c = 'checked="checked"';
			}
			?>
			<div class="cc-main-content">
				<p>
					<label>Slider Delay
						<small>(sec)</small>
					</label>
					<input type="text" value="<?php echo $d; ?>" name="if_slider_options[s_delay]"/>
				</p>
				<p>
					<label>Transition Time
						<small>(sec)</small>
					</label>
					<input type="text" value="<?php echo $t; ?>" name="if_slider_options[t_time]"/>
				</p>
				<p class="check-container">
					<input id="if_slider_s_auto" class="checkbox-toggle" <?php echo $c; ?> name="if_slider_options[s_auto]" type="checkbox" value="yes">
					<label style="float:left;" class="in-label">Auto Slide</label>
					<label class="toggle" for="if_slider_s_auto">&nbsp;</label>
				</p>
			</div>
		<?php
		}

		public function render_slides_meta_box( $post ) {
			$slides = $this->get_slides( $post->ID, 'medium' );
			echo '<ul class="cc-parent cc-content-section if-sortables ui-sortable" data-post-id="' . $post->ID . '">';
			$cs = 2;
			if ( is_array( $slides ) and count( $slides ) > 0 ) {
				foreach ( $slides as $i => $slide ) {
					-- $cs;
					?>
					<li class="cc-has-children  section-group if-slide" data-slide-type="image">
						<a class="if-header" href="#"><strong class="if-title"> Slide [<?php echo $slide['id']; ?>] </strong>
							<span class="if-controls"> <span class="if-delete" title="Delete"> Delete </span> </span>

							<div class="clear"></div>
						</a>

						<div class="if-body">
							<div class="if-slide-image">
								<div class="if-image-preview">
									<div class="if-image-thumb">
										<?php echo $slide['img']; ?>
									</div>
									<input class="if-image-id" name="if_slider_imgs[]" value="<?php echo $slide['id']; ?>" type="hidden">
									<input class="button-primary btn if-media-gallery-show" value="Change Image" type="submit">
								</div>
								<div class="clear"></div>
							</div>
						</div>
					</li>
				<?php
				}
			}
			if ( $cs ) {
				for ( $j = 0; $j < $cs; $j ++ ) {
					$this->admin_footer();
				}
			}
			echo '</ul>';
			?>
		<?php

		}

		public function admin_footer() {
			?>
			<li class="cc-has-children  section-group if-slide" data-slide-type="image">
				<a class="if-header" href="#"><strong class="if-title"> New Slide </strong>
					<span class="if-controls"> <span class="if-delete" title="Delete"> Delete </span> </span>

					<div class="clear"></div>
				</a>

				<div class="if-body">
					<div class="if-slide-image">
						<div class="if-image-preview">
							<div class="if-image-thumb" style="display:none"></div>
							<input class="if-image-id" name="if_slider_imgs[]" value="<" type="hidden">
							<input class="button-primary btn if-media-gallery-show" value="Get Image" type="submit">
						</div>
						<div class="clear"></div>
					</div>
				</div>
			</li>
		<?php
		}

		public function if_slider_load() {
			$query      = new WP_Query( array( 'post_type' => 'if_slider' ) );
			$sliders    = $query->posts;
			$slider_arr = array();
			foreach ( $sliders as $slide ) {
				$slider_arr[ $slide->ID ] = $slide->post_title;
			}
			header( 'Content-type: application/json' );
			echo json_encode( $slider_arr );
			die;

		}

		// check if sliders are more than one
		public function if_slider_check() {
			if ( ! isset( $_GET['post_type'] ) || $_GET['post_type'] !== $this->shortcode ) {
				return false;
			}
			$slider = get_posts( array(
				                     'posts_per_page' => 1,
				                     'post_type'      => 'if_slider',
				                     'meta_query'     => array(
					                     array(
						                     'key' => $this->meta_imgs
					                     )
				                     )
			                     ) );

			if ( $slider && count( $slider ) > 0 ) {
				$this->_slider = true;
			}
		}

		// display admin notice if slider is more than one
		public function if_slider_admin_notice() {
			if ( $this->_slider ) {
				?>
				<div class="error"><p><?php _e( 'You are using the free version of the iFeature Slider Plugin. Buy <a href="http://cyberchimps.com/store/ifeature-slider/" target="_blank">Ifeature Slider Pro</a> to make unlimited sliders

.' ); ?></p>
				</div>
			<?php
			}
		}

	}

	$ifeature_slider = new IfeatureSlider;

	function iFeatureSlider( $id ) {
		global $ifeature_slider;
		$ifeature_slider->plugin_shortcode( array( 'id' => $id ) );
	}

}