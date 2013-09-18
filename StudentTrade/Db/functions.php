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
		return "<a href=\"ad.php?page=$page&city=$city". (($campus != NULL) ? "&campus=". replaceSwedishLetters(replaceSpecialChars(strtolower($campus))) ."" : "") ."". (($type != NULL) ? "&type=$type" : "") ."\">$name_on_url</a>";
	}

	function generateCampusURL($city, $name_on_url, $campus, $type=NULL) {
		return "<a href=\"ad.php?page=latest&city=$city&campus=". replaceSwedishLetters(replaceSpecialChars(strtolower($campus))) ."". (($type != NULL) ? "&type=$type" : "") ."\" class=\"btn btn-default\">$name_on_url</a>";
	}

	function generateShowAdURL($city, $name_on_url, $campus=NULL, $type=NULL, $adID) {
		return "<a href=\"ad.php?page=ad_show&city=$city". (($campus != NULL) ? "&campus=". replaceSwedishLetters(replaceSpecialChars(strtolower($campus))) ."" : "") ."". (($type != NULL) ? "&type=$type" : "") ."&aid=". $adID ."\">$name_on_url</a>";
	}
?>