// JavaScript Document
jQuery(document).ready(function($) {
	$('.if-sortables').sortable({
		handle: '.if-header',
		placeholder: "if-slide-placeholder",
		forcePlaceholderSize: true,
		delay: 100		
	});

	var if_media_frame, if_s = $('#if_slider-slides-metabox');
  
  if_s.on('click','.if-delete',function(e){
    $(this).parents('.if-slide').remove();
    return false;
    });
  
  if_s.on('click','.if-header',function(e){
    $(this).next().toggle();
    return false;
    });
  

	if_s.on('click', '.if-media-gallery-show', function(e) {
		e.preventDefault();
		current_slide_box = $(this).parents('.if-slide');

		// If the frame already exists, re-open it.
		if (if_media_frame) {
			if_media_frame.open();
			return;
		}

		if_media_frame = wp.media.frames.if_media_frame = wp.media({
			className: 'media-frame if-frame',
			frame: 'select',
			multiple: false,
			title: 'iFeature Slider',
			library: {
				type: 'image'
			},
			button: {
				text: 'Add Image'
			}
		});

		if_media_frame.on('select', function() {
			var media_attachment, slide_thumb, slide_attachment_id, img_url;

			media_attachment = if_media_frame.state().get('selection').first().toJSON();

			slide_thumb = current_slide_box.find('.if-image-thumb');
			slide_attachment_id = current_slide_box.find('.if-image-id '); 
			if (undefined == media_attachment.sizes.medium) {
				img_url = media_attachment.url;
			} else {
				img_url = media_attachment.sizes.medium.url;
			}

			slide_thumb.html('<img src="' + img_url + '" alt="thumb">').show();
			slide_attachment_id.val(media_attachment.id);

		});
		if_media_frame.open();
	});

});
