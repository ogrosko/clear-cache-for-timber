<?php
/*
Plugin Name: Clear cache for timber
Plugin URI: https://github.com/ogrosko/timber-clear-cache
Description: Clear cache for Timber and Twig caching
Author: Ondrej Grosko
Version: 0.0.3
Author URI: 
Network: True
Text Domain: clear-cache-for-timber
*/

//add button to admin menu bar
function add_timber_clear_cache_admin_button() {
    global $wp_admin_bar;

    if ( !is_super_admin() || !is_admin_bar_showing() || !class_exists('Timber') )
        return;
    
    $wp_admin_bar->add_menu(array(
        'id' => 'clear-timber-cache',
        'title' => __( 'Clear Timber Cache'),
        'href' => '#',
        'meta' => array(
        	'html' => '<div class="spinner"></div>',
        	'onclick' => 'clear_timber_cache(jQuery(this))'
        )
    ));
}
add_action('admin_bar_menu', 'add_timber_clear_cache_admin_button', 110);

/**
 * Add footer script ajax posting
 */
add_action( 'admin_footer', 'clear_timer_cache_javascript' ); // Write our JS below here
function clear_timer_cache_javascript() { ?>
	<script type="text/javascript" >
		function clear_timber_cache(button) {
			jQuery('li#wp-admin-bar-clear-timber-cache .spinner').addClass('active');
			var data = {
				'action': 'clear_timber_cache_action'
			};

			jQuery.post(ajaxurl, data, function(response) {
				jQuery('li#wp-admin-bar-clear-timber-cache .spinner').removeClass('active');
			});
		}
	</script> <?php
}

/**
 * PHP ajax script
 */
add_action( 'wp_ajax_clear_timber_cache_action', 'clear_timber_cache_callback' );
function clear_timber_cache_callback() {
	echo TimberCommand::clear_cache();
	wp_die();
}

/**
 * Add custom styles
 */
add_action('admin_head', 'clear_timber_cache_style');
function clear_timber_cache_style() {
	wp_enqueue_style( 'clear-cache-for-timber-style',  plugins_url('style.css', __FILE__) );
}