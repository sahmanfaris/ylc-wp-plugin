<?php

// Register REST API endpoints
function ylc_register_rest_routes() {
    // Get current user info
    register_rest_route('ylc/v1', '/user', array(
        'methods' => 'GET',
        'callback' => 'ylc_get_user_data',
        'permission_callback' => function() {
            return is_user_logged_in();
        }
    ));

    // Get site data
    register_rest_route('ylc/v1', '/site-data', array(
        'methods' => 'GET',
        'callback' => 'ylc_get_site_data',
        'permission_callback' => function() {
            return current_user_can('edit_posts');
        }
    ));
}
add_action('rest_api_init', 'ylc_register_rest_routes');

// Callback functions
function ylc_get_user_data() {
    $current_user = wp_get_current_user();
    
    return array(
        'id' => $current_user->ID,
        'name' => $current_user->display_name,
        'email' => $current_user->user_email,
        'roles' => $current_user->roles,
    );
}

function ylc_get_site_data() {
    return array(
        'site_title' => get_bloginfo('name'),
        'posts_count' => wp_count_posts()->publish,
        'pages_count' => wp_count_posts('page')->publish,
        'users_count' => count_users()['total_users'],
    );
}