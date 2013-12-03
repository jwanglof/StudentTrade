<?php
error_reporting(-1);
ini_set("display_errors", 1);

date_default_timezone_set('UTC');
define('APPLICATION_PATH', realpath(dirname(__DIR__)) ."/StudentTrade");

use Slim\Slim;

require_once(APPLICATION_PATH ."/StudentTrade/Composer/vendor/autoload.php");
require_once(APPLICATION_PATH ."/StudentTrade/Includes/Functions.php");
require_once(APPLICATION_PATH ."/StudentTrade/Includes/AutoClassLoader.php");

$dbh = new DbSelect();
$config = require_once(APPLICATION_PATH ."/config.php");
$app = new Slim($config["slim"]);

// $cities 	= $dbh->getCityIDs();

// $leftColumn = array();
// $rightColumn = array();
// for ($i = 0; $i < count($cities); $i++) {
// 	if ($i < (count($cities)/2))
// 		array_push($leftColumn, $cities[$i]);
// 	else
// 		array_push($rightColumn, $cities[$i]);
// }

// $dbh = null;
// http://www.slimframework.com/news/how-to-organize-a-large-slim-framework-application
// http://www.youtube.com/watch?v=yEA0VWHCFac
$app->get("/", function() use ($app, $dbh) {
	$cities = $dbh->getCityIDs();
	$app->render("index.tpl", array("page_title" => "Startsidan"));
});

$app->get("/city/:city", function($city) use ($app) {
	$app->render("front.tpl", array("city" => $city));
});

// $app->get('/page/:page', function ($page = 1) use ($app, $container) {
$app->get("/index/hello/:name", function($name) use ($app) {
	echo "Hello, $name";
});

$app->run();

/*
header("Content-Type: text/html; charset=utf-8");



*/

?>