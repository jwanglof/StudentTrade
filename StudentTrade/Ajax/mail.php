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

	if ($_POST["mail"] == "requestCampus") {
		$checkInput = checkRequiredInput($_POST, array("campus_name", "city_name"));
		if ($checkInput == 0) {
			//$sendEmail = new Email("request@studenttrade.se");
			$sendEmail->setRecipientEmail("request@studenttrade.se");
			if ($sendEmail->sendRequestEmail($_POST["campus_name"], $_POST["city_name"])) {
				echo true;
			} else {
				echo false;
			}
			//$sendEmail = null;
		}
	}

	else if ($_POST["mail"] == "requestCity") {
		$checkInput = checkRequiredInput($_POST, array("city_name"));
		if ($checkInput == 0) {
			//$sendEmail = new Email("request@studenttrade.se");
			$sendEmail->setRecipientEmail("request@studenttrade.se");
			if ($sendEmail->sendRequestEmail("Inget, vill lägga till stad", $_POST["city_name"])) {
				echo true;
			} else {
				echo false;
			}
			//$sendEmail = null;
		}
	}

	else if ($_POST["mail"] == "forgotCode") {
		//$dbh = new DbSelect();
		$ad = $dbh->getAdFromID($_POST["aid"]);
		$adUserInfo = $dbh->getAdUserInfoFromAdUserInfoID($ad["fk_ad_adUserInfo"]);

		$cipher = new Cipher("JFKs3ef03J");
		$password = $cipher->decrypt($ad["password"]);
		$cipher = null;

		$sendEmail = new Email($adUserInfo["email"]);

		echo $sendEmail->resendCode($_POST["aid"], $password);
		// if ($sendEmail->resendCode($_POST["aid"], $password)) 
		// 	echo true;
		// else
		// 	echo false;
		//$sendEmail = null;
		//$dbh = null;
	}

	else if ($_POST["mail"] == "adReply") {
		$checkInput = checkRequiredInput($_POST, array("name", "from_email", "message"));

		if ($checkInput == 0) {
			//$dbh = new DbSelect();
			$ad = $dbh->getAdFromID($_POST["aid"]);
			$adUserInfo = $dbh->getAdUserInfoFromAdUserInfoID($ad["fk_ad_adUserInfo"]);
			//$dbh = null;

			$sendEmail = new Email($adUserInfo["email"]);

			echo $sendEmail->sendAdEmail($_POST["name"], $_POST["from_email"], nl2br($_POST["message"]));

			//$sendEmail = null;
		} else {
			echo 2;
		}
	}

	else if ($_POST["mail"] == "adReport") {
		$checkInput = checkRequiredInput($_POST, array("message"));

		if ($checkInput == 0) {
			//$sendEmail = new Email("ad_report@studenttrade.se");
			$sendEmail->setRecipientEmail("abuse@studenttrade.se");

			echo $sendEmail->sendReportAdEmail($_POST["aid"], nl2br($_POST["message"]));
			
			//$sendEmail = null;
		} else {
			echo 2;
		}
	}

	else if ($_POST["mail"] == "contactUs") {
		$checkInput = checkRequiredInput($_POST, array("name", "from_email", "message"));

		if ($checkInput == 0) {
			//$sendEmail = new Email("kontakt@studenttrade.se");
			$sendEmail->setRecipientEmail("kontakt@studenttrade.se");

			echo $sendEmail->sendContactEmail($_POST["name"], $_POST["from_email"], nl2br($_POST["message"]));
			// if ($sendEmail->sendContactEmail($_POST["name"], $_POST["from_email"], nl2br($_POST["message"]))) {
			// 	// $city = (isset($_GET["city"]) ? $_GET["city"] : "");
			// 	// header("Location: front.php?page=latest". $city);
			// 	echo "Tackar för din e-post. Vi på StudentTrade.se tittar på det så snabbt som möjligt!";
			// } else {
			// 	echo "Could not send the e-mail!";
			// }
			//$sendEmail = null;
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
			//$dbh = new DbSelect();
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
			//$dbh = null;
			$dbInsert = null;

			// $sendEmail = new Email($_POST["email"]);
			$sendEmail->setRecipientEmail($_POST["email"]);
			$sendEmail->sendNewAdEmail($password, $adID);
			// $sendEmail = null;

			echo $adID;
		} else {
			echo 2;
		}
	}

	$dbh = null;
	$sendEmail = null;
}
?>