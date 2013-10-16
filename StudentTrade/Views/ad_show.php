<?php
$dbh = new DbSelect();
$adInfo = $dbh->getAdFromID($_GET["aid"]);
$dbh = null;
print_r($adInfo);

?>
<div class="col-md-12" style="color: #464646;">
	<h1><?php echo $adInfo["title"]; ?></h1>
	<?php echo $adInfo["info"]; ?>
</div>