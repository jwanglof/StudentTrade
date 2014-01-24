<?php
// phpinfo();
mcrypt_create_iv(32);
ob_start();
session_start();

error_reporting(-1);
ini_set("display_errors", 1);

date_default_timezone_set('UTC');
define('APPLICATION_PATH', realpath(dirname(__DIR__)) ."/StudentTrade");
define("WEB_PATH", realpath(dirname(__FILE__)));

if (empty($_SESSION["campus"]) && empty($_SESSION["category"])) {
	$_SESSION["campus"] = "";
	$_SESSION["category"] = "";
}
if (empty($_SESSION["sessProtector"])) {
        $_SESSION["sessProtector"] = session_id();
        session_write_close();
}
if (empty($_SESSION["newPictures"])) {
	$_SESSION["newPictures"] = [];
}

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
function setHeader($app, $_city, $_campus, $_category, $_aid=NULL) {
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
$app->post("/ajax/get", function() use($app) {
	$ajax = new Ajax();
	echo $ajax->get($_POST);
	$ajax = null;
});

$app->post("/ajax/mail", function() use ($app) {
	$ajax = new Ajax();
	echo $ajax->mail($_POST);
	$ajax = null;
});

$app->post("/ajax/update", function() use ($app) {
	$ajax = new Ajax();
	echo $ajax->update($_POST);
	$ajax = null;
});

$app->post("/upload", function() use ($app) {
	// Need to make this more secure!
	// Generate filename
	$filename = md5(mt_rand()). '.jpg';
	// Read RAW data
	$data = file_get_contents('php://input');
	// Read string as an image file
	$image = file_get_contents('data://'. substr($data, 5));

	// Save to disk
	// if (!file_put_contents(realpath("../.."). "/Public/Upload/". $filename, $image)) {
	$getDir = "local";
	if ($getDir == "local")
		$uploadDir = "/home/johan/Git/StudentTrade/Public/Upload/";
	else if ($getDir == "jumpstarter")
		$uploadDir = "/home/http/Public/Upload/";

	if (!file_put_contents($uploadDir . $filename, $image)) {
	        header('HTTP/1.1 503 Service Unavailable');
	        exit();
	}

	array_push($_SESSION["newPictures"], $filename);

	// Clean up memory
	unset($data);
	unset($image);

	// Return file URL
	echo $filename;
});

$app->get("/", function() use ($app) {
	$index = new Index();

	$app->render("index.tpl", array("dir" => WEB_PATH, "leftColumn" => $index->getLeftColumn(), "rightColumn" => $index->getRightColumn()));
});

$app->get("/city/:city/rules", function($_city) use ($app) {
	$app->render("rules.tpl", array(
			"header" 			=> setHeader($app, $_city, $_SESSION["campus"], $_SESSION["category"])
		)
	);
});

$app->get("/city/:city/ad/:aid", function($_city, $_aid) use ($app) {
	$showAd = new ShowAd();
	$showAd->setAd($_aid);

	$app->render("showAd.tpl", array(
			"header" 			=> setHeader($app, $_city, $_SESSION["campus"], $_SESSION["category"], $_aid),
			"ad" 				=> $showAd->getAd(),
			"adInfo" 			=> $showAd->getAdInfo(),
			"userInfo"			=> $showAd->getUserInfo(),
			"adCategory" 		=> $showAd->getAdCategory(),
			"adSubCategory"	=> $showAd->getAdSubCategory(),
			"adType"			=> $showAd->getAdType(),
			"pictures"			=> $showAd->getPictures()
		)
	);
});

$app->get("/city/:city/addNew(/:step)", function($_city, $_step=NULL) use ($app) {
	$newAd = new NewAd();

	$_SESSION["newAd"] = "";

	$renderTpl = "newAd.tpl";

	if ($_step == 2) {
		$_SESSION["newAd"] = $_POST;
		$renderTpl = "uploadImages.tpl";
	}

	$app->render($renderTpl, array(
			"header" 			=> setHeader($app, $_city, $_SESSION["campus"], $_SESSION["category"]),
			"adTypes" 			=> $newAd->getAdTypes(),
			"adCategories" 		=> $newAd->getAdCategories()
		)
	);
})->conditions(array("step" => "2"))->via("GET", "POST");

// $app->post("/city/:city/search", function($_city) use ($app) {
// 	$searchString = $app->request()->params("searchString");

// });

// Should really make this more module!
$app->map("/city/:city(/campus/:campus)(/category/:category)(/page/:page)(/search)", function($_city, $_campus=NULL, $_category=NULL, $_page=1) use ($app) {
	if ($app->request()->params("searchString"))
		$searchString = $app->request()->params("searchString");
	else
		$searchString = NULL;

	// Put everything below in City()????
	// Since I don't use anything in here except on this page!
	$city = new City();
	if ($_category != NULL)
		$city->setCategory($_category);

	// Set the sessions so they don't have to be in the URL all the time
	if ($_SESSION["campus"] != $_campus)
		$_SESSION["campus"] = $_campus;
	if ($_SESSION["category"] != $_category)
		$_SESSION["category"] = $_category;

	$headerArray = setHeader($app, $_city, $_campus, $_category);
	$_campusInfo = searchMultiArray($_campus, "short_name", $headerArray["campuses"]);
	$_categoryInfo = searchMultiArray($_category, "name", $headerArray["adCategories"]);

	/*
	 * Pagination
	 */
	$pagination = new Pagination(20);
	$pagination->setURL($headerArray["current_url"]);
	$pagination->setDbQuery($headerArray["city"]["id"], $_campusInfo["id"], $_categoryInfo["id"], $searchString); //TODO: ADD SEARCH-STRING
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

		$adTmpArray["id"] = $ad["id"];

		array_push($ads, $adTmpArray);
	}

	// Previous page
	if (empty($pagination->getPreviousPage()))
		$paginationPrevPage = "<li class=\"disabled\"><span>&laquo;</span></li>";
	else
		$paginationPrevPage = "<li><a href=\"". $pagination->getURL() . $pagination->getPreviousPage() ."\">&laquo;</a></li>";

	// Total number of pages
	$paginationPages = array();
	foreach ($pagination->getPages() as $page) {
		if ($_page == $page)
			array_push($paginationPages, "<li class=\"active\"><a href=\"". $pagination->getURL() . $page ."\">". $page ."</a></li>");
		else
			array_push($paginationPages, "<li><a href=\"". $pagination->getURL() . $page ."\">". $page ."</a></li>");
	}

	// Next page
	if (empty($pagination->getNextPage()))
		$paginationNextPage = "<li class=\"disabled\"><span>&raquo;</span></li>";
	else
		$paginationNextPage = "<li><a href=\"". $pagination->getURL() . $pagination->getNextPage() ."\">&raquo;</a></li>";
	/*
	 * END
	 * Pagination
	 */

	$app->render("city.tpl", array(
			"header" 			=> $headerArray,
			"adCategory"		=> $city->getCategory(),
			"ads" 				=> $ads,

			"paginationPrevPage"=> $paginationPrevPage,
			"paginationNextPage"=> $paginationNextPage,
			"paginationPages" 	=> $paginationPages
		)
	);
})->conditions(array("page" => "[0-9]*"))->via("GET", "POST");

$app->run();
?>