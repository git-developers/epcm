<?php

ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', realpath(dirname(__FILE__)) . DS);
define('APP_PATH', ROOT . 'application' . DS);

require_once APP_PATH . 'Config.php';
require_once APP_PATH . 'Autoload.php';

try{
	session_start();
    Bootstrap::run(new Request);
} catch(Exception $e) {
    echo "Jafeth :: " . $e->getMessage();
}

?>