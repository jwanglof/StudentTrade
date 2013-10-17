<div class="col-md-12" style="color: #464646;">
<?php
$dbh = new DbSelect();
$ad = $dbh->getAdFromID($_GET["aid"]);
$adInfo = $dbh->getAdInfoFromAdID($ad["id"]);
$adUserInfo = $dbh->getAdUserInfoFromAdUserInfoID($ad["fk_ad_adUserInfo"]);
$adCategory = $dbh->getAdCategoryFromID($ad["fk_ad_adCategory"]);
$adSubCategory = $dbh->getAdSubCategoryFromAdCategoryID($ad["fk_ad_adCategory"]);
$dbh = null;

print_r($ad);
echo "<br />";
print_r($adInfo);
echo "<br />";
print_r($adUserInfo);
echo "<br />";
print_r($adCategory);
echo "<br />";
print_r($adSubCategory);

?>
</div>

				<div class="col-xs-12 categoryHeading" style="background-color: <?php echo $adCategory["color"]; ?>">
					<?php echo $ad["title"]; ?>
				</div>
				<div class="col-xs-12" style="width: 100%; min-height: 150px; background-color: #f4f4f4;">
					<div class="col-xs-12" style="background-color: #DCD9D4; color: #000; padding: 10px 10px;">
						<?php echo $ad["info"]; ?>
					</div>
						<div class="col-xs-8" style="background-color: #DCD9D4; color: #000; border-top: 1px solid #000; min-height: 70px;">
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
							<div style="background-color: #39b54a; font-size: 20px; text-align: center; margin-top: 10px; padding: 10px 0px;">
								Svara på annonsen
							</div>
							<span style="color: #000;">
								Anmäl denna annons <br />
								Ta bort annonsen
							</span>
						</div>
				</div>