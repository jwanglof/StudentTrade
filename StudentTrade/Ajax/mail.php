<?php
error_reporting(-1);
ini_set('display_errors', 1);
if (isset($_POST["mail"])) {
	require_once("../Includes/Functions.php");
	require_once("../Class/Email.php");
	require_once("../Class/Cipher.php");
	require_once("../Db/DbConfig.php");
	require_once("../Db/DbSelect.php");
	require_once("../Db/DbInsert.php");

	$sendEmail = new Email();
	$dbh = new DbSelect();
	$cipher = new Cipher("JFKs3ef03J");

	if ($_POST["mail"] == "requestCampus") {
		$checkInput = checkRequiredInput($_POST, array("campus_name", "city_name"));
		if ($checkInput == 0) {
			$sendEmail->setRecipientEmail("request@studenttrade.se");
			echo $sendEmail->sendRequestEmail($_POST["campus_name"], $_POST["city_name"]);
		}
	}

	else if ($_POST["mail"] == "requestCity") {
		$checkInput = checkRequiredInput($_POST, array("city_name"));
		if ($checkInput == 0) {
			$sendEmail->setRecipientEmail("request@studenttrade.se");

			echo $sendEmail->sendRequestEmail("Inget, vill lägga till stad", $_POST["city_name"]);
		}
	}

	else if ($_POST["mail"] == "forgotCode") {
		$ad = $dbh->getAdFromID($_POST["aid"]);

		// Allow the code to only be sent one time per hour
		if (date("H:i:s", strtotime($ad["request_code"] ."+1 hour")) <= date("H:i:s")) {
			$adUserInfo = $dbh->getAdUserInfoFromAdUserInfoID($_POST["aid"]);

			$dbUpdate = new DbUpdate();
			$dbUpdate->updateAdRequestCodeTime($_POST["aid"], date("Y-m-d H:i:s", strtotime("+1 hour")));
			$dbUpdate = null;

			$password = $cipher->decrypt($ad["password"]);

			$sendEmail->setRecipientEmail($adUserInfo["email"]);

			echo $sendEmail->resendCode($_POST["aid"], $password);
		} else {
			echo 2;
		}

	}

	else if ($_POST["mail"] == "adReply") {
		$checkInput = checkRequiredInput($_POST, array("name", "from_email", "message"));

		if ($checkInput == 0) {
			$ad = $dbh->getAdFromID($_POST["aid"]);
			$adUserInfo = $dbh->getAdUserInfoFromAdUserInfoID($_POST["aid"]);

			$sendEmail->setRecipientEmail($adUserInfo["email"]);

			echo $sendEmail->sendAdEmail($_POST["name"], $_POST["from_email"], nl2br($_POST["message"]));
		} else {
			echo 2;
		}
	}

	else if ($_POST["mail"] == "adReport") {
		$checkInput = checkRequiredInput($_POST, array("message"));

		if ($checkInput == 0) {
			$sendEmail->setRecipientEmail("abuse@studenttrade.se");

			echo $sendEmail->sendReportAdEmail($_POST["aid"], nl2br($_POST["message"]));
		} else {
			echo 2;
		}
	}

	else if ($_POST["mail"] == "contactUs") {
		$checkInput = checkRequiredInput($_POST, array("name", "from_email", "message"));

		if ($checkInput == 0) {
			$sendEmail->setRecipientEmail("kontakt@studenttrade.se");

			echo $sendEmail->sendContactEmail($_POST["name"], $_POST["from_email"], nl2br($_POST["message"]));
		} else {
			echo 2;
		}
	}

	else if ($_POST["mail"] == "adAddNew") {
		$checkInput = checkRequiredInput($_POST, array("name", "email", "city", "adType", "title", "info", "adCategory"));
		if ($checkInput == 0) {
			/*
			 * Check the input values so it doesn't contain any illegal characters
			 */
			foreach ($_POST as $key => $value) {
				$_POST[$key] = checkPOSTInput($_POST[$key]);
			}
			$dbInsert = new DbInsert();

			$password = generateRandomString(4, "0123456789");
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
			foreach($dbh->getAdSubCategoryShortNames() as $val) {
				foreach ($val as $value) {
					if (!empty($_POST[$value]) ) {
						$adTypeInfoID = $dbh->getAdSubCategoryIDFromAdSubCategoryName($value);
						$adTypeInfoID = $adTypeInfoID["id"];
						$dbInsert->insertIntoAdInfo($_POST[$value], $adTypeInfoID, $adID);
					}
				}
			}

			$cityShortName = $dbh->getCityFromID($_POST["city"]);
			$dbInsert = null;

			$sendEmail->setRecipientEmail($_POST["email"]);
			$sendEmail->sendNewAdEmail($password, $adID);

			echo $adID;
		} else {
			echo 2;
		}
	}

	$cipher = null;
	$dbh = null;
	$sendEmail = null;
}
?>