<?php 
	// echo (isset($_GET["type"]) ? $adCategory["description"] : "Senaste annonserna"); 
	if (isset($_GET["type"]) && empty($_GET["aid"])) {
		echo $adCategory["description"];
	} elseif (isset($_GET["aid"])) {
		echo $title;
	} else {
		echo "Senaste annonserna";
	}
?>
					<br />
					<span>
						<ol class="breadcrumb">
							<li><a href="front.php?page=latest&city=<?php echo $city["short_name"]; ?>"><?php echo $city["city_name"]; ?></a></li>
							<?php
							if (isset($_GET["campus"])) {
								foreach ($campuses[0] as $key => $value) {
									if (replaceSwedishLetters(replaceSpecialChars(strtolower($value["campus_name"]))) == $_GET["campus"])
										echo "<li><a href=\"#\">". $value["campus_name"] ."</a></li>";
								}
							}
							if (isset($_GET["type"])) {
								foreach ($adtypes as $key => $value) {
									if ($value["name"] == $_GET["type"])
										echo "<li><a href=\"#\">". $value["description"] ."</a></li>";
								}
							}
							if (isset($_GET["aid"])) {
								echo "<li><a href=\"#\">". $title ."</a></li>";
							}
							?>
						</ol>
					</span>