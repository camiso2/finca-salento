<?php

namespace App\Custom;
use DateTime;


define('METHOD','AES-256-CBC');
define('SECRET_KEY','$fincasalento@2022');
define('SECRET_IV','101712');

class authenticate
{


	public static function creation_publication($fetch_register){
		$Fecha = new \DateTime();
		$FechaActual = $Fecha->format('Y-m-d H:i:s');
		$actual_os = new DateTime($FechaActual);
		$fecha_registro = new DateTime($fetch_register);
		$interval = $actual_os->diff($fecha_registro);
		$dias =  (int) $interval->format('%R%a');
		$horas = (int) $interval->format('%H');
		$min = (int) $interval->format('%I');
		if ($dias*(-1)>31) {
			$result = "hace "."mas de un mes";
		}else{
			if ($dias*(-1)>0) {
				if ($dias*(-1) == 1) {
					$result = "hace ".$dias*(-1)." día";
				}else{
					$result = "hace ".$dias*(-1)." días";
				}
			}else{
				if ($horas>1) {
					$result = "hace ".$horas." horas";
				}else{
					if ($min <= 1) {
						$result = "hace "."1 minuto";
					}else{
						$result = "hace ".$min." minutos";
					}
				}
			}
		}
		return $result;
	}
	public static function deleted_records($url){
		$files = glob($url.'tmp/*');
		foreach($files as $file){
			if(is_file($file))
				unlink($file);
		}
		return 'ok';
	}

	public static function encryption($string){
		$output=FALSE;
		$key=hash('sha256', SECRET_KEY);
		$iv=substr(hash('sha256', SECRET_IV), 0, 16);
		$output=openssl_encrypt($string, METHOD, $key, 0, $iv);
		$output=base64_encode($output);
		return $output;
	}
	public static function decryption($string){
		$key=hash('sha256', SECRET_KEY);
		$iv=substr(hash('sha256', SECRET_IV), 0, 16);
		$output=openssl_decrypt(base64_decode($string), METHOD, $key, 0, $iv);
		return $output;
	}
}
