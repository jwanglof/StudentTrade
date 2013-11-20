				<?php
				// $cityID and $city is from ad.php
				
				// Works, but I think I need to specify in MySQL Workbench that foreign keys are gonna be deleted when the table is
				// Remove date_expire in the database and from ad_add
				// $dbd = new DbDelete();
				// echo $dbd->deleteAdWithinDate(30);
				// $dbd = null;

				// Make this more pretty some way?
				$dbh = new DbSelect();

				$proceed = True;
				
				if (isset($_GET["type"], $_GET["campus"])) {
					$adCategory = $dbh->getAdCategoryFromName($_GET["type"]);
					$campus = $dbh->getCampusFromName(replaceSpecialChars($_GET["campus"], True));

					if (empty($adCategory) || empty($campus))
						$proceed = False;

					$campusID = $campus["id"];

					$ads = $dbh->getAdsWithAdCategoryFromCampus($adCategory["id"], $campusID, $cityID);
				}

				else if (isset($_GET["type"]) && !isset($_GET["campus"])) {
					$adCategory = $dbh->getAdCategoryFromName($_GET["type"]);

					if (empty($adCategory))
						$proceed = False;

					$ads = $dbh->getAdsWithAdCategoryIDFromCity($adCategory["id"], $cityID);
				}

				else if (isset($_GET["campus"]) && !isset($_GET["type"])) {
					$campus = $dbh->getCampusFromName(replaceSpecialChars($_GET["campus"], True));

					if (empty($campus))
						$proceed = False;

					$campusID = $campus["id"];

					$ads = $dbh->getAdsFromCampus($campusID, $cityID);
				}

				else {
					$ads = $dbh->getAds($cityID);
				}

				if ($proceed) {
					$_SESSION["totalAds"] = $dbh->getAmountOfAds();
					// $_SESSION["totalNoPages"] = $noPages;

					$pageNo = 1;
					if (isset($_GET["pageNo"]))
						$pageNo = $_GET["pageNo"];

					$paginationURL = "front.php?page=latest&city=". $_GET["city"];
					$paginationURL .= isset($_GET["campus"]) ? "&campus=". $_GET["campus"] : "";
					$paginationURL .= isset($_GET["type"]) ? "&type=". $_GET["type"] : "";

					$hej = new Blaffs($_SESSION["totalAds"], "5", $paginationURL);
					$hej->setPageNumber($pageNo);
					$currentAds = $hej->getAds();
					print_r($currentAds);

					echo "Current page: ". $hej->getCurrentPage();
					echo "<br />Last page: ". $hej->getLastPage();
					echo "<br />";
					echo $hej->getPages();

				?>
				<div class="col-xs-12 categoryHeading" <?php echo (isset($_GET["type"]) ? "style=\"background-color: ". $adCategory["color"] ."\"" : ""); ?>>
					<?php echo (isset($_GET["type"]) ? $adCategory["description"] : "Senaste annonserna"); ?>
				</div>
				<div class="col-xs-12 categoryHeading search">
					<div class="row">
						<form action="front.php" method="get">
							<?php echo generateSearchInputs($city["short_name"],
								(isset($_GET["campus"]) ? $_GET["campus"] : NULL),
								(isset($_GET["type"]) ? $_GET["type"] : NULL)); ?>
							<div class="input-group">
								<input type="text" class="form-control" name="searchString" placeholder="Sök på annonstitel">
								<span class="input-group-btn">
									<button type="submit" class="btn btn-default">Sök!</button>
								</span>
							</div>
						</form>
					</div>
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
									<span class="where"><?php $campus = $dbh->getCampusFromID($ad["fk_ad_campus"]); echo $campus["campus_name"]; ?></span>
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
				<?php
				} else {
					echo "<h2>Fel parametrar i adressen!</h2>";
				}
				$dbh = null;
				?>