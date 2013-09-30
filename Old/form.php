<?php include "data.php";

if (isset($_POST['sendBiljetter'])) {
	// The form was sent
	$rubrik = $_POST["rubrik"];
	$event = $_POST["event"];
	$beskrivning = $_POST["beskrivning"];
	$person = $_POST["person"];
	$kontakt = $_POST["kontakt"];
	
	createBiljetter($rubrik, $event, $beskrivning, $person, $kontakt);
	
	header("Location: biljetter.php?status=upplagd");
}
if (isset($_POST['sendBlandat'])) {
	//The form was sent
	$rubrik = $_POST["rubrik"];
	$beskrivning = $_POST["beskrivning"];
	$person = $_POST["person"];
	$kontakt = $_POST["kontakt"];

	createStandard('Blandat', $rubrik, $beskrivning, $person, $kontakt);
	header("Location: blandat.php?status=upplagd");
}
if (isset($_POST['sendJobb'])) {
	//The form was sent
	$rubrik = $_POST["rubrik"];
	$beskrivning = $_POST["beskrivning"];
	$person = $_POST["person"];
	$kontakt = $_POST["kontakt"];

	createStandard('Jobb', $rubrik, $beskrivning, $person, $kontakt);
	header("Location: jobb.php?status=upplagd");
}
if (isset($_POST['sendResor'])) {
	//The form was sent
	$rubrik = $_POST["rubrik"];
	$beskrivning = $_POST["beskrivning"];
	$person = $_POST["person"];
	$kontakt = $_POST["kontakt"];

	createStandard('Resor', $rubrik, $beskrivning, $person, $kontakt);
	header("Location: resor.php?status=upplagd");
}
if (isset($_POST['sendBostad'])) {
	//The form was sent
	$rubrik = $_POST["rubrik"];
	$beskrivning = $_POST["beskrivning"];
	$person = $_POST["person"];
	$kontakt = $_POST["kontakt"];

	createStandard('Bostad', $rubrik, $beskrivning, $person, $kontakt);
	header("Location: bostad.php?status=upplagd");
}
else{
	echo "Du har inte skickat något";
}

?>