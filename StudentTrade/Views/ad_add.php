<?php
$requiredInputs = ["name", "email", "city", "category"];

foreach ($_POST as $key => $value) {
	if (in_array($key, $requiredInputs)) {
		if (!empty($value))
			echo $key ." ++ ". $value;
		else
			echo $key ." ++ No value";
	} else {
		echo $key ." -- ". $value;
	}
	echo "<br />";
}
?>