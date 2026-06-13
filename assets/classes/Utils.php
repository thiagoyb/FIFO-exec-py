<?php
class Utils{
	static function UID($data = null){
		$data = $data ?? random_bytes(16);
		$data = substr(str_pad($data,16,' ', STR_PAD_LEFT),0,16);

		//assert(strlen($data) == 16);
		return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
	}
	static function hashrot13($s){
		return str_rot13($s);
	}	
	static function geraToken(){
		return md5(uniqid(rand(), true));
	}

	static function soNumeros($str){
		return preg_replace("/[^0-9]/", '', $str);
	}
	
	static function toFloat($value){
		return strtr(preg_replace("/\s+/", '', $value), array('.'=>'', ','=>'.'));
	}
	static function byteConvert($bytes){
		if($bytes==0) return '0B';
		$s = array('B', 'K', 'M', 'G', 'T', 'P','E','Z','Y');
		$e = floor(log($bytes, 1024));
		return round($bytes/pow(1024, $e), 2).$s[$e];
	}
	static function isJsonStr($str){
		return is_string($str) && json_encode(json_decode($str,JSON_NUMERIC_CHECK))===$str;
	}
	static function isCPF($cpf){
			$iguais=1;
			$cpf = self::soNumeros($cpf);
			if(strlen($cpf) != 11){
				return false;
			}
			for($i = 0; $i < strlen($cpf) - 1; $i++){
				if($cpf[$i] != $cpf[$i+1]){
					$iguais = 0;
					break;
				}
			}
			if($iguais){
				return false;
			}
			$soma = 0;
			for($i=0;$i<9;$i++){
				$soma += $cpf[$i] *(10-$i);
			}
			$rev = 11 - ($soma % 11);
			$rev = $rev == 10 || $rev == 11 ? 0 : $rev;
			if($rev != $cpf[9]){
				return false;
			}
			$soma = 0;
			for($i = 0; $i < 10; $i++){
				$soma += $cpf[$i] * (11 - $i);
			}
			$rev = 11 - ($soma % 11);
			$rev = $rev == 10 || $rev == 11 ? 0 : $rev;
			if($rev != $cpf[10]){
				return false;
			}
		  return true;
		}
	static function isCNPJ($cnpj){
			$iguais=1;
			$cnpj = self::soNumeros($cnpj);
			if(strlen($cnpj) != 14){
				return false;
			}
			for($i = 0; $i < strlen($cnpj) - 1; $i++){
				if($cnpj[$i] != $cnpj[$i+1]){
					$iguais = 0;
					break;
				}
			}
			if($iguais){
				return false;
			}
			$tamanho = strlen($cnpj) - 2;
			$num = substr($cnpj,0,$tamanho);
			$dv = substr($cnpj,-2,1);
			$soma = 0;	$pos = $tamanho - 7;
			for($i = $tamanho; $i >= 1; $i--){
				$soma += intval($num[$tamanho - $i]) * $pos--;
				if($pos < 2){
					$pos = 9;
				}
			}
			$rev = $soma % 11 < 2 ? 0 : 11 - $soma % 11; 
			if($rev != $dv){
				return false;
			}
			$tamanho++;
			$num = substr($cnpj,0,$tamanho);
			$dv = substr($cnpj,-1,1);
			$soma = 0;	$pos = $tamanho - 7;
			for($i = $tamanho; $i >= 1; $i--){
				$soma += intval($num[$tamanho - $i]) * $pos--;
				if($pos < 2){
					$pos = 9;
				}
			} 
			$rev = $soma % 11 < 2 ? 0 : 11 - $soma % 11;
			if($rev != $dv){
				return false;
			}
			return true;
		}
	
	static function setMask($val, $mask){
		 $maskared = '';
		 $k = 0;
		 for($i = 0; $i<=strlen($mask)-1; $i++){
			if($mask[$i] == '#'){
				if(isset($val[$k])){
					$maskared .= $val[$k++];
				}
			} else{
				if(isset($mask[$i])){
					$maskared .= $mask[$i];
				}
			}
		 }
		 return $maskared;
	}
	static function array_get($data){
		return $data!=null && is_array($data) ? $data : array();
	}

	static function receiveAjaxData($method=null){
		$_RECV = array();
		$INPUT = file_get_contents('php://input');

		switch($method){
			case 'GET':{
				$_RECV = isset($_GET) && $_GET!=null ? $_GET : array();
				break;
			}
			case 'POST':{
				$_RECV = isset($_POST) && $_POST!=null ? $_POST : array();
				break;
			}
			case 'DELETE':
			case 'OPTIONS':
			case 'PUT':{
				if(strpos($INPUT,'=')!==false){
					parse_str($INPUT,$_RECV);
				} else{
					$_RECV = json_decode($INPUT,JSON_NUMERIC_CHECK);
				}
				break;
			}
		}

		return Utils::cast($_RECV);
	}
	static function teste($a){ return 'Received: = '.$a; }
}
?>