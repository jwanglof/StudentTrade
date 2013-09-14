<?php
$dbh = new DbSelect();

$city_id = $dbh->getCityID($_GET['city']);
$universities = $dbh->getUniversitiesFromCityID($city_id["id"]);
foreach ($universities as $uni) {
	
}
?>