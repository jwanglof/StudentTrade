		<div class="col-xs-12 row footer">
			<div class="col-xs-4">
				<ul>
					<li data-toggle="modal" data-target="#aboutUsModal">Om oss</li>
					<li data-toggle="modal" data-target="#howItWorksModal">Så fungerar det</li>
				</ul>
			</div>
			<div class="col-xs-4">
				<img src="../Img/studenttrade_logo_grey.png" />
			</div>
			<div class="col-xs-4">
				<ul>
					<li data-toggle="modal" data-target="#faqModal">Vanliga frågor</li>
					<li data-toggle="modal" data-target="#contactUsModal" id="contact_us">Kontakta oss</li>
				</ul>
			</div>
			<p class="copyright">Copyright &copy2013 StudentTrade</p>
		</div>

		<div class="fade modal" id="aboutUsModal" tabindex="-1" role="dialog" aria-labelledby="aboutUsModal" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
						<h2>Om oss</h2>
					</div>

					<div class="modal-body">
						StudentTrade.se är en köp- och säljsajt av studenter för studenter. Hos oss kan du köpa och sälja saker som har studentlivet till. StudentTrade.se startades hösten 2013 av tre studenter på Linköpings Universitet.
					</div>
				</div>
			</div>
		</div>

		<div class="fade modal" id="howItWorksModal" tabindex="-1" role="dialog" aria-labelledby="howItWorksModal" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
						<h2>Så fungerar det</h2>
					</div>

					<div class="modal-body">
						Hos oss är det lätt att både lägga upp annons och att hitta det du söker. Börja med att välja din studentstad på startsidan. Väl inne på sidan kan du sedan lätt sortera annonserna efter kategori och lägga upp annons genom att klicka på ”Lägg upp annons”. Annonsen kommer direkt upp i flödet och blir tillgänlig för andra studenter.
					</div>
				</div>
			</div>
		</div>

		<div class="fade modal" id="faqModal" tabindex="-1" role="dialog" aria-labelledby="faqModal" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
						<h2>Vanliga frågor och svar</h2>
					</div>

					<div class="modal-body">
						<h4>Kostar det något att lägga upp en annons?</h4>
						Nej, tillskillnad från andra säljsajter är det helt gratis att lägga upp en annons hos oss. Vi är också studenter och tycker inte man ska betala för att lägga upp en annons.
						
						<h4>Hur tar jag bort min annons?</h4>
						När du lägger upp din annons får du en fyrsiffrig kod till den e-mail adress du angett. Om du vill ta bort din annons går du in på den, klickar på ”Ta bort annons” och anger din kod. Snabbt och enkelt!

						<h4>Vad gör jag om jag tycker att en annons är olämplig?</h4>
						Om du ser en annons som du inte tycker är olämplig kan du anmäla den till oss. Vi ser då om den bryter mot ”Regler kring annonsering” och beslutar med detta som grund om hurvida annonser ska bli borttagen eller inte. Om du vill veta vilka regler som gäller kring annonsering så hittar du det <a href="rules.php?city=<?php echo $_GET["city"]; ?>" style="color: #565656;text-decoration: underline">här</a>.
					</div>
				</div>
			</div>
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
						<img src="../Img/ajax-loader.gif" class="ajaxLoader" /> <button type="submit" form="contactUsForm" class="btn btn-primary">Skicka</button>
					</div>
				</div>
			</div>
		</div>
		
		<script src="../Scripts/jquery.min.js" type="text/javascript"></script>
		<script src="../Scripts/bootstrap.min.js" type="text/javascript"></script>
		<script src="../Scripts/bootbox.min.js" type="text/javascript"></script>
		<script src="../Scripts/jquery.validate.min.js" type="text/javascript"></script>
		<script src="../Scripts/ad_new.js" type="text/javascript"></script>
		<script src="../Scripts/scripts.js" type="text/javascript"></script>
		<script src="../Scripts/forms.js" type="text/javascript"></script>
	</body>
</html>