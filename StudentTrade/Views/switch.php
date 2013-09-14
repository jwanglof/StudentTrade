<?php
	if (!$_GET) {
		include 'layout_index.php';
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