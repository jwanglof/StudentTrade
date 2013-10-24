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
				<div class="col-xs-12 categoryHeading" <?php echo (isset($_GET["type"]) ? "style=\"background-color: ". $adCategory["color"] ."\"" : ""); ?>>
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
							<a href="<?php echo generateShowAdURL($city["short_name"], $ad["title"],
								(isset($_GET["campus"]) ? $_GET["campus"] : NULL),
								(isset($_GET["type"]) ? $_GET["type"] : NULL),
								$ad["id"]); ?>">
								<div class="col-xs-2 categoryIcon icon <?php echo $adCategory["name"]; ?>"></div>
								<div class="col-xs-10 newAdInfo">
									<h4><?php echo limitStringLength($ad["title"]); ?></h4>
									<?php echo $adType["name"] ." för ". $ad["price"] ." SEK (". date_format(date_create($ad["date_created"]), "Y-m-d") .")"; ?>
								</div>
							</a>
						</div>
				<?php
				}
				?>
					</div>
				</div>