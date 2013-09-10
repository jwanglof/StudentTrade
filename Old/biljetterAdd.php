<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>StudentTrade.se</title>
<link rel="stylesheet" type="text/css" href="style.css" />
<link rel="stylesheet" type="text/css" href="ikon.css" />
</head>
<body>
</body>
<div id="wrapper">
	<header>
		<h1></h1>
	</header>
	
	<div id="top">
		<a href="index.html">StudentTrade.se</a> > <a href="stad.php">Linköping</a> > <a href="biljetter.php">Biljetter</a>
	</div>
	
	<div id="categories">
		<span class="top">Välj kategori</span>
		<ul class="nav">
		<a href="biljetter.php"><li><i class="icon-biljetter"></i>Biljetter</li></a>
		<a href="kurslitteratur.php"><li><i class="icon-kurslitteratur"></i>Kurslitteratur</li></a>
		<a href="bostad.php"><li><i class="icon-bostad"></i>Bostad</li></a>
		<a href="jobb.php"><li><i class="icon-jobb"></i>Jobb/arbete</li></a>
		<a href="resor.php"><li><i class="icon-resor"></i>Resor/samåkning</li></a>
		<a href="blandat.php"><li><i class="icon-blandat"></i>Övrigt</li></a>
		</ul>
		
		<ul class="addAnnons">
			<li>LÄGG UPP ANNONS</li>
		</ul>
		<span class="info">Vad gäller för annonsering?</span>
	</div>
	
	<div id="main">
		<div id="stylized" class="myform">
			<form action="form.php" method="post">
			<h1>Lägg upp annons</h1>
			<p>Lägg upp din annons under kategorin biljetter</p>
			
				<label for="rubrik">Rubrik:
				<span class="small">Ange annonsrubrik</span></label>
				<input type="text" name="rubrik" id="rubrik" placeholder="Ange rubrik"><br>
				
				<label for="event">Event
				<span class="small">Till vad gäller biljetten?</span></label>
				<input type="text" name="event" id="event" placeholder="Till vad gäller biljetten?"><br><br>

				<label for="beskrivning">Beskrivning
				<span class="small">Ange din beskrivning</span></label>
				<textarea rows="5" cols="30" name="beskrivning" id="beskrivning" placeholder="Beskrivning om vad du säljer..."></textarea><br>

				<label for="person">Namn
				<span class="small">För- och efternamn</span></label>
				<input type="text" name="person" id="person" placeholder="Ange ditt namn"><br>

				<label for="kontakt">Kontaktuppgifter
				<span class="small">Hur vill du bli kontaktad?</span></label>
				<input type="text" name="kontakt" id="kontakt" placeholder="Hur vill du bli kontaktad?">

				<button type="submit" class="btn" name="sendBiljetter">Lägg upp annons</button>
			</form>
		</div>
	</div>
	
	<aside>
		<p>Annons för att lägga upp annons</p>
	</aside>
	
	<footer>
		<div class="content">
			<div class="nav">
				<ul class="left">
					<li>Om oss</li>
					<li>Så fungerar det</li>
				</ul>
				<img src="img/greyLogo.png">
				<ul class="right">
					<li>Vanliga frågor</li>
					<li>Kontakta oss</li>
				</ul>
			</div>
		<p class="copyright">Copyright &copy 2013 StudentTrade</p>
		</div>
	</footer>
	
	
</div>
</html>