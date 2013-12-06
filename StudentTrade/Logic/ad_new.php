<?php
error_reporting(-1);
ini_set('display_errors', 1);

require_once("autoload_classes.php");
require_once("../Includes/Functions.php");

$config = array(
	'template_path' => array('../Templates/')
);

$adNew = new Savant3($config);
$dbh = new DbSelect();
$title = "Lägg upp annons";

$cities = array();
foreach ($dbh->getCityIDs() as $city) {
	$selected = "";

	if (isset($_GET["city"])) {
		if ($_GET["city"] == $city["short_name"])
			$selected = "selected";
	}

	array_push($cities, "<option value=\"". $city["id"] ."\" $selected>". $city["city_name"] ."</option>");
}

$adTypes = array();
foreach ($dbh->getAdTypes() as $type) {
	array_push($adTypes, "<option value=\"". $type["id"] ."\">". $type["name"] ."</option>");
}

$adCategories = array();
foreach ($dbh->getAdCategories() as $category) {
	$selected = "";
	if (isset($_GET["type"])) {
		if ($_GET["type"] == $category["name"])
			$selected = "selected";
	}

	array_push($adCategories, "<option value=\"". $category["id"] ."\" $selected>". $category["description"] ."</option>");
}

$title = "Lägg upp annons";

$adNew->cities 				= $cities;
$adNew->adTypes 			= $adTypes;
$adNew->adCategories 		= $adCategories;

$adNew->header 				= include 'header.php';
$adNew->footer 				= $adNew->fetch("footer.tpl");
$adNew->rightColumn 		= $adNew->fetch("right.tpl");
// $adNew->title 			= $title;

$adNew->display("ad_new.tpl");
?>