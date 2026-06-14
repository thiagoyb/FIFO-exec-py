<?php
	$ENV_SETTINGS=array();
	foreach(explode(PHP_EOL, file_get_contents(dirname(dirname(dirname(__FILE__))).DIRECTORY_SEPARATOR.'.env')) as $s){
		if(strpos($s,'=')!==false){
			$ENV_SETTINGS[substr($s, 0, strpos($s,'='))] = substr($s, strpos($s,'=')+1);
		}
	}
//var_dump($ENV_SETTINGS);exit;
?>