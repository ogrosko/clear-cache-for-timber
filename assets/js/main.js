function clear_timber_cache($button) {
	jQuery('#wp-admin-bar-clear-timber-cache .loader').addClass('active');
	var ajaxUrl = $button.attr('href'),
		data = {
			'action': 'clear_timber_cache_action'
		};

	jQuery.post(ajaxUrl, data, function(response) {
		jQuery('#wp-admin-bar-clear-timber-cache .loader').removeClass('active');
	});
}