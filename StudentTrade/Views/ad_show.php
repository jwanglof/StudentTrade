<?php
$dbh = new DbSelect();
$ad = $dbh->getAdFromID($_GET["aid"]);

$adInfo = $dbh->getAdInfoFromAdID($ad["id"]);
$adUserInfo = $dbh->getAdUserInfoFromAdUserInfoID($ad["fk_ad_adUserInfo"]);
$adCategory = $dbh->getAdCategoryFromID($ad["fk_ad_adCategory"]);
$adSubCategory = $dbh->getAdSubCategoryFromAdCategoryID($ad["fk_ad_adCategory"]);
$adType = $dbh->getAdTypeFromAdTypeID($ad["fk_ad_adType"]);

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

$title = myWordWrap($ad["title"], 33);
$info = myWordWrap($ad["info"], 68);

?>
				<div class="col-xs-3">
					<p style="width: 100%; height: 200px; background-color: <?php echo $adCategory["color"]; ?>"></p>
					<p style="width: 100%; height: 25px; font-size: 1.3em;" class="adType <?php echo $adType["short_name"]; ?>"><?php echo $adType["name"]; ?></p>
				</div>
				<div class="col-xs-9">
					Hej2
				</div>

				<!-- <div class="col-xs-12 categoryHeading" style="background-color: <?php echo $adCategory["color"]; ?>">
					<?php include("category_heading.php");/*echo $title;*/ ?>
				</div>
				<div class="col-xs-12" style="width: 100%; min-height: 200px; background-color: #f4f4f4;">
					<div class="col-xs-12" style="background-color: #DCD9D4; padding: 10px 10px;">
						<?php echo wordwrap($ad["info"], 71, "<br />", true); ?>
					</div>
						<div class="col-xs-8" style="background-color: #DCD9D4; border-top: 1px solid #000; min-height: 70px;">
							<h4>Säljes av: <?php echo $adUserInfo["name"]; ?></h4>
							Telefonnummer: <?php echo (!empty($adUserInfo["phonenumber"]) ? $adUserInfo["phonenumber"] : "<i>Ej angett</i>"); ?>
							<br />
							Pris: <?php echo $ad["price"]; ?>kr
							<p>
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
							</p>
						</div>
						<div class="col-xs-4" style="text-align: right;">
							<div style="background-color: #39b54a; font-size: 20px; text-align: center; margin-top: 10px; padding: 10px 0px; color: #fff;" id="adAnswer">Svara på annonsen</div>
							<div id="adReport">Anmäl denna annons</div>
							<div id="adDelete">Ta bort annonsen</div>

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
							<div style="display: none;" id="adReportForm">
								<form method="post" action="front.php?page=ad_form&city=<?php echo $_GET["city"]; ?>&aid=<?php echo $_GET["aid"]; ?>&check" class="form-horizontal" role="form">
									<fieldset>
										<div class="form-group">
											<label for="message" class="col-lg-1 control-label">Varför anmäler du denna annons? *</label>
											<div class="col-lg-5">
												<textarea class="form-control" name="message" id="message" rows="5"></textarea>
											</div>
										</div>

										<button type="submit" class="btn btn-primary btn-sm">Skicka meddelande</button>
										<button type="reset" class="btn btn-default btn-sm">Rensa alla fält</button>
									</fieldset>
								</form>
							</div>
						</div>
				</div> -->