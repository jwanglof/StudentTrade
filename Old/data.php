<?php

//skapa connection till databas
function createConnection() {
	$con = mysql_connect("83.168.227.169", "u1162056_ehidrup", "erik4321");
	if(!$con){
		die("Could not connect:".mysql_error());
	}
	mysql_query("SET NAMES 'utf8'");
	mysql_select_db("db1162056_studenttrade",$con);
	return $con;
}
// skapar en tupel i tabellen för Biljetter
function createBiljetter($rubrik, $event, $beskrivning, $person, $kontakt) {
	$con = createConnection();
	$annonsTyp = '1';
	$stad = '1';
	
	//kom ihåg att sql-protecta
	//$name = mysql_real_escape_string($name);
	
	//id, date, annonsTyp, rubrik, event, beskrivning, person, kontakt, stad
	$query = "INSERT INTO Biljetter VALUES(null, null,'$annonsTyp','$rubrik','$event','$beskrivning','199','$person','$kontakt','$stad')";
	
	mysql_query($query);
	mysql_close($con);
}
function createStandard($tabell, $rubrik, $beskrivning, $person, $kontakt) {
	$con = createConnection();
	$annonsTyp = '1';
	$stad = '1';
	
	//kom ihåg att sql-protecta
	//$name = mysql_real_escape_string($name);
	
	//id, date, annonsTyp, rubrik, beskrivning, person, kontakt, stad
	$query = "INSERT INTO $tabell VALUES(null, null,'$annonsTyp','$rubrik','$beskrivning','$person','$kontakt','$stad')";
	
	mysql_query($query);
	mysql_close($con);
}
function skrivUtBiljetter() {
	echo "<ul class=\"annonsList\">";
	$con = createConnection();
	$query = "SELECT id, date, rubrik, event, pris FROM Biljetter ORDER BY date DESC";
	$result = mysql_query($query, $con);
	while($array = mysql_fetch_array($result)){
		$id = $array["id"];
		if($array["pris"] != null){
			$pris = $array["pris"] . ":-";
		}
		else{
			$pris = null;
		}
		
		echo "<a href=\"annons.php?select=Biljetter&id=$id\"><li><span class=\"first\">";
		echo substr($array["date"], 0, 10);
		echo "</span><span class=\"rubrik\">" . $array["rubrik"] . "</span><span class=\"price\">" . $pris . "</span></li></a>";

	}
	echo "</ul>";
	mysql_close($con);
}
function skrivUtStandard($tabell) {
	echo "<ul class=\"annonsList\">";
	$con = createConnection();
	if($tabell == 'Blandat'){
		$query = "SELECT id, date, rubrik, pris FROM $tabell ORDER BY date DESC";
	}
	else{
		$query = "SELECT id, date, rubrik FROM $tabell ORDER BY date DESC";
	}
	$result = mysql_query($query, $con);
	while($array = mysql_fetch_array($result)){
		$id = $array["id"];
		if($array["pris"] != null){
			$pris = $array["pris"] . ":-";
		}
		else{
			$pris = null;
		}
		
			if($tabell == 'Blandat'){
				echo "<a href=\"annons.php?select=$tabell&id=$id\"><li><span class=\"first\">";
				echo substr($array["date"], 0, 10);
				echo "</span><span class=\"rubrik\">" . $array["rubrik"] . "</span><span class=\"price\">" . $pris . "</span></li></a>";
			}
			else{
				echo "<a href=\"annons.php?select=$tabell&id=$id\"><li><span class=\"first\">";
				echo substr($array["date"], 0, 10);
				echo "</span><span class=\"rubrik\">" . $array["rubrik"] . "</span><span class=\"price\"></span></li></a>";
			}		
	}
	echo "</ul>";
	mysql_close($con);
}
function skrivUtAnnons($tabell, $id){
	$con = createConnection();
	$query = "SELECT * FROM $tabell WHERE id='$id'";
	
	$result = mysql_query($query, $con);
	while($array = mysql_fetch_array($result)){
		$annonsData = array(
		"tabell" => $tabell,
		"date" => $array["date"],
		"rubrik" => $array["rubrik"],
		"beskrivning" => $array["beskrivning"],
		"person" => $array["person"],
		);
	}
	return $annonsData;
}
function senasteAnnonserna($antal){
	$con = createConnection();
	$query = "SELECT Biljetter.id AS id, Biljetter.rubrik AS rubrik, Biljetter.date AS date, Biljetter.pris AS pris, 'Biljetter' AS tableName
				FROM Biljetter

			UNION
			SELECT Blandat.id AS id, Blandat.rubrik AS rubrik, Blandat.date AS date, Blandat.pris AS pris, 'Blandat' AS tableName
			FROM Blandat

			UNION
			SELECT Bostad.id AS id,	Bostad.rubrik AS rubrik, Bostad.date AS date, null AS pris, 'Bostad' AS tableName
			FROM Bostad

			UNION
			SELECT Jobb.id AS id, Jobb.rubrik AS rubrik, Jobb.date AS date, null AS pris, 'Jobb' AS tableName
			FROM Jobb

			UNION
			SELECT Resor.id AS id, Resor.rubrik AS rubrik, Resor.date AS date, null AS pris, 'Resor' AS tableName
			FROM Resor

			ORDER BY date DESC limit $antal";
	echo "<ul class=\"annonsList\">";
	$result = mysql_query($query, $con);
	while($array = mysql_fetch_array($result)){
		$tabell = $array["tableName"];
		$bild = strtolower($tabell);
		$id = $array["id"];
		if($array["pris"] != null){
			$pris = $array["pris"] . ":-";
		}
		else{
			$pris = null;
		}
		
		echo "<li><a href=\"annons.php?select=$tabell&id=$id\"><span class=\"first\">" . $array["tableName"] . "<br><span class=\"smallDate\">" . $array["date"] . "</span></span><span class=\"rubrik\">" . $array["rubrik"] . "</span><span class=\"price\">" . $pris . "</span></a></li>";
		
	}
	echo "</ul>";
	mysql_close($con);
}

function removeBok($tabell, $id){
	$con = createConnection();
	$id = mysql_real_escape_string($id);
	
	$query = "DELETE FROM $tabell WHERE id='$id'";
	
	mysql_query($query);
	mysql_close($con);
}


?>