<?php
defined( 'ABSPATH' ) OR exit;

/*
/--------------------------------------------------------------------\
|                                                                    |
| License: GPL Version 3                                             |
|                                                                    |
| Magic Liquidizer Responsive Form - Make HTML Form Responsive.      |
| Copyright (C) 2014, Elvin Deza,                                    |
| http://innovedesigns.com/                                          |
| All rights reserved.                                               |
|                                                                    |
| By using the software, you agree to be bound by the terms of		 | 		
| this license.														 |
| 																	 |
|                                                                    |
\--------------------------------------------------------------------/
*/

if (!function_exists('liquidizer_navigationbar_activation')) {
	function liquidizer_navigationbar_activation() {
		if(!current_user_can( 'activate_plugins' )) { 
			echo 'You have no permission to activate this plugin';
			exit();
		} else { 
		
			$liquidizer_lite_options = array(
			'liquidizer_lite_wp_navigationbar' => '1',
			'liquidizer_lite_wp_navigationbar_width' => '780',
			'liquidizer_lite_wp_which_navigationbar_element' => '#navigationbarID',
			'liquidizer_lite_wp_navcolor' => '',
			'liquidizer_lite_wp_navselect' => '.current_page_item',
			'liquidizer_lite_wp_home' => get_site_url().'/',
			'liquidizer_lite_wp_info' => get_site_url().'/about/',
			'liquidizer_lite_wp_contact' => get_site_url().'/contact/');
		
	/* Handling variable array */	
			foreach($liquidizer_lite_options as $x=>$x_value) {
				if ( get_option( $x ) !== false ) {
					update_option($x, $x_value);
				} else {			
					add_option( $x, $x_value, '', 'yes' );
				}
			}
		
		} // else	
	}
}	

