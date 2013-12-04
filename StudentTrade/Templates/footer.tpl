		<div class="col-xs-12 row footer">
			<div class="col-xs-4">
				<ul>
					<li id="about_us">Om oss</li>
					<li id="how_it_works">Så fungerar det</li>
				</ul>
			</div>
			<div class="col-xs-4">
				<img src="../Img/studenttrade_logo_grey.png" />
			</div>
			<div class="col-xs-4">
				<ul>
					<li id="faq">Vanliga frågor</li>
					<li data-toggle="modal" data-target="#contactUsModal" id="contact_us">Kontakta oss</li>
				</ul>
			</div>
			<p class="copyright">Copyright &copy2013 StudentTrade</p>
		</div>

		<div class="fade modal" id="contactUsModal" tabindex="-1" role="dialog" aria-labelledby="contactUsModal" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
						<h2>Kontakta oss</h2>
					</div>

					<div class="modal-body">
						<form method="post" class="form-horizontal" role="form" id="contactUsForm">
							<input type="hidden" id="mail" name="mail" value="contactUs" />
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
										<textarea class="form-control" name="message" id="message" rows="5" placeholder="Meddelande"></textarea>
									</div>
								</div>
							</fieldset>
						</form>

						<div class="modal-body-error"></div>
					</div>

					<div class="modal-footer">
						<img src="StudentTrade/Img/ajax-loader.gif" class="ajaxLoader" /> <button type="submit" form="contactUsForm" class="btn btn-primary">Skicka</button>
					</div>
				</div>
			</div>
		</div>
		
		<script src="../Scripts/jquery.min.js" type="text/javascript"></script>
		<script src="../Scripts/bootstrap.min.js" type="text/javascript"></script>
		<script src="../Scripts/bootbox.min.js" type="text/javascript"></script>
		<script src="../Scripts/jquery.validate.min.js" type="text/javascript"></script>
		<script src="../Scripts/scripts.js" type="text/javascript"></script>
		<script src="../Scripts/forms.js" type="text/javascript"></script>
	</body>
</html>