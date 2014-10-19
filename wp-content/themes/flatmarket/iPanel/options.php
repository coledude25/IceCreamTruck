<?php

/**
 * SETTINGS TAB
 **/
$ipanel_flatmarket_tabs[] = array(
	'name' => 'Main Settings',
	'id' => 'main_settings'
);

$ipanel_flatmarket_option[] = array(
	"type" => "StartTab",
	"id" => "main_settings"
);

$ipanel_flatmarket_option[] = array(
	"name" => "Enable Parallax effects for pages backgrounds and parallax blocks",
	"id" => "enable_parallax",
	"std" => true,
	"field_options" => array(
		"box_label" => "Check Me!"
	),
	"desc" => "You can turn on/off parallax effects for scrolling here",
	"type" => "checkbox",
);

$ipanel_flatmarket_option[] = array(
	"name" => "Show Homepage Revolution slider fullwidth",
	"id" => "revolution_fullwidth",
	"std" => false,
	"field_options" => array(
		"box_label" => "Check Me!"
	),
	"desc" => "If turned on Revolution Slider on homepage will scale to full browser width",
	"type" => "checkbox",
);

$ipanel_flatmarket_option[] = array(
	"name" => "Enable theme CSS3 animations",
	"id" => "enable_theme_animations",
	"std" => true,
	"field_options" => array(
		"box_label" => "Check Me!"
	),
	"desc" => "Enable colors and background colors fade effects",
	"type" => "checkbox",
);

$ipanel_flatmarket_option[] = array(
	"name" => "Upload Favicon",
	"id" => "favicon_image",
	"field_options" => array(
		"std" => get_template_directory_uri().'/img/favicon.png'
	),
	"desc" => "Upload your site Favicon in PNG format (32x32px)",
	"type" => "qup",
);

$ipanel_flatmarket_option[] = array(
	"name" => "Show author info and avatar after blog posts",
	"id" => "enable_author_info",
	"std" => true,
	"field_options" => array(
		"box_label" => "Check Me!"
	),
	"desc" => "",
	"type" => "checkbox",
);

$ipanel_flatmarket_option[] = array(
	"type" => "EndTab"
);
/**
 * Header TAB
 **/
$ipanel_flatmarket_tabs[] = array(
	'name' => 'Header',
	'id' => 'header_settings'
);

$ipanel_flatmarket_option[] = array(
	"type" => "StartTab",
	"id" => "header_settings"
);

$ipanel_flatmarket_option[] = array(
	"name" => "Header info text",
	"id" => "header_info_editor",
	"std" => '<i class="fa fa-mobile"></i> 8(802)234-5678 <i class="fa fa-clock-o"></i>
 Call us Monday - Saturday: 8:30 am - 6:00 pm',
	"desc" => "Displayed in top header",
	"field_options" => array(
		'media_buttons' => false
	),
	"type" => "wp_editor",
);

$ipanel_flatmarket_option[] = array(
	"name" => "Header logo info text",
	"id" => "header_info2_editor",
	"std" => '<i class="fa fa-exclamation-circle"></i><strong>Free shipping</strong> on all orders under $100',
	"desc" => "Displayed after logo",
	"field_options" => array(
		'media_buttons' => false
	),
	"type" => "wp_editor",
);

$ipanel_flatmarket_option[] = array(
	"type" => "EndTab"
);

/**
 * FOOTER TAB
 **/
$ipanel_flatmarket_tabs[] = array(
	'name' => 'Footer',
	'id' => 'footer_settings'
);

