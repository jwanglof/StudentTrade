<div style="color: #000;">
<?php

// SET FOREIGN_KEY_CHECKS=0;TRUNCATE adUserInfo;TRUNCATE ad;TRUNCATE adInfo;SET FOREIGN_KEY_CHECKS=1;
// print_r($requiredInputs);
// print_r($adTypeInfoShortNames);
// print_r($_POST);


function checkPOSTInput($input) {
	$input = trim($input);
	$input = stripslashes($input);
	$input = htmlspecialchars($input);
	return $input;
}

/*
 * Returns how many input-fields are left in $requiredInputs after
 * deleting the required ones
 * If it returns 0 it means that the user has typed in all
 * required fields,
 * else it will return >0
 */
function checkRequiredInput($postData, $requiredInputs) {
	foreach ($postData as $key => $value) {
		$found = array_search($key, $requiredInputs);
		if ($found >= 0) {
			if (!empty($value))
				unset($requiredInputs[$found]);
		}
	}
	return ((count($requiredInputs) == 0) ? 0 : $requiredInputs);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$success = true;
	print_r($_POST);
	$checkInput = checkRequiredInput($_POST, array("name", "email", "city", "adType", "title", "info", "price", "adCategory"));
	if ($checkInput == 0) {
		/*
		 * Check the input values so it doesn't contain any illegal characters
		 */
		foreach ($_POST as $key => $value) {
			$_POST[$key] = checkPOSTInput($_POST[$key]);
		}
		$dbInsert = new DbInsert();
		$adUserInfoID = $dbInsert->insertIntoAdUserInfo($_POST["name"], $_POST["email"], $_POST["phonenumber"]);
		echo 1 . $adUserInfoID . "--- ";

		$password = generateRandomString(4);
		$adID = $dbInsert->insertIntoAd($_POST["title"], nl2br($_POST["info"]), $password, $_POST["price"], 
			date("Y-m-d H:i:s"), date("Y-m-d H:i:s", strtotime("+1 month")), $_POST["adType"], 
			$_POST["campus"], $_POST["city"], $adUserInfoID, $_POST["adType"]);
		echo 2 . $adID;
		/*
		 * Insert the adInfo
		 * Loop through all ad types, 
		 * and then check if the type is present in $_POST,
		 * and then add it to the DB
		 */
		$dbh = new DbSelect();
		foreach($dbh->getAdSubCategoryShortNames() as $val) {
			foreach ($val as $key => $value) {
				// array_push($adTypeInfoShortNames, $value);
				if (isset($_POST[$value])) {
					$adTypeInfoID = $dbh->getAdTypeInfoIDFromAdTypeInfoName($value);
					$adTypeInfoID = $adTypeInfoID["id"];

					$dbInsert->insertIntoAdInfo($_POST[$value], $adTypeInfoID, $adID);
				}
			}
		}
		$cityShortName = $dbh->getCityFromID($_POST["city"]);
		$dbh = null;
		$dbInsert = null;
	} else {
		foreach ($checkInput as $value) {
			echo "Kunde ej lägga till din annons. Var vänlig försök igen!";
		}
		return false;
	}

	if ($success) {
		// $sendEmail = new Email($_POST["email"]);
		// $sendEmail->sendPassword($password);

		header("Location: front.php?page=ad_show&city=". $cityShortName["short_name"] ."&aid=". $adID);
	}
}

?>
</div>