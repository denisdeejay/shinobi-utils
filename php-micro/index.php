<?php
define('PATH_APP', 'app/');
define('ENVIRONMENT','development');

// Errors
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Go go go...
try {
	require_once(PATH_APP . 'application.php');
	$app = application::get_instance();
	$app->init();
} catch (Exception $e) {
	header("HTTP/1.0 404 Not Found"); 
	exit;
}