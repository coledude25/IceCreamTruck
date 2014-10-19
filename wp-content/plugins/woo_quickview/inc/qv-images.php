<?php global $post, $product, $woocommerce; ?>

<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>
<div id="<?php echo $this->slug.'_images_wrap'; ?>">
	<div id="<?php echo $this->slug.'_images'; ?>" class="royalSlider rsMinW">
	
		<?php
		
			$prodImgs = array();
			
			if ( has_post_thumbnail() ) {
				
				$imgId = get_post_thumbnail_id();
				
				$prodImgs[$imgId]['slideId'][] = '-0-';
				$prodImgs[$imgId]['imgSrc'] = wp_get_attachment_image_src(get_post_thumbnail_id(), apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ));
				$prodImgs[$imgId]['imgThumbSrc'] = wp_get_attachment_image_src(get_post_thumbnail_id(), 'thumbnail');
	
			} else {
				
				$prodImgs[$imgId]['slideId'][] = '-0-';
				$prodImgs[$imgId]['imgSrc'] = woocommerce_placeholder_img_src();
				$prodImgs[$imgId]['imgThumbSrc'] = woocommerce_placeholder_img_src();
	
			}
			
			// Additional Images
			
			$attachIds = $product->get_gallery_attachment_ids();
			$attachment_count = count( $attachIds );
			
			if(!empty($attachIds)):
				foreach($attachIds as $attachId):
					
					$prodImgs[$attachId]['slideId'][] = '-0-';
					$prodImgs[$attachId]['imgSrc'] = wp_get_attachment_image_src( $attachId, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ) );
					$prodImgs[$attachId]['imgThumbSrc'] = wp_get_attachment_image_src( $attachId, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ) );
					
				endforeach;
			endif;
			
			// !If is Varibale product
			
			if ( $product->product_type == 'variable' ) :
				$prodVars = $product->get_available_variations();
				if(!empty($prodVars)):
					foreach($prodVars as $prodVar):
					
						if(has_post_thumbnail($prodVar['variation_id'])):
							
							$varThumbId = get_post_thumbnail_id($prodVar['variation_id']);
							
							$prodImgs[$varThumbId]['slideId'][] = '-'.$prodVar['variation_id'].'-';
							$prodImgs[$varThumbId]['imgSrc'] = wp_get_attachment_image_src($varThumbId, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ));
							$prodImgs[$varThumbId]['imgThumbSrc'] = wp_get_attachment_image_src($varThumbId, 'thumbnail');
							
						endif;
						
					endforeach;
				endif;
			endif;
			
			if(!empty($prodImgs)):
				$i = 0; foreach($prodImgs as $imgId => $imgData):
					if($i == 0):
						echo '<img src="'.$imgData['imgSrc'][0].'" data-'.$this->slug.'="'.implode(' ', $imgData['slideId']).'" class="'.$this->slug.'_image" data-rsTmb="'.$imgData['imgThumbSrc'][0].'">';
					else:
						echo '<a href="'.$imgData['imgSrc'][0].'" data-'.$this->slug.'="'.implode(' ', $imgData['slideId']).'" class="'.$this->slug.'_image rsImg" data-rsTmb="'.$imgData['imgThumbSrc'][0].'"></a>';
					endif;
				$i++; endforeach;
			endif;
			
		?>
	
	</div>
</div>