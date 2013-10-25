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
					<p style="width: 100%; height: 30px; font-size: 1.35em; text-align: center;" class="adType <?php echo $adType["short_name"]; ?>"><?php echo $adType["name"]; ?></p>
					<p>
						Kategori:
						<br />
						<span class="adShowInfo"><?php echo $adCategory["description"]; ?></span>
					</p>
					<p>
						Upplagd:
						<br />
						<span class="adShowInfo">
							<?php echo date_format(date_create($ad["date_created"]), "Y-m-d"); ?>
							<br />
							<?php echo date_format(date_create($ad["date_created"]), "H:m"); ?>
						</span>
					</p>
					<p>
						Säljes av:
						<br />
						<span class="adShowInfo">
							<?php echo $adUserInfo["name"]; ?>
							<?php echo (!empty($adUserInfo["phonenumber"]) ? "<br /> (". $adUserInfo["phonenumber"]. ")" : "");  ?>
						</span>
					</p>
				</div>
				<div class="col-xs-9">
					<h1><?php echo $ad["title"]; ?></h1>
					<?php echo $ad["info"]; ?>
					<div class="row">
						<div class="col-xs-7">
							<h4>Få större spridning på sociala medier</h4>
						</div>
						<div class="col-xs-5"><hr /></div>
					</div>

					<div id="adAnswer">Svara på annonsen</div>

					<div class="row">
						<div class="col-xs-6" id="adReport">Anmäl denna annons</div>
						<div class="col-xs-6" id="adDelete">Ta bort annonsen</div>
					</div>
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
				<div style="display: none;" id="adReportForm">
					<form method="post" action="front.php?page=ad_form&city=<?php echo $_GET["city"]; ?>&aid=<?php echo $_GET["aid"]; ?>&check" class="form-horizontal" role="form">
						<fieldset>
							<div class="form-group">
								<label for="message" class="col-lg-1 control-label">Varför anmäler du denna annons? *</label>
								<div class="col-lg-5">
									<textarea class="form-control" name="message" id="message" rows="5"></textarea>
								</div>
							</div>

							<button type="submit" class="btn btn-primary btn-sm">Skicka anmälan</button>
							<button type="reset" class="btn btn-default btn-sm">Rensa alla fält</button>
						</fieldset>
					</form>
				</div>