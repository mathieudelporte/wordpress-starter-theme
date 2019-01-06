<?php

// ---------------------------------------------------------------------------------------------
// CLEAN HEADER
// ---------------------------------------------------------------------------------------------

function header_cleanup() {
    remove_action('wp_head', 'wlwmanifest_link'); // remove wlwmanifest.xml (needed to support windows live writer)
    remove_action('wp_head', 'wp_generator'); // remove wordpress version
    remove_action('wp_head', 'rsd_link'); // remove really simple discovery link
    remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0); // remove shortlink
    remove_action('wp_head', 'print_emoji_detection_script', 7);  // remove emojis
    remove_action('wp_print_styles', 'print_emoji_styles');   // remove emojis
    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head'); // remove the / and previous post links
    remove_action('wp_head', 'feed_links', 2); // remove rss feed links
    remove_action('wp_head', 'feed_links_extra', 3); // removes all extra rss feed links
    remove_action('wp_head', 'rest_output_link_wp_head', 10); // remove the REST API link
    remove_action('wp_head', 'wp_oembed_add_discovery_links'); // remove oEmbed discovery links
    remove_action('template_redirect', 'rest_output_link_header', 11, 0); // remove the REST API link from HTTP Headers
    remove_action('wp_head', 'wp_oembed_add_host_js'); // remove oEmbed-specific javascript from front-end / back-end
    remove_action('rest_api_init', 'wp_oembed_register_route'); // remove the oEmbed REST API route
    remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10); // don't filter oEmbed results
}
add_action('after_setup_theme', 'header_cleanup');

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
    echo 'Website by <a href="https://mathieudelporte.be" target="_blank">Mathieu Delporte</a>';
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
    // remove_menu_page('edit-comments.php'); // Comments
    // remove_menu_page('themes.php'); // Appearance
    // remove_menu_page('plugins.php'); // Plugins
    // remove_menu_page('users.php'); // Users
    // remove_menu_page('tools.php'); // Tools
    // remove_menu_page('options-general.php'); // Settings
}
add_action('admin_menu', 'remove_menus');

// ---------------------------------------------------------------------------------------------
// REGISTER CSS & JS
// ---------------------------------------------------------------------------------------------

function theme_load_scripts() {
    wp_enqueue_style( 'theme-styles', get_stylesheet_directory_uri() . '/style.css', array(), filemtime( get_stylesheet_directory() . '/style.css' ) );
    wp_enqueue_script('jquery');
    wp_enqueue_script( 'scripts', get_stylesheet_directory_uri() . '/js/scripts.min.js', array( 'jquery' ), filemtime( get_stylesheet_directory() . '/js/scripts.min.js' ), true );
}
add_action('wp_enqueue_scripts', 'theme_load_scripts');

// ---------------------------------------------------------------------------------------------
// POST THUMBNAIL
// ---------------------------------------------------------------------------------------------

add_theme_support('post-thumbnails');

// ---------------------------------------------------------------------------------------------
// IMAGE SIZES
// ---------------------------------------------------------------------------------------------

// add_image_size( 'thumb_project', 600, 400, array( 'center', 'center' ) );

// ---------------------------------------------------------------------------------------------
// MENUS
// ---------------------------------------------------------------------------------------------

register_nav_menus(
    array(
        'main-nav' => __('Main Menu', 'theme_name')
    )
);

// ---------------------------------------------------------------------------------------------
// CLEAN NAVIGATION
// ---------------------------------------------------------------------------------------------

function nav_class_filter($var) {
    return is_array($var) ? array_intersect($var, array('current-menu-item', 'current-page-ancestor', 'has-dropdown', 'menu-item-has-children', 'button')) : '';
}
add_filter('nav_menu_css_class', 'nav_class_filter', 100, 1);

// ---------------------------------------------------------------------------------------------
// PAGE SLUG AS NAV ID
// ---------------------------------------------------------------------------------------------

function nav_id_filter($id, $item) {
    return 'nav-' . cleanname($item->title);
}
add_filter('nav_menu_item_id', 'nav_id_filter', 10, 2);

function cleanname($v) {
    $v = preg_replace('/[^a-zA-Z0-9s]/', '', $v);
    $v = str_replace(' ', '-', $v);
    $v = strtolower($v);
    return $v;
}

?>