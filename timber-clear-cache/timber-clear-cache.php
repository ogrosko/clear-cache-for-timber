<?php
/*
Plugin Name: Timber Clear cache
Plugin URI: 
Description: Clear cache for Timber and Twig caching
Author: Ondrej Grosko
Version: 0.0.1
Author URI: 
Network: True
Text Domain: timber-clear-cache
*/

//check if Timber is installed
if ( ! class_exists('Timber') ) {
	add_action( 'admin_notices', function() {
		echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="' . esc_url( admin_url( 'plugins.php#timber' ) ) . '">' . esc_url( admin_url( 'plugins.php' ) ) . '</a></p></div>';
	} );
	return;
}

//add button to admin menu bar
function add_timber_clear_cache_admin_button() {
    global $wp_admin_bar;

    if ( !is_super_admin() || !is_admin_bar_showing() || !class_exists('Timber') )
        return;
    
    $wp_admin_bar->add_menu(array(
        'id' => 'clear_timber_cache',
        'title' => __( 'Clear Timber Cache'),
        'href' => '#',
        'meta' => array(
        	'onclick' => 'clear_timer_cache()'
        )
    ));
}
add_action('admin_bar_menu', 'add_timber_clear_cache_admin_button');

//add footer script ajax posting
add_action( 'admin_footer', 'clear_timer_cache_javascript' ); // Write our JS below here
function clear_timer_cache_javascript() { ?>
	<script type="text/javascript" >
		function clear_timer_cache() {
			var data = {
				'action': 'my_action'
			};

			jQuery.post(ajaxurl, data, function(response) {
				alert(response);
			});
		}
	</script> <?php
}

//ajax script
add_action( 'wp_ajax_my_action', 'my_action_callback' );
function my_action_callback() {
	$temDir = plugins_url().'/timber-library/cache/twig';
	if (file_exists($temDir)) {
		rmdir($temDir);
	}
	TimberCommand::clear_cache();

    echo 'Timber cache cleared successfully';

	wp_die();
}