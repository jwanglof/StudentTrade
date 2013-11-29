<?php
error_reporting(-1);
ini_set('display_errors', 1);

require_once("autoload_classes.php");
require_once("../Includes/Functions.php");

$config = array(
	'template_path' => array('../Templates/')
);

$tpl = new Savant3($config);
$dbh = new DbSelect();

$city = (isset($_GET["city"]) ? $dbh->getCity($_GET["city"]) : $dbh->getCity("linkoping"));

$title = "Senaste annonserna från ". $city["city_name"];

// Need this because there might be more than one school in $city["id"]
// E.g. Stockholm has KTH and Stockholms University
// 
// Replace generateCampusURL with code instead?
$universities = $dbh->getUniversitiesFromCityID($city["id"]);
$campuses = array();
foreach ($universities as $uni) {
	foreach ($dbh->getCampusFromUniversityID($uni["id"]) as $campus) {
		// $chosenCampus = ()) ? True : False);
		if (isset($_GET["campus"]) && compareString($_GET["campus"], $campus["campus_name"])) {
			array_push($campuses, generateCampusURL($city["short_name"], $campus["campus_name"], (isset($_GET["type"]) ? $_GET["type"] : NULL), False));
		} else {
			array_push($campuses, generateCampusURL($city["short_name"], $campus["campus_name"], (isset($_GET["type"]) ? $_GET["type"] : NULL)));
		}
	}
}

$cities = $dbh->getCityIDs();
$citiesInformation = array();
foreach ($cities as $cityInfo) {
	$short_name = replaceSwedishLetters(strtolower($cityInfo["short_name"]));
	array_push($citiesInformation, $tpl->ahref("front.php?page=latest&city=". $short_name, $cityInfo["city_name"]));
}

$adCategories = $dbh->getAdCategories();
$adCategory = array();
foreach ($adCategories as $category) {
	$tmpCategoryArray = array();
	$tmpCategoryArray["background-color"] = $category["color"];
	$tmpCategoryArray["url"] = generateAdURL("latest", $city["short_name"],
			$category["description"], (isset($_GET["campus"]) ? $_GET["campus"] : NULL),
			$category["name"],
			(isset($_GET["type"]) && $_GET["type"] == $category["name"]));

	array_push($adCategory, $tmpCategoryArray);
}

$adNewAdURL = generateAdURL("ad_new", $city["short_name"], "Lägg upp annons", (isset($_GET["campus"]) ? $_GET["campus"] : NULL), (isset($_GET["type"]) ? $_GET["type"] : NULL), True);

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
		$breadCampus = "<li>". $tpl->ahref("front.php?page=latest&city=". $city["short_name"], $aidAdCampus["campus_name"]) ."</li>";
	} else {
		$breadCampus = "<li>". $tpl->ahref("front.php?page=latest&city=". $city["short_name"] ."&campus=". replaceSwedishLetters(replaceSpecialChars(strtolower($aidAdCampus["campus_name"]))), $aidAdCampus["campus_name"]) ."</li>";
	}

	$breadCategory = "<li>". $tpl->ahref("front.php?page=latest&city=". $city["short_name"] ."&type=". $aidAdCategory["name"], $aidAdCategory["description"]) ."</li>";

	$breadAdTitle = "<li>". $tpl->ahref("#", $ad["title"]) ."</li>";
} else {
	if (isset($_GET["campus"])) {
		foreach ($campuses as $key => $value) {
			if (replaceSwedishLetters(replaceSpecialChars(strtolower($value["campus_name"]))) == $_GET["campus"])
				$breadCampus = "<li>". $tpl->ahref("front.php?page=latest&city=". $city["short_name"] ."&campus=". $_GET["campus"], $value["campus_name"]) ."</li>";
		}
	}

	if (isset($_GET["type"])) {
		$aidAdCategory = $dbh->getAdCategoryFromName($_GET["type"]);
		$breadCategory = "<li>". generateAdURL("latest", $city["short_name"],
				$aidAdCategory["description"],
				(isset($_GET["campus"]) ? $_GET["campus"] : NULL),
				$_GET["type"], True) ."</li>";
	}
}

// $switchFile = "../Includes/Switch.php";

if (isset($_GET["page"])) {
	switch ($_GET["page"]) {
		case "latest":
			$showPage = "latest.php";
			break;
		case "ad_show":
			$showPage = "ad_show.php";
			break;
		case "ad_new":
			$showPage = "ad_new.php";
			break;
		
		default:
			$showPage = "error.php";
			break;
	}
}

$tpl->city 				= $city;
$tpl->title 			= $title;
$tpl->campuses 			= $campuses;
$tpl->citiesInformation = $citiesInformation;
$tpl->adCategory 		= $adCategory;
$tpl->adNewAdURL 		= $adNewAdURL;

$tpl->breadCampus 		= $breadCampus;
$tpl->breadCategory 	= $breadCategory;
$tpl->breadAdTitle 		= $breadAdTitle;


$tpl->header 			= $tpl->fetch("header.tpl");
$tpl->footer 			= $tpl->fetch("footer.tpl");
// $tpl->switchFile		= $tpl->fetch("../Includes/Switch.php");

$tpl->showPage 			= $tpl->fetch($showPage);

$tpl->display("front.tpl");

$dbh = null;
$tpl = null;
?>