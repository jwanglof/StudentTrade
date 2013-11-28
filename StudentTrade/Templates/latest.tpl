				<?php if ($this->proceed) { ?>
				<div class="col-xs-12 categoryHeading" style="<?php $this->eprint($this->adCategory["color"]); ?>">
					<?php echo (isset($_GET["type"]) ? $adCategory["description"] : "Senaste annonserna"); ?>
				</div>
				<div class="col-xs-12 categoryHeading search">
					<div class="row">
						<form action="front.php" method="get">
							<?php echo $this->searchAction; ?>
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
				foreach ($this->allAds as $ad):
				?>
					<div class="latestAd">
						<a href="<?php echo $ad["url"]; ?>">
							<div class="col-xs-1 categoryIcon icon <?php $this->eprint($ad["categoryName"]); ?>"></div>
							<div class="col-xs-4 newAdInfo">
								<h4><?php echo $ad["adTitleLimited"]; ?></h4>
							</div>
							<div class="col-xs-3 newAdInfo">
								<span class="adType <?php echo $ad["adType"]["short_name"]; ?>"><?php echo $ad["adType"]["name"]; ?></span>
								<span class="where"><?php echo $ad["campus"]["campus_name"]; ?></span>
							</div>
							<div class="col-xs-2 newAdInfo date"><?php echo $ad["dateCreated"]; ?></div>
							<div class="col-xs-2 newAdInfo price"><?php echo $ad["price"]; ?> SEK</div>
						</a>
					</div>
				<?php
				endforeach;
					echo "<div class=\"pagination\">";
						echo "<ul class=\"pagination\">";

						$prevPage = $pagination->getPreviousPage();
						if (empty($prevPage))
							echo "<li class=\"disabled\"><span>&laquo;</span></li>";
						else
							echo "<li><a href=\"". $pagination->getURL() . $pagination->getPreviousPage() ."\">&laquo;</a></li>";

						foreach ($pagination->getPages() as $value) {
							if ($pageNo == $value)
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