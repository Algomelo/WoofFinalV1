<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            // Usuario con rol de administrador
            return view('homeAdmin');
        } elseif ($user->role === 'user') {
            $id = Auth::id();
            $user = User::users()->findOrFail($id);
            return view('home', compact('user'));
        } else {
            // Otros roles, puedes manejarlos según tus necesidades
            abort(403, 'Acceso no autorizado');
        }
}
}
