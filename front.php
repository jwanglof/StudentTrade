<?php
session_start();
header('Content-Type: text/html; charset=utf-8');
error_reporting(-1);
ini_set('display_errors', 1);
// Auto load the classes that are called
function __autoload($class_name) {
	//class directories
	$base_dir = 'StudentTrade/';
	$directorys = array(
		'Class/',
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
$campuses = array();
foreach ($universities as $uni) {
	array_push($campuses, $dbh->getCampusFromUniversityID($uni["id"]));
}

$adtypes = $dbh->getAdCategories();
$cityID = $city["id"];

$dbh = null;
?>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<title>StudentTrade.se</title>
		<link rel="stylesheet" type="text/css" href="StudentTrade/Css/bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="StudentTrade/Css/non-responsive.css" />
		<link rel="stylesheet" type="text/css" href="StudentTrade/Css/avgrund.css" />
		<link rel="stylesheet" type="text/css" href="StudentTrade/Css/style.css" />
		<link rel="stylesheet" type="text/css" href="StudentTrade/Css/style_footer.css" />

		<link href='http://fonts.googleapis.com/css?family=Lato:400,700,900' rel='stylesheet' type='text/css'>

		<link rel="shortcut icon" href="favicon.ico" />
	</head>
	<body>
		<div class="container">
			<div class="col-xs-12 top">
				<div class="row" style="height: 200px;">
					<div class="col-xs-6">
						<a href="index.php"><img src="StudentTrade/Img/ST_w_bubble.png" /></a>
					</div>
					<div class="col-xs-3 col-md-offset-3" id="campusChooser">
						<div class="btn-group">
							<a href="front.php?page=latest&city=<?php echo $city["short_name"]; ?>" class="btn btn-info">Se <?php echo $city["city_name"]; ?></a> 
							<div class="btn-group">
								<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"></button>
								<ul class="dropdown-menu">
									<?php
									foreach ($campuses as $cam) {
										foreach ($cam as $c) {
											echo "<li>";
											if (isset($_GET["campus"]) && compareString($_GET["campus"], $c["campus_name"])) {
												echo generateCampusURL($city["short_name"], $c["campus_name"],
													(isset($_GET["type"]) ? $_GET["type"] : NULL),
													False);
											} else {
												echo generateCampusURL($city["short_name"], $c["campus_name"],
													(isset($_GET["type"]) ? $_GET["type"] : NULL));
											}
											echo "</li>";
										}
									}
									?>
									<li class="divider"></li>
									<li><a id="requestCampus">Mitt campus saknas!</a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>

				<!-- <div class="col-xs-12" id="categories"> -->
				<div class="row"  >
					<div class="navbar">
				    	<div class="navbar-collapse collapse">
							<ul class="nav nav-pills">
								<?php
								foreach ($adtypes as $type) {
									echo "<li class=\"category\" style=\"background-color: ". $type["color"] ."\">";
									echo generateAdURL("latest", $city["short_name"],
											((isset($_GET["type"]) && $_GET["type"] == $type["name"]) ? ">". $type["description"] : $type["description"]),
											(isset($_GET["campus"]) ? $_GET["campus"] : NULL),
											$type["name"]);
									echo "</li>";
								}
								?>
								<li class="category" style="background-color: #666666;">
								<?php
									echo generateAdURL("latest", $city["short_name"], 
											(!isset($_GET["type"]) ? "> Visa alla" : "Visa alla"),
											(isset($_GET["campus"]) ? $_GET["campus"] : NULL));
								?>
								</li>
								<li class="category" style="background-color: #39b54a; float: right; width: 250px; height: 80px; text-align: center; font-size: 29px; line-height: 60px;">
								<?php
									echo generateAdURL("ad_new", $city["short_name"], "Lägg upp annons",
												(isset($_GET["campus"]) ? $_GET["campus"] : NULL),
												(isset($_GET["type"]) ? $_GET["type"] : NULL));
								?>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<!-- </div>
				<div class="col-xs-8" id="categories">
					<?php
					// generateAdURL($page, $city, $nameOnUrl, $campus=NULL, $type=NULL)
					/*foreach ($adtypes as $type) {
						echo "<span style=\"background-color: ". $type["color"] ."\">";
						echo generateAdURL("latest", $city["short_name"],
									((isset($_GET["type"]) && $_GET["type"] == $type["name"]) ? ">". $type["description"] : $type["description"]),
									(isset($_GET["campus"]) ? $_GET["campus"] : NULL),
									$type["name"]);
						echo "</span>";
					}
					echo "<span class=\"categoryViewAll\">";
					echo generateAdURL("latest", $city["short_name"], 
									(!isset($_GET["type"]) ? "> Visa alla" : "Visa alla"),
									(isset($_GET["campus"]) ? $_GET["campus"] : NULL));
					echo "</span>";
					?>
				</div>

				<div class="col-xs-4 addNew">
					<?php
					echo "<span>";
					echo generateAdURL("ad_new", $city["short_name"], "Lägg upp annons",
									(isset($_GET["campus"]) ? $_GET["campus"] : NULL),
									(isset($_GET["type"]) ? $_GET["type"] : NULL));
					echo "</span>";*/
					?>
				</div> -->
			</div>

			<div class="content">
				<div class="row">
					<div class="col-xs-8">
						<?php include_once('StudentTrade/Views/switch.php'); ?>
					</div>
					<div class="col-xs-4 rightColumn">
						<?php include_once("StudentTrade/Views/right_column.php"); ?>
					</div>
				</div>
			</div>

			<div class="col-xs-12 footer">
				<?php include_once("StudentTrade/Views/footer.php"); ?>
			</div>
		</div>

		<script src="StudentTrade/Scripts/jquery-1.10.2.min.js" type="text/javascript"></script>
		<script src="StudentTrade/Scripts/bootstrap.min.js" type="text/javascript"></script>
		<script src="StudentTrade/Scripts/bootbox.min.js" type="text/javascript"></script>
		<script src="StudentTrade/Scripts/scripts.js" type="text/javascript"></script>
	</body>
</html>