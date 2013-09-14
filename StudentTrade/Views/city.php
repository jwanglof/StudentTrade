<?php
$dbh = new DbSelect();

$city = $dbh->getCity($_GET['city']);
$universities = $dbh->getUniversitiesFromCityID($city["id"]);
$campuses = [];
foreach ($universities as $uni) {
	array_push($campuses, $dbh->getCampusFromUniversityID($uni["id"]));
}

$adtypes = $dbh->getAdTypes();
?>

			<div class="row">
				<div class="col-md-6 col-md-offset-6" style="border: 0px solid #000; height: 100px; margin-top: 20px;">
					Visa bara annonser från campus:
					<div class="btn-group btn-group-justified">
					<?php
					foreach ($campuses as $cam) {
						foreach ($cam as $c) {
							echo "<a 
									href=\"?page=city
									&city=". $_GET["city"] ."
									&campus=
									". removeSwedishLetters(strtolower($c["campus_name"])) ."
									\" class=\"btn btn-default\">
									". $c["campus_name"] ."
									</a>";
						}
					}
					?>
					</div>
				</div>
			</div>

			<div class="col-md-12" style="border: 0px solid #000; height: 320px;">
				En fin bild eller dylikt
			</div>

			<div class="col-md-12 alert alert-warning" style="border: 0px solid #000">
			<?php
			foreach ($adtypes as $type) {
				echo "<span class=\"label label-success\" style=\"font-size: 15px; margin-right: 10px;\">";
				if (isset($_GET["campus"])) {
					echo "<a 
							href=\"?page=city
							&city=". $_GET["city"] ."
							&campus=
							". removeSwedishLetters(strtolower($_GET["campus"])) ."
							&type=". $type["name"] ."
							\">
							". $type["description"] ."
							</a>";
				} else {
					echo "<a 
							href=\"?page=city
							&city=". $_GET["city"] ."
							&type=". $type["name"] ."
							\">
							". $type["description"] ."
							</a>";
				}
				echo "</span>";
			}
			?>
			</div>