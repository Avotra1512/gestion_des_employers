<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;



class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }
    public function handleLogin(AuthRequest $request)
    {
        $credentials = $request->only(['email', 'password']);
        if(Auth::attempt($credentials)){
            return redirect()->route('dashboard');
        }else{
            return redirect()->back()->with('error_msg','Paramètre de connexion non reconnu');
        }
    }


    /**
     * Déconnecter un utilisateur et rediriger.
     */
    public function logout(Request $request)
    {
        Auth::logout(); // Déconnexion de l'utilisateur

        $request->session()->invalidate(); // Invalider la session
        $request->session()->regenerateToken(); // Générer un nouveau token CSRF

        return redirect('/'); // Redirection vers la page d'accueil ou une autre page
    }
    
}
