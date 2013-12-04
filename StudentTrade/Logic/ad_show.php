<?php
$dbh = new DbSelect();
$adFromID = $dbh->getAdFromID($_GET["aid"]);

if (!empty($adFromID)) {
	$config = array(
		'template_path' => array('../Templates/')
	);

	$adShow = new Savant3($config);

	$adInfo = $dbh->getAdInfoFromAdID($adFromID["id"]);
	$adUserInfo = $dbh->getAdUserInfoFromAdUserInfoID($adFromID["id"]);
	$adCategory = $dbh->getAdCategoryFromID($adFromID["fk_ad_adCategory"]);
	$adSubCategory = $dbh->getAdSubCategoryFromAdCategoryID($adFromID["fk_ad_adCategory"]);
	$adType = $dbh->getAdTypeFromAdTypeID($adFromID["fk_ad_adType"]);

	// print_r($adFromID);
	// echo "<br />";
	// print_r($adInfo);
	// echo "<br />";
	// print_r($adUserInfo);
	// echo "<br />";
	// print_r($adCategory);
	// echo "<br />";
	// print_r($adSubCategory);

	$title = myWordWrap($adFromID["title"], 33);
	$info = myWordWrap($adFromID["info"], 68);

	$adShow->adFromID 			= $adFromID;
	$adShow->adInfo 			= $adInfo;
	$adShow->adUserInfo 		= $adUserInfo;
	$adShow->adCategory 		= $adCategory;
	$adShow->adSubCategory 		= $adSubCategory;
	$adShow->adType 			= $adType;

	$adShow->display("ad_show.tpl");
} else {
	echo "<h2>Denna annons finns inte!</h2>";
}
$dbh = null;
?>