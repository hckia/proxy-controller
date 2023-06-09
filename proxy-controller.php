<?php
/**
 * Plugin Name: Proxy Controller
 * Description: A plugin that controls proxy requests. Mostly for offloading Pantheon directories
 * Plugin URI: github.com/hckia/proxy-controller
 * Version: 1.0
 * Author: H Cyrus Kia
 * Author URI: https://cyruskia.com
 * Text Domain: proxy-controller
 */

/**
 * You can set constants after this comment, or in wp-config.php
 */

require_once __DIR__ . '/includes/custom-headers.php';
// @TODO I would suggest we don't supply this file, it makes more sense for all user configurations to be outside of the mu-plugin which may be updated in the future.
// Only comment out proxy-paths if you do not wish to define in wp-config.php. This will require you to update proxy-paths.php
// require_once __DIR__ . '/includes/proxy-paths.php';
require_once __DIR__ . '/includes/proxy-requests.php';
