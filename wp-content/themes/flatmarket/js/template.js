(function($){
$(document).ready(function() {

	'use strict';
/**
*	Init
*/	
	// iOS button fixes
	var iOS = false,
        p = navigator.platform;

    if (p === 'iPad' || p === 'iPhone' || p === 'iPod') {
        iOS = true;
    }
	if (iOS) {
        $('input.button, input[type="text"],input[type="button"],input[type="password"],textarea, input.input-text').css('-webkit-appearance', 'none');
        $('input').css('border-radius', '0');
    }

    // Remove animations on touch devices
    function isTouchDevice(){
	    return true == ("ontouchstart" in window || window.DocumentTouch && document instanceof DocumentTouch);
	}

	if(isTouchDevice()===true) {
	    $("#animations-css").remove();
	}

	$("select").select2({
		allowClear: true,
		minimumResultsForSearch: Infinity
	});
    	
	updateFullwidthSections();

	// Fix product boxes height
	$(".woocommerce ul.products li.product a img").load(function()
	{
		if($(".woocommerce ul.products li.product a img").height() > 0)
	    $(".woocommerce ul.products li.product .product-item-box").height( $(".woocommerce ul.products li.product a img").height() + 80);
	    
	});

	// WooCommerce fix
	$(".woocommerce .shop-product .summary .product_meta").before($(".woocommerce #content div.product form.cart"));
	$(".woocommerce .shop-product .short-description").before($(".woocommerce .woocommerce-product-rating, .woocommerce-page .woocommerce-product-rating"));
	$(".woocommerce .shop-product .single_variation_wrap .single_add_to_cart_button").after($(".woocommerce .shop-product .summary .yith-wcwl-add-to-wishlist"));

	$('.woocommerce .page-title').after($(".woocommerce-breadcrumb"));

	$(".woocommerce-breadcrumb").after($('.woocommerce .term-description')).show();

	$(".footer-container h2.widgettitle").after('<div class="line"></div>');

	// Breadcrumb on product page
	$(".woocommerce-breadcrumb").prependTo($('.shop-content .entry-summary')).show();

	var menu_hover_link_color = '';
	var menu_link_color = $(".navbar .nav > li > a").css('color');
	var menu_hover_bg = '';

	// Floating blocks
	$(".widget_facebook_right").hover(function(){            
	$(".widget_facebook_right").stop(true, false).animate({right: "0" }, 800, 'easeOutQuint' );        
	},
	function(){            
	$(".widget_facebook_right").stop(true, false).animate({right: "-237" }, 800, 'easeInQuint' );        
	},1000);

	$(".widget_twitter_right").hover(function(){            
	$(".widget_twitter_right").stop(true, false).animate({right: "0" }, 800, 'easeOutQuint' );        
	},
	function(){            
	$(".widget_twitter_right").stop(true, false).animate({right: "-237" }, 800, 'easeInQuint' );        
	},1000);

	$(function(){        
	$(".widget_custom_box_right").hover(function(){            
	$(".widget_custom_box_right").stop(true, false).animate({right: "0" }, 800, 'easeOutQuint' );        
	},
	function(){            
	$(".widget_custom_box_right").stop(true, false).animate({right: "-245" }, 800, 'easeInQuint' );        
	},1000);    
	});
/**
*	Scroll functions
*/
	$(window).scroll(function () {

		var scrollonscreen = $(window).scrollTop() + $(window).height();
		
		// Scroll to top function
		if(scrollonscreen > $(window).height() + 350){
			$('#top-link').css("bottom", "22px");
		}
		else {
			$('#top-link').css("bottom", "-60px");
		}
	
	});

//scroll up event
$('#top-link').click(function(){
	$('body,html').stop().animate({
		scrollTop:0
	},800,'easeOutCubic')
	return false;
});


/**
*	Resize events
*/

	$(window).resize(function () {
		
		updateFullwidthSections();
		fixProductBoxHeight();

	});

/**
*	Functions
*/
function fixProductBoxHeight() {
	if($(".woocommerce ul.products li.product a img").height() > 0)
	$(".woocommerce ul.products li.product .product-item-box").height( $(".woocommerce ul.products li.product a img").height() + 80);

}
function updateFullwidthSections() {

	if($(window).width() > 979) {

		$('.fullwidth-section').each(function(){
			var $bodyWidth = $('body').width();
			var $justOutOfSight = parseInt((parseInt($('body').css('width')) - parseInt($('.container').css('width'))) / 2);
		
			var $marginleft = (-1)*$justOutOfSight;

			$(this).css({
				'margin-left': $marginleft - 15,
				'padding-left': $justOutOfSight,
				'padding-right': $justOutOfSight
			});	

			$(this).css("width", $bodyWidth);
		});	

		$('.homepage .wpb_revslider_element.fullwidth-rev-slider').each(function(){
				
				var $justOutOfSight = ((parseInt($('body').width()) - parseInt($('.container').css('width'))) / 2);
				var $marginleft = (-1)*$justOutOfSight;

				$(this).css({
					'margin-left': $marginleft - 15
				});	

				$(this).width($(window).width());
		});
	
	} else {
		$('.fullwidth-section, .fullwidth-slider').width("auto");

		$('.fullwidth-section, .fullwidth-slider').css({
				'margin-left': -15,
				'padding-left': 10,
				'padding-right': 10
			});	
	}
}

/**
*	Other scripts
*/


/**
* Social share for products
*/
function facebookShare(){
	window.open( 'https://www.facebook.com/sharer/sharer.php?u='+window.location, "facebookWindow", "height=380,width=660,resizable=0,toolbar=0,menubar=0,status=0,location=0,scrollbars=0" ) 
	return false;
}
function twitterShare(){
	if($(".section-title h1").length > 0) {
		var $page_title = encodeURIComponent($(".portfolio-item-title h1").text());
	} else {
		var $page_title = encodeURIComponent($(document).find("title").text());
	}
	window.open( 'http://twitter.com/intent/tweet?text='+$page_title +' '+window.location, "twitterWindow", "height=370,width=600,resizable=0,toolbar=0,menubar=0,status=0,location=0,scrollbars=0" ) 
	return false;
}
function pinterestShare(){
	var $sharingImg = $('.attachment-shop_single').first().attr('src'); 
	
	if($(".section-title h1").length > 0) {
		var $page_title = encodeURIComponent($(".portfolio-item-title h1").text());
	} else {
		var $page_title = encodeURIComponent($(document).find("title").text());
	}
	
	window.open( 'http://pinterest.com/pin/create/button/?url='+window.location+'&media='+$sharingImg+'&description='+$page_title, "pinterestWindow", "height=620,width=600,resizable=0,toolbar=0,menubar=0,status=0,location=0,scrollbars=0" ) 
	return false;
}
if( $('a.facebook-share').length > 0 || $('a.twitter-share').length > 0 || $('a.pinterest-share').length > 0) {
	
		// Facebook
		
		$.getJSON("http://graph.facebook.com/?id="+ window.location +'&callback=?', function(data) {
			if((data.shares != 0) && (data.shares != undefined) && (data.shares != null)) { 
				$('.facebook-share span.count').html( data.shares );	
			}
			else {
				$('.facebook-share span.count').html( 0 );	
			}
			
		});
	 
		
		
		$('.facebook-share').click(facebookShare);
		
		// Twitter
		
		$.getJSON('http://urls.api.twitter.com/1/urls/count.json?url='+window.location+'&callback=?', function(data) {
			if((data.count != 0) && (data.count != undefined) && (data.count != null)) { 
				$('.twitter-share span.count').html( data.count );
			}
			else {
				$('.twitter-share span.count').html( 0 );
			}

		});
		
		
		
		$('.twitter-share').click(twitterShare);

		// Pinterest
		
		$.getJSON('http://api.pinterest.com/v1/urls/count.json?url='+window.location+'&callback=?', function(data) {
			if((data.count != 0) && (data.count != undefined) && (data.count != null)) { 
				$('.pinterest-share span.count').html( data.count );
			}
			else {
				$('.pinterest-share span.count').html( 0 );
			}
	
		});
		
		

		$('.pinterest-share').click(pinterestShare);
		
	}
	
});
})(jQuery);