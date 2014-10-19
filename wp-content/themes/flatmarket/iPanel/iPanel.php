<?php

    /*
     *    === Define the Path ===
    */
    defined('IPANEL_PATH') ||
        define( 'IPANEL_PATH' , dirname(__FILE__) . '/' );    

    /*
     *    === Define the Version of iPanel ===
    */
    define( 'IPANEL_VERSION' , '1.1' );    
    

    
    /*
     *    === Define the Classes Path ===
    */
    if ( defined('IPANEL_PATH') ) {
        define( 'IPANEL_CLASSES_PATH' , IPANEL_PATH . 'classes/' );
    } else {
        define( 'IPANEL_CLASSES_PATH' , dirname(__FILE__) . '/classes/' );
    }
    
    function iPanelLoad(){
        require_once IPANEL_CLASSES_PATH . 'ipanel.class.php';
		if( file_exists(IPANEL_PATH . 'options.php') )
			require_once IPANEL_PATH . 'options.php';
    }
    
    if ( defined('IPANEL_PLUGIN_USAGE') ) {
        if ( IPANEL_PLUGIN_USAGE === true ) {
            add_action('plugins_loaded', 'iPanelLoad');
        } else {
            add_action('init', 'iPanelLoad');
        }
    } else {
        add_action('init', 'iPanelLoad');
    }