jQuery(document).ready(function(){
        jQuery(".thumbnails .zoom").removeClass("zoom").addClass("wisdm_zoom").attr("rel", "remove");
        jQuery("a.wisdm_zoom").removeData();
        get_all_images_link = new Array();
        var wisdm_obj = new Object();
        wisdm_obj[wdm_zwoom_object.sourceimageurlforzoom] = wdm_zwoom_object.sourceimagesinglesrc;
        jQuery("a.wisdm_zoom").each(function()
                                    {
                                        get_all_images_link.push(jQuery(this).attr("href"));
                                        temp_link = jQuery(this).attr("href");
                                        wisdm_obj[temp_link] = temp_link;
                                    });
        
        var data = {
		action: 'get_ids_of_all_attachments',
		all_links: get_all_images_link.join(':::::')
	};
        jQuery.ajax({
		type: "POST",
		traditional: true,
		url: wdm_zwoom_object.admin_ajax_url,
		async: false,
		data: data,
		success: function (response)
		{
			response_string = response.split(':::::');
			var links_to_be_preloaded = new Array(); 
			for (var i=0; i<response_string.length; i++)
			{
				var separate_new_old_links = response_string[i].split('|||||');
				var newPhoto = new Image();
				newPhoto.src = separate_new_old_links[1];
				var newPhoto2 = new Image();
				newPhoto2.src = separate_new_old_links[0];
				wisdm_obj[newPhoto.src] = newPhoto2.src;
			}
			load_rest_of_script();
		}
	});
		function load_rest_of_script(){
			jQuery('.images').find('a.zoom:first').width(jQuery(".images").width());
			jQuery(".thumbnails").attr("id" , "slider_main_div");
			jQuery('<ul class="bxslider"></ul>').prependTo("#slider_main_div");
			jQuery('.images').find('a.zoom:first').clone().wrap("<li></li>").prependTo("#slider_main_div .bxslider").addClass('first-featured-image wisdm_zoom');
			jQuery('.first-featured-image img').attr({
				src: wdm_zwoom_object.sourceimageurl,
				width: wdm_zwoom_object.thumbnail_image_width,
				height: wdm_zwoom_object.thumbnail_image_height,
				style: ""
				});
			jQuery(".thumbnails a").each(function()
			{
				var cloned_element = jQuery(this).clone();
				jQuery(this).remove();
				var create_a_new_li = jQuery("<li></li>").appendTo('#slider_main_div .bxslider');
				cloned_element.appendTo(create_a_new_li);
			});
			jQuery("#slider_main_div").css({'overflow':'hidden', 'height':wdm_zwoom_object.thumbnail_image_height, 'width': jQuery(".images").width()});
			jQuery(".bxslider li img").width(wdm_zwoom_object.thumbnail_image_width).height(wdm_zwoom_object.thumbnail_image_height);
			
			jQuery('.bxslider li').css('paddingLeft', '10px').css('paddingRight', '10px');
			jQuery("a.wisdm_zoom").unbind("click");
			jQuery("a.wisdm_zoom").click(function(event)
			{
				event.preventDefault();
			});
			var first_image_selector = jQuery('.images a.zoom:first');
			first_image_selector.each(function(index){
			
				if (index == 0)
				{
					var title_of_image = jQuery(this).attr("title");
					jQuery(this).hover(
					function(){
						jQuery(this).attr("title" , "");
					},
					function(){
						jQuery(this).attr("title" , title_of_image);
					});
				}
				
			});
			jQuery('.bxslider').bxSlider({speed: 800, setWrapperwidth: jQuery(".images").width(), setChildrenWidth: (parseInt(wdm_zwoom_object.thumbnail_image_width)), moveSlideQty: 1, prevImage: wdm_zwoom_object.previous_image , nextImage: wdm_zwoom_object.next_image, hideControlOnEnd: true, infiniteLoop: false, distanceBetweenControlImages: 20});
			jQuery(".bxslider li .wisdm_zoom").click(function()
			{
				var get_original_link_of_image = jQuery(this).attr("href");
				first_image_selector.find('img:first').attr("src", wisdm_obj[get_original_link_of_image]).width(jQuery(".images").width());
				var zoom_level_to_be_set_new = parseInt(wdm_zwoom_object.zoomleveloption) || 2;
				var get_zoomed_height_new = first_image_selector.find('img:first').height() * zoom_level_to_be_set_new;
				jQuery('.images .zoomImg').height(get_zoomed_height_new);
				first_image_selector.find('.zoomImg').attr("src", get_original_link_of_image);
				first_image_selector.attr("href",get_original_link_of_image);
			});
		}
});
