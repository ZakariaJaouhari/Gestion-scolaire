<?php

namespace App\Http\Controllers;

use App\Models\NewDirecteur;
use App\Models\NewFormateur;
use App\Models\NewStagiaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    //

    public function showLoginForm()
    {
        return view('welcome'); 
    }

    
    public function login(Request $request)
    {
        
        $input = $request->all();

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('directeur')->attempt(['email'=> $input['email'], 'password'=> $input['password']])){
            return redirect()->action([DirecteurController::class, 'pagehome']);
        }elseif (Auth::guard('formateur')->attempt(['email'=> $input['email'], 'password'=> $input['password']])){
            return redirect()->action([FormateurController::class, 'pagehomeF']);
        }elseif (Auth::guard('stagiaire')->attempt(['email'=> $input['email'], 'password'=> $input['password']])){
            return redirect()->action([StagiaireController::class, 'pagehomeS']);
        }else{
            return back() -> with ('error','Email ou mot de passe incorrect');
        }
     }



    // Déconnecter l'utilisateur
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
