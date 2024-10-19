<?php
/*
Plugin Name: WP React Plugin
Description: A WordPress plugin to serve React app.
Version: 1.0
*/

function wp_react_enqueue_scripts() {
    wp_enqueue_script('react-app', plugin_dir_url(__FILE__) . 'build/static/js/main.js', array(), '1.0.0', true);
    wp_enqueue_style('react-app-css', plugin_dir_url(__FILE__) . 'build/static/css/main.css', array(), '1.0.0');
}
add_action('wp_enqueue_scripts', 'wp_react_enqueue_scripts');
