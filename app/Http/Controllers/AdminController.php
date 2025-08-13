<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\storeAdminRequest;
use App\Http\Requests\updateAdminRequest;
use App\Http\Requests\submiteDefineAccessRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use App\Notifications\SendEmailNotification;
use App\ResetCodePassword;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Exception;

class AdminController extends Controller
{
    public function index(){
        $admins = User::paginate(10);
        return view('admins/index', compact('admins'));
    }

    public function create(){
        return view('admins/create');
    }

    public function edit(User $user){
        return view('admins/edit', compact('user'));
    }

    //Enregistrer un damin en BD et envoyer un mail
    public function store(storeAdminRequest $request){

        try {
            //logique de creation de compte
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make('default');

            $user-> save();

            //Envoyer un email pour que l'utilisateur peuvent confirmer son compte

            //Envoyer un code par email pour verification
            if($user){
                try {
                    ResetCodePassword::where('email', $user->email)->delete();
                    $code = rand(1000, 4000);

                    $data = [
                         'code'=>$code,
                         'email'=>$user->email
                    ];

                    ResetCodePassword::create($data);

                    Notification::route('mail', $user->email)->notify(new SendEmailNotification($code, $user->email));

                    //Rediriger l'utilisateur vers une URL
                    return redirect()-> route('administrateurs')->with('success_message', 'Administrateur ajouté');

                } catch (Exception $e) {
                    dd($e);
                    throw new Exception('Une erreur est survenue lors de l\'envoie du mail');
                }

            }


        } catch (Exception $e) {
            dd($e);
            //throw new Exception('Une erreur est survenue lors de la création de cet administrateur');

        }
    }



    public function delete(User $user){
        try {
            //logique de suppression du compte

            //L'admin qui est connecté ne puisse pas supprimer son compte
            $connectedAdminId = Auth::user()->id;
            if ($connectedAdminId !== $user->id) {
                $user->delete();
                return redirect()-> back()->with('success_message', 'Administrateur retiré');
            }else {
                return redirect()-> back()->with('error_message', 'Vous ne pouvez pas supprimer votre compte');
            }
        } catch (Exception $e) {
            //dd($e);
            throw new Exception('Une erreur est survenue lors de suppression du compte de l\'admin');

        }
    }
    public function defineAccess($email)
    {
        $checkUserExist = User::where('email', $email)->first();

        if ($checkUserExist) {
            return view('auth.validate-account', compact('email'));
        }else {
            //Rediriger sur une route 404.
            //return redirect()->route('login');
        }
    }
    public function submiteDefineAccess(submiteDefineAccessRequest $request)
    {

        try {
            $user = User::where('email', $request->email)->first();
            if ($user) {
                $user->password = Hash::make($request->password);
                $user->email_verified_at = Carbon::now();
                $user->update();

                return redirect()-> route('login')->with('success_message', 'Vos accès ont été correctement  défini');

            if ($user) {
                $existingCode = ResetCodePassword::where('email', $user->email)->count();
                if ($existingCode) {
                    ResetCodePassword::where('email', $user->email)->delete();
                }
            }

            }else {
                //404
            }
        }  catch (Exception $e) {
            dd($e);

        }
    }
    public function search(Request $request)
    {
        // Récupérer le terme de recherche si existant
        $searchTerm = $request->input('searchorders');

        // Si un terme de recherche est fourni, filtrer les administrateurs
        if ($searchTerm) {
            $administrateurs = User::where('name', 'like', '%' . $searchTerm . '%')
                ->orWhere('email', 'like', '%' . $searchTerm . '%')
                ->paginate(10);
        } else {
            // Si aucun terme de recherche n'est fourni, afficher tous les administrateurs
            $administrateurs = User::paginate(10);
        }

        // Retourner la vue avec les administrateurs trouvés et le terme de recherche
        return view('admins.index', [ // Retour à `index` pour réutiliser la même vue
            'admins' => $administrateurs, // Variable correcte pour la vue
            'searchTerm' => $searchTerm,
        ]);
    }


}
