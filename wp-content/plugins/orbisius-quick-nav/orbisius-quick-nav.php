<?php
/*
Plugin Name: Orbisius Quick Nav
Plugin URI: http://club.orbisius.com/products/wordpress-plugins/orbisius-quick-nav/?utm_source=orbisius-quick-nav&utm_medium=plugin-header&utm_campaign=product
Description: This plugin allows you to quickly switch between pages, posts, or any other custom post types.
Version: 1.0.1
Author: Svetoslav Marinov (Slavi)
Author URI: http://orbisius.com
*/

/*  Copyright 2012-2050 Svetoslav Marinov (Slavi) <slavi@orbisius.com>

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// Setup plugin
add_action( 'init', 'orbisius_quick_nav_init' );
add_action( 'wp_footer', 'orbisius_quick_nav_add_plugin_credits', 1000 ); // be the last in the footer

// admin stuff
add_action( 'admin_init', 'orbisius_quick_nav_register_settings' );
add_action( 'admin_menu', 'orbisius_quick_nav_setup_admin', 10 );
add_action( 'admin_footer', 'orbisius_quick_nav_admin_inline_js' );
//add_action( 'admin_print_scripts', 'orbisius_quick_nav_admin_inline_js' );

function orbisius_quick_nav_admin_inline_js() {
    $json_arr = array(
        // http://localhost/wordpress313/wp-admin/post.php?post=368&action=edit
        'admin_edit_page' => admin_url('post.php?post=%%ID%%&action=edit'),
    );
    
    $json = json_encode($json_arr);

    $buff = '';
    
	$buff .= "<script type='text/javascript'>\n";
	$buff .= "var orbisius_quick_nav_cfg = $json;";

	$buff .= <<<EOF
    jQuery(function($) {
        // id can change so find it by name
        $('[name=orb_quick_nav_select]').on('change', function () {
            var item_id = $(this).val();
            var url = orbisius_quick_nav_cfg.admin_edit_page;
            url = url.replace('%%ID%%', item_id);

            // reload page
            window.location = url;
        });
    });
EOF;
    
	$buff .= "\n</script>";

    echo $buff;
}

/**
 *
 * @param obj $post
 */
