<?php
require_once("Email.php");
require_once("Cipher.php");
require_once("Db/DbConfig.php");
require_once("Db/DbUpdate.php");
require_once("Db/DbSelect.php");

class Ajax {
	private $dbSelect;

	public function __construct() {
		$this->dbSelect = new DbSelect();
	}

	public function __destruct() {}

	public function get($postValues) {
		if ($postValues["get"] == "campuses") {
			$universities = $this->dbSelect->getUniversitiesFromCityID($postValues["cityID"]);
			$campuses = array();
			foreach ($universities as $key) {
				$campus = $this->dbSelect->getCampusFromUniversityID($key["id"]);
				foreach ($campus as $value) {
					$campuses[$value["id"]] = $value["campus_name"];
				}
			}
			return json_encode($campuses);
		} else if ($postValues["get"] == "adTypeInfo") {
			$adType = $this->dbSelect->getAdSubCategoryFromAdCategoryID($postValues["adType"]);
			return json_encode($adType);
	 	} else if ($postValues["get"] == "search") {
	 		$searchResult = $this->dbSelect->searchAdsWithName($postValues["search"]);
	 		return json_encode($searchResult);
	 	} else {
	 		return false;
	 	}
	}

	public function mail($postValues) {
		// $handler->debug($postValues, 'postValues');
		// $handler = PhpConsole\Handler::getInstance();
		// $handler->start();

		$sendEmail = new Email();
		$cipher = new Cipher("JFKs3ef03J");

		if ($postValues["mail"] == "requestCampus") {
			$checkInput = checkRequiredInput($postValues, array("campus_name", "city_name"));
			if ($checkInput == 0) {
				$sendEmail->setRecipientEmail("request@studenttrade.se");
				return $sendEmail->sendRequestEmail($postValues["campus_name"], $postValues["city_name"]);
			}
		} else if ($postValues["mail"] == "requestCity") {
			$checkInput = checkRequiredInput($postValues, array("city_name"));
			if ($checkInput == 0) {
				$sendEmail->setRecipientEmail("request@studenttrade.se");
				return $sendEmail->sendRequestEmail("Inget, vill lägga till stad", $postValues["city_name"]);
			}
		} else if ($postValues["mail"] == "forgotCode") {
			$ad = $this->dbSelect->getAdFromID($postValues["aid"]);

			// Allow the code to only be sent one time per hour
			if (date("H:i:s", strtotime($ad["request_code"] ."+1 hour")) <= date("H:i:s")) {
				$adUserInfo = $this->dbSelect->getAdUserInfoFromAdUserInfoID($postValues["aid"]);

				$dbUpdate = new DbUpdate();
				$dbUpdate->updateAdRequestCodeTime($postValues["aid"], date("Y-m-d H:i:s", strtotime("+1 hour")));
				$dbUpdate = null;

				$password = $cipher->decrypt($ad["password"]);

				$sendEmail->setRecipientEmail($adUserInfo["email"]);

				return $sendEmail->resendCode($postValues["aid"], $password, $postValues["city"]);
			} else {
				return 2;
			}
		} else if ($postValues["mail"] == "adReply") {
			$checkInput = checkRequiredInput($postValues, array("name", "from_email", "message"));
			
			if ($checkInput == 0) {
				// $handler->debug($postValues["from_email"], 'adReply');
				$ad = $this->dbSelect->getAdFromID($postValues["aid"]);
				$adUserInfo = $this->dbSelect->getAdUserInfoFromAdUserInfoID($postValues["aid"]);

				$sendEmail->setRecipientEmail($adUserInfo["email"]);

				return $sendEmail->sendAdEmail($postValues["name"], $postValues["from_email"], nl2br($postValues["message"]), $postValues["aid"], $ad["title"], $postValues["city"]);
			} else {
				return 2;
			}
		} else if ($postValues["mail"] == "adReport") {
			$checkInput = checkRequiredInput($postValues, array("message"));

			if ($checkInput == 0) {
				$sendEmail->setRecipientEmail("abuse@studenttrade.se");

				return $sendEmail->sendReportAdEmail($postValues["aid"], nl2br($postValues["message"]));
			} else {
				return 2;
			}
		} else if ($postValues["mail"] == "contactUs") {
			$checkInput = checkRequiredInput($postValues, array("name", "from_email", "message"));

			if ($checkInput == 0) {
				$sendEmail->setRecipientEmail("kontakt@studenttrade.se");

				return $sendEmail->sendContactEmail($postValues["name"], $postValues["from_email"], nl2br($postValues["message"]));
			} else {
				return 2;
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
				foreach($this->dbSelect->getAdSubCategoryShortNames() as $val) {
					foreach ($val as $value) {
						if (!empty($_SESSION["newAd"][$value]) ) {
							$adTypeInfoID = $this->dbSelect->getAdSubCategoryIDFromAdSubCategoryName($value);
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

				$cityShortName = $this->dbSelect->getCityFromID($_SESSION["newAd"]["city"]);

				$city = $this->dbSelect->getCityFromID($_SESSION["newAd"]["city"]);

				$sendEmail->setRecipientEmail($_SESSION["newAd"]["email"]);
				$sendEmail->sendNewAdEmail($password, $adID, $_SESSION["newAd"]["adType"], $city["short_name"]);

				return $adID;
			} else {
				return -1;
			}
		} else {
			return false;
		}
	}

	public function update($postValues) {
		$dbUpdate = new DbUpdate();
		$cipher = new Cipher("JFKs3ef03J");

		if ($postValues["update"] == "adActive") {
			$ad = $this->dbSelect->getAdFromID($postValues["aid"]);
		
			if ($ad["password"] == $cipher->encrypt($postValues["removeCode"])) {
				if ($dbUpdate->updateAdActiveWithAdID($postValues["aid"]) > 0) 
					return true;
				else
					return false;
			}
			else {
				return false;
			}
		}
		else {
			return false;
		}
	}
}
?>