$ipanel_flatmarket_option[] = array(
	"type" => "StartTab",
	"id" => "footer_settings"
);
$ipanel_flatmarket_option[] = array(
	
	"name" => "Social icons",   
	"type" => "StartSection",
	"field_options" => array(
		"show" => true // Set true to show items by default.
	)
);
$ipanel_flatmarket_option[] = array(
	"type" => "info",
	"name" => "Leave URL fields blank to hide this social icons",
	"field_options" => array(
		"style" => 'alert'
	)
);
$ipanel_flatmarket_option[] = array(
	"name" => "Facebook Page url",
	"id" => "facebook",
	"std" => "",
	"desc" => "",
	"type" => "text",
);
$ipanel_flatmarket_option[] = array(
	"name" => "Vkontakte page url",
	"id" => "vk",
	"std" => "",
	"desc" => "",
	"type" => "text",
);
$ipanel_flatmarket_option[] = array(
	"name" => "Twitter Page url",
	"id" => "twitter",
	"std" => "",
	"desc" => "",
	"type" => "text",
);
$ipanel_flatmarket_option[] = array(
	"name" => "Google+ Page url",
	"id" => "google-plus",
	"std" => "",
	"desc" => "",
	"type" => "text",
);
$ipanel_flatmarket_option[] = array(
	"name" => "LinkedIn Page url",
	"id" => "linkedin",
	"std" => "",
	"desc" => "",
	"type" => "text",
);
$ipanel_flatmarket_option[] = array(
	"name" => "Dribbble Page url",
	"id" => "dribbble",
	"std" => "",
	"desc" => "",
	"type" => "text",
);
$ipanel_flatmarket_option[] = array(
	"name" => "Instagram Page url",
	"id" => "instagram",
	"std" => "",
	"desc" => "",
	"type" => "text",
);
$ipanel_flatmarket_option[] = array(
	"name" => "Tumblr page url",
	"id" => "tumblr",
	"std" => "",
	"desc" => "",
	"type" => "text",
);
$ipanel_flatmarket_option[] = array(
	"name" => "Pinterest page url",
	"id" => "pinterest",
	"std" => "",
	"desc" => "",
	"type" => "text",
);
$ipanel_flatmarket_option[] = array(
	"name" => "Vimeo page url",
	"id" => "vimeo-square",
	"std" => "",
	"desc" => "",
	"type" => "text",
);
$ipanel_flatmarket_option[] = array(
	"name" => "YouTube page url",
	"id" => "youtube",
	"std" => "",
	"desc" => "",
	"type" => "text",
);
$ipanel_flatmarket_option[] = array(
	"name" => "Skype url",
	"id" => "skype",
	"std" => "",
	"desc" => "",
	"type" => "text",
);
$ipanel_flatmarket_option[] = array(
		"type" => "EndSection"
);
$ipanel_flatmarket_option[] = array(
	
	"name" => "Payment icons",   
	"type" => "StartSection",
	"field_options" => array(
		"show" => true // Set true to show items by default.
	)
);
$ipanel_flatmarket_option[] = array(
	
	"name" => "Footer Payment Icons",   
	"id" => "footer_payment_icons",
	"options" => array(
		"visa" => "Visa",
		"visaelectron" => "Visa Electron",
		"mc" => "MasterCard",
		"discover" => "Discover",
		"cirrus" => "Cirrus",
		"ae" => "AmericanExpress",
		"paypal" => "PayPal",
		"maestro" => "Maestro"
	),
	"std" => false,
	"desc" => "You can add different accepted payments icons to your footer",
	"type" => "multicheckbox",
	"field_options" => array(
		
		"desc_in_tooltip" => false // If you wish the description be displayed in tooltip set this true.
		
	)
	
);
$ipanel_flatmarket_option[] = array(
		"type" => "EndSection"
);

$ipanel_flatmarket_option[] = array(
	"name" => "Footer copyright text",
	"id" => "footer_copyright_editor",
	"std" => "Powered by <a href='http://themeforest.net/user/dedalx/' target='_blank'>FlatMarket - Premium Wordpress Theme</a>",
	"desc" => "",
	"field_options" => array(
		'media_buttons' => false
	),
	"type" => "wp_editor",
);

$ipanel_flatmarket_option[] = array(
	"type" => "EndTab"
);
/**
 * MEGAMENU TAB
 **/
$ipanel_flatmarket_tabs[] = array(
	'name' => 'MegaMenu',
	'id' => 'megamenu_settings'
);

