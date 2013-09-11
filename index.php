<?php
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

// $a = new Mysql('localhost', 'jwanglof', 'testtest', 'jwanglof');
// $selected = $a->select($a, 'test', 'id=1');
// echo mysqli_num_rows($selected);
// $new_id = $a->insert($a, 'test', '(test, test2)', '(3322, 4432)');
// $a->update($a, 'test', 'test2=1', 'id='.$new_id);
// $a->close();
// <?php include('StudentTrade/Views/switch.php'); 
?>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<title>StudentTrade.se</title>
		<!-- <link rel="stylesheet" type="text/css" href="Old/style.css" /> -->
		<link rel="stylesheet" type="text/css" href="StudentTrade/CSS/bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="StudentTrade/CSS/style.css" />
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

					<span class="linkoping"><a href="#">Linköping</a></span>
					<span class="sthlm"><a href="#">Stockholm</a></span>
					<span class="gbg"><a href="#">Göteborg</a></span>
					<span class="lund"><a href="#">Lund</a></span>
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
		</div>

		<div class="col-md-12 index footer">
			<div class="ow-overlay ow-closed" id="overlay_text"></div>
			<div class="modal ow-closed"></div>

			<div class="col-md-4">
				<ul>
					<li id="about_us">Om oss</li>
					<li id="how_it_works">Så fungerar det</li>
				</ul>
			</div>
			<div class="col-md-4">
				<img src="StudentTrade/Img/studenttrade_logo_grey.png" />
			</div>
			<div class="col-md-4">
				<ul>
					<li id="faq">Vanliga frågor</li>
					<li id="contact_us">Kontakta oss</li>
				</ul>
			</div>
			<p class="copyright">Copyright &copy2013 StudentTrade</p>
		</div>

		<script src="StudentTrade/Scripts/jquery-1.10.2.min.js" type="text/javascript"></script>
		<script src="StudentTrade/Scripts/jquery.spritely.js" type="text/javascript"></script>
		<script src="StudentTrade/Scripts/jquery.omniwindow.js" type="text/javascript"></script>
		<script src="StudentTrade/Scripts/scripts.js" type="text/javascript"></script>

		<script type="text/javascript">
			$(document).ready(function() {
				$('#far-clouds').pan({fps: 30, speed: 0.7, dir: 'left', depth: 30});
				$('#near-clouds').pan({fps: 30, speed: 1, dir: 'right', depth: 70});
			});    
		</script>
	</body>
</html>