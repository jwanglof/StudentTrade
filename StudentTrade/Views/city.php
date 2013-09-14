<?php
$city = $_GET['city'];

$pdod = new DbSelect();
print_r($pdod->login("jwanglof", "asdf")[0]["username"]);
?>