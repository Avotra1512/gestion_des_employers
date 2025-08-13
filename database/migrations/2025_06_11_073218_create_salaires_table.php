<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalairesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salaires', function (Blueprint $table) {
            $table->id();
            // Clé étrangère pour lier le salaire à un employé
            $table->unsignedBigInteger('employer_id');
            // La colonne 'montant' pour le salaire, peut être nulle si le montant n'est pas encore défini
            $table->integer('montant')->nullable();
            // Nouvelle colonne pour la date de paiement du salaire
            $table->date('date_paiement')->nullable(); // Utilisation de 'date' pour stocker seulement la date

            $table->timestamps(); // Ajoute les colonnes created_at et updated_at

            // Définition de la clé étrangère : 'employer_id' référence 'id' dans la table 'employers'
            // onDelete('cascade') signifie que si un employé est supprimé, tous ses salaires associés le sont aussi
            $table->foreign('employer_id')->references('id')->on('employers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('salaires');
    }
}
