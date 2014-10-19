<?php

class spaceBoxCols {

	function __construct(){
		add_filter('manage_spaceboxes_posts_columns', array($this,'col_head'));
		add_action('manage_spaceboxes_posts_custom_column', array($this,'col_content'), 10, 2);
	}

	function col_head($defaults) {
	    $defaults['spacebox_sc'] = __('Space Boxes Shortcode','space-boxes');
	    return $defaults;
	}

	function col_content($column_name, $post_ID) {
	    if ($column_name == 'spacebox_sc') {
	        printf('[spaceboxes id="%s"]',$post_ID);
	    }
	}
}

new spaceBoxCols;

