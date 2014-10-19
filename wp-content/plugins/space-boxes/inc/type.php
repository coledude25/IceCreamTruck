<?php
/**
* Registers the custom post type
*
* @since version 1.0
* @param null
* @return custom post type
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

class ba_SpaceBoxes_type {

	function __construct() {

        $this->dir  = plugin_dir_path( __FILE__ );
        $this->url  = plugins_url( '', __FILE__ );

       	add_action('init',array($this,'do_type'));
       	add_action( 'init', array($this,'do_taxo'), 0 );

	}

	function do_type() {

		$labels = array(
			'name'                		=> _x( 'Space Boxes', 'Post Type General Name', 'space-boxes' ),
			'singular_name'       		=> _x( 'Space Box', 'Post Type Singular Name', 'space-boxes' ),
			'menu_name'           		=> __( 'Space Boxes', 'space-boxes' ),
			'parent_item_colon'   		=> __( 'Parent Space Box:', 'space-boxes' ),
			'all_items'           		=> __( 'All Space Boxes', 'space-boxes' ),
			'view_item'           		=> __( 'View Space Box', 'space-boxes' ),
			'add_new_item'        		=> __( 'Add New Space Box', 'space-boxes' ),
			'add_new'             		=> __( 'New Space Box', 'space-boxes' ),
			'edit_item'           		=> __( 'Edit Space Box', 'space-boxes' ),
			'update_item'         		=> __( 'Update Space Box', 'space-boxes' ),
			'search_items'        		=> __( 'Search Space Boxes', 'space-boxes' ),
			'not_found'           		=> __( 'No Space Boxes found', 'space-boxes' ),
			'not_found_in_trash'  		=> __( 'No Space Boxes found in Trash', 'space-boxes' ),
		);
		$args = array(
			'label'               		=> __( 'Space Boxes', 'space-boxes' ),
			'description'         		=> __( 'Create responsive boxes', 'space-boxes' ),
			'menu_icon' 		  		=> $this->url.'/icon.png',  // Icon Path
			'labels'              		=> $labels,
			'supports'            		=> array( 'title', 'editor', 'thumbnail' ),
			'taxonomies'          		=> array( 'spacebox-categories' ),
			'hierarchical'        		=> false,
			'public'              		=> false,
 			'show_ui' 					=> true,
			'exclude_from_search'		=> false,
			'query_var' 				=> true,
			'can_export' 				=> true,
		);
		register_post_type( 'spaceboxes', $args );

	}
	function do_taxo()  {

		$labels = array(
			'name'                      => _x( 'Space Box Categories', 'Taxonomy General Name', 'space-boxes' ),
			'singular_name'             => _x( 'Space Box Category', 'Taxonomy Singular Name', 'space-boxes' ),
			'menu_name'                 => __( 'Categories', 'space-boxes' ),
			'all_items'                 => __( 'All Categories', 'space-boxes' ),
			'parent_item'               => __( 'Parent Category', 'space-boxes' ),
			'parent_item_colon'         => __( 'Parent Category:', 'space-boxes' ),
			'new_item_name'             => __( 'New Category Name', 'space-boxes' ),
			'add_new_item'              => __( 'Add New Space Box Category', 'space-boxes' ),
			'edit_item'                 => __( 'Edit Category', 'space-boxes' ),
			'update_item'               => __( 'Update Category', 'space-boxes' ),
			'separate_items_with_commas' => __( 'Separate Categories with commas', 'space-boxes' ),
			'search_items'              => __( 'Search Categories', 'space-boxes' ),
			'add_or_remove_items'       => __( 'Add or remove categories', 'space-boxes' ),
			'choose_from_most_used'     => __( 'Choose from the most used categories', 'space-boxes' ),
		);
		$args = array(
			'labels'                    => $labels,
			'hierarchical'              => true,
			'public'                    => true,
			'show_ui'                   => true,
			'show_admin_column'         => true,
			'show_in_nav_menus'         => false,
			'show_tagcloud'             => false,
		);
		register_taxonomy( 'spacebox-categories', 'spaceboxes', $args );

	}
}
new ba_SpaceBoxes_type;