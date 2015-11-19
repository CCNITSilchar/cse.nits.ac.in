jQuery(document).ready(function($) {

    tinymce.create('tinymce.plugins.vsrp_plugin', {
        init : function(ed, url) {
                // Register command for when button is clicked
                ed.addCommand('vsrp_insert_shortcode', function() {
                    selected = tinyMCE.activeEditor.selection.getContent();

                    if( selected ){
                        //If text is selected when button is clicked
                        //Wrap shortcode around it.
                        content =  '[vsrp vsrp_id="" class=""]'+selected+'[/vsrp]';
                    }else{
                        content =  '[vsrp vsrp_id="" class=""]';
                    }

                    tinymce.execCommand('mceInsertContent', false, content);
                });

            // Register buttons - trigger above command when clicked
            ed.addButton('vsrp_button', {
                title : 'Insert vsrp shortcode [vsrp vsrp_id="" class=""]',
                cmd : 'vsrp_insert_shortcode',
                image: url + '/vsrp_icon.png'
            });
        },   
    });

    // Register our TinyMCE plugin
    // first parameter is the button ID1
    // second parameter must match the first parameter of the tinymce.create() function above
    tinymce.PluginManager.add('vsrp_button', tinymce.plugins.vsrp_plugin);
});