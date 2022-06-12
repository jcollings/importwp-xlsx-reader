<?php

/**
 * Plugin Name: Import WP - XLSX Importer Addon
 * Plugin URI: https://www.importwp.com
 * Description: Allow Import WP to import xlsx files, by convert an xlsx file into csv.
 * Author: James Collings <james@jclabs.co.uk>
 * Version: 2.1.1 
 * Author URI: https://www.importwp.com
 * Network: True
 */

$base_path = dirname(__FILE__);

if (class_exists('ZipArchive')) {
    require_once $base_path . '/class/autoload.php';
    require_once $base_path . '/setup.php';

    // Install updater
    if (file_exists($base_path . '/updater.php') && !class_exists('IWP_Updater')) {
        require_once $base_path . '/updater.php';
    }

    if (class_exists('IWP_Updater')) {
        $updater = new IWP_Updater(__FILE__, 'importwp-xlsx-reader');
        $updater->initialize();
    }
}
