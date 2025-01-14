<?php

namespace App\Imports;

use App\Employer;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMapping;

class EmployersImport implements ToModel, WithHeadingRow, WithMapping
{
    /**
     * Importer chaque ligne du fichier Excel dans le modèle Employer.
     *
     * @param array $row Une ligne de données importée depuis Excel.
     * @return Employer|null
     */
    public function model(array $row)
{
    Log::info('Données mappées : ', $row);

    $validator = Validator::make($row, [
        'montant_journalier' => 'nullable|int|min:0',
        'nom' => 'required|string|max:255',
        'prenom' => 'required|string|max:255',
        'date_naissance' => 'nullable|date',
        'sexe' => 'required|string|in:Masculin,Féminin',
        'email' => 'required|email|max:255',
        'contact' => 'required|string|max:20',
        'departement_id' => 'required|exists:departements,id',
        'photos' => 'nullable|string|max:2048',
    ]);

    if ($validator->fails()) {
        Log::error('Validation échouée : ', $validator->errors()->toArray());
        return null;
    }

    // Vérifier si un employé existe déjà avec cet email
    $employer = Employer::where('email', $row['email'])->first();

    if ($employer) {
        // Mettre à jour l'enregistrement existant
        $employer->update([
            'nom' => $row['nom'],
            'prenom' => $row['prenom'],
            'montant_journalier' => $row['montant_journalier'],
            'sexe' => $row['sexe'],
            'contact' => $row['contact'],
            'departement_id' => $row['departement_id'],
            'photos' => $row['photos'] ?? $employer->photos,
        ]);

        Log::info('Employé mis à jour : ', $row);
        return null;
    }

    // Créer un nouvel enregistrement si l'employé n'existe pas
    Log::info('Nouvel employé créé : ', $row);
    return new Employer($row);
}

public function map($row): array
{
    return [

        'nom' => $row['nom'] ?? null,
        'prenom' => $row['prenom'] ?? null,
        'montant_journalier' => $row['montant_journalier'] ?? null, // Corrigé
        'sexe' => $row['sexe'] ?? null,
        'email' => $row['email'] ?? null,
        'contact' => isset($row['contact']) ? (string) $row['contact'] : null,
        'departement_id' => $row['departement_id'] ?? null,
        'photos' => $row['photos'] ?? null,
    ];
}
public function rules(): array
{
    return [
        'montant_journalier' => 'nullable|int|min:0',
        'nom' => 'required|string',
        'prenom' => 'required|string',
        'sexe' => 'required|string',
        'email' => 'required|email|unique:users,email',
        'contact' => 'required|string',
        'departement_id' => 'required|integer',
        'photos' => 'nullable|string',
    ];
}





}
