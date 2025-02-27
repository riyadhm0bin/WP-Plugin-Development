<?php
/**
 * Plugin Name: Insert Code  Snippets in Header & Body
 * Plugin URI: #
 * Description: Insert Code in Header & Body is a lightweight WordPress plugin that allows administrators to easily insert custom code snippets into the <head> and <body> sections of their website. Ideal for adding tracking scripts, custom CSS, meta tags, and other integrations without modifying theme files.
 * Version: 1.0
 * Author: Riyadh Mobin
 * Author URI: https://profiles.wordpress.org/riyadhmobin
 */

if (!defined('ABSPATH')) {
    exit;
}

// Include necessary files
$plugin_path = plugin_dir_path(__FILE__);

if (file_exists($plugin_path . 'includes/admin-settings.php')) {
    require_once $plugin_path . 'includes/admin-settings.php';
}

if (file_exists($plugin_path . 'includes/hooks.php')) {
    require_once $plugin_path . 'includes/hooks.php';
}

// Enqueue admin styles only on the plugin settings page
function ichb_enqueue_styles($hook) {
    if ($hook !== 'toplevel_page_insert_code_settings') {
        return;
    }

    wp_enqueue_style(
        'ichb-style',
        plugin_dir_url(__FILE__) . 'assets/css/style.css',
        [],
        '1.0.0'
    );
}
add_action('admin_enqueue_scripts', 'ichb_enqueue_styles');
