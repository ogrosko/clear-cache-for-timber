function clear_timber_cache(button) {
	jQuery('#wp-admin-bar-clear-timber-cache .spinner').addClass('active');
	var data = {
		'action': 'clear_timber_cache_action'
	};

	jQuery.post(ajaxurl, data, function(response) {
		jQuery('#wp-admin-bar-clear-timber-cache .spinner').removeClass('active');
	});
}