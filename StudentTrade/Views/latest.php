				<?php
				// $cityID and $city is from ad.php
				
				// Make this more pretty some way?
				if (isset($_GET["type"], $_GET["campus"])) {
					$adType = $dbh->getAdTypeFromName($_GET["type"]);
					$campusID = $dbh->getCampusFromName(replaceSpecialChars($_GET["campus"], True))["id"];

					$ads = $dbh->getAdsWithTypeFromCampus($adType["id"], $campusID, $cityID);
				} elseif (isset($_GET["type"]) && !isset($_GET["campus"])) {
					$adType = $dbh->getAdTypeFromName($_GET["type"]);

					$ads = $dbh->getAdsWithTypeIDFromCity($adType["id"], $cityID);
				} elseif (isset($_GET["campus"]) && !isset($_GET["type"])) {
					$campusID = $dbh->getCampusFromName(replaceSpecialChars($_GET["campus"], True))["id"];

					$ads = $dbh->getAdsFromCampus($campusID, $cityID);
				} else {
					$ads = $dbh->getAds($cityID);
				}
				?>
				<div class="col-md-12 alert alert-danger">
					<h3><?php
						echo (isset($_GET["type"]) ? $adType["description"] : "Senaste annonserna");
					?></h3>
					<div class="ad title">Kategori</div>
					<div class="ad title">Titel</div>
					<div class="ad title">Pris</div>
					<div class="ad title">Skapad</div>
				</div>
				<div class="col-md-12">
				<?php
				foreach ($ads as $ad) {
					$ad_type = $dbh->getAdTypeFromID($ad["fk_ad_ad_type"]);
					echo "<div class=\"ad\">";
					echo generateAdURL("latest", $city["short_name"], $ad_type["description"],
									(isset($_GET["campus"]) ? $_GET["campus"] : NULL),
									$ad_type["name"]);
					echo "</div>";
					echo "<div class=\"ad\">";
					echo generateShowAdURL($city["short_name"], $ad["title"],
								(isset($_GET["campus"]) ? $_GET["campus"] : NULL),
								(isset($_GET["type"]) ? $_GET["type"] : NULL),
								$ad["id"]);
					echo "</div>";
					echo "<div class=\"ad\">". $ad["price"] ."</div>";
					echo "<div class=\"ad\">". $ad["date_created"] ."</div>";
					echo "<br />";
				}
				?>