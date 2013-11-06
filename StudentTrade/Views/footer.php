<div class="col-xs-4">
				<ul>
					<li id="about_us">Om oss</li>
					<li id="how_it_works">Så fungerar det</li>
				</ul>
			</div>
			<div class="col-xs-4">
				<img src="StudentTrade/Img/studenttrade_logo_grey.png" />
			</div>
			<div class="col-xs-4">
				<ul>
					<li id="faq">Vanliga frågor</li>
					<li id="contact_us">Kontakta oss</li>
				</ul>
			</div>
			<p class="copyright">Copyright &copy2013 StudentTrade</p>

<div style="display: none;" id="contactUsDiv">
					<form method="post" action="front.php?page=mail&mail=contactUs" class="form-horizontal" role="form" id="contactUsForm">
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