<?php
ob_start();
session_start();
header('Content-Type: text/html; charset=UTF-8');
// error_reporting(-1);
// ini_set('display_errors', 1);
mb_internal_encoding("UTF-8");
// include_once 'ChromePhp.php';

// Auto load the classes that are called
spl_autoload_register(function ($class) {
	$base_dir = 'StudentTrade/';
	$directories = array(
		'Class/',
		'Db/',
		'Logic/'
		// 'Views'
	);

	//for each directory
	foreach($directories as $directory)
	{
		//see if the file exsists
		if(file_exists($base_dir.$directory.$class . '.php'))
		{
			include($base_dir.$directory.$class . '.php');
			//only require the class once, so quit after to save effort (if you got more, then name them something else
			return;
		}
	}
});
require_once("StudentTrade/Includes/Functions.php");

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
$cities = $dbh->getCityIDs();
$dbh = null;
?>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<title>StudentTrade.se - En Köp- och Sälj sajt för studenter</title>
		<link rel="stylesheet" type="text/css" href="StudentTrade/Css/bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="StudentTrade/Css/non-responsive.css" />
		<link rel="stylesheet" type="text/css" href="StudentTrade/Css/avgrund.css" />
		<link rel="stylesheet" type="text/css" href="StudentTrade/Css/style.css" />
		<link rel="stylesheet" type="text/css" href="StudentTrade/Css/style_footer.css" />

		<link href='http://fonts.googleapis.com/css?family=Lato:400,700,900' rel='stylesheet' type='text/css'>

		<link rel="shortcut icon" href="favicon.ico" />
	</head>
	<body>
		<?php include_once("StudentTrade/Includes/GoogleAnalytics.php"); ?>
		<div class="fade modal" id="requestCampusModal" tabindex="-1" role="dialog" aria-labelledby="requestCampusModal" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
						<h2>Förfråga att lägga till campus</h2>
					</div>

					<div class="modal-body">
						<form class="form-horizontal well" data-async data-target="#requestCampusModal" method="post" id="requestCampusForm">
							<input type="hidden" id="mail" name="mail" value="requestCampus" />
							<fieldset>
								<div class="form-group">
									<label for="campus_name" class="col-lg-1 control-label">Namn på campus *</label>
									<div class="col-lg-5">
										<input type="text" class="form-control" id="campus_name" name="campus_name" placeholder="Campusnamn" />
									</div>
								</div>
								<div class="form-group">
									<label for="city_name" class="col-lg-1 control-label">Ligger i stad *</label>
									<div class="col-lg-5">
										<input type="text" class="form-control" id="city_name" name="city_name" placeholder="Stadsnamn" />
									</div>
								</div>
							</fieldset>
						</form>
					</div>

					<div class="modal-footer">
						<button type="submit" form="requestCampusForm" class="btn btn-primary">Skicka förfrågan</button>
					</div>
				</div>
			</div>
		</div>

		<div class="container">
			<div class="col-xs-12 top">
				<div class="row">
					<div class="col-xs-6">
						<a href="index.php"><img src="StudentTrade/Img/ST_w_bubble.png" /></a>
					</div>
					<div class="col-xs-3 col-xs-offset-3" id="campusChooser">
						<div class="btn-group">
							<a href="front.php?page=latest&city=<?php echo $city["short_name"]; ?>" class="btn btn-info">Se <?php echo $city["city_name"]; ?></a> 
							<div class="btn-group">
								<button type="button" class="btn btn-default dropdown-toggle campus" data-toggle="dropdown"></button>
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
									<li><a href="front.php?page=latest&city=<?php echo $city["short_name"]; ?>">Se alla</a></li>
									<li class="divider"></li>
									<li><a data-toggle="modal" href="#requestCampusModal">Mitt campus saknas!</a></li>
								</ul>
							</div>
						</div>
						
						<br /><br />

						<div class="btn-group">
							<span class="btn btn-info">Byt stad</span>
							<div class="btn-group">
								<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Välj stad <span class="caret"></span></button>
								<ul class="dropdown-menu">
								<?php
								foreach ($cities as $value) {
									$short_name = replaceSwedishLetters(strtolower($value["short_name"]));
									echo "<li><a href=\"front.php?page=latest&city=". $short_name ."\">". $value["city_name"] ."</a></li>";
								}
								?>
								</ul>
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-xs-9 navbar" id="categories">
				    	<div class="navbar-collapse collapse">
							<ul class="nav nav-pills">
								<?php
								foreach ($adtypes as $type) {
									echo "<li class=\"category\" style=\"background-color: ". $type["color"] ."\">";
									echo generateAdURL("latest", $city["short_name"],
											$type["description"], (isset($_GET["campus"]) ? $_GET["campus"] : NULL),
											$type["name"],
											(isset($_GET["type"]) && $_GET["type"] == $type["name"]));
									echo "</li>";
								}
								?>
								<!-- <li class="category" style="background-color: #666666;">
								<?php
									echo generateAdURL("latest", $city["short_name"], 
											(!isset($_GET["type"]) ? "> Visa alla" : "Visa alla"),
											(isset($_GET["campus"]) ? $_GET["campus"] : NULL));
								?>
								</li> -->
							</ul>
						</div>
					</div>
					<div class="navbar col-xs-3">
						<ul class="nav nav-pills">
							<li class="category" style="background-color: #39b54a; float: right; width: 250px; height: 80px; text-align: center; font-size: 25px; line-height: 60px;">
							<?php
								echo generateAdURL("ad_new", $city["short_name"], "Lägg upp annons",
											(isset($_GET["campus"]) ? $_GET["campus"] : NULL),
											(isset($_GET["type"]) ? $_GET["type"] : NULL), True);
							?>
							</li>
						</ul>
					</div>
				</div>

				<div class="row" style="position: relative; top: -41px; z-index: 3; border: 0px solid #000">
					<ol class="breadcrumb">
						<li><a href="front.php?page=latest&city=<?php echo $city["short_name"]; ?>"><?php echo $city["city_name"]; ?></a></li>
						<?php
						$dbh = new DbSelect();
						if (isset($_GET["aid"])) {
							$ad = $dbh->getAdFromID($_GET["aid"]);
							$adCategory = $dbh->getAdCategoryFromID($ad["fk_ad_adCategory"]);
							$adCampus = $dbh->getCampusFromID($ad["fk_ad_campus"]);

							if ($adCampus["id"] == 999)
								echo "<li><a href=\"front.php?page=latest&city=". $city["short_name"] ."\">". $adCampus["campus_name"] ."</a></li>";
							else
								echo "<li><a href=\"front.php?page=latest&city=". $city["short_name"] ."&campus=". replaceSwedishLetters(replaceSpecialChars(strtolower($adCampus["campus_name"]))) ."\">". $adCampus["campus_name"] ."</a></li>";

							echo "<li><a href=\"front.php?page=latest&type=". $adCategory["name"] ."\">". $adCategory["description"] ."</a></li>";
							echo "<li><a href=\"#\">". $ad["title"] ."</a></li>";
						} else {
							if (isset($_GET["campus"])) {
								foreach ($campuses[0] as $key => $value) {
									if (replaceSwedishLetters(replaceSpecialChars(strtolower($value["campus_name"]))) == $_GET["campus"])
										echo "<li><a href=\"front.php?page=latest&city=". $city["short_name"] ."&campus=". $_GET["campus"] ."\">". $value["campus_name"] ."</a></li>";
								}
							}
							if (isset($_GET["type"])) {
								$adCategory = $dbh->getAdCategoryFromName($_GET["type"]);
								echo "<li>". generateAdURL("latest", $city["short_name"],
										(isset($_GET["type"]) ? $adCategory["description"] : NULL),
										(isset($_GET["campus"]) ? $_GET["campus"] : NULL),
										$type["name"]) ."</li>";
							}
						}
						$dbh = null;
						?>
					</ol>
				</div>
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

			<?php include_once("StudentTrade/Views/footer.php"); ?>
		</div>

		<script src="StudentTrade/Scripts/jquery.min.js" type="text/javascript"></script>
		<script src="StudentTrade/Scripts/bootstrap.min.js" type="text/javascript"></script>
		<script src="StudentTrade/Scripts/bootbox.min.js" type="text/javascript"></script>
		<script src="StudentTrade/Scripts/jquery.validate.min.js" type="text/javascript"></script>
		<script src="StudentTrade/Scripts/scripts.js" type="text/javascript"></script>
		<script src="StudentTrade/Scripts/forms.js" type="text/javascript"></script>
	</body>
</html>
<?php ob_flush(); ?>