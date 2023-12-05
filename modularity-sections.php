<?php

/**
 * Plugin Name:       Modularity sections
 * Plugin URI:        https://github.com/helsingborg-stad/modularity-sections
 * Description:       Provides graphical sections intended for full-width usage
 * Version: 3.0.3
 * Author:            Sebastian Thulin, Nikolas Ramstedt
 * Author URI:        https://github.com/helsingborg-stad
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
define('MODULARITYSECTIONS_FULL_VIEW_PATH', MODULARITYSECTIONS_MODULE_PATH . '/Full/views');
define('MODULARITYSECTIONS_SPLIT_VIEW_PATH', MODULARITYSECTIONS_MODULE_PATH . '/Split/views');
define('MODULARITYSECTIONS_FEATURED_VIEW_PATH', MODULARITYSECTIONS_MODULE_PATH . '/Featured/views');
define('MODULARITYSECTIONS_CARD_VIEW_PATH', MODULARITYSECTIONS_MODULE_PATH . '/Card/views');


load_plugin_textdomain('modularity-sections', false, plugin_basename(dirname(__FILE__)) . '/languages');

// Autoload from plugin
if (file_exists(MODULARITYSECTIONS_PATH . 'vendor/autoload.php')) {
    require_once MODULARITYSECTIONS_PATH . 'vendor/autoload.php';
}
require_once MODULARITYSECTIONS_PATH . 'Public.php';

// Start application
new ModularitySections\App();

// Upgrade database
new \ModularitySections\Upgrade();

// Acf auto import and export
add_action('plugins_loaded', function () {
    $acfExportManager = new \AcfExportManager\AcfExportManager();
    $acfExportManager->setTextdomain('modularity-sections');
    $acfExportManager->setExportFolder(MODULARITYSECTIONS_PATH . 'acf-fields/');
    $acfExportManager->autoExport(array(
        'full' => 'group_6154339331c4e',
        'split-featured' => 'group_599fddb1da69a',
        'card' => 'group_63ff1e1238bd3'
    ));
    $acfExportManager->import();
});

/**
 * Registers the module
 */
add_action('plugins_loaded', function () {
    if (function_exists('modularity_register_module')) {
        modularity_register_module(
            MODULARITYSECTIONS_MODULE_PATH . "/Split/",
            'Split'
        );
        modularity_register_module(
            MODULARITYSECTIONS_MODULE_PATH . "/Full/",
            'Full'
        );
        modularity_register_module(
            MODULARITYSECTIONS_MODULE_PATH . "/Featured/",
            'Featured'
        );
        modularity_register_module(
            MODULARITYSECTIONS_MODULE_PATH . "/Card/",
            'Card'
        );
    }
});

add_filter('/Modularity/externalViewPath', function ($viewPaths) {
    $viewPaths['mod-section-split'] = MODULARITYSECTIONS_SPLIT_VIEW_PATH;
    $viewPaths['mod-section-full'] = MODULARITYSECTIONS_FULL_VIEW_PATH;
    $viewPaths['mod-section-featured'] = MODULARITYSECTIONS_FEATURED_VIEW_PATH;
    $viewPaths['mod-section-card'] = MODULARITYSECTIONS_CARD_VIEW_PATH;
    return $viewPaths;
});
