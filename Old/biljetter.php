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
		<h1>Biljetter</h1>
		<!-- <ul class="annonsList">
			<a href="annons.php"><li><span class="first">2013-05-09</span><span class="rubrik">Säljer min lägenhet i centrala stan</span><span class="price"></span></li></a>
			<li><span class="first">2013-05-09</span><span class="rubrik">Bokhylla nyskick från IKEA</span><span class="price">130:-</span></li>
			<li><span class="first">2013-05-08</span><span class="rubrik">Bokhylla nyskick från IKEA</span><span class="price">130:-</span></li>
			<li><span class="first">2013-05-07</span><span class="rubrik">Möblerad 2:a nära centrum och HU uthyres under sommaren 2013</span><span class="price">130:-</span></li>
			<li><span class="first">2013-05-07</span><span class="rubrik">Bokhylla nyskick från IKEA</span><span class="price">130:-</span></li>
			<li><span class="first">2013-05-06</span><span class="rubrik">Bokhylla nyskick från IKEA som jag har haft i tio år och är i bra skick</span><span class="price">130:-</span></li>
			<li><span class="first">2013-05-06</span><span class="rubrik">Bokhylla nyskick från IKEA</span><span class="price">130:-</span></li>
			<li><span class="first">2013-05-05</span><span class="rubrik">Köper 2 SoF-Biljetter till Fredagen (Imorgon)</span><span class="price">130:-</span></li>
			<li><span class="first">2013-05-05</span><span class="rubrik">Stuff for sale (Double bed, single bed, tables, trolley etc)</span><span class="price">130:-</span></li>
			<li><span class="first">2013-05-04</span><span class="rubrik">Bokhylla nyskick från IKEA</span><span class="price">130:-</span></li>
		</ul> -->
		<?php include "data.php";
			skrivUtBiljetter();
		?>
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