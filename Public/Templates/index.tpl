<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<title>StudentTrade.se - En Köp- och Sälj sajt för studenter</title>
		<link rel="stylesheet" type="text/css" href="Css/bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="Css/non-responsive.css" />
		<link rel="stylesheet" type="text/css" href="Css/style_index.css" />
		<link rel="stylesheet" type="text/css" href="Css/style_footer.css" />
		<link rel="shortcut icon" href="favicon.ico" />
		<link href="http://fonts.googleapis.com/css?family=Lato:400,700,900|Gochi+Hand" rel="stylesheet" type="text/css">
		<style type="text/css">
			.stage {
				position: absolute;
				top: 0;
				left: 0;
				width: 100%;
				height: 100%;
				overflow: hidden;
				z-index: -100;
			}
			#far-clouds {
				background: transparent url("Img/far-clouds.png") 305px 52px repeat-x;
			}
			#near-clouds {
				background: transparent url("Img/near-clouds.png") 305px 172px repeat-x;
			}
		</style>
	</head>
	<body>
		<div class="fade modal" id="requestCityModal" tabindex="-1" role="dialog" aria-labelledby="requestCityModal" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
						<h2>Förfråga att lägga till stad</h2>
					</div>

					<div class="modal-body">
						<form class="form-horizontal well" data-async data-target="#requestCityModal" method="post" id="requestCityForm">
							<input type="hidden" id="mail" name="mail" value="requestCity" />
							<fieldset>
								<div class="form-group">
									<label for="city_name" class="col-lg-1 control-label">Stadnamn *</label>
									<div class="col-lg-5">
										<input type="text" class="form-control" id="city_name" name="city_name" placeholder="Stadsnamn" />
									</div>
								</div>
							</fieldset>
						</form>
					</div>

					<div class="modal-footer">
						<button type="submit" form="requestCityForm" class="btn btn-primary">Skicka förfrågan</button>
					</div>
				</div>
			</div>
		</div>

		<div class="container">
			<div class="col-xs-12 top row">
				<noscript><h2>Vi ser att du inte har JavaScript aktiverat. Då StudentTrade.se använder väldigt mycket JavaScript ber vi därför dig att aktivera det för att kunna använda StudentTrade.se!</h2></noscript>
				<div id="far-clouds" class="stage"></div>
				<div id="near-clouds" class="stage"></div>

				<div class="row">
					<div class="col-xs-6 col-xs-offset-3">
						<img src="Img/studenttrade_logo.png" class="studenttrade_logo" />
					</div>
				</div>

				<div class="row">
					<div class="col-xs-4" id="infoText">
						<span class="info info1">KÖP OCH SÄLJ BEGAGNAD KURSLITTERATUR</span>
						<span class="info info2">HITTA OCH HYR UT STUDENTBOSTAD</span>
						<span class="info info3">CYKLAR, MÖBLER, BILJETTER OCH MYCKET MER</span>
					</div>
					<div class="col-xs-4" id="selectCity">
						<ul id="multicol-menu" class="btn-group list-unstyled">
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">Välj din stad <b class="caret whiteCaret"></b></a>
								<ul class="dropdown-menu" style="margin-top: 15px; width: 395px;">
									<li>
										<div class="row">
											<ul class="list-unstyled col-xs-6">
												{% for lefty in leftColumn %}
													<li><a href="index.php/city/{{ lefty.short_name }}">{{ lefty.city_name }}</li>
												{% endfor %}
											</ul>
											<ul class="list-unstyled col-xs-6">
												{% for righty in rightColumn %}
													<li><a href="index.php/city/{{ righty.short_name }}">{{ righty.city_name }}</li>
												{% endfor %}
											</ul>
										</div>
									</li>
								</ul>
							</li>
						</ul> <!-- End of dropdown -->
						<div>Saknar du din stad? <a data-toggle="modal" href="#requestCityModal">Klicka då här!</a></div>
					</div>
				</div>
			</div>

			<div class="content">
				<ul id="hover-img">
					<li class="col-xs-4">
						<div class="thumbnail">
							<div class="caption">
								<h3>Helt gratis</h3>
								Vi vet att ekonomin kan vara knapp som student. Många utekvällar och fredagspizzor äter snabbt upp CSN. Så varför betala 50kr för att lägga upp en annons någon annanstans när du kan göra det gratis hos oss? Hos oss visas bara relevanta annonser – från student till student.
							</div>
							<div class="caption-btm">
								<h3>Helt gratis</h3>
								Det kostar ingenting för dig <br />
								<img src="Img/circle_with_plus_sign.png" />
							</div>
						</div>
					</li>
					<li class="col-xs-4">
						<div class="thumbnail">
							<div class="caption">
								<h3>Snabbt och enkelt</h3>
								Hos oss är det enkelt att lägga upp en annons. Välj din studentstad och klicka på ”Lägg upp annons”. Annonsen kommer direkt upp i flödet och kan lätt hittas av sökande.
							</div>
							<div class="caption-btm">
								<h3>Snabbt och enkelt</h3>
								Det ska vara lättåtkomligt och enkelt för dig <br />
								<img src="Img/circle_with_plus_sign.png" />
							</div>
						</div>
					</li>
					<li class="col-xs-4">
						<div class="thumbnail">
							<div class="caption">
								<h3>Hitta det du söker</h3>
								Söker du en studentbostad eller kanske kurslitteratur till en ny kurs. Kolla alltid hos oss först. Hos oss hittar du alltid annonser från studenter från just ditt universitet vilket gör kontakten lätt – bara att träffas på t.ex. lunchen i skolan.
							</div>
							<div class="caption-btm">
								<h3>Hitta det du söker</h3>
								Det finns ett stort utbud <br />
								<img src="Img/circle_with_plus_sign.png" />
							</div>
						</div>
					</li>
				</ul>
			</div>

					<div class="col-xs-12 row footer">
			<div class="col-xs-4">
				<ul>
					<li data-toggle="modal" data-target="#aboutUsModal">Om oss</li>
					<li data-toggle="modal" data-target="#howItWorksModal">Så fungerar det</li>
				</ul>
			</div>
			<div class="col-xs-4">
				<img src="Img/studenttrade_logo_grey.png" />
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
		</div>

		<script src="Scripts/jquery.min.js" type="text/javascript"></script>
		<script src="Scripts/jquery.spritely.js" type="text/javascript"></script>
		<script src="Scripts/bootstrap.min.js" type="text/javascript"></script>
		<script src="Scripts/bootbox.min.js" type="text/javascript"></script>
		<script src="Scripts/jquery.validate.min.js" type="text/javascript"></script>
		<script src="Scripts/scripts.js" type="text/javascript"></script>
		<script src="Scripts/forms.js" type="text/javascript"></script>

		<script type="text/javascript">
			$(document).ready(function() {
				$("#far-clouds").pan({fps: 30, speed: 0.7, dir: "left", depth: 30});
				$("#near-clouds").pan({fps: 30, speed: 1, dir: "right", depth: 70});
			});
		</script>
	</body>
</html>