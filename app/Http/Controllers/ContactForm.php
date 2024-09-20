<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\Enviarcorreo;
use App\Rules\Recaptcha;
use App\Models\SistemsEmails;

class ContactForm extends Controller
{


public function EnviarCorreoContact(Request $request)
    {

        $request->validate([
            'g-recaptcha-response' => ['required', new Recaptcha]

        ]);
        // Aquí puedes validar los datos del formulario
        // Procesa y almacena los datos de la solicitud
        // Enviar el correo a dos direcciones de correo electrónico
        $data = $request->all();


     
        try {
            // Define las direcciones de correo a las que deseas enviar
            $toEmails = ['info@ohmywoof.com.au', 'juanpava1212@gmail.com'];
    
            // Envia el correo a ambas direcciones
            Mail::to($toEmails)
                ->send(new Enviarcorreo($data));


            return response()->json(['status' => 'success']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Error al enviar la solicitud. Por favor, inténtalo de nuevo más tarde.']);
        }
    }
}


