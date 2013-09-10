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
?>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<title>StudentTrade.se</title>
		<link rel="stylesheet" type="text/css" href="Old/style.css" />
		<link rel="stylesheet" type="text/css" href="StudentTrade/CSS/style.css" />
		<link rel="shortcut icon" href="favicon.ico" />
		<script type="text/javascript">
		function showstuff(boxid){
			document.getElementById(boxid).style.display="inline";
		}
		 
		function hidestuff(boxid){
			document.getElementById(boxid).style.display="none";
		}
		</script>
		<style type="text/css">
			.stage {
				position: absolute;
				top: 0;
				left: 0;
				width: 100%;
				min-width: 900px;
				height: 100%;
				overflow: hidden;
				z-index: -100;
			}
			.far-clouds {
				background: transparent url('StudentTrade/Img/far-clouds.png') 305px 52px repeat-x;
			}
			.near-clouds {
				background: transparent url('StudentTrade/Img/near-clouds.png') 305px 172px repeat-x;
			}
		</style>
	</head>
	<body>

		<div class="first">
			<div id="wrapper">
				<div id="backClouds">
					<div id="far-clouds" class="far-clouds stage"></div>
					<div id="near-clouds" class="near-clouds stage"></div>
				</div>

				<div id="firstHeader">
					<a href="index.php" class="logo" title="StudentTrade.se">StudentTrade.se</a>
					<div id='infoText'>
						<span class='info1'>Har du en lagenhet att hyra ut?</span>
						<span class='info2'>En oanvand biljett liggandes hemma?</span>
						<span class='info3'>Eller kurslitteratur som du vill bli av med?</span>

						<span class="what">StudentTrade.se erbjuder dig som student ett enkelt och smidigt sätt att köpa och sälja saker som kommer med studentlivet. Hos oss når du lätt andra studenter på ditt universitet.</span>
					</div>
					<img src="StudentTrade/Img/front_half_circle.png" />
				</div>

				<div id="mainMap">
					<img src="Old/img/map.png" width="330px">
					<span class="txt lnkpg" onMouseOver="showstuff('liu')" onMouseOut="hidestuff('liu')"><a href="Old/stad.php">Linköping</a></span>
					<span class="txt sthlm" onMouseOver="showstuff('sthlm')" onMouseOut="hidestuff('sthlm')">Stockholm</span>
					<span class="txt gbg" onMouseOver="showstuff('gbg')" onMouseOut="hidestuff('gbg')">Göteborg</span>
					<span class="txt lund" onMouseOver="showstuff('lund')" onMouseOut="hidestuff('lund')">Lund</span>
				</div>

				<div id="liu" class="univ"></div>
				<div id="sthlm" class="univ"></div>
				<div id="lund" class="univ"></div>
				<div id="gbg" class="univ"></div>	

				<section class="row feature-tenets-wrapper">
					<div class="wrapper">
						<div class="feature-tenet first-tenet col span-4">
							<h3>Helt gratis</h3>
							<p>Det kostar inget för dig</p>
							<div class="grower-wrapper">
								<div class="grower">
									<div class="smaller">
										<i><i></i></i>
									</div>
									<div class="larger">
										<img src="Old/img/ruta1.png" alt="Manage Expenses">
									</div>
								</div>
							</div>
						</div>
					
						<div class="feature-tenet first-tenet col span-4">
							<h3>Snabbt och enkelt</h3>
							<p>Det ska vara lättåtkomligt och enkelt för dig</p>
							<div class="grower-wrapper">
								<div class="grower">
									<div class="smaller">
										<i><i></i></i>
									</div>
									<div class="larger">
										<img src="Old/img/ruta2.png" alt="Grow Savings">
									</div>
								</div>
							</div>
						</div>

						<div class="feature-tenet first-tenet col span-4">
							<h3>Hitta det du söker!</h3>
							<p>Det finns ett stort utbud</p>
							<div class="grower-wrapper">
								<div class="grower">
									<div class="smaller">
										<i><i></i></i>
									</div>
									<div class="larger">
										<img src="Old/img/ruta3.png" alt="Receive Guidance">
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>
				
				<footer class="start">
					<div class="nav">
							<ul class="left">
								<li>Om oss</li>
								<li>Så fungerar det</li>
							</ul>
							<img src="Old/img/greyLogo.png">
							<ul class="right">
								<li><a href="faq.html">Vanliga frågor</a></li>
								<li>Kontakta oss</li>
							</ul>
					</div>
					<p class="copyright">Copyright &copy 2013 StudentTrade</p>
				</footer>
				
			</div>
		</div>

		<script src="StudentTrade/Scripts/jquery-1.10.2.min.js" type="text/javascript"></script>
		<script src="StudentTrade/Scripts/jquery.spritely.js" type="text/javascript"></script>

		<script type="text/javascript">
			$(document).ready(function() {
				$('#far-clouds').pan({fps: 30, speed: 0.7, dir: 'left', depth: 30});
				$('#near-clouds').pan({fps: 30, speed: 1, dir: 'left', depth: 70});
			});    
		</script>
	</body>
</html>