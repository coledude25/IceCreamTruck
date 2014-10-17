(function() {
    tinymce.create('tinymce.plugins.ifslider', {
        init : function(ed, url) {


        ed.addButton('if_slider', {
                title : 'Insert iFeature Slider',
                image :  url + '/if-icon.png',
                onclick: function() {
                    ed.windowManager.open({
                      title:'Loading sliders..',
                      buttons: [],
                      width:300,
                      height:150,
                      });
                    jQuery.get(ajaxurl,{action:'if_slider_load'},function(e){ 
                      var sldr = [],y;
                      for (var key in e) {
                        if (e.hasOwnProperty(key)) {
                          if(!e[key]) y  = '[no title] '+key;
                          else        y  = e[key];
                          sldr.push({text:y,value:key});
                        }
                      }
                      tinymce.activeEditor.windowManager.close();
                      ed.windowManager.open({
                        title: 'Select Slider',
                        close_previous: true,
                        width:300,
                        height:100,
                        body: [{type: 'listbox', 
                                name: 'slider', 
                                label: 'Slider', 
                                'values': sldr
                                }],
                        onsubmit: function(e) {
                          ed.insertContent('[if_slider id="'+e.data.slider+'"]');
                        }
                      });
                    },'json');
                }
            });    

        },

    });

    tinymce.PluginManager.add( 'mce_if_slider', tinymce.plugins.ifslider );
})();