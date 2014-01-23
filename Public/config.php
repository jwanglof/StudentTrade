<?php
return array(
	"slim" => array(
		"templates.path" 	=> realpath(dirname(__DIR__)) ."/Public/Templates",
		"log.level"			=> 4,
		"log.enabled"		=> true,
		/*"log.writer"		=> new \Slim\Extras\Log\DateTimeFileWriter(
			array(
				"path"				=> realpath(dirname(__DIR__)) ."/StudentTrade/Logs",
				"name_format"		=> "y-m-d",
				"message_format" 	=> "%label% - %date% - %message%"
			)
		),*/
		"view"				=> new \Slim\Views\Twig(),
		"mode" 				=> "development"
	),
	"twig" => array(),
	"cookies" => array()
);
?>