<?php
	if(!session_id()){ session_start(); }
	date_default_timezone_set('America/Sao_Paulo');

	require dirname(__FILE__).DIRECTORY_SEPARATOR.'assets'.DIRECTORY_SEPARATOR.'classes'.DIRECTORY_SEPARATOR.'Session.php';
	require dirname(__FILE__).DIRECTORY_SEPARATOR.'assets'.DIRECTORY_SEPARATOR.'classes'.DIRECTORY_SEPARATOR.'Utils.php';

switch($_SERVER['REQUEST_METHOD']){
	case 'POST':{
		$arrReturn =  array('rs'=>false, 'msg'=>'');
		$params = Utils::receiveAjaxData('GET');
		$err = false;

		if(isset($params['a']) && isset($params['token']) && $params['token'] > time()){
			$servidor = Session::authServidor(__FILE__, true);
			$VAR_SERVIDOR_ID = isset($servidor['id']) ? $servidor['id'] : null;
			$VAR_NOME_SERVIDOR = ucwords(strtolower(isset($servidor['nome']) ? $servidor['nome'] : 'Anonimo'));

			$PATH = __DIR__.DIRECTORY_SEPARATOR.'py'.DIRECTORY_SEPARATOR;

			if(!empty($servidor)){
				$_RECV = Utils::receiveAjaxData('POST');
				$rs = false;	$id=0;

				$PATH_INPUT = $PATH.'queue'.DIRECTORY_SEPARATOR;
				$PATH_OUTPUT = $PATH.date('Y').DIRECTORY_SEPARATOR.date('m').DIRECTORY_SEPARATOR;
				if(!is_dir($PATH_OUTPUT)){
					@mkdir($PATH_OUTPUT, 0777, true);
				}

				switch($params['a']){	
					case 'sendQueue':{
						if(!empty($_RECV)){
							if(Utils::isCNPJ(isset($_RECV['cnpj']) ? $_RECV['cnpj']: '')){
								$cnpj = Utils::soNumeros($_RECV['cnpj']);

								$data = time();
								$request = $cnpj.'_'.$data.'.queue';

								if(is_dir($PATH_INPUT)){
									$search = glob($PATH_INPUT.$cnpj.'_*.*');

									if(empty($search)){
										$rs = file_put_contents($PATH_INPUT.$request, $VAR_SERVIDOR_ID);
										if($rs){
											$metaDados=array();
											$metaDados['cnpj'] = Utils::setMask($cnpj, '##.###.###/####-##');
											$metaDados['idRequest'] = crc32($data);
											$metaDados['data'] = date('d/m/Y H:i', $data);
											$metaDados['code'] = $cnpj.'_'.$data;
											$metaDados['status'] = 'ongoing';
											$metaDados['user'] = $VAR_NOME_SERVIDOR;

											$arrReturn['data'] = $metaDados;
											$arrReturn['rs'] = true;

										} else{
											$arrReturn['msg'] = 'Erro ao salvar requisição na fila.';
										}
									} else {
										$request = isset($search[0]) ? $search[0] : array();
										$user = $servidor;//Session::getServidorUser(@file_get_contents($request));

										$info = pathinfo($request);
										$ext = $info['extension'];
										$data = explode('_',$info['filename'])[1];

										$metaDados=array();
										$metaDados['cnpj'] = Utils::setMask($cnpj, '##.###.###/####-##');
										$metaDados['idRequest'] = crc32($data);
										$metaDados['data'] = $data!='' ? date('d/m/Y H:i', $data) : '';
										$metaDados['code'] = $cnpj.'_'.$data;
										$metaDados['status'] = $ext == 'lock' ? 'processing' : 'ongoing';
										$metaDados['user'] = isset($user['nome'])&&$user['nome']!='' ? $user['nome'] : 'Usuário';

										$arrReturn['data'] = $metaDados;
										$arrReturn['rs'] = true;
										$arrReturn['msg'] = 'Já existe uma requisição para esse CNPJ.';
									}
								} else {	$arrReturn['msg'] = 'Diretório de entrada não encontrado !';}
							} else {	$arrReturn['msg'] = 'CNPJ inválido !';}
						} else {	$arrReturn['msg'] = 'Sem dados recebidos !';}
						break;
					}
					
					default:
						$err = true;
				}

				$arrReturn['rs'] = $arrReturn['rs']!=null && is_bool($arrReturn['rs']) ? $arrReturn['rs'] : (is_string($rs) ? false : $rs===true || $rs>0);
				if(is_numeric($rs) && $rs>0) $arrReturn['id'] = $rs;
				$arrReturn['msg'] = $arrReturn['msg']!==null ? $arrReturn['msg'] : (is_string($rs) ? $rs : ($arrReturn['rs']===true ? 'Salvo com Sucesso !' : 'Error: Ajax'));
			}
			else{
				$arrReturn['rs'] = -1;
				$arrReturn['html'] = '';
				$arrReturn['msg'] = 'Error: Sessão expirada !';
			}

			if(!$err) echo json_encode($arrReturn, JSON_NUMERIC_CHECK);
		}
		break;
	}
}
?>