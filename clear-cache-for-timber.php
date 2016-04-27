<?php
/*
Plugin Name: Clear cache for Timber
Plugin URI: https://github.com/ogrosko/timber-clear-cache
Description: Clear cache for Timber and Twig caching
Author: Ondrej Grosko
Version: 0.0.5
Author URI: 
Network: True
Text Domain: clear-cache-for-timber
*/

/**
* Add button to admin menu bar
*/
add_action('admin_bar_menu', 'add_timber_clear_cache_admin_button', 110);
function add_timber_clear_cache_admin_button() {
    global $wp_admin_bar;

    if ( !is_super_admin() || !is_admin_bar_showing() || !class_exists('Timber') || !\Timber::$cache ) { 
          return;
    }
    
    $wp_admin_bar->add_menu(array(
        'id' => 'clear-timber-cache',
        'title' => __( 'Clear Timber Cache'),
        'href' => admin_url('admin-ajax.php'),
        'meta' => array(
            'html' => '<img src="'.plugins_url('assets/images/loader.svg', __FILE__).'" class="loader" alt="clear timber cache loader" />',
            'onclick' => 'clear_timber_cache(jQuery(this)); return false;'
        )
    ));
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
 * Enqueue resources
 */
add_action( 'admin_enqueue_scripts', 'clear_timer_cache_javascript' );
add_action( 'admin_bar_init', 'clear_timer_cache_javascript' );
function clear_timer_cache_javascript() { 
    wp_enqueue_script('clear-cache-for-timber-javascript', plugins_url('assets/js/main.js', __FILE__), array(), '0.0.5', true);
    wp_enqueue_style( 'clear-cache-for-timber-style',  plugins_url('assets/css/style.css', __FILE__), array(), '0.0.5' );
}