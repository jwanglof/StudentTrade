<?php
	function replaceSwedishLetters($string, $reversed=False) {
		$search = array("å","ä","ö");
		$replace = array("a","a","o");
		return str_replace((($reversed == False) ? $search : $replace), (($reversed == False) ? $replace : $search), $string);
	}

	function replaceSpecialChars($string, $reversed=False) {
		$search = array(" ");
		$replace = array("_");
		return str_replace((($reversed == False) ? $search : $replace), (($reversed == False) ? $replace : $search), $string);
	}

	function generateAdURL($page, $city, $name_on_url, $campus=NULL, $type=NULL) {
		return "<a href=\"front.php?page=$page&city=$city". (($campus != NULL) ? "&campus=". replaceSwedishLetters(replaceSpecialChars(strtolower($campus))) ."" : "") ."". (($type != NULL) ? "&type=$type" : "") ."\">$name_on_url</a>";
	}

	function generateCampusURL($city, $name_on_url, $type=NULL, $showCampus=True) {
		$campus = replaceSwedishLetters(replaceSpecialChars(strtolower($name_on_url)));
		
		return "<a href=\"front.php?page=latest&city=$city". ($showCampus ? "&campus=$campus" : "") ."". (($type != NULL) ? "&type=$type" : "") ."\" class=\"btn btn-default\" id=\"$campus\">$name_on_url</a>";
	}

	function generateShowAdURL($city, $name_on_url, $campus=NULL, $type=NULL, $adID) {
		return "<a href=\"front.php?page=ad_show&city=$city". (($campus != NULL) ? "&campus=". replaceSwedishLetters(replaceSpecialChars(strtolower($campus))) ."" : "") ."". (($type != NULL) ? "&type=$type" : "") ."&aid=". $adID ."\">$name_on_url</a>";
	}

	function generateRandomString($length = 10) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, strlen($characters) - 1)];
		}
		return $randomString;
	}

	function compareString($string1, $string2) {
		return (replaceSwedishLetters(replaceSpecialChars(strtolower($string1))) == replaceSwedishLetters(replaceSpecialChars(strtolower($string2))));
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

	function checkPOSTInput($input) {
		$input = trim($input);
		$input = stripslashes($input);
		$input = htmlspecialchars($input);
		return $input;
	}
?>