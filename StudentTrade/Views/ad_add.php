<div style="color: #000;">
<?php

// SET FOREIGN_KEY_CHECKS=0;TRUNCATE adUserInfo;SET FOREIGN_KEY_CHECKS=1;
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
	print_r($_POST);
	echo "<br />";

	$checkInput = checkRequiredInput($_POST, array("name", "email", "city", "adType", "info", "price", "title"));
	if ($checkInput == 0) {
		/*
		 * Check the input values so it doesn't contain any illegal characters
		 */
		foreach ($_POST as $key => $value) {
			$_POST[$key] = checkPOSTInput($_POST[$key]);
		}

		$dbInsert = new DbInsert();
		$adUserInfoID = $dbInsert->insertIntoAdUserInfo($_POST["name"], $_POST["email"], $_POST["phonenumber"]);
		echo $adUserInfoID;
		// $title, $info, $price, $fk_adType, $fk_campus, $fk_city, $fk_adUserInfo
		$adID = $dbInsert->insertIntoAd($_POST["title"], $_POST["info"], $_POST["price"], $_POST["adType"], $_POST["campus"], $_POST["city"], $adUserInfoID);
		echo $adID;

		$adTypeInfoShortNames = array();
		$dbh = new DbSelect();
		foreach($dbh->getAdTypeInfoShortNames() as $val) {
			foreach ($val as $key => $value) {
				array_push($adTypeInfoShortNames, $value);
			}
		}

		foreach ($adTypeInfoShortNames as $value) {
			if (isset($_POST[$value])) {
				$adTypeInfoID = $dbh->getAdTypeInfoIDFromAdTypeInfoName($value);
				$adTypeInfoID = $adTypeInfoID["id"];

				$dbInsert->insertIntoAdInfo($_POST[$value], $adTypeInfoID, $adID);
			}
		}
		$dbh = null;
	} else {
		foreach ($checkInput as $value) {
			echo $value;
		}
	}
}

?>
</div>