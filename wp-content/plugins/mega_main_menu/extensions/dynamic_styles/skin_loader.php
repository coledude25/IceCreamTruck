<?php
/**
 * @package MegaMain
 * @subpackage MegaMain
 * @since mm 1.0
 */

	add_action( 'wp_head', 'mmm_ie9_gradient_fix', 80, 5 );
	add_action( 'init', 'mmm_enqueue_styles', 20, 5 );
	add_action( 'wp_enqueue_scripts', 'mmm_enqueue_styles' );

	function mmm_ie9_gradient_fix ( $args ) {
		echo '
<!--[if gte IE 9]>
	<style type="text/css">
		.#mega_main_menu,
		.#mega_main_menu *
		{
			filter: none;
		}
	</style>
<![endif]-->
';
	}

	function mmm_enqueue_styles( ) {
		// remove later
		global $mega_main_menu;
//		include_once( $mega_main_menu->constant[ 'MM_WARE_EXTENSIONS_DIR' ] . '/common_tools/init.php' ); 
		if ( function_exists( 'is_multisite' ) && is_multisite() ){
			$cache_file_name = 'cache.skin.b' . get_current_blog_id();
		} else {
			$cache_file_name = 'cache.skin';
		}
		/* check cache or dynamic file enqueue */
		$options_last_modified = $mega_main_menu->get_option( 'last_modified' );
		if( file_exists( $mega_main_menu->constant[ 'MM_WARE_CSS_DIR' ] . '/' . $cache_file_name . '.css' ) ) {
			$cache_status[] = 'exist';
			if ( $options_last_modified > filemtime( $mega_main_menu->constant[ 'MM_WARE_CSS_DIR' ] . '/' . $cache_file_name . '.css' ) ) {
				$cache_status[] = 'old';
			} else {
				$cache_status[] = 'actual';
			}
		} else {
			$cache_status[] = 'no-exist';
		};

		if ( in_array( 'actual', $cache_status ) ) {
			$skin_css[] = array( 'name' => $mega_main_menu->constant[ 'MM_WARE_PREFIX' ] . '_mega_main_menu', 'path' => $mega_main_menu->constant[ 'MM_WARE_CSS_URL' ] . '/' . $cache_file_name . '.css' );
		} else {
			$static_css = mm_common::get_url_content( $mega_main_menu->constant[ 'MM_WARE_CSS_DIR' ] . '/frontend/mega_main_menu.css' );
			if ( ( $static_css !== false ) && ( $cache_file = @fopen( $mega_main_menu->constant[ 'MM_WARE_CSS_DIR' ] . '/' . $cache_file_name . '.css', 'w' ) ) ) {
				$out = '';
				/* google fonts */
				if ( $set_of_google_fonts = $mega_main_menu->get_option( 'set_of_google_fonts' ) ) {
					if ( count( $set_of_google_fonts ) > 0 ) {
						$out .= '/* google fonts */';
						foreach ( $set_of_google_fonts as $key => $value ) {
							$additional_font = '@import url(https://fonts.googleapis.com/css?family=' . str_replace(' ', '+', $value['family'] ) . ':400italic,600italic,300,400,600,700,800&subset=latin,latin-ext,cyrillic,cyrillic-ext);';
							$out .= $additional_font;
						}
					}
				}
				$out .= $static_css . mmm_get_skin();
				if ( in_array( 'true', $mega_main_menu->get_option( 'coercive_styles' , array() ) ) ) {
					$out = str_replace( array( ";
", ";\n", " !important !important" ), array( " !important;", " !important;", " !important" ), $out );
				}
				if ( $mega_main_menu->get_option( 'responsive_resolution' , '768' ) != '768' ) {
					$out = str_replace( 
						array(
							'@media (max-width: 767px) { /* DO NOT CHANGE THIS LINE (See = Specific Options -> Responsive Resolution) */',
							'@media (min-width: 768px) { /* DO NOT CHANGE THIS LINE (See = Specific Options -> Responsive Resolution) */'
						), 
						array( 
							'@media (max-width: ' . ( $mega_main_menu->get_option( 'responsive_resolution' , '768' ) - 1 ). 'px) { /* Responsive Resolution is changed */',
							'@media (min-width: ' . $mega_main_menu->get_option( 'responsive_resolution' , '768' ) . 'px) { /* Responsive Resolution is changed */'

						), 
						$out 
					);
				}
				$out = str_replace( array( "\t", "
", "\n", "  ", ), array( "", "", " ", " ", ), $out );
				if ( @fwrite( $cache_file, $out ) ) {
					$skin_css = array( array( 'name' => $mega_main_menu->constant[ 'MM_WARE_PREFIX' ] . '_' . $cache_file_name, 'path' => $mega_main_menu->constant[ 'MM_WARE_CSS_URL' ] . '/' . $cache_file_name . '.css' ) );
					@touch( $mega_main_menu->constant[ 'MM_WARE_CSS_DIR' ] . '/' . $cache_file_name . '.css', time(), time() );
				}
			} else {
				$skin_css[] = array( 'name' => $mega_main_menu->constant[ 'MM_WARE_PREFIX' ] . '_common_styles', 'path' => $mega_main_menu->constant[ 'MM_WARE_CSS_URL' ] . '/frontend/mega_main_menu.css' );
				$skin_css[] = array( 'name' => $mega_main_menu->constant[ 'MM_WARE_PREFIX' ] . '_dynamic.skin', 'path' => '/?' . $mega_main_menu->constant[ 'MM_WARE_PREFIX' ] . '_page=skin' );
/*
				if ( $set_of_google_fonts = $mega_main_menu->get_option( 'set_of_google_fonts' ) ) {
					unset( $set_of_google_fonts['0'] );
					if ( count( $set_of_google_fonts ) > 0 ) {
						foreach ( $set_of_google_fonts as $key => $value ) {
							$font_family = str_replace(' ', '+', $value['family'] ) . ':400italic,600italic,300,400,600,700,800&subset=latin,latin-ext,cyrillic,cyrillic-ext';
							$skin_css[] = array( 'name' => $mega_main_menu->constant[ 'MM_WARE_PREFIX' ] . '_' . $value['family'], 'path' => 'https://fonts.googleapis.com/css?family=' . $font_family );
						}
					}
				}
*/				
			}
		}

		/* check and enqueue google fonts */
		/* register and enqueue styles */
		foreach ( $skin_css as $single_css ) {
			wp_register_style( $single_css[ 'name' ], $single_css[ 'path' ], false, $options_last_modified );
			wp_enqueue_style( $single_css[ 'name' ] );
		}

		if ( isset( $_GET[ $mega_main_menu->constant[ 'MM_WARE_PREFIX' ] . '_page' ] ) && ( $_GET[ $mega_main_menu->constant[ 'MM_WARE_PREFIX' ] . '_page' ] == 'skin' ) ) {
			header("Content-type: text/css", true);
			//echo '/* CSS Generator  */';
			$generated = microtime(true);
			if ( file_exists( dirname( __FILE__ ) . '/skin.php' ) ) {
				$out = mmm_get_skin();
				if ( in_array( 'true', $mega_main_menu->get_option( 'coercive_styles' , array() ) ) ) {
					$out = str_replace( array( ";
", ";\n", " !important !important" ), array( " !important;", " !important;", " !important" ), $out );
				}
				echo $out;
			} else {
				echo '/* Not have called CSS */';
			}
			die('/* CSS Generator Execution Time: ' . floatval( ( microtime(true) - $generated ) ) . ' seconds */');
		}
	}

?>