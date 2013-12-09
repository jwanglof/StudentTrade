{% extends 'layout.tpl' %}

{% block page_title %}En köp- och säljsajt för studenter{% endblock %}

{% block add_css %}
<link rel="stylesheet" type="text/css" href="Css/style_index.css" />
<link rel="stylesheet" type="text/css" href="Css/style_footer.css" />
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
{% endblock %}

{% block add_scripts %}
<script type="text/javascript">
	$(document).ready(function() {
		$("#far-clouds").pan({fps: 30, speed: 0.7, dir: "left", depth: 30});
		$("#near-clouds").pan({fps: 30, speed: 1, dir: "right", depth: 70});
	});
</script>
{% endblock %}

{% block content %}
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
									<?php
									foreach ($leftColumn as $value) {
										$short_name = replaceSwedishLetters(strtolower($value["short_name"]));
										echo "<li><a href=\"Logic/front.php?city=". $short_name ."\">". $value["city_name"] ."</a></li>";
									}
									?>
								</ul>
								<ul class="list-unstyled col-xs-6">
									<?php
									foreach ($rightColumn as $value) {
										$short_name = replaceSwedishLetters(strtolower($value["short_name"]));
										echo "<li><a href=\"Logic/front.php?city=". $short_name ."\">". $value["city_name"] ."</a></li>";
									}
									?>
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
{% endblock %}