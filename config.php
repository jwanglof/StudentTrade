<?php
return array(
	"slim" => array(
		"templates.path" 	=> __DIR__ ."/StudentTrade/Templates",
		"log.level"			=> 4,
		"log.enabled"		=> true,
		"log.writer"		=> new \Slim\Extras\Log\DateTimeFileWriter(
			array(
				"path"				=> __DIR__ ."/Logs",
				"name_format"		=> "y-m-d",
				"message_format" 	=> "%label% - %date% - %message%"
			)
		),
		"view"				=> new \Slim\Views\Twig()
	),
	"twig" => array(),
	"cookies" => array(),
);
?>