<?php

function ylc_enqueue_scripts() {
    // Get plugin directory URL
    $plugin_url = plugin_dir_url(dirname(__FILE__));
    
    // Only load React scripts if we're on our plugin page or viewing a page with our shortcode
    global $post;
    $should_load = false;

    // Check if we're on our admin page
    if (is_admin() && isset($_GET['page']) && $_GET['page'] === 'ylc-app') {
        $should_load = true;
    }
    
    // Check if we're on a page/post with our shortcode
    if (!is_admin() && is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'ylc_react_app')) {
        $should_load = true;
    }

    // Only load if needed
    if ($should_load) {
        wp_enqueue_script(
            'ylc-react-app',
            $plugin_url . 'build/assets/index.js',
            array(),
            '1.0.0',
            true
        );
        
        wp_enqueue_style(
            'ylc-react-app-css',
            $plugin_url . 'build/assets/index.css',
            array(),
            '1.0.0'
        );

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
}

add_action('wp_enqueue_scripts', 'ylc_enqueue_scripts');
add_action('admin_enqueue_scripts', 'ylc_enqueue_scripts');