function orbisius_quick_nav_gen_dropdown($post) {
    $buff = "<div id='orbisius_quick_nav_dropdown_container' style='border:1px solid #ccc;padding:3px;'>\n";
    $buff .= "Orbisius Quick Nav To ($post->post_type): \n";

    $statuses = get_post_stati();
    
    $args = array(
        'name' => 'orb_quick_nav_select',
        'id' => 'orb_quick_nav_select_' . $post->post_type . '_id',
        'depth'            => 0,
        'child_of'         => 0,
        'selected'         => $post->ID,
        'echo'             => 0,
        'post_type'        => $post->post_type,
        'post_status'      => $statuses,
    );

    if ($post->post_type == 'page') {
        $buff .= wp_dropdown_pages($args); // must be hierachical
    } elseif ($post->post_type == 'post') {
        $dropdown_options = array();
        $items_raw = orbisius_quick_nav_util::get_items($post->post_type, array( 'post_status' => $statuses) );

        foreach ($items_raw as $rec) {
            if ($rec['post_status'] == 'auto-draft') {
                continue;
            }
            
            $dropdown_options[$rec['id']] = $rec['post_title'];

            if ($rec['post_status'] != 'publish') {
                $dropdown_options[$rec['id']] .=  ' [' . $rec['post_status'] . ']';
            }
        }

        $buff .= orbisius_quick_nav_util::html_select($args['name'], $post->ID, $dropdown_options);
    } else {
        $limit = 1000;
        global $wpdb;

        $where = sprintf( "WHERE post_status != 'trash' AND post_type = '%s' ", $wpdb->escape($post->post_type) );
        $order = 'ORDER BY post_title DESC';
        
        $items_raw = $wpdb->get_results("SELECT id, post_title, post_type, post_status FROM {$wpdb->posts} $where $order LIMIT $limit", ARRAY_A);
        $items_raw = empty($items_raw) ? array() : $items_raw;

        foreach ($items_raw as $rec) {
            if ($rec['post_status'] == 'auto-draft') {
                continue;
            }
            
            $dropdown_options[$rec['id']] = $rec['post_title'];

            if ($rec['post_status'] != 'publish') {
                $dropdown_options[$rec['id']] =  '[' . $rec['post_status'] . '] ' . $dropdown_options[$rec['id']];
            }
        }

        $buff .= orbisius_quick_nav_util::html_select($args['name'], $post->ID, $dropdown_options);
    }

    $plugin_data = get_plugin_data(__FILE__);
    $prod_link = $plugin_data['PluginURI']; // this should have utm params but we want to change them.
    $prod_link = preg_replace('#\?.*#si', '', $prod_link);

    $pl_slug = str_replace('.php', '', basename(__FILE__));
    $utm = "?utm_source=$pl_slug&utm_medium=plugin-dropdown&utm_campaign=product";
    
    $buff .= "<div style='float:right;padding:3px;text-decoration:none;'>\n";
    $buff .= "<a href='$prod_link/$utm' title='Go to the plugin&#39;s home page. Opens in a new tab/window' target='_blank'>Product Page</a>\n";
    $buff .= "| <a href='http://club.orbisius.com/forums/forum/community-support-forum/wordpress-plugins/$pl_slug/$utm'"
            . " title='Ask questions or make a suggestion. Opens in a new tab/window.' target='_blank'>Support Forums</a>\n";
    $buff .= "| <a href='http://orbisius.com/page/free-quote/$utm' "
            . "title='Need a custom WordPress plugin or a web/mobile app? Contact Us! Opens in a new tab/window.' target='_blank'>Hire Us</a>&nbsp;\n";
    $buff .= "</div>\n";
    $buff .= "</div> <!-- /orbisius_quick_nav_dropdown_container --> \n";

    echo $buff;
}

class orbisius_quick_nav_util {
    // generates HTML select
    // orbisius_quick_nav_util::html_select('sys_user', 'user')
    public static function html_select($name = '', $sel = null, $options = array(), $attr = '') {
        $html = "\n" . '<select name="' . $name . '" id="' . $name . '" ' . $attr . '>' . "\n";

        foreach ($options as $key => $label) {
            $selected = $sel == $key ? ' selected="selected"' : '';

            /*if ($key == '') {
                $selected .= ' disabled="disabled" ';
            }*/
            
            $html .= "\t<option value='$key' $selected>$label</option>\n";
        }

        $html .= '</select>';
        $html .= "\n";

        return $html;
    }

    /**
     * Retrieves all the posts matching given post type.
     * If the type is attachment we set the publish status to inherit because
     * the post status is set to published if not specified.
     */
    public static function get_items($post_type = '', $filters = array()) {
        $limit = -1;
        $items = array();

        $args = array(
            'post_type' => $post_type,
            'posts_per_page' => $limit,
            'suppress_filters' => true,
        );

        if (!empty($filters['post_status'])) {
            $args['post_status'] = $filters['post_status'];
        } elseif ($post_type == 'attachment') {
            $args['post_status'] = 'inherit';
        }

        if (!empty($filters['post_parent'])) {
            $args['post_parent'] = $filters['post_parent'];
        }

        if (!empty($filters['user_id'])) {
            $args['author'] = $filters['user_id'];
        }

        if (!empty($filters['limit'])) {
            $args['posts_per_page'] = $filters['limit'];
        }

        if (!empty($filters['tax_query'])) {
            $args['tax_query'] = $filters['tax_query'];
        }

        if (!empty($filters['meta_query'])) {
            if (is_array($filters['meta_query'])) { // an array, you know what you're doing!
                $args['meta_query_query'] = $filters['meta'];
            } else {
                $args['meta_query'] = array(
                    array(
                        'key' => $filters['meta']['key'],
                        'value' => $filters['meta']['value'],
                        'compare' => empty($filters['meta_query']['compare']) ? '=' : $filters['meta_query']['compare'],
                    )
                );
            }
        }

        $posts = get_posts($args);
        $posts = empty($posts) ? array() : $posts;

        foreach ($posts as $post) {
            $rec['id'] = $post->ID;
            $rec['title'] = $post->post_title;
            $rec['post_title'] = $post->post_title;
            $rec['post_status'] = $post->post_status;
            $items[$rec['id']] = $rec;
        }

        wp_reset_postdata();
        
        return $items;
    }
}

