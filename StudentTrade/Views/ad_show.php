<div class="col-md-12" style="color: #464646;">
<?php
$dbh = new DbSelect();
$ad = $dbh->getAdFromID($_GET["aid"]);
$adInfo = $dbh->getAdInfoFromAdID($ad["id"]);
$adUserInfo = $dbh->getAdUserInfoFromAdUserInfoID($ad["fk_ad_adUserInfo"]);
$adCategory = $dbh->getAdCategoryFromID($ad["fk_ad_adCategory"]);
$adSubCategory = $dbh->getAdSubCategoryFromAdCategoryID($ad["fk_ad_adCategory"]);
$dbh = null;

// print_r($ad);
// echo "<br />";
// print_r($adInfo);
// echo "<br />";
// print_r($adUserInfo);
// echo "<br />";
// print_r($adCategory);
// echo "<br />";
// print_r($adSubCategory);

?>
</div>

				<div class="col-xs-12 categoryHeading" style="background-color: <?php echo $adCategory["color"]; ?>">
					<?php echo $ad["title"]; ?>
				</div>
				<div class="col-xs-12" style="width: 100%; min-height: 200px; background-color: #f4f4f4;">
					<div class="col-xs-12" style="background-color: #DCD9D4; padding: 10px 10px;">
						<?php echo $ad["info"]; ?>
					</div>
						<div class="col-xs-8" style="background-color: #DCD9D4; border-top: 1px solid #000; min-height: 70px;">
							<h4>Säljes av: <?php echo $adUserInfo["name"]; ?></h4>
							Pris: <?php echo $ad["price"]; ?>kr
							<br />
							<?php
							foreach ($adSubCategory as $val) {
								echo $val["name"] .": ";
								foreach ($adInfo as $value) {
									if ($val["id"] == $value["fk_adInfo_adSubCategory"])
										echo $value["sub_category_value"];
								}
								echo "<br />";
							}
							?>
						</div>
						<div class="col-xs-4" style="text-align: right;">
							<div style="background-color: #39b54a; font-size: 20px; text-align: center; margin-top: 10px; padding: 10px 0px;" id="adAnswer">
								<!-- <a href="front.php?page=ad_form&aid=<?php echo $_GET["aid"]; ?>">Svara på annonsen</a> -->
								Svara på annonsen
							</div>
							<div style="display: none;" id="adAnswerForm">
								<form method="post" action="front.php?page=ad_form&city=<?php echo $_GET["city"]; ?>&aid=<?php echo $_GET["aid"]; ?>&check" class="form-horizontal" role="form">
									<fieldset>
										<div class="form-group">
											<label for="name" class="col-lg-1 control-label">Ditt namn *</label>
											<div class="col-lg-5">
												<input type="text" class="form-control" id="name" name="name" placeholder="Namn">
											</div>
										</div>

										<div class="form-group">
											<label for="from_email" class="col-lg-1 control-label">Din e-post *</label>
											<div class="col-lg-5">
												<input type="email" class="form-control" name="from_email" id="from_email" placeholder="Din e-post" />
											</div>
										</div>

										<div class="form-group">
											<label for="message" class="col-lg-1 control-label">Ditt meddelande *</label>
											<div class="col-lg-5">
												<textarea class="form-control" name="message" id="message" rows="5"></textarea>
											</div>
										</div>

										<button type="submit" class="btn btn-primary btn-sm">Skicka meddelande</button>
										<button type="reset" class="btn btn-default btn-sm">Rensa alla fält</button>
									</fieldset>
								</form>
							</div>
							<span>
								Anmäl denna annons
								<br />
								<!-- <a href="front.php?page=ad_remove&aid=<?php echo $_GET["aid"]; ?>">Ta bort annonsen</a> -->
								<div id="adDelete">Ta bort annonsen</div>
							</span>
						</div>
				</div>