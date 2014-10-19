<?php
/** 
 * Plugin recomendations
 **/

require_once ('class-tgm-plugin-activation.php');

add_action( 'tgmpa_register', 'flatmarket_register_required_plugins' );

function flatmarket_register_required_plugins() {

    /**
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(
        
        array(
            'name'                  => 'FlatMarket Visual Page Builder', // The plugin name
            'slug'                  => 'js_composer', // The plugin slug (typically the folder name)
            'source'                => get_stylesheet_directory() . '/inc/plugins/js_composer.zip', // The plugin source
            'required'              => false, // If false, the plugin is only 'recommended' instead of required
            'version'               => '4.3.4', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'          => '', // If set, overrides default API URL and points to an external URL
        ),
        array(
            'name'                  => 'Revolution Slider', // The plugin name
            'slug'                  => 'revslider', // The plugin slug (typically the folder name)
            'source'                => get_stylesheet_directory() . '/inc/plugins/revslider.zip', // The plugin source
            'required'              => true, // If false, the plugin is only 'recommended' instead of required
            'version'               => '4.6', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'          => '', // If set, overrides default API URL and points to an external URL
        ),
        array(
            'name'                  => 'Mega Main Menu', // The plugin name
            'slug'                  => 'mega_main_menu', // The plugin slug (typically the folder name)
            'source'                => get_stylesheet_directory() . '/inc/plugins/mega_main_menu.zip', // The plugin source
            'required'              => false, // If false, the plugin is only 'recommended' instead of required
            'version'               => '2.0.2', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'          => '', // If set, overrides default API URL and points to an external URL
        ),
        array(
            'name'                  => 'WooCommerce', // The plugin name
            'slug'                  => 'woocommerce', // The plugin slug (typically the folder name)
            'source'                => get_stylesheet_directory() . '/inc/plugins/woocommerce.2.2.2.zip', // The plugin source
            'required'              => true, // If false, the plugin is only 'recommended' instead of required
            'version'               => '2.2.2', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'          => '', // If set, overrides default API URL and points to an external URL
        ),
        array(
            'name'                  => 'WooCommerce WishList', // The plugin name
            'slug'                  => 'yith-woocommerce-wishlist', // The plugin slug (typically the folder name)
            'source'                => get_stylesheet_directory() . '/inc/plugins/yith-woocommerce-wishlist.1.1.1.zip', // The plugin source
            'required'              => true, // If false, the plugin is only 'recommended' instead of required
            'version'               => '1.1.1', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'          => '', // If set, overrides default API URL and points to an external URL
        ),
        array(
            'name'                  => 'WooCommerce Compare', // The plugin name
            'slug'                  => 'yith-woocommerce-compare', // The plugin slug (typically the folder name)
            'source'                => get_stylesheet_directory() . '/inc/plugins/yith-woocommerce-compare.1.2.1.zip', // The plugin source
            'required'              => true, // If false, the plugin is only 'recommended' instead of required
            'version'               => '1.2.1', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'          => '', // If set, overrides default API URL and points to an external URL
        ),
        array(
            'name'                  => 'WooCommerce QuickView', // The plugin name
            'slug'                  => 'woo_quickview', // The plugin slug (typically the folder name)
            'source'                => get_stylesheet_directory() . '/inc/plugins/woo_quickview.zip', // The plugin source
            'required'              => true, // If false, the plugin is only 'recommended' instead of required
            'version'               => '3.0.5', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'          => '', // If set, overrides default API URL and points to an external URL
        ),
        array(
            'name'                  => 'WooCommerce Ajax Search', // The plugin name
            'slug'                  => 'yith-woocommerce-ajax-search', // The plugin slug (typically the folder name)
            'source'                => get_stylesheet_directory() . '/inc/plugins/yith-woocommerce-ajax-search.1.1.1.zip', // The plugin source
            'required'              => false, // If false, the plugin is only 'recommended' instead of required
            'version'               => '1.1.1', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'          => '', // If set, overrides default API URL and points to an external URL
        ),
        array(
            'name'                  => 'WooCommerce CloudZoom', // The plugin name
            'slug'                  => 'cloud-zoom-for-woocommerce', // The plugin slug (typically the folder name)
            'source'                => get_stylesheet_directory() . '/inc/plugins/cloud-zoom-for-woocommerce.0.1.zip', // The plugin source
            'required'              => false, // If false, the plugin is only 'recommended' instead of required
            'version'               => '0.1', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'          => '', // If set, overrides default API URL and points to an external URL
        ),
        
        array(
            'name'                  => 'FlatMarket Twitter Widget', // The plugin name
            'slug'                  => 'twitter-widget-pro', // The plugin slug (typically the folder name)
            'source'                => get_stylesheet_directory() . '/inc/plugins/twitter-widget-pro.2.6.0.zip', // The plugin source
            'required'              => false, // If false, the plugin is only 'recommended' instead of required
            'version'               => '2.6.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'          => '', // If set, overrides default API URL and points to an external URL
        ),

        array(
            'name'                  => 'FlatMarket Translation Manager', // The plugin name
            'slug'                  => 'loco-translate', // The plugin slug (typically the folder name)
            'source'                => get_stylesheet_directory() . '/inc/plugins/loco-translate.1.4.6.zip', // The plugin source
            'required'              => false, // If false, the plugin is only 'recommended' instead of required
            'version'               => '1.4.6', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'          => '', // If set, overrides default API URL and points to an external URL
        ),

        array(
            'name'                  => 'PrettyPhoto Lightbox', // The plugin name
            'slug'                  => 'prettyphoto', // The plugin slug (typically the folder name)
            'source'                => get_stylesheet_directory() . '/inc/plugins/prettyphoto.zip', // The plugin source
            'required'              => false, // If false, the plugin is only 'recommended' instead of required
            'version'               => '1.1', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'          => '', // If set, overrides default API URL and points to an external URL
        ),


        array(
            'name'                  => 'Contact Form 7', // The plugin name
            'slug'                  => 'contact-form-7', // The plugin slug (typically the folder name)
            'source'                => get_stylesheet_directory() . '/inc/plugins/contact-form-7.3.9.3.zip', // The plugin source
            'required'              => false, // If false, the plugin is only 'recommended' instead of required
            'version'               => '3.9.3', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'          => '', // If set, overrides default API URL and points to an external URL
        ),
        
        array(
            'name'                  => 'Regenerate Thumbnails', // The plugin name
            'slug'                  => 'regenerate-thumbnails', // The plugin slug (typically the folder name)
            'source'                => get_stylesheet_directory() . '/inc/plugins/regenerate-thumbnails.zip', // The plugin source
            'required'              => false, // If false, the plugin is only 'recommended' instead of required
            'version'               => '2.2.4', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'          => '', // If set, overrides default API URL and points to an external URL
        ),
        
        array(
            'name'                  => 'Simple WP Retina', // The plugin name
            'slug'                  => 'simple-wp-retina', // The plugin slug (typically the folder name)
            'source'                => get_stylesheet_directory() . '/inc/plugins/simple-wp-retina.1.1.1.zip', // The plugin source
            'required'              => false, // If false, the plugin is only 'recommended' instead of required
            'version'               => '1.1.1', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'          => '', // If set, overrides default API URL and points to an external URL
        )

    );

    /**
     * Array of configuration settings. Amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * leave the strings uncommented.
     * Some of the strings are added into a sprintf, so see the comments at the
     * end of each line for what each argument will be.
     */
    $config = array(
        'domain'            => 'flatmarket',           // Text domain - likely want to be the same as your theme.
        'default_path'      => '',                          // Default absolute path to pre-packaged plugins
        'parent_menu_slug'  => 'themes.php',                // Default parent menu slug
        'parent_url_slug'   => 'themes.php',                // Default parent URL slug
        'menu'              => 'install-required-plugins',  // Menu slug
        'has_notices'       => true,                        // Show admin notices or not
        'is_automatic'      => false,                       // Automatically activate plugins after installation or not
        'message'           => '',                          // Message to output right before the plugins table
        'strings'           => array(
            'page_title'                                => __( 'Install Required Plugins', 'flatmarket' ),
            'menu_title'                                => __( 'Install Plugins', 'flatmarket' ),
            'installing'                                => __( 'Installing Plugin: %s', 'flatmarket' ), // %1$s = plugin name
            'oops'                                      => __( 'Something went wrong with the plugin API.', 'flatmarket' ),
            'notice_can_install_required'               => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
            'notice_can_install_recommended'            => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
            'notice_cannot_install'                     => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
            'notice_can_activate_required'              => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
            'notice_can_activate_recommended'           => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
            'notice_cannot_activate'                    => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
            'notice_ask_to_update'                      => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
            'notice_cannot_update'                      => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
            'install_link'                              => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
            'activate_link'                             => _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
            'return'                                    => __( 'Return to Required Plugins Installer', 'flatmarket' ),
            'plugin_activated'                          => __( 'Plugin activated successfully.', 'flatmarket' ),
            'complete'                                  => __( 'All plugins installed and activated successfully. %s', 'flatmarket' ), // %1$s = dashboard link
            'nag_type'                                  => 'updated' // Determines admin notice type - can only be 'updated' or 'error'
        )
    );

    tgmpa( $plugins, $config );

}

