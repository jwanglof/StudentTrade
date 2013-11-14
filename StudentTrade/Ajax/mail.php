<?php
error_reporting(-1);
ini_set('display_errors', 1);
if (isset($_POST["mail"])) {
	require_once("../Includes/Functions.php");
	require_once("../Class/Email.php");
	require_once("../Class/Cipher.php");
	require_once("../Db/DbConfig.php");
	require_once("../Db/DbSelect.php");

	if ($_POST["mail"] == "requestCampus") {
		$checkInput = checkRequiredInput($_POST, array("campus_name", "city_name"));
		if ($checkInput == 0) {
			$sendEmail = new Email("request@studenttrade.se");
			if ($sendEmail->sendRequestEmail($_POST["campus_name"], $_POST["city_name"])) {
				echo true;
			} else {
				echo false;
			}
			$sendEmail = null;
		}
	} elseif ($_POST["mail"] == "requestCity") {
		$checkInput = checkRequiredInput($_POST, array("city_name"));
		if ($checkInput == 0) {
			$sendEmail = new Email("request@studenttrade.se");
			if ($sendEmail->sendRequestEmail("Inget, vill lägga till stad", $_POST["city_name"])) {
				echo true;
			} else {
				echo false;
			}
			$sendEmail = null;
		}
	}

	else if ($_POST["mail"] == "forgotCode") {
		$dbh = new DbSelect();
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
		$sendEmail = null;
		$dbh = null;
	}

	else if ($_POST["mail"] == "adReply") {
		$checkInput = checkRequiredInput($_POST, array("name", "from_email", "message"));

		if ($checkInput == 0) {
			$dbh = new DbSelect();
			$ad = $dbh->getAdFromID($_POST["aid"]);
			$adUserInfo = $dbh->getAdUserInfoFromAdUserInfoID($ad["fk_ad_adUserInfo"]);
			$dbh = null;

			$sendEmail = new Email($adUserInfo["email"]);

			echo $sendEmail->sendAdEmail($_POST["name"], $_POST["from_email"], nl2br($_POST["message"]));

			$sendEmail = null;
		} else {
			echo 2;
		}
	}

	else if ($_POST["mail"] == "adReport") {
		$checkInput = checkRequiredInput($_POST, array("message"));

		if ($checkInput == 0) {
			$sendEmail = new Email("ad_report@studenttrade.se");

			echo $sendEmail->sendReportAdEmail($_POST["aid"], nl2br($_POST["message"]));
			
			$sendEmail = null;
		} else {
			echo 2;
		}
	}

	else if ($_POST["mail"] == "contactUs") {
		$checkInput = checkRequiredInput($_POST, array("name", "from_email", "message"));

		if ($checkInput == 0) {
			$sendEmail = new Email("kontakt@studenttrade.se");

			echo $sendEmail->sendContactEmail($_POST["name"], $_POST["from_email"], nl2br($_POST["message"]));
			// if ($sendEmail->sendContactEmail($_POST["name"], $_POST["from_email"], nl2br($_POST["message"]))) {
			// 	// $city = (isset($_GET["city"]) ? $_GET["city"] : "");
			// 	// header("Location: front.php?page=latest". $city);
			// 	echo "Tackar för din e-post. Vi på StudentTrade.se tittar på det så snabbt som möjligt!";
			// } else {
			// 	echo "Could not send the e-mail!";
			// }
			$sendEmail = null;
		} else {
			echo 2;
		}
	}
}
?>