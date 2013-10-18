<?php
header('Content-Type: text/html; charset=utf-8');
error_reporting(-1);
ini_set('display_errors', 1);
// Auto load the classes that are called
function __autoload($class_name) {
	//class directories
	$base_dir = 'StudentTrade/';
	$directorys = array(
		'Db/'
	);
	//for each directory
	foreach($directorys as $directory)
	{
		//see if the file exsists
		if(file_exists($base_dir.$directory.$class_name . '.php'))
		{
			require_once($base_dir.$directory.$class_name . '.php');
			//only require the class once, so quit after to save effort (if you got more, then name them something else 
			return;
		}            
	}
}
require_once("StudentTrade/Db/functions.php");
?>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<title>StudentTrade.se</title>
		<link rel="stylesheet" type="text/css" href="StudentTrade/Css/bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="StudentTrade/Css/avgrund.css" />
		<link rel="stylesheet" type="text/css" href="StudentTrade/Css/style_index.css" />
		<link rel="stylesheet" type="text/css" href="StudentTrade/Css/style_footer.css" />
		<link rel="shortcut icon" href="favicon.ico" />
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
				background: transparent url('StudentTrade/Img/far-clouds.png') 305px 52px repeat-x;
			}
			#near-clouds {
				background: transparent url('StudentTrade/Img/near-clouds.png') 305px 172px repeat-x;
			}
		</style>
	</head>
	<body>
		<div class='col-xs-12 index top'>
			<div>
				<div id="far-clouds" class="stage"></div>
				<div id="near-clouds" class="stage"></div>
			</div>
			<div class='row'>
				<div class='col-xs-8'>
					<a href="index.php" title="StudentTrade.se"><img src='StudentTrade/Img/studenttrade_logo.png' class='studenttrade_logo' /></a>
				</div>
				<div class='col-xs-4' id="map">
					<img src="StudentTrade/Img/map.png" />
					<?php
					$dbh = new DbSelect();
					$cities = $dbh->getCityIDs();

					foreach ($cities as $city) {
						$short_name = replaceSwedishLetters(strtolower($city["short_name"]));
						echo "<span class=\"". $short_name ."\"><a href=\"front.php?page=latest&city=". $short_name ."\">". $city["city_name"] ."</a></span>";
					}
					$dbh = null;
					?>
				</div>
			</div>
			<div id='infoText'>
				<span class='info info1'>Har du en lägenhet att hyra ut?</span>
				<span class='info info2'>En oanvänd biljett liggandes hemma?</span>
				<span class='info info3'>Eller kurslitteratur som du vill bli av med?</span>
				<span class="what">
					StudentTrade erbjuder dig som student ett enkelt och smidigt sätt att köpa och sälja saker som kommer med stundentlivet. Här hittar du kurslitteratur, evenemangsbiljetter, hyra/hyra ut bostäder och mycket mer.
					<br />
					Vi erbjuder dig som student en lättillgänglig annonsplats på lokal nivå. Hos oss kommer du lätt i kontakt med andra studenter på ditt universitet. Lägg bara upp en annons där du berättar vad du söker eller vill bli av med – helt gratis dessutom.
				</span>
			</div>
			<img src="StudentTrade/Img/front_half_circle.png" class='front_half_circle' />	
		</div>

		<div class="index content">
			<ul id="hover-img">
				<li class="col-xs-4">
					<div class="thumbnail">
						<div class="caption">
							Vi vet att ekonomin kan vara knapp som student. Många utekvällar och fredagspizzor äter snabbt upp CSN. Så varför betala 50kr för att lägga upp en annons någon annanstans när du kan göra det gratis hos oss? Hos oss visas bara relevanta annonser – från student till student.
						</div>
						<div class="caption-btm">
							<h3>Helt gratis</h3>
							Det kostar ingenting för dig <br />
							<img src="StudentTrade/Img/circle_with_plus_sign.png" />
						</div>
					</div>
				</li>
				<li class="col-xs-4">
					<div class="thumbnail">
						<div class="caption">
							Hos oss är det enkelt att lägga upp en annons. Välj din studentstad och klicka på ”Lägg upp annons”. Annonsen kommer direkt upp i flödet och kan lätt hittas av sökande.
						</div>
						<div class="caption-btm">
							<h3>Snabbt och enkelt</h3>
							Det ska vara lättåtkomligt och enkelt för dig <br />
							<img src="StudentTrade/Img/circle_with_plus_sign.png" />
						</div>
					</div>
				</li>
				<li class="col-xs-4">
					<div class="thumbnail">
						<div class="caption">
							Söker du en studentbostad eller kanske kurslitteratur till en ny kurs. Kolla alltid hos oss först. Hos oss hittar du alltid annonser från studenter från just ditt universitet vilket gör kontakten lätt – bara att träffas på lunchen i skolan.
						</div>
						<div class="caption-btm">
							<h3>Hitta det du söker</h3>
							Det finns ett stort utbud <br />
							<img src="StudentTrade/Img/circle_with_plus_sign.png" />
						</div>
					</div>
				</li>
			</ul>
		</div>

		<!-- <div class="index content">
			<div class="row">
				<div class="col-xs-4 box">
					<h3>Helt gratis</h3>
					<p>Det kostar inget för dig</p>
					<img class="box1_img" src="StudentTrade/Img/circle_with_plus_sign.png" />
					<div class="box1" style="display: none;">
						En massa text
					</div>
				</div>
				<div class="col-xs-4 middle">
					<h3>Snabbt och enkelt</h3>
					<p>Det ska vara lättåtkomligt och enkelt för dig</p>
					<img class="box2" src="StudentTrade/Img/circle_with_plus_sign.png" />
					<div class="box2" style="display: none;">
						En massa text
					</div>
				</div>
				<div class="col-xs-4 box">
					<h3>Hitta det du söker</h3>
					<p>Det finns ett stort utbud</p>
					<img class="box3" src="StudentTrade/Img/circle_with_plus_sign.png" />
					<div class="box3" style="display: none;">
						En massa text
					</div>
				</div>
			</div>
		</div> -->

		<div class="col-xs-12 index footer">
			<?php include_once("StudentTrade/Views/footer.php"); ?>
		</div>

		<script src="StudentTrade/Scripts/jquery-1.10.2.min.js" type="text/javascript"></script>
		<script src="StudentTrade/Scripts/jquery.spritely.js" type="text/javascript"></script>
		<script src="StudentTrade/Scripts/bootstrap.min.js" type="text/javascript"></script>
		<script src="StudentTrade/Scripts/bootbox.min.js" type="text/javascript"></script>
		<script src="StudentTrade/Scripts/scripts.js" type="text/javascript"></script>

		<script type="text/javascript">
			$(document).ready(function() {
				$('#far-clouds').pan({fps: 30, speed: 0.7, dir: 'left', depth: 30});
				$('#near-clouds').pan({fps: 30, speed: 1, dir: 'right', depth: 70});
			});
		</script>
	</body>
</html>