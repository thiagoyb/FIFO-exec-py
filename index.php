<?php
    session_start();
	date_default_timezone_set('America/Sao_Paulo');

	require dirname(__FILE__).DIRECTORY_SEPARATOR.'assets'.DIRECTORY_SEPARATOR.'classes'.DIRECTORY_SEPARATOR.'Session.php';
	require dirname(__FILE__).DIRECTORY_SEPARATOR.'assets'.DIRECTORY_SEPARATOR.'classes'.DIRECTORY_SEPARATOR.'Utils.php';
	require dirname(__FILE__).DIRECTORY_SEPARATOR.'assets'.DIRECTORY_SEPARATOR.'classes'.DIRECTORY_SEPARATOR.'Config.php';

	$servidor = Session::authServidor(__FILE__);

	$VAR_NOME_SERVIDOR = ucwords(strtolower(isset($servidor['nome']) ? $servidor['nome'] : 'Anonimo'));
	$VAR_SERVIDOR_ID = isset($servidor['id']) ? $servidor['id'] : 0;

	$PROTOCOL = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ? 'https://' : 'http://');
	$URL_HOME = isset($ENV_SETTINGS['URL']) ? $PROTOCOL.$ENV_SETTINGS['URL'] : $PROTOCOL.$_SERVER['HTTP_HOST'].'certidoes';
	$PATH = isset($ENV_SETTINGS['PATH']) ? $ENV_SETTINGS['PATH'] : __DIR__.DIRECTORY_SEPARATOR.'py'.DIRECTORY_SEPARATOR;
	$p = isset($_GET['p']) && $_GET['p']!='' ? $_GET['p'].'.php' : 'certidoes.php';
//echo $URL_HOME;exit;

	require $p;
	exit;
?>