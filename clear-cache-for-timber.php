<?php
/*
Plugin Name: Clear cache for Timber
Plugin URI: https://github.com/ogrosko/timber-clear-cache
Description: Clear cache for Timber and Twig caching
Author: Ondrej Grosko
Version: 0.1.0
Author URI: 
Network: True
Text Domain: clear-cache-for-timber
*/

/**
 * Init function
 */
add_action( 'init', 'clear_cache_for_timber_init' );
function clear_cache_for_timber_init() {

    if ( !is_super_admin() || !is_admin_bar_showing() || !class_exists('Timber') || !\Timber::$cache ) { 
          return;
    }

    //Check if user disable cron task and remove cron task
    if (defined('CLEAR_CACHE_FOR_TIMBER_DISABLE_CRON_JOB_CLEANUP')
        and CLEAR_CACHE_FOR_TIMBER_DISABLE_CRON_JOB_CLEANUP === true) {
        clear_cache_for_timber_remove_cron_task();
    }
    //If cron is not cheduled add one
    else if (wp_get_schedule('clear_cache_for_timber_cron_task') === false){
        clear_cache_for_timber_add_cron_task();
    }
}

/**
* Add button to admin menu bar
*/
add_action('admin_bar_menu', 'add_timber_clear_cache_admin_button', 110);
function add_timber_clear_cache_admin_button() {
    global $wp_admin_bar;
   
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
    echo clear_cache_for_timber_clear_cache();
    wp_die();
}

/**
 * Timber Clear cache function
 */
function clear_cache_for_timber_clear_cache() {
    if (class_exists('Timber\\Integrations\\Command')) {
        return \Timber\Integrations\Command::clear_cache();
    }
    else {
        return TimberCommand::clear_cache();
    }
}

/**
 * Enqueue resources
 */
add_action( 'admin_enqueue_scripts', 'clear_timer_cache_javascript' );
add_action( 'admin_bar_init', 'clear_timer_cache_javascript' );
function clear_timer_cache_javascript() { 
    wp_enqueue_script('clear-cache-for-timber-javascript', plugins_url('assets/js/main.js', __FILE__), array(), '0.1.0', true);
    wp_enqueue_style( 'clear-cache-for-timber-style',  plugins_url('assets/css/style.css', __FILE__), array(), '0.1.0' );
}


/**
 * Register cron task on plugin activation
 */
register_activation_hook(__FILE__, 'clear_cache_for_timber_add_cron_task');
function clear_cache_for_timber_add_cron_task() {
    if (! wp_next_scheduled ( 'clear_cache_for_timber_cron_task' )) {
        wp_schedule_event(time(), 'daily', 'clear_cache_for_timber_cron_task');
    }
}

/**
 * WP cron task
 */
add_action( 'clear_cache_for_timber_cron_task', 'clear_cache_for_timber_cron_event' );
function clear_cache_for_timber_cron_event() {
    clear_cache_for_timber_clear_cache();
}

/**
 * Unregister cron task on plugin deactivation
 */
register_deactivation_hook(__FILE__, 'clear_cache_for_timber_remove_cron_task');
function clear_cache_for_timber_remove_cron_task() {
    wp_clear_scheduled_hook('clear_cache_for_timber_cron_task');
}