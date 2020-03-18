<?php

/**
 * Plugin Name: ImportWP - XLSX Importer Addon
 * Plugin URI: https://www.importwp.com
 * Description: Allow ImportWP to import xlsx files, by convert an xlsx file into csv.
 * Author: James Collings <james@jclabs.co.uk>
 * Version: 2.0.20 
 * Author URI: https://www.importwp.com
 * Network: True
 */

$iwpwc_base_path = dirname(__FILE__);

if (class_exists('ZipArchive')) {
    require_once $iwpwc_base_path . '/class/autoload.php';
    require_once $iwpwc_base_path . '/setup.php';
}
