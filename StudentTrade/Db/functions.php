<?php
	function removeSwedishLetters($string) {
		$search = array("å","ä","ö");
		$replace = array("a","a","o");
		return str_replace($search, $replace, $string);
	}
?>