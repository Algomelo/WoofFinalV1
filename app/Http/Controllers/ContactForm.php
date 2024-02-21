<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\Enviarcorreo;
use App\Rules\Recaptcha;

class ContactForm extends Controller
{




public function EnviarCorreoContact(Request $request)
    {
        // Aquí puedes validar los datos del formulario
        // Procesa y almacena los datos de la solicitud
        // Enviar el correo a dos direcciones de correo electrónico
        $data = $request->all();
     
        try {
            // Define las direcciones de correo a las que deseas enviar
            $toEmails = ['info@ohmywoof.com.au', 'daniel1999san1@gmail.com', 'fabianrodriguezbrochero98@gmail.com'];
    
            // Envia el correo a ambas direcciones
            Mail::to($toEmails)
                ->send(new Enviarcorreo($data));
    
            return response()->json(['message' => 'Solicitud enviada con éxito'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al enviar la solicitud. Por favor, inténtalo de nuevo más tarde.'], 500);
        }
    }
}


