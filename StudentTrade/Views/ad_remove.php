<?php
if (isset($_GET["aid"]) && isset($_GET["code"])) {
	$dbh = new DbSelect();
	$ad = $dbh->getAdFromID($_GET["aid"]);
	$dbh = null;

	$cipher = new Cipher("JFKs3ef03J");
	if ($ad["password"] == $cipher->encrypt($_GET["code"])) {
		$dbUpdate = new DbUpdate();
		if ($dbUpdate->updateAdActiveWithAdID($_GET["aid"]) > 0) {
			$cipher = null;
			header("Location: front.php?page=latest");
		}
		else
			echo "Du angav fel borttagningskod.";
		$dbUpdate = null;
	}
	else
		echo False;
	$cipher = null;
}
?>