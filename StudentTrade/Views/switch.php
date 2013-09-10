<?php
	if (!$_GET) {
		include 'index_boxes.php';
	} else {
		$root_dir = getcwd() .'/StudentTrade/Views/';
		if (is_file($root_dir . $_GET['page'] .'.php')) {
			include $_GET['page'] .'.php';
		} else {
			include 'error.php';
		}
	}
?>