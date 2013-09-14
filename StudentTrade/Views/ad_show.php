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
			<div class='col-md-12 index top' style="background-color: #363636;">
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
			</div>

			<div class="col-md-12 ads content" style="margin: 20px 0px;">
				<div class="col-md-12 alert alert-danger">
					<h3></h3>
					<div class="ad title">Kategori</div>
					<div class="ad title">Titel</div>
					<div class="ad title">Pris</div>
					<div class="ad title">Skapad</div>
				</div>
			</div>