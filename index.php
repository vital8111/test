<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
header('Content-Type: text/html; charset=utf-8');

require_once __DIR__ . '/autoload.php';

$uri = $_SERVER['REQUEST_URI'];
$parts = explode('/',$uri);
$ctrl = $parts[1] ? ucfirst($parts[1]):'Index';
$class = '\App\Controllers\\'.$ctrl;
unset($parts[0]);
unset($parts[1]);
$ctrl = new $class;
if(isset($parts[2])) {
    $params['action'] = $parts[2];
    if(isset($parts[3])) {
        $params['id'] = $parts[3];
    }
    $ctrl($params);
}else{
    $ctrl();
}






