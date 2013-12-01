<?php
error_reporting(-1);
ini_set('display_errors', 1);

require_once("autoload_classes.php");
require_once("../Includes/Functions.php");

$config = array(
	'template_path' => array('../Templates/')
);

$rules = new Savant3($config);
// Need $dbh because header inherit it from it's parent, aka this file
$dbh = new DbSelect(); 
$title = "Regler";

$rules->header 					= include 'header.php';
$rules->footer 					= $rules->fetch("footer.tpl");
$rules->rightColumn 			= $rules->fetch("right.tpl");

$rules->display("rules.tpl");
?>