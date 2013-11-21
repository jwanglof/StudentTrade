<?php
session_start();

if ($_SESSION["admin"]) {
	if (isset($_GET["func"])) {
		if ($_GET["func"] == "deactive") {
			echo 22;
		}
	}
}
?>