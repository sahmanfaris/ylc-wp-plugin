<?php
/*
Plugin Name: YLC WP Plugin
Description: A WordPress plugin to serve React app with WordPress integration.
Version: 1.0
Author: Your Name
*/

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Plugin constants
define('YLC_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('YLC_PLUGIN_URL', plugin_dir_url(__FILE__));
define('YLC_PLUGIN_VERSION', '1.0.0');

// Composer autoloader
require_once YLC_PLUGIN_PATH . 'vendor/autoload.php';

// Setup automatic updates
use YahnisElsts\PluginUpdateChecker\v5\PucFactory;

$myUpdateChecker = PucFactory::buildUpdateChecker(
    'https://github.com/sahmanfaris/ylc-wp-plugin/',
    __FILE__,
    'ylc-plugin'
);
$myUpdateChecker->setBranch('main');

// Include files
require_once YLC_PLUGIN_PATH . 'includes/enqueue.php';
require_once YLC_PLUGIN_PATH . 'includes/api.php';

// Initialize plugin
function ylc_init() {
    // Add menu item to WordPress admin
    add_menu_page(
        'YLC App',           // Page title
        'YLC App',           // Menu title
        'manage_options',    // Capability
        'ylc-app',          // Menu slug
        'ylc_render_app',    // Callback function
        'dashicons-editor-paste-text', // Icon
        20                   // Position
    );
}
add_action('admin_menu', 'ylc_init');

// Render the React app
function ylc_render_app() {
    echo '<div id="ylc-root"></div>';
}