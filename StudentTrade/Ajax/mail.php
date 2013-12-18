<?php
session_start();

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

			echo $sendEmail->sendAdEmail($_POST["name"], $_POST["from_email"], nl2br($_POST["message"]), $_POST["aid"], $ad["title"], $_POST["city"]);
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
		$checkInput = checkRequiredInput($_SESSION["newAd"], array("name", "email", "city", "adType", "title", "info", "adCategory"));
		if ($checkInput == 0) {
			/*
			 * Check the input values so it doesn't contain any illegal characters
			 */
			foreach ($_SESSION["newAd"] as $key => $value) {
				$_SESSION["newAd"][$key] = checkPOSTInput($_SESSION["newAd"][$key]);
			}
			$dbInsert = new DbInsert();

			$password = generateRandomString(4, "0123456789");
			$encryptedPassword = $cipher->encrypt($password);

			$adID = $dbInsert->insertIntoAd($_SESSION["newAd"]["title"], nl2br($_SESSION["newAd"]["info"]), $encryptedPassword, $_SESSION["newAd"]["price"], date("Y-m-d H:i:s"), $_SESSION["newAd"]["adCategory"], $_SESSION["newAd"]["campus"], $_SESSION["newAd"]["city"], $_SESSION["newAd"]["adType"]);
			$adUserInfoID = $dbInsert->insertIntoAdUserInfo($_SESSION["newAd"]["name"], $_SESSION["newAd"]["email"], $_SESSION["newAd"]["phonenumber"], $adID);

			/*
			 * Insert the adInfo
			 * Loop through all ad types, 
			 * and then check if the type is present in $_SESSION["newAd"],
			 * and then add it to the DB
			 */
			foreach($dbh->getAdSubCategoryShortNames() as $val) {
				foreach ($val as $value) {
					if (!empty($_SESSION["newAd"][$value]) ) {
						$adTypeInfoID = $dbh->getAdSubCategoryIDFromAdSubCategoryName($value);
						$adTypeInfoID = $adTypeInfoID["id"];
						$dbInsert->insertIntoAdInfo($_SESSION["newAd"][$value], $adTypeInfoID, $adID);
					}
				}
			}

			$cityShortName = $dbh->getCityFromID($_SESSION["newAd"]["city"]);
			$dbInsert = null;

			$city = $dbh->getCityFromID($_SESSION["newAd"]["city"]);

			// $sendEmail->setRecipientEmail($_SESSION["newAd"]["email"]);
			// $sendEmail->sendNewAdEmail($password, $adID, $_SESSION["newAd"]["adType"], $city["short_name"]);

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