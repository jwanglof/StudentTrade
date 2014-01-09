<?php
class Ajax extends DbSelect {
	public function __construct() {
		parent::__construct();
	}

	public function __destruct() {}

	public function get($postValues) {
		if ($postValues["get"] == "campuses") {
			$universities = parent::getUniversitiesFromCityID($postValues["cityID"]);
			$campuses = array();
			foreach ($universities as $key) {
				$campus = parent::getCampusFromUniversityID($key["id"]);
				foreach ($campus as $value) {
					$campuses[$value["id"]] = $value["campus_name"];
				}
			}
			return json_encode($campuses);
		} else if ($postValues["get"] == "adTypeInfo") {
			$adType = parent::getAdSubCategoryFromAdCategoryID($postValues["adType"]);
			return json_encode($adType);
	 	} else if ($postValues["get"] == "search") {
	 		$searchResult = parent::searchAdsWithName($postValues["search"]);
	 		return json_encode($searchResult);
	 	} else {
	 		return false;
	 	}
	}

	public function mail($postValues) {
		if ($postValues["mail"] == "requestCampus") {
			$checkInput = checkRequiredInput($_POST, array("campus_name", "city_name"));
			if ($checkInput == 0) {
				$sendEmail->setRecipientEmail("request@studenttrade.se");
				echo $sendEmail->sendRequestEmail($_POST["campus_name"], $_POST["city_name"]);
			}
		} else if ($postValues["mail"] == "requestCity") {
			$checkInput = checkRequiredInput($_POST, array("city_name"));
			if ($checkInput == 0) {
				$sendEmail->setRecipientEmail("request@studenttrade.se");
				echo $sendEmail->sendRequestEmail("Inget, vill lägga till stad", $_POST["city_name"]);
			}
		} else if ($postValues["mail"] == "forgotCode") {
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

		} else if ($postValues["mail"] == "adReply") {
			$checkInput = checkRequiredInput($_POST, array("name", "from_email", "message"));

			if ($checkInput == 0) {
				$ad = $dbh->getAdFromID($_POST["aid"]);
				$adUserInfo = $dbh->getAdUserInfoFromAdUserInfoID($_POST["aid"]);

				$sendEmail->setRecipientEmail($adUserInfo["email"]);

				echo $sendEmail->sendAdEmail($_POST["name"], $_POST["from_email"], nl2br($_POST["message"]), $_POST["aid"], $ad["title"], $_POST["city"]);
			} else {
				echo 2;
			}
		} else if ($postValues["mail"] == "adReport") {
			$checkInput = checkRequiredInput($_POST, array("message"));

			if ($checkInput == 0) {
				$sendEmail->setRecipientEmail("abuse@studenttrade.se");

				echo $sendEmail->sendReportAdEmail($_POST["aid"], nl2br($_POST["message"]));
			} else {
				echo 2;
			}
		} else if ($postValues["mail"] == "contactUs") {
			$checkInput = checkRequiredInput($_POST, array("name", "from_email", "message"));

			if ($checkInput == 0) {
				$sendEmail->setRecipientEmail("kontakt@studenttrade.se");

				echo $sendEmail->sendContactEmail($_POST["name"], $_POST["from_email"], nl2br($_POST["message"]));
			} else {
				echo 2;
			}
		} else if ($postValues["mail"] == "adAddNew") {
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

				// Add the pictures if there are any
				if (!empty($_SESSION["newPictures"])) {
					foreach ($_SESSION["newPictures"] as $filename) {
						$dbInsert->insertIntoPictures($filename, $adID);
					}
					// Reset the array
					$_SESSION["newPictures"] = array();
				}

				$cityShortName = $dbh->getCityFromID($_SESSION["newAd"]["city"]);
				$dbInsert = null;

				$city = $dbh->getCityFromID($_SESSION["newAd"]["city"]);

				// $sendEmail->setRecipientEmail($_SESSION["newAd"]["email"]);
				// $sendEmail->sendNewAdEmail($password, $adID, $_SESSION["newAd"]["adType"], $city["short_name"]);

				echo $adID;
			} else {
				echo -1;
			}
		} else {
			return false;
		}
	}
}
?>