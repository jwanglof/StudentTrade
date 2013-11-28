<?php
error_reporting(-1);
ini_set('display_errors', 1);
require("../Class/vendor/autoload.php");
use Rain/Tpl;
$config = array(
	// "tpl_dir"		=> "vendor/rain/raintpl/templates/test/",
	// "cache_dir"		=> "vendor/rain/raintpl/cache/"
	"tpl_dir"		=> "../StudentTrade/Views/",
	"cache_dir"		=> "../Cache",
	"debug"			=> true
);
Tpl::configure( $config );

$variables = array(
	"title"				=> "HEJHEJEHEJ"
);

$tpl = new Tpl;
$tpl->assign($variables);
echo $tpl->draw("front")
?>