<?php
/**
* create custom meta boxes for project meta
*
* @since version 1.0
* @param null
* @return custom meta boxes
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

add_filter( 'cmb_meta_boxes', 'ba_spaceboxes_meta' );
function ba_spaceboxes_meta( array $meta_boxes ) {

	$opts = array(
		array(
			'id'             => 'spacebox_setup_directions',
			'name'           => __('Instructions', 'space-boxes'),
			'type'           => 'title',
			'cols'			=> 12,
			'desc'			=> __('Create a Wordpress gallery, and insert it into the post. If you insert 3 images, you\'ll have 3 boxes. Use the Title, Alt, and Caption fields for each image. This will show the title, caption, and image alt. If you do not input a title, or caption, then they will not show.<br/><br/>You can then show this Space Box set with <code>[spaceboxes id=""]</code>. The ID is the ID of this post. Look up in the browser bar; it\'s the number that follows <code>?post=</code>.','space-boxes')
		),
		array(
			'id'             => 'spacebox_setup_directions',
			'name'           => __('Archive Options', 'space-boxes'),
			'type'           => 'title',
			'cols'			=> 12,
			'desc'			=> __('You have the option to showcase all of your Space Box sets with the shortcode <code>[spaceboxes_archive category=""]</code>. The category attribute is optional, and allows you to only show Space Box sets from an specific Space Box category.<br/><br/>Each Space Box set in the archive is represented by the Featured Image (on your right), and Space Box set title. You can then use the link below, to tell this Space Box where to link to from the Space Box Archives. In other words, what page is this specific Space Box set on? Put that link below.','space-boxes')
		),
		array(
			'id'             => 'ba_spacebox_single_link',
			'name'           => __('Space Box Link', 'space-boxes'),
			'type'           => 'text',
			'cols'			=> 8,
		),
		array(
		    'id'   			=> 'spacebox_help',
		    'type' 			=> 'title',
		    'name' 			=> __(' ', 'space-boxes'),
		    'cols'			=> 4,
			'desc'    		=> __('<span class="ba-help-icon">?</span>This only applies if you are using the Spacebox Archive Shortcode, and you\'d like to provide a link to the page that the [spacebox] shortcode is on.','space-boxes')
		)

	);

	$meta_boxes[] = array(
		'title' => __('Space Boxes', 'space-boxes'),
		'pages' => array('spaceboxes'),
		'fields' => $opts
	);

	return $meta_boxes;

}