function flatmarket_widgets_init() {
    register_sidebar(
      array(
        'name' => __( 'Left/Right sidebar', 'flatmarket' ),
        'id' => 'main-sidebar',
        'description' => __( 'Widgets in this area will be shown in the left or right site column.', 'flatmarket' )
      )
    );

    register_sidebar(
      array(
        'name' => __( 'Woocommerce sidebar', 'flatmarket' ),
        'id' => 'shop-sidebar',
        'description' => __( 'Widgets in this area will be shown in the left or right column on shop pages.', 'flatmarket' )
      )
    );

    register_sidebar(
      array(
        'name' => __( 'Footer 4 column sidebar #1', 'flatmarket' ),
        'id' => 'footer-sidebar',
        'description' => __( 'Widgets in this area will be shown in site footer in 4 column.', 'flatmarket' )
      )
    );

    register_sidebar(
      array(
        'name' => __( 'Footer 4 column sidebar #2', 'flatmarket' ),
        'id' => 'footer-sidebar-2',
        'description' => __( 'Widgets in this area will be shown in site footer in 4 column after Footer sidebar #1.', 'flatmarket' )
      )
    );
}

add_action( 'widgets_init', 'flatmarket_widgets_init' );

add_filter('widget_text', 'do_shortcode');

/*
* WooCommerce ajax add to cart
*/
// Ensure cart contents update when products are added to the cart via AJAX (place the following in functions.php)
add_filter('add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');
 
function woocommerce_header_add_to_cart_fragment( $fragments ) {
  global $woocommerce;
  ob_start();
  ?>
  <div class="shopping-cart">
      
      <div class="shopping-cart-title">
        <?php if($woocommerce->cart->cart_contents_count > 0): ?>
        <div class="shopping-cart-count"><?php echo $woocommerce->cart->cart_contents_count; ?></div>
        <?php endif; ?>
        <a class="cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'flatmarket'); ?>"><?php echo $woocommerce->cart->get_cart_total(); ?></a>
      </div>
      <a class="shopping-cart-icon" href="<?php echo $woocommerce->cart->get_cart_url(); ?>"><i class="fa fa-shopping-cart"></i></a>
      <div class="shopping-cart-content">
      <?php if ( sizeof( $woocommerce->cart->get_cart() ) > 0 ) : ?>
      <?php foreach ( $woocommerce->cart->get_cart() as $cart_item_key => $cart_item ) : $_product = $cart_item['data'];
      if ( ! apply_filters('woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) || ! $_product->exists() || $cart_item['quantity'] == 0 ) continue;
      $product_price = get_option( 'woocommerce_display_cart_prices_excluding_tax' ) == 'yes' || $woocommerce->customer->is_vat_exempt() ? $_product->get_price_excluding_tax() : $_product->get_price();
      $product_price = apply_filters( 'woocommerce_cart_item_price_html', woocommerce_price( $product_price ), $cart_item, $cart_item_key );
      ?>
      <div class="shopping-cart-product clearfix">
        <div class="shopping-cart-product-image">
        <a href="<?php echo get_permalink( $cart_item['product_id'] ); ?>"><?php echo $_product->get_image(); ?></a>
        </div>
        <div class="shopping-cart-product-title">
        <a href="<?php echo get_permalink( $cart_item['product_id'] ); ?>"><?php echo apply_filters('woocommerce_widget_cart_product_title', $_product->get_title(), $_product ); ?></a>
        </div>
        <div class="shopping-cart-product-price">
        <?php echo $woocommerce->cart->get_item_data( $cart_item ); ?><span class="quantity"><?php printf( '%s &times; %s', $cart_item['quantity'], $product_price ); ?></span></li>
        </div>
      </div>
      <?php endforeach; ?>
      <a class="view-cart" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'flatmarket'); ?>"><?php _e('View cart', 'flatmarket'); ?></a> <a class="view-cart" href="<?php echo $woocommerce->cart->get_checkout_url(); ?>" title="<?php _e('Checkout', 'flatmarket'); ?>"><?php _e('Checkout', 'flatmarket'); ?></a>
      <?php else : ?><div class="empty"><?php _e('No products in the cart.', 'flatmarket'); ?></div>
      <?php endif; ?>
      
      </div>
    </div>
  <?php
  $fragments['.shopping-cart'] = ob_get_clean();
  return $fragments;
}

// Customisation Menu Link
class description_walker extends Walker_Nav_Menu{
      function start_el(&$output, $item, $depth = 0, $args = Array(), $current_object_id = 0 ){
           global $wp_query;
           $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
           $class_names = $value = '';
           $classes = empty( $item->classes ) ? array() : (array) $item->classes;
           $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
          
           $add_class = '';
           
           $post = get_post($item->object_id);          

               $class_names = ' class="'.$add_class.' '. esc_attr( $class_names ) . '"';
               $output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';
               $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
               $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
               $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';

             
               
                    $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

                if (is_object($args)) {
                    $item_output = $args->before;
                    $item_output .= '<a'. $attributes .'>';
                    $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID );
                    $item_output .= $args->link_after;
                    $item_output .= '</a>';
                    $item_output .= $args->after;
                    $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );

                    
                }
                
           

               
     }
}


/** 
* Favicon, Google Fonts and custom styles
**/
function flatmarket_js_settings() {
    global $theme_options;

   
    ?>
    <script>
    (function($){
    $(document).ready(function() {

        
        <?php if(isset($theme_options['shop_addedtocart_popup']) && $theme_options['shop_addedtocart_popup']): ?>
        // Cart popup
        $('body').on('added_to_cart',function(e,data) {
        <?php global $woocommerce; ?>
                $('body').append('<a href="#TB_inline?width=205&height=115&inlineId=hidden_popup_cart" id="show_popup_cart" title="<?php _e("Product added to cart", "flatmarket"); ?>" class="thickbox" style="display:none"></a>');

                // Some customization:

                var s = '';

                s += '<div class="popup_shopping_cart_content">';

                s += '<p>';

                s += '<?php _e("Product was successfully added to your shopping cart.", "flatmarket"); ?>';

                s += '</p>';

                s += '<p class="buttons">';

                s += '  <a href="" onclick="javascript:tb_remove();return false;" class="btn button wc-forward"><?php _e("Continue Shopping", "flatmarket"); ?></a>';

                s += '  <a href="<?php echo $woocommerce->cart->get_checkout_url(); ?>" class="btn button checkout wc-forward"><?php _e("Checkout", "flatmarket"); ?></a>';

                s += '</p>';

                s += '</div>';

                $('body').append('<div id="hidden_popup_cart" style="display:none">'+s+'</div>');

                $('#show_popup_cart').click();

        });
        <?php endif; ?>

        <?php if(isset($theme_options['revolution_fullwidth']) && $theme_options['revolution_fullwidth']): ?>

        $('.homepage .wpb_revslider_element').addClass('fullwidth-rev-slider');

        <?php endif; ?>

        
        <?php if(isset($theme_options['shop_show_more_enable']) && $theme_options['shop_show_more_enable']): ?>
        $('.products-module .products').bxSlider({
          minSlides: 1,
          maxSlides: 5,
          slideWidth: 216, //275
          slideMargin: 23,
          pager: false
        });
        <?php endif; ?>

        <?php if(isset($theme_options['enable_parallax']) && $theme_options['enable_parallax']): ?>
  
        $('.parallax').each(function(){
           $(this).parallax("50%", 0.1);
        });

        <?php endif; ?>
        

    });
    })(jQuery);
    </script>
    
  
    <?php
   
}
add_action( 'wp_head' , 'flatmarket_js_settings' );

function flatmarket_custom_favicon() {
    global $theme_options;

    if(isset($theme_options['favicon_image']) && $theme_options['favicon_image']['url'] <> '') {
      echo '<link rel="icon" type="image/png" href="'.$theme_options['favicon_image']['url'].'" />';
    }
}
add_action( 'wp_head' , 'flatmarket_custom_favicon' );

