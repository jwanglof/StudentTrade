<?php
// Auto load the classes that are called
spl_autoload_register(function ($class) {
	$base_dir = '../';
	$directories = array(
		'Class/',
		'Db/',
		// 'Views'
	);

	//for each directory
	foreach($directories as $directory)
	{
		//see if the file exsists
		if(file_exists($base_dir.$directory.$class . '.php'))
		{
			include($base_dir.$directory.$class . '.php');
			//only require the class once, so quit after to save effort (if you got more, then name them something else
			return;
		}
	}
});
?>