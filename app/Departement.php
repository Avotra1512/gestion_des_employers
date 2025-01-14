<?php

namespace App;
use App\Employer;

use Illuminate\Database\Eloquent\Model;

class Departement extends Model
{
    protected $fillable = ['name', 'apropos'];
    public function employers()
{
    return $this->hasMany(Employer::class);
}
}
