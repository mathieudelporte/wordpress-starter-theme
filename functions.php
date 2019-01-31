<?php

// ---------------------------------------------------------------------------------------------
// INCLUDES
// ---------------------------------------------------------------------------------------------

@include 'functions-admin.php';

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