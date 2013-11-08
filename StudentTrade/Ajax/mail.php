<?php
// error_reporting(-1);
// ini_set('display_errors', 1);
if (isset($_POST["mail"])) {
	require_once("../Includes/Functions.php");
	require_once("../Class/Email.php");

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
	} elseif ($_POST["mail"] == "contactUs") {
		$checkInput = checkRequiredInput($_POST, array("name", "from_email", "message"));
		print_r($checkInput);
		if ($checkInput == 0) {
			$sendEmail = new Email("kontakt@studenttrade.se");
			if ($sendEmail->sendContactEmail($_POST["name"], $_POST["from_email"], nl2br($_POST["message"]))) {
				// $city = (isset($_GET["city"]) ? $_GET["city"] : "");
				// header("Location: front.php?page=latest". $city);
				echo "Tackar för din e-post. Vi på StudentTrade.se tittar på det så snabbt som möjligt!";
			} else {
				echo "Could not send the e-mail!";
			}
			$sendEmail = null;
		} else {
			echo "Du har inte fyllt i alla obligatoriska fält";
		}
	}
}
?>