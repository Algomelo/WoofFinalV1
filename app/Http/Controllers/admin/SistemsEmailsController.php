<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Models\SistemsEmails;
use App\Http\Controllers\Controller;
use App\Exports\SistemsEmailsExport;
use Maatwebsite\Excel\Facades\Excel;
use App\EModels\User;

class SistemsEmailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function indexlanding(){
        $sistemsEmails = SistemsEmails::where('form', 'landing')->get();
    
        return view('admin.contactLanding', compact('sistemsEmails'));
    }
    
    public function indexcontact(){
        $sistemsEmails = SistemsEmails::where('form', 'contact')->get();

    
        return view('admin.contactLanding', compact('sistemsEmails'));

    }
    public function indexcontactjob(){
        $sistemsEmails = SistemsEmails::where('form', 'contactJob')->get();
    
        return view('admin.contactLanding', compact('sistemsEmails'));

    }

    public function storecontact(Request $request)
    {
        $email = SistemsEmails::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'comment' => $request->message,
            'form' => "contact",
        ]);
    }
    public function storecontactjob(Request $request)
    {
        $email = SistemsEmails::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'comment' => $request->message,
            'form' => "contactJob",
        ]);
    }
    public function storecontactlanding(Request $request)
    {
        try {
            $email = SistemsEmails::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'comment' => $request->message,
                'form' => "landing",
            ]);
            return response()->json(['status' => 'success']);
            }
            catch (\Exception $e) {
                dd($e->getMessage()); // Agrega esta línea para ver el mensaje de error específico
                return response()->json(['status' => 'error', 'message' => 'Error al enviar la solicitud. Por favor, inténtalo de nuevo más tarde.']);
            }
        }


    public function export()
{
    return Excel::download(new SistemsEmailsExport, 'sistems_emails.xlsx');
}
}
