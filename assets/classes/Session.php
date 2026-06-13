<?php
class Session{
	static function authServidor($origemFile, $visitante=false){
		$idServidor = isset($_SESSION['UID_CERTS_FIFO']) ? $_SESSION['UID_CERTS_FIFO'] : null;

        $user = Session::getServidorUser($idServidor);
		if(!empty($user)){
			return $user;
		}
		else{
			if(!$visitante) Session::Sair("Usuario não encontrado. Faça login novamente !", $origemFile);
			return array();
		}
    }

    static function getServidorUser($id=null){
		//if($id==null){	return array(); }

		//require 'Sql.php';
        //$Sql = new Sql();

		//$user = $Sql->select1("SELECT * FROM usuarios WHERE .....");

		//retorno exemplo do Banco de Dados:
		$user = array('id'=>1,'nome'=>'Thiago');

		return $user;
    }
}
?>