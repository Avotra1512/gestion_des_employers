<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salaire extends Model
{
    use HasFactory;

    protected $fillable = ['employer_id', 'montant', 'date_paiement'];

    public function employer()
    {
        return $this->belongsTo(Employer::class);
    }
}
