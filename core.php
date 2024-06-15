<?php
/*
Plugin Name: related posts  
Plugin URI: wferwe
Description: پست های مرتبط
Version: 1.0.0
Author: moham madhossein aalipor
Author URI: https://automattic.com/wordpress-plugins/
License: GPLv2 or later

*/
defined('ABSPATH') || exit;
define('rp_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('rp_PLUGIN_URL', plugin_dir_url(__FILE__));

function wp_rp_register_assets()
{
    //css
    wp_enqueue_style('rp-style', rp_PLUGIN_URL . 'assets/css/style.css');
    wp_enqueue_style('rp-style-owl', rp_PLUGIN_URL . 'assets/css/owl.carousel.min.css');
    wp_enqueue_style('rp-style-owl-theme', rp_PLUGIN_URL . 'assets/css/owl.theme.default.min.css');
    //js
    wp_enqueue_script('rp-main', rp_PLUGIN_URL . 'assets/js/main.js', ['jquery'], '1.0.0', true);
    wp_enqueue_script('rp-owl', rp_PLUGIN_URL . 'assets/js/owl.carousel.min.js', ['jquery'], '1.0.0', true);
}
function admin_register_assets()
{
    //css
    wp_enqueue_style('rp-admin-style', rp_PLUGIN_URL . 'assets/css/admin/style.css');
    //js
    // wp_enqueue_script('rp-main', rp_PLUGIN_URL . 'assets/js/main.js', ['jquery'], '1.0.0', true);
}
add_action('admin_enqueue_scripts', 'admin_register_assets');
add_action('wp_enqueue_scripts', 'wp_rp_register_assets');
include_once rp_PLUGIN_DIR . 'view/front/related-posts.php';
include_once rp_PLUGIN_DIR . '_inc/setting/menu.php';
register_deactivation_hook(__FILE__, 'selet_setting_rp');
function selet_setting_rp()
{
    $settings_array = [
        '_rp_title',
        '_rp_number',
        '_rp_accoording_to',
        '_rp_show'
    ];
    foreach ($settings_array as $item) delete_option($item);
}
register_activation_hook(__FILE__, 'set_setting_rp');
function set_setting_rp()
{
    $settings_array = [
        '_rp_title' => 'مطالب مرتبط',
        '_rp_number' => 4,
        '_rp_accoording_to' => 'category',
        '_rp_show' => 'list'
    ];
    foreach ($settings_array as $item => $value) update_option($item, $value);
}