/**
 * Adds the action link to settings. That's from Plugins. It is a nice thing.
 * @param type $links
 * @param type $file
 * @return type
 */
function orbisius_quick_nav_add_quick_settings_link($links, $file) {
    if ($file == plugin_basename(__FILE__)) {
        $link = admin_url('options-general.php?page=' . plugin_basename(__FILE__));
        $dashboard_link = "<a href=\"{$link}\">Settings</a>";
        array_unshift($links, $dashboard_link);
    }

    return $links;
}

/**
 * Setups shortcode and other cool stuff.
 * @return void
 */
function orbisius_quick_nav_init() {
}

/**
 * Set up administration
 *
 * @package Orbisius Quick Nav
 * @since 0.1
 */
function orbisius_quick_nav_setup_admin() {
    // Settings > Orbisius Quick Nav
	add_options_page( 'Orbisius Quick Nav', 'Orbisius Quick Nav', 'manage_options', __FILE__,
            'orbisius_quick_nav_options_page' );

    // Plugins > Action Links
    add_filter('plugin_action_links', 'orbisius_quick_nav_add_quick_settings_link', 10, 2);	
}

/**
 * Sets the setting variables & attached to the correct hook.
 */
function orbisius_quick_nav_register_settings() { // whitelist options
    register_setting('orbisius_quick_nav_settings', 'orbisius_quick_nav_options',
            'orbisius_quick_nav_validate_settings');

    global $wp_version;

    // depending on the
    if (version_compare($wp_version, '3.7') >= 0) {
        $hook = 'edit_form_top'; // v3.7
    } elseif (version_compare($wp_version, '3.5') >= 0) {
        $hook = 'edit_form_after_title';
    } else { // add it to the sidebar if not possible in other places
        // wp 2.1.0
        $hook = 'dbx_post_sidebar';
    }

    add_action( $hook, 'orbisius_quick_nav_gen_dropdown' );
}

/**
 * This is called by WP after the user hits the submit button.
 * The variables are trimmed first and then passed to the who ever wantsto filter them.
 * @param array the entered data from the settings page.
 * @return array the modified input array
 */
function orbisius_quick_nav_validate_settings($input) { // whitelist options
    $input = array_map('trim', $input); // there is an array

    // Let's check if the user has disabled the plugin
    $input['status'] = !empty($input['status']) ? 1 : 0;

    return $input;
}

/**
 * Retrieves the plugin options. It inserts some defaults.
 * The saving is handled by the settings page. Basically, we submit to WP and it takes
 * care of the saving.
 */
function orbisius_quick_nav_get_options() {
    $defaults = array(
        'status' => 1,
    );
    
    $opts = get_option('orbisius_quick_nav_options');
    
    $opts = (array) $opts;
    $opts = array_merge($defaults, $opts);

    return $opts;
}

/**
 * Options page and this is shown under Products.
 * For some reason the saved message doesn't show up on Products page
 * that's why I had to display the message for edit.php page specifically.
 *
 * @package Orbisius Quick Nav
 * @since 1.0
 */
