<?php
// SET FOREIGN_KEY_CHECKS=0;TRUNCATE adUserInfo;TRUNCATE ad;TRUNCATE adInfo;SET FOREIGN_KEY_CHECKS=1;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$success = True;

	$checkInput = checkRequiredInput($_POST, array("name", "email", "city", "adType", "title", "info", "adCategory"));
	if ($checkInput == 0) {
		/*
		 * Check the input values so it doesn't contain any illegal characters
		 */
		foreach ($_POST as $key => $value) {
			$_POST[$key] = checkPOSTInput($_POST[$key]);
		}
		$dbInsert = new DbInsert();

		$password = generateRandomString(4);
		$cipher = new Cipher("JFKs3ef03J");
		$encryptedPassword = $cipher->encrypt($password);

		$adID = $dbInsert->insertIntoAd($_POST["title"], nl2br($_POST["info"]), $encryptedPassword, $_POST["price"], 
			date("Y-m-d H:i:s"), $_POST["adCategory"], $_POST["campus"], $_POST["city"], $_POST["adType"]);
		$adUserInfoID = $dbInsert->insertIntoAdUserInfo($_POST["name"], $_POST["email"], $_POST["phonenumber"], $adID);

		/*
		 * Insert the adInfo
		 * Loop through all ad types, 
		 * and then check if the type is present in $_POST,
		 * and then add it to the DB
		 */
		$dbh = new DbSelect();
		foreach($dbh->getAdSubCategoryShortNames() as $val) {
			foreach ($val as $value) {
				// array_push($adTypeInfoShortNames, $value);
				if (!empty($_POST[$value]) ) {
					// echo "<br />";
					// echo $value ." ---- ". $_POST[$value];
					// echo "<br />";
					$adTypeInfoID = $dbh->getAdSubCategoryIDFromAdSubCategoryName($value);
					$adTypeInfoID = $adTypeInfoID["id"];
					// echo $adTypeInfoID;
					$dbInsert->insertIntoAdInfo($_POST[$value], $adTypeInfoID, $adID);
				}
			}
		}

		$cityShortName = $dbh->getCityFromID($_POST["city"]);
		$cipher = null;
		$dbh = null;
		$dbInsert = null;
	} else {
		// foreach ($checkInput as $value) {
		echo "Kunde ej lägga till din annons. Var vänlig försök igen!";
		// }
		return false;
	}

	// $success is never used
	if ($success) {
		$sendEmail = new Email($_POST["email"]);
		$sendEmail->sendNewAdEmail($password, $adID);
		$sendEmail = null;

		header("Location: front.php?page=ad_show&city=". $cityShortName["short_name"] ."&aid=". $adID);
	}
}
?>