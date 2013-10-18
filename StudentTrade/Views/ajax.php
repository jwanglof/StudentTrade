<?php
// error_reporting(-1);
// ini_set('display_errors', 1);

if (!isset($_GET["page"])) {
	require("../Db/DbConfig.php");
	require("../Db/DbSelect.php");
	require("../Db/DbUpdate.php");
	require("../Class/Cipher.php");
	require("../Db/functions.php");
}

print_r($_COOKIE);
print_r(session_id());
if ($_SESSION["sessProtector"] == session_id()) {
	if (isset($_POST["get"])) {
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
		} 

		else if ($_POST["get"] == "adTypeInfo") {
			$adType = $dbh->getAdSubCategoryFromAdCategoryID($_POST["adType"]);
			echo json_encode($adType);
		}

		else {
			echo false;
		}

		$dbh = null;
	}

	else if (isset($_POST["check"])) {
		print_r($_POST);
	}

	else if (isset($_POST["remove"])) {
		if ($_POST["remove"] == "ad") {
			$dbh = new DbSelect();
			$ad = $dbh->getAdFromID($_POST["aid"]);
			$dbh = null;

			$cipher = new Cipher("JFKs3ef03J");
			if ($ad["password"] == $cipher->encrypt($_POST["removeCode"])) {
				$dbUpdate = new DbUpdate();
				// $dbUpdate->updateAdActiveWithAdID($_POST["aid"]);

				if ($dbUpdate->updateAdActiveWithAdID($_POST["aid"]) > 0) 
					echo true;
				else
					echo false;
				$dbUpdate = null;
			}
			else
				echo false;
			$cipher = null;
			// 9ksKmPvSjz
		}
	}
}
?>