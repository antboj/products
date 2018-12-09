<?php
// Set json
header("Content-type: application/json");

// Get the HTTP method
$requestMethod = strtolower($_SERVER['REQUEST_METHOD']);

// Database info
define('DBHOST','localhost');
define('DBUSER','root');
define('DBPASS','');
define('DBNAME','products');

// Classes autoloader
spl_autoload_register(function($class){
    require_once "classes/{$class}.php";
});

// Get the device from URL string that is later instanciated by Fatory class
function device(){
	$devices = [
		"computer"=>"Computer",
		"desktop"=>"Desktop",
		"laptop"=>"Laptop",
		"tablet"=>"Tablet"
	];
	if(isset($_GET['device'])){
		$default_device = $_GET['device'];
		if(isset($devices[$default_device])){
			return $devices[$default_device];
		}else{
			throw new Exception('Unknown device');
		}
	}else{
		throw new Exception('Unknown device');
	}
}