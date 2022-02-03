<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class RosarioController extends Controller
{
    public function contacto(Request $request)
	{

		//dd($request->all());
		$this->validate($request, [
			'_token'=>'required',
			'nombre'=>'required|max:50',
			//'asunto'=>'required|max:50',
			'email' => 'required|email|max:50',
			'telefono'=>'numeric|required|digits_between:0,14',
			'mensaje'=>'required|max:500',
			'g-recaptcha-response' => 'recaptcha',
		]);
		$mensaje="";
		$para    = 'info@elrosario-salento.com';
		$titulo    = 'Email enviado desde form contacto elrosario-salento.com';
		$mensaje .= "Nombre: " . $request->input('nombre') . "\n\n";
		$mensaje .= "E-mail: " . $request->input('email'). "\n\n";
		$mensaje .= "Teléfono: " . $request->input('telefono'). "\n\n";
		$mensaje .= "Mensaje: " .wordwrap($request->input('mensaje'),100,"\r\n");
		$cabeceras = 'From: info@elrosario-salento.com' . "\r\n" .'Reply-To: info@elrosario-salento.com' . "\r\n" .'X-Mailer: PHP/' . phpversion();
		$success = mail($para, utf8_decode($titulo), utf8_decode($mensaje) , $cabeceras);
		if (!$success) {
			//$errorMessage = error_get_last()['message'];
			return redirect()->back()->with('alert_error', 'No pudimos recibir su mensaje, contacte con el administrador; contacte con el administrador de El Rosario Salento , lamentamos el incoveniente !');

		}else{

			return Redirect::back()->with('alert_success', 'En poco tiempo nuestros asesores se comunicarán con usted ! ');
		}
	}

    public function suscribirse(Request $request)
	{
		//dd($request->all());
		$this->validate($request, [
			'email' => 'required|email|max:50',
		]);
		$mensaje="";
		$para    = 'info@elrosario-salento.com';
		$titulo    = 'Email enviado desde formulario de suscripción elrosario-salento.com';
		$mensaje .= "Una persona se suscribio en el portal de elrosario-salento.com: " . "\n\n";
		$mensaje .= "E-mail: " . $request->input('email'). "\n\n";
		$mensaje .=
		$cabeceras = 'From: info@elrosario-salento.com' . "\r\n" .'Reply-To: info@elrosario-salento.com' . "\r\n" .'X-Mailer: PHP/' . phpversion();
		$success = mail($para, utf8_decode($titulo), utf8_decode($mensaje) , $cabeceras);
		if (!$success) {
			//$errorMessage = error_get_last()['message'];
			return redirect()->back()->with('alert_error', 'La suscripción no se pudo realizar, contacte con el administrador de elrosario-salento.com, lamentamos el incoveniente !');
		}else{
			return Redirect::back()->with('alert_success', 'GRACIAS por suscribirse, pronto tendrá noticias de nuestro hotel !');
		}
	}

    public function reserva(Request $request){
        return redirect()->back()->with('alert_reserva', 'La Función de reserva está deshabilitada por favor contáctenos por WhatsApp, ');
    }
}
