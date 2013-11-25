<?php
require("../Db/DbSelect.php");
foreach ($campuses as $cam) {
										foreach ($cam as $c) {
											echo "<li>";
											if (isset($_GET["campus"]) && compareString($_GET["campus"], $c["campus_name"])) {
												echo generateCampusURL($city["short_name"], $c["campus_name"],
													(isset($_GET["type"]) ? $_GET["type"] : NULL),
													False);
											} else {
												echo generateCampusURL($city["short_name"], $c["campus_name"],
													(isset($_GET["type"]) ? $_GET["type"] : NULL));
											}
											echo "</li>";
										}
									}

$dbh = new DbSelect();

$city = (isset($_GET['city']) ? $dbh->getCity($_GET['city']) : $dbh->getCity("linkoping"));
$universities = $dbh->getUniversitiesFromCityID($city["id"]);
$campuses = array();
foreach ($universities as $uni) {
	array_push($campuses, $dbh->getCampusFromUniversityID($uni["id"]));
}
?>