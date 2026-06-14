<?php
    session_start();
	date_default_timezone_set('America/Sao_Paulo');

	require dirname(__FILE__).DIRECTORY_SEPARATOR.'assets'.DIRECTORY_SEPARATOR.'classes'.DIRECTORY_SEPARATOR.'Session.php';
	require dirname(__FILE__).DIRECTORY_SEPARATOR.'assets'.DIRECTORY_SEPARATOR.'classes'.DIRECTORY_SEPARATOR.'Utils.php';

	$servidor = Session::authServidor(__FILE__);

	$VAR_NOME_SERVIDOR = ucwords(strtolower(isset($servidor['nome']) ? $servidor['nome'] : 'Anonimo'));
	$VAR_SERVIDOR_ID = isset($servidor['id']) ? $servidor['id'] : 0;

	$PROTOCOL = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ? 'https://' : 'http://');
	$URL_HOME = $PROTOCOL.$_SERVER['HTTP_HOST'].'certidoes';
	$PATH = $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'certidoes'.DIRECTORY_SEPARATOR.'py'.DIRECTORY_SEPARATOR;
	$p = isset($_GET['p']) && $_GET['p']!='' ? $_GET['p'].'.php' : 'certidoes.php';
//echo $URL_HOME;exit;

	require $p;
	exit;
?>