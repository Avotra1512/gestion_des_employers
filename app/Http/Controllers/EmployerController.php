<?php

//Fichier: EmployerController.php
//Crée par Avotra
//Date de création : 
//Derniere modification: 27/11/2024
//Recommandation : Action (insertion, modification et suppression des employers) dans la base
//Prise de notes : Ajuster le dashboard

namespace App\Http\Controllers;

use App\Employer;
use App\Departement;
use Illuminate\Http\Request;
use App\Http\Requests\StoreEmployeRequest;
use App\Http\Requests\UpdateEmployerRequest;
use Illuminate\Support\Facades\Storage;
use App\Imports\EmployersImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Log;
use PDF;



class EmployerController extends Controller
{
    public function index(){
        $employers = Employer::with('departement')->paginate(10);
        return view('employers.index', compact('employers'));

    }


    public function create(){
        $departements = Departement::all();
        return view('employers.create', compact('departements'));
    }

    
    public function edit(Employer $employer){
        $departements = Departement::all();
        return view('employers.edit', compact('employer', 'departements'));
    }

    public function store(Request $request)
    {
        // Validation des données
        $validatedData = $request->validate([
            'montant_journalier' => 'nullable|int|min:0',
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'date_naissance' => 'nullable|date',
            'sexe' => 'required|string',
            'email' => 'required|email|max:255|unique:employers,email',
            'contact' => 'required|string|max:20',
            'departement_id' => 'required|exists:departements,id',
            'photos' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Création d'un nouvel employé
        $employer = new Employer();
        $employer->montant_journalier = $validatedData['montant_journalier'];
        $employer->nom = $validatedData['nom'];
        $employer->prenom = $validatedData['prenom'];
        $employer->sexe = $validatedData['sexe'];
        $employer->email = $validatedData['email'];
        $employer->contact = $validatedData['contact'];
        $employer->departement_id = $validatedData['departement_id'];

        // Gestion de la photo
        if ($request->hasFile('photos')) {
            $photoPath = $request->file('photos')->store('employers/photos', 'public');
            $employer->photos = $photoPath;
        }

        // Sauvegarder dans la base de données
        $employer->save();

        return redirect()->route('employer.index')->with('success_message', 'Employé ajouté avec succès.');
    }

    
 


    public function update(Request $request, Employer $employer)
    {
        // Validation des données
        $validatedData = $request->validate([
            'montant_journalier' => 'nullable|int|min:0',
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'date_naissance' => 'nullable|date',
            'sexe' => 'required|string',
            'email' => 'required|email|max:255|unique:employers,email,' . $employer->id,
            'contact' => 'required|string|max:20',
            'departement_id' => 'required|exists:departements,id',
            'photos' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Mise à jour des champs de l'employé
        $employer->montant_journalier = $validatedData['montant_journalier'];
        $employer->nom = $validatedData['nom'];
        $employer->prenom = $validatedData['prenom'];
        $employer->sexe = $validatedData['sexe'];
        $employer->email = $validatedData['email'];
        $employer->contact = $validatedData['contact'];
        $employer->departement_id = $validatedData['departement_id'];

        // Gestion de la photo
        if ($request->hasFile('photos')) {
            // Supprimer l'ancienne photo si elle existe
            if ($employer->photos) {
                Storage::disk('public')->delete($employer->photos);
            }

            // Enregistrer la nouvelle photo
            $photoPath = $request->file('photos')->store('employers/photos', 'public');
            $employer->photos = $photoPath;
        }

        // Sauvegarder les modifications
        $employer->save();

        return redirect()->route('employer.index', $employer->id)->with('success_message', 'Les informations de l\'employé ont été mises à jour avec succès.');
    }

    
    public function delete(Employer $employer)
    {
        //Enregistrer un nouveau département
        try {
            $employer->delete();

            return redirect()->route('employer.index')->with('success_message','Employer supprimer');

        } catch (Exception $e) {
            dd($e);
        }
       
    }

    public function search(Request $request)
{
    // Récupérer le terme de recherche
    $searchTerm = $request->input('searchorders');

    if ($searchTerm) {
        // Rechercher les employeurs si un terme de recherche est fourni
        $employers = Employer::query()
            ->where('nom', 'LIKE', "%{$searchTerm}%")
            ->orWhere('email', 'LIKE', "%{$searchTerm}%")
            ->orWhere('contact', 'LIKE', "%{$searchTerm}%")
            ->paginate(10);

        return view('employers.index', compact('employers', 'searchTerm'));
    } else {
        // Si aucun terme de recherche n'est fourni, afficher tous les employeurs
        $employers = Employer::paginate(10);

        return view('employers.index', compact('employers'));
    }
}


public function import(Request $request)
{
    $request->validate([
        'file' => 'required|mimes:xlsx,xls,csv',
    ]);

    try {
        Excel::import(new EmployersImport, $request->file('file'));

        return redirect()->back()->with('success', 'Les employés ont été importés avec succès.');
    } catch (\Exception $e) {
        // Journal des erreurs
        Log::error('Erreur lors de l\'importation : ' . $e->getMessage());
        return redirect()->back()->with('error', 'Une erreur est survenue lors de l\'importation : ' . $e->getMessage());
    }
}


public function print($id)
{
    $employer = Employer::findOrFail($id);

    // Chargez une vue pour le PDF
    $pdf = PDF::loadView('employers.pdf', compact('employer'));

    // Téléchargez ou affichez directement le PDF
    return $pdf->download('employer_' . $employer->id . '.pdf');
}

public function printAll()
{
    $employers = Employer::all();

    $pdf = PDF::loadView('employers.pdf_all', compact('employers'));

    return $pdf->download('employers_list.pdf');
}

public function generatePDF($id)
{
    set_time_limit(120); // Augmente le temps d'exécution
    ini_set('memory_limit', '256M'); // Augmente la mémoire

    $employer = Employer::with('departement')->findOrFail($id);

    // Charge la vue pour le PDF
    $pdf = Pdf::loadView('pdf', compact('employer'));

    return $pdf->download('employer_' . $employer->id . '.pdf');
}

}
