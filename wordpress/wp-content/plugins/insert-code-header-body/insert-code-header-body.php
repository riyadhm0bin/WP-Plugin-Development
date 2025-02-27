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

// Add settings menu
function ichb_add_admin_menu() {
    add_menu_page(  'Insert Code',
                    'Insert Code',
                    'manage_options',
                    'insert_code_settings',
                    'ichb_settings_page'
    );
}
add_action('admin_menu', 'ichb_add_admin_menu');

// Register settings
function ichb_register_settings() {
    register_setting('ichb_settings_group', 'ichb_header_code');
    register_setting('ichb_settings_group', 'ichb_body_code');
}
add_action('admin_init', 'ichb_register_settings');

// Page
function ichb_settings_page() {
    ?>

    <style>
        .main{
            margin-top: 20px;
            margin-right: 20px;
        }

        .plugin-title{
            /*background: blue;*/
        }

        .page-title{
            /*background: #ed00ff;*/
            font-size: 26px;
        }

        .page-description{
            font-size: 16px;
        }

        .form{
            /*background: purple;*/
        }

        .field-label{
            font-size: 18px;
            color: black;
        }

        .input-fields{
            margin-top: 10px;
            width:100%;
            border: none;
        }

        .textarea-row{
            /*background: green;*/
        }

        .head-col, .body-col{
            background: #dddddd;
            padding: 10px;
            border-radius: 7px;
        }

        .body-col{
            margin-top: 20px;
        }
    </style>

    <div class="main">
        <div class="plugin-title">
            <h1 class="page-title">Insert Code in Header & Body</h1>
            <p class="page-description">Insert Code in Header & Body is a lightweight WordPress plugin that allows administrators to easily insert custom code snippets into the <head> and <body> sections of their website. Ideal for adding tracking scripts, custom CSS, meta tags, and other integrations without modifying theme files.</p>
        </div>
        <div class="form">
            <form method="post" action="options.php">
                <?php settings_fields('ichb_settings_group'); ?>
                <?php do_settings_sections('ichb_settings_group'); ?>
                <div class="textarea-row">
                    <div class="head-col">
                        <label class="field-label">Header Code (Inside &lt;head&gt; Tag)</label>
                        <textarea class="input-fields" name="ichb_header_code" rows="10"><?php echo esc_textarea(get_option('ichb_header_code')); ?></textarea>
                    </div>
                    <div class="body-col">
                        <lable class="field-label">Body Code (After &lt;body&gt; Tag)</lable>
                        <textarea class="input-fields" name="ichb_body_code" rows="10"><?php echo esc_textarea(get_option('ichb_body_code')); ?></textarea>
                    </div>
                </div>
                <div class="save-button">
                    <?php submit_button(); ?>
                </div>
            </form>
        </div>
    </div>
    <?php
}

// Insert code into the head tag
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