$ipanel_flatmarket_option[] = array(
	"type" => "StartTab",
	"id" => "megamenu_settings"
);
$ipanel_flatmarket_option[] = array(
	"type" => "info",
	"name" => "If you installed MegaMenu plugin provided with theme you can configure it <a href='admin.php?page=mega_main_menu_options'>here</a>.",
	"field_options" => array(
		"style" => 'alert'
	)
);
$ipanel_flatmarket_option[] = array(
	"type" => "info",
	"name" => "You can manage your theme menus <a href='nav-menus.php'>here</a>.",
	"field_options" => array(
		"style" => 'alert'
	)
);
$ipanel_flatmarket_option[] = array(
	"name" => "Override MegaMenu plugin styles with theme colors/skins",
	"id" => "megamenu_override",
	"std" => true,
	"field_options" => array(
		"box_label" => "Check Me!"
	),
	"desc" => "If you want to use MegaMenu plugin styles and skins settigns instead of theme colors and skins disable this checkbox",
	"type" => "checkbox",
);
$ipanel_flatmarket_option[] = array(
	"type" => "EndTab"
);
/**
 * SIDEBAR TAB
 **/
$ipanel_flatmarket_tabs[] = array(
	'name' => 'Sidebar',
	'id' => 'sidebar_settings'
);

$ipanel_flatmarket_option[] = array(
	"type" => "StartTab",
	"id" => "sidebar_settings"
);
$ipanel_flatmarket_option[] = array(
	"name" => "Pages sidebar position",
	"id" => "page_sidebar_position",
	"std" => "disable",
	"options" => array(
		"left" => "Left",
		"right" => "Right",
		"disable" => "Disable sidebar"
	),
	"desc" => "",
	"type" => "select",
);
$ipanel_flatmarket_option[] = array(
	"name" => "Blog page sidebar position",
	"id" => "blog_sidebar_position",
	"std" => "right",
	"options" => array(
		"left" => "Left",
		"right" => "Right",
		"disable" => "Disable sidebar"
	),
	"desc" => "",
	"type" => "select",
);
$ipanel_flatmarket_option[] = array(
	"name" => "Blog Archive page sidebar position",
	"id" => "archive_sidebar_position",
	"std" => "right",
	"options" => array(
		"left" => "Left",
		"right" => "Right",
		"disable" => "Disable sidebar"
	),
	"desc" => "",
	"type" => "select",
);
$ipanel_flatmarket_option[] = array(
	"name" => "Blog Search page sidebar position",
	"id" => "search_sidebar_position",
	"std" => "right",
	"options" => array(
		"left" => "Left",
		"right" => "Right",
		"disable" => "Disable sidebar"
	),
	"desc" => "",
	"type" => "select",
);
$ipanel_flatmarket_option[] = array(
	"name" => "Blog post sidebar position",
	"id" => "post_sidebar_position",
	"std" => "right",
	"options" => array(
		"left" => "Left",
		"right" => "Right",
		"disable" => "Disable sidebar"
	),
	"desc" => "",
	"type" => "select",
);
$ipanel_flatmarket_option[] = array(
	"name" => "WooCommerce listing pages sidebar position",
	"id" => "shop_sidebar_position",
	"std" => "left",
	"options" => array(
		"left" => "Left",
		"right" => "Right",
		"disable" => "Disable sidebar"
	),
	"desc" => "",
	"type" => "select",
);
$ipanel_flatmarket_option[] = array(
	"name" => "WooCommerce product page sidebar position",
	"id" => "product_sidebar_position",
	"std" => "left",
	"options" => array(
		"left" => "Left",
		"right" => "Right",
		"disable" => "Disable sidebar"
	),
	"desc" => "",
	"type" => "select",
);
$ipanel_flatmarket_option[] = array(
	"type" => "EndTab"
);

/**
 * WOOCOMMERCE TAB
 **/
$ipanel_flatmarket_tabs[] = array(
	'name' => 'Woocommerce',
	'id' => 'shop_settings'
);
$ipanel_flatmarket_option[] = array(
	"type" => "StartTab",
	"id" => "shop_settings"
);
$ipanel_flatmarket_option[] = array(
	"name" => "Show social share buttons and counters on product pages",
	"id" => "shop_social_buttons_enable",
	"std" => true,
	"field_options" => array(
		"box_label" => "Check Me!"
	),
	"desc" => "",
	"type" => "checkbox",
);
$ipanel_flatmarket_option[] = array(
	"name" => "Enable Carousel for homepage product grids",
	"id" => "shop_show_more_enable",
	"std" => true,
	"field_options" => array(
		"box_label" => "Check Me!"
	),
	"desc" => "If you disable this option you will see products grids with all products (with limit that you set in WooCommerce shortcode)",
	"type" => "checkbox",
);

