<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>StudentTrade.se</title>
<link rel="stylesheet" type="text/css" href="style.css" />
<link rel="stylesheet" type="text/css" href="ikon.css" />
</head>
<body>
<?php include "data.php";
	$selection = $_GET["select"];
	$annonsId = $_GET["id"];
	$annonsData = skrivUtAnnons($selection, $annonsId);
	$adress = strtolower($selection);
?>
<div id="wrapper">
	<header>
		<h1></h1>
	</header>
	
	<div id="top">
		<a href="index.html">StudentTrade.se</a> > <a href="stad.php">Linköping</a> > <?php echo "<a href=\"$adress.php\">$selection</a>" . " > Annons";?>
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
		<p><i class="icon-pil"></i><?php echo "<a href=\"$adress.php\">Gå tillbaka till annonser</a>";?></p><br>
		<h1><?php echo $annonsData["rubrik"]; ?></h1>
		<span class="underrubrik">Kategori: <?php echo $annonsData["tabell"]; ?></span><span class="annonsDate"><?php echo $annonsData["date"]; ?></span>
		<p class="beskrivning"><?php echo nl2br($annonsData["beskrivning"]); ?></p>
		<span class="seller">Säljes av: <?php echo $annonsData["person"]; ?></span>
		<span class="btn contactAnnons">Svara på denna annons</span>
		<p class="endNote">Anmäl denna annons<br>Vad innebär anmälan?<br>
		<p>Ta bort annons</p>
		</span>
	</div>
	
	<!--
		<h1>Annonsrubrik</h1>
		<span class="underrubrik">Kategori: Biljetter</span><span class="annonsDate">2013-05-09</span>
		<p class="beskrivning">Beskrivning: Säljer min biljett till UK-kravallen för att jag har ådragit mig en liten liten förkylning. Biljett finns att hämta i Ryd.<br><br>Akta er för Rydskogen!</p>
		<span class="seller">Säljes av: Christopher Palmgren</span>
		<span class="btn contactAnnons">Svara på denna annons</span>
		<p class="endNote">Anmäl denna annons<br>Vad innebär anmälan?<br>Ta bort annons</span>
	-->
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
</body>
</html>