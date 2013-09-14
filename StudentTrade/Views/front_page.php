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
						$short_name = removeSwedishLetters(strtolower($city["short_name"]));
						echo "<span class=\"". $short_name ."\"><a href=\"?page=city&city=". $short_name ."\">". $city["city_name"] ."</a></span>";

					}
					?>
				</div>
			</div>
			<div id='infoText'>
				<span class='info1'>Har du en lägenhet att hyra ut?</span>
				<span class='info2'>En oanvänd biljett liggandes hemma?</span>
				<span class='info3'>Eller kurslitteratur som du vill bli av med?</span>
				<span class="what">StudentTrade.se erbjuder dig som student ett enkelt och smidigt sätt att köpa och sälja saker som kommer med studentlivet. Hos oss når du lätt andra studenter på ditt universitet.</span>
			</div>
			<img src="StudentTrade/Img/front_half_circle.png" class='front_half_circle' />	
		</div>

		<div class="col-md-12 index content">
			<div class="row">
				<div class="col-md-4 box box_image">
					<h3>Helt gratis</h3>
					<p>Det kostar inget för dig</p>
					<!-- <div class="grower-wrapper">
						<div class="grower">
							<div class="smaller">
								<i><i></i></i>
							</div>
							<div class="larger">
								<img src="Old/img/ruta1.png" alt="Manage Expenses">
							</div>
						</div>
					</div> -->
				</div>
				<div class="col-md-4 middle box_image">
					<h3>Snabbt och enkelt</h3>
					<p>Det ska vara lättåtkomligt och enkelt för dig</p>
					<!-- <div class="grower-wrapper">
						<div class="grower">
							<div class="smaller">
								<i><i></i></i>
							</div>
							<div class="larger">
								<img src="Old/img/ruta2.png" alt="Grow Savings">
							</div>
						</div>
					</div> -->
				</div>
				<div class="col-md-4 box box_image">
					<h3>Hitta det du söker</h3>
					<p>Det finns ett stort utbud</p>
					<!-- <div class="grower-wrapper">
						<div class="grower">
							<div class="smaller">
								<i><i></i></i>
							</div>
							<div class="larger">
								<img src="Old/img/ruta3.png" alt="Receive Guidance">
							</div>
						</div>
					</div> -->
				</div>
			</div>