function orbisius_quick_nav_options_page() {
    $opts = orbisius_quick_nav_get_options();
	?>
	<div class="wrap orbisius_quick_nav_admin_wrapper">
        <h2>Orbisius Quick Nav</h2>

        <div class="updated"><p>
            This plugin allows you to quickly switch between pages, posts, or any other custom post types.
        </p></div>        
		
        <div id="poststuff">

            <div id="post-body" class="metabox-holder columns-2">

                <!-- main content -->
                <div id="post-body-content">

                    <div class="meta-box-sortables ui-sortable">

                        <div class="postbox">
                            <div class="inside">
                                The plugin currently doesn't have any configuration options.<br/>
                                If will show a dropdown menu near the title of the edited content.
                                For WordPress between 3.5-3.7 the dropdown will after the permalink and
                                for WordPress older than 3.5 the dropdown will appear after the editor.

                                <?php if (0) : ?>
                                <form method="post" action="options.php">
                                    <?php settings_fields('orbisius_quick_nav_settings'); ?>
                                    <table class="form-table">
										<tr valign="top">
                                            <th scope="row">Plugin Status</th>
                                            <td>
                                                <label for="radio1">
                                                    <input type="radio" id="radio1" name="orbisius_quick_nav_options[status]"
                                                        value="1" <?php echo empty($opts['status']) ? '' : 'checked="checked"'; ?> /> Enabled
                                                </label>
                                                <br/>
                                                <label for="radio2">
                                                    <input type="radio" id="radio2" name="orbisius_quick_nav_options[status]"
                                                        value="0" <?php echo !empty($opts['status']) ? '' : 'checked="checked"'; ?> /> Disabled
                                                </label>
                                            </td>
                                        </tr>										
                                    </table>

                                    <p class="submit">
                                        <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
                                    </p>
                                </form>
                                <?php endif; ?>
                            </div> <!-- .inside -->

                        </div> <!-- .postbox -->

                        <div class="postbox">

                            <h3><span>Tell Your Friends</span></h3>
                            <div class="inside">
                                <?php
                                    $plugin_data = get_plugin_data(__FILE__);

                                    $app_link = urlencode($plugin_data['PluginURI']);
                                    $app_title = urlencode($plugin_data['Name']);
                                    $app_descr = urlencode($plugin_data['Description']);
                                ?>
                                <p>
                                    <!-- AddThis Button BEGIN -->
                                    <div class="addthis_toolbox addthis_default_style addthis_32x32_style">
                                        <a class="addthis_button_facebook" addthis:url="<?php echo $app_link?>" addthis:title="<?php echo $app_title?>" addthis:description="<?php echo $app_descr?>"></a>
                                        <a class="addthis_button_twitter" addthis:url="<?php echo $app_link?>" addthis:title="<?php echo $app_title?>" addthis:description="<?php echo $app_descr?>"></a>
                                        <a class="addthis_button_google_plusone" g:plusone:count="false" addthis:url="<?php echo $app_link?>" addthis:title="<?php echo $app_title?>" addthis:description="<?php echo $app_descr?>"></a>
                                        <a class="addthis_button_linkedin" addthis:url="<?php echo $app_link?>" addthis:title="<?php echo $app_title?>" addthis:description="<?php echo $app_descr?>"></a>
                                        <a class="addthis_button_email" addthis:url="<?php echo $app_link?>" addthis:title="<?php echo $app_title?>" addthis:description="<?php echo $app_descr?>"></a>
                                        <a class="addthis_button_myspace" addthis:url="<?php echo $app_link?>" addthis:title="<?php echo $app_title?>" addthis:description="<?php echo $app_descr?>"></a>
                                        <a class="addthis_button_google" addthis:url="<?php echo $app_link?>" addthis:title="<?php echo $app_title?>" addthis:description="<?php echo $app_descr?>"></a>
                                        <a class="addthis_button_digg" addthis:url="<?php echo $app_link?>" addthis:title="<?php echo $app_title?>" addthis:description="<?php echo $app_descr?>"></a>
                                        <a class="addthis_button_delicious" addthis:url="<?php echo $app_link?>" addthis:title="<?php echo $app_title?>" addthis:description="<?php echo $app_descr?>"></a>
                                        <a class="addthis_button_stumbleupon" addthis:url="<?php echo $app_link?>" addthis:title="<?php echo $app_title?>" addthis:description="<?php echo $app_descr?>"></a>
                                        <a class="addthis_button_tumblr" addthis:url="<?php echo $app_link?>" addthis:title="<?php echo $app_title?>" addthis:description="<?php echo $app_descr?>"></a>
                                        <a class="addthis_button_favorites" addthis:url="<?php echo $app_link?>" addthis:title="<?php echo $app_title?>" addthis:description="<?php echo $app_descr?>"></a>
                                        <a class="addthis_button_compact"></a>
                                    </div>
                                    <!-- The JS code is in the footer -->

                                    <script type="text/javascript">
                                    var addthis_config = {"data_track_clickback":true};
                                    var addthis_share = {
                                      templates: { twitter: 'Check out {{title}} at {{lurl}} (from @orbisius)' }
                                    }
                                    </script>
                                    <!-- AddThis Button START part2 -->
                                    <script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=lordspace"></script>
                                    <!-- AddThis Button END part2 -->
                                </p>
                            </div> <!-- .inside -->

                        </div> <!-- .postbox -->

                    </div> <!-- .meta-box-sortables .ui-sortable -->

                </div> <!-- post-body-content -->

                <!-- sidebar -->
                <div id="postbox-container-1" class="postbox-container">

                    <div class="meta-box-sortables">

                        <!-- Hire Us -->
                        <div class="postbox">
                            <h3><span>Hire Us</span></h3>
                            <div class="inside">
                                Hire us to create a plugin/web/mobile app
                                <br/><a href="http://orbisius.com/page/free-quote/?utm_source=<?php echo str_replace('.php', '', basename(__FILE__));?>&utm_medium=plugin-settings&utm_campaign=product"
                                   title="If you want a custom web/mobile app/plugin developed contact us. This opens in a new window/tab"
                                    class="button-primary" target="_blank">Get a Free Quote</a>
                            </div> <!-- .inside -->
                        </div> <!-- .postbox -->
                        <!-- /Hire Us -->

                        <?php
                            $current_user = wp_get_current_user();
                            $email = empty($current_user->user_email) ? '' : $current_user->user_email;
                        ?>

                        <div class="postbox">
                            <h3><span>Newsletter</span></h3>
                            <div class="inside">
                                <!-- Begin MailChimp Signup Form -->
                                <div id="mc_embed_signup">
                                    <form action="http://WebWeb.us2.list-manage.com/subscribe/post?u=005070a78d0e52a7b567e96df&amp;id=1b83cd2093" method="post"
                                          id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank">
                                        <span>Get notifed about cool plugins we release</span>
                                        <!--<div class="indicates-required"><span class="app_asterisk">*</span> indicates required
                                        </div>-->
                                        <div class="mc-field-group">
                                            <label for="mce-EMAIL">Email <span class="app_asterisk">*</span></label>
                                            <input type="email" value="<?php echo esc_attr($email); ?>" name="EMAIL" class="required email" id="mce-EMAIL">
                                        </div>
                                        <div id="mce-responses" class="clear">
                                            <div class="response" id="mce-error-response" style="display:none"></div>
                                            <div class="response" id="mce-success-response" style="display:none"></div>
                                        </div>	<div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button-primary"></div>
                                    </form>
                                </div>
                                <!--End mc_embed_signup-->
                            </div> <!-- .inside -->
                        </div> <!-- .postbox -->

                        <!-- support options -->
                        <?php $pl_slug = str_replace('.php', '', basename(__FILE__)); ?>
                        <div class="postbox">
                            <div class="inside">
                                <!-- Twitter: code -->
                                <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="http://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
                                <!-- /Twitter: code -->

                                <!-- Twitter: Orbisius_Follow:js -->
                                    <a href="https://twitter.com/orbisius" class="twitter-follow-button"
                                       data-align="right" data-show-count="false">Follow @orbisius</a>
                                <!-- /Twitter: Orbisius_Follow:js -->

                                &nbsp;

                                <?php
                                    $plugin_data = get_plugin_data(__FILE__);
                                    $prod_name = $plugin_data['Name'];
                                    $prod_link = $plugin_data['PluginURI'];
                                    $tw_descr = $plugin_data['Description'];

                                    $tw_hash_tags_arr = array('#WordPress', );

                                    if (stripos($prod_name, 'woocommerce') !== false) {
                                        $tw_hash_tags_arr[] = '#woocommerce';
                                    }

                                    // the text plugin exists we'll make it a hash
                                    if (stripos($tw_descr, 'plugin') === false) {
                                        $tw_hash_tags_arr[] = '#plugin';
                                    } else {
                                        $tw_descr = str_ireplace('plugin', '#plugin', $tw_descr);
                                    }

                                    $tw_hash_tags_list = ' ' . join(' ', $tw_hash_tags_arr);

                                    $tw_share_text = (strlen($tw_descr) > 75 ? substr($tw_descr, 0, 75) . '..' : $tw_descr) . $tw_hash_tags_list;
                                   ?>
                                <!-- Twitter: Tweet:js -->
                                <a href="https://twitter.com/share" class="twitter-share-button"
                                   data-lang="en" data-text="<?php echo esc_attr($tw_share_text); ?>"
                                   data-count="none" data-via="orbisius" data-related="orbisius,qsandbox"
                                   data-url="<?php echo $prod_link; ?>">Tweet</a>
                                <!-- /Twitter: Tweet:js -->

                                <br/>
                                <span>
                                    <a target="_blank" title="[new window]" href="<?php
                                    echo $prod_link;
                                    ?>">Product Page</a>
                                    |
                                    <a href="http://club.orbisius.com/forums/forum/community-support-forum/wordpress-plugins/<?php echo $pl_slug;?>/?utm_source=<?php
                                        echo $pl_slug;?>&utm_medium=plugin-settings&utm_campaign=product"
                                    target="_blank" title="[new window]">Forums</a>
                                    |
                                    More <a href="http://club.orbisius.com/products/?utm_source=<?php
                                        echo $pl_slug;?>&utm_medium=plugin-settings-support&utm_campaign=product"
                                    target="_blank" title="[new window]">Products</a>

                                    <!--|
                                     <a href="http://docs.google.com/viewer?url=https%3A%2F%2Fdl.dropboxusercontent.com%2Fs%2Fwz83vm9841lz3o9%2FOrbisius_LikeGate_Documentation.pdf" target="_blank">Documentation</a>
                                    -->
                                </span>
                            </div>
                        </div> <!-- .postbox --> <!-- /support options -->

                        <div class="postbox"> <!-- quick-contact -->
                            <?php
                            $current_user = wp_get_current_user();
                            $email = empty($current_user->user_email) ? '' : $current_user->user_email;
                            $quick_form_action = is_ssl()
                                    ? 'https://ssl.orbisius.com/apps/quick-contact/'
                                    : 'http://apps.orbisius.com/quick-contact/';

                            if (!empty($_SERVER['DEV_ENV'])) {
                                $quick_form_action = 'http://localhost/projects/quick-contact/';
                            }
                            ?>
                            <script>
                                var never_delete_admin_quick_contact = {
                                    validate_form : function () {
                                        try {
                                            var msg = jQuery('#never_delete_admin_msg').val().trim();
                                            var email = jQuery('#never_delete_admin_email').val().trim();

                                            email = email.replace(/\s+/, '');
                                            email = email.replace(/\.+/, '.');
                                            email = email.replace(/\@+/, '@');

                                            if ( msg == '' ) {
                                                alert('Enter your message.');
                                                jQuery('#never_delete_admin_msg').focus().val(msg).css('border', '1px solid red');
                                                return false;
                                            } else {
                                                // all is good clear borders
                                                jQuery('#never_delete_admin_msg').css('border', '');
                                            }

                                            if ( email == '' || email.indexOf('@') <= 2 || email.indexOf('.') == -1) {
                                                alert('Enter your email and make sure it is valid.');
                                                jQuery('#never_delete_admin_email').focus().val(email).css('border', '1px solid red');
                                                return false;
                                            } else {
                                                // all is good clear borders
                                                jQuery('#never_delete_admin_email').css('border', '');
                                            }

                                            return true;
                                        } catch(e) {};
                                    }
                                };
                            </script>
                            <h3><span>Quick Question or Suggestion</span></h3>
                            <div class="inside">
                                <div>
                                    <form method="post" action="<?php echo $quick_form_action; ?>" target="_blank">
                                        <?php
                                            global $wp_version;
                                            $plugin_data = get_plugin_data(__FILE__);

                                            $hidden_data = array(
                                                'site_url' => site_url(),
                                                'wp_ver' => $wp_version,
                                                'first_name' => $current_user->first_name,
                                                'last_name' => $current_user->last_name,
                                                'product_name' => $plugin_data['Name'],
                                                'product_ver' => $plugin_data['Version'],
                                                'woocommerce_ver' => defined('WOOCOMMERCE_VERSION') ? WOOCOMMERCE_VERSION : 'n/a',
                                            );
                                            $hid_data = http_build_query($hidden_data);
                                            echo "<input type='hidden' name='data[sys_info]' value='$hid_data' />\n";
                                        ?>
                                        <textarea class="widefat" id='never_delete_admin_msg' name='data[msg]' required="required"></textarea>
                                        <br/>Your Email: <input type="text" class=""
                                               id="never_delete_admin_email" name='data[sender_email]' placeholder="Email" required="required"
                                               value="<?php echo esc_attr($email); ?>"
                                               />
                                        <br/><input type="submit" class="button-primary" value="<?php _e('Send Feedback') ?>"
                                                    onclick="return never_delete_admin_quick_contact.validate_form();" />
                                        <br/>
                                        What data will be sent
                                        <a href='javascript:void(0);'
                                            onclick='jQuery(".never_delete_admin_data_to_be_sent").toggle();'>(show/hide)</a>
                                        <div class="hide app_hide never_delete_admin_data_to_be_sent">
                                            <textarea class="widefat" rows="4" readonly="readonly" disabled="disabled"><?php
                                            foreach ($hidden_data as $key => $val) {
                                                if (is_array($val)) {
                                                    $val = var_export($val, 1);
                                                }

                                                echo "$key: $val\n";
                                            }
                                            ?></textarea>
                                        </div>
                                    </form>
                                </div>
                            </div> <!-- .inside -->

                        </div> <!-- .postbox --> <!-- /quick-contact -->
                    </div> <!-- .meta-box-sortables -->

                </div> <!-- #postbox-container-1 .postbox-container -->

            </div> <!-- #post-body .metabox-holder .columns-2 -->

            <br class="clear">
        </div> <!-- #poststuff -->
	</div>
	<?php
}

function orbisius_quick_nav_get_plugin_data() {
    // pull only these vars
    $default_headers = array(
		'Name' => 'Plugin Name',
		'PluginURI' => 'Plugin URI',
	);

    $plugin_data = get_file_data(__FILE__, $default_headers, 'plugin');

    $url = $plugin_data['PluginURI'];
    $name = $plugin_data['Name'];

    $data['name'] = $name;
    $data['url'] = $url;
    
    return $data;
}

/**
* adds some HTML comments in the page so people would know that this plugin powers their site.
*/
function orbisius_quick_nav_add_plugin_credits() {
    // pull only these vars
    $default_headers = array(
		'Name' => 'Plugin Name',
		'PluginURI' => 'Plugin URI',
	);

    $plugin_data = get_file_data(__FILE__, $default_headers, 'plugin');

    $url = $plugin_data['PluginURI'];
    $name = $plugin_data['Name'];

    printf(PHP_EOL . PHP_EOL . '<!-- ' . "Powered by $name | URL: $url " . '-->' . PHP_EOL . PHP_EOL);
}

