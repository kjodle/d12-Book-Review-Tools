(function() {
	tinymce.create('tinymce.plugins.d12_br', {
		init : function (ed, url) {
			ed.addButton('d12-br-button', {
				title:'Book Review Tools',
				type:'menubutton',
				image: url + '/d12-br-mce-button.png',
				menu: [
					{
						text: 'Add a Spoiler Alert',
						value: 'spoiler',
						icon : 'icon d12br-pause',
						onclick: function() {
							ed.selection.setContent('[spoiler]');
						}
					},
					{
						text: 'Add an eBook Notice',
						value: 'ebook',
						icon : 'icon d12br-ebook',
						onclick: function() {
							ed.selection.setContent('[ebook]');
						}
					},
			]}); // end of ed.addButton
		},
		createControl : function(n, cm) {
			return null;
		},
	}); // end of tinymce.create()
	tinymce.PluginManager.add( 'd12_br', tinymce.plugins.d12_br );
})(); // closes the first line
