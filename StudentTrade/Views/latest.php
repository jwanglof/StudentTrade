				<?php
				// $cityID and $city is from ad.php
				
				// Works, but I think I need to specify in MySQL Workbench that foreign keys are gonna be deleted when the table is
				// Remove date_expire in the database and from ad_add
				// $dbd = new DbDelete();
				// echo $dbd->deleteAdWithinDate(30);
				// $dbd = null;

				// Make this more pretty some way?
				$dbh = new DbSelect();

				$pageNo = 1;
				if (isset($_GET["pageNo"]) && $_GET["pageNo"] > 0)
					$pageNo = $_GET["pageNo"];

				$paginationURL = "front.php?page=latest&city=". $_GET["city"];
				$paginationURL .= isset($_GET["campus"]) ? "&campus=". $_GET["campus"] : "";
				$paginationURL .= isset($_GET["type"]) ? "&type=". $_GET["type"] : "";
				$paginationURL .= "&pageNo=";

				$pagination = new Pagination(20, $paginationURL);

				$proceed = True;
				
				if (isset($_GET["type"], $_GET["campus"])) {
					$adCategory = $dbh->getAdCategoryFromName($_GET["type"]);
					$campus = $dbh->getCampusFromName(replaceSpecialChars($_GET["campus"], True));

					if (empty($adCategory) || empty($campus))
						$proceed = False;

					$campusID = $campus["id"];

					$pagination->setDbQuery("getAdsWithAdCategoryFromCampus", $cityID, $campusID, $adCategory["id"]);
				}

				else if (isset($_GET["type"]) && !isset($_GET["campus"])) {
					$adCategory = $dbh->getAdCategoryFromName($_GET["type"]);

					if (empty($adCategory))
						$proceed = False;

					$pagination->setDbQuery("getAdsWithAdCategoryIDFromCity", $cityID, NULL, $adCategory["id"]);
				}

				else if (isset($_GET["campus"]) && !isset($_GET["type"])) {
					$campus = $dbh->getCampusFromName(replaceSpecialChars($_GET["campus"], True));

					if (empty($campus))
						$proceed = False;

					$campusID = $campus["id"];

					$pagination->setDbQuery("getAdsFromCampus", $cityID, $campusID, NULL);
				}

				else {
					$pagination->setDbQuery("getAds", $cityID, NULL, NULL);
				}

				$pagination->setLastPage();
				$pagination->setCurrentPage($pageNo);

				$ads = $pagination->getCurrentAds();

				if ($proceed) {					
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
					echo "<div class=\"pagination\">";
						echo "<ul class=\"pagination\">";

						$prevPage = $pagination->getPreviousPage();
						if (empty($prevPage))
							echo "<li class=\"disabled\"><span>&laquo;</span></li>";
						else
							echo "<li><a href=\"". $pagination->getURL() . $pagination->getPreviousPage() ."\">&laquo;</a></li>";

						foreach ($pagination->getPages() as $value) {
							if (isset($_GET["pageNo"]) && $_GET["pageNo"] == $value)
								echo "<li class=\"active\"><a href=\"". $pagination->getURL() . $value ."\">". $value ."</a></li>";
							else
								echo "<li><a href=\"". $pagination->getURL() . $value ."\">". $value ."</a></li>";
						}
						
						$nextPage = $pagination->getNextPage();
						if (empty($nextPage))
							echo "<li class=\"disabled\"><span>&raquo;</span></li>";
						else
							echo "<li><a href=\"". $pagination->getURL() . $pagination->getNextPage() ."\">&raquo;</a></li>";

						echo "</ul>";
					echo "</div>";
				echo "</div>";
				} else {
					echo "<h2>Fel parametrar i URLn!</h2>";
				}
				$dbh = null;
				?>