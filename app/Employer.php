<?php

namespace App;

use App\Departement;
use App\Salaire;
use Illuminate\Database\Eloquent\Model;

class Employer extends Model
{
  
    protected $guarded = [''];


    public function departement()
    {
        return $this->belongsTo(Departement::class);
    }
    public function getPhotoUrlAttribute()
    {
    return $this->photos ? asset('storage/' . $this->photos) : null;
    }

    public function salaires()
{
    return $this->hasMany(Salaire::class);
}
}
