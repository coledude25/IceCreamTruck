/*
* Plugin Name: Magic Liquidizer Responsive Navigationbar
* Plugin URI: http://www.innovedesigns.com/wordpress/plugin/magic-liquidizer-responsive-nagivation-bar-must-have-rwd-plugin/
* Author: Elvin Deza
* Description: A Responsive Web Design (RWD) plugin that makes your existing Navigation Bar / Nav Menu become an instant responsive or mobile compatible.
* Version: 1.0.0
* Tags: responsive, fluid, nav bar, nav menu, navigation bar
* Author URI: http://innovedesigns.com/author/esstat17
*/

 /* Navs Function */
(function ($, window, i) {	
  $.fn.innovedesignsNav = function (options) {
    // Default settings
    var settings = $.extend({
      'active' : '',
      'navcolor' : '',
      'home' : '',
      'info' : '',
      'contact' : '',
      'header' : '', 
      'label'  : ''
    }, options);

    return this.each(function () {

      // Used for prefixing
      i++;

      var $this = $(this),
        // Prefixing
        fluidnavs = 'ml-navbar',
        fluidnavs_i = fluidnavs + i,
        l_fluidnavs_i = '.l_' + fluidnavs_i,
        navClass = $('<div/>').attr("id", fluidnavs_i).addClass("ml-nav" + " " + "ml-padding-zero"),
        $selects = $('<select/>').attr("id", fluidnavs).addClass( fluidnavs );
       
    // Inject navClass
        $('body').prepend('<div id="ml-selectnav" />');
        $('#ml-selectnav').prepend('<div class="ml-selectnav" />');
        
        if (settings.navcolor) {
		  $('#ml-selectnav').css({'background':settings.navcolor});
		}
		if (settings.home) {
          $('.ml-selectnav').prepend('<div class="ml-homeicon"><a href="' + settings.home + '">Home</a></div>');
      	}
      	
      	if (settings.info) {
          $('.ml-selectnav').append('<div class="ml-infoicon"><a href="' + settings.info + '">About</a></div>');
      	}
      	
      	if (settings.contact) {
          $('.ml-selectnav').append('<div class="ml-callicon"><a href="' + settings.contact + '">Contact</a></div>');
      	}
		 $('.ml-selectnav').append(navClass);
		
	if ($this.has('ul,ol')) {
			if (settings.header !== '') {
          		$selects.append(
            	$('<option/>').text(settings.header)
          	);  
		}  
	
	 // Append '$select' into a navClass
        navClass.append($selects); 
        
    // Build options
        var options = '', 
        j=1;
        $this
          .find('a')
          .each(function() {
            options += '<option class="ml-option-' + j + '" value="' + $(this).attr('href') + '">';
             j++;
            for (var i = 0; i < $(this).parents('ul, ol').length - 1; i++) {
              options += '&ndash;&nbsp;';
            }
            options += $(this).text() + '</option>';
          });
          
    // Change window location
        $selects.change(function() {
          window.location.href = $(this).val();
        });
        
	// Append 'options' into a $selects
    	$selects.append(options);           
	
    // navClass the active item
    	if (!settings.header) {	
      	var selectit = (settings.active) ? $(settings.active).index('li'):0,
      		fixselectit = (selectit<0)?0:selectit;
        $selects.find(':eq('+fixselectit+')')
            .attr('selected', true).addClass('ml-selected');
		}
        
    // Inject label
		if (settings.label) {
          $selects.before(
            $("<label/>")
              .attr("for", fluidnavs_i)
              .addClass(fluidnavs + '_label ' + fluidnavs_i + '_label')
              .append(settings.label)
          );
    	}
		
	}

    });

  };
})(jQuery, this, 0); //  End of innovedesignsNav function 



(function($){
	$.fn.MagicLiquidizerNavigationbar = function(options){
   					var settings = $.extend({
            			navigationbar: '1',
            			breakpoint: '720',
            			whichelement: 'nav'
        				}, options );       				
	return this.each(function() {
		
		function responsiveNavigationbarFn() {			 
			var viewwidth = $( window ).width();
    	/** Media screens **/
    		if (viewwidth < settings.breakpoint) {	// Form and Smartphone Screens  		
    			if(!$(settings.whichelement+'.hide').length > 0){ $(settings.whichelement).addClass('hide'); }
    			if(!$('#ml-selectnav.show, html.ml-switch-off').length > 0){ $('#ml-selectnav').addClass('show').removeClass('hide'); }
    			if(settings.whichelement && !$('html.nav-on').length > 0){ $('html').addClass('margin-auto-top nav-on').removeClass('nav-off'); }
    			if(!$('#ml-selectnav, html.ml-switch-off').length > 0){
    				$(settings.whichelement).innovedesignsNav({ navcolor: settings.navcolor, active: settings.navselect, home: settings.home, info: settings.info, contact: settings.contact });	
    			}
    		
    		} else {
    		    if($(settings.whichelement+'.hide').length > 0){ $(settings.whichelement).removeClass('hide'); }
    			if(!$('#ml-selectnav.hide').length > 0){ $('#ml-selectnav').addClass( "hide").removeClass( "show"); }  
    			if(settings.navigationbar && $('.margin-auto-top.nav-on').length > 0){ $('html').removeClass('margin-auto-top nav-on').addClass('nav-off') }  
    		}		
  		} // responsiveFormFn()
  		$(window).resize(responsiveNavigationbarFn).ready(responsiveNavigationbarFn);	
	});  // each fn ends
	};  // MagicLiquidizer fn
   
}( jQuery ));