function flatmarket_google_fonts() {
    global $theme_options;
    ?>

    <link href='//fonts.googleapis.com/css?family=<?php if(isset($theme_options['header_font'])) { echo $theme_options['header_font']['font-family']; } ?>:300,300italic,regular,italic,600,600italic,700,700italic,800,800italic<?php if(isset($theme_options['font_cyrillic_enable']) && ($theme_options['font_cyrillic_enable'])) { echo '&amp;subset=cyrillic'; } ?>' rel='stylesheet' type='text/css'>
    <?php if($theme_options['header_font']['font-family'] <> $theme_options['body_font']['font-family']): ?>
    <link href='//fonts.googleapis.com/css?family=<?php echo $theme_options['body_font']['font-family']; ?><?php if(isset($theme_options['font_cyrillic_enable']) && ($theme_options['font_cyrillic_enable'])) { echo '&amp;subset=latin,cyrilic'; } ?>' rel='stylesheet' type='text/css'>
    <?php endif; ?>
    <?php
}
add_action( 'wp_head' , 'flatmarket_google_fonts' );


function flatmarket_custom_styles() {
    global $theme_options;
    ?>
    
    <style type="text/css">
    <?php if(isset($theme_options['shop_show_more_enable']) && $theme_options['shop_show_more_enable']): ?>
    .woocommerce .products ul, .woocommerce ul.products, .woocommerce-page .products ul, .woocommerce-page ul.products {
        margin-left: 0;
        margin-right: 0;
    }
    .products-module .woocommerce ul.products li.product .product-item-box {
        width: 214px;
        height: 293px;
    }
    .products-module .woocommerce ul.products li.product {
        border:0;
    }
    .products-module .woocommerce ul.products li.product:hover {
        border:0;
    }
    .products-module .woocommerce ul.products li.first, 
    .products-module .woocommerce-page ul.products li.first {
        clear: none;
        float: none;
    }
    .products-module .woocommerce ul.products li, 
    .products-module .woocommerce-page ul.products li {
        clear: none;
        float: none;
    }
    .products-module .woocommerce ul.products li.product {
        padding-bottom: 0;
    }
    .products-module .woocommerce ul.products li.product, 
    .products-module .woocommerce-page ul.products li.product  {
        margin-bottom: 0;
    }
    .products-module .woocommerce:not(.compare-button) {
        height: 294px;
        overflow: hidden;
    }

    <?php endif; ?>
    <?php if(isset($theme_options['shop_catalog_mode_enable']) && $theme_options['shop_catalog_mode_enable']): ?>
    .shopping-cart, 
    .add_to_cart_button, 
    .anim_add_to_cart_button,
    .single_add_to_cart_button, 
    .quantity,
    .link-checkout,
    .add_to_cart {
        display: none!important;
    }

    <?php endif; ?>

    <?php if(isset($theme_options['shop_hide_wishlist']) && $theme_options['shop_hide_wishlist']): ?>
    .yith-wcwl-add-to-wishlist,
    .link-wishlist {
        display: none!important;
    }
    <?php endif; ?>

    <?php if(isset($theme_options['shop_hide_compare']) && $theme_options['shop_hide_compare']): ?>
    .woocommerce .shop-product .summary .compare.button,
    .woocommerce .product-item-box .product-buttons .compare-button {
        display: none!important;
    }
    <?php endif; ?>

    <?php if(isset($theme_options['shop_hide_qv']) && $theme_options['shop_hide_qv']): ?>
    .woocommerce .product-item-box .jckqvBtn {
        display: none!important;
    }

    <?php endif; ?>
    
    

    /**
    * Custom CSS
    **/
    <?php if(isset($theme_options['custom_css_code'])) { echo $theme_options['custom_css_code']; } ?>
    
    
    /** 
    * Theme Google Font
    **/
    
    h1, h2, h3, h4, h5, h6,
    .woocommerce ul.products li.product .price,
    .flatmarket-button a,
    .shop-content .entry-summary .price,
    #jckqv h1,
    #jckqv .price,
    .simple.single_add_to_cart_button,
    .woocommerce .shop-product .summary .anim_add_to_cart_button .text {
        font-family: '<?php echo str_replace("+"," ", $theme_options['header_font']['font-family']); ?>';
    }
    h1 {
        font-size: <?php echo $theme_options['header_font']['font-size']; ?>px;
    }
    body {
        font-family: '<?php echo str_replace("+"," ", $theme_options['body_font']['font-family']); ?>';
        font-size: <?php echo $theme_options['body_font']['font-size']; ?>px;
    }
    /**
    * Colors and color skins
    */
    

    <?php
    if(!isset($theme_options['color_skin_name'])) {
        $color_skin_name = 'none';
    }
    else {
        $color_skin_name = $theme_options['color_skin_name'];
    }
    // Use panel settings
    if($color_skin_name == 'none') {

        $theme_body_color = $theme_options['theme_body_color'];
        $theme_text_color = $theme_options['theme_text_color'];
        $theme_links_color = $theme_options['theme_links_color'];
        $theme_links_hover_color = $theme_options['theme_links_hover_color'];
        $theme_main_color = $theme_options['theme_main_color'];
        $theme_hover_color = $theme_options['theme_hover_color'];
        $theme_header_bg_color = $theme_options['theme_header_bg_color'];
        $theme_header_link_color = $theme_options['theme_header_link_color'];
        $theme_cat_menu_bg_color = $theme_options['theme_cat_menu_bg_color'];
        $theme_cat_menu_link_color = $theme_options['theme_cat_menu_link_color'];
        $theme_cat_submenu_1lvl_bg_color = $theme_options['theme_cat_submenu_1lvl_bg_color'];
        $theme_cat_submenu_1lvl_link_color = $theme_options['theme_cat_submenu_1lvl_link_color'];
        $theme_product_background_color = $theme_options['theme_product_background_color'];
        $theme_footer_color = $theme_options['theme_footer_color'];
        $theme_footer_link_color = $theme_options['theme_footer_link_color'];
        $theme_footer_header_color = $theme_options['theme_footer_header_color'];
        $theme_footer_text_color = $theme_options['theme_footer_text_color'];
        $theme_title_color = $theme_options['theme_title_color'];
        $theme_widget_title_color = $theme_options['theme_widget_title_color'];
        $theme_productpage_border_color = $theme_options['theme_productpage_border_color'];
        $theme_content_bg_color = $theme_options['theme_content_bg_color'];
        $theme_carticon_bg_color = $theme_options['theme_carticon_bg_color'];
        $theme_cartcounter_bg_color = $theme_options['theme_cartcounter_bg_color'];
        $theme_productbuttons_hover_color = $theme_options['theme_productbuttons_hover_color'];
        $theme_copyfooter_bg_color = $theme_options['theme_copyfooter_bg_color'];
        $theme_salebadge_bg_color = $theme_options['theme_salebadge_bg_color'];

    }
    // Default skin
    if($color_skin_name == 'default') {
        
        $theme_body_color = '#ffffff';
        $theme_text_color = '#393232';
        $theme_links_color = '#000000';
        $theme_links_hover_color = '#008c8d';
        $theme_main_color = '#008c8d';
        $theme_hover_color = '#535353';
        $theme_header_bg_color = '#eef0f0';
        $theme_header_link_color = '#868686';
        $theme_cat_menu_bg_color = '#535353';
        $theme_cat_menu_link_color = '#ffffff';
        $theme_cat_submenu_1lvl_bg_color = '#f8f8f8';
        $theme_cat_submenu_1lvl_link_color = '#000000';
        $theme_product_background_color = '#535353';
        $theme_footer_color = '#2f2e2e';
        $theme_footer_link_color = '#ffffff';
        $theme_footer_header_color = '#ffffff';
        $theme_footer_text_color = '#ffffff';
        $theme_title_color = '#252727';
        $theme_widget_title_color = '#252727';
        $theme_productpage_border_color = '#e8e5e5';
        $theme_content_bg_color = '#F8F8F8';
        $theme_carticon_bg_color = '#00AFB3';
        $theme_cartcounter_bg_color = '#FFC32C';
        $theme_productbuttons_hover_color = '#afe0e1';
        $theme_copyfooter_bg_color = '#181818';
        $theme_salebadge_bg_color = '#f64f57';

    }
    // Green skin
    if($color_skin_name == 'green') {
        
        $theme_body_color = '#ffffff';
        $theme_text_color = '#393232';
        $theme_links_color = '#2ba86e';
        $theme_links_hover_color = '#00BC8F';
        $theme_main_color = '#00BC8F';
        $theme_hover_color = '#535353';
        $theme_header_bg_color = '#eef0f0';
        $theme_header_link_color = '#868686';
        $theme_cat_menu_bg_color = '#069e78';
        $theme_cat_menu_link_color = '#ffffff';
        $theme_cat_submenu_1lvl_bg_color = '#f8f8f8';
        $theme_cat_submenu_1lvl_link_color = '#000000';
        $theme_product_background_color = '#069e78';
        $theme_footer_color = '#2f2e2e';
        $theme_footer_link_color = '#ffffff';
        $theme_footer_header_color = '#ffffff';
        $theme_footer_text_color = '#ffffff';
        $theme_title_color = '#252727';
        $theme_widget_title_color = '#252727';
        $theme_productpage_border_color = '#e8e5e5';
        $theme_content_bg_color = '#F8F8F8';
        $theme_carticon_bg_color = '#069e78';
        $theme_cartcounter_bg_color = '#FFC32C';
        $theme_productbuttons_hover_color = '#14ddad';
        $theme_copyfooter_bg_color = '#181818';
        $theme_salebadge_bg_color = '#f64f57';
    }
    // Blue skin
    if($color_skin_name == 'blue') {

        $theme_body_color = '#ffffff';
        $theme_text_color = '#393232';
        $theme_links_color = '#617F9B';
        $theme_links_hover_color = '#4b6a85';
        $theme_main_color = '#617F9B';
        $theme_hover_color = '#57728a';
        $theme_header_bg_color = '#eef0f0';
        $theme_header_link_color = '#57728a';
        $theme_cat_menu_bg_color = '#57728a';
        $theme_cat_menu_link_color = '#ffffff';
        $theme_cat_submenu_1lvl_bg_color = '#f8f8f8';
        $theme_cat_submenu_1lvl_link_color = '#000000';
        $theme_product_background_color = '#57728a';
        $theme_footer_color = '#617F9B';
        $theme_footer_link_color = '#ffffff';
        $theme_footer_header_color = '#ffffff';
        $theme_footer_text_color = '#ffffff';
        $theme_title_color = '#252727';
        $theme_widget_title_color = '#252727';
        $theme_productpage_border_color = '#e8e5e5';
        $theme_content_bg_color = '#F8F8F8';
        $theme_carticon_bg_color = '#57728a';
        $theme_cartcounter_bg_color = '#FFC32C';
        $theme_productbuttons_hover_color = '#9fbbd5';
        $theme_copyfooter_bg_color = '#57728a';
        $theme_salebadge_bg_color = '#f64f57';

    }
    // Red skin
    if($color_skin_name == 'red') {

        $theme_body_color = '#ffffff';
        $theme_text_color = '#393232';
        $theme_links_color = '#e33039';
        $theme_links_hover_color = '#e86f75';
        $theme_main_color = '#e86f75';
        $theme_hover_color = '#d13a42';
        $theme_header_bg_color = '#eef0f0';
        $theme_header_link_color = '#868686';
        $theme_cat_menu_bg_color = '#e33039';
        $theme_cat_menu_link_color = '#ffffff';
        $theme_cat_submenu_1lvl_bg_color = '#f8f8f8';
        $theme_cat_submenu_1lvl_link_color = '#000000';
        $theme_product_background_color = '#535353';
        $theme_footer_color = '#2f2e2e';
        $theme_footer_link_color = '#ffffff';
        $theme_footer_header_color = '#ffffff';
        $theme_footer_text_color = '#ffffff';
        $theme_title_color = '#252727';
        $theme_widget_title_color = '#252727';
        $theme_productpage_border_color = '#e8e5e5';
        $theme_content_bg_color = '#F8F8F8';
        $theme_carticon_bg_color = '#e33039';
        $theme_cartcounter_bg_color = '#FFC32C';
        $theme_productbuttons_hover_color = '#fec4c4';
        $theme_copyfooter_bg_color = '#181818';
        $theme_salebadge_bg_color = '#f64f57';

    }
    // Black skin
    if($color_skin_name == 'black') {

        $theme_body_color = '#ffffff';
        $theme_text_color = '#393232';
        $theme_links_color = '#000000';
        $theme_links_hover_color = '#cacaca';
        $theme_main_color = '#535353';
        $theme_hover_color = '#000000';
        $theme_header_bg_color = '#eef0f0';
        $theme_header_link_color = '#868686';
        $theme_cat_menu_bg_color = '#000000';
        $theme_cat_menu_link_color = '#ffffff';
        $theme_cat_submenu_1lvl_bg_color = '#f8f8f8';
        $theme_cat_submenu_1lvl_link_color = '#000000';
        $theme_product_background_color = '#000000';
        $theme_footer_color = '#F8F8F8';
        $theme_footer_link_color = '#535353';
        $theme_footer_header_color = '#000000';
        $theme_footer_text_color = '#535353';
        $theme_title_color = '#252727';
        $theme_widget_title_color = '#252727';
        $theme_productpage_border_color = '#e8e5e5';
        $theme_content_bg_color = '#F8F8F8';
        $theme_carticon_bg_color = '#000000';
        $theme_cartcounter_bg_color = '#FFC32C';
        $theme_productbuttons_hover_color = '#cacaca';
        $theme_copyfooter_bg_color = '#535353';
        $theme_salebadge_bg_color = '#f64f57';

    }

    // Pink/Violet skin
    if($color_skin_name == 'pink') {

        $theme_body_color = '#ffffff';
        $theme_text_color = '#393232';
        $theme_links_color = '#000000';
        $theme_links_hover_color = '#f098d2';
        $theme_main_color = '#ed6cc1';
        $theme_hover_color = '#f098d2';
        $theme_header_bg_color = '#eef0f0';
        $theme_header_link_color = '#868686';
        $theme_cat_menu_bg_color = '#f098d2';
        $theme_cat_menu_link_color = '#ffffff';
        $theme_cat_submenu_1lvl_bg_color = '#f8f8f8';
        $theme_cat_submenu_1lvl_link_color = '#000000';
        $theme_product_background_color = '#e066b6';
        $theme_footer_color = '#F8F8F8';
        $theme_footer_link_color = '#535353';
        $theme_footer_header_color = '#000000';
        $theme_footer_text_color = '#535353';
        $theme_title_color = '#252727';
        $theme_widget_title_color = '#252727';
        $theme_productpage_border_color = '#e8e5e5';
        $theme_content_bg_color = '#F8F8F8';
        $theme_carticon_bg_color = '#f098d2';
        $theme_cartcounter_bg_color = '#FFC32C';
        $theme_productbuttons_hover_color = '#fea0f0';
        $theme_copyfooter_bg_color = '#181818';
        $theme_salebadge_bg_color = '#f64f57';

    }

    // Orange skin
    if($color_skin_name == 'orange') {

        $theme_body_color = '#ffffff';
        $theme_text_color = '#393232';
        $theme_links_color = '#000000';
        $theme_links_hover_color = '#fac170';
        $theme_main_color = '#faa732';
        $theme_hover_color = '#fac170';
        $theme_header_bg_color = '#eef0f0';
        $theme_header_link_color = '#868686';
        $theme_cat_menu_bg_color = '#fac170';
        $theme_cat_menu_link_color = '#ffffff';
        $theme_cat_submenu_1lvl_bg_color = '#f8f8f8';
        $theme_cat_submenu_1lvl_link_color = '#000000';
        $theme_product_background_color = '#fac170';
        $theme_footer_color = '#2f2e2e';
        $theme_footer_link_color = '#ffffff';
        $theme_footer_header_color = '#ffffff';
        $theme_footer_text_color = '#ffffff';
        $theme_title_color = '#252727';
        $theme_widget_title_color = '#252727';
        $theme_productpage_border_color = '#e8e5e5';
        $theme_content_bg_color = '#F8F8F8';
        $theme_carticon_bg_color = '#fac170';
        $theme_cartcounter_bg_color = '#FFC32C';
        $theme_productbuttons_hover_color = '#fbddb4';
        $theme_copyfooter_bg_color = '#181818';
        $theme_salebadge_bg_color = '#f64f57';

    }
    // Fencer skin
    if($color_skin_name == 'fencer') {
        
        $theme_body_color = '#ffffff';
        $theme_text_color = '#393232';
        $theme_links_color = '#26cdb3';
        $theme_links_hover_color = '#000000';
        $theme_main_color = '#26cdb3';
        $theme_hover_color = '#232b33';
        $theme_header_bg_color = '#eef0f0';
        $theme_header_link_color = '#868686';
        $theme_cat_menu_bg_color = '#232b33';
        $theme_cat_menu_link_color = '#ffffff';
        $theme_cat_submenu_1lvl_bg_color = '#f8f8f8';
        $theme_cat_submenu_1lvl_link_color = '#000000';
        $theme_product_background_color = '#232b33';
        $theme_footer_color = '#2d363a';
        $theme_footer_link_color = '#ffffff';
        $theme_footer_header_color = '#26cdb3';
        $theme_footer_text_color = '#a3a8a9';
        $theme_title_color = '#252727';
        $theme_widget_title_color = '#252727';
        $theme_productpage_border_color = '#e8e5e5';
        $theme_content_bg_color = '#F8F8F8';
        $theme_carticon_bg_color = '#232b33';
        $theme_cartcounter_bg_color = '#FFC32C';
        $theme_productbuttons_hover_color = '#afe0e1';
        $theme_copyfooter_bg_color = '#3c4448';
        $theme_salebadge_bg_color = '#f64f57';

        ?>
     
        <?php
    }
    // Perfectum skin
    if($color_skin_name == 'perfectum') {

        $theme_body_color = '#ffffff';
        $theme_text_color = '#393232';
        $theme_links_color = '#F2532F';
        $theme_links_hover_color = '#000000';
        $theme_main_color = '#F2532F';
        $theme_hover_color = '#000000';
        $theme_header_bg_color = '#eef0f0';
        $theme_header_link_color = '#868686';
        $theme_cat_menu_bg_color = '#000000';
        $theme_cat_menu_link_color = '#ffffff';
        $theme_cat_submenu_1lvl_bg_color = '#f8f8f8';
        $theme_cat_submenu_1lvl_link_color = '#000000';
        $theme_product_background_color = '#000000';
        $theme_footer_color = '#FAFAFA';
        $theme_footer_link_color = '#F2532F';
        $theme_footer_header_color = '#000000';
        $theme_footer_text_color = '#000000';
        $theme_title_color = '#252727';
        $theme_widget_title_color = '#252727';
        $theme_productpage_border_color = '#e8e5e5';
        $theme_content_bg_color = '#F8F8F8';
        $theme_carticon_bg_color = '#000000';
        $theme_cartcounter_bg_color = '#FFC32C';
        $theme_productbuttons_hover_color = '#fdc7bb';
        $theme_copyfooter_bg_color = '#ffffff';
        $theme_salebadge_bg_color = '#f64f57';
        ?>

        <?php

    }
    // Simplegreat skin
    if($color_skin_name == 'simplegreat') {
        
        $theme_body_color = '#ffffff';
        $theme_text_color = '#393232';
        $theme_links_color = '#C3A36B';
        $theme_links_hover_color = '#000000';
        $theme_main_color = '#C3A36B';
        $theme_hover_color = '#3D4445';
        $theme_header_bg_color = '#eef0f0';
        $theme_header_link_color = '#868686';
        $theme_cat_menu_bg_color = '#4A5456';
        $theme_cat_menu_link_color = '#ffffff';
        $theme_cat_submenu_1lvl_bg_color = '#f8f8f8';
        $theme_cat_submenu_1lvl_link_color = '#000000';
        $theme_product_background_color = '#4A5456';
        $theme_footer_color = '#4A5456';
        $theme_footer_link_color = '#a3a8a9';
        $theme_footer_header_color = '#ffffff';
        $theme_footer_text_color = '#ffffff';
        $theme_title_color = '#252727';
        $theme_widget_title_color = '#252727';
        $theme_productpage_border_color = '#e8e5e5';
        $theme_content_bg_color = '#F8F8F8';
        $theme_carticon_bg_color = '#3D4445';
        $theme_cartcounter_bg_color = '#EEF0F0';
        $theme_productbuttons_hover_color = '#fffae5';
        $theme_copyfooter_bg_color = '#363b3c';
        $theme_salebadge_bg_color = '#f64f57';

        ?>

        <?php
    }
    ?>
    body {
        background-color: <?php echo $theme_body_color; ?>;
        color: <?php echo $theme_text_color; ?>;
    }
    a.btn,
    .btn,
    .btn:focus,
    input[type="submit"],
    .btn-primary,
    .btn-primary:focus,
    .shopping-cart .shopping-cart-title,
    .shopping-cart .view-cart,
    #navbar .navbar-toggle,
    .nav .sub-menu li a:hover,
    .nav .children li a:hover,
    .blog-post .more-link,
    .widget_custom_box_right #custom_box_icon,
    #top-link,
    .navigation-paging a:hover,
    .sidebar .widget_product_categories .current-cat > a,
    .sidebar .widget_nav_menu .current-menu-item > a,
    .sidebar .widget_product_categories a:hover,
    .sidebar .widget_product_categories .children a:hover,
    .sidebar .widget_pages ul li a:hover,
    .sidebar .widget_meta ul li a:hover,
    .sidebar .widget_nav_menu a:hover,
    .content-block .widget_archive ul li:hover,
    .woocommerce-page .widget_archive ul li:hover,
    .woocommerce-page .widget_categories > ul > li:hover,
    .content-block .widget_categories > ul > li:hover,
    .woocommerce .widget_layered_nav ul li:hover,
    .woocommerce-page .widget_layered_nav ul li:hover,
    .woocommerce #content input.button,
    .woocommerce #respond input#submit,
    .woocommerce a.button,
    .woocommerce button.button,
    .woocommerce input.button,
    .woocommerce-page #content input.button,
    .woocommerce-page #respond input#submit,
    .woocommerce-page a.button,
    .woocommerce-page button.button,
    .woocommerce-page input.button,
    .woocommerce a.added_to_cart,
    .woocommerce-page a.added_to_cart,
    .woocommerce a.add_to_cart_button,
    .woocommerce #content input.button.alt:hover,
    .woocommerce #respond input#submit.alt:hover,
    .woocommerce a.button.alt:hover,
    .woocommerce button.button.alt:hover,
    .woocommerce input.button.alt:hover,
    .woocommerce-page #content input.button.alt:hover,
    .woocommerce-page #respond input#submit.alt:hover,
    .woocommerce-page a.button.alt:hover,
    .woocommerce-page button.button.alt:hover,
    .woocommerce-page input.button.alt:hover,
    .woocommerce .product-item-box a.add_to_cart_button,
    .woocommerce .product-item-box a.product_type_simple:not(.add_to_cart_button),
    .woocommerce .product-item-box a.product_type_grouped,
    .woocommerce .product-item-box .product-buttons .yith-wcwl-wishlistexistsbrowse a,
    .woocommerce .product-item-box .product-buttons .yith-wcwl-wishlistaddedbrowse a,
    .woocommerce .shop-product .summary .yith-wcwl-wishlistexistsbrowse a,
    .woocommerce .shop-product .summary .yith-wcwl-wishlistaddedbrowse a,
    .woocommerce .product-item-box .product-buttons .yith-wcwl-add-button a,
    .woocommerce .shop-product .summary .yith-wcwl-add-button a,
    .woocommerce .shop-product .summary .yith-wcwl-wishlistexistsbrowse a,
    .woocommerce .shop-product .summary .yith-wcwl-wishlistaddedbrowse a,
    .woocommerce .product-item-box .product-buttons .compare-button a,
    .woocommerce .shop-product .summary .compare.button,
    #jckqv_summary .simple.single_add_to_cart_button,
    .woocommerce .shop-product .summary .cart button:hover,
    .woocommerce .quantity .minus,
    .woocommerce .quantity .plus,
    .woocommerce div.product .woocommerce-tabs ul.tabs li:not(.active):hover,
    .woocommerce #content div.product .woocommerce-tabs ul.tabs li:not(.active):hover,
    .woocommerce-page div.product .woocommerce-tabs ul.tabs li:not(.active):hover,
    .woocommerce-page #content div.product .woocommerce-tabs ul.tabs li:not(.active):hover,
    .woocommerce #content nav.woocommerce-pagination ul li a:focus,
    .woocommerce #content nav.woocommerce-pagination ul li a:hover,
    .woocommerce #content nav.woocommerce-pagination ul li span.current,
    .woocommerce nav.woocommerce-pagination ul li a:focus,
    .woocommerce nav.woocommerce-pagination ul li a:hover,
    .woocommerce nav.woocommerce-pagination ul li span.current,
    .woocommerce-page #content nav.woocommerce-pagination ul li a:focus,
    .woocommerce-page #content nav.woocommerce-pagination ul li a:hover,
    .woocommerce-page #content nav.woocommerce-pagination ul li span.current,
    .woocommerce-page nav.woocommerce-pagination ul li a:focus,
    .woocommerce-page nav.woocommerce-pagination ul li a:hover,
    .woocommerce-page nav.woocommerce-pagination ul li span.current,
    .flatmarket-button a,
    #jckqv .button:hover,
    .woocommerce .product-item-box a.add_to_cart_button:hover,
    .woocommerce .product-item-box a.product_type_simple:not(.add_to_cart_button):hover,
    .woocommerce .product-item-box a.product_type_grouped:hover,
    .navbar .nav > li > a:hover,
    body .select2-results .select2-highlighted,
    .shopping-cart .shopping-cart-icon:hover {
        background-color: <?php echo $theme_main_color; ?>;
    }
    .btn:hover,
    input[type="submit"]:hover,
    .btn:active,
    .btn-primary:hover,
    .btn-primary:active,
    .shopping-cart .view-cart:hover,
    #navbar .navbar-toggle:hover,
    .yith-wcwl-add-button a:hover,
    .blog-post .more-link:hover,
    .blog-post .format-quote blockquote,
    .products-module .bx-wrapper .bx-controls-direction a,
    .footer-container .line,
    #top-link:hover,
    .navigation-paging a,
    .sidebar .widget_calendar th,
    .sidebar .widget_calendar tfoot td,
    .sidebar .widget_product_categories a,
    .sidebar .widget_pages ul li a,
    .sidebar .widget_meta ul li a,
    .sidebar .widget_nav_menu a,
    .woocommerce .widget_layered_nav ul li.chosen a,
    .woocommerce-page .widget_layered_nav ul li.chosen a,
    .woocommerce .widget_layered_nav_filters ul li a,
    .woocommerce-page .widget_layered_nav_filters ul li a,
    .content-block .widget_archive ul li,
    .woocommerce-page .widget_archive ul li,
    .woocommerce-page .widget_categories ul li,
    .content-block .widget_categories ul li,
    .content-block .widget_layered_nav ul,
    .woocommerce-page .widget_layered_nav ul,
    .woocommerce .widget_price_filter .ui-slider .ui-slider-handle,
    .woocommerce-page .widget_price_filter .ui-slider .ui-slider-handle,
    .woocommerce .widget_price_filter .ui-slider .ui-slider-range,
    .woocommerce-page .widget_price_filter .ui-slider .ui-slider-range,
    .woocommerce #content input.button.alt,
    .woocommerce #respond input#submit.alt,
    .woocommerce a.button.alt,
    .woocommerce button.button.alt,
    .woocommerce input.button.alt,
    .woocommerce-page #content input.button.alt,
    .woocommerce-page #respond input#submit.alt,
    .woocommerce-page a.button.alt,
    .woocommerce-page button.button.alt,
    .woocommerce-page input.button.alt,
    .woocommerce #content input.button:hover,
    .woocommerce #respond input#submit:hover,
    .woocommerce a.button:hover,
    .woocommerce button.button:hover,
    .woocommerce input.button:hover,
    .woocommerce-page #content input.button:hover,
    .woocommerce-page #respond input#submit:hover,
    .woocommerce-page a.button:hover,
    .woocommerce-page button.button:hover,
    .woocommerce-page input.button:hover,
    .woocommerce .product-item-box .jckqvBtn,
    .woocommerce .shop-product .summary .yith-wcwl-wishlistexistsbrowse a:hover,
    .woocommerce .shop-product .summary .yith-wcwl-wishlistaddedbrowse a:hover,
    .woocommerce .shop-product .summary .yith-wcwl-add-button a:hover,
    .woocommerce .shop-product .summary .compare.button:hover,
    #jckqv_summary .simple.single_add_to_cart_button:hover,
    .woocommerce .shop-product .summary .cart button,
    .woocommerce .quantity .plus:hover,
    .woocommerce .quantity .minus:hover,
    .woocommerce #content nav.woocommerce-pagination ul li,
    .woocommerce nav.woocommerce-pagination ul li,
    .woocommerce-page #content nav.woocommerce-pagination ul li,
    .woocommerce-page nav.woocommerce-pagination ul li,
    .flatmarket-button a:hover,
    .tp-leftarrow:hover,
    .tp-rightarrow:hover,
    .jckqvBtn:hover,
    #jckqv .button,
    .comment-meta .reply a,
    .search-bar #searchform #searchsubmit:hover {
        background-color: <?php echo $theme_hover_color; ?>;
    }
    .sidebar .widget_calendar tbody td a,
    .woocommerce .widget_layered_nav ul li.chosen a,
    .woocommerce-page .widget_layered_nav ul li.chosen a,
    .woocommerce .widget_layered_nav_filters ul li a,
    .woocommerce-page .widget_layered_nav_filters ul li a,
    blockquote {
        border-color: <?php echo $theme_hover_color; ?>;
    }
    .header-menu-bg {
        background-color: <?php echo $theme_header_bg_color; ?>;
    }
    .header-menu li a,
    .header-info-text {
        color: <?php echo $theme_header_link_color; ?>;
    }
    .navbar .container {
        background-color: <?php echo $theme_cat_menu_bg_color; ?>;
    }
    .navbar .nav > li > a {
        color: <?php echo $theme_cat_menu_link_color; ?>;
    }
    
    a,
    .sidebar .widget_product_categories .children a,
    .sidebar .widget_pages ul li li a,
    .sidebar .widget_nav_menu ul li li a,
    .woocommerce .woocommerce-breadcrumb a {
        color: <?php echo $theme_links_color; ?>;
    }
    a:hover,
    a:focus,
    .homepage-latest-posts .post-title a:hover,
    .woocommerce .shop-product .summary .product_meta .post-social a:hover,
    .footer-social a:hover,
    .woocommerce .shop-product div.product .summary span.price,
    .woocommerce .shop-product div.product .summary p.price,
    .woocommerce .shop-product #content div.product .summary span.price,
    .woocommerce .shop-product  #content div.product .summary p.price,
    .woocommerce-page .shop-product div.product .summary span.price,
    .woocommerce-page .shop-product div.product .summary p.price,
    .woocommerce-page .shop-product #content div.product .summary span.price,
    .woocommerce-page .shop-product #content div.product .summary p.price,
    .woocommerce div.product .woocommerce-tabs ul.tabs li.active a,
    #jckqv .price ins,
    #jckqv .price {
        color: <?php echo $theme_links_hover_color; ?>;
    }
    .widget_tag_cloud .tagcloud a:hover,
    .widget_product_tag_cloud .tagcloud a:hover {
        background-color: <?php echo $theme_links_hover_color; ?>;
    }
    .widget_tag_cloud .tagcloud a:hover,
    .widget_product_tag_cloud .tagcloud a:hover {
        border-color: <?php echo $theme_links_hover_color; ?>;
    }
    .header-menu li a {
        color: <?php echo $theme_header_link_color; ?>;
    }
    .navbar .nav > li > a {
        color: <?php echo $theme_cat_menu_link_color; ?>;
    }
    .nav .sub-menu li a, 
    .nav .children li a,
    .nav .sub-menu li li a, 
    .nav .children li li a {
        background-color: <?php echo $theme_cat_submenu_1lvl_bg_color; ?>;
    }
    .nav .sub-menu li a, 
    .nav .children li a {
        color: <?php echo $theme_cat_submenu_1lvl_link_color; ?>;
    }
    .woocommerce ul.products li.product .product-item-box {
        background-color: <?php echo $theme_product_background_color; ?>;
    }
    .footer-sidebar-2-wrapper {
        background-color: <?php echo $theme_footer_color; ?>;
    }
    .footer-container a,
    footer a {
        color: <?php echo $theme_footer_link_color; ?>;
    }
    .widget_tag_cloud .tagcloud a,
    .widget_product_tag_cloud .tagcloud a {
        border-color: <?php echo $theme_footer_link_color; ?>;
    }
    .footer-container h2.widgettitle {
        color: <?php echo $theme_footer_header_color; ?>;
    }
    .footer-container,
    footer {
        color: <?php echo $theme_footer_text_color; ?>;
    }
    .woocommerce .page-title,
    .page-item-title h1,
    #jckqv h1,
    .products-module h2,
    .wpb_heading.wpb_teaser_grid_heading {
        color: <?php echo $theme_title_color; ?>;
    }
    .sidebar .widgettitle,
    .woocommerce .upsells h2, .woocommerce .related h2 {
        color: <?php echo $theme_widget_title_color; ?>;
    }
    .post-social,
    .post-social a,
    .woocommerce .shop-product .summary .yith-wcwl-add-to-wishlist,
    .woocommerce .shop-product .summary .cart,
    .woocommerce .shop-product .short-description,
    body .select2-container .select2-choice,
    body .select2-drop-active {
        border-color: <?php echo $theme_productpage_border_color; ?>;
    }
    .blog-post .post-content,
    .shopping-cart .shopping-cart-content,
    .homepage-latest-posts .isotope-inner,
    .author-bio,
    .widget_facebook_right .facebook_box,
    .widget_custom_box_right .custom_box,
    .sidebar .widget_calendar tbody td.pad,
    .sidebar .widget_calendar tfoot td.pad,
    .sidebar .widget_product_categories .children a,
    .sidebar .widget_pages ul li li a,
    .sidebar .widget_nav_menu ul li li a,
    .woocommerce-page div.product .woocommerce-tabs .panel,
    .woocommerce div.product .woocommerce-tabs ul.tabs li,
    .woocommerce #content div.product .woocommerce-tabs ul.tabs li,
    .woocommerce-page div.product .woocommerce-tabs ul.tabs li,
    .woocommerce-page #content div.product .woocommerce-tabs ul.tabs li,
    .woocommerce div.product .woocommerce-tabs ul.tabs li.active,
    .shop-content .entry-summary,
    .comment-body,
    body .select2-drop,
    .page article,
    .widget_twitter_right .twitter_box,
    .woocommerce .woocommerce-message, .woocommerce .woocommerce-error, .woocommerce .woocommerce-info, .woocommerce-page .woocommerce-message, .woocommerce-page .woocommerce-error, .woocommerce-page .woocommerce-info {
        background-color: <?php echo $theme_content_bg_color; ?>;
    }
    @media (max-width: 767px) {
        #menu-categories {
            background-color: <?php echo $theme_content_bg_color; ?>;
        }
        .navbar .nav .sub-menu li a:hover {
            color: <?php echo $theme_links_hover_color; ?>;;
        }
        .navbar .nav li a {
            color: <?php echo $theme_links_color; ?>;
        }
    }
    .shopping-cart .shopping-cart-icon {
        background-color: <?php echo $theme_carticon_bg_color; ?>;
    }
    .shopping-cart .shopping-cart-count {
        background-color: <?php echo $theme_cartcounter_bg_color; ?>;
    }
    .woocommerce .product-item-box a.add_to_cart_button:hover,
    .woocommerce .product-item-box a.product_type_simple:hover,
    .woocommerce .product-item-box a.product_type_grouped:hover,
    .woocommerce .product-item-box .product-buttons .yith-wcwl-wishlistexistsbrowse a:hover,
    .woocommerce .product-item-box .product-buttons .yith-wcwl-wishlistaddedbrowse a:hover,
    .woocommerce .product-item-box .product-buttons .yith-wcwl-add-button a:hover,
    .woocommerce .product-item-box .product-buttons .compare-button a:hover,
    .woocommerce .shop-product .summary .compare-button a:hover {
        color: <?php echo $theme_productbuttons_hover_color; ?>;
    }
    footer {
        background-color: <?php echo $theme_copyfooter_bg_color; ?>;
    }
    .woocommerce ul.products li.product .onsale, 
    .woocommerce-page ul.products li.product .onsale, 
    .woocommerce span.onsale, .woocommerce-page span.onsale,
    #jckqv .onsale { 
        background-color: <?php echo $theme_salebadge_bg_color; ?>;
    }
    <?php if(isset($theme_options['megamenu_override']) && $theme_options['megamenu_override']): ?>
    /* 
    *   Mega menu styles overrides
     */
    #mega_main_menu.primary > .menu_holder > .mmm_fullwidth_container {
        background: none;
    }
    #mega_main_menu.primary {
        min-height: 69px;
    }
    /* Reset - current/hover item */
    #mega_main_menu.primary > .menu_holder > .menu_inner > ul > li:hover > .item_link, 
    #mega_main_menu.primary > .menu_holder > .menu_inner > ul > li > .item_link:hover, 
    #mega_main_menu.primary > .menu_holder > .menu_inner > ul > li > .item_link:focus, 
    #mega_main_menu.primary > .menu_holder > .menu_inner > ul > li.current-menu-ancestor > .item_link, 
    #mega_main_menu.primary > .menu_holder > .menu_inner > ul > li.current-menu-item > .item_link {
        background: none;
        color: <?php echo $theme_cat_menu_link_color; ?>;
    }
    /* Current top menu item */
    #mega_main_menu.primary > .menu_holder > .menu_inner > ul > li.current-menu-ancestor > .item_link, #mega_main_menu.primary > .menu_holder > .menu_inner > ul > li.current-menu-ancestor > .item_link *, #mega_main_menu.primary > .menu_holder > .menu_inner > ul > li.current-menu-item > .item_link * {
        color: <?php echo $theme_cat_menu_link_color; ?>;
    }
    #mega_main_menu.primary > .menu_holder > .menu_inner > ul > li.current-menu-ancestor, #mega_main_menu.primary > .menu_holder > .menu_inner > ul > li.current-menu-ancestor, #mega_main_menu.primary > .menu_holder > .menu_inner > ul > li.current-menu-item {
        background-color: <?php echo $theme_main_color; ?>;
    }
    /* Hover top menu item text */
    #mega_main_menu.primary > .menu_holder > .menu_inner > ul > li:hover > .item_link, 
    #mega_main_menu.primary > .menu_holder > .menu_inner > ul > li > .item_link:hover, 
    #mega_main_menu.primary > .menu_holder > .menu_inner > ul > li > .item_link:focus, 
    #mega_main_menu.primary > .menu_holder > .menu_inner > ul > li:hover > .item_link *, 
    #mega_main_menu.primary > .menu_holder > .menu_inner > ul > li.current-menu-ancestor > .item_link, 
    #mega_main_menu.primary > .menu_holder > .menu_inner > ul > li.current-menu-ancestor > .item_link * {
        color: <?php echo $theme_cat_menu_link_color; ?>;
    }
    #mega_main_menu.primary > .menu_holder > .menu_inner > ul > li:not(.nav_search_box):hover {
        background-color: <?php echo $theme_main_color; ?>;
    }
    /* Menu items */
    #mega_main_menu.primary > .menu_holder > .menu_inner > .nav_logo > .mobile_toggle > .mobile_button, #mega_main_menu.primary > .menu_holder > .menu_inner > ul > li > .item_link, #mega_main_menu.primary > .menu_holder > .menu_inner > ul > li > .item_link .link_text, #mega_main_menu.primary > .menu_holder > .menu_inner > ul > li.nav_search_box *, #mega_main_menu.primary > .menu_holder > .menu_inner > ul > li .post_details > .post_title, #mega_main_menu.primary > .menu_holder > .menu_inner > ul > li .post_details > .post_title > .item_link {
        font-weight: bold;
        font-size: 13px;
        text-transform: uppercase;
    }
    #mega_main_menu.primary ul li .mega_dropdown > li > .item_link, #mega_main_menu.primary ul li .mega_dropdown > li > .item_link .link_text, #mega_main_menu.primary ul li .mega_dropdown, #mega_main_menu.primary > .menu_holder > .menu_inner > ul > li .post_details > .post_description {
        font-size: 14px;
    }
    /* Reset - all items */
    #mega_main_menu.primary.primary_style-buttons > .menu_holder > .menu_inner > .nav_logo > .mobile_toggle, 
    #mega_main_menu.primary > .menu_holder > .menu_inner > ul > li > .item_link {
        background: none;
    }
    #mega_main_menu.primary > .menu_holder > .menu_inner > .nav_logo > .mobile_toggle > .mobile_button, 
    #mega_main_menu.primary > .menu_holder > .menu_inner > ul > li > .item_link, 
    #mega_main_menu.primary > .menu_holder > .menu_inner > ul > li > .item_link * {
        color: <?php echo $theme_cat_menu_link_color; ?>;
        text-transform: uppercase;
        font-weight: bold;
    }
    /* Item separator */
    #mega_main_menu.direction-horizontal > .menu_holder > .menu_inner > ul > li {
        padding-top: 9px;
        padding-bottom: 10px;
    }
    #mega_main_menu.direction-horizontal > .menu_holder > .menu_inner .nav_logo {
        padding-top: 9px;
        padding-bottom: 10px;
    }
    #mega_main_menu > .menu_holder > .menu_inner > ul > li.nav_search_box {
        margin-top: 9px;
    }
    #mega_main_menu.direction-horizontal > .menu_holder > .menu_inner > ul > li:first-child {
        border-left: 0;
    }
    #mega_main_menu.direction-horizontal > .menu_holder > .menu_inner > ul > li.nav_search_box {
        border: 0;
        color: <?php echo $theme_cat_menu_link_color; ?>;
    }
    #mega_main_menu.direction-horizontal > .menu_holder > .menu_inner > ul > li > .item_link:before, #mega_main_menu.direction-horizontal > .menu_holder > .menu_inner > .nav_logo:before, #mega_main_menu.direction-horizontal > .menu_holder > .menu_inner > ul > li.nav_search_box:before {
        background-image: none;
    }
   
    /* Text and links color */
    #mega_main_menu.primary > .menu_holder > .menu_inner > ul > li .post_details > .post_icon > i, #mega_main_menu.primary > .menu_holder > .menu_inner > ul > li .mega_dropdown .item_link *, #mega_main_menu.primary > .menu_holder > .menu_inner > ul > li .mega_dropdown a, #mega_main_menu.primary > .menu_holder > .menu_inner > ul > li .mega_dropdown a *, #mega_main_menu.primary ul li.default_dropdown .mega_dropdown > li > .item_link *, #mega_main_menu.primary ul li.multicolumn_dropdown .mega_dropdown > li > .item_link #mega_main_menu.primary ul li.grid_dropdown .mega_dropdown > li > .item_link *, #mega_main_menu.primary ul li li .post_details a {
        color: inherit;
    }
     /* Submenu Item hover */
    #mega_main_menu.primary > .menu_holder > .menu_inner > ul > li .mega_dropdown .item_link:hover, 
    #mega_main_menu.primary > .menu_holder > .menu_inner > ul > li .mega_dropdown .item_link:focus, 
    #mega_main_menu.primary ul li.default_dropdown .mega_dropdown > li:hover > .item_link, 
    #mega_main_menu.primary ul li.default_dropdown .mega_dropdown > li.current-menu-item > .item_link, 
    #mega_main_menu.primary ul li.multicolumn_dropdown .mega_dropdown > li > .item_link:hover, 
    #mega_main_menu.primary ul li.multicolumn_dropdown .mega_dropdown > li.current-menu-item > .item_link, 
    #mega_main_menu.primary ul li.post_type_dropdown .mega_dropdown > li:hover > .item_link, 
    #mega_main_menu.primary ul li.post_type_dropdown .mega_dropdown > li > .item_link:hover, 
    #mega_main_menu.primary ul li.post_type_dropdown .mega_dropdown > li.current-menu-item > .item_link, 
    #mega_main_menu.primary ul li.grid_dropdown .mega_dropdown > li:hover > .processed_image, 
    #mega_main_menu.primary ul li.grid_dropdown .mega_dropdown > li:hover > .item_link, 
    #mega_main_menu.primary ul li.grid_dropdown .mega_dropdown > li > .item_link:hover, 
    #mega_main_menu.primary ul li.grid_dropdown .mega_dropdown > li.current-menu-item > .item_link, 
    #mega_main_menu.primary ul li.post_type_dropdown .mega_dropdown > li > .processed_image:hover {
       background: none;
       background-color: <?php echo $theme_main_color; ?>;
    }

    #mega_main_menu > .menu_holder > .menu_inner > ul > li.widgets_dropdown .mega_dropdown > li > .item_link, #mega_main_menu > .menu_holder > .menu_inner > ul > li.multicolumn_dropdown .mega_dropdown > li > .item_link {
        border: none;
    }
    #mega_main_menu.primary > .menu_holder > .menu_inner > ul > li .mega_dropdown .item_link *, #mega_main_menu.primary > .menu_holder > .menu_inner > ul > li .mega_dropdown .item_link *, #mega_main_menu.primary ul li.default_dropdown .mega_dropdown > li > .item_link *, #mega_main_menu.primary ul li.default_dropdown .mega_dropdown > li.current-menu-item > .item_link *, #mega_main_menu.primary ul li.multicolumn_dropdown .mega_dropdown > li > .item_link *, #mega_main_menu.primary ul li.multicolumn_dropdown .mega_dropdown > li.current-menu-item > .item_link *, #mega_main_menu.primary ul li.post_type_dropdown .mega_dropdown > li > .item_link *, #mega_main_menu.primary ul li.post_type_dropdown .mega_dropdown > li.current-menu-item > .item_link *, #mega_main_menu.primary ul li.grid_dropdown .mega_dropdown > li > .item_link *, #mega_main_menu.primary ul li.grid_dropdown .mega_dropdown > li a *, #mega_main_menu.primary ul li.grid_dropdown .mega_dropdown > li.current-menu-item > .item_link *, #mega_main_menu.primary ul li.post_type_dropdown .mega_dropdown > li > .processed_image > .cover > a > i,
    #mega_main_menu > .menu_holder > .menu_inner > ul > li.default_dropdown.drop_to_right .mega_dropdown li > .item_link:before {
        color: <?php echo $theme_cat_submenu_1lvl_link_color; ?>;
    }
    #mega_main_menu.primary > .menu_holder > .menu_inner > ul > li .mega_dropdown * {
        color: <?php echo $theme_cat_submenu_1lvl_link_color; ?>;
    }
    /* Submenu hover color */
    #mega_main_menu.primary > .menu_holder > .menu_inner > ul > li .mega_dropdown .item_link:hover *, #mega_main_menu.primary > .menu_holder > .menu_inner > ul > li .mega_dropdown .item_link:focus *, #mega_main_menu.primary ul li.default_dropdown .mega_dropdown > li:hover > .item_link *, #mega_main_menu.primary ul li.default_dropdown .mega_dropdown > li.current-menu-item > .item_link *, #mega_main_menu.primary ul li.multicolumn_dropdown .mega_dropdown > li > .item_link:hover *, #mega_main_menu.primary ul li.multicolumn_dropdown .mega_dropdown > li.current-menu-item > .item_link *, #mega_main_menu.primary ul li.post_type_dropdown .mega_dropdown > li:hover > .item_link *, #mega_main_menu.primary ul li.post_type_dropdown .mega_dropdown > li.current-menu-item > .item_link *, #mega_main_menu.primary ul li.grid_dropdown .mega_dropdown > li:hover > .item_link *, #mega_main_menu.primary ul li.grid_dropdown .mega_dropdown > li a:hover *, #mega_main_menu.primary ul li.grid_dropdown .mega_dropdown > li.current-menu-item > .item_link *, #mega_main_menu.primary ul li.post_type_dropdown .mega_dropdown > li > .processed_image:hover > .cover > a > i {
        color: <?php echo $theme_cat_menu_link_color; ?>;
    }

    /* Drop down menus */
    #mega_main_menu > .menu_holder > .menu_inner > ul > li.default_dropdown > ul, #mega_main_menu > .menu_holder > .menu_inner > ul > li.default_dropdown li > ul, #mega_main_menu > .menu_holder > .menu_inner > ul > li.multicolumn_dropdown > ul, #mega_main_menu > .menu_holder > .menu_inner > ul > li.widgets_dropdown > ul, #mega_main_menu > .menu_holder > .menu_inner > ul > li.post_type_dropdown > ul, #mega_main_menu > .menu_holder > .menu_inner > ul > li.grid_dropdown > ul, #mega_main_menu > .menu_holder > .menu_inner > ul > li.post_type_dropdown .mega_dropdown > li.post_item .post_details, #mega_main_menu > .menu_holder > .menu_inner > ul > li.grid_dropdown .mega_dropdown > li .post_details {
        box-shadow: none;
    }
    #mega_main_menu.primary > .menu_holder > .menu_inner > ul > li.default_dropdown .mega_dropdown, #mega_main_menu.primary > .menu_holder > .menu_inner > ul > li > .mega_dropdown, #mega_main_menu.primary > .menu_holder > .menu_inner > ul > li .mega_dropdown > li .post_details {
        background-color: <?php echo $theme_cat_submenu_1lvl_bg_color; ?>;
    }
    #mega_main_menu.primary > .menu_holder > .menu_inner > ul > li.default_dropdown:not(.multicolumn_dropdown) .mega_dropdown .mega_dropdown, #mega_main_menu.primary > .menu_holder > .menu_inner > ul > li:not(.multicolumn_dropdown) > .mega_dropdown .mega_dropdown, #mega_main_menu.primary > .menu_holder > .menu_inner > ul > li:not(.multicolumn_dropdown) .mega_dropdown .mega_dropdown > li:not(.multicolumn_dropdown) .post_details {
        background-color: <?php echo $theme_cat_submenu_1lvl_bg_color; ?>;
    }
    #mega_main_menu > .menu_holder > .menu_inner > ul > li.default_dropdown .mega_dropdown > li > .item_link {
        border: none;
        padding: 10px 15px;
    }
    #mega_main_menu > .menu_holder > .menu_inner > ul > li.multicolumn_dropdown .mega_dropdown > li > .item_link {
        padding: 8px 15px;
    }
    /* Search box */
    #mega_main_menu.primary > .menu_holder > .menu_inner > ul > li.nav_search_box > #mega_main_menu_searchform {
        background-color: <?php echo $theme_main_color; ?>;
    }
    #mega_main_menu > .menu_holder > .menu_inner > ul > li.default_dropdown.drop_to_right .mega_dropdown li:hover > .item_link:before {
        color: <?php echo $theme_cat_menu_link_color; ?>;
    }
    #mega_main_menu > .menu_holder > .menu_inner > .mega_main_menu_ul > li.multicolumn_dropdown > .mega_dropdown > .menu-item-object-product_cat > a > .link_content > .link_text {
        font-weight: bold;
    }
    .navbar {
        padding-bottom: 0!important;
    }
    #mega_main_menu.primary > .menu_holder > .menu_inner > ul > li.nav_search_box .field, #mega_main_menu.primary > .menu_holder > .menu_inner > ul > li.nav_search_box *, #mega_main_menu.primary > .menu_holder > .menu_inner > ul > li .icosearch {
        color: inherit;
    }
    @media (max-width: 767px)  {
        #mega_main_menu.primary {
            background-color: <?php echo $theme_cat_menu_bg_color; ?>;
        }
        #mega_main_menu > .menu_holder > .menu_inner > ul > li > .item_link:after {
            right: 10px;
        }
    }
    
    <?php endif; ?>
    </style>
    <script>
   
    <?php if(isset($theme_options['custom_js_code'])) { echo $theme_options['custom_js_code']; } ?>
    </script>
    <?php
}
add_action( 'wp_head' , 'flatmarket_custom_styles' );
