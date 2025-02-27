<?php
/**
 * Plugin Name: Insert Code in Header & Body
 * Plugin URI: #
 * Description: A simple plugin to insert code snippets into the header and body sections of a WordPress site.
 * Version: 1.0
 * Author: Riyadh Mobin
 * Author URI: #
 */

if (!defined('ABSPATH')) {
    exit;
}


require_once plugin_dir_path(__FILE__) . 'includes/admin-settings.php';
require_once plugin_dir_path(__FILE__) . 'includes/hooks.php';

function ichb_enqueue_styles($hook) {
    // Enqueue the styles only on the plugin settings page
    if ($hook != 'toplevel_page_insert_code_settings') {
        return;
    }
    wp_enqueue_style('ichb-style', plugin_dir_url(__FILE__) . 'assets/css/style.css');
}
add_action('admin_enqueue_scripts', 'ichb_enqueue_styles');
// Insert code into the head tag

