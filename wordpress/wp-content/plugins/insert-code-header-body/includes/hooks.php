<?php

if (!defined('ABSPATH')) {
    exit;
}



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