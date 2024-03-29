<?php
$dbh = new DbSelect();
$ad = $dbh->getAdFromID($_GET["aid"]);

if (!empty($ad)) {
	$adInfo = $dbh->getAdInfoFromAdID($ad["id"]);
	$adUserInfo = $dbh->getAdUserInfoFromAdUserInfoID($ad["id"]);
	$adCategory = $dbh->getAdCategoryFromID($ad["fk_ad_adCategory"]);
	$adSubCategory = $dbh->getAdSubCategoryFromAdCategoryID($ad["fk_ad_adCategory"]);
	$adType = $dbh->getAdTypeFromAdTypeID($ad["fk_ad_adType"]);

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
							<?php echo date_format(date_create($ad["date_created"]), "H:i:s"); ?>
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

					<hr />

					<div data-toggle="modal" data-target="#adReplyModal" id="adAnswer">Svara på annonsen</div>

					<div class="row">
						<div class="col-xs-6" data-toggle="modal" data-target="#adReportModal" id="adReport">Anmäl denna annons</div>
						<div class="col-xs-6" data-toggle="modal" data-target="#adDeleteModal" id="adDelete">Ta bort annonsen</div>
					</div>
					
					<div class="row" style="margin-top: 30px;">
						<div class="col-xs-7">
							<h4>Få större spridning på sociala medier</h4>
						</div>
						<div class="col-xs-5"><hr /></div>
					</div>

					<div class="row">
						<div class="col-xs-6">
							Välj att dela med dig av din annons på sociala medier. Någon i din vänskapskrets kanske är intresserad.
						</div>
						<div class="col-xs-6">
							<div class="col-xs-6">
								<div class="fb-share-button" data-href="<?php echo "http://". $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>" data-type="button_count"></div>
							</div>
							<div class="col-xs-6">
								<a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo "http://". $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>" data-via="StudentTrade" data-lang="sv" data-hashtags="annonssäljesköpstudenttrade">Tweeta</a>
							</div>
						</div>
					</div>
				</div>

				<div class="fade modal" id="adDeleteModal" tabindex="-1" role="dialog" aria-labelledby="adDeleteModal" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
								<h2>Ange den borttagningskod som du fått via e-post</h2>
							</div>

							<div class="modal-body">
								<form class="form-horizontal well" data-target="#adDeleteModal" method="post" id="adDeleteForm">
									<input type="hidden" id="update" name="update" value="adActive" />
									<input type="hidden" id="aid" name="aid" value="<?php echo $_GET["aid"]; ?>" />
									<input type="hidden" id="code" name="code" value="<?php echo $ad["password"]; ?>" />
									<fieldset>
										<div class="form-group">
											<label for="removeCode" class="col-lg-1 control-label">Borttagningskod *</label>
											<div class="col-lg-5">
												<input type="text" class="form-control" id="removeCode" name="removeCode" placeholder="Borttagningskod" />
											</div>
										</div>
									</fieldset>
								</form>

								<div class="modal-body-error"></div>
							</div>

							<div class="modal-footer">
								<button type="submit" class="btn btn-primary" id="forgotCode">Glömt koden? Tryck här!</button>
								<img src="StudentTrade/Img/ajax-loader.gif" class="ajaxLoader" /> <button type="submit" form="adDeleteForm" class="btn btn-primary">Ta bort annons</button>
							</div>
						</div>
					</div>
				</div>

				<div class="fade modal" id="adReplyModal" tabindex="-1" role="dialog" aria-labelledby="adReplyModal" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
								<h2>Svara på annons</h2>
							</div>

							<div class="modal-body">
								<form method="post" class="form-horizontal" role="form" id="adReplyForm">
									<input type="hidden" id="mail" name="mail" value="adReply" />
									<input type="hidden" id="aid" name="aid" value="<?php echo $_GET["aid"]; ?>" />
									<input type="hidden" id="city" name="city" value="<?php echo $_GET["city"]; ?>" />

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
									</fieldset>
								</form>

								<div class="modal-body-error"></div>
							</div>

							<div class="modal-footer">
								<img src="StudentTrade/Img/ajax-loader.gif" class="ajaxLoader" /> <button type="submit" form="adReplyForm" class="btn btn-primary">Skicka meddelandet</button>
							</div>
						</div>
					</div>
				</div>

				<div class="fade modal" id="adReportModal" tabindex="-1" role="dialog" aria-labelledby="adReportModal" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
								<h2>Anmäl annons</h2>
							</div>

							<div class="modal-body">
								<form method="post" class="form-horizontal" role="form" id="adReportForm">
									<input type="hidden" id="mail" name="mail" value="adReport" />
									<input type="hidden" id="aid" name="aid" value="<?php echo $_GET["aid"]; ?>" />

									<fieldset>
										<div class="form-group">
											<label for="message" class="col-lg-1 control-label">Varför anmäler du denna annons? *</label>
											<div class="col-lg-5">
												<textarea class="form-control" name="message" id="message" rows="5"></textarea>
											</div>
										</div>
									</fieldset>
								</form>

								<div class="modal-body-error"></div>
							</div>

							<div class="modal-footer">
								<img src="StudentTrade/Img/ajax-loader.gif" class="ajaxLoader" /> <button type="submit" form="adReportForm" class="btn btn-primary">Skicka anmälan</button>
							</div>
						</div>
					</div>
				</div>
<?php
} else {
	echo "<h2>Denna annons finns inte!</h2>";
}
$dbh = null;
?>