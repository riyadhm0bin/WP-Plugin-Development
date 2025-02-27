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

    <style>
        textarea
        {
            /*border:1px solid red;*/
            width:100%;
            /*margin:5px 0;*/
            /*padding-right:30px;*/
        }
        .textarea-row{
            padding-right: 20px;
        }
    </style>

    <div class="">
        <h1>Insert Code in Header & Body</h1>
        <form method="post" action="options.php">
            <?php settings_fields('ichb_settings_group'); ?>
            <?php do_settings_sections('ichb_settings_group'); ?>
            <div class="textarea-row">
                <div class="head-col">
                    <h4>Header Code (Inside &lt;head&gt;)</h4>
                    <textarea name="ichb_header_code" rows="10"><?php echo esc_textarea(get_option('ichb_header_code')); ?></textarea>
                </div>
                <div class="body-col">
                    <h4>Body Code (After &lt;body&gt; tag)</h4>
                    <textarea name="ichb_body_code" rows="10"><?php echo esc_textarea(get_option('ichb_body_code')); ?></textarea>
                </div>
            </div>
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
