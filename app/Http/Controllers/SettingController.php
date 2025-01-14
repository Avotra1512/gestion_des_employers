<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setting;

class SettingController extends Controller
{
    // Méthode pour afficher les paramètres
    public function show()
{
    $settings = auth()->user()->setting;

    // Si les paramètres n'existent pas, créez-les avec des valeurs par défaut
    if (!$settings) {
        $settings = auth()->user()->setting()->create([
            'theme' => 'light', 
            'language' => 'en', 
            'dashboard_layout' => null,
        ]);
    }

    return view('settings.index', compact('settings'));
}

    // Méthode pour mettre à jour les paramètres
    public function update(Request $request)
    {
        $user = auth()->user();
        $user->setting->theme = $request->theme; // Sauvegarde dans la base de données
        $user->setting->save();
    
        // Sauvegarder le thème dans la session
        session(['theme' => $request->theme]);
    
        return redirect()->back()->with('success', 'Paramètres mis à jour avec succès.');
    }
    

    
    public function index()
    {
        // Récupérer les paramètres associés à l'utilisateur connecté
        $settings = auth()->user()->setting;

        // Passer les paramètres à la vue
        return view('settings.index', compact('settings'));
    }
    public function __construct()
{
    $this->middleware('auth'); // Cette ligne assure que seuls les utilisateurs authentifiés peuvent accéder à cette page
}
    
}

