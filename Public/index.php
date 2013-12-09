<?php
error_reporting(-1);
ini_set("display_errors", 1);

date_default_timezone_set('UTC');
define('APPLICATION_PATH', realpath(dirname(__DIR__)) ."/StudentTrade");
define("WEB_PATH", realpath(dirname(__FILE__)));

use Slim\Slim;

require_once(APPLICATION_PATH ."/Composer/vendor/autoload.php");
require_once(APPLICATION_PATH ."/Includes/Functions.php");
require_once(APPLICATION_PATH ."/Includes/AutoClassLoader.php");

$config = require_once(WEB_PATH ."/config.php");
$app = new Slim($config["slim"]);
$env = $app->environment();

$app->configureMode("development", function() use ($app, $env) {
	$env["URLIMG"] 		= "../Img/";
	$env["URLCSS"] 		= "../Css/";
	$env["URLJS"]		= "../Scripts/";
	$app->config("debug", true);
});

// $headerValues = array();
// Need this because there might be more than one school in $city["id"]
// E.g. Stockholm has KTH and Stockholms University
// 
// $campuses is for breadcrumbs
// $campusURLs is for the scroll down on the website
// $universities = $dbh->getUniversitiesFromCityID($city["id"]);
// $campuses = array();
// $campusURLs = array();
// foreach ($universities as $uni) {
// 	foreach ($dbh->getCampusFromUniversityID($uni["id"]) as $campus) {
// 		// $campusName = replaceSwedishLetters(replaceSpecialChars(strtolower($campus["campus_name"])));
// 		// $campusURL = "front.php?city=". $_GET["city"];
// 		// $campusURL .= "&campus=". $campusName;
// 		// if (isset($_GET["type"]))
// 		// 	$campusURL .= "&type=". $_GET["type"];

// 		array_push($campusURLs, $header->ahref($campusURL, $campus["campus_name"], "id=". $campusName));
// 		array_push($campuses, $campus["campus_name"]);
// 	}
// }
// $headerValues["campuses"] = $campuses;

// http://www.slimframework.com/news/how-to-organize-a-large-slim-framework-application
// http://www.youtube.com/watch?v=yEA0VWHCFac

$app->get("/", function() use ($app) {
	$index = new Index();

	$app->render("index.tpl", array("dir" => WEB_PATH, "leftColumn" => $index->getLeftColumn(), "rightColumn" => $index->getRightColumn()));
});

$app->get("/city/:city(/campus/:campus)(/category/:category)(/ad/:aid)", function($_city, $_campus=NULL, $_category=NULL, $_aid=NULL) use ($app) {
	$city = new City($_city, $_campus, $_category);
	$general = new General();
	$general->setCurrentCity($_city);

	$currentCity = $general->getCurrentCity();

	$current_url = $app->request()->getRootUri() ."/city/". $currentCity["short_name"];
	if ($_campus != NULL)
		$current_url .= "/campus/". $_campus;
	if ($_category != NULL)
		$current_url .= "/category/". $_category;
	if ($_aid != NULL)
		$current_url .= "/ad/". $_aid;

	$app->render("city.tpl", array(
			"city"			=> $currentCity,
			"dir" 			=> substr($app->request()->getRootUri(), 0, -9),
			"base_url"		=> $app->request()->getRootUri() ."/city/". $currentCity["short_name"],
			"current_url" 	=> $current_url,
			"campuses" 		=> $general->getCampuses(),
			"cities" 		=> $general->getCities(),
			"adCategories"	=> $general->getCategories($_category),
			"newAd"			=> $general->getAddNewAdURL($_category, $_campus),
			"breadcrumbs"	=> $general->getBreadcrumbs($_category, $_campus, $_aid)
		)
	);
});

$app->run();
?>