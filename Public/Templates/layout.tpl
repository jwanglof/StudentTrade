<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<title>StudentTrade - {% block page_title %}{% endblock %}</title>
		<link rel="stylesheet" type="text/css" href="{{ dir }}Css/bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="{{ dir }}Css/non-responsive.css" />
		<link rel="stylesheet" type="text/css" href="{{ dir }}Css/style.css" />
		<link rel="stylesheet" type="text/css" href="{{ dir }}Css/style_footer.css" />
		{% block add_css %}{% endblock %}

		<link href="http://fonts.googleapis.com/css?family=Lato:400,700,900" rel="stylesheet" type="text/css">

		<link rel="shortcut icon" href="{{ dir }}Img/favicon.ico" />
	</head>
	<body>
		<?php include_once("../GoogleAnalytics.php"); ?>
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
						<a href="{{ dir }}index.php"><img src="{{ dir }}Img/ST_w_bubble.png" /></a>
					</div>
					<div class="col-xs-3 col-xs-offset-3" id="campusChooser">
						<div class="btn-group">
							<a href="{{ base_url }}" class="btn btn-info">Se {{ city.city_name }}</a> 
							<div class="btn-group">
								<button type="button" class="btn btn-default dropdown-toggle campus" data-toggle="dropdown"></button>
								<ul class="dropdown-menu">
									{% for campus in campuses %}
										<li><a href="{{ base_url }}/campus/{{ campus.short_name }}" class="{{ campus.short_name }}">{{ campus.campus_name }}</a></li>
									{% endfor %}
									<li class="divider"></li>
									<li><a href="{{ base_url }}">Se alla</a></li>
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
								{% for city in cities %}
									<li><a href="{{ dir }}index.php/city/{{ city.short_name }}">{{ city.city_name }}</a></li>
								{% endfor %}
								</ul>
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-xs-9 navbar" id="categories">
				    	<div class="navbar-collapse collapse">
							<ul class="nav nav-pills">
								{% for category in adCategories %}
									<li class="category" style="background-color: {{ category.color }}">
										<a href="{{ base_url }}/category/{{ category.name }}" class="{{ category.linkClass }}">{{ category.description }}</a>
									</li>
								{% endfor %}
							</ul>
						</div>
					</div>
					<div class="navbar col-xs-3">
						<ul class="nav nav-pills">
							<li class="category" style="background-color: #39b54a; float: right; width: 250px; height: 80px; text-align: center; font-size: 25px; line-height: 60px;">
								<a href="{{ base_url }}/addNew">Lägg upp annons</a>
							</li>
						</ul>
					</div>
				</div>

				<div class="row" style="position: relative; top: -41px; z-index: 3; border: 0px solid #000">
					<ol class="breadcrumb">
						<li><a href="{{ city.short_name }}">{{ city.city_name }}</a></li>
						{% if breadcrumbs.category %}
							<li><a href="{{ base_url }}/category/{{ breadcrumbs.category.name }}">{{ breadcrumbs.category.description }}</a></li>
						{% endif %}
						{% if breadcrumbs.campus %}
							<li><a href="{{ base_url }}/campus/{{ breadcrumbs.campus.short_name }}">{{ breadcrumbs.campus.campus_name }}</a></li>
						{% endif %}
						{% if breadcrumbs.ad %}
							<li><a href="#">{{ breadcrumbs.ad.id }}</a></li>
						{% endif %}
					</ol>
				</div>
			</div>
		</div>

		<div class="content">		
			<div class="row">{% block content %}{% endblock %}</div>
			<div class="col-xs-4 rightColumn"><?php echo $this->rightColumn; ?></div>
		</div>

		<div class="col-xs-12 row footer">
			<div class="col-xs-4">
				<ul>
					<li data-toggle="modal" data-target="#aboutUsModal">Om oss</li>
					<li data-toggle="modal" data-target="#howItWorksModal">Så fungerar det</li>
				</ul>
			</div>
			<div class="col-xs-4">
				<img src="../Img/studenttrade_logo_grey.png" />
			</div>
			<div class="col-xs-4">
				<ul>
					<li data-toggle="modal" data-target="#faqModal">Vanliga frågor</li>
					<li data-toggle="modal" data-target="#contactUsModal" id="contact_us">Kontakta oss</li>
				</ul>
			</div>
			<p class="copyright">Copyright &copy2013 StudentTrade</p>
		</div>

		<div class="fade modal" id="aboutUsModal" tabindex="-1" role="dialog" aria-labelledby="aboutUsModal" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
						<h2>Om oss</h2>
					</div>

					<div class="modal-body">
						StudentTrade.se är en köp- och säljsajt av studenter för studenter. Hos oss kan du köpa och sälja saker som har studentlivet till. StudentTrade.se startades hösten 2013 av tre studenter på Linköpings Universitet.
					</div>
				</div>
			</div>
		</div>

		<div class="fade modal" id="howItWorksModal" tabindex="-1" role="dialog" aria-labelledby="howItWorksModal" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
						<h2>Så fungerar det</h2>
					</div>

					<div class="modal-body">
						Hos oss är det lätt att både lägga upp annons och att hitta det du söker. Börja med att välja din studentstad på startsidan. Väl inne på sidan kan du sedan lätt sortera annonserna efter kategori och lägga upp annons genom att klicka på ”Lägg upp annons”. Annonsen kommer direkt upp i flödet och blir tillgänlig för andra studenter.
					</div>
				</div>
			</div>
		</div>

		<div class="fade modal" id="faqModal" tabindex="-1" role="dialog" aria-labelledby="faqModal" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
						<h2>Vanliga frågor och svar</h2>
					</div>

					<div class="modal-body">
						<h4>Kostar det något att lägga upp en annons?</h4>
						Nej, tillskillnad från andra säljsajter är det helt gratis att lägga upp en annons hos oss. Vi är också studenter och tycker inte man ska betala för att lägga upp en annons.
						
						<h4>Hur tar jag bort min annons?</h4>
						När du lägger upp din annons får du en fyrsiffrig kod till den e-mail adress du angett. Om du vill ta bort din annons går du in på den, klickar på ”Ta bort annons” och anger din kod. Snabbt och enkelt!

						<h4>Vad gör jag om jag tycker att en annons är olämplig?</h4>
						Om du ser en annons som du inte tycker är olämplig kan du anmäla den till oss. Vi ser då om den bryter mot ”Regler kring annonsering” och beslutar med detta som grund om hurvida annonser ska bli borttagen eller inte. Om du vill veta vilka regler som gäller kring annonsering så hittar du det <a href="rules.php?city=<?php echo $_GET["city"]; ?>" style="color: #565656;text-decoration: underline">här</a>.
					</div>
				</div>
			</div>
		</div>

		<div class="fade modal" id="contactUsModal" tabindex="-1" role="dialog" aria-labelledby="contactUsModal" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
						<h2>Kontakta oss</h2>
					</div>

					<div class="modal-body">
						<form method="post" class="form-horizontal" role="form" id="contactUsForm">
							<input type="hidden" id="mail" name="mail" value="contactUs" />
							<fieldset>
								<div class="form-group">
									<label for="name" class="col-lg-1 control-label">Ditt namn *</label>
									<div class="col-lg-5">
										<input type="text" class="form-control" id="name" name="name" placeholder="Namn">
									</div>
								</div>

								<div class="form-group">
									<label for="from_email" class="col-lg-1 control-label">Din e-post *</label>
									<div class="col-lg-5">
										<input type="email" class="form-control" name="from_email" id="from_email" placeholder="Din e-post" />
									</div>
								</div>

								<div class="form-group">
									<label for="message" class="col-lg-1 control-label">Ditt meddelande *</label>
									<div class="col-lg-5">
										<textarea class="form-control" name="message" id="message" rows="5" placeholder="Meddelande"></textarea>
									</div>
								</div>
							</fieldset>
						</form>

						<div class="modal-body-error"></div>
					</div>

					<div class="modal-footer">
						<img src="../Img/ajax-loader.gif" class="ajaxLoader" /> <button type="submit" form="contactUsForm" class="btn btn-primary">Skicka</button>
					</div>
				</div>
			</div>
		</div>
		
		<script src="{{ dir }}Scripts/jquery.min.js" type="text/javascript"></script>
		<script src="{{ dir }}Scripts/bootstrap.min.js" type="text/javascript"></script>
		<script src="{{ dir }}Scripts/bootbox.min.js" type="text/javascript"></script>
		<script src="{{ dir }}Scripts/jquery.validate.min.js" type="text/javascript"></script>
		<script src="{{ dir }}Scripts/ad_new.js" type="text/javascript"></script>
		<script src="{{ dir }}Scripts/scripts.js" type="text/javascript"></script>
		<script src="{{ dir }}Scripts/forms.js" type="text/javascript"></script>
		{% block add_scripts %}{% endblock %}
	</body>
</html>