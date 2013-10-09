<?php
// error_reporting(-1);
// ini_set('display_errors', 1);
if ($_SESSION["sessProtector"] == session_id()) {
	require("../Db/DbConfig.php");
	require("../Db/DbSelect.php");
	$dbh = new DbSelect();

	// $universities = $dbh->getUniversitiesFromCityID(2);
	// $campuses = [];
	// foreach ($universities as $key) {
	// 	// $campuses[$key["id"]] = $key["university_name"];
	// 	$campus = $dbh->getCampusFromUniversityID($key["id"]);
	// 	foreach ($campus as $value) {
	// 		$campuses[$value["id"]] = $value["campus_name"];
	// 	}
	// }
	// // print_r($campuses);
	// echo json_encode($campuses);

	if (isset($_POST["get"])) {
		if ($_POST["get"] == "campuses") {
			$universities = $dbh->getUniversitiesFromCityID($_POST["cityID"]);
			$campuses = [];
			foreach ($universities as $key) {
				// $campuses[$key["id"]] = $key["university_name"];
				$campus = $dbh->getCampusFromUniversityID($key["id"]);
				foreach ($campus as $value) {
					$campuses[$value["id"]] = $value["campus_name"];
				}
			}
			echo json_encode($campuses);
		} else {
			return false;
		}
	}
}
?>