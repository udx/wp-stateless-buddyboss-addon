<?php

/**
 * Plugin Name: WP-Stateless - BuddyBoss Platform Addon
 * Plugin URI: https://stateless.udx.io/addons/buddyboss
 * Description: Provides compatibility between the BuddyBoss Platform and the WP-Stateless plugin.
 * Author: UDX
 * Version: 0.0.1
 * Text Domain: slcabbp
 * Author URI: https://udx.io
 * License: MIT
 * 
 * Copyright 2024 UDX (email: info@udx.io)
 */

namespace SLCA\BuddyBoss;

add_action('plugins_loaded', function () {
  if (class_exists('wpCloud\StatelessMedia\Compatibility')) {
    require_once 'vendor/autoload.php';
    // Load 
    return new BuddyBoss();
  }

  add_filter('plugin_row_meta', function ($plugin_meta, $plugin_file, $_, $__) {
    if ($plugin_file !== join(DIRECTORY_SEPARATOR, [basename(__DIR__), basename(__FILE__)])) return $plugin_meta;
    $plugin_meta[] = sprintf('<span style="color:red;">%s</span>', __('This plugin requires WP-Stateless plugin version 3.4.0 or greater to be installed and active.'));
    return $plugin_meta;
  }, 10, 4);
});
