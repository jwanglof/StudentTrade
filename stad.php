<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>StudentTrade.se</title>
<link rel="stylesheet" type="text/css" href="style.css" />
<link rel="stylesheet" type="text/css" href="ikon.css" />
<link rel="shortcut icon" href="favicon.ico" />
<style type="text/css">
	.stage {
		position: absolute;
		top: 0;
		left: 0;
		width: 100%;
		min-width: 900px;
		height: 100%;
		overflow: hidden;
		z-index: -100;
	}
	.far-clouds {
		background: transparent url(img/far-clouds.png) 305px 52px repeat-x;
	}
	.near-clouds {
		background: transparent url(img/near-clouds.png) 305px 172px repeat-x;
	}
</style>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-38819740-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</head>
<body>
<div id="wrapper">
	<header>
		<h1></h1>
	</header>
	
	<div id="top">
		<a href="index.html">StudentTrade.se</a> > <a href="stad.php">Linköping</a>
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
			<li><a href="biljetterAdd.php">LÄGG UPP ANNONS</a></li>
		</ul>
		<span class="info"><a href="regler.html">Vad gäller för annonsering?</a></span>
	</div>
	
	<div id="main">
		<h1>Senaste annonser</h1>
		<?php include "data.php";
			senasteAnnonserna('10');
		?>
		<ul class="annonsList">
			<li><span class="first">Bostad<br><span class="smallDate">2013-05-10</span></span><span class="rubrik">Säljer min lägenhet i centrala stan</span><span class="price"></span></li>
			<li><span class="first">Övrigt<br><span class="smallDate">2013-05-10</span></span><span class="rubrik">Bokhylla nyskick från IKEA</span><span class="price">130:-</span></li>
			<li><span class="first">Övrigt<br><span class="smallDate">2013-05-10</span></span><span class="rubrik">Bokhylla nyskick från IKEA</span><span class="price">130:-</span></li>
			<li><span class="first">Bostad<br><span class="smallDate">2013-05-10</span></span><span class="rubrik">Möblerad 2:a nära centrum och HU uthyres under sommaren 2013</span><span class="price">130:-</span></li>
			<li><span class="first">Övrigt<br><span class="smallDate">2013-05-10</span></span><span class="rubrik">Bokhylla nyskick från IKEA</span><span class="price">130:-</span></li>
			<li><span class="first">Resor/samåkning<br><span class="smallDate">2013-05-10</span></span><span class="rubrik">Bokhylla nyskick från IKEA som jag har haft i tio år och är i bra skick</span><span class="price">130:-</span></li>
			<li><span class="first">Övrigt<br><span class="smallDate">2013-05-10</span></span><span class="rubrik">Bokhylla nyskick från IKEA</span><span class="price">130:-</span></li>
			<li><span class="first">Biljetter<br><span class="smallDate">2013-05-10</span></span><span class="rubrik">Köper 2 SoF-Biljetter till Fredagen (Imorgon)</span><span class="price">130:-</span></li>
			<li><span class="first">Övrigt<br><span class="smallDate">2013-05-10</span></span><span class="rubrik">Stuff for sale (Double bed, single bed, tables, trolley etc)</span><span class="price">130:-</span></li>
			<li><span class="first">Övrigt<br><span class="smallDate">2013-05-10</span></span><span class="rubrik">Bokhylla nyskick från IKEA</span><span class="price">130:-</span></li>
		</ul>

	</div>
	
	<aside>
		<p>Annons för att lägga upp annons</p>
	</aside>
	
	<footer>
		<div class="nav">
				<ul class="left">
					<li>Om oss</li>
					<li>Så fungerar det</li>
				</ul>
				<img src="img/greyLogo.png">
				<ul class="right">
					<li><a href="faq.html">Vanliga frågor</a></li>
					<li>Kontakta oss</li>
				</ul>
		</div>
		<p class="copyright">Copyright &copy 2013 StudentTrade</p>
	</footer>
	
	
</div>
<script src="scripts/jquery-1.6.3.min.js" type="text/javascript"></script>
<script src="scripts/jquery.spritely-0.6.js" type="text/javascript"></script>

    <script type="text/javascript">
            $(document).ready(function() {
                $('#far-clouds').pan({fps: 30, speed: 0.7, dir: 'left', depth: 30});
                $('#near-clouds').pan({fps: 30, speed: 1, dir: 'left', depth: 70});
			});    
    </script>
</body>
</html>