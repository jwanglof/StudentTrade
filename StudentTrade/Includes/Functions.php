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

	// function generateAdURL($page, $city, $name_on_url, $campus=NULL, $type=NULL, $active=False) {
	// 	return "<a href=\"../Logic/front.php?page=$page&city=$city". (($campus != NULL) ? "&campus=". replaceSwedishLetters(replaceSpecialChars(strtolower($campus))) ."" : "") ."". (($type != NULL) ? "&type=$type" : "") ."\" class=\"". ($active ? "categoryActive" : ((isset($_GET["type"]) && $type != NULL) ? "categoryInactive" : "")) ."\">$name_on_url</a>";
	// }

	// function generateCampusURL($city, $name_on_url, $type=NULL, $showCampus=True) {
	// 	$campus = replaceSwedishLetters(replaceSpecialChars(strtolower($name_on_url)));
		
	// 	return "<a href=\"../Logic/front.php?page=latest&city=$city". ($showCampus ? "&campus=$campus" : "") ."". (($type != NULL) ? "&type=$type" : "") ."\" id=\"$campus\">$name_on_url</a>";
	// }

	// function generateShowAdURL($city, $name_on_url, $campus=NULL, $type=NULL, $adID) {
	// 	// $name_on_url = ((strlen($name_on_url) > 10) ? substr($name_on_url, 0, 25) ."..." : $name_on_url);
	// 	// return "<a href=\"../Logic/front.php?page=ad_show&city=$city". (($campus != NULL) ? "&campus=". replaceSwedishLetters(replaceSpecialChars(strtolower($campus))) ."" : "") ."". (($type != NULL) ? "&type=$type" : "") ."&aid=". $adID ."\">$name_on_url</a>";
	// 	return "../Logic/front.php?page=ad_show&city=$city". (($campus != NULL) ? "&campus=". replaceSwedishLetters(replaceSpecialChars(strtolower($campus))) : "") ."". (($type != NULL) ? "&type=". $type : "") ."&aid=". $adID;
	// }

	// function generateSearchInputs($city, $campus=NULL, $type=NULL) {
	// 	$searchInput = "<input type=\"hidden\" name=\"page\" value=\"search\" />";
	// 	$searchInput .= "<input type=\"hidden\" name=\"city\" value=\"". $city ."\" />";
	// 	if ($campus != NULL)
	// 		$searchInput .= "<input type=\"hidden\" name=\"campus\" value=\"". replaceSwedishLetters(replaceSpecialChars(strtolower($campus))) ."\" />";
	// 	if ($type != NULL)
	// 		$searchInput .= "<input type=\"hidden\" name=\"type\" value=\"". $type ."\" />";
	// 	return $searchInput;
	// }

	function generateRandomString($length = 10, $characters) {
		// $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		// $characters = '0123456789';
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

	function limitStringLength($string, $length=23) {
		return ((mb_strlen($string) > $length) ? mb_substr($string, 0, $length) ."..." : $string);
	}

	function utf8_wordwrap($string, $width=75, $break="\n", $cut=false) {
		if($cut) {
			// Match anything 1 to $width chars long followed by whitespace or EOS,
			// otherwise match anything $width chars long
			$search = '/(.{1,'.$width.'})(?:\s|$)|(.{'.$width.'})/uS';
			$replace = '$1$2'.$break;
		} else {
			// Anchor the beginning of the pattern with a lookahead
			// to avoid crazy backtracking when words are longer than $width
			$pattern = '/(?=\s)(.{1,'.$width.'})(?:\s|$)/uS';
			$replace = '$1'.$break;
		}
		return preg_replace($search, $replace, $string);
	}

	function myWordWrap($string, $length=20) {
		// $string = utf8_wordwrap($string, $length, "\n", true);
		$string = wordwrap($string, $length, "\n", true);
		$string = htmlspecialchars($string, ENT_QUOTES, "UTF-8");
		$string = nl2br($string);
		return $string;
	}

	function searchMultiArray($value, $key, $array) {
		foreach ($array as $k => $val) {
			if ($val[$key] == $value)
				return $val;
		}
		return NULL;
	}
?>