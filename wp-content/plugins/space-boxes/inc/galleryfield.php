<?php

class baSpaceBoxesGalleryMeta {

	public function __construct(){
		add_filter( 'attachment_fields_to_edit', array($this,'add_Link_field_to_media_uploader'), null, 2 );
		add_filter( 'attachment_fields_to_save', array($this,'add_Link_field_to_media_uploader_save'), null, 2 );
	}

	/**
	 	* Adding a "Link" field to the media uploader $form_fields array
	 	*
	 	* @param array $form_fields
	 	* @param object $post
	 	*
	 	* @return array
	*/
	public function add_Link_field_to_media_uploader( $form_fields, $post ) {
		$form_fields['link_field'] = array(
			'label' => __('Image Link'),
			'value' => get_post_meta( $post->ID, 'space_boxes_img_link', true ),
			'helps' => __('Space Boxes image link.','space-boxes')
		);

		return $form_fields;
	}


	/**
	 	* Save our new "Link" field
	 	*
	 	* @param object $post
	 	* @param object $attachment
	 	*
	 	* @return array
	*/
	public function add_Link_field_to_media_uploader_save( $post, $attachment ) {
		if ( ! empty( $attachment['link_field'] ) ) 
			update_post_meta( $post['ID'], 'space_boxes_img_link', $attachment['link_field'] );
		else
			delete_post_meta( $post['ID'], 'space_boxes_img_link' );

		return $post;
	}


	/**
	 	* Display our new "Link" field
	 	*
	 	* @param int $attachment_id
	 	*
	 	* @return array
	*/
	public function get_featured_image_Link( $attachment_id = null ) {
		$attachment_id = ( empty( $attachment_id ) ) ? get_post_thumbnail_id() : (int) $attachment_id;

		if ( $attachment_id )
			return get_post_meta( $attachment_id, 'space_boxes_img_link', true );

	}

}

new baSpaceBoxesGalleryMeta;