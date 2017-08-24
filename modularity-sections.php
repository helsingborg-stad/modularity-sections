<?php

/**
 * Plugin Name:       Modularity sections
 * Plugin URI:        (#plugin_url#)
 * Description:       Provides graphical sections intended for full-width usage
 * Version:           1.0.0
 * Author:            Sebastian Thulin
 * Author URI:        (#plugin_author_url#)
 * License:           MIT
 * License URI:       https://opensource.org/licenses/MIT
 * Text Domain:       modularity-sections
 * Domain Path:       /languages
 */

 // Protect agains direct file access
if (! defined('WPINC')) {
    die;
}

define('MODULARITYSECTIONS_PATH', plugin_dir_path(__FILE__));
define('MODULARITYSECTIONS_URL', plugins_url('', __FILE__));
define('MODULARITYSECTIONS_TEMPLATE_PATH', MODULARITYSECTIONS_PATH . 'templates/');

load_plugin_textdomain('modularity-sections', false, plugin_basename(dirname(__FILE__)) . '/languages');

require_once MODULARITYSECTIONS_PATH . 'source/php/Vendor/Psr4ClassLoader.php';
require_once MODULARITYSECTIONS_PATH . 'Public.php';

// Instantiate and register the autoloader
$loader = new ModularitySections\Vendor\Psr4ClassLoader();
$loader->addPrefix('ModularitySections', MODULARITYSECTIONS_PATH);
$loader->addPrefix('ModularitySections', MODULARITYSECTIONS_PATH . 'source/php/');
$loader->register();

// Start application
new ModularitySections\App();
