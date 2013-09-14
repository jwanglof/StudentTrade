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
										". replaceSwedishLetters(replaceSpecialChars(strtolower($c["campus_name"]))) ."
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
								". replaceSwedishLetters(replaceSpecialChars(strtolower($_GET["campus"]))) ."
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
				echo "<span class=\"label label-success\" style=\"font-size: 15px; margin-right: 10px;\">";
				if (isset($_GET["campus"])) {
					echo "<a 
							href=\"?page=city
							&city=". $_GET["city"] ."
							&campus=
							". replaceSwedishLetters(replaceSpecialChars(strtolower($_GET["campus"]))) ."
							\">
							Visa alla
							</a>";
				} else {
					echo "<a 
							href=\"?page=city
							&city=". $_GET["city"] ."
							\">
							Visa alla
							</a>";
				}
				echo "</span>";
				echo "<span class=\"label label-success\" style=\"font-size: 15px; margin-right: 10px;\">";
				echo "<a 
						href=\"?page=ad_new
						&city=". $_GET["city"] ."
						\">
						Lägg till annons
						</a>";
				echo "</span>";
				?>
				</div>
			</div>

			<div class="col-md-12 ads content" style="margin: 20px 0px;">
				<?php
				if (isset($_GET["type"])) {
					$ad_type_info = $dbh->getAdTypeFromName($_GET["type"]);
					$ads = $dbh->getAdsWithTypeID($ad_type_info["id"]);
				} else {
					$ads = $dbh->getAds();
				}
				?>
				<div class="col-md-12 alert alert-danger">
					<h3><?php
						echo (isset($_GET["type"]) ? $ad_type_info["description"] : "Senaste annonserna");
					?></h3>
					<div class="ad title">Kategori</div>
					<div class="ad title">Titel</div>
					<div class="ad title">Pris</div>
					<div class="ad title">Skapad</div>
				</div>
				<div class="col-md-12">
				<?php
				foreach ($ads as $ad) {
					$ad_type = $dbh->getAdTypeFromID($ad["fk_ad_type_id"]);
					echo "<div class=\"ad\">". $ad_type["description"] ."</div>";
					echo "<div class=\"ad\">
							<a 
								href=\"?page=ad_show
								&city=". $_GET["city"] ."
								&id=". $ad["id"] ."\">
								". $ad["title"] ."
								</a>
							</div>";
					echo "<div class=\"ad\">". $ad["price"] ."</div>";
					echo "<div class=\"ad\">". $ad["date_created"] ."</div>";
					echo "<br />";
				}
				?>
				</div>
			</div>