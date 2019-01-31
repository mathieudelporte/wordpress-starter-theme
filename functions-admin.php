<?php

// ---------------------------------------------------------------------------------------------
// CLEAN DASHBOARD
// ---------------------------------------------------------------------------------------------

function dashboard_cleanup() {
    remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
    remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );
    remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
    remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' );
    remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
    remove_meta_box( 'dashboard_secondary', 'dashboard', 'side' );
    remove_meta_box( 'dashboard_activity', 'dashboard', 'normal' );
    remove_action('welcome_panel', 'wp_welcome_panel');
}
add_action( 'wp_dashboard_setup', 'dashboard_cleanup' );

// ---------------------------------------------------------------------------------------------
// CUSTOM ADMIN FOOTER
// ---------------------------------------------------------------------------------------------

function custom_admin_footer () {
    echo 'Website by <a href="https://mathieudelporte.be" target="_blank">Mathieu Delporte</a> | Powered by <a href="http://www.wordpress.org" target="_blank">WordPress</a>';
}
add_filter('admin_footer_text', 'custom_admin_footer');

// ---------------------------------------------------------------------------------------------
// CLEAN ADMIN
// ---------------------------------------------------------------------------------------------

function remove_menus() {
    // remove_menu_page('index.php'); // Dashboard tab
    // remove_menu_page('edit.php'); // Posts
    // remove_menu_page('edit.php?post_type=page'); // Pages
    // remove_menu_page('upload.php'); // Media
    // remove_menu_page('link-manager.php'); // Links
    remove_menu_page('edit-comments.php'); // Comments
    // remove_menu_page('themes.php'); // Appearance
    // remove_menu_page('plugins.php'); // Plugins
    // remove_menu_page('users.php'); // Users
    // remove_menu_page('tools.php'); // Tools
    // remove_menu_page('options-general.php'); // Settings
}
add_action('admin_menu', 'remove_menus');

?>