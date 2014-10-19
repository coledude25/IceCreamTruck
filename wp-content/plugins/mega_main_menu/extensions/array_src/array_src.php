<?php
/**
 * @package MegaMain
 * @subpackage MegaMain
 * @since mm 1.0
 */

	if ( !function_exists( 'mega_main_menu__array_src' ) ) {
		function mega_main_menu__array_src(){
			return array(
				'frontend' => array(
					'css' => array(
						'mm_icomoon' => '/external/icomoon.css',
						'mm_font-awesome' => '/external/font-awesome.css',
					),
					'js' => array(
						'mm_menu_functions' => '/frontend/menu_functions.js',
					),
				),
				'backend' => array(
					'css' => array(
						'mm_icomoon' => '/external/icomoon.css',
						'mm_font-awesome' => '/external/font-awesome.css',
						'mm_bootstrap' => '/external/bootstrap.css',
						'mm_bootstrap_colorpicker' => '/external/colorpicker.css',
						'mm_backend_general' => '/backend/common.css',
					),
					'js' => array(
						'jquery-ui-sortable' => '',
						'jquery-ui-draggable' => '',
						'mm_bootstrap' => '/external/bootstrap.js',
						'mm_bootstrap_colorpicker' => '/external/colorpicker.js',
						'mm_option_generator' => '/backend/option_generator.js',
					),
				),
			);
		}
	}
?>