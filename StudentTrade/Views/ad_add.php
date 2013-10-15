<div style="color: #000;">
<?php

// SET FOREIGN_KEY_CHECKS=0;TRUNCATE adUserInfo;SET FOREIGN_KEY_CHECKS=1;
// print_r($requiredInputs);
// print_r($adTypeInfoShortNames);
// print_r($_POST);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	print_r($_POST);

	$checkInput = checkRequiredInput($_POST, array("name", "email", "city", "adType", "info", "price", "title"));
	if ($checkInput == 0) {
		/*
	 	 * NEED TO LOOP THROUGH $_POST TO SEE IF ANY OF THE VALUES IS A ADTYPEINFO
	 	 * MAKE A FUNCTION FOR THIS!
		 */

		// $dbInsert = new DbInsert();
		// $adUserInfoID = $dbInsert->insertIntoAdUserInfo($_POST["name"], $_POST["email"], $_POST["phonenumber"]);
		// $title, $info, $price, $adType, $campus, $city, $adUserInfo, $adInfo
		// $dbInsert->insertIntoAd($_POST["title"], $_POST["info"], $_POST["adType"], $_POST["campus"], $_POST["city"], $adUserInfoID);
	} else {
		foreach ($checkInput as $value) {
			echo $value;
		}
	}
}

?>
</div>