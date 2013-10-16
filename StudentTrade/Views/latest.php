				<?php
				// $cityID and $city is from ad.php
				
				// Make this more pretty some way?
				$dbh = new DbSelect();
				
				if (isset($_GET["type"], $_GET["campus"])) {
					$adCategory = $dbh->getAdCategoryFromName($_GET["type"]);
					$campusID = $dbh->getCampusFromName(replaceSpecialChars($_GET["campus"], True));
					$campusID = $campusID["id"];

					$ads = $dbh->getAdsWithAdCategoryFromCampus($adCategory["id"], $campusID, $cityID);
				} elseif (isset($_GET["type"]) && !isset($_GET["campus"])) {
					$adCategory = $dbh->getAdCategoryFromName($_GET["type"]);

					$ads = $dbh->getAdsWithAdCategoryIDFromCity($adCategory["id"], $cityID);
				} elseif (isset($_GET["campus"]) && !isset($_GET["type"])) {
					$campusID = $dbh->getCampusFromName(replaceSpecialChars($_GET["campus"], True));
					$campusID = $campusID["id"];

					$ads = $dbh->getAdsFromCampus($campusID, $cityID);
				} else {
					$ads = $dbh->getAds($cityID);
				}
				?>
				<div class="col-xs-12 categoryHeading" <?php echo (isset($_GET["type"]) ? "style=\"background-color: ". $adCategory["color"] ."\"" : "Senaste annonserna"); ?>>
					<?php echo (isset($_GET["type"]) ? $adCategory["description"] : "Senaste annonserna"); ?>
				</div>
				<div class="col-xs-12">
					<div class="row" id="latestAd">

				<?php
				foreach ($ads as $ad) {
					$adCategory = $dbh->getAdCategoryFromID($ad["fk_ad_adCategory"]);
					$adType = $dbh->getAdTypeFromAdTypeID($ad["fk_ad_adType"]);
				?>
						<div class="col-xs-6 latestAd">
							<div class="categoryLetter" style="background-color: <?php echo $adCategory["color"]; ?>;">
								<?php echo mb_substr($adCategory["description"], 0, 1, "UTF-8"); ?>
							</div>
							<div class="adInfo">
								<h4><?php echo generateShowAdURL($city["short_name"], $ad["title"],
								(isset($_GET["campus"]) ? $_GET["campus"] : NULL),
								(isset($_GET["type"]) ? $_GET["type"] : NULL),
								$ad["id"]); ?></h4>
								<?php echo $adType["name"] ." - ". $ad["price"] ." SEK (". date_format(date_create($ad["date_created"]), "Y-m-d") .")"; ?>
							</div>
						</div>
				<?php
				// 	echo $ad["fk_ad_adType"];
				// 	echo "<div class=\"ad\">";
				// 	echo generateAdURL("latest", $city["short_name"], $ad_type["description"],
				// 					(isset($_GET["campus"]) ? $_GET["campus"] : NULL),
				// 					$ad_type["name"]);
				// 	echo "</div>";
				// 	echo "<div class=\"ad\">";
				// 	echo generateShowAdURL($city["short_name"], $ad["title"],
				// 				(isset($_GET["campus"]) ? $_GET["campus"] : NULL),
				// 				(isset($_GET["type"]) ? $_GET["type"] : NULL),
				// 				$ad["id"]);
				// 	echo "</div>";
				// 	echo "<div class=\"ad\">". $ad["price"] ."</div>";
				// 	echo "<div class=\"ad\">". $ad["date_created"] ."</div>";
				// 	echo "<br />";
				}
				?>
					</div>
				</div>