$ipanel_flatmarket_option[] = array(
	"name" => "Show WooCommerce search form in main menu",
	"id" => "woocommerce_show_search",
	"std" => true,
	"field_options" => array(
		"box_label" => "Check Me!"
	),
	"desc" => "Disable this option if you use another search widjet/plugin or don't want to have products search form in menu",
	"type" => "checkbox",
);
$ipanel_flatmarket_option[] = array(
	"name" => "Disable dropdown cart on top",
	"id" => "shop_disable_cartbox",
	"std" => false,
	"field_options" => array(
		"box_label" => "Check Me!"
	),
	"desc" => "You will not see cart dropdown with total on site top menu",
	"type" => "checkbox",
);
$ipanel_flatmarket_option[] = array(
	"name" => "Show Added to cart popup window",
	"id" => "shop_addedtocart_popup",
	"std" => false,
	"field_options" => array(
		"box_label" => "Check Me!"
	),
	"desc" => "",
	"type" => "checkbox",
);
$ipanel_flatmarket_option[] = array(
	"name" => "Enable Catalog mode (disable cart features)",
	"id" => "shop_catalog_mode_enable",
	"std" => false,
	"field_options" => array(
		"box_label" => "Check Me!"
	),
	"desc" => "Enable if you want to disable cart/checkout features and use your site as product catalog",
	"type" => "checkbox",
);
$ipanel_flatmarket_option[] = array(
	"name" => "Disable QuickView button in product boxes",
	"id" => "shop_hide_qv",
	"std" => false,
	"field_options" => array(
		"box_label" => "Check Me!"
	),
	"desc" => "",
	"type" => "checkbox",
);
$ipanel_flatmarket_option[] = array(
	"name" => "Disable WishList features",
	"id" => "shop_hide_wishlist",
	"std" => false,
	"field_options" => array(
		"box_label" => "Check Me!"
	),
	"desc" => "",
	"type" => "checkbox",
);
$ipanel_flatmarket_option[] = array(
	"name" => "Disable Compare features",
	"id" => "shop_hide_compare",
	"std" => false,
	"field_options" => array(
		"box_label" => "Check Me!"
	),
	"desc" => "",
	"type" => "checkbox",
);
$ipanel_flatmarket_option[] = array(
	"name" => "Enable product page custom tab display",
	"id" => "shop_product_custom_tab_enable",
	"std" => false,
	"field_options" => array(
		"box_label" => "Check Me!"
	),
	"desc" => "Show additional tab on product page with your content specified below",
	"type" => "checkbox",
);
$ipanel_flatmarket_option[] = array(
	"name" => "Product custom tab title",
	"id" => "shop_product_custom_tab_title",
	"std" => "",
	"desc" => "",
	"type" => "text",
);
$ipanel_flatmarket_option[] = array(
	"name" => "Product custom tab text",
	"id" => "shop_product_custom_tab_text",
	"std" => "",
	"desc" => "",
	"field_options" => array(
		'media_buttons' => false
	),
	"type" => "wp_editor",
);
$ipanel_flatmarket_option[] = array(
	"type" => "EndTab"
);

/**
 * FLOATING BOX
 **/
$ipanel_flatmarket_tabs[] = array(
	'name' => 'Side blocks',
	'id' => 'sideblock_settings'
);

