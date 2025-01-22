<?php

function ylc_enqueue_scripts() {
    // Enqueue for frontend
    wp_enqueue_script(
        'ylc-react-app',
        YLC_PLUGIN_URL . 'build/static/js/main.js',
        array(),
        YLC_PLUGIN_VERSION,
        true
    );
    
    wp_enqueue_style(
        'ylc-react-app-css',
        YLC_PLUGIN_URL . 'build/static/css/main.css',
        array(),
        YLC_PLUGIN_VERSION
    );

    // Pass WordPress data to React
    wp_localize_script(
        'ylc-react-app',
        'ylcWPData',
        array(
            'apiUrl' => rest_url('ylc/v1/'),
            'nonce' => wp_create_nonce('wp_rest'),
            'isAdmin' => is_admin(),
            'currentUser' => wp_get_current_user()->display_name
        )
    );
}
add_action('wp_enqueue_scripts', 'ylc_enqueue_scripts');
add_action('admin_enqueue_scripts', 'ylc_enqueue_scripts');