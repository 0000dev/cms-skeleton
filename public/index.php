<?php
  

error_reporting(E_ALL);
ini_set('display_errors', 0);

$time_start = microtime(true); 

require_once '../src/config.php';
require '../vendor/autoload.php';

$controller = new App(); 

$url = (isset($_GET['___url'])?$_GET['___url']:$_SERVER['REQUEST_URI']);
$url = htmlspecialchars($url, ENT_QUOTES);
$route =  array_filter(explode('/', $url));


/**
	== Router ==
*/


if (isset($route) && count($route)>0) {

	switch ($route[0]) {

		case '/some': 

			$controller -> itemPage($route[0]);
			break;

		case $route_vars['articles_page']: 

			$controller -> itemPage($route[0]);
			break;

		default: 
			$controller -> itemPage($route[0]);
	}
			

} else {

	# home page
	$controller -> homePage();
}
 

//echo "\n\n\n <br><br><br>".'Generated in: ' . (microtime(true) - $time_start);
