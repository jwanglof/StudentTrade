<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<title>StudentTrade - <?php $this->eprint($this->title); ?></title>
		<link rel="stylesheet" type="text/css" href="../Css/bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="../Css/non-responsive.css" />
		<link rel="stylesheet" type="text/css" href="../Css/avgrund.css" />
		<link rel="stylesheet" type="text/css" href="../Css/style.css" />
		<link rel="stylesheet" type="text/css" href="../Css/style_footer.css" />

		<link href='http://fonts.googleapis.com/css?family=Lato:400,700,900' rel='stylesheet' type='text/css'>

		<link rel="shortcut icon" href="../Img/favicon.ico" />
	</head>
	<body>
		<?php include_once("../Includes/GoogleAnalytics.php"); ?>
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
						<a href="../../index.php"><img src="../Img/ST_w_bubble.png" /></a>
					</div>
					<div class="col-xs-3 col-xs-offset-3" id="campusChooser">
						<div class="btn-group">
							<a href="front.php?city=<?php echo $this->eprint($this->city["short_name"]); ?>" class="btn btn-info">Se <?php echo $this->eprint($this->city["city_name"]); ?></a> 
							<div class="btn-group">
								<button type="button" class="btn btn-default dropdown-toggle campus" data-toggle="dropdown"></button>
								<ul class="dropdown-menu">
									<?php foreach ($this->campusURLs as $campus): ?>
									<li><?php echo $campus; ?></li>
									<?php endforeach; ?>
									<li class="divider"></li>
									<li><a href="front.php?page=latest&city=<?php echo $this->city["short_name"]; ?>">Se alla</a></li>
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
								<?php foreach ($this->citiesInformation as $city): ?>
									<li><?php echo $city; ?></li>
								<?php endforeach; ?>
								</ul>
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-xs-9 navbar" id="categories">
				    	<div class="navbar-collapse collapse">
							<ul class="nav nav-pills">
								<?php foreach ($this->adCategory as $category): ?>
								<li class="category" style="background-color: <?php $this->eprint($category["background-color"]); ?>">
									<?php echo $category["url"]; ?>
								</li>
								<?php endforeach; ?>
							</ul>
						</div>
					</div>
					<div class="navbar col-xs-3">
						<ul class="nav nav-pills">
							<li class="category" style="background-color: #39b54a; float: right; width: 250px; height: 80px; text-align: center; font-size: 25px; line-height: 60px;">
							<?php echo $this->adNewAdURL; ?>
							</li>
						</ul>
					</div>
				</div>

				<div class="row" style="position: relative; top: -41px; z-index: 3; border: 0px solid #000">
					<ol class="breadcrumb">
						<li><a href="front.php?city=<?php $this->eprint($this->city["short_name"]); ?>"><?php $this->eprint($this->city["city_name"]); ?></a></li>
						<?php echo $this->breadCampus; ?>
						<?php echo $this->breadCategory; ?>
						<?php echo $this->breadAdTitle; ?>
					</ol>
				</div>
			</div>