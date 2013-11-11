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
				<div id="fb-root"></div>
				<script type="text/javascript">
					(function(d, s, id) {
						var js, fjs = d.getElementsByTagName(s)[0];
						if (d.getElementById(id)) return;
						js = d.createElement(s); js.id = id;
						js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
						fjs.parentNode.insertBefore(js, fjs);
					}(document, 'script', 'facebook-jssdk'));
				</script>

				<script type="text/javascript">
					!function(d,s,id){
						var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';
						if(!d.getElementById(id)){
							js=d.createElement(s);
							js.id=id;
							js.src=p+'://platform.twitter.com/widgets.js';
							fjs.parentNode.insertBefore(js,fjs);
						}
					}(document, 'script', 'twitter-wjs');
				</script>
				<div class="col-xs-3">
					<p style="width: 100%; height: 200px; background-color: <?php echo $adCategory["color"]; ?>" class="categoryIcon icon <?php echo $adCategory["name"]; ?>"></p>
					<p style="width: 100%; height: 30px; font-size: 1.35em; text-align: center;" class="adType <?php echo $adType["short_name"]; ?>"><?php echo $adType["name"]; ?></p>
					<p>
						Pris:
						<br />
						<span class="adShowInfo"><?php echo $ad["price"]; ?> SEK</span>
					</p>
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
					<p>
					<?php
					foreach ($adInfo as $info) {
						foreach ($adSubCategory as $subCategory) {
							if ($info["fk_adInfo_adSubCategory"] == $subCategory["id"]) {
								echo $subCategory["name"] .":<br /><span class=\"adShowInfo\">". $info["sub_category_value"] ."</span><br />";
							}
						}
					}
					?>
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

					<div class="row">
						<div class="col-xs-6">
							Välj att dela med dig av din annons på sociala medier. Någon i din vänskapskrets kanske är intresserad.
						</div>
						<div class="col-xs-6" style="text-align: right;">
							<div class="fb-share-button" data-href="<?php echo "http://". $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>" data-type="button_count"></div>
							<a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo "http://". $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>" data-via="StudentTrade" data-lang="sv" data-hashtags="annonssäljesköpstudenttrade">Tweeta</a>
						</div>
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