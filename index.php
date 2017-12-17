<?php

session_start();

require_once 'config/config.php';

//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

use controller\AppController;

define("DOCUMENT_ROOT", config\Config::create()->getDocumentRoot());

spl_autoload_register(function ($class_name) {
    $class_name = str_replace('\\', '/', $class_name);
    $file = DOCUMENT_ROOT . $class_name . '.php';
//    echo $file;
//    echo '<br>';
    if (!file_exists($file)) {
        return false;
    }
    include $file;
});


$appController = AppController::create();
$appController->run();





