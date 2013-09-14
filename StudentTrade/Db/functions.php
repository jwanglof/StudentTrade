<?php
	function replaceSwedishLetters($string) {
		$search = array("å","ä","ö");
		$replace = array("a","a","o");
		return str_replace($search, $replace, $string);
	}

	function replaceSpecialChars($string) {
		$search = array(" ");
		$replace = array("_");
		return str_replace($search, $replace, $string);
	}
?>