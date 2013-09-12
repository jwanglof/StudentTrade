<?php
	if (!$_GET) {
		include 'front_page.php';
	} elseif ($_GET['page']) {
		$root_dir = getcwd() .'/StudentTrade/Views/';
		if (is_file($root_dir . $_GET['page'] .'.php')) {
			include $_GET['page'] .'.php';
		} else {
			include 'error.php';
		}
	} else {
		include 'error.php';
	}
?>