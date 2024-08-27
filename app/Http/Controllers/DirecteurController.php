<?php

namespace App\Http\Controllers;

use App\Models\NewDirecteur;
use App\Models\NewFormateur;
use App\Models\NewGroupe;
use App\Models\NewStagiaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DirecteurController extends Controller
{
    //
    public function Ajouter(Request $request)
    {
        $validatedData = $request->validate([
            'nom_ecole' => 'required|string',
            'nom_directeur' => 'required|string',
            'email' => 'required|string',
            'password' => 'required|string',
            'academie' => 'required|string',
            'annee' => 'required|string',
            'direction' => 'required|string',

        ]);
        // dd($request);
        $hashedPassword = Hash::make($validatedData['password']);

        NewDirecteur::create([
            'nom_ecole' => $validatedData['nom_ecole'],
            'nom_directeur' => $validatedData['nom_directeur'],
            'email' => $validatedData['email'],
            'password' => $hashedPassword,
            'academie' => $validatedData['academie'],
            'annee' => $validatedData['annee'],
            'direction' => $validatedData['direction'],
        ]);

        return redirect()->back();
    }

    public function updateD(Request $request)
    {
        $directeurId = Auth::guard('directeur')->user()->id;

        $validatedData = $request->validate([
            'nom_ecole' => 'required|string',
            'nom_directeur' => 'required|string',
            'email' => 'required|string',
            'academie' => 'required|string',
            'annee' => 'required|string',
            'direction' => 'required|string',
            'password' => 'nullable|string',
        ]);

        if (isset($validatedData['password'])) {
            $hashedPassword = Hash::make($validatedData['password']);
        }

        $directeur = Auth::guard('directeur')->user();

        $directeur->nom_ecole = $validatedData['nom_ecole'];
        $directeur->nom_directeur = $validatedData['nom_directeur'];
        $directeur->email = $validatedData['email'];
        $directeur->academie = $validatedData['academie'];
        $directeur->annee = $validatedData['annee'];
        $directeur->direction = $validatedData['direction'];

        if (isset($hashedPassword)) {
            $directeur->password = $hashedPassword;
        }

        $directeur->save();

        return redirect()->back();
    }

    public function changepasswordD(Request $request)
    {

        $validatedData = $request->validate([
            'password' => 'nullable|string|min:8|confirmed',
        ], [
            'password.min' => 'Le mot de passe doit contenir au moins :min caractères.',
        ]);
        if (isset($validatedData['password'])) {
            $hashedPassword = Hash::make($validatedData['password']);
        }

        $directeur = Auth::guard('directeur')->user();

        if (isset($hashedPassword)) {
            $directeur->password = $hashedPassword;
        }
        $directeur->save();

        return redirect()->back();
    }

    public function pagehome()
    {
        $directeurId = Auth::guard('directeur')->user()->id;

        $nombreFormateurs = NewFormateur::where('directeur_id', $directeurId)->count();
        $nombreStagiaires = NewStagiaire::where('directeur_id', $directeurId)->count();
        $nombreGroupes = NewGroupe::where('directeur_id', $directeurId)->count();


        $groupes = NewGroupe::withCount([
            'stagiaires as hommes' => function ($query) {
                $query->where('sexe', 'Homme');
            },
            'stagiaires as femmes' => function ($query) {
                $query->where('sexe', 'Femme');
            },
            'modules' => function ($query) {
                $query->with('formateur')->distinct('formateur_id');
            },
        ])->where('directeur_id', $directeurId)->get();

        // Organiser les données dans un tableau associatif
        $data = [];
        foreach ($groupes as $groupe) {
            $modules = $groupe->modules->count();
            $formateurs = $groupe->modules->pluck('formateur')->unique()->count();
            $data[$groupe->matricule] = [
                'hommes' => $groupe->hommes,
                'femmes' => $groupe->femmes,
                'modules' => $modules,
                'formateurs' => $formateurs
            ];
        }


        $hommes_count = NewStagiaire::where('directeur_id', $directeurId)
            ->where('sexe', 'Homme')
            ->count();

        $femmes_count = NewStagiaire::where('directeur_id', $directeurId)
            ->where('sexe', 'Femme')
            ->count();




        $directeur = Auth::user();
        return view(
            'directeur.pageHome',
            ['directeur' => $directeur, 'data' => $data],
            compact('hommes_count', 'femmes_count', 'nombreFormateurs', 'nombreStagiaires', 'nombreGroupes', 'groupes')
        );
    }


    public function profil()
    {
        $directeur = Auth::guard('directeur')->user();

        return view('directeur.profil', compact('directeur'));
    }
}
