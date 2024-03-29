				<?php				
				if (isset($_GET["page"]) && $_GET["page"] == "search") {
					$dbh = new DbSelect();
					$ads = $dbh->searchAdsWithName("%". $_GET["searchString"] ."%", $cityID);
				?>
				<div class="col-xs-12 categoryHeading">
					Resultat av <i><?php echo $_GET["searchString"]; ?></i>
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
				?>
				</div>
				<?php
					$dbh = null;
				}
				?>