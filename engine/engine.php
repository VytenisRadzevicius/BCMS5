<?php

session_start();

// Includes and classes
include 'config.php';
include 'includes/autoload.inc.php';
include 'includes/helperfunctions.inc.php';

// Debug options
if(DEBUG) {
    ini_set("display_errors", "1");
    error_reporting(E_ALL);

    $options = [
        PDO::ATTR_EMULATE_PREPARES => false,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ];
} else {
    $options = [];
}

$config = array(
    "db_host" => DB_HOST,
    "db_type" => DB_TYPE,
    "db_user" => DB_USER,
    "db_pass" => DB_PASS,
    "db_name" => DB_NAME,
    "db_char" => DB_CHAR,
    "options" => $options
);

// Initialize container
$container = new Container($config);

$user = $container->getUserObj();
$page = $container->getPageObj();
$role = $container->getRoleObj();
$privilege = $container->getPrivilegeObj();

isset($_GET['p']) ? $p = $_GET['p'] : $p = '';
isset($_GET['b']) ? $b = $_GET['b'] : $b = '';