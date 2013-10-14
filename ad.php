<?php
session_start();
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
if (!isset($_SESSION["sessProtector"])) {
	$_SESSION["sessProtector"] = session_id();
	session_write_close();
}

$dbh = new DbSelect();

$city = (isset($_GET['city']) ? $dbh->getCity($_GET['city']) : $dbh->getCity("linkoping"));
$universities = $dbh->getUniversitiesFromCityID($city["id"]);
$campuses = [];
foreach ($universities as $uni) {
	array_push($campuses, $dbh->getCampusFromUniversityID($uni["id"]));
}

$adtypes = $dbh->getAdTypes();
$cityID = $city["id"];
?>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<title>StudentTrade.se</title>
		<link rel="stylesheet" type="text/css" href="StudentTrade/Css/bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="StudentTrade/Css/avgrund.css" />
		<link rel="stylesheet" type="text/css" href="StudentTrade/Css/style.css" />

		<link href='http://fonts.googleapis.com/css?family=Lato:400,700,900' rel='stylesheet' type='text/css'>

		<link rel="shortcut icon" href="favicon.ico" />
	</head>
	<body>
		<div class='col-xs-12 ad top'>
			<!--  style="border: 0px solid #000; height: 100px; margin-top: 20px; float: right;" -->
			<div class="col-xs-6 col-md-offset-6" id="campusChooser">
				<div class="btn-group btn-group-justified">
					<a href="ad.php?page=latest&city=<?php echo $city["short_name"]; ?>" class="btn btn-info">Se <?php echo $city["city_name"]; ?></a>
				<?php
				foreach ($campuses as $cam) {
					foreach ($cam as $c) {
						if (isset($_GET["campus"]) && compareString($_GET["campus"], $c["campus_name"])) {
							echo generateCampusURL($city["short_name"], $c["campus_name"],
								(isset($_GET["type"]) ? $_GET["type"] : NULL),
								False);
						} else {
							echo generateCampusURL($city["short_name"], $c["campus_name"],
								(isset($_GET["type"]) ? $_GET["type"] : NULL));
						}
					}
				}
				?>
				</div>
			</div>

			<!-- <div class="row" style="border: 1px solid #000; height: 147px;">
				<div class="col-xs-6">
					<img src="StudentTrade/Img/studenttrade_logo_wo_text.png" />
				</div>
				<div class="col-xs-6">
					<img src="StudentTrade/Img/far-clouds_small.png" />
				</div>
			</div> -->
			<!-- <div class="col-xs-12" style="border: 1px solid #000; background: #000 url("StudentTrade/Img/far-clouds_small.png"); height: 200px; width: 200px;">
			qwd
			</div> -->

			<div class="col-xs-8" id="categories">
				<?php
				// generateAdURL($page, $city, $nameOnUrl, $campus=NULL, $type=NULL)
				foreach ($adtypes as $type) {
					echo "<span style=\"background-color: ". $type["color"] ."\">";
					echo generateAdURL("latest", $city["short_name"],
								((isset($_GET["type"]) && $_GET["type"] == $type["name"]) ? ">". $type["description"] : $type["description"]),
								(isset($_GET["campus"]) ? $_GET["campus"] : NULL),
								$type["name"]);
					echo "</span>";
				}
				echo "<span class=\"categoryViewAll\">";
				echo generateAdURL("latest", $city["short_name"], "Visa alla",
								(isset($_GET["campus"]) ? $_GET["campus"] : NULL));
				echo "</span>";
				?>
			</div>

			<div class="col-xs-4 addNew">
				<?php
				echo "<span>";
				echo generateAdURL("ad_new", $city["short_name"], "Lägg till annons",
								(isset($_GET["campus"]) ? $_GET["campus"] : NULL),
								(isset($_GET["type"]) ? $_GET["type"] : NULL));
				echo "</span>";
				?>
			</div>
		</div>

		<div class="ads content">
			<div class="row">
				<div class="col-xs-8">
					<?php include_once('StudentTrade/Views/switch.php'); ?>
				</div>
				<div class="col-xs-4 rightColumn">
					Annonser
				</div>
			</div>
		</div>

		<div class="col-xs-12 index footer">
			<?php include_once("StudentTrade/Views/footer.php"); ?>
		</div>

		<script src="StudentTrade/Scripts/jquery-1.10.2.min.js" type="text/javascript"></script>
		<script src="StudentTrade/Scripts/bootstrap.min.js" type="text/javascript"></script>
		<script src="StudentTrade/Scripts/bootbox.min.js" type="text/javascript"></script>
		<script src="StudentTrade/Scripts/scripts.js" type="text/javascript"></script>
	</body>
</html>