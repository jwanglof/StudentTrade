<?php
header("Content-Type: text/html; charset=utf-8");
error_reporting(-1);
ini_set("display_errors", 1);

// Auto load the classes that are called
spl_autoload_register(function ($class) {
	$base_dir = "StudentTrade/";
	$directories = array(
		"Db/"
	);

	//for each directory
	foreach($directories as $directory)
	{
		//see if the file exsists
		if(file_exists($base_dir.$directory.$class . ".php"))
		{
			include($base_dir.$directory.$class . ".php");
			//only require the class once, so quit after to save effort (if you got more, then name them something else
			return;
		}
	}
});
require("StudentTrade/Composer/vendor/autoload.php");
$dbh 		= new DbSelect();
$config = require_once(__DIR__ ."/config.php");
require_once("StudentTrade/Includes/Functions.php");


$slim = new \Slim\Slim($config["slim"]);
// http://www.youtube.com/watch?v=yEA0VWHCFac
$slim->get("/", function() use ($slim, $dbh) {
	$cities = $dbh->getCityIDs();
	$slim->render("index.tpl", array("cities" => $cities));
});

$slim->get("/city/:city", function($city) use ($slim) {
	$slim->render("front.tpl", array("city" => $city));
});

$slim->get("/index/hello/:name", function($name) {
	echo "Hello, $name";
});

$slim->run();


$cities 	= $dbh->getCityIDs();

$leftColumn = array();
$rightColumn = array();
for ($i = 0; $i < count($cities); $i++) {
	if ($i < (count($cities)/2))
		array_push($leftColumn, $cities[$i]);
	else
		array_push($rightColumn, $cities[$i]);
}

$dbh = null;
?>