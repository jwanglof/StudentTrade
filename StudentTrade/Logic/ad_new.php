<?php
$config = array(
	'template_path' => array('../Templates/')
);

$adNew = new Savant3($config);
$dbh = new DbSelect();

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

$dbh = null;

$adNew->cities = $cities;
$adNew->adTypes = $adTypes;
$adNew->adCategories = $adCategories;

$adNew->display("ad_new.tpl");
?>