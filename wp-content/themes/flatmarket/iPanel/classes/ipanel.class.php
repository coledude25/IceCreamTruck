<?php

/**
 * iPanel Option Panel Generator
 *
 * PHP version 5
 *
 * @category IPANEL
 * @package  IPanelOptionPanelGenerator
 * @author   Vahidd <vahid-mohamadi@live.com>
 * @license  http://codecanyon.net/licenses Codecanyon Licenses
 * @link     http://codecanyon.net/item/ipanel-wordpress-options-panel-framework/4988973
 *
 */
 
defined('ABSPATH') || die;

if (!class_exists('IPANEL')) {
     /**
      * iPanel Main Class.
      *
      * @category  PHP
      * @package   PHP_IPANEL
      * @author    Vahidd <vahid-mohamadi@live.com>
      * @copyright Codecanyon
      * @license   http://codecanyon.net/licenses Codecanyon License
      * @version   Release: @package_version@
      * @link      http://codecanyon.net/item/ipanel-wordpress-options-panel-framework/4988973
      */
    class IPANEL
    {
        
        /*
         * All arguments
         * 
         * @var array
         * @since 1.0
         */
        protected $args;
        
        /*
         * Direction
         * 
         * @var string
         * @since 1.0
         */
        protected $direction;
        
        /*
         * Direction
         * 
         * @var string
         * @since 1.0
         */
        protected $text_domain;
        
        /**
         * Construct Function
         * 
         * @param array $args Contain All Needed Arguments.
         *
         * @since 1.0
         * @return void
         * @author vahidd
         */
        function __construct($args)
        {
            $this->args        = $args;
            $this->direction   = $args['rtl'] === true ? 'ipanel-rtl' : 'ipanel-ltr';
            $this->text_domain = !empty($args['text_domain']) ? $args['text_domain'] : 'ipanel';
            add_action(
                'admin_menu', 
                array(
                    $this,
                    'registerMenu'
                )
            );
            add_action(
                'admin_enqueue_scripts', 
                array(
                    $this,
                    'enqueue'
                )
            );
            add_action(
                'wp_ajax_ipanel_ajax_request',
                array(
                    $this,
                    'ajaxRequestsHandle'
                )
            );
            add_filter(
                'admin_body_class',
                array(
                    $this,
                    'adminBodyClass'
                )
            );
            add_action(
                'admin_head',
                array(
                    $this,
                    'adminHead'
                )
            );
            add_action(
                'admin_footer',
                array(
                    $this,
                    'adminFooter'
                )
            );
            add_action(
                'admin_init',
                array(
                    $this,
                    'downloadExport'
                )
            );
            add_action(
                'admin_init',
                array(
                    $this,
                    'addOptions'
                )
            );
            add_action(
                'ipanel_save_options',
                array(
                    $this,
                    'saveOptions'
                ),
                10,
                2
            );
        }
        
        /**
         * Enqueue needed styles and scripts
         * 
         * @since 1.0
         * @return void
         * @author vahidd
         */
        public function enqueue()
        {
            if ((isset($_GET['page'])) && ('ipanel_' . $this->args['ID'] == $_GET['page'])) {
                $assets_url = IPANEL_URI . 'assets/';
                wp_enqueue_script('jquery-form');
                wp_enqueue_script('jquery-ui-core');
                wp_enqueue_script('jquery-ui-widget');
                wp_enqueue_script('jquery-ui-sortable');
                wp_enqueue_script('jquery-effects-drop');
                wp_enqueue_script('jquery-ui-slider');
                wp_enqueue_script('jquery-ui-datepicker');
                wp_enqueue_script('ipanel-js-libraries', $assets_url . 'ipanel-libraries-pack.js', array(), false, true);
                wp_enqueue_script('ipanel-js-libraries-header', $assets_url . 'ipanel-libraries-pack-header.js');
                wp_enqueue_script('ipanel-codemirror-pack-js', $assets_url . 'codemirror/ipanel-codemirror-pack.js', array(), false, true);
                wp_enqueue_script('ipanel-script', $assets_url . 'js/scripts.js');
                wp_enqueue_style('ipanel-styles', $assets_url . 'css/styles.css');
                wp_enqueue_style('ipanel-css-libraries', $assets_url . 'ipanel-css-libraries.css');
                wp_enqueue_style('ipanel-codemirror-pack-css', $assets_url . 'codemirror/ipanel-codemirror-pack.css');
                wp_enqueue_media();
                wp_localize_script(
                    'ipanel-script',
                    'iPanelAjax',
                    array(
                        'ajaxurl' => admin_url('admin-ajax.php'),
                        'reset_confirm_message' => __("Are you sure you want to reset back to the defaults?", $this->text_domain),
                        'confirm_message' => __("Are you sure?", $this->text_domain),
                        'assetsurl' => $assets_url
                    )
                );
            }
        }
        
        /**
         * Register Menu from Options
         * 
         * @since 1.0
         * @author vahidd
         * @return void
         */
        public function registerMenu()
        {
            if ($this->args['menu']['submenu'] !== false) {
                $admin_page = add_submenu_page(
                    $this->args['menu']['submenu'],
                    $this->args['menu']['page_title'],
                    $this->args['menu']['menu_title'],
                    $this->args['menu']['capability'],
                    'ipanel_' . $this->args['ID'],
                    array(
                        $this,
                        'menuPage'
                    )
                );
            } else {
                $admin_page = add_menu_page(
                    $this->args['menu']['page_title'],
                    $this->args['menu']['menu_title'],
                    $this->args['menu']['capability'],
                    'ipanel_' . $this->args['ID'],
                    array(
                        $this,
                        'menuPage'
                    ),
                    isset($this->args['menu']['icon_url']) ? filter_var($this->args['menu']['icon_url'], FILTER_VALIDATE_URL) : null, $this->args['menu']['position']
                );
            }
            if (isset($this->args['help_tabs']) && is_array($this->args['help_tabs']) && count($this->args['help_tabs']) > 0) {
                add_action('load-'.$admin_page, array($this, 'addHelpTabs'));
            }
        }
        
        /**
         * Add Help Tabs
         * 
         * @since 1.1
         * @return void
         * @author vahidd
         */
        function addHelpTabs()
        {
            foreach ($this->args['help_tabs'] as $tab) {
                get_current_screen()->add_help_tab(array('id'=> $tab['id'],'title' => $tab['title'],'content' => '<p>'.$tab['content'].'</p>'));
            }    
        }
        
        /**
         * Custom Update Option
         * 
         * @param int $id  The ID of Option.
         * @param int $val The Values.
         * 
         * @since 1.1
         * @return bool
         * @author vahidd
         */
        function updateOption($id, $val)
        {
            if (get_option($id) === false) {
                return add_option($id, $val);
            } else {
                delete_option($id);
                return add_option($id, $val);
            }
        }
        
        /**
         * Save Options Callback
         * 
         * @param int $options_data Data of Panel to Save.
         * @param int $panel_id     Option Panel ID.
         * 
         * @since 1.0
         * @return string
         * @author vahidd
         */
        function saveOptions($data, $panel_id)
        {
            
            foreach ($data as $optionID => $o) {
                
                $field  = $this->fieldByID($optionID);
                
                    
                if ($field['type'] == 'checkbox') {
                
                    $o == 'on' ? ($data[$optionID] = true) : ($data[$optionID] = false);
                    
                } else if ($field['type'] == 'multiselect') {
                
                    $data[$optionID] = explode(',', $o);
                    
                } else if ($field['type'] == 'multicheckbox') {
                
                    $data[$optionID] = $this->filterGetOption('multicheckbox', $o);
                    
                } else if ($field['type'] == 'repeater') {
                    
                    foreach ($o as $REPEATRKEY => $REPEATERVALUE) {
                        foreach ($REPEATERVALUE as $REPEATRITEMKEY => $REPEATERITEMVALUE) {
                            $repeater_field = $this->repeaterFieldByID2($field['id'], $REPEATRITEMKEY);
                            if ($repeater_field['type'] == 'multiselect') {
                                $rF[$REPEATRKEY][$REPEATRITEMKEY] = $this->filterGetOption('repeater_multiselect', $REPEATERITEMVALUE);
                            } else if ($repeater_field['type'] == 'checkbox') {
                                $rF[$REPEATRKEY][$REPEATRITEMKEY] = $this->filterGetOption('repeater_checkbox', $REPEATERITEMVALUE);
                            } else if ($repeater_field['type'] == 'multicheckbox') {
                                $rF[$REPEATRKEY][$REPEATRITEMKEY] = $this->filterGetOption('repeater_multicheckbox', $REPEATERITEMVALUE);
                            } else {
                                $rF[$REPEATRKEY][$REPEATRITEMKEY] = $REPEATERITEMVALUE;
                            }
                        }
                    }
                    $data[$optionID] = $rF;

                    
                } else {
                
                    $data[$optionID] = $o;
                    
                }
                
                
            }
            
            $update = $this->updateOption($panel_id, base64_encode(serialize($data)));
            $output['status']  = $update === false ? 'error' : 'succeed';
            $output['message'] = $output['status'] === 'error' ? __('Error!', $this->text_domain) : __('Options Updated.', $this->text_domain);
            $output['test'] = base64_encode(serialize($data));
            echo json_encode($output);
        }
        
        /**
         * AJAX Requests Handle
         * 
         * @since 1.0
         * @author vahidd
         * @return string
         */
        function ajaxRequestsHandle()
        {
            $_nonce = check_ajax_referer('ipanel_nonce', 'security', false); // Pass Nonce in Var
            if ($_nonce === false) {
                die(
                    json_encode(
                        array(
                        'status' => 'error',
                        'message' => __('Error!', $this->text_domain)
                        )
                    )
                );
            }
            if ($_POST['action2'] == 'save_settings') {
                wp_parse_str(ltrim(rtrim(stripslashes($_POST['_data']), '&'), '&'), $data);
                do_action('ipanel_save_options', $data, $_POST['panelid']);
            } else if ($_POST['action2'] == 'import') { // Import Action
                if ($_POST['import_type'] == 'code') { // Check if import data is code
                    $data = trim($_POST['data']);
                } else if ($_POST['import_type'] == 'file') { // Check if import data is file
                    $data = file_get_contents($_FILES['ipanel-import-file']['tmp_name']);
                } else {
                    die(
                        json_decode(
                            array(
                            'status' => 'error',
                            'message' => __("You've not specified any data.", $this->text_domain)
                            )
                        )
                    );
                }
                if (base64_decode($data) === false) {
                    die(
                        json_decode(
                            array(
                                'status' => 'error',
                                'message' => __('There is something wrong with the data.', $this->text_domain)
                            )
                        )
                    );
                }
                $panelID = $_POST['panelid']; // Pass the panel id Variable
                delete_option(@$panelID); // Delete Current Data
                $add_option = add_option(@$panelID, $data); // Add New Data
                if ($add_option === true) { // Check if add data was successfuly
                    $output['status']  = 'succeed';
                    $output['message'] = __('Data has been imported successfully.', $this->text_domain);
                } else { // and if not
                    $output['status']  = 'succeed';
                    $output['message'] = __('An error occured while importing data.', $this->text_domain);
                }
                echo json_encode($output); // Return Ajax Result(s)
            } else if ($_POST['action2'] == 'reset_settings') { // Reset Settings Action
                $panel_id          = trim($_POST['panelid']);
                $delete            = delete_option($panel_id);
                $output['status']  = $delete === false ? 'error' : 'succeed';
                $output['message'] = $delete === false ? __('Error!', $this->text_domain) : __('Options Reset.', $this->text_domain);
                $this->saveAllOptions();
                echo json_encode($output);
            } else if ($_POST['action2'] == 'delete_qup_file') { // Delete Uploaded File Action
                if (@unlink(urldecode($_POST['file_path']))) {
                    $output['status']  = 'succeed';
                    $output['message'] = __('The file permanently deleted.', $this->text_domain);
                } else {
                    $output['status']  = 'error';
                    $output['message'] = __('ERROR!', $this->text_domain);
                }
                echo json_encode($output);
            } else if ($_POST['action2'] == 'qup') { // Quick Upload Action
                if (current_user_can('upload_files')) {
                    if (!function_exists('wp_handle_upload')) {
                        include_once ABSPATH . 'wp-admin/includes/file.php';
                    }
                    $fileName = $_POST['fileID'];
                    $movefile = wp_handle_upload(
                        $_FILES[$fileName],
                        array(
                            'test_form' => false
                        )
                    );
                    if (array_key_exists('error', $movefile)) {
                        $upResults = array(
                            'status' => 'error',
                            'message' => $movefile['error']
                        );
                    } else {
                        $upResults = array(
                            'status' => 'succeed',
                            'url' => $movefile['url'],
                            'path' => $movefile['file']
                        );
                        $file_     = pathinfo($movefile['url']);
                        $is_image  = preg_match('/^(gif|jpg|png)$/', $file_['extension']) === 1 ? true : false;
                        if ($is_image) {
                            //File Box for Image
                            $HTMLRESULTS = '    <img class="ipanel-qup-up-img img" src="' . $movefile['url'] . '" />' . "\n";
                            $HTMLRESULTS .= '    <div class="ipanel_file_info">' . "\n";
                            $HTMLRESULTS .= '    '.__('File URL', $this->text_domain).': ' . '<code>' . $movefile['url'] . '</code><br/><br/>' . "\n";
                            $HTMLRESULTS .= '    '.__('File Path', $this->text_domain).': ' . '<code>' . $movefile['file'] . '</code><br/><br/>' . "\n";
                            $HTMLRESULTS .= '    <a href="#" class="ipanel-remove-qup-file" data-filePath="' . $movefile['file'] . '">Delete</a>' . "\n";
                            $HTMLRESULTS .= '    </div>' . "\n";
                            $HTMLRESULTS .= '    <div class="clr"></div>' . "\n";
                            $upResults['file_html'] = $HTMLRESULTS;
                        } else {
                            // File Box for Other File Types
                            $HTMLRESULTS = '    <img class="ipanel-qup-up-img" src="' . IPANEL_URI . 'assets/img/document.png" />' . "\n";
                            $HTMLRESULTS .= '    <div class="ipanel_file_info">' . "\n";
                            $HTMLRESULTS .= '    '.__('File URL', $this->text_domain).': ' . '<code>' . $movefile['url'] . '</code><br/><br/>' . "\n";
                            $HTMLRESULTS .= '    '.__('File Path', $this->text_domain).': ' . '<code>' . $movefile['file'] . '</code><br/><br/>' . "\n";
                            $HTMLRESULTS .= '    <a href="#" class="ipanel-remove-qup-file" data-filePath="' . $movefile['file'] . '">Delete</a>' . "\n";
                            $HTMLRESULTS .= '    </div>' . "\n";
                            $HTMLRESULTS .= '    <div class="clr"></div>' . "\n";
                            $upResults['file_html'] = $HTMLRESULTS;
                        }
                    }
                    echo json_encode($upResults);
                } else {
                    echo json_encode(
                        array(
                        'status' => 'error',
                        'message' => __('Error!', $this->text_domain)
                        )
                    );
                }
            }
            exit;
        }
        
        
        /**
         * Admin Head Stuff
         * 
         * @since 1.0
         * @author vahidd
         * @return void
         */
        function adminHead()
        {
            if (isset($_GET['page']) && 'ipanel_' . $this->args['ID'] == $_GET['page']) {
            }
        }
        
        /**
         * Admin Footer Stuff
         * 
         * @since 1.0
         * @author vahidd
         * @return void
         */
        function adminFooter()
        {
            if (isset($_GET['page']) && 'ipanel_' . $this->args['ID'] == $_GET['page']) {
                echo '<div id="ipanel-canvesLoader" style="display: none;"></div>';
                echo '<div id="ipanel-message-box"></div>';
                echo "<script type='text/javascript'>
                  var cl = new CanvasLoader('ipanel-canvesLoader');
                  cl.setColor('#ffffff');
                  cl.setDiameter(60);
                  cl.setDensity(101);
                  cl.setRange(0.8);
                  cl.setFPS(60);cl.show();var loaderObj = document.getElementById('canvasLoader');
                </script>";
            }
        }
        
        /**
         * Add Direction as Body Class
         * 
         * @param string $classes The Class of Body to Append.
         * 
         * @since 1.0
         * @author vahidd
         * @return string
         */
        function adminBodyClass($classes)
        {
            if (isset($_GET['page']) && 'ipanel_' . $this->args['ID'] == $_GET['page']) {
                $classes .= ' - ' . $this->direction . ' - ';
                return $classes;
            }
        }
        
        /**
         * Cheked Attribute for Checkbox Elemnt by Field ID
         * 
         * @param int $value The Value if Checkbox.
         * 
         * @since 1.0
         * @author vahidd
         * @return string
         */
        public function checked($value = null)
        {
            return $value === 1 ? 'checked="checked"' : '';
        }
        
        /**
         * Selected attribute.
         * 
         * @param string $val    The Value if Field.
         * @param string $option Item Name.
         * 
         * @since 1.1
         * @author vahidd
         * @return string
         */
        public function selected($val, $option)
        {
            return $option == $val ? 'selected="selected"' : '';
        }
        
        /**
         * Filter Valid Fields
         * 
         * @param array  $fields Fields to Filter.
         * @param string $type   The type of filter.
         * 
         * @since 1.0
         * @author vahidd
         * @return array
         */
        public function filterFields($fields, $type = 'with_id')
        {
            if ($type == 'with_id') {
                if (is_array($fields) && count((array) $fields) > 0) {
                    return array_filter(
                        (array) $fields, 
                        array(
                            $this,
                            'filterFieldsByWithCallback'
                        )
                    );
                }
            } else if ($type == 'for_db') {
                if (is_array($fields) && count((array) $fields) > 0) {
                    return array_filter(
                        (array) $fields, 
                        array(
                            $this,
                            'filterFieldsForDBCallback'
                        )
                    );
                }
            }
            return array();
        }
        
        /**
         * Filter Fields Callback Function
         * 
         * @param array $var The Field Array to Check.
         * 
         * @since 1.0
         * @author vahidd
         * @return true|false
         */
        public function filterFieldsByWithCallback($var)
        {
            if ($var['type'] == 'EndTab' || $var['type'] == 'export' || $var['type'] == 'import' || $var['type'] == 'StartSection' || $var['type'] == 'EndSection' || $var['type'] == 'info') {
                return true;
            }
            return (isset($var['id']) && isset($var['type']));
        }
        
        /**
         * Filter Fields For Database
         * 
         * @param array $var The Field Array to Check.
         * 
         * @since 1.1
         * @author vahidd
         * @return true|false
         */
        public function filterFieldsForDBCallback($var)
        {
            return (! empty($var['std']));
        }
        
        /**
         * Filter Fields For Export
         * 
         * @param array $fields Filter Correct Fields for Export.
         * 
         * @since 1.0
         * @author vahidd
         * @return array
         */
        public function filterForExport($fields)
        {
            $fields = $this->filterFields($fields);
            $output = array();
            foreach ($fields as $field) {
                if (isset($field['id']) && $field['type'] != 'StartTab' && $field['type'] != 'StartSection' && $field['type'] != 'EndSection' && $field['type'] != 'EndTab' && $field['type'] != 'info') {
                    $output[] = $field;
                }    
            }
            return $output;
        }
        
        /**
         * Make an array from all options include their values
         * 
         * @since 1.0
         * @author vahidd
         * @return array
         */
        public function allOptionsInArray()
        {
            $output  = array();
            $options = unserialize(base64_decode(get_option($this->args['ID'])));
            foreach ($this->filterForExport($this->args['fields']) as $field) {
                if (isset($options[$field['id']])) {
                    $output[$field['id']] = $options[$field['id']];
                } else if (isset($field['std'])) {
                    $output[$field['id']] = $field['std'];
                }    
            }
            return $output;
        }
        
        
        /**
         * Get Column of Field by Fields ID
         * 
         * @param string $id The ID of Field.
         * 
         * @since 1.0
         * @author vahidd
         * @return array
         */
        public function fieldByID($id = 0)
        {
            $f = self::filterFields($this->args['fields']);
            foreach ($f as $key => $val) {
                if (isset($val['id']) && $id == $val['id']) {
                    return $f[$key];
                    break;
                }
            }
        }
        
        /**
         * Get Column of Field by Fields ID
         * 
         * @param array $fields The Array of Repeater Items.
         * @param array $id     The ID of Repeater Field.
         * 
         * @since 1.0
         * @author vahidd
         * @return array
         */
        public function repeaterFieldByID($fields = array(), $id = 0)
        {
            $f = self::filterFields($fields);
            foreach ($f as $key => $val) {
                if ($id == $val['id']) {
                    return $f[$key];
                    break;
                }
            }
        }
        
        /**
         * Get Column of Field by Fields ID
         * 
         * @param string $repeater_id Repeater ID.
         * @param string $field_id    Field ID.
         * 
         * @since 1.0
         * @author vahidd
         * @return array
         */
        public function repeaterFieldByID2($repeater_id = '', $field_id = '')
        {
            $options = $this->fieldByID($repeater_id);
            foreach ($options['options'] as $k => $v) {
                if ($v['id'] == $field_id) {
                    return $options['options'][$k];
                    break;
                }
            }
            return array();
        }
        
        /**
         * Filter The Data Which Are Going To Be Saved in DB
         * 
         * @param string $type Type of Field.
         * @param string $val  Value if Field.
         * 
         * @since 1.1
         * @author vahidd
         * @return mixed
         */
        public function filterAddOption($type, $val)
        {
            if ($type == 'repeater_checkbox') {
                return $val === true ? 'on' : 'off';
            }
            if ($type == 'repeater_multiselect') {
                return implode(',', $val);
            }
            if ($type == 'multicheckbox') {
                $multi_checkbox_value = array();
                foreach ($val as $multicheckbox_key => $multicheckbox_val) {
                    if ($multicheckbox_val == 'on') {
                        $multi_checkbox_value[] = $multicheckbox_key;
                    }
                }
                return $multi_checkbox_value;
            }        
        }
        
        /**
         * Filter Get Option Data To The Currect Format
         * 
         * @param string $type Type of Field.
         * @param string $val  Value if Field.
         * 
         * @since 1.0
         * @author vahidd
         * @return mixed
         */
        public function filterGetOption($type, $val)
        {
            if ($type == 'repeater_multicheckbox') {
                $output = array();
                foreach ($val as $key => $val) {
                    if ('on' == $val) {
                        $output[] = $key;
                    }
                }
                return $output;
            }
            if ($type == 'repeater_checkbox') {
                return $val == 'on' ? true : false;
            }
            if ($type == 'repeater_multiselect') {
                return explode(',', $val);
            }
            if ($type == 'multicheckbox') {
                $multi_checkbox_value = array();
                foreach ($val as $multicheckbox_key => $multicheckbox_val) {
                    if ($multicheckbox_val == 'on') {
                        $multi_checkbox_value[] = $multicheckbox_key;
                    }
                }
                return $multi_checkbox_value;
            }
        }
        
        /**
         * Save All Options (usage in reset and install)
         * 
         * @since 1.1
         * @author vahidd
         * @return mixed
         */
        public function saveAllOptions()
        {
            $options = array();
            foreach($this->filterFields($this->args['fields'], 'for_db') as $field) {
                $options[$field['id']] = $field['std'];
            }
            return $this->updateOption($this->args['ID'], base64_encode(serialize($options)));
        }
        
        /**
         * Add options when the theme or plugin has been activated
         * 
         * @since 1.1
         * @author vahidd
         * @return mixed
         */
        public function addOptions()
        {
            global $pagenow;
            if (get_option($this->args['ID']) === false) {
                if (defined('IPANEL_PLUGIN_USAGE') && IPANEL_PLUGIN_USAGE !== true) {
                    if ($pagenow == 'themes.php' && isset($_GET['activated']) && $_GET['activated'] == 'true') {
                        $this->saveAllOptions();
                    }
                } else if (defined('IPANEL_PLUGIN_USAGE') && IPANEL_PLUGIN_USAGE === true) {
                    if ($pagenow == 'plugins.php' && isset($_GET['activate']) && $_GET['activate'] == 'true') {
                        $this->saveAllOptions();
                    }
                }
            }
        }
        
        /**
         * Get Option by ID
         * 
         * @param string $id The ID of Field.
         * 
         * @since 1.0
         * @author vahidd
         * @return mixed
         */
        public function getOption($id = '')
        {
            $field  = $this->fieldByID($id);
            $option = @unserialize(base64_decode(get_option($this->args['ID'])));
            return isset($option[$id]) ? $option[$id] : '';
        }
        
        /**
         * Download Export File
         * 
         * @since 1.0
         * @author vahidd
         * @return mixed
         */
        public function downloadExport()
        {
            if (isset($_GET['action']) && $_GET['action'] == 'ipanel-download-export-file') {
                // Check nonce
                if (! wp_verify_nonce($_GET['nonce'], 'ipanel_export_nonce')) {
                    wp_die('Security Check');
                }
                // Set Capability of download the file
                $download_capability = empty($this->args['download_capability']) ? 'manage_options' : $this->args['download_capability'];
                
                // Check if current user can download the file
                if (!current_user_can($download_capability)) {
                    wp_die('You do not have sufficient permissions to do this.');
                }
                // Get Download Data
                $data = get_option($_GET['panelid']);
                
                // Check if data can be the download file
                if ($data === false || base64_decode($data) === false) {
                    wp_die(__('Error in download the file.', $this->text_domain));
                }
                // Apply Filter to Download File Name
                $file_name = apply_filters('ipanel_export_download_file_name', empty($_GET['panelid']) ? 'backup.txt' : $_GET['panelid'] . ' - Backup.txt');
                
                // No Cache
                header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');
                header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
                header('Cache-Control: no-store, no-cache, must-revalidate');
                header('Cache-Control: post-check=0, pre-check=0', false);
                header('Pragma: no-cache');
                
                header('Content-Type: application/force-download');
                header("Content-Length: " . strlen($data));
                header('Content-Disposition: attachment; filename="' . $file_name . '"');
                die($data);
            }
        }

        /**
         * Generate Tabs
         * 
         * @since 1.0
         * @return mixed
         */
        public function generateTabs()
        {
            $tabs   = is_array($this->args['tabs']) ? $this->args['tabs'] : false;
            $output = '';
            if ($tabs !== false) {
                foreach ($tabs as $tab) {
                    $subitems = '';
                    if (isset($tab['childrens']) && is_array($tab['childrens']) && count($tab['childrens']) > 0) {
                        $subitems .= '<ul class="submenu">';
                        foreach ($tab['childrens'] as $subItem) {
                            $subitems .= '  ' . '<a href="#" id="tab-' . $subItem['id'] . '" data-target="' . $subItem['id'] . '">' . $subItem['name'] . '</a>' . "\n";
                        }
                        $subitems .= '</ul>';
                    }
                    $output .= '<li id="tab-'.$tab['id'].'"><a href="#" data-target="' . $tab['id'] . '">' . $tab['name'] . '</a> ' . $subitems . ' </li>' . "\n";
                }
            }
            return $output;
        }
        
        /**
         * Generate All Fields
         * 
         * @param array $fields Fields Array to Generate Fields.
         * 
         * @since 1.0
         * @author vahidd
         * @return string
         */
        public function generateFields($fields)
        {
            $f      = $this->filterFields($fields);
            $output = '';
            foreach ($f as $item) {
                switch ($item['type']) {

                case ('StartTab'):
                    $output .= $this->startTab($item);
                    break;
                    
                case ('EndTab'):
                    $output .= $this->endTab();
                    break;
                    
                case ('text'):
                    $output .= $this->text($item, array());
                    break;
                    
                case ('color'):
                    $output .= $this->colorPicker($item, array());
                    break;
                    
                case ('textarea'):
                    $output .= $this->textArea($item, array());
                    break;
                    
                case ('wp_editor'):
                    $output .= $this->wpEditor($item);
                    break;
                    
                case ('cleditor'):
                    $output .= $this->cleditor($item, array());
                    break;
                    
                case ('checkbox'):
                    $output .= $this->checkbox($item, array());
                    break;
                    
                case ('multicheckbox'):
                    $output .= $this->multiCheckbox($item, array());
                    break;
                    
                case ('select'):
                    $output .= $this->select($item, array());
                    break;
                    
                case ('multiselect'):
                    $output .= $this->multiSelect($item, array());
                    break;
                    
                case ('radio'):
                    $output .= $this->radio($item, array());
                    break;
                    
                case ('media'):
                    $output .= $this->mediaUploader($item, array());
                    break;
                    
                case ('typography'):
                    $output .= $this->typography($item, array());
                    break;
                    
                case ('repeater'):
                    $output .= $this->repeater($item, array());
                    break;
                    
                case ('qup'):
                    $output .= $this->quickUpload($item, array());
                    break;
                    
                case ('export'):
                    $output .= $this->export($item);
                    break;
                    
                case ('import'):
                    $output .= $this->import($item);
                    break;
                    
                case ('date'):
                    $output .= $this->datePicker($item);
                    break;
                    
                case ('code'):
                    $output .= $this->codeEditor($item);
                    break;
                    
                case ('image'):
                    $output .= $this->imageSelect($item);
                    break;
                    
                case ('slider'):
                    $output .= $this->slider($item);
                    break;
                    
                case ('sorter'):
                    $output .= $this->sorter($item);
                    break;
                    
                case ('StartSection'):
                    $output .= $this->startSection($item);
                    break;
                    
                case ('EndSection'):
                    $output .= $this->endSection($item);
                    break;
                    
                case ('info'):
                    $output .= $this->info($item);
                    break;
                }
            }
            return $output;
        }
        
        /**
         * Wordpress Taxonomies
         * 
         * @param string $option Option Name to Get.
         * @param array  $extra  Extrat Options.
         * 
         * @since 1.0
         * @author vahidd
         * @return mixed
         */
        public static function get($option = '', $extra = array())
        {
            global $wpdb;
            $output = array();
            if ($option == 'categories') {
                $categories = get_categories();
                foreach ($categories as $cat) {
                    $output[$cat->term_id] = $cat->name;
                }
            } else if ($option == 'tags') {
                $tags = get_tags((array) $extra);
                foreach ($tags as $tag) {
                    $output[$tag->term_id] = $tag->name;
                }
            } else if ($option == 'users') {
                if (!is_array($extra) || count($extra) == 0) {
                    $extra = array(
                        'orderby' => 'post_count',
                        'order' => 'DESC'
                    );
                }
                if (function_exists('wp_get_current_user')) {
                    $users = new WP_User_Query((array) $extra);
                    foreach ($users->results as $user) {
                        $output[$user->data->ID] = $user->data->display_name;
                    }
                }
            } else if ($option == 'posts') {
                $posts = get_posts((array) $extra);
                foreach ($posts as $post) {
                    $output[$post->ID] = $post->post_title;
                }
            } else if ($option == 'pages') {
                $pages = get_pages((array) $extra);
                foreach ($pages as $page) {
                    $output[$page->ID] = $page->post_title;
                }
            } else if ($option == 'post_types') {
                $output = get_post_types((array) $extra);
            } else if ($option == 'taxonomies') {
                $taxonomies = get_taxonomies((array) $extra, 'objects');
                foreach ($taxonomies as $taxonomy_name => $taxonomy_data) {
                    $output[$taxonomy_name] = $taxonomy_data->labels->name;
                }
            } else if ($option == 'plugins') {
                if (!function_exists('get_plugin_data')) {
                    include_once ABSPATH . '/wp-admin/includes/plugin.php';
                }    
                $plugins = get_option('active_plugins');
                foreach ($plugins as $plugin) {
                    $plugin_data     = get_plugin_data(WP_PLUGIN_DIR . '/' . $plugin);
                    $output[$plugin] = $plugin_data['Name'];
                }
            }
            return $output;
        }
        
        /**
         * Make Local Path from URL
         * 
         * @param string $url The URL to Make Local Path.
         * 
         * @since 1.0
         * @author vahidd
         * @return string
         */
        public function localPath($url)
        {
            $urlParts = parse_url($url);
            return $_SERVER['DOCUMENT_ROOT'] . ltrim($urlParts['path'], '/');
        }
        
        /**
         * Get All Available Google Fonts
         * 
         * @param string $sort The Type of Sorting Fonts.
         * 
         * @since 1.0
         * @author vahidd
         * @return array
         */
        static function getGoogleFonts($sort = 'alpha')
        {
            $fonts_transient = unserialize(get_transient('ipanel_googleFonts'));
            if ($fonts_transient === false) {
                $response = wp_remote_get(
                    'https://www.googleapis.com/webfonts/v1/webfonts?sort=popularity&key=AIzaSyDXgT0NYjLhDmUzdcxC5RITeEDimRmpq3s',
                    array(
                        'sslverify' => false
                    )
                );
                if (!is_wp_error($response)) {
                    $fonts      = json_decode($response['body']);
                    $fonts_list = array();
                    foreach ($fonts->items as $font) {
                        $key              = str_replace(' ', '+', $font->family);
                        $fonts_list[$key] = $font->family;
                    }
                    set_transient('ipanel_googleFonts', serialize($fonts_list), 60 * 60 * 24 * 2); // Cache 2 days
                    if ($sort == 'alpha') {
                        asort($fonts_list);
                    }    
                    return $fonts;
                }
            } else {
                if ($sort == 'alpha') {
                    asort($fonts_transient);
                }    
                return $fonts_transient;
            }
        }
        
        /**
         * Option Page Callback Function
         * 
         * @since 1.0
         * @author vahidd
         * @return string
         */
        public function menuPage()
        {
            $livePreview = isset($this->args['live_preview']) && self::isURL($this->args['live_preview']) && $this->args['live_preview'] !== false;
            ?>
            <div class="ipanel-form-stuff" style="margin-top: 40px;">

                <button class="ipanel-button ipanel-button-orange ipanel-save-settings"><i class="ipanel-white-icon save"></i> <?php echo __('Save', $this->text_domain); ?></button>
                <h1 class="theme-cp-title"><?php echo $this->args['menu']['page_title']; ?></h1>
                <a class="ipanel-button ipanel-button-green ipanel-more-themes" target="_blank" href="http://magniumthemes.com/themes/?from=mswp_cp"><?php echo __('More themes', $this->text_domain); ?></a>
                <button class="ipanel-button ipanel-button-white ipanel-reset-settings"><i class="ipanel-black-icon trash"></i> <?php echo __('Reset', $this->text_domain); ?></button>
                <?php if ($livePreview) {
                        echo '<button class="ipanel-button ipanel-button-white ipanel-toggle-preview"><i class="ipanel-black-icon eye"></i> '.__('Toggle Preview', $this->text_domain).'</button>'; 
                    } 
                ?>
                <div class="clr"></div>
            </div>
            <!-- Start Main Container -->
            <div class="ipanel-wrap" id="IPANEL" data-panelid="<?php echo $this->args["ID"]; ?>">
                <table cellspacing="0">
                    <tr>
                        <td class="ipanel-tabs-list" id="<?php echo $this->args["ID"]; ?>-tabs-list">
                            <div>
                            <!-- Left Side-->
                                <div id="ipanel-tabs">
                                    <ul>
                                        <?php echo $this->generateTabs(); ?>
                                    </ul>
                                </div>
                                <!-- Left Side-->
                            </div>
                        </td>
                        <td id="ipanel-fields-container">
                            <div>
                                <!-- Fields Container -->
                                    <form id="ipanel-settings-form">
                                        <?php echo $this->generateFields($this->args['fields']); ?>
                                    </form>
                                <!-- Fields Container -->
                            </div>    
                        </td>
                    </tr>
                </table>
            </div>    
            <?php if ($livePreview) { ?>
            <div id="ipanel-preview-wrap" style="display:none;">
                <div class="ipanel-devices-nav">
                    <ul>
                        <li class="desktop"></li>
                        <li class="tablet"></li>
                        <li class="phone"></li>
                    </ul>
                </div>
                
                <div class="imac ipanel-device" id="ipanel-preview-desktop">
                    <iframe src="<?php echo $this->args['live_preview']; ?>" frameborder="0" width="1010" height="573"><?php echo __("Your browser doesn't support iframes.", $this->text_domain); ?></iframe>
                </div>
                
                <div class="ipad ipanel-device" id="ipanel-preview-tablet">
                    <iframe src="<?php echo $this->args['live_preview']; ?>" frameborder="0" width="767" height="1037"><?php echo __("Your browser doesn't support iframes.", $this->text_domain); ?></iframe>
                </div>
                
                <div class="iphone ipanel-device" id="ipanel-preview-phone">
                    <iframe src="<?php echo $this->args['live_preview']; ?>" frameborder="0" width="642" height="1127"><?php echo __("Your browser doesn't support iframes.", $this->text_domain); ?></iframe>
                </div>

            </div>
            <?php } ?>
            <div class="ipanel-form-stuff">
                <input type="hidden" id="ipanel_ajax_nonce" value="<?php echo wp_create_nonce("ipanel_nonce"); ?>" />
                <button class="ipanel-button ipanel-button-orange ipanel-save-settings"><i class="ipanel-white-icon save"></i> <?php echo __('Save', $this->text_domain); ?></button>
                <div class="theme-copyright">Theme developed by <a href="http://magniumthemes.com/?from=mswp_cp_copy" target="_blank">Magnium Themes Company</a></div>
                <a class="ipanel-button ipanel-button-green ipanel-more-themes" target="_blank" href="http://magniumthemes.com/themes/?from=mswp_cp"><?php echo __('More themes', $this->text_domain); ?></a>
                <button class="ipanel-button ipanel-button-white ipanel-reset-settings"><i class="ipanel-black-icon trash"></i> <?php echo __('Reset', $this->text_domain); ?></button>
                <?php             if ($livePreview) { ?>
                <button class="ipanel-button ipanel-button-white ipanel-toggle-preview"><i class="ipanel-black-icon eye"></i> <?php echo __('Toggle Preview', $this->text_domain); ?></button>
                <?php                   } ?>
                <div class="clr"></div>
            </div>
            <!-- Main Container -->
            <?php
        }
        
        
        /**
         * Generate Repeater Fields
         * 
         * @param array $Repeater Repeater Fields.
         * @param array $Options  Repeater Options.
         * 
         * @since 1.0
         * @author vahidd
         * @return string
         */
        public function generateRepeaterFields($Repeater, $Options)
        {
            $output = '';
            
            switch ($Repeater['type']) {
                
            case ('text'):
                $output .= $this->text($Repeater, $Options);
                break;
                
            case ('textarea'):
                $output .= $this->textArea($Repeater, $Options);
                break;
                
            case ('media'):
                $output .= $this->mediaUploader($Repeater, $Options);
                break;
                
            case ('qup'):
                $output .= $this->quickUpload($Repeater, $Options);
                break;
                
            case ('typography'):
                $output .= $this->typography($Repeater, $Options);
                break;
                
            case ('multiselect'):
                $output .= $this->multiSelect($Repeater, $Options);
                break;
                
            case ('select'):
                $output .= $this->select($Repeater, $Options);
                break;
                
            case ('multicheckbox'):
                $output .= $this->multiCheckbox($Repeater, $Options);
                break;
                
            case ('checkbox'):
                $output .= $this->checkbox($Repeater, $Options);
                break;
                
            case ('cleditor'):
                $output .= $this->cleditor($Repeater, $Options);
                break;
                
            case ('radio'):
                $output .= $this->radio($Repeater, $Options);
                break;
                
            case ('date'):
                $output .= $this->datePicker($Repeater, $Options);
                break;
                
            case ('color'):
                $output .= $this->colorPicker($Repeater, $Options);
                break;
                
            case ('image'):
                $output .= $this->imageSelect($Repeater, $Options);
                break;
            }
            
            return $output;
        }
        
        /*
         * The Sections Container Tag
         * @var string
         */
        var $section_container_tag = 'div';
        
        /*
         * The Sections Container Tag Classess
         * @var string
         */
        var $section_container_classes = 'ipanel-field-section';
        
        
        /*
         * The Labels Container Tag
         * @var string
         */
        var $label_container_tag = 'div';
        
        /*
         * The Labels Container Tag Classess
         * @var string
         */
        var $label_container_tag_classes = 'ipanel-label';
        
        
        /*
         * The Input Container Tag
         * @var string
         */
        var $input_container_tag = 'div';
        
        /*
         * The Input Container Tag Classess
         * @var string
         */
        var $input_container_tag_classes = 'ipanel-input';
        
        
        /*
         * The Desciption Container Tag
         * @var string
         */
        var $desc_container_tag = 'div';
        
        /*
         * The Desciption Container Tag Classess
         * @var string
         */
        var $desc_container_tag_classes = 'ipanel-description';
        
        
        /**
         * Generate Field Section
         * 
         * @param array  $field_options      The options of Field.
         * @param string $input              The Input String.
         * @param string $input_custom_class Custom Class for Input.
         * 
         * @author vahidd
         * @since 1.0
         * @return string
         */
        private function _fieldSection($field_options = array(), $input = '', $input_custom_class = '')
        {
            $costum_class = @$field_options['repeater_item'] === true ? ' ipanel-repeater-field' : '';
            $costum_class .= empty($field_options['field_options']['custom_class']) ? '' : ' ' . $field_options['field_options']['custom_class'];
            $filed_id            = isset($field_options['id']) ? 'id="ipanel-field-section-' . $field_options['id'] . '"' : '';
            $container_start_tag = "\n" . '<' . $this->section_container_tag . ' class="ipanel-' . $field_options['type'] . '-field ' . $this->section_container_classes . $costum_class . '" ' . $filed_id . ' >' . "\n";
            $container_end_tag   = '</' . $this->section_container_tag . '>' . "\n";
            $label_start         = '  <' . $this->label_container_tag . ' class="' . $this->label_container_tag_classes . '">' . "\n";
            $label               = '    <label>' . $field_options['name'] . '</label>' . "\n";
            $label_end           = '  </' . $this->label_container_tag . '>' . "\n";
            $input_start         = '  <' . $this->input_container_tag . ' class="' . $this->input_container_tag_classes . $input_custom_class . '">' . "\n";
            $input_end           = '  </' . $this->input_container_tag . '>' . "\n";
            if (isset($field_options['desc'])) {
                if (isset($field_options['field_options']['desc_in_tooltip']) && $field_options['field_options']['desc_in_tooltip'] === true) {
                    $desc_start = '  <' . $this->desc_container_tag . ' class="' . $this->desc_container_tag_classes . ' ipanel-field-description-icon">' . "\n";
                    $desc       = '    <div>' . $field_options['desc'] . '</div>' . "\n";
                    ;
                    $desc .= '    <i class="ipanel-description-icon"> </i> <div class="clr"></div>' . "\n";
                    $desc .= '<div style="display:none;" class="tooltip_data">' . $field_options['desc'] . '</div>';
                    $desc_end = '  </' . $this->desc_container_tag . '>' . "\n";
                } else {
                    $desc_start = '  <' . $this->desc_container_tag . ' class="' . $this->desc_container_tag_classes . '">' . "\n";
                    $desc       = '    <div>' . $field_options['desc'] . '</div>' . "\n";
                    $desc_end   = '  </' . $this->desc_container_tag . '>' . "\n";
                }
            } else {
                $desc_start = '';
                $desc       = '';
                $desc_end   = '';
            }
            return $container_start_tag . $label_start . $label . $label_end . $input_start . $input . $input_end . $desc_start . $desc . $desc_end . $container_end_tag;
        }
        
        /**
         * Generete the Beginning of Tab
         *
         * @param array $options The Options of Tab.
         *
         * @author vahidd
         * @since 1.0
         * @return string
         */
        public function startTab($options = null)
        {
            $output = '';
            $output .= '<!-- Start Tab - ' . $options['id'] . ' --><div class="ipanel-tabs" id="ipanel-' . $options['id'] . '">';
            return $output;
        }
        
        /**
         * Generete the Ending of Tab
         * 
         * @author vahidd
         * @return string
         * @since 1.0
         */
        public function endTab()
        {
            return '</div><!-- Tab End -->';
        }
        
        /**
         * Generete the Ending of Tab
         * 
         * @param array $options Conditional Logic Options.
         * 
         * @author vahidd
         * @return string
         * @since 1.1
         */
        public function conditionalLogic($options)
        {
            $custom_js = '';
            if (isset($options['field_options']['conditional_logic']) && is_array($options['field_options']['conditional_logic'])) {
                foreach ($options['field_options']['conditional_logic'] as $logic) {
                    
                    $targetID = '';
                    foreach ((array) $logic['target_ID'] as $ID) {
                        $targetID .= '#ipanel-field-section-'.$ID.',';
                    }
                    
                    $custom_js .= '<script type="text/javascript">(function($) {';
                    $custom_js .= '$("body")';
                    $custom_js .= '.on("'.$logic['event'].'", "#ipanel-field-section-'.$options['id'].' :input", function(){';
                    
                    $custom_js .= 'if ($("#ipanel-field-section-'.$options['id'].' :input").val() == "'.$logic['value'].'")';
                    $custom_js .= $logic['action'] == 'show' ? '$("'.rtrim($targetID, ",").'").animate({"height":"show","opacity":"show"},function(){'.@$logic['callback'].'});' : '$("'.rtrim($targetID, ",").'").animate({"height":"hide","opacity":"hide"},function(){'.@$logic['callback'].'});';
                    
                    $custom_js .= '});';
                    $custom_js .= '})(jQuery);</script>';
                }    
            }
            return $custom_js;
        }
        
        /**
         * Generate Text Field
         *
         * @param array $options  Field Options Array.
         * @param array $Repeater Repeater Options for Field.
         *
         * @author vahidd
         * @return string
         * @since 1.0
         */
        public function text($options = null, $Repeater = array())
        {
            if (count($Repeater)) {
                $value = isset($Repeater['value']) ? $Repeater['value'] : '';
            } else {
                $value = $this->getOption($options['id']);
            }
            if (isset($options['repeater_item']) && $options['repeater_item'] === true) {
                $option_name = $Repeater['id'] . '[' . $Repeater['pos'] . '][' . $options['id'] . ']';
            } else {
                $option_name = $options['id'];
            }    
            $width = empty($options['field_options']['width']) ? '' : $options['field_options']['width'] . 'px';
            $input = '    <input type="text" name="' . $option_name . '" value="' . $value . '" style="width:' . $width . '" />' . "\n";
            $input .= $this->conditionalLogic($options);
            if (isset($options['repeater_item']) && $options['repeater_item'] === true) {
                return '<div class="ipanel-repeater-option ipanel-repeater-' . $options['type'] . '"><label>' . $options['name'] . '<br/>' . $input . '</label></div>';
            }
            return $this->_fieldSection($options, $input);
        }
        
        /**
         * Generate Textarea
         *
         * @param array $options  Field Options Array.
         * @param array $Repeater Repeater Options for Field.
         *
         * @author vahidd
         * @return string
         * @since 1.0
         */
        public function textArea($options = null, $Repeater = array())
        {
            if (count($Repeater)) {
                $value = isset($Repeater['value']) ? $Repeater['value'] : '';
            } else {
                $value = $this->getOption($options['id']);
            }
            if (isset($options['repeater_item']) && $options['repeater_item'] === true) {
                $option_name = $Repeater['id'] . '[' . $Repeater['pos'] . '][' . $options['id'] . ']';
            } else {
                $option_name = $options['id'];
            }    
            $styles = 'style="';
            $styles .= empty($options['field_options']['width']) ? '' : 'width:' . $options['field_options']['width'].';';
            $styles .= empty($options['field_options']['height']) ? '' : 'height:' . $options['field_options']['height'].';';
            $styles .= '"';
            $input = '    <textarea name="' . $option_name . '" ' . $styles . '>' . $value . '</textarea>' . "\n";
            $input .= $this->conditionalLogic($options);
            if (isset($options['repeater_item']) && $options['repeater_item'] === true) {
                return '<div class="ipanel-repeater-option ipanel-repeater-' . $options['type'] . '"><label>' . $options['name'] . '<br/>' . $input . '</label></div>';
            }
            return $this->_fieldSection($options, $input);
        }
        
        /**
         * Generate Color Picker
         *
         * @param array $options  Field Options Array.
         * @param array $Repeater Repeater Options for Field.
         *
         * @author vahidd
         * @return string
         * @since 1.0
         */
        public function colorPicker($options = null, $Repeater = array())
        {
            if (count($Repeater)) {
                $value = isset($Repeater['value']) ? $Repeater['value'] : '';
            } else {
                $value = $this->getOption($options['id']);
            }            
            if (isset($options['repeater_item']) && $options['repeater_item'] === true) {
                $option_name = $Repeater['id'] . '[' . $Repeater['pos'] . '][' . $options['id'] . ']';
            } else {
                $option_name = $options['id'];
            }
            $input = '    <input type="text" name="' . $option_name . '" value="' . $value . '" class="ipanel-color-picker"/>' . "\n";
            $input .= '<div class="ipanel-color-picker-preview" style="background-color:'.$value.'"></div>';
            $input .= '<div class="clr"></div>';
            $input .= $this->conditionalLogic($options);
            if (isset($options['repeater_item']) && $options['repeater_item'] === true) {
                return '<div class="ipanel-repeater-option ipanel-repeater-' . $options['type'] . '"><label>' . $options['name'] . '<br/>' . $input . '</label></div>';
            }
            return $this->_fieldSection($options, $input);
        }

        /**
         * Generate Checkbox Field
         *
         * @param array $options  Field Options Array.
         * @param array $Repeater Repeater Options for Field.
         *
         * @author vahidd
         * @return string
         * @since 1.0
         */
        public function checkbox($options = null, $Repeater = array())
        {
            if (isset($Repeater['value'])) {
                $value = $Repeater['value'];
            } else {
                $value = $this->getOption($options['id']);
            }
            if (!is_bool($value)) {
                $value = false;
            }    
            if (isset($options['repeater_item']) && $options['repeater_item'] === true) {
                $option_name = $Repeater['id'] . '[' . $Repeater['pos'] . '][' . $options['id'] . ']';
            } else {
                $option_name = $options['id'];
            }    
            $checked        = $value === true ? "checked='checked'" : '';
            $checkbox_label = empty($options['field_options']['input_label']) ? $options['name'] : $options['field_options']['input_label'];
            if (isset($options['repeater_item']) && $options['repeater_item'] === true) {
                $input = '    <input type="checkbox" name="' . $option_name . '" ' . $checked . ' />' . "\n";
            } else { 
                $input = '    <label>' . $checkbox_label . ' <input type="checkbox" name="' . $option_name . '" ' . $checked . ' /></label>' . "\n";
            }
            $input .= $this->conditionalLogic($options);
            if (isset($options['repeater_item']) && $options['repeater_item'] === true) {
                return '<div class="ipanel-repeater-option ipanel-repeater-' . $options['type'] . '"><label>' . $checkbox_label . $input . '</label></div>';
            }
            return $this->_fieldSection($options, $input);
        }
        
        /**
         * Generate MultiCheckbox Field
         *
         * @param array $options  Field Options Array.
         * @param array $Repeater Repeater Options for Field.
         *
         * @author vahidd
         * @return string
         * @since 1.0
         */
        public function multiCheckbox($options = null, $Repeater = array())
        {
            if (isset($Repeater['value'])) {
                $value = $Repeater['value'];
            } else {
                $value = $this->getOption($options['id']);
            }
            if (!is_array($value)) {
                $value = array();
            }
            if (isset($options['repeater_item']) && $options['repeater_item'] === true) {
                $option_name = $Repeater['id'] . '[' . $Repeater['pos'] . '][' . $options['id'] . ']';
            } else {
                $option_name = $options['id'];
            }    
            $input = '';
            foreach ($options['options'] as $ikey => $ivalue) {
                $ckhecked = in_array($ikey, $value) ? 'checked="checked"' : '';
                $input .= '    <label>' . $ivalue . '<input type="checkbox" id="multiCheckbox_' . $ikey . '" name="' . $option_name . '[' . $ikey . ']" ' . $ckhecked . '/></label>' . "\n";
            }
            $input .= $this->conditionalLogic($options);
            if (isset($options['repeater_item']) && $options['repeater_item'] === true) {
                return '<div class="ipanel-repeater-option ipanel-repeater-' . $options['type'] . '"><label>' . $options['name'] . '</label><br/>' . $input . '</div>';
            }
            return $this->_fieldSection($options, $input);
        }
        
        /**
         * Generate Slider Field
         *
         * @param array $options  Field Options Array.
         * @param array $Repeater Repeater Options for Field.
         *
         * @author vahidd
         * @return string
         * @since 1.0
         */
        public function slider($options = null, $Repeater = array())
        {
            if (count($Repeater)) {
                $value = isset($Repeater['value']) ? $Repeater['value'] : '';
            } else {
                $value = $this->getOption($options['id']);
            }    
            if (isset($options['repeater_item']) && $options['repeater_item'] === true) {
                $option_name = $Repeater['id'] . '[' . $Repeater['pos'] . '][' . $options['id'] . ']';
            } else {
                $option_name = $options['id'];
            }    
            $_dimension = empty($options['field_options']['dimension']) ? '' : $options['field_options']['dimension'];
            $_min       = is_numeric(@$options['field_options']['min']) ? $options['field_options']['min'] : 0;
            $_max       = is_numeric(@$options['field_options']['max']) ? $options['field_options']['max'] : 100;
            $_step      = is_numeric(@$options['field_options']['step']) ? $options['field_options']['step'] : 1;
            $_animation = @$options['field_options']['animation'] === false ? 'disable' : 'enable';
            $input      = '    <div class="ipanel-slider-slider" data-dimension="' . $_dimension . '" data-animation="' . $_animation . '" data-val="' . $value . '" data-min="' . $_min . '" data-max="' . $_max . '" data-step="' . $_step . '"></div>' . "\n";
            $input .= '<input type="hidden" class="ipanel-slider-input" name="' . $option_name . '" value="' . $value . '"/>';
            $input .= $this->conditionalLogic($options);
            if (isset($options['repeater_item']) && $options['repeater_item'] === true) {
                return '<div class="ipanel-repeater-option ipanel-repeater-' . $options['type'] . '"><label>' . $options['name'] . '<br/>' . $input . '</label></div>';
            }
            return $this->_fieldSection($options, $input);
        }
        
        /**
         * Generate Date Picker
         *
         * @param array $options  Field Options Array.
         * @param array $Repeater Repeater Options for Field.
         *
         * @author vahidd
         * @return string
         * @since 1.0
         */
        public function datePicker($options = null, $Repeater = array())
        {
            if (count($Repeater)) {
                $value = isset($Repeater['value']) ? $Repeater['value'] : '';
            } else {
                $value = $this->getOption($options['id']);
            }
            if (isset($options['repeater_item']) && $options['repeater_item'] === true) {
                $option_name = $Repeater['id'] . '[' . $Repeater['pos'] . '][' . $options['id'] . ']';
            } else {
                $option_name = $options['id'];
            }
            $width       = empty($options['field_options']['width']) ? '30' : $options['field_options']['width'];
            $date_format = empty($options['field_options']['dateFormat']) ? 'mm/dd/yy' : $options['field_options']['dateFormat'];
            $input       = '    <input type="text" name="' . $option_name . '" value="' . $value . '" class="ipanel-date-picker" size="' . $width . '" data-ipanel-date-format="' . $date_format . '"/>' . "\n";
            $input .= $this->conditionalLogic($options);
            if (isset($options['repeater_item']) && $options['repeater_item'] === true) {
                return '<div class="ipanel-repeater-option ipanel-repeater-' . $options['type'] . '"><label>' . $options['name'] . '<br/>' . $input . '</label></div>';
            }
            return $this->_fieldSection($options, $input);
        }
        
        /**
         * Generate Sorter
         *
         * @param array $options Field Options Array.
         *
         * @author vahidd
         * @return string
         * @since 1.0
         */
        public function sorter($options = null)
        {
            $value       = is_array($this->getOption($options['id'])) ? $this->getOption($options['id']) : false;
            $option_name = $options['id'];
            $input       = '';
            $groups_id   = '';
            if ($value !== false) {
                $itemsNum = count($options['options']);
                $i        = 0;
                $width    = 620 / $itemsNum;
                $width    = $width - 20;
                foreach ($options['options'] as $group_id => $group) {
                    $i++;
                    if ($itemsNum !== $i) {
                        $margin = 'margin-right: 15px;';
                    } else {
                        $margin = '';
                    }
                    $groups_id .= '#ipanel_sorter_' . $option_name . '_' . $group_id . ', ';
                    $input .= "\n" . '<div style="width:' . $width . 'px;' . $margin . '" class="ipanel-sorter-block-container">';
                    $input .= '<h3>' . $group['label'] . '</h3>';
                    $input .= '<ul id="ipanel_sorter_' . $option_name . '_' . $group_id .'" class="ipanel_sorter_' . $option_name . ' ipanel-sorter-block" data-group="' . $group_id . '" data-itemsclass="'.(isset($group['items_class'])?$group['items_class']:'').'">' . "\n";
                    foreach ($value[$group_id] as $item_key => $item_val) {
                        $input .= '  <li class="'.(isset($group['items_class'])?$group['items_class']:'').'">' . $item_val . ' <input type="hidden" name="' . $option_name . '[' . $group_id . '][' . $item_key . ']" class="ipanel_sorter_hidden_input" value="' . $item_val . '" /></li>' . "\n";
                    }
                    $input .= '</ul></div>' . "\n" . "\n";
                }
                $input .= '<div class="clr"></div>';
            } else {
                $itemsNum = count($options['options']);
                $i        = 0;
                $width    = 570 / $itemsNum;
                $width    = $width - 20;
                foreach ($options['options'] as $group_id => $group) {
                    $i++;
                    if ($itemsNum !== $i) {
                        $margin = 'margin-right: 20px;';
                    } else {
                        $margin = '';
                    }
                    $groups_id .= '#ipanel_sorter_' . $option_name . '_' . $group_id . ', ';
                    $input .= "\n" . '<div style="width:' . $width . 'px;' . $margin . '" class="ipanel-sorter-block-container">';
                    $input .= "\n" . '<h3>' . $group['label'] . '</h3>';
                    $input .= "\n" . '<ul id="ipanel_sorter_' . $option_name . '_' . $group_id .'" data-group="' . $group_id . '" data-itemsclass="'.(isset($group['items_class'])?$group['items_class']:'').'" class="ipanel_sorter_' . $option_name . ' ipanel-sorter-block">' . "\n";
                    foreach ($group['items'] as $item_key => $item_val) {
                        $input .= '  <li class="'.(isset($group['items_class'])?$group['items_class']:'').'">' . $item_val . ' <input type="hidden" name="' . $option_name . '[' . $group_id . '][' . $item_key . ']" class="ipanel_sorter_hidden_input" value="' . $item_val . '" /></li>' . "\n";
                    }
                    $input .= '</ul></div>' . "\n" . "\n";
                }
                $input .= '<div class="clr"></div>';
            }
            $groups_id = rtrim(trim($groups_id), ',');
            $_delay    = is_numeric(@$options['field_options']['delay']) ? $options['field_options']['delay'] : 0;
            $_revert   = isset($options['field_options']['revert']) ? $options['field_options']['revert'] : 100;
            $input .= '<script type="text/javascript">' . "\n";
            $input .= 'jQuery(function  ($) {';
            $input .= '$( "' . $groups_id . '" ).sortable({
                        connectWith: ".ipanel_sorter_' . $option_name . '",
                        start: function( event, ui ) {
                          ui.item.siblings(".ipanel-sorter-placeholder").height( ui.item.height());
                        },
                        update: function( event, ui ) {
                          ui.item.find(".ipanel_sorter_hidden_input").attr("name",function(o,n){ 
                            var _mbc = n.split("[")[1].split("]")[0];
                            var _new = ui.item.parent("ul").data("group");
                            return n.replace( _mbc, _new);
                          });
                          ui.item.removeAttr("class").addClass( ui.item.parent().data("itemsclass") );
                        },
                        placeholder: "ipanel-sorter-placeholder",
                        revert: ' . $_revert . ',
                        helper: "clone",
                        delay: ' . $_delay . ',
                        scroll: false
                        }).disableSelection();';

            $input .= '});';
            $input .= "\n" . '</script>';
            return $this->_fieldSection($options, $input);
        }
        
        /**
         * Generate Code Editor
         *
         * @param array $options Field Options Array.
         *
         * @author vahidd
         * @return string
         * @since 1.0
         */
        public function codeEditor($options = null)
        {
            $value = $this->getOption($options['id']);
            if (empty($options['field_options']['language'])) {
                $_lang_ = 'text/html';
            } else {
                switch ($options['field_options']['language']) {
                case ('xml'):
                case ('html'):
                    $_lang_ = 'text/html';
                    break;
                    
                case ('javascript'):
                case ('json'):
                case ('js'):
                    $_lang_ = 'text/javascript';
                    break;
                    
                case ('php'):
                    $_lang_ = 'application/x-httpd-php';
                    break;
                    
                case ('css'):
                    $_lang_ = 'text/css';
                    break;
                    
                case ('sql'):
                    $_lang_ = 'text/x-sql';
                    break;
                    
                default:
                    $_lang_ = 'text/html';
                    break;
                }
            }
            $_line_numbers_      = @$options['field_options']['line_numbers'] === true ? 'enable' : 'disable';
            $_autoCloseBrackets_ = @$options['field_options']['autoCloseBrackets'] === true ? 'enable' : 'disable';
            $_autoCloseTags_     = @$options['field_options']['autoCloseTags'] === true ? 'enable' : 'disable';
            $_place_holder_      = empty($options['field_options']['placeholder']) ? '' : 'placeholder="' . $options['field_options']['placeholder'] . '"';
            $input               = '    <textarea class="ipanel-code-editor" name="' . $options['id'] . '" data-lang="' . $_lang_ . '" data-line-numbers="' . $_line_numbers_ . '" data-auto-close-brackets="' . $_autoCloseBrackets_ . '" data-auto-close-tags="' . $_autoCloseTags_ . '" ' . $_place_holder_ . '>' . $value . '</textarea>' . "\n";
            return $this->_fieldSection($options, $input);
        }
        
        /**
         * Generate Custom WYSIWYG Editor (cleditor)
         *
         * @param array $options  Field Options Array.
         * @param array $Repeater Repeater Options for Field.
         *
         * @author vahidd
         * @return string
         * @since 1.0
         */
        public function cleditor($options = null, $Repeater = array())
        {
            if (isset($Repeater['value'])) {
                $value = $Repeater['value'];
            } else {
                $value = $this->getOption($options['id']);
            }
            if (isset($options['repeater_item']) && $options['repeater_item'] === true) {
                $option_name = $Repeater['id'] . '[' . $Repeater['pos'] . '][' . $options['id'] . ']';
            } else {
                $option_name = $options['id'];
            }
            $width = (isset($options['field_options']['width']) && is_numeric($options['field_options']['width'])) ? $options['field_options']['width'] : 595;
            $input = '    <textarea name="' . $option_name . '" class="ipanel-cleditor" data-width="' . $width . '">' . $value . '</textarea>' . "\n";
            if (isset($options['repeater_item']) && $options['repeater_item'] === true) {
                return '<div class="ipanel-repeater-option ipanel-repeater-' . $options['type'] . '"><label>' . $options['name'] . '<br/>' . $input . '</label></div>';
            }
            return $this->_fieldSection($options, $input);
        }
        
        
        /**
         * Generate Select Field
         *
         * @param array $options  Field Options Array.
         * @param array $Repeater Repeater Options for Field.
         *
         * @author vahidd
         * @return string
         * @since 1.0
         */
        public function select($options = null, $Repeater = array())
        {
            if (isset($options['options'])) {
                if (count($Repeater) > 0) {
                    $value = isset($Repeater['value']) ? $Repeater['value'] : array();
                } else {
                    $value = $this->getOption($options['id']);
                }
                if (isset($options['repeater_item']) && $options['repeater_item'] === true) {
                    $option_name = $Repeater['id'] . '[' . $Repeater['pos'] . '][' . $options['id'] . ']';
                } else {
                    $option_name = $options['id'];
                }
                $width       = (isset($options['field_options']['width']) && is_numeric($options['field_options']['width'])) ? $options['field_options']['width'] : 41;
                $field_class = empty($options['field_options']['input_class']) ? '' : 'class="' . $options['field_options']['input_class'] . '"';
                $input       = '    <select name="' . $option_name . '" ' . $field_class . ' data-width="' . $width . '">' . "\n";
                foreach ($options['options'] as $ikey => $ivalue) {
                    $selected = $this->selected($value, $ikey);
                    $input .= '        <option value="' . $ikey . '" ' . $selected . ' >' . $ivalue . '</option>' . "\n";
                }
                $input .= '    </select>' . "\n";
                $input .= $this->conditionalLogic($options);
                if (isset($options['repeater_item']) && $options['repeater_item'] === true) {
                    return '<div class="ipanel-repeater-option ipanel-repeater-' . $options['type'] . '"><label>' . $options['name'] . '<br/>' . $input . '</label></div>';
                }
                return $this->_fieldSection($options, $input);
            }
        }
        
        /**
         * Generate Select Field
         *
         * @param array $options  Field Options Array.
         * @param array $Repeater Repeater Options for Field.
         *
         * @author vahidd
         * @return string
         * @since 1.0
         */
        public function imageSelect($options = null, $Repeater = array())
        {
            if (isset($options['options'])) {
                if (count($Repeater) > 0) {
                    $value = isset($Repeater['value']) ? $Repeater['value'] : array();
                } else {
                    $value = $this->getOption($options['id']);
                }
                if (isset($options['repeater_item']) && $options['repeater_item'] === true) {
                    $option_name = $Repeater['id'] . '[' . $Repeater['pos'] . '][' . $options['id'] . ']';
                } else {
                    $option_name = $options['id'];
                }
                $input = '';
                foreach ($options['options'] as $option_key => $option_value) {
                    $checked = $value == $option_key ? 'checked="checked"' : '';
                    $input .= '    <label class="ipanel-image-field-label">';
                    $input .= '<img src="' . $option_value['image'] . '" title="' . $option_value['label'] . '" alt="' . $option_value['label'] . '" class="ipanel-image-select-image"/> ';
                    $input .= '<input type="radio" value="' . $option_key . '" name="' . $option_name . '" ' . $checked . ' class="ipanel-image-field-radio"/>';
                    $input .= '<div class="ipanel-checked-icon"></div>';
                    $input .= '</label>' . "\n";
                }
                $input .= '<div class="clr"></div>';
                $input .= $this->conditionalLogic($options);
                if (isset($options['repeater_item']) && $options['repeater_item'] === true) {
                    return '<div class="ipanel-repeater-option ipanel-repeater-' . $options['type'] . '"><label>' . $options['name'] . '</label><br/>' . $input . '</div>';
                }
                return $this->_fieldSection($options, $input);
            }
        }
        
        /**
         * Generate Multi Select Field
         *
         * @param array $options  Field Options Array.
         * @param array $Repeater Repeater Options for Field.
         *
         * @author vahidd
         * @return string
         * @since 1.0
         */
        public function multiSelect($options = null, $Repeater = array())
        {
            if (count($Repeater) > 0) {
                $value = isset($Repeater['value']) ? $Repeater['value'] : array();
            } else {
                $value = $this->getOption($options['id']);
            }
            if (!is_array($value)) {
                $value = array();
            }    
            if (isset($options['repeater_item']) && $options['repeater_item'] === true) {
                $option_name = $Repeater['id'] . '[' . $Repeater['pos'] . '][' . $options['id'] . ']';
            } else {
                $option_name = $options['id'];
            }
            $width       = (isset($options['field_options']['width']) && is_numeric($options['field_options']['width'])) ? $options['field_options']['width'] : 50;
            $field_class = empty($options['field_options']['input_class']) ? '' : 'class="' . $options['field_options']['input_class'] . '"';
            if (isset($options['options'])) {
                $input = '    <select name="' . $option_name . '" multiple="multiple" ' . $field_class . ' data-width="' . $width . '">' . "\n";
                foreach ($options['options'] as $ikey => $ivalue) {
                    $selected = in_array($ikey, $value) ? 'selected="selected"' : '';
                    $input .= '        <option value="' . $ikey . '" ' . $selected . '>' . $ivalue . '</option>' . "\n";
                }
                $input .= '    </select>' . "\n";
                $input .= $this->conditionalLogic($options);
                if (isset($options['repeater_item']) && $options['repeater_item'] === true) {
                    return '<div class="ipanel-repeater-option ipanel-repeater-' . $options['type'] . '"><label>' . $options['name'] . '<br/>' . $input . '</label></label></div>';
                }
                return $this->_fieldSection($options, $input);
            }
        }
        
        /**
         * Generate Quick Upload
         *
         * @param array $options  Field Options Array.
         * @param array $Repeater Repeater Options for Field.
         *
         * @author vahidd
         * @return string
         * @since 1.0
         */
        public function quickUpload($options = null, $Repeater = array())
        {
            if (count($Repeater)) {
                $value = isset($Repeater['value']) ? $Repeater['value'] : array(
                    'url' => '',
                    'path' => ''
                );
            } else {
                $value = is_array($this->getOption($options['id'])) ? $this->getOption($options['id']) : array(
                    'url' => '',
                    'path' => ''
                );
            }
            if (!is_file(@$value['path'])) {
                $value['path'] = $this->localPath($value['url']);
            }    
            if (isset($options['repeater_item']) && $options['repeater_item'] === true) {
                $option_name = $Repeater['id'] . '[' . $Repeater['pos'] . '][' . $options['id'] . ']';
            } else {
                $option_name = $options['id'];
            }    
            if (!empty($options['field_options']['btn_text'])) {
                $btn_text = $options['field_options']['btn_text'];
            } else {
                $btn_text = __("Choose File", $this->text_domain);
            }
            $input = '    <input type="file" name="' . preg_replace('/[^A-Z0-9a-z\w ]/u', '', 'ipanel_quick_up_' . $option_name) . '" class="ipanel-quick-up-file" />' . "\n";
            $input .= '    <label class="ipanel-select-file ipanel-button ipanel-button-white">' . $btn_text . '</label>' . "\n";
            $input .= '    <input name="' . $option_name . '[url]" class="ipanel-quick-upload-value" type="hidden" value="' . $value['url'] . '" data-filePath="">' . "\n";
            $input .= '    <input name="' . $option_name . '[path]" class="ipanel-quick-upload-filePath" type="hidden" value="' . $value['path'] . '" data-filePath="">' . "\n";
            $input .= '    <div class="ipanel-qup-progress-bar"><div class="text"></div><div class="bar"><div class="percent"></div></div></div>' . "\n";
            if (filter_var($value['url'], FILTER_VALIDATE_URL) !== false) {
                $file_    = pathinfo($value['url']);
                $is_image = preg_match('/^(gif|jpg|png)$/', $file_['extension']) === 1 ? true : false;
                if ($is_image) {
                    //File Box for Image
                    $input .= '    <div class="ipanel-quick-upload-file">' . "\n";
                    $input .= '    <img class="ipanel-qup-up-img img" src="' . $value['url'] . '" />' . "\n";
                    $input .= '    <div class="ipanel_file_info">' . "\n";
                    $input .= '    '.__('File URL', $this->text_domain).': ' . '<code>' . $value['url'] . '</code><br/><br/>' . "\n";
                    $input .= '    '.__('File Path', $this->text_domain).': ' . '<code>' . $value['path'] . '</code><br/><br/>' . "\n";
                    $input .= '    <a href="#" class="ipanel-remove-qup-file" data-filePath="' . $value['path'] . '">'.__('Delete', $this->text_domain).'</a>' . "\n";
                    $input .= '    </div>' . "\n";
                    $input .= '    <div class="clr"></div></div>' . "\n";
                } else {
                    // File Box for Other File Types
                    $input .= '    <div class="ipanel-quick-upload-file">' . "\n";
                    $input .= '    <img class="ipanel-qup-up-img" src="' . IPANEL_URI . 'assets/img/document.png" />' . "\n";
                    $input .= '    <div class="ipanel_file_info">' . "\n";
                    $input .= '    '.__('File URL', $this->text_domain).': ' . '<code>' . $value['url'] . '</code><br/><br/>' . "\n";
                    $input .= '    '.__('File Path', $this->text_domain).': ' . '<code>' . $value['path'] . '</code><br/><br/>' . "\n";
                    $input .= '    <a href="#" class="ipanel-remove-qup-file" data-filePath="' . $value['path'] . '">Delete</a>' . "\n";
                    $input .= '    </div>' . "\n";
                    $input .= '    <div class="clr"></div></div>' . "\n";
                }
            } else {
                $input .= '    <div class="ipanel-quick-upload-file" style="display:none;"></div>' . "\n";
            }
            $input .= $this->conditionalLogic($options);
            if (isset($options['repeater_item']) && $options['repeater_item'] === true) {
                return '<div class="ipanel-repeater-option ipanel-repeater-' . $options['type'] . '"><label>' . $options['name'] . '</label><br/>' . $input . '</div>';
            }
            return $this->_fieldSection($options, $input);
        }
        
        /**
         * Generate Typography Field
         *
         * @param array $options  Field Options Array.
         * @param array $Repeater Repeater Options for Field.
         *
         * @author vahidd
         * @return string
         * @since 1.0
         */
        public function typography($options = null, $Repeater = array())
        {
            if (count($Repeater)) {
                $value = isset($Repeater['value']) ? $Repeater['value'] : '';
            } else {
                $value = $this->getOption($options['id']);
            }
            if (isset($options['repeater_item']) && $options['repeater_item'] === true) {
                $option_name = $Repeater['id'] . '[' . $Repeater['pos'] . ']' . '[' . $options['id'] . ']';
            } else {
                $option_name = $options['id'];
            }
            $input            = '';
            $font_size_width  = isset($options['field_options']['font-size-chosen-width']) ? $options['field_options']['font-size-chosen-width'] : '22';
            $font_size_chosen = @$options['field_options']['font-size-chosen'] === false ? 'class="no-chosen"' : '';
            $font_size_val    = isset($value['font-size']) ? $value['font-size'] : '';
            // Font Size Field
            if (isset($options['options']['font-sizes']) && false !== $options['options']['font-sizes']) {
                $input .= '<select name="' . $option_name . '[font-size]" ' . $font_size_chosen . ' data-width="' . $font_size_width . '">';
                foreach ($options['options']['font-sizes'] as $font_size_key => $font_size_value) {
                    $selected = $font_size_val == $font_size_key ? 'selected="selected"' : '';
                    $input .= '<option value="' . $font_size_key . '" ' . $selected . '>' . $font_size_value . '</option>';
                }
                $input .= '</select>';
            }
            $font_family_width  = isset($options['field_options']['font-family-chosen-width']) ? $options['field_options']['font-family-chosen-width'] : '25';
            $font_family_chosen = @$options['field_options']['font-family-chosen'] === false ? 'class="no-chosen"' : '';
            $font_family_value  = isset($value['font-family']) ? $value['font-family'] : '';
            // Font Family Field
            if (isset($options['options']['font-families']) && false !== $options['options']['font-families']) {
                $input .= '<select name="' . $option_name . '[font-family]" ' . $font_family_chosen . ' data-width="' . $font_family_width . '">';
                
                foreach ($options['options']['font-families'] as $font_family_key => $font_family_value) {
                    $selected = $font_family_value == $font_family_key ? 'selected="selected"' : '';
                    // DedalX Fixes for save Fonts here
                    if(isset($value['font-family'])&&$value['font-family'] == $font_family_key) {
                      $input .= '<option value="' . $font_family_key . '" selected="selected">' . $font_family_value . '</option>';
                    }
                    else {
                      $input .= '<option value="' . $font_family_key . '">' . $font_family_value . '</option>';
                    }
                }
                $input .= '</select>';
            }
            $color_value = isset($value['color']) ? $value['color'] : '';
            // Color Field
            if (false !== @$options['options']['color']) {
                $input .= '<input type="text" class="ipanel-color-picker ipanel-repeater-color-picker" name="' . $option_name . '[color]" value="' . $color_value . '" />';
            }
            $font_style_width  = isset($options['field_options']['font-style-chosen-width']) ? $options['field_options']['font-style-chosen-width'] : '20';
            $font_style_chosen = @$options['field_options']['font-style-chosen'] === false ? 'class="no-chosen"' : '';
            $font_style_value  = isset($value['font-style']) ? $value['font-style'] : '';
            // Font Style
            if (isset($options['options']['font-styles']) && false !== $options['options']['font-styles']) {
                $input .= '<select name="' . $option_name . '[font-style]" data-width="' . $font_style_width . '" ' . $font_style_chosen . '>';
                foreach ($options['options']['font-styles'] as $font_style_key => $font_style_value) {
                    $selected = $font_style_value == $font_style_key ? 'selected="selected"' : '';
                    $input .= '<option value="' . $font_style_key . '" ' . $selected . '>' . $font_style_value . '</option>';
                }
                $input .= '</select>';
            }
            $input .= $this->conditionalLogic($options);
            if (isset($options['repeater_item']) && $options['repeater_item'] === true) {
                return '<div class="ipanel-repeater-option ipanel-repeater-' . $options['type'] . '"><label>' . $options['name'] . '</label><br/>' . $input . '</div>';
            }
            return $this->_fieldSection($options, $input);
        }
        
        /**
         * Generate Repeater Field
         *
         * @param array $options Field Options Array.
         *
         * @author vahidd
         * @return string
         * @since 1.0
         */
        public function repeater($options = null)
        {
            $value  = is_array($this->getOption($options['id'])) ? $this->getOption($options['id']) : array();
            $inputs = '';
            $i = 0;
            if (count($value)) { // If repeater has any item
                foreach ($value as $itemKey => $itemVal) {
                    $inputs .= '<li class="ipanel-repeater-item" data-repeaterCounter="' . $i . '">';
                    $inputs .= '<i class="ipanel-delete-icon ipanel-delete-repeater-item"></i>';
                    $inputs .= '<i class="ipanel-drag-icon ipanel-drag-repeater-item"></i>';
                    $inputs .= empty($options['field_options']['each_title']) ? '<h2 class="ipanel-repeater-title">' . __("Item", $this->text_domain) . '<span class="item_number"> ' . ($i + 1) . '</span>' . '</h2>' : '<h2 class="ipanel-repeater-title">' . sprintf($options['field_options']['each_title'], '<span class="item_number">' . $i + 1 . '</span>') . '</h2>';
                    $inputs .= '<div class="ipanel-repeater-fields">';
                    foreach ($itemVal as $inputItemKey => $inputItem) {
                        $inputs .= $this->generateRepeaterFields(
                            $this->repeaterFieldByID($options['options'], $inputItemKey), 
                            array(
                                'value' => $inputItem,
                                'id' => $options['id'],
                                'pos' => $itemKey
                            )
                        );
                    }
                    $inputs .= '</div>';
                    $inputs .= '<div class="clr"></div></li>';
                    $i++;
                }
            } else {
                $inputs .= '<li class="ipanel-repeater-item" data-repeaterCounter="0">';
                $inputs .= '<i class="ipanel-delete-icon ipanel-delete-repeater-item"></i>';
                $inputs .= '<i class="ipanel-drag-icon ipanel-drag-repeater-item"></i>';
                $inputs .= empty($options['field_options']['each_title']) ? '<h2 class="ipanel-repeater-title">' . __("Item", $this->text_domain) . ' 1' . '</h2>' : '<h2 class="ipanel-repeater-title">' . sprintf($options['field_options']['each_title'], '1') . '</h2>';
                $inputs .= '<div class="ipanel-repeater-fields">';
                foreach ($options['options'] as $value2) {
                    $inputs .= $this->generateRepeaterFields(
                        $value2, 
                        array(
                            'id' => $options['id'],
                            'pos' => 0
                        )
                    );
                }
                $inputs .= '</div>';
                $inputs .= '<div class="clr"></div></li>';
            }
            $inputs .= '<button class="ipanel-button ipanel-button-white ipanel-repeater-new-item">'.__("New Item", $this->text_domain).'</button>';
            $inputs .= '<script type="text/html">';
            $inputs .= '<li class="ipanel-repeater-item" data-repeaterCounter="0">';
            $inputs .= '<i class="ipanel-delete-icon ipanel-delete-repeater-item"></i>';
            $inputs .= '<i class="ipanel-drag-icon ipanel-drag-repeater-item"></i>';
            $inputs .= empty($options['field_options']['each_title']) ? '<h2 class="ipanel-repeater-title">' . __("Item", $this->text_domain) . '<span class="item_number"> ' . ($i + 1) . '</span>' . '</h2>' : '<h2 class="ipanel-repeater-title">' . sprintf($options['field_options']['each_title'], '<span class="item_number">' . $i + 1 . '</span>') . '</h2>';
            $inputs .= '<div class="ipanel-repeater-fields">';
            foreach ($options['options'] as $REPEATEROPTION) {
                $inputs .= $this->generateRepeaterFields(
                    $REPEATEROPTION, 
                    array(
                        'id' => $options['id'],
                        'pos' => 0
                    )
                );
            }
            $inputs .= '</div>';
            $inputs .= '<div class="clr"></div></li>';
            $inputs .= '</script>';
            return $this->_fieldSection($options, $inputs, ' ipanel-repeater-input-container');
        }
        
        /**
         * Generate Wordpress WYSIWYG Editor
         *
         * @param array $options Field Options Array.
         *
         * @author vahidd
         * @return string
         * @since 1.0
         */
        public function wpEditor($options = null)
        {
            ob_start();
            wp_editor($this->getOption($options['id']), $options['id'], $options['field_options']);
            $input = ob_get_clean();
            return $this->_fieldSection($options, $input);
        }
        
        /**
         * Generate Radio Button
         *
         * @param array $options  Field Options Array.
         * @param array $Repeater Repeater Options for Field.
         *
         * @author vahidd
         * @return string
         * @since 1.0
         */
        public function radio($options = null, $Repeater = array())
        {
            if (isset($options['options'])) {
                if (count($Repeater) > 0) {
                    $value = isset($Repeater['value']) ? $Repeater['value'] : array();
                } else {
                    $value = $this->getOption($options['id']);
                }
                if (isset($options['repeater_item']) && $options['repeater_item'] === true) {
                    $option_name = $Repeater['id'] . '[' . $Repeater['pos'] . '][' . $options['id'] . ']';
                } else {
                    $option_name = $options['id'];
                }    
                $input = '';
                foreach ($options['options'] as $option_key => $option_value) {
                    $checked = $value == $option_key ? 'checked="checked"' : '';
                    $input .= '    <label>' . $option_value . ' <input type="radio" value="' . $option_key . '" name="' . $option_name . '" ' . $checked . ' class="iradio_polaris"/></label>' . "\n";
                }
                $input .= $this->conditionalLogic($options);
                if (isset($options['repeater_item']) && $options['repeater_item'] === true) {
                    return '<div class="ipanel-repeater-option ipanel-repeater-' . $options['type'] . '"><label>' . $options['name'] . '</label><br/>' . $input . '</div>';
                }
                return $this->_fieldSection($options, $input);
            }
        }
        
        /**
         * Generate Media Uploader
         *
         * @param array $options  Field Options Array.
         * @param array $Repeater Repeater Options for Field.
         *
         * @author vahidd
         * @return string
         * @since 1.0
         */
        public function mediaUploader($options = null, $Repeater = array())
        {
            $button_text  = isset($options['field_options']['button_text']) ? $options['field_options']['button_text'] : __("Upload", $this->text_domain);
            $media_title  = isset($options['field_options']['media_title']) ? $options['field_options']['media_title'] : __("Choose File", $this->text_domain);
            $media_button = isset($options['field_options']['media_insert_button_text']) ? $options['field_options']['media_insert_button_text'] : __("Choose File", $this->text_domain);
            if (isset($options['repeater_item']) && $options['repeater_item'] === true) {
                $option_name = $Repeater['id'] . '[' . $Repeater['pos'] . '][' . $options['id'] . ']';
            } else {
                $option_name = $options['id'];
            }
            if (count($Repeater)) {
                $value = isset($Repeater['value']) ? $Repeater['value'] : '';
            } else {
                $value = $this->getOption($options['id']);
            }
            $input = '    <input class="ipanel-media-uploader-input" type="text" size="36" name="' . $option_name . '" value="' . $value . '" />';
            $input .= '    <input class="ipanel-button ipanel-button-white ipanel-media-upload-button" type="button" value="' . $button_text . '" data-mediaTitle="' . $media_title . '" data-mediaButton="' . $media_button . '" />';
            $input .= $this->conditionalLogic($options);
            if (isset($options['repeater_item']) && $options['repeater_item'] === true) {
                return '<div class="ipanel-repeater-option ipanel-repeater-' . $options['type'] . '"><label>' . $options['name'] . '</label><br/>' . $input . '</div>';
            }
            return $this->_fieldSection($options, $input);
        }
        
        /**
         * Generate Export Field
         *
         * @param array $options Field Options Array.
         *
         * @author vahidd
         * @return string
         * @since 1.0
         */
        public function export($options = null)
        {
            $export_value = get_option($this->args['ID']);
            if ($export_value === false || base64_decode($export_value) === false) {
                $export_value = __("You need to save options first.", $this->text_domain);
            }
            $op = '';
            $op .= '<div class="ipanel-export-field">';
            $op .= '<div class="ipanel-export-value"><span>' . $export_value . '</span></div>';
            $args = array(
                'action' => 'ipanel-download-export-file',
                'nonce' => wp_create_nonce('ipanel_export_nonce'),
                'panelid' => $this->args['ID']
            );
            $url  = add_query_arg($args, admin_url());
            $op .= '<a href="' . $url . '" class="ipanel-button ipanel-button-white ipanel-export-link-btn" target="_blank"> ' . __('Download File', $this->text_domain) . '</a>';
            $op .= '</div>';
            return $this->_fieldSection($options, $op);
        }
        
        /**
         * Generate Start of a Section
         *
         * @param array $options Field Options Array.
         *
         * @author vahidd
         * @return string
         * @since 1.0
         */
        public function startSection($options = null)
        {
            
            $section = '';
            $section .= '<div class="ipanel-usection" id="ipanel-usection-' . preg_replace('/\W/', '', $options['name']) . '">';
            $section .= '<h2>' . $options['name'] . '</h2>';
            $style = @$options['field_options']['show'] !== true ? 'display:none;' : '';
            $section .= '<div style="' . $style . '">';
            return $section;
        }
        
        /**
         * Generate End of Section
         *
         * @author vahidd
         * @return string
         * @since 1.0
         */
        public function endSection()
        {
            $section = '</div>';
            $section .= '</div>';
            return $section;
        }
        
        /**
         * Generate Info Box
         *
         * @param array $options Field Options Array.
         *
         * @author vahidd
         * @return string
         * @since 1.0
         */
        public function info($options = null)
        {
            $container_style = empty($options['field_options']['container_css']) ? '' : 'style="' . $options['field_options']['container_css'] . '"';
            $text_style      = empty($options['field_options']['css']) ? '' : 'style="' . $options['field_options']['css'] . '"';
            $ustyle          = empty($options['field_options']['style']) ? '' : $options['field_options']['style'];
            switch ($ustyle) {
            case ('info'):
                $box_style = 'info';
                break;
                
            case ('danger'):
                $box_style = 'danger';
                break;
                
            case ('alert'):
                $box_style = 'alert';
                break;
                
            case ('success'):
                $box_style = 'success';
                break;
                
            default:
                $box_style = 'info';
                break;
            }
            return '<div class="ipanel-info ' . $box_style . '" ' . $container_style . '>' . '<span ' . $text_style . '>' . $options['name'] . '</span>' . '</div>';
        }
        
        /**
         * Generate Import Field
         *
         * @param array $options Field Options Array.
         *
         * @author vahidd
         * @return string
         * @since 1.0
         */
        public function import($options = null)
        {
            $op = '';
            $op .= '<div class="ipanel-import-field">';
            $op .= '<label>' . __('Enter Code', $this->text_domain) . '<textarea class="ipanel-import-text"></textarea></label>';
            $op .= '<br/><br/><label class="ipanel-import-file-label ipanel-button ipanel-button-white"> ' . __('Import File', $this->text_domain) . ' <input type="file" name="ipanel-import-file" class="ipanel-import-file"/></label>';
            $op .= '<span class="ipanel-chosen-filename"></span>';
            $op .= '<br/><br/><br/><a class="ipanel-button ipanel-button-white ipanel-import-button">'.__('Import', $this->text_domain).'</a>';
            $op .= '</div>';
            return $this->_fieldSection($options, $op);
        }
        
        /**
         * Generate Import Field
         *
         * @param string $url The URL
         *
         * @author vahidd
         * @return string
         * @since 1.1
         */
        public function isURL($url = '')
        {
            return preg_match('|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i', $url) === 1 ? true : false;
        }        
        
    }
}