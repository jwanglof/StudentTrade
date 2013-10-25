				<?php
				// $cityID and $city is from ad.php
				
				// Make this more pretty some way?
				$dbh = new DbSelect();
				
				if (isset($_GET["type"], $_GET["campus"])) {
					$adCategory = $dbh->getAdCategoryFromName($_GET["type"]);
					$campus = $dbh->getCampusFromName(replaceSpecialChars($_GET["campus"], True));
					$campusID = $campus["id"];

					$ads = $dbh->getAdsWithAdCategoryFromCampus($adCategory["id"], $campusID, $cityID);
				} elseif (isset($_GET["type"]) && !isset($_GET["campus"])) {
					$adCategory = $dbh->getAdCategoryFromName($_GET["type"]);

					$ads = $dbh->getAdsWithAdCategoryIDFromCity($adCategory["id"], $cityID);
				} elseif (isset($_GET["campus"]) && !isset($_GET["type"])) {
					$campus = $dbh->getCampusFromName(replaceSpecialChars($_GET["campus"], True));
					$campusID = $campus["id"];

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
						<div class="latestAd">
							<a href="<?php echo generateShowAdURL($city["short_name"], $ad["title"],
								(isset($_GET["campus"]) ? $_GET["campus"] : NULL),
								(isset($_GET["type"]) ? $_GET["type"] : NULL),
								$ad["id"]); ?>">
								<div class="col-xs-1 categoryIcon icon <?php echo $adCategory["name"]; ?>"></div>
								<div class="col-xs-4 newAdInfo">
									<h4><?php echo limitStringLength($ad["title"]); ?></h4>
								</div>
								<div class="col-xs-3 newAdInfo">
									<span class="adType <?php echo $adType["short_name"]; ?>"><?php echo $adType["name"]; ?></span>
									<span class="where"><?php $asd = $dbh->getCampusFromID($ad["fk_ad_campus"]); echo $asd["campus_name"]; ?></span>
								</div>
								<div class="col-xs-2 newAdInfo date"><?php echo date_format(date_create($ad["date_created"]), "Y-m-d"); ?></div>
								<div class="col-xs-2 newAdInfo price"><?php echo $ad["price"]; ?> SEK</div>
							</a>
						</div>
					<?php
					}
					?>
					</div>
				</div>