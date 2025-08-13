<?php

namespace App\Http\Controllers;

use App\Dashboard;
use Illuminate\Http\Request;
use App\Departement; // Supposons que c'est votre modèle pour les services
use App\Employer;    // Votre modèle pour les employers
use App\User;
use App\Salaire;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


public function index()
{
    // Statistiques globales
    $totalDepartements = Departement::count();
    $totalEmployers = Employer::count();
    $totalAdministrateurs = User::count();
    // Nombre d'employés payés aujourd'hui
    $totalPayé = Salaire::whereDate('date_paiement', Carbon::today())
                    ->distinct('employer_id')
                    ->count('employer_id');

    // Courbe 1 : Nombre d'employés par service
    $departements = Departement::withCount('employers')->get();
    $serviceLabels = $departements->pluck('name'); // ou 'nom' selon ta table
    $serviceData = $departements->pluck('employers_count');

    // Courbe 2 : Évolution des paiements par jour
    $paiementsParJour = Salaire::select(
        DB::raw('DATE(date_paiement) as jour'),
        DB::raw('SUM(montant) as total')
    )
    ->groupBy('jour')
    ->orderBy('jour', 'ASC')
    ->get();

    $paiementLabels = $paiementsParJour->pluck('jour')->map(function ($date) {
        return Carbon::parse($date)->format('d/m/Y');
    });

    $paiementData = $paiementsParJour->pluck('total');

    return view('dashboard', compact(
        'totalDepartements',
        'totalEmployers',
        'totalAdministrateurs',
        'totalPayé',
        'serviceLabels',
        'serviceData',
        'paiementLabels',
        'paiementData'
    ));
}

}
