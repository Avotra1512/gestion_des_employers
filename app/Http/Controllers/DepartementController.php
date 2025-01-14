<?php

namespace App\Http\Controllers;

use App\Departement;
use Illuminate\Http\Request;
use App\Http\Requests\saveDepartementRequest;

class DepartementController extends Controller
{
    public function index(){
        $departements = Departement::paginate(10);
        return view('departements.index', compact('departements'));

    }


    public function create(){
        return view('departements.create');
    }

    
    public function edit(Departement $departement){
        return view('departements.edit', compact('departement'));
    }

    
    public function store(Departement $departement, saveDepartementRequest $request)
    {
        //Enregistrer un nouveau département
        try {
            
            $departement->name = $request->name;
            $departement->apropos = $request->apropos;

            $departement->save();

            return redirect()->route('departement.index')->with('success_message','Sérvice enregistré');

        } catch (Exception $e) {
            dd($e);
        }
       
    }


    //Interraction avec la BD
    public function update(Departement $departement, saveDepartementRequest $request)
    {
        //Enregistrer un nouveau département
        try {
            
            $departement->name = $request->name;
            $departement->apropos = $request->apropos;

            $departement->update();

            return redirect()->route('departement.index')->with('success_message','Sérvice mis à jour');

        } catch (Exception $e) {
            dd($e);
        }
       
    }


    public function delete(Departement $departement)
    {
        

        //Enregistrer un nouveau département
        try {
            // Vérifiez si le département a des employés
            if ($departement->employers()->count() > 0) {
                return redirect()->back()->with('error', 'Impossible de supprimer ce sérvice car des employés y sont encore assignés.');
    }
            $departement->delete();

            return redirect()->route('departement.index')->with('success_message','Sérvice supprimé');

        } catch (Exception $e) {
            dd($e);
        }
       
    }

    public function search(Request $request)
{
    $searchTerm = $request->input('searchorders');

    // Vérifier si un terme de recherche est donné
    if ($searchTerm) {
        // Recherche dans les départements
        $departements = Departement::query()
            ->where('name', 'LIKE', "%{$searchTerm}%")
            ->paginate(10);

        return view('departements.index', compact('departements', 'searchTerm'));
    } else {
        // Si aucun terme de recherche, afficher tous les départements
        $departements = Departement::paginate(10);

        return view('departements.index', compact('departements'));
    }
}

public function showEmployes($id)
{
    $departements = Departement::findOrFail($id); // Trouver le département par ID
    $employers = $departements->employers; // Récupérer les employés associés

    return view('departements.employes', compact('departements', 'employers'));
}



}
