<?php

add_action('admin_menu', 'myplugin_admin_menu');

function myplugin_admin_menu() {
    $page_title = 'My Plugin Settings';
    $menu_title = 'My Plugin';
    $capability = 'manage_options';
    $menu_slug = 'myplugin-settings';
    $function = 'myplugin_settings';
    add_options_page($page_title, $menu_title, $capability, $menu_slug, $function);
}

function myplugin_settings() {
    if (!current_user_can('manage_options')) {
        wp_die('You do not have sufficient permissions to access this page.');
    }

    // Here is where you could start displaying the HTML needed for the settings
    // page, or you could include a file that handles the HTML output for you.
}

?>