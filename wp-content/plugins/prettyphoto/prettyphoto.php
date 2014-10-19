<?php
/*
Plugin Name: PrettyPhoto
Plugin URI: http://www.ibabar.com/blog/prettyphoto
Description: The WordPress port of the jQuery library named PrettyPhoto.
Version: 1.1
Author: Babar
Author URI: http://www.iBabar.com
Requires at least: 3.1
Tested Up to: 3.8
Stable Tag: 1.1
License: GPL v2
*/

$shortname = 'pp';

add_filter('wp_enqueue_scripts', 'pp_enqueue_required_scripts');
add_filter('wp_footer', 'pp_print_footer_script');

function pp_enqueue_required_scripts() {
    $pp_path = plugin_dir_url(__FILE__);
    wp_enqueue_style('pp_css', $pp_path.'css/prettyPhoto.css');
    wp_enqueue_script('pp_js', $pp_path.'js/jquery.prettyPhoto.js', array('jquery'));
}

function pp_print_footer_script() {
    $script = <<<END
<script type="text/javascript">
    jQuery(document).ready(function() {
    jQuery("a[rel^='prettyPhoto']").prettyPhoto({
	    deeplinking: false,
	    });
    });
</script>
END;
echo $script;
	}
