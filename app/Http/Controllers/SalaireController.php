<?php

// Fichier : SalaireController.php
// Crée par Avotra
// Dernière modification : 11/06/2025
// Fonction : Gérer les salaires des employés

namespace App\Http\Controllers;

use App\Salaire;
use App\Employer;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;

class SalaireController extends Controller
{
    public function index()
    {
        $salaires = Salaire::with('employer')->paginate(10);
        return view('paiements.index', compact('salaires'));
    }

    public function create()
    {
        $employers = Employer::all();
        return view('paiements.create', compact('employers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'employer_id' => 'required|exists:employers,id',
            'montant' => 'required|integer|min:0',
            'date_paiement' => 'required|date',
        ]);

        Salaire::create($validated);

        return redirect()->route('paiements.index')->with('success_message', 'Paiement enregistré avec succès.');
    }

    public function edit($id)
    {
        $salaire = Salaire::findOrFail($id);
        $employers = Employer::all();
        return view('paiements.edit', compact('salaire', 'employers'));
    }

    public function update(Request $request, $id)
    {
        $salaire = Salaire::findOrFail($id);

        $validated = $request->validate([
            'employer_id' => 'required|exists:employers,id',
            'montant' => 'required|integer|min:0',
            'date_paiement' => 'required|date',
        ]);

        $salaire->update($validated);

        return redirect()->route('paiements.index')->with('success_message', 'Paiement mis à jour avec succès.');
    }

    public function destroy($id)
    {
        try {
            $salaire = Salaire::findOrFail($id);
            $salaire->delete();
            return redirect()->route('paiements.index')->with('success_message', 'Paiement supprimé avec succès.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Erreur lors de la suppression : ' . $e->getMessage());
        }
    }

    public function print($id)
{
    $salaire = Salaire::with('employer')->findOrFail($id);
    $pdf = Pdf::loadView('paiements.recu', compact('salaire'));
    return $pdf->download('recu_paiement_'.$salaire->id.'.pdf');
}

    public function searchByDate(Request $request)
{
    $request->validate([
        'start_date' => 'required|date',
        'end_date'   => 'required|date|after_or_equal:start_date',
    ]);

    $start = $request->input('start_date');
    $end   = $request->input('end_date');

    $salaires = Salaire::with('employer')
        ->whereBetween('date_paiement', [$start, $end])
        ->orderBy('date_paiement', 'desc')
        ->paginate(10);

    return view('paiements.index', compact('salaires', 'start', 'end'));
}

    public function search(Request $request)
    {
    $searchTerm = $request->input('searchorders');

    if ($searchTerm) {
        $salaires = Salaire::whereHas('employer', function ($query) use ($searchTerm) {
            $query->where('nom', 'like', "%{$searchTerm}%")
                  ->orWhere('prenom', 'like', "%{$searchTerm}%");
        })->with('employer')->paginate(10);

        return view('paiements.index', compact('salaires', 'searchTerm'));
    } else {
        $salaires = Salaire::with('employer')->paginate(10);
        return view('paiements.index', compact('salaires'));
    }
    }
}
