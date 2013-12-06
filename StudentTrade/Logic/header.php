<?php
ob_start();
session_start();
header('Content-Type: text/html; charset=UTF-8');
mb_internal_encoding("UTF-8");

$header = new Savant3($config);

// Since header.php is included in all files it will get $dbh from the parent
// $dbh = new DbSelect();

if (!isset($_SESSION["sessProtector"])) {
	$_SESSION["sessProtector"] = session_id();
	session_write_close();
}

if (isset($_GET["city"]))
	$city = $dbh->getCity($_GET["city"]);
else
	$city = $dbh->getCity("linkoping");

// Need this because there might be more than one school in $city["id"]
// E.g. Stockholm has KTH and Stockholms University
// 
// $campuses is for breadcrumbs
// $campusURLs is for the scroll down on the website
$universities = $dbh->getUniversitiesFromCityID($city["id"]);
$campuses = array();
$campusURLs = array();
foreach ($universities as $uni) {
	foreach ($dbh->getCampusFromUniversityID($uni["id"]) as $campus) {
		$campusName = replaceSwedishLetters(replaceSpecialChars(strtolower($campus["campus_name"])));
		$campusURL = "front.php?city=". $_GET["city"];
		$campusURL .= "&campus=". $campusName;
		if (isset($_GET["type"]))
			$campusURL .= "&type=". $_GET["type"];

		array_push($campusURLs, $header->ahref($campusURL, $campus["campus_name"], "id=". $campusName));
		array_push($campuses, $campus["campus_name"]);
	}
}

$cities = $dbh->getCityIDs();
$citiesInformation = array();
foreach ($cities as $cityInfo) {
	$short_name = replaceSwedishLetters(strtolower($cityInfo["short_name"]));
	array_push($citiesInformation, $header->ahref("front.php?city=". $short_name, $cityInfo["city_name"]));
}

$adCategories = $dbh->getAdCategories();
$adCategory = array();

foreach ($adCategories as $category) {
	$tmpCategoryArray = array();
	$tmpCategoryArray["background-color"] = $category["color"];

	$tmpCategoryArray["url"] = "front.php?city=". $_GET["city"];
	if (isset($_GET["campus"]))
		$tmpCategoryArray["url"] .= "&campus=". $_GET["campus"];
	$tmpCategoryArray["url"] .= "&type=". $category["name"];

	if (isset($_GET["type"])) {
		if ($_GET["type"] == $category["name"])
			$categoryLinkActive = "categoryActive";
		else
			$categoryLinkActive = "categoryInactive";
	} else
		$categoryLinkActive = "categoryActive";

	$tmpCategoryArray["url"] = $header->ahref($tmpCategoryArray["url"], $category["description"], "class=". $categoryLinkActive);

	array_push($adCategory, $tmpCategoryArray);
}

$adNewAdURL = "ad_new.php?city=". $_GET["city"];
if (isset($_GET["campus"]))
	$adNewAdURL .= "&campus=". $_GET["campus"];
if (isset($_GET["type"]))
	$adNewAdURL .= "&type=". $_GET["type"];

$adNewAdURL = $header->ahref($adNewAdURL, "Lägg upp annons");

/**
 * Code for breadcrumbs
 * NOT very pretty but it gets the work done
 */
$breadCampus = "";
$breadCategory = "";
$breadAdTitle = "";
if (isset($_GET["aid"])) {
	$ad = $dbh->getAdFromID($_GET["aid"]);
	$aidAdCategory = $dbh->getAdCategoryFromID($ad["fk_ad_adCategory"]);
	$aidAdCampus = $dbh->getCampusFromID($ad["fk_ad_campus"]);

	if ($aidAdCampus["id"] == 999) {
		$breadCampus = "<li>". $header->ahref("front.php?city=". $city["short_name"], $aidAdCampus["campus_name"]) ."</li>";
	} else {
		$breadCampus = "<li>". $header->ahref("front.php?&city=". $city["short_name"] ."&campus=". replaceSwedishLetters(replaceSpecialChars(strtolower($aidAdCampus["campus_name"]))), $aidAdCampus["campus_name"]) ."</li>";
	}

	$breadCategory = "<li>". $header->ahref("front.php?&city=". $city["short_name"] ."&type=". $aidAdCategory["name"], $aidAdCategory["description"]) ."</li>";

	$breadAdTitle = "<li>". $header->ahref("#", $ad["title"]) ."</li>";
} else {
	if (isset($_GET["campus"])) {
		foreach ($campuses as $value) {
			if (replaceSwedishLetters(replaceSpecialChars(strtolower($value))) == $_GET["campus"]) {
				$breadCampus = "<li>". $header->ahref("front.php?&city=". $city["short_name"] ."&campus=". $_GET["campus"], $value) ."</li>";
			}
		}
	}

	if (isset($_GET["type"])) {
		$aidAdCategory = $dbh->getAdCategoryFromName($_GET["type"]);

		$breadCategoryURL = "front.php?city=". $_GET["city"];
		if (isset($_GET["campus"]))
			$breadCategoryURL .= "&campus=". $_GET["campus"];
		$breadCategoryURL .= "&type=". $_GET["type"];

		$breadCategory = "<li>". $header->ahref($breadCategoryURL, $aidAdCategory["description"]) ."</li>";
	}
}

$header->city 					= $city;
$header->title 					= $title;
$header->campusURLs 			= $campusURLs;
$header->citiesInformation 		= $citiesInformation;
$header->adCategory 			= $adCategory;
$header->adNewAdURL 			= $adNewAdURL;

$header->breadCampus 			= $breadCampus;
$header->breadCategory 			= $breadCategory;
$header->breadAdTitle 			= $breadAdTitle;

$header->display("header.tpl");
?>