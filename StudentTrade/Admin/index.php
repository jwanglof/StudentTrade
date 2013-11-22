<?php
ob_start();
session_start();

error_reporting(-1);
ini_set('display_errors', 1);

// Auto load the classes that are called
spl_autoload_register(function ($class) {
	$base_dir = "../";
	$directories = array(
		// "Class/",
		"Db/",
		"Admin/Db/"
		// "Logic/"
		// "Views"
	);

	//for each directory
	foreach($directories as $directory)
	{
		//see if the file exsists
		if(file_exists($base_dir.$directory.$class .".php"))
		{
			include($base_dir.$directory.$class .".php");
			//only require the class once, so quit after to save effort (if you got more, then name them something else
			return;
		}
	}
});
// unset($_SESSION["admin"]);

// echo $_SESSION["admin"];
?>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<title>StudentTrade.se - En Köp- och Sälj sajt för studenter</title>
		<link rel="stylesheet" type="text/css" href="../Css/bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="Css/admin.css" />

		<link href='http://fonts.googleapis.com/css?family=Lato:400,700,900' rel='stylesheet' type='text/css'>

		<link rel="shortcut icon" href="favicon.ico" />
	</head>
	<body>

		<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
			<div class="container">
				<div class="navbar-header">
					<a class="navbar-brand" href="../../index.php" target="_blank">StudentTrade Admin</a>
				</div>
<?php
	if (!$_SESSION["admin"]) {
?>
				<div class="navbar-collapse collapse">
					<form class="navbar-form navbar-right" method="post" action="login.php">
						<div class="form-group">
							<input type="text" name="username" id="username" placeholder="Användarnamn" class="form-control">
						</div>
						<div class="form-group">
							<input type="password" name="password" id="password" placeholder="Lösenord" class="form-control">
						</div>
						<button type="submit" class="btn btn-success">Sign in</button>
					</form>
				</div><!--/.navbar-collapse -->
		
<?php
	} else {
?>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="?page=showAds">Se annonser</a></li>
					<li><a href="#">Se användare</a></li>
					<li><a href="?page=logOut">Logga ut</a></li>
				</ul>
<?php
	}
?>
			</div>
		</div>
		<div class="container">
<?php
	if (!isset($_GET["page"])) {
?>
			<h1>Hello, world!</h1>
			<p>This is a template for a simple marketing or informational website. It includes a large callout called a jumbotron and three supporting pieces of content. Use it as a starting point to create something more unique.</p>
<?php
	} else if ($_SESSION["admin"]) {
		if ($_GET["page"] == "showAds") {
			$dbh = new DbSelect();
			$ads = $dbh->getAds();
			// print_r($ads);
			foreach ($ads as $key => $ad) {
				$adInfo = $dbh->getAdInfoFromAdID($ad["id"]);
				$adUserInfo = $dbh->getAdUserInfoFromAdUserInfoID($ad["id"]);
				$adCategory = $dbh->getAdCategoryFromID($ad["fk_ad_adCategory"]);
				$adSubCategory = $dbh->getAdSubCategoryFromAdCategoryID($ad["fk_ad_adCategory"]);
				$adType = $dbh->getAdTypeFromAdTypeID($ad["fk_ad_adType"]);

				// print_r($adCategory);

				echo "<div class=\"adminAd\" id=\"". $key ."\">". $ad["title"] ."</div>";
				echo "<div class=\"adminAdInfo ". $key ."\">";
					echo "<div class=\"col-md-4\">Beskrivning</div>";
					echo "<div class=\"col-md-8\">". $ad["info"] ."</div>";
					echo "<br />";
					echo "<div class=\"col-md-4\">Skapad av</div>";
					echo "<div class=\"col-md-8\">". $adUserInfo["name"] ."</div>";
					echo "<br />";
					echo "<div class=\"col-md-4\">Kategori</div>";
					echo "<div class=\"col-md-8\">". $adCategory["description"] ."</div>";
					echo "<br />";
					echo "<div class=\"col-md-4\"><a href=\"ad.php?func=deactive&aid=". $ad["id"] ."\">Ta bort</a></div>";
					echo "<div class=\"col-md-8\"><a href=\"#\">Somesome</a></div>";
				echo "</div>";
			}
		} else if ($_GET["page"] == "logOut") {
			unset($_SESSION["admin"]);
		}
	}
?>
		</div>
		<script src="../Scripts/jquery.min.js" type="text/javascript"></script>
		<script src="Scripts/scripts.js" type="text/javascript"></script>
	</body>
</html>