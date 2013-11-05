<?php
if (isset($_GET["req"])) {
	if ($_GET["req"] == "campus") {
		$checkInput = checkRequiredInput($_POST, array("campus_name", "city_name"));
		if ($checkInput == 0) {
			$sendEmail = new Email("request@studenttrade.se");
			if ($sendEmail->sendRequestEmail($_POST["campus_name"], $_POST["city_name"])) {
				header("Location: front.php?page=latest");
			} else {
				echo "Could not send the e-mail!";
			}
			$sendEmail = null;
		}
	} elseif ($_GET["req"] == "city") {
		
	}
}
?>