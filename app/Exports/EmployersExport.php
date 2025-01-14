<?php

namespace App\Exports;

use App\Employer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EmployersExport implements FromCollection, WithHeadings
{
    /**
     * Retourne les données à exporter.
     */
    public function collection()
    {
        return Employer::select(
            'id',          // ID de l'employé
            'montant_journalier',          // Matricule
            'nom',         // Nom
            'prenom',      // Prénom
            'sexe',    // Fonction
            'email',       // Adresse email
            'contact',     // Numéro de contact
            'photos',      // URL de la photo
            'departement_id', // ID du service
            'created_at',  // Date de création
            'updated_at'   // Date de mise à jour
        )->get();
    }

    /**
     * Retourne les en-têtes des colonnes.
     */
    public function headings(): array
    {
        return [
            'ID',
            'IM', // Matricule
            'Nom',
            'Prénom',
            'Fonction',
            'Email',
            'Contact',
            'Photos',
            'Sérvices ID',
            'Créé à',
            'Mis à jour à',
        ];
    }
}
