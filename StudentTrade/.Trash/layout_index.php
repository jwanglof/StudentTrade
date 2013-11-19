		<div class='col-md-12 index top'>
			<div>
				<div id="far-clouds" class="stage"></div>
				<div id="near-clouds" class="stage"></div>
			</div>
			<div class='row'>
				<div class='col-md-6'>
					<a href="index.php" title="StudentTrade.se"><img src='StudentTrade/Img/studenttrade_logo.png' class='studenttrade_logo' /></a>
				</div>
				<div class='col-md-6 map'>
					<img src="StudentTrade/Img/map.png" />
					<?php
					$dbh = new DbSelect();
					$cities = $dbh->getCityIDs();

					foreach ($cities as $city) {
						$short_name = replaceSwedishLetters(strtolower($city["short_name"]));
						echo "<span class=\"". $short_name ."\"><a href=\"?page=city&city=". $short_name ."\">". $city["city_name"] ."</a></span>";

					}
					?>
				</div>
			</div>
			<div id='infoText'>
				<span class='info info1'>Har du en lägenhet att hyra ut?</span>
				<span class='info info2'>En oanvänd biljett liggandes hemma?</span>
				<span class='info info3'>Eller kurslitteratur som du vill bli av med?</span>
				<span class="what">StudentTrade.se erbjuder dig som student ett enkelt och smidigt sätt att köpa och sälja saker som kommer med studentlivet. Hos oss når du lätt andra studenter på ditt universitet.</span>
			</div>
			<img src="StudentTrade/Img/front_half_circle.png" class='front_half_circle' />	
		</div>

		<div class="index content">
			<div class="row">
				<div class="col-md-4 box">
					<h3>Helt gratis</h3>
					<p>Det kostar inget för dig</p>
					<img class="box1_img" src="StudentTrade/Img/circle_with_plus_sign.png" />
					<div class="box1" style="display: none;">
						En massa text
					</div>
				</div>
				<div class="col-md-4 middle">
					<h3>Snabbt och enkelt</h3>
					<p>Det ska vara lättåtkomligt och enkelt för dig</p>
					<img class="box2" src="StudentTrade/Img/circle_with_plus_sign.png" />
					<div class="box2" style="display: none;">
						En massa text
					</div>
				</div>
				<div class="col-md-4 box">
					<h3>Hitta det du söker</h3>
					<p>Det finns ett stort utbud</p>
					<img class="box3" src="StudentTrade/Img/circle_with_plus_sign.png" />
					<div class="box3" style="display: none;">
						En massa text
					</div>
				</div>
			</div>
		</div>
