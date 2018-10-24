<?php
namespace Docusign;

ini_set("date.timezone", "America/Denver");

$env = getenv("APPLICATION_ENV");
define("APPLICATION_ENV", ($env ? $env : 'production'));
ini_set("display_errors", stripos(APPLICATION_ENV, "development") !== false ? true : false);
define("APPLICATION_PATH", '../application');

require_once '../vendor/autoload.php';
require_once APPLICATION_PATH . "/Application.php";

$endpoint = substr($_SERVER["REQUEST_URI"], 0, 1) === '/' ? substr($_SERVER["REQUEST_URI"], 1) : $_SERVER["REQUEST_URI"];
$httpRequestType = strtoupper($_SERVER["REQUEST_METHOD"]);

try{
    $api = new Application();
	$api->Route($endpoint, $httpRequestType);
}catch(\Exception $e){
	header('HTTP/1.1 500 Internal Server Error');
	echo $e->getMessage();
	echo "\r\n\r\n" . $e->getTraceAsString();
}