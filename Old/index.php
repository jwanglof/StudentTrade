<?php
// Auto load the classes that are called
function __autoload($class_name) {
	//class directories
	$base_dir = 'StudentTrade/';
	$directorys = array(
	    'Data/',
	    'Db/',
	    'Logic/',
	    'Views'
	);

	//for each directory
	foreach($directorys as $directory)
	{
	    //see if the file exsists
	    if(file_exists($base_dir.$directory.$class_name . '.php'))
	    {
	        require_once($base_dir.$directory.$class_name . '.php');
	        //only require the class once, so quit after to save effort (if you got more, then name them something else 
	        return;
	    }            
	}
}

// $a = new Mysql('localhost', 'jwanglof', 'testtest', 'jwanglof');
// $selected = $a->select($a, 'test', 'id=1');
// echo mysqli_num_rows($selected);
// $new_id = $a->insert($a, 'test', '(test, test2)', '(3322, 4432)');
// $a->update($a, 'test', 'test2=1', 'id='.$new_id);
// $a->close();
?>