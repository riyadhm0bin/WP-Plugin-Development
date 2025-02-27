<?php
/**
 * Plugin Name: Insert Code in Header & Body
 * Plugin URI: https://example.com
 * Description: A simple plugin to insert code snippets into the header and body sections of a WordPress site.
 * Version: 1.0
 * Author: Your Name
 * Author URI: https://example.com
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

// Add settings menu
function ichb_add_admin_menu() {
    add_menu_page('Insert Code', 'Insert Code', 'manage_options', 'insert_code_settings', 'ichb_settings_page');
}
add_action('admin_menu', 'ichb_add_admin_menu');

// Register settings
function ichb_register_settings() {
    register_setting('ichb_settings_group', 'ichb_header_code');
    register_setting('ichb_settings_group', 'ichb_body_code');
}
add_action('admin_init', 'ichb_register_settings');

// Settings page
function ichb_settings_page() {
    ?>
    <div class="wrap">
        <h1>Insert Code in Header & Body</h1>
        <form method="post" action="options.php">
            <?php settings_fields('ichb_settings_group'); ?>
            <?php do_settings_sections('ichb_settings_group'); ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Header Code (Inside &lt;head&gt;)</th>
                    <td>
                        <textarea name="ichb_header_code" rows="5" cols="50"><?php echo esc_textarea(get_option('ichb_header_code')); ?></textarea>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Body Code (After &lt;body&gt; tag)</th>
                    <td>
                        <textarea name="ichb_body_code" rows="5" cols="50"><?php echo esc_textarea(get_option('ichb_body_code')); ?></textarea>
                    </td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

// Insert code into the head
function ichb_insert_header_code() {
    $header_code = get_option('ichb_header_code');
    if ($header_code) {
        echo $header_code . "\n";
    }
}
add_action('wp_head', 'ichb_insert_header_code');

// Insert code after the body tag
function ichb_insert_body_code() {
    $body_code = get_option('ichb_body_code');
    if ($body_code) {
        echo $body_code . "\n";
    }
}
add_action('wp_body_open', 'ichb_insert_body_code');
