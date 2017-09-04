<?php

/**
 * Plugin Name:       Modularity sections
 * Plugin URI:        https://github.com/helsingborg-stad/modularity-sections
 * Description:       Provides graphical sections intended for full-width usage
 * Version:           1.0.0
 * Author:            Sebastian Thulin
 * Author URI:        https://github.com/sebastianthulin
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
define('MODULARITYSECTIONS_MODULE_PATH', MODULARITYSECTIONS_PATH . 'source/php/Module');

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

// Acf auto import and export
add_action('plugins_loaded', function () {
    $acfExportManager = new \AcfExportManager\AcfExportManager();
    $acfExportManager->setTextdomain('modularity-sections');
    $acfExportManager->setExportFolder(MODULARITYSECTIONS_PATH . 'acf-fields/');
    $acfExportManager->autoExport(array(
        'base' => 'group_599eaa60c0e79',
        'featured' => 'group_599ea0d1d160b',
        'full' => 'group_599fdc072e961',
        'split' => 'group_599fddb1da69a',
    ));
    $acfExportManager->import();
});

/**
 * Registers the module
 */
add_action('plugins_loaded', function () {
    if (function_exists('modularity_register_module')) {
        modularity_register_module(
            MODULARITYSECTIONS_MODULE_PATH ."/Split/",
            'Split'
        );
        modularity_register_module(
            MODULARITYSECTIONS_MODULE_PATH ."/Full/",
            'Full'
        );
        modularity_register_module(
            MODULARITYSECTIONS_MODULE_PATH ."/Featured/",
            'Featured'
        );
    }
});
