<?php
	if(!session_id()) session_start();

	$servidor = isset($servidor) ?  $servidor : array();
	$pasta = isset($_GET['code']) && $_GET['code']!='' ? $_GET['code'] : null;
	$key = isset($_GET['key']) && $_GET['key']!='' ? $_GET['key'] : null;

if(basename($_SERVER['PHP_SELF'])=='certidao.php'){
	header("Location: index.php?p=certidao&code={$pasta}&key={$key}");
	exit;
}

if(!empty($servidor) && $pasta!=null && $key!=null){
	$PATH = isset($PATH) ? $PATH : '.';
	$PATH_OUTPUT = $PATH.date('Y').DIRECTORY_SEPARATOR.date('m').DIRECTORY_SEPARATOR.$pasta.DIRECTORY_SEPARATOR;
	$PDF = $PATH_OUTPUT.$key.'.pdf';

	if(file_exists($PDF)){
		header("Content-Type: application/pdf");
		header("Content-Disposition: inline; filename=".basename($PDF));
		header('Content-Transfer-Encoding: binary');
		header('Accept-Ranges: bytes');
		@readfile($PDF);
	} else{ ?>
		<META http-equiv="refresh" content="0; index.php?ref=certidao"></META><?php
		echo 'error:';
		exit;
	}	
} else{ ?>
	<META http-equiv="refresh" content="0; index.php?ref=certidao"></META><?php
	echo 'error:';
	exit;
}		
?>