$ipanel_flatmarket_option[] = array(
	"type" => "StartTab",
	"id" => "sideblock_settings"
);
$ipanel_flatmarket_option[] = array(
	"name" => "Display Twitter Side Block",
	"id" => "sideblock_show_twitter",
	"std" => false,
	"field_options" => array(
		"box_label" => "Check Me!"
	),
	"desc" => "Add floating block to the right with your Twitter feed",
	"type" => "checkbox",
);
$ipanel_flatmarket_option[] = array(
	"name" => "Twitter Side Block widget HTML code (paste code to TEXT mode tab in editor)",
	"id" => "sideblock_twitter_content",
	"std" => '<a class="twitter-timeline"  href="https://twitter.com/magniumthemes" data-widget-id="520625740711084032">Tweets by @magniumthemes</a>
            <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?\'http\':\'https\';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>',
	"desc" => "You can create new Twitter Widget and get it code <a href='https://twitter.com/settings/widgets/'>here</a>",
	"field_options" => array(
		'media_buttons' => false
	),
	"type" => "wp_editor",
);
$ipanel_flatmarket_option[] = array(
	"name" => "Display Facebook Side Block",
	"id" => "sideblock_show_facebook",
	"std" => false,
	"field_options" => array(
		"box_label" => "Check Me!"
	),
	"desc" => "Add floating block to the right with your Facebook Page Likebox",
	"type" => "checkbox",
);
$ipanel_flatmarket_option[] = array(
	"name" => "Facebook Page name / ID",
	"id" => "facebook_gid",
	"std" => "",
	"desc" => "Input your facebook page name or page ID",
	"type" => "text",
);
$ipanel_flatmarket_option[] = array(
	"name" => "Display Custom Side Block",
	"id" => "sideblock_show_custom",
	"std" => false,
	"field_options" => array(
		"box_label" => "Check Me!"
	),
	"desc" => "Add floating block with your content to the right of site",
	"type" => "checkbox",
);
$ipanel_flatmarket_option[] = array(
	"name" => "Custom Side Block content",
	"id" => "sideblock_custom_content",
	"std" => "Custom block content",
	"desc" => "Input your content to display it in custom floating block at the right",
	"field_options" => array(
		'media_buttons' => false
	),
	"type" => "wp_editor",
);

$ipanel_flatmarket_option[] = array(
	"type" => "EndTab"
);
/**
 * FONTS TAB
 **/

$ipanel_flatmarket_tabs[] = array(
	'name' => 'Fonts',
	'id' => 'font_settings'
);

$ipanel_flatmarket_option[] = array(
	"type" => "StartTab",
	"id" => "font_settings"
);

$ipanel_flatmarket_option[] = array(
	"name" => "Headers font",
	"id" => "header_font",
	"desc" => "Font used in headers. Default: PT Sans",
	"options" => array(
		"font-sizes" => array(
			" " => "Font Size",
			'11' => '11px',
			'12' => '12px',
			'13' => '13px',
			'14' => '14px',
			'15' => '15px',
			'16' => '16px',
			'17' => '17px',
			'18' => '18px',
			'19' => '19px',
			'20' => '20px',
			'21' => '21px',
			'22' => '22px',
			'23' => '23px',
			'24' => '24px',
			'25' => '25px',
			'26' => '26px',
			'27' => '27px',
			'28' => '28px',
			'29' => '29px',
			'30' => '30px',
			'31' => '31px',
			'32' => '32px',
			'33' => '33px',
			'34' => '34px',
			'35' => '35px',
			'36' => '36px',
			'37' => '37px',
			'38' => '38px',
			'39' => '39px',
			'40' => '40px'
		),
		"color" => false,
		"font-families" => iPanel::getGoogleFonts(),
		"font-styles" => false
	),
	"std" => array(
		"font-size" => '26',
		"font-family" => 'Open+Sans'
	),
	"type" => "typography"
);

$ipanel_flatmarket_option[] = array(
	"name" => "Body font",
	"id" => "body_font",
	"desc" => "Font used in other elements. Default: PT Sans",
	"options" => array(
		"font-sizes" => array(
			" " => "Font Size",
			'11' => '11px',
			'12' => '12px',
			'13' => '13px',
			'14' => '14px',
			'15' => '15px',
			'16' => '16px',
			'17' => '17px',
			'18' => '18px',
			'19' => '19px',
			'20' => '20px',
			'21' => '21px',
			'22' => '22px',
			'23' => '23px',
			'24' => '24px',
			'25' => '25px',
			'26' => '26px',
			'27' => '27px'
		),
		"color" => false,
		"font-families" => iPanel::getGoogleFonts(),
		"font-styles" => false
	),
	"std" => array(
		"font-size" => '14',
		"font-family" => 'Open+Sans'
	),
	"type" => "typography"
);
$ipanel_flatmarket_option[] = array(
	"name" => "Enable cyrillic support for Google Fonts",
	"id" => "font_cyrillic_enable",
	"std" => false,
	"field_options" => array(
		"box_label" => "Check Me!"
	),
	"desc" => "Use this if you use Russian Language on your site. Please note that not all Google Fonts support cyrilic.",
	"type" => "checkbox",
);
$ipanel_flatmarket_option[] = array(
	"type" => "EndTab"
);

