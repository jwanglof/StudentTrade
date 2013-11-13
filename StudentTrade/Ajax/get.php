<?php
session_start();

if (isset($_POST["get"]) && $_SESSION["sessProtector"] == $_COOKIE["PHPSESSID"]) {
	require("../Db/DbConfig.php");
	require("../Db/DbSelect.php");

	$dbh = new DbSelect();

	if ($_POST["get"] == "campuses") {
		$universities = $dbh->getUniversitiesFromCityID($_POST["cityID"]);
		$campuses = array();
		foreach ($universities as $key) {
			$campus = $dbh->getCampusFromUniversityID($key["id"]);
			foreach ($campus as $value) {
				$campuses[$value["id"]] = $value["campus_name"];
			}
		}
		echo json_encode($campuses);
	} else if ($_POST["get"] == "adTypeInfo") {
		$adType = $dbh->getAdSubCategoryFromAdCategoryID($_POST["adType"]);
		echo json_encode($adType);
 	} else if ($_POST["get"] == "search") {
 		$searchResult = $dbh->searchAdsWithName($_POST["search"]);
 		echo json_encode($searchResult);
 	} else if ($_POST["get"] == "forgotCode") {
 		$ad = $dbh->getAdFromID($_POST["aid"]);

 		$cipher = new Cipher("JFKs3ef03J");
		$password = $cipher->decrypt($ad["password"]);
		$cipher = null;

		$sendEmail = new Email($_POST["email"]);
		if ($sendEmail->resendCode($ad["id"], $password))
			echo true;
		else
			echo false;
		$sendEmail = null;
 	}

	$dbh = null;
} else {
	echo false;
}
?>