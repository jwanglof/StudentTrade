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

// http://www.slimframework.com/news/how-to-organize-a-large-slim-framework-application
// http://www.youtube.com/watch?v=yEA0VWHCFac

/*
 * Ze header
 */
function setHeader($app, $_city, $_campus, $_category, $_aid) {
	$header = new Header();
	$header->setCurrentCity($_city);

	$currentCity = $header->getCurrentCity();

	$currentUrl = $app->request()->getRootUri() ."/city/". $currentCity["short_name"];
	if (!empty($_campus))
		$currentUrl .= "/campus/". $_campus;
	if (!empty($_category))
		$currentUrl .= "/category/". $_category;
	if (!empty($_aid))
		$currentUrl .= "/ad/". $_aid;

	$headerVars = array(
		"city"			=> $currentCity,
		"dir" 			=> substr($app->request()->getRootUri(), 0, -9),
		"base_url"		=> $app->request()->getRootUri() ."/city/". $currentCity["short_name"],
		"current_url" 	=> $currentUrl,
		"campuses" 		=> $header->getCampuses(),
		"cities" 		=> $header->getCities(),
		"adCategories"	=> $header->getCategories($_category),
		"newAd"			=> $header->getAddNewAdURL($_category, $_campus),
		"breadcrumbs"	=> $header->getBreadcrumbs($_category, $_campus, $_aid)
	);

	return $headerVars;
}
/*
 * End
 * Ze header
 */

$app->get("/", function() use ($app) {
	$index = new Index();

	$app->render("index.tpl", array("dir" => WEB_PATH, "leftColumn" => $index->getLeftColumn(), "rightColumn" => $index->getRightColumn()));
});

// Should really make this more module!
$app->get("/city/:city(/campus/:campus)(/category/:category)(/ad/:aid)(/page/:page)", function($_city, $_campus=NULL, $_category=NULL, $_aid=NULL, $_page=1) use ($app) {
	$city = new City();
	if ($_category != NULL)
		$city->setCategory($_category);

	$headerArray = setHeader($app, $_city, $_campus, $_category, $_aid);
	$_campusInfo = searchMultiArray($_campus, "short_name", $headerArray["campuses"]);
	$_categoryInfo = searchMultiArray($_category, "name", $headerArray["adCategories"]);

	$pagination = new Pagination(10);
	$pagination->setURL($headerArray["current_url"]);
	// echo $_city ." --- ". $_campus ." --- ". $_category;
	$pagination->setDbQuery($headerArray["city"]["id"], $_campusInfo["id"], $_categoryInfo["id"]); //TODO: ADD SEARCH-STRING
	$pagination->setLastPage();
	$pagination->setCurrentPage($_page);

	$ads = array();
	foreach ($pagination->getCurrentAds() as $ad) {
		$adTmpArray = array();
		$adTmpArray["category"] = searchMultiArray($ad["fk_ad_adCategory"], "id", $headerArray["adCategories"]);

		$adTmpArray["adTitleLimited"] = limitStringLength($ad["title"]);

		$adTmpArray["adType"] = $pagination->getAdType($ad["fk_ad_adType"]);

		$adTmpArray["campus"] = searchMultiArray($ad["fk_ad_campus"], "id", $headerArray["campuses"]);

		$adTmpArray["dateCreated"] = date_format(date_create($ad["date_created"]), "Y-m-d");

		$adTmpArray["price"] = $ad["price"];

		array_push($ads, $adTmpArray);
	}

	$app->render("city.tpl", array(
			"header" 			=> $headerArray,
			"adCategory"		=> $city->getCategory(),
			"ads" 				=> $ads,

			$front->paginationURL			= $paginationURL;
			$front->paginationPrevPage 		= $paginationPrevPage;
			$front->paginationPages 		= $paginationPages;
			$front->paginationNextPage		= $paginationNextPage;
		)
	);
})->conditions(array("page" => "[0-9]*"));

$app->run();
?>