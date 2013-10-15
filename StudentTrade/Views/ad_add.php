<div style="color: #000;">
<?php
$requiredInputs = ["name", "email", "city", "adType", "info"];
$adTypeInfoShortNames = [];
foreach($dbh->getAdTypeInfoShortNames() as $val) {
	foreach ($val as $key => $value) {
		array_push($adTypeInfoShortNames, $value);
	}
}

// print_r($_POST);
foreach ($_POST as $key => $value) {
	if (in_array($key, $requiredInputs)) {
		echo "Required value: ". $key .". Value: ". $value;
	} else if (in_array($key, $adTypeInfoShortNames)) {
		echo "adTypeInfo: ". $key .". Value: ". $value;
	} else {
		echo $key ." -- ". $value;
	}
	echo "<br />";
}
?>
</div>