/**
 * COLORS TAB
 **/

$ipanel_flatmarket_tabs[] = array(
	'name' => 'Colors',
	'id' => 'color_settings'
);

$ipanel_flatmarket_option[] = array(
	"type" => "StartTab",
	"id" => "color_settings",
);
$ipanel_flatmarket_option[] = array(
	"name" => "Predefined color skins",
	"id" => "color_skin_name",
	"std" => "none",
	"options" => array(
		"none" => "Use colors specified below",
		"default" => "FlatMarket (Default)",
		"green" => "Green Grass",
		"blue" => "Blue Ocean",
		"red" => "Red Sun",
		"black" => "Black and White",
		"pink" => "Pink in Dark",
		"orange" => "Orange Juice",
		"fencer" => "Fencer",
		"perfectum" => "Perfectum",
		"simplegreat" => "SimpleGreat"
	),
	"desc" => "Select one of predefined skins",
	"type" => "select",
);

$ipanel_flatmarket_option[] = array(
	"name" => "Body background color",
	"id" => "theme_body_color",
	"std" => "#ffffff",
	"desc" => "Used in many theme places, default: #ffffff",
	"field_options" => array(
		//'desc_in_tooltip' => true
	),
	"type" => "color",
);

$ipanel_flatmarket_option[] = array(
	"name" => "Body text color",
	"id" => "theme_text_color",
	"std" => "#393232",
	"desc" => "Used in many theme places, default: #393232",
	"field_options" => array(
		//'desc_in_tooltip' => true
	),
	"type" => "color",
);

$ipanel_flatmarket_option[] = array(
	"name" => "Theme links color",
	"id" => "theme_links_color",
	"std" => "#000000",
	"desc" => "Default: #000000",
	"field_options" => array(
		//'desc_in_tooltip' => true
	),
	"type" => "color",
);

$ipanel_flatmarket_option[] = array(
	"name" => "Theme links hover color",
	"id" => "theme_links_hover_color",
	"std" => "#008c8d",
	"desc" => "Default: #008c8d",
	"field_options" => array(
		//'desc_in_tooltip' => true
	),
	"type" => "color",
);

$ipanel_flatmarket_option[] = array(
	"name" => "Main theme color (Buttons color)",
	"id" => "theme_main_color",
	"std" => "#008c8d",
	"desc" => "Used in many theme places, buttons color, default: #008c8d",
	"field_options" => array(
		//'desc_in_tooltip' => true
	),
	"type" => "color",
);

$ipanel_flatmarket_option[] = array(
	"name" => "Hover theme color (Buttons hover)",
	"id" => "theme_hover_color",
	"std" => "#535353",
	"desc" => "Used in many theme places, buttons hover color, default: #535353",
	"field_options" => array(
		//'desc_in_tooltip' => true
	),
	"type" => "color",
);

$ipanel_flatmarket_option[] = array(
	"name" => "Header menu background color",
	"id" => "theme_header_bg_color",
	"std" => "#eef0f0",
	"desc" => "Default: #eef0f0",
	"field_options" => array(
		//'desc_in_tooltip' => true
	),
	"type" => "color",
);

$ipanel_flatmarket_option[] = array(
	"name" => "Header menu links/text color",
	"id" => "theme_header_link_color",
	"std" => "#868686",
	"desc" => "Default: #868686",
	"field_options" => array(
		//'desc_in_tooltip' => true
	),
	"type" => "color",
);

$ipanel_flatmarket_option[] = array(
	"name" => "Category menu background color",
	"id" => "theme_cat_menu_bg_color",
	"std" => "#535353",
	"desc" => "Default: #535353",
	"field_options" => array(
		//'desc_in_tooltip' => true
	),
	"type" => "color",
);

$ipanel_flatmarket_option[] = array(
	"name" => "Category menu links color",
	"id" => "theme_cat_menu_link_color",
	"std" => "#ffffff",
	"desc" => "Default: #ffffff",
	"field_options" => array(
		//'desc_in_tooltip' => true
	),
	"type" => "color",
);

$ipanel_flatmarket_option[] = array(
	"name" => "Category menu submenu background color",
	"id" => "theme_cat_submenu_1lvl_bg_color",
	"std" => "#f8f8f8",
	"desc" => "Default: #f8f8f8",
	"field_options" => array(
		//'desc_in_tooltip' => true
	),
	"type" => "color",
);

$ipanel_flatmarket_option[] = array(
	"name" => "Category menu submenu link color",
	"id" => "theme_cat_submenu_1lvl_link_color",
	"std" => "#000000",
	"desc" => "Default: #000000",
	"field_options" => array(
		//'desc_in_tooltip' => true
	),
	"type" => "color",
);

$ipanel_flatmarket_option[] = array(
	"name" => "Product box background color",
	"id" => "theme_product_background_color",
	"std" => "#535353",
	"desc" => "Used in product boxes, default: #535353",
	"field_options" => array(
		//'desc_in_tooltip' => true
	),
	"type" => "color",
);

$ipanel_flatmarket_option[] = array(
	"name" => "Footer background color",
	"id" => "theme_footer_color",
	"std" => "#2f2e2e",
	"desc" => "Default: #2f2e2e",
	"field_options" => array(
		//'desc_in_tooltip' => true
	),
	"type" => "color",
);

$ipanel_flatmarket_option[] = array(
	"name" => "Footer links color",
	"id" => "theme_footer_link_color",
	"std" => "#ffffff",
	"desc" => "Default: #ffffff",
	"field_options" => array(
		//'desc_in_tooltip' => true
	),
	"type" => "color",
);

$ipanel_flatmarket_option[] = array(
	"name" => "Footer headers color",
	"id" => "theme_footer_header_color",
	"std" => "#ffffff",
	"desc" => "Default: #ffffff",
	"field_options" => array(
		//'desc_in_tooltip' => true
	),
	"type" => "color",
);

$ipanel_flatmarket_option[] = array(
	"name" => "Footer text color",
	"id" => "theme_footer_text_color",
	"std" => "#ffffff",
	"desc" => "Default: #ffffff",
	"field_options" => array(
		//'desc_in_tooltip' => true
	),
	"type" => "color",
);

$ipanel_flatmarket_option[] = array(
	"name" => "Pages title color",
	"id" => "theme_title_color",
	"std" => "#252727",
	"desc" => "Default: #252727",
	"field_options" => array(
		//'desc_in_tooltip' => true
	),
	"type" => "color",
);

$ipanel_flatmarket_option[] = array(
	"name" => "Widgets title color",
	"id" => "theme_widget_title_color",
	"std" => "#252727",
	"desc" => "Default: #252727",
	"field_options" => array(
		//'desc_in_tooltip' => true
	),
	"type" => "color",
);

$ipanel_flatmarket_option[] = array(
	"name" => "Product page borders color",
	"id" => "theme_productpage_border_color",
	"std" => "#e8e5e5",
	"desc" => "Default: #e8e5e5",
	"field_options" => array(
		//'desc_in_tooltip' => true
	),
	"type" => "color",
);

$ipanel_flatmarket_option[] = array(
	"name" => "Content background color",
	"id" => "theme_content_bg_color",
	"std" => "#F8F8F8",
	"desc" => "Used in many theme places for content areas, default: #F8F8F8",
	"field_options" => array(
		//'desc_in_tooltip' => true
	),
	"type" => "color",
);

$ipanel_flatmarket_option[] = array(
	"name" => "Mini Cart icon background color",
	"id" => "theme_carticon_bg_color",
	"std" => "#00AFB3",
	"desc" => "Default: #00AFB3",
	"field_options" => array(
		//'desc_in_tooltip' => true
	),
	"type" => "color",
);
$ipanel_flatmarket_option[] = array(
	"name" => "Mini Cart item counter background color",
	"id" => "theme_cartcounter_bg_color",
	"std" => "#FFC32C",
	"desc" => "Default: #FFC32C",
	"field_options" => array(
		//'desc_in_tooltip' => true
	),
	"type" => "color",
);
$ipanel_flatmarket_option[] = array(
	"name" => "Product box buttons icons background color on hover",
	"id" => "theme_productbuttons_hover_color",
	"std" => "#afe0e1",
	"desc" => "Default: #afe0e1",
	"field_options" => array(
		//'desc_in_tooltip' => true
	),
	"type" => "color",
);
$ipanel_flatmarket_option[] = array(
	"name" => "Copyright footer background color",
	"id" => "theme_copyfooter_bg_color",
	"std" => "#181818",
	"desc" => "Default: #181818",
	"field_options" => array(
		//'desc_in_tooltip' => true
	),
	"type" => "color",
);
$ipanel_flatmarket_option[] = array(
	"name" => "Products Sale badge background color",
	"id" => "theme_salebadge_bg_color",
	"std" => "#f64f57",
	"desc" => "Default: #f64f57",
	"field_options" => array(
		//'desc_in_tooltip' => true
	),
	"type" => "color",
);

$ipanel_flatmarket_option[] = array(
	"type" => "EndTab"
);

/**
 * CUSTOM CODE TAB
 **/

$ipanel_flatmarket_tabs[] = array(
	'name' => 'Custom code',
	'id' => 'custom_code'
);

$ipanel_flatmarket_option[] = array(
	"type" => "StartTab",
	"id" => "custom_code",
);

$ipanel_flatmarket_option[] = array(
	"name" => "Custom JavaScript code",
	"id" => "custom_js_code",
	"std" => '',
	"field_options" => array(
		"language" => "javascript",
		"line_numbers" => true,
		"autoCloseBrackets" => true,
		"autoCloseTags" => true
	),
	"desc" => "This code will run in header",
	"type" => "code",
);

$ipanel_flatmarket_option[] = array(
	"name" => "Custom CSS styles",
	"id" => "custom_css_code",
	"std" => '',
	"field_options" => array(
		"language" => "json",
		"line_numbers" => true,
		"autoCloseBrackets" => true,
		"autoCloseTags" => true
	),
	"desc" => "This CSS code will be included in header",
	"type" => "code",
);

$ipanel_flatmarket_option[] = array(
	"type" => "EndTab"
);

/**
 * EXPORT TAB
 **/

$ipanel_flatmarket_tabs[] = array(
	'name' => 'Export',
	'id' => 'export_settings'
);

$ipanel_flatmarket_option[] = array(
	"type" => "StartTab",
	"id" => "export_settings"
);
	
$ipanel_flatmarket_option[] = array(
	"name" => "Export with Download Possibility",
	"type" => "export",
	"desc" => "This is a sample of export field."
);

$ipanel_flatmarket_option[] = array(
	"type" => "EndTab"
);

/**
 * IMPORT TAB
 **/

$ipanel_flatmarket_tabs[] = array(
	'name' => 'Import',
	'id' => 'import_settings'
);

$ipanel_flatmarket_option[] = array(
	"type" => "StartTab",
	"id" => "import_settings"
);

$ipanel_flatmarket_option[] = array(
	"name" => "Import",
	"type" => "import",
	"desc" => "This is a sample of import field."
);

$ipanel_flatmarket_option[] = array(
	"type" => "EndTab"
);

/**
 * CONFIGURATION
 **/

$ipanel_configs = array(
	'ID'=> 'FLATMARKET_PANEL', 
	'menu'=> 
		array(
			'submenu' => false,
			'page_title' => __('Theme Control Panel', 'flatmarket'),
			'menu_title' => __('FlatMarket Control Panel', 'flatmarket'),
			'capability' => 'manage_options',
			'menu_slug' => 'manage_theme_options',
			'icon_url' => IPANEL_URI . 'assets/img/panel-icon.png',
			'position' => 58
		),
	'rtl' => ( function_exists('is_rtl') && is_rtl() ),
	'tabs' => $ipanel_flatmarket_tabs,
	'fields' => $ipanel_flatmarket_option,
	'download_capability' => 'manage_options',
	'live_preview' => site_url()
);

$ipanel_theme_usage = new IPANEL( $ipanel_configs );
	