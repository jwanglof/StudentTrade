<?php
header('Content-Type: text/html; charset=utf-8');
error_reporting(-1);
ini_set('display_errors', 1);
// Auto load the classes that are called
function __autoload($class_name) {
	//class directories
	$base_dir = 'StudentTrade/';
	$directorys = array(
		'Data/',
		'Db/',
		'Logic/',
		'Views'
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
		<link rel="stylesheet" type="text/css" href="StudentTrade/Css/style.css" />
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
				<div class='col-xs-6'>
					<a href="index.php" title="StudentTrade.se"><img src='StudentTrade/Img/studenttrade_logo.png' class='studenttrade_logo' /></a>
				</div>
				<div class='col-xs-6 map'>
					<img src="StudentTrade/Img/map.png" />
					<?php
					$dbh = new DbSelect();
					$cities = $dbh->getCityIDs();

					foreach ($cities as $city) {
						$short_name = replaceSwedishLetters(strtolower($city["short_name"]));
						echo "<span class=\"". $short_name ."\"><a href=\"front.php?page=latest&city=". $short_name ."\">". $city["city_name"] ."</a></span>";
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

		<div class="col-xs-12 index content">
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
		</div>

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