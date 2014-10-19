<?php
/**
* creates setting tabs
*
* @since version 1.0
* @param null
* @return global settings
*/

require_once dirname( __FILE__ ) . '/class.settings-api.php';

if ( !class_exists('ba_spaceboxes_settings_api' ) ):
class ba_spaceboxes_settings_api {

    private $settings_api;

    const version = '1.0';

    function __construct() {

        $this->dir  		= plugin_dir_path( __FILE__ );
        $this->url  		= plugins_url( '', __FILE__ );
        $this->settings_api = new WeDevs_Settings_API;

        add_action( 'admin_init', array($this, 'admin_init') );
        add_action( 'admin_menu', array($this,'submenu_page'));

    }

    function admin_init() {

        //set the settings
        $this->settings_api->set_sections( $this->get_settings_sections() );
        $this->settings_api->set_fields( $this->get_settings_fields() );

        //initialize settings
        $this->settings_api->admin_init();
    }

	function submenu_page() {
		add_submenu_page( 'edit.php?post_type=spaceboxes', 'Settings', 'Settings', 'manage_options', 'spaceboxes-settings', array($this,'submenu_page_callback') );
	}

	function submenu_page_callback() {

		echo '<div class="wrap"><div id="icon-tools" class="icon32"></div>';
			echo '<h2>Space Boxes Settings</h2>';
			//$this->settings_api->show_navigation();
        	$this->settings_api->show_forms();

		echo '</div>';

	}

    function get_settings_sections() {
        $sections = array(
            array(
                'id' => 'ba_spacebox_settings',
                'title' => __( 'Space Box Options', 'space-boxes' )
            )
        );
        return $sections;
    }

    function get_settings_fields() {
        $settings_fields = array(
            'ba_spacebox_settings' => array(
                array(
                    'name' => 'text_color',
                    'label' => __( 'Text Color', 'space-boxes' ),
                    'desc' => __( 'Controls the overall text color.', 'space-boxes' ),
                    'type' => 'color',
                    'default' => '#333'
                ),
               	array(
                    'name' => 'accent_color',
                    'label' => __( 'Accent Color', 'space-boxes' ),
                    'desc' => __( 'Controls the background color of the plus icon.', 'space-boxes' ),
                    'type' => 'color',
                    'default' => '#333'
                ),
                array(
                    'name' => 'lb_bg',
                    'label' => __( 'Lightbox Background Color', 'space-boxes' ),
                    'desc' => __( 'Controls the lightbox background color.', 'space-boxes' ),
                    'type' => 'color',
                    'default' => '#000'
                ),
                array(
                    'name' => 'lb_txt',
                    'label' => __( 'Lightbox Text Color', 'space-boxes' ),
                    'desc' => __( 'Controls the lightbox text color.', 'space-boxes' ),
                    'type' => 'color',
                    'default' => '#EAEAEA'
                )
            )
        );

        return $settings_fields;
    }
}
endif;

$settings = new ba_spaceboxes_settings_api();




