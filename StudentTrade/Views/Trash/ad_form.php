<?php
if (isset($_GET["check"])) {
	$checkInput = checkRequiredInput($_POST, array("name", "from_email", "message"));

	if ($checkInput == 0) {
		$dbh = new DbSelect();
		$ad = $dbh->getAdFromID($_GET["aid"]);
		$adUserInfo = $dbh->getAdUserInfoFromAdUserInfoID($ad["fk_ad_adUserInfo"]);
		$dbh = null;

		$sendEmail = new Email($adUserInfo["email"]);
		if ($sendEmail->sendAdEmail($_POST["name"], $_POST["from_email"], nl2br($_POST["message"]))) {
			header("Location: front.php?page=ad_show&city=". $_GET["city"] ."&aid=". $_GET["aid"]);
		} else {
			echo "Could not send the e-mail!";
		}
		$sendEmail = null;
	} else {
		echo "Du har inte fyllt i alla obligatoriska fält";
	}
} elseif (isset($_GET["report"])) {
	$checkInput = checkRequiredInput($_POST, array("message"));

	if ($checkInput == 0) {
		$sendEmail = new Email("ad_report@studenttrade.se");
		if ($sendEmail->sendReportAdEmail(nl2br($_POST["message"]))) {
			header("Location: front.php?page=ad_show&city=". $_GET["city"] ."&aid=". $_GET["aid"]);
		} else {
			echo "Could not send the e-mail!";
		}
		$sendEmail = null;
	} else {
		echo "Du har inte fyllt i alla obligatoriska fält";
	}
}
?>