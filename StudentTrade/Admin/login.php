<?php
ob_start();
session_start();

error_reporting(-1);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	include_once("../Db/DbConfig.php");
	include_once("Db/AdminDb.php");

	$dbh = new AdminDb();
	$adminQuery = $dbh->getAdmin($_POST["username"], $_POST["password"]);
	
	if (count($adminQuery) > 1) {
		$_SESSION["admin"] = True;
		echo "<a href=\"index.php?page=showAds\">Tryck för att återgå till adminverktygen</a>";
	}
	else {
		$_SESSION["admin"] = False;
		echo "Du är inte inloggad!";
	}
	echo $_SESSION["admin"];
}
?>