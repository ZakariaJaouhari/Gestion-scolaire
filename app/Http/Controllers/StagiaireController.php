<?php

namespace App\Http\Controllers;

use App\Models\NewExam;
use App\Models\NewGroupe;
use App\Models\NewModule;
use App\Models\NewNote;
use App\Models\NewStagiaire;
use App\Support\CustomQueryBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StagiaireController extends Controller
{
    //
    public function Ajouter(Request $request)
    {

        $directeurId = Auth::guard('directeur')->user()->id;

        $customMessages = [
            'required' => 'Le champ :attribute est requis.',
            'numeric' => 'Le champ :attribute doit être un nombre.',
            'in' => 'La valeur du champ :attribute n\'est pas valide.',
            'string' => 'Le champ :attribute doit être une chaîne de caractères.',
            'image' => 'Le champ :attribute doit être une image.',
        ];

        $validatedData = $request->validate([
            'nom' => 'required|string',
            'prenom' => 'required|string',
            'day' => 'required|numeric',
            'month' => 'required|numeric',
            'year' => 'required|numeric',
            'sexe' => 'required|in:Homme,Femme',
            'groupe' => 'required|string',
            'CIN' => 'required|string',
            'email' => 'required',
            'password' => 'required|string',
            'profile_picture' => 'required|image',
        ], $customMessages);

        $hashedPassword = Hash::make($validatedData['password']);

        $dateOfBirth = $validatedData['year'] . '-' . $validatedData['month'] . '-' . $validatedData['day'];


        if ($request->hasFile('profile_picture')) {
            $image = $request->file('profile_picture');

            if ($image->isValid()) {
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $imageName);
                $validatedData['profile_picture'] = 'images/' . $imageName;
            }
        }



        $emailcomplet = $validatedData['email'] . '@taalim.ma';


        NewStagiaire::create([
            'nom' => $validatedData['nom'],
            'prenom' => $validatedData['prenom'],
            'date_naissance' => $dateOfBirth,
            'sexe' => $validatedData['sexe'],
            'CIN' => $validatedData['CIN'],
            'groupe_id' => $validatedData['groupe'],
            'email' => $emailcomplet,
            'directeur_id' => $directeurId,
            'password' => $hashedPassword,
            'profile_picture' => $validatedData['profile_picture'],
        ]);

        return redirect()->action([StagiaireController::class, 'showStagiaires']);
    }

    public function showStagiaires()
    {
        $directeur = Auth::guard('directeur')->user();
        $groupes = $directeur->groupes;
        $stagiaires = $directeur->stagiaires;
        return view('directeur.gestion_Stagiaires', ['stagiaires' => $stagiaires,  'groupes' => $groupes]);
    }

    public function formA()
    {
        $directeur = Auth::guard('directeur')->user();
        $groupes = $directeur->groupes;
        return view('directeur.ajouter_Stagiaire', ['groupes' => $groupes]);
    }



    public function deleteS(string $id)
    {
        
        DB::table('stagiaires')->where('id', '=', $id)->delete();
        return redirect()->action([StagiaireController::class, 'showStagiaires']);
    }

    public function editS($id)
    {
        $directeur = Auth::guard('directeur')->user();
        $stagiaire = NewStagiaire::findOrFail($id);
        $email = str_replace('@taalim.ma', '', $stagiaire->email);
        $groupes = $directeur->groupes;
        return view('directeur.modifierS', compact('stagiaire', 'groupes', 'email'));
    }


    public function updateS(Request $request, $id)
    {
        $directeurId = Auth::guard('directeur')->user()->id;

        $validatedData = $request->validate([
            'nom' => 'required|string',
            'prenom' => 'required|string',
            'day' => 'required|numeric',
            'month' => 'required|numeric',
            'year' => 'required|numeric',
            'sexe' => 'required|in:Homme,Femme',
            'groupe' => 'required|string',
            'CIN' => 'required|string',
            'email' => 'required',
            'password' => 'nullable|string',
            'profile_picture' => 'image',

        ]);

        if (isset($validatedData['password'])) {
            $hashedPassword = Hash::make($validatedData['password']);
        }
        $emailcomplet = $validatedData['email'] . '@taalim.ma';
        $dateOfBirth = $validatedData['year'] . '-' . $validatedData['month'] . '-' . $validatedData['day'];

        $stagiaire = NewStagiaire::findOrFail($id);

        $stagiaire->nom = $validatedData['nom'];
        $stagiaire->prenom = $validatedData['prenom'];
        $stagiaire->CIN = $validatedData['CIN'];
        $stagiaire->sexe = $validatedData['sexe'];
        $stagiaire->date_naissance = $dateOfBirth;
        $stagiaire->CIN = $validatedData['CIN'];
        $stagiaire->email = $emailcomplet;
        $stagiaire->groupe_id = $validatedData['groupe'];

        if (isset($hashedPassword)) {
            $stagiaire->password = $hashedPassword;
        }
        if ($request->hasFile('profile_picture')) {
            $image = $request->file('profile_picture');

            if ($image->isValid()) {
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $imageName);
                $stagiaire->profile_picture = 'images/' . $imageName;
            }
        }

        $stagiaire->save();

        return redirect()->action([StagiaireController::class, 'showStagiaires']);
    }


    public function filtrerStagiaires(Request $request)
    {
        $directeur = Auth::guard('directeur')->user();
        $directeurId = Auth::guard('directeur')->user()->id;
        $nom = $request->input('nom');
        $prenom = $request->input('prenom');
        $CIN = $request->input('CIN');
        $sexe = $request->input('sexe');
        $groupe = $request->input('groupe');

        $query = NewStagiaire::query();
        $customQueryBuilder = new CustomQueryBuilder();
        $data = [
            'f' => [
                [
                    'column' => 'nom',
                    'operator' => 'startsWith',
                    'query_1' => $nom,
                    'match' => 'and'
                ],
                [
                    'column' => 'prenom',
                    'operator' => 'startsWith',
                    'query_1' => $prenom,
                    'match' => 'and'
                ],
                [
                    'column' => 'CIN',
                    'operator' => 'startsWith',
                    'query_1' => $CIN,
                    'match' => 'and'
                ],
                [
                    'column' => 'sexe',
                    'operator' => 'startsWith',
                    'query_1' => $sexe,
                    'match' => 'and'
                ],
                [
                    'column' => 'groupe_id',
                    'operator' => 'startsWith',
                    'query_1' => $groupe,
                    'match' => 'and'
                ],


            ],
            'filter_match' => 'and'
        ];
        $query = $customQueryBuilder->apply($query, $data);
        $query->where('directeur_id', $directeurId);
        $stagiaires = $query->get();
        $groupes = $directeur->groupes;


        return view('Directeur.gestion_Stagiaires', ['stagiaires' => $stagiaires, 'groupes' => $groupes]);
    }


    public function pagehomeS()
    {
        $stagiaireId = Auth::guard('stagiaire')->user()->id;
        $stagiaire = Auth::guard('stagiaire')->user();

        
        $groupe = $stagiaire->groupe;
        $nombreDeModules = $groupe->modules()->count();
        $exams = NewExam::where('groupe_id', $groupe->id)->get();
        $nombre_exams = NewExam::where('groupe_id', $groupe->id)->count();


        return view('stagiaire.pageHomeS', ['stagiaire' => $stagiaire], compact('groupe', 'nombreDeModules', 'exams', 'nombre_exams'));
    }

    public function modulesS()
    {
        $stagiaire = Auth::guard('stagiaire')->user();
        $groupe = $stagiaire->groupe;
        $modules = $groupe->modules()->get();
        return view('stagiaire.Modules', ['modules' => $modules]);
    }

    public function filtrerModulesS(Request $request)
    {
        $stagiaire = Auth::guard('stagiaire')->user();
        $nom = $request->input('nom');
        $matricule = $request->input('matricule');


        $query = NewModule::query();
        $customQueryBuilder = new CustomQueryBuilder();
        $data = [
            'f' => [
                [
                    'column' => 'nom',
                    'operator' => 'startsWith',
                    'query_1' => $nom,
                    'match' => 'and'
                ],
                [
                    'column' => 'matricule',
                    'operator' => 'startsWith',
                    'query_1' => $matricule,
                    'match' => 'and'
                ],

            ],
            'filter_match' => 'and'
        ];
        $query = $customQueryBuilder->apply($query, $data);
        $query->whereIn('id', function ($query) use ($stagiaire) {
            $query->select('module_id')
                ->from('new_groupe_new_module')
                ->where('groupe_id', $stagiaire->groupe_id);
        });
        $modules = $query->get();

        return view('stagiaire.Modules', ['modules' => $modules]);
    }

    public function profilS()
    {
        $stagiaire = Auth::guard('stagiaire')->user();
        $email = str_replace('@taalim.ma', '', $stagiaire->email);
        return view("stagiaire.profilS", ['stagiaire' => $stagiaire], compact('email'));
    }

    public function changepasswordS(Request $request)
    {

        $validatedData = $request->validate([
            'password' => 'nullable|string|min:8',
        ], [
            'password.min' => 'Le mot de passe doit contenir au moins :min caractères.',
        ]);
        if (isset($validatedData['password'])) {
            $hashedPassword = Hash::make($validatedData['password']);
        }

        $stagiaire = Auth::guard('stagiaire')->user();

        if (isset($hashedPassword)) {
            $stagiaire->password = $hashedPassword;
        }
        $stagiaire->save();

        return redirect()->back();
    }


    public function notesS()
    {
        $stagiaire = Auth::guard('stagiaire')->user();
        $modules = NewModule::whereIn('id', function ($query) {
            $query->select('module_id')
                ->from('new_groupe_new_module')
                ->where('groupe_id', Auth::guard('stagiaire')->user()->groupe_id);
        })->get();

        $notes = NewNote::whereIn('module_id', $modules->pluck('id'))
            ->where('stagiaire_id', $stagiaire->id)
            ->get();

        $totalCoefficient = $modules->sum('coefficient');

        $totalScore = 0;
        foreach ($modules as $module) {
            $note = $notes->where('module_id', $module->id)->first();
            if ($note) {
                $totalScore += $module->coefficient * $note->note;
            }
        }

        

        return view('stagiaire.Notes', ['modules' => $modules, 'notes' => $notes], compact('stagiaire', 'totalCoefficient', 'totalScore'));
    }

    
}
