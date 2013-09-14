<?php
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

// $a = new Mysql('localhost', 'jwanglof', 'testtest', 'jwanglof');
// $selected = $a->select($a, 'test', 'id=1');
// echo mysqli_num_rows($selected);
// $new_id = $a->insert($a, 'test', '(test, test2)', '(3322, 4432)');
// $a->update($a, 'test', 'test2=1', 'id='.$new_id);
// $a->close();
// 
?>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<title>StudentTrade.se</title>
		<!-- <link rel="stylesheet" type="text/css" href="Old/style.css" /> -->
		<link rel="stylesheet" type="text/css" href="StudentTrade/Css/bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="StudentTrade/Css/avgrund.css" />
		<link rel="stylesheet" type="text/css" href="StudentTrade/Css/style.css" />
		<link rel="shortcut icon" href="favicon.ico" />
		<?php if (!$_GET) { ?>
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
		<?php } ?>
	</head>
	<body>
		<div class='col-md-12 index top'>
			<?php include('StudentTrade/Views/switch.php'); ?>
		</div>

		<div class="col-md-12 index footer">
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
		<script src="StudentTrade/Scripts/jquery.avgrund.js" type="text/javascript"></script>
		<script src="StudentTrade/Scripts/scripts.js" type="text/javascript"></script>

		<?php if (!$_GET) { ?>
		<script type="text/javascript">
			$(document).ready(function() {
				$('#far-clouds').pan({fps: 30, speed: 0.7, dir: 'left', depth: 30});
				$('#near-clouds').pan({fps: 30, speed: 1, dir: 'right', depth: 70});
			});
		</script>
		<?php } ?>
	</body>
</html>