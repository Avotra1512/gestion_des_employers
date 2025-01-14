<?php

use App\Http\Requests\AuthRequest;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AppController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\DepartementController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Mail\testMail;
use Illuminate\Support\Facades\Mail;
use App\Exports\EmployersExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\SettingController;



Route::get('/', [AuthController::class, 'login'])->name('login'); 
Route::post('/', [AuthController::class, 'handleLogin'])->name('handleLogin'); 
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/validate-account/{email}', [AdminController::class, 'defineAccess']);
Route::post('/validate-account/{email}', [AdminController::class, 'submiteDefineAccess'])->name('submiteDefineAccess');


//Export excel
Route::get('/export-employers', function () {
    return Excel::download(new EmployersExport, 'employers.xlsx');
})->name('export.employers');

//Import excel
Route::post('/import-employers', [EmployerController::class, 'import'])->name('import.employers');

//Generer pdf
Route::get('/employer/{id}/print', [EmployerController::class, 'print'])->name('employer.print');
Route::get('/employers/print-all', [EmployerController::class, 'printAll'])->name('employers.printAll');
Route::get('/employer/{id}/badge', [EmployerController::class, 'generateBadge'])->name('employer.badge');



//Route sécurisé

Route::middleware('auth')->group(function(){

    Route::get('/dashboard', [AppController::class, 'index'])->name('dashboard');
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');
    

    Route::prefix('departements')->group(function(){
        Route::get('/', [DepartementController::class, 'index'])->name('departement.index');
        Route::get('/create', [DepartementController::class, 'create'])->name('departement.create');
        Route::post('/create', [DepartementController::class, 'store'])->name('departement.store');
        Route::get('/edit/{departement}', [DepartementController::class, 'edit'])->name('departement.edit');
        Route::put('/update/{departement}', [DepartementController::class, 'update'])->name('departement.update');

        Route::get('/search', [DepartementController::class, 'search'])->name('departement.search');

        Route::get('/{departement}', [DepartementController::class, 'delete'])->name('departement.delete');
        Route::get('/departement/{id}/employer', [DepartementController::class, 'showEmployes'])->name('departement.employes');
    });


    Route::prefix('employers')->group(function(){
        Route::get('/', [EmployerController::class, 'index'])->name('employer.index');
        Route::get('/create', [EmployerController::class, 'create'])->name('employer.create');
        Route::get('/edit/{employer}', [EmployerController::class, 'edit'])->name('employer.edit');
    
        //Route d'actions
        Route::post('/store', [EmployerController::class, 'store'])->name('employer.store');
        Route::put('/update/{employer}', [EmployerController::class, 'update'])->name('employer.update');
        Route::get('/delete/{employer}', [EmployerController::class, 'delete'])->name('employer.delete');
        Route::get('/employers/employes/search', [EmployerController::class, 'search'])->name('employer.search');


    });

    

    Route::prefix('administrateurs')->group(function(){
        Route::get('/', [AdminController::class, 'index'])->name('administrateurs');
        Route::get('/create', [AdminController::class, 'create'])->name('administrateurs.create');
        Route::post('/store', [AdminController::class, 'store'])->name('administrateurs.store');
        Route::get('/delete/{user}', [AdminController::class, 'delete'])->name('administrateurs.delete');
        
        
        // Route de recherche (si vous avez une autre route de recherche dédiée)
        Route::get('/search', [AdminController::class, 'search'])->name('administrateurs.search'); // Recherche



        

    });

    

    Route::get('/send-test-email', function (){
        Mail::to('test@example.com')->send(new testMail()) ;
        return 'Email envoyé avec succes verifier votre Mailtrap'; 
    });

});


