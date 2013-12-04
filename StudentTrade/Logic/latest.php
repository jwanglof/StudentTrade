<?php
$config = array(
	'template_path' => array('../Templates/')
);

$latest = new Savant3($config);
$dbh = new DbSelect();

// Set default values
$adCategory = "";
$city = (isset($_GET["city"]) ? $dbh->getCity($_GET["city"]) : $dbh->getCity("linkoping"));
$searchAction = generateSearchInputs($city["short_name"], (isset($_GET["campus"]) ? $_GET["campus"] : NULL), (isset($_GET["type"]) ? $_GET["type"] : NULL));
$proceed = True;

$pageNo = 1;
if (isset($_GET["pageNo"]) && $_GET["pageNo"] > 0)
	$pageNo = $_GET["pageNo"];

$paginationURL = "front.php?page=latest&city=". $_GET["city"];
$paginationURL .= isset($_GET["campus"]) ? "&campus=". $_GET["campus"] : "";
$paginationURL .= isset($_GET["type"]) ? "&type=". $_GET["type"] : "";
$paginationURL .= "&pageNo=";

$pagination = new Pagination(20, $paginationURL);

if (isset($_GET["type"], $_GET["campus"])) {
	$adCategory = $dbh->getAdCategoryFromName($_GET["type"]);
	$campus = $dbh->getCampusFromName(replaceSpecialChars($_GET["campus"], True));

	if (empty($adCategory) || empty($campus))
		$proceed = False;

	$campusID = $campus["id"];

	$pagination->setDbQuery("getAdsWithAdCategoryFromCampus", $city["id"], $campusID, $adCategory["id"]);
}

else if (isset($_GET["type"]) && !isset($_GET["campus"])) {
	$adCategory = $dbh->getAdCategoryFromName($_GET["type"]);

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

else {
	$pagination->setDbQuery("getAds", $city["id"], NULL, NULL);
}

$pagination->setLastPage();
$pagination->setCurrentPage($pageNo);

$ads = array();
foreach ($pagination->getCurrentAds() as $ad) {
	$adTmpArray = array();
	$adCategory = $dbh->getAdCategoryFromID($ad["fk_ad_adCategory"]);

	$adTmpArray["url"] = generateShowAdURL($city["short_name"], $ad["title"], (isset($_GET["campus"]) ? $_GET["campus"] : NULL), (isset($_GET["type"]) ? $_GET["type"] : NULL), $ad["id"]);
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
 */
// Previous page
if (empty($pagination->getPreviousPage()))
	$paginationPrevPage = "<li class=\"disabled\"><span>&laquo;</span></li>";
else
	$paginationPrevPage = "<li><a href=\"". $pagination->getURL() . $pagination->getPreviousPage() ."\">&laquo;</a></li>";

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


$latest->paginationURL				= $paginationURL;
$latest->proceed					= $proceed;
$latest->adCategory  				= $adCategory;
$latest->searchAction 				= $searchAction;
$latest->ads 						= $ads;

$latest->paginationPrevPage 		= $paginationPrevPage;
$latest->paginationPages 			= $paginationPages;
$latest->paginationNextPage			= $paginationNextPage;

// http://devzone.zend.com/1542/creating-modular-template-based-interfaces-with-savant/

if ($proceed)
	$latest->display("latest.tpl");
else
	echo "<h2>Fel parametrar i URLn!</h2>";

$dbh = null;
?>