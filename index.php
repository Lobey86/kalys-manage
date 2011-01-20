<?php
/**
 * Project Jamal
 * rrrvvv
 * @author  Alex
 * @version 0.002
 */

error_reporting(E_ALL);
ini_set('display_errors', 'On');

date_default_timezone_set("Europe/Bucharest");

define('ROOT_PATH', realpath(dirname(__FILE__)));

// Define path to application directory
define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/application'));

// Define application environment
define('APPLICATION_ENV', 'development');

// Typically, you will also want to add your library/ directory
// to the include_path, particularly if it contains your ZF install
set_include_path(implode(PATH_SEPARATOR, array(
    realpath(dirname(__FILE__) . '/library'),
    get_include_path(),
)));

/** Zend_Application */
require_once 'Zend/Application.php';

// Create application, bootstrap, and run
$application = new Zend_Application(APPLICATION_ENV, APPLICATION_PATH . '/configs/Application.ini');
$application->bootstrap()->run();