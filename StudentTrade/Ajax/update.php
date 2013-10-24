<?php
session_start();

if (isset($_POST["update"]) && $_SESSION["sessProtector"] == $_COOKIE["PHPSESSID"]) {
	require("../Db/DbConfig.php");
	require("../Db/DbSelect.php");
	require("../Db/DbUpdate.php");
	require("../Class/Cipher.php");
	
	if ($_POST["update"] == "adActive") {
		$dbh = new DbSelect();
		$ad = $dbh->getAdFromID($_POST["aid"]);
		$dbh = null;

		$cipher = new Cipher("JFKs3ef03J");
		if ($ad["password"] == $cipher->encrypt($_POST["removeCode"])) {
			$dbUpdate = new DbUpdate();
			// echo $dbUpdate->updateAdActiveWithAdID($_POST["aid"]);
			if ($dbUpdate->updateAdActiveWithAdID($_POST["aid"]) > 0) 
				echo True;
			else
				echo False;
			$dbUpdate = null;
		}
		else
			echo False;
		$cipher = null;
	}
	else
		echo False;
} else {
	echo False;
}
?>