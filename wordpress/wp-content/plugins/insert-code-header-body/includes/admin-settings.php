<?php

// Add settings menu
function ichb_add_admin_menu() {
    add_menu_page(
        'Insert Code Snippets',
        'Insert Code Snippets',
        'manage_options',
        'insert_code_settings',
        'ichb_settings_page',
        'dashicons-media-code',
        99
    );
}
add_action('admin_menu', 'ichb_add_admin_menu');

// Register settings
function ichb_register_settings() {
    register_setting('ichb_settings_group', 'ichb_header_code');
    register_setting('ichb_settings_group', 'ichb_body_code');
}
add_action('admin_init', 'ichb_register_settings');

// Settings page HTML
function ichb_settings_page() {
    ?>
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
                        <label class="field-label">Body Code (After &lt;body&gt; Tag)</label>
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
