<?php

namespace App\Http\Controllers;

use App;
use App\Departement;
use App\Employer;
use App\User;
use Illuminate\Http\Request;
use PHPUnit\Framework\Constraint\Count;

class AppController extends Controller
{
   public function index()
   {
       $totalDepartements = Departement::all()->count();
       $totalEmployers = Employer::all()->count();
       $totalAdministrateurs = User:: all()->count();
       return view('dashboard', compact('totalDepartements', 'totalEmployers', 'totalAdministrateurs'));
       App::setLocale(auth()->user()->setting->language);
   }
}
