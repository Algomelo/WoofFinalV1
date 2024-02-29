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
        $sistemsEmails = SistemsEmails::where('form', 'like', '%landing%')->get();
    
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
        $email = SistemsEmails::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'comment' => $request->message,
            'form' => "landing",
        ]);
    }


    public function export()
{
    return Excel::download(new SistemsEmailsExport, 'sistems_emails.xlsx');
}
}
