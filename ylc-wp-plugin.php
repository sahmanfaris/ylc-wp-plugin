<?php
/*
Plugin Name: YLC WP Plugin
Description: A WordPress plugin to serve React app with WordPress integration.
Version: 1.0
Author: Your Name
*/

// Include files
require_once plugin_dir_path(__FILE__) . 'includes/enqueue.php';
require_once plugin_dir_path(__FILE__) . 'includes/api.php';

// Add shortcode to display React app
function ylc_react_app_shortcode() {
    return '<div id="root">React app should load here</div>';
}
add_shortcode('ylc_react_app', 'ylc_react_app_shortcode');

// Initialize plugin
function ylc_init() {
    add_menu_page(
        'YLC App',
        'YLC App',
        'manage_options',
        'ylc-app',
        'ylc_render_app',
        'dashicons-editor-paste-text',
        20
    );
}
add_action('admin_menu', 'ylc_init');

// Render the React app
function ylc_render_app() {
    echo '<div id="root">React app should load here</div>';
}

# TODO: Make automatic updates 