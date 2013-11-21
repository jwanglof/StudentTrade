<?php
ob_start();
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	// Auto load the classes that are called
	spl_autoload_register(function ($class) {
		$base_dir = "../";
		$directories = array(
			// "Class/",
			"Db/",
			"Admin/Db/"
			// "Logic/"
			// "Views"
		);

		//for each directory
		foreach($directories as $directory)
		{
			//see if the file exsists
			if(file_exists($base_dir.$directory.$class .".php"))
			{
				include($base_dir.$directory.$class .".php");
				//only require the class once, so quit after to save effort (if you got more, then name them something else
				return;
			}
		}
	});

	$dbh = new AdminDb();
	$adminQuery = $dbh->getAdmin($_POST["username"], $_POST["password"]);
	
	if (count($adminQuery) > 1)
		$_SESSION["admin"] = True;
	else
		$_SESSION["admin"] = False;
}
echo $_SESSION["admin"];
if (!$_SESSION["admin"]) {
?>
<form method="post" action="index.php">
	<input type="text" name="username" id="username" placeholder="Användarnamn" />
	<input type="password" name="password" id="password" placeholder="Lösenord" />
	<input type="submit" value="Logga in" />
</form>
<?php
} else {
?>
<
<?php
}
// unset($_SESSION["admin"]);
?>