// JavaScript Document for IFeatureSlider
(function($) {

	var defaults = [0,{
      duration  : 1000,
			delay     : 3000,
			easing    : 'swing',
			auto      : true,
      click     : true
      }],slide   = 0,
 
  ifs = {

		animate: function(j,prev) {

      if(!defaults[j].click) return false;
      defaults[j].click              = false;

      if(!prev)
      {
        defaults[j].i++;
        defaults[j].first            = defaults[j].ul.find('li').first();
        defaults[j].width            = defaults[j].first.width();
        defaults[j].first.animate({
          marginLeft      : '-=' + defaults[j].width + 'px'
        }, defaults[j].duration, defaults[j].easing, function() {
          /*if (defaults[j].auto && (defaults[j].i === defaults[j].length)) 
            return clearInterval(defaults[j].timer);*/
          $(this).appendTo(defaults[j].ul).css('marginLeft', 0);
          defaults[j].click          = true;
  
        });
      }
      else
      {
        defaults[j].last             = defaults[j].ul.find('li').last();
        defaults[j].width            = defaults[j].last.width();
        defaults[j].last.css({marginLeft:'-'+defaults[j].width+'px'}).prependTo(defaults[j].ul);
        defaults[j].last.animate({
          marginLeft      : '+=' + defaults[j].width + 'px'
        }, defaults[j].duration, defaults[j].easing, function() {
          defaults[j].click          = true;
        });
        
        
      }
      
		},
    
    autoslide: function(j)
    {
      var d                    = defaults[j].delay,
          s                    = defaults[j].next.parent().data('slide');
      ifs.animate(s);
      defaults[j].timer        = setTimeout(function(){ifs.autoslide(j)},d);
    }

	}

  
	
	$.fn.iFeatureSlider = function(settings) {
		var li,th=$(this);
    slide++;
		defaults[slide]            = $.extend({},defaults[0], settings);
    if(defaults[slide].imgs < 2) return false;
    defaults[slide].th         = $(this);
    defaults[slide].click      = true;
		defaults[slide].ul         = defaults[slide].th.find('ul');
		defaults[slide].li         = defaults[slide].ul.find('li'),
		defaults[slide].length     = defaults[slide].li.length,
    defaults[slide].prev       = defaults[slide].th.find('.if-prev-btn');
    defaults[slide].next       = defaults[slide].th.find('.if-next-btn');
    defaults[slide].btn        = defaults[slide].ul.next();
		defaults[slide].i          = slide,
    automatic                  = function(j){
                                  defaults[j].timer = setTimeout(function(){ ifs.autoslide(j); }, defaults[j].delay);
                                },
    pauseauto                  = function(j){if(!defaults[j].auto) return false; clearTimeout(defaults[j].timer); automatic(j);};


		if (defaults[slide].auto) automatic(slide);

    defaults[slide].next.on('click',function(){ var j=$(this).parent().data('slide');pauseauto(j);ifs.animate(j); });
    defaults[slide].prev.on('click',function(){ var j=$(this).parent().data('slide');pauseauto(j);ifs.animate(j,true); });
    

	}

  
})(jQuery);