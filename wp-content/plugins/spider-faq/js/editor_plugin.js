(function() {
    tinymce.create('tinymce.plugins.Spider_Faq_mce', {
 
        init : function(ed, url){
			
			ed.addCommand('mceSpider_Faq_mce', function() { 
				ed.windowManager.open({
					file : ajaxurl+'?action=spiderFaqselectfaq',
					width : 380 + ed.getLang('Spider_Video_Player_mce.delta_width', 0),
					height : 180 + ed.getLang('Spider_Video_Player_mce.delta_height', 0),
					inline : 1
				}, {
					plugin_url : url // Plugin absolute URL
				});
			
			
			} );
            ed.addButton('Spider_Faq_mce', {
            title : 'Insert Spider Faq',
			cmd : 'mceSpider_Faq_mce',
			image: spider_faq_plugin_url + '/images/spider-faq_edit_but.png'
            });
        }
    });
 
    tinymce.PluginManager.add('Spider_Faq_mce', tinymce.plugins.Spider_Faq_mce);
 
})();