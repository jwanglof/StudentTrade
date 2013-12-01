<?php
error_reporting(-1);
ini_set('display_errors', 1);

require_once("autoload_classes.php");
require_once("../Includes/Functions.php");

$config = array(
	'template_path' => array('../Templates/')
);

$front = new Savant3($config);
$dbh = new DbSelect();

// Set default values
$adCategory = "";
$categoryHeading = "Senaste annonserna";
$categoryColor = "#565656";

$city = (isset($_GET["city"]) ? $dbh->getCity($_GET["city"]) : $dbh->getCity("linkoping"));

// Not sure if this is needed?
// $searchActions = "";
// if (isset($_GET["campus"]))
// 	$searchActions .= "<input type=\"hidden\" name=\"campus\" value=\"". replaceSwedishLetters(replaceSpecialChars(strtolower($_GET["campus"]))) ."\" />";
// if (isset($_GET["type"]))
// 	$searchActions .= "<input type=\"hidden\" name=\"type\" value=\"". $_GET["type"] ."\" />";

$title = "Senaste annonserna från ". $city["city_name"];

$proceed = True;

$pageNo = 1;
if (isset($_GET["pageNo"]) && $_GET["pageNo"] > 0)
	$pageNo = $_GET["pageNo"];

$paginationURL = "front.php?city=". $_GET["city"];
$paginationURL .= isset($_GET["campus"]) ? "&campus=". $_GET["campus"] : "";
$paginationURL .= isset($_GET["type"]) ? "&type=". $_GET["type"] : "";
$paginationURL .= "&pageNo=";

$pagination = new Pagination(10, $paginationURL);

if (isset($_GET["type"], $_GET["campus"])) {
	$adCategory = $dbh->getAdCategoryFromName($_GET["type"]);
	$campus = $dbh->getCampusFromName(replaceSpecialChars($_GET["campus"], True));

	$categoryHeading = $adCategory["description"];
	$categoryColor = $adCategory["color"];

	if (empty($adCategory) || empty($campus))
		$proceed = False;

	$campusID = $campus["id"];

	$pagination->setDbQuery("getAdsWithAdCategoryFromCampus", $city["id"], $campusID, $adCategory["id"]);
}

else if (isset($_GET["type"]) && !isset($_GET["campus"])) {
	$adCategory = $dbh->getAdCategoryFromName($_GET["type"]);

	$categoryHeading = $adCategory["description"];
	$categoryColor = $adCategory["color"];

	if (empty($adCategory))
		$proceed = False;

	$pagination->setDbQuery("getAdsWithAdCategoryIDFromCity", $city["id"], NULL, $adCategory["id"]);
}

else if (isset($_GET["campus"]) && !isset($_GET["type"])) {
	$campus = $dbh->getCampusFromName(replaceSpecialChars($_GET["campus"], True));

	if (empty($campus))
		$proceed = False;

	$campusID = $campus["id"];

	$pagination->setDbQuery("getAdsFromCampus", $city["id"], $campusID, NULL);
}
else if (isset($_GET["searchString"])) {
	$pagination->setDbQuery("searchAdsWithName", $city["id"], NULL, NULL, $_GET["searchString"]);
	$categoryHeading = "Resultat av <i>". $_GET["searchString"] ."</i>";
}

else {
	$pagination->setDbQuery("getAds", $city["id"], NULL, NULL);
}

$pagination->setLastPage();
$pagination->setCurrentPage($pageNo);
$ads = array();
foreach ($pagination->getCurrentAds() as $ad) {
	$adTmpArray = array();
	$adCategory = $dbh->getAdCategoryFromID($ad["fk_ad_adCategory"]);

	$adTmpArray["url"] = "ad_show.php?city=". $_GET["city"];
	if (isset($_GET["campus"]))
		$adTmpArray["url"] .= "&campus=". replaceSwedishLetters(replaceSpecialChars(strtolower($_GET["campus"])));
	if (isset($_GET["type"]))
		$adTmpArray["url"] .= "&type=". $_GET["type"];
	$adTmpArray["url"] .= "&aid=". $ad["id"];

	$adTmpArray["categoryName"] = $adCategory["name"];
	$adTmpArray["adTitleLimited"] = limitStringLength($ad["title"]);

	$adTmpArray["adType"] = $dbh->getAdTypeFromAdTypeID($ad["fk_ad_adType"]);

	$adTmpArray["campus"] = $dbh->getCampusFromID($ad["fk_ad_campus"]);

	$adTmpArray["dateCreated"] = date_format(date_create($ad["date_created"]), "Y-m-d");

	$adTmpArray["price"] = $ad["price"];

	array_push($ads, $adTmpArray);
}

/*
 * Pagination
 * TODO
 * If someone has searched for something, searchString NEEDS to be in the pagination link!
 */
// Previous page
if (empty($pagination->getPreviousPage()))
	$paginationPrevPage = "<li class=\"disabled\"><span>&laquo;</span></li>";
else {
	if (isset($_GET["searchString"]))
		$prevURL = $front->ahref($pagination->getURL() ."&searchString=". $_GET["searchString"] ."&". $pagination->getPreviousPage(), "&laquo;");
	else
		$prevURL = $front->ahref($pagination->getURL() . $pagination->getPreviousPage(), "&laquo;");
	$paginationPrevPage = "<li>". $prevURL ."</li>";
}

// Total number of pages
$paginationPages = array();
foreach ($pagination->getPages() as $page) {
	if ($pageNo == $page)
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
 * Pagination
 */


$front->paginationURL			= $paginationURL;
$front->proceed					= $proceed;
// $front->searchActions 			= $searchActions;
$front->ads 					= $ads;
$front->categoryHeading 		= $categoryHeading;
$front->categoryColor 			= $categoryColor;
$front->city  					= $city;

$front->paginationPrevPage 		= $paginationPrevPage;
$front->paginationPages 		= $paginationPages;
$front->paginationNextPage		= $paginationNextPage;

$front->header 					= include 'header.php';
$front->footer 					= $front->fetch("footer.tpl");
$front->rightColumn 			= $front->fetch("right.tpl");

$front->display("front.tpl");

$dbh = null;
$front = null;
?>