<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\EnviarcorreoJob;
use App\Rules\Recaptcha;

class ContactJobController extends Controller
{
public function EnviarContactJob(Request $request)
    {
        // Aquí puedes validar los datos del formulario
        // Procesa y almacena los datos de la solicitud
        $request->validate([
            'g-recaptcha-response' => ['required', new Recaptcha]

        ]);
        // Enviar el correo a dos direcciones de correo electrónico
        $data = $request->all();
        

        try {
            // Define las direcciones de correo a las que deseas enviar
            $toEmails = ['info@ohmywoof.com.au', 'daniel1999san1@gmail.com', 'fabianrodriguezbrochero98@gmail.com'];

            // Envia el correo a ambas direcciones
            Mail::to($toEmails)
                ->send(new EnviarcorreoJob($data));
    
            return response()->json(['status' => 'success']);
            } catch (\Exception $e) {
            dd($e->getMessage()); // Agrega esta línea para ver el mensaje de error específico
            return response()->json(['status' => 'error', 'message' => 'Error al enviar la solicitud. Por favor, inténtalo de nuevo más tarde.']);
        }
    }
}
