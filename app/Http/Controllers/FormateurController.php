<?php

namespace App\Http\Controllers;

use App\Models\NewExam;
use App\Support\CustomQueryBuilder;
use App\Models\NewFormateur;
use App\Models\NewGroupe;
use App\Models\NewModule;
use App\Models\NewStagiaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class FormateurController extends Controller
{
    //
    public function Ajouter(Request $request)
    {

        $directeurId = Auth::guard('directeur')->user()->id;


        $validatedData = $request->validate([
            'nom' => 'required|string',
            'prenom' => 'required|string',
            'matricule' => 'required|string',
            'sexe' => 'required|in:Homme,Femme',
            'day' => 'required|numeric',
            'month' => 'required|numeric',
            'year' => 'required|numeric',
            'CIN' => 'required|string',
            'situation' => 'required|in:Marié(e),Célibataire',
            'dayR' => 'required|numeric',
            'monthR' => 'required|numeric',
            'yearR' => 'required|numeric',
            'email' => 'required|string',
            'password' => 'required|string',
            'profile_picture' => 'required|image',

        ], [
            'nom.required' => 'Le champ nom est requis.',
            'prenom.required' => 'Le champ prénom est requis.',
            'matricule.required' => 'Le champ matricule est requis.',
            'sexe.required' => 'Veuillez sélectionner le sexe.',
            'day.required' => 'Le champ jour de naissance est requis.',
            'month.required' => 'Le champ mois de naissance est requis.',
            'year.required' => 'Le champ année de naissance est requis.',
            'CIN.required' => 'Le champ CIN est requis.',
            'situation.required' => 'Veuillez sélectionner la situation familiale.',
            'dayR.required' => 'Le champ jour de recrutement est requis.',
            'monthR.required' => 'Le champ mois de recrutement est requis.',
            'yearR.required' => 'Le champ année de recrutement est requis.',
            'email.required' => 'Le champ email est requis.',
            'password.required' => 'Le champ mot de passe est requis.',
            'profile_picture' => 'Le fichier doit être une image.',
        ]);

        $hashedPassword = Hash::make($validatedData['password']);

        $dateOfBirth = $validatedData['year'] . '-' . $validatedData['month'] . '-' . $validatedData['day'];
        $date_recrutement = $validatedData['yearR'] . '-' . $validatedData['monthR'] . '-' . $validatedData['dayR'];


        if ($request->hasFile('profile_picture')) {
            $image = $request->file('profile_picture');

            if ($image->isValid()) {
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $imageName);
                $validatedData['profile_picture'] = 'images/' . $imageName;
            }
        }
        $emailcomplet = $validatedData['email'] . '@taalim.ma';


        NewFormateur::create([
            'nom' => $validatedData['nom'],
            'prenom' => $validatedData['prenom'],
            'matricule' => $validatedData['matricule'],
            'sexe' => $validatedData['sexe'],
            'date_naissance' => $dateOfBirth,
            'CIN' => $validatedData['CIN'],
            'situation' => $validatedData['situation'],
            'date_recrutement' => $date_recrutement,
            'email' => $emailcomplet,
            'directeur_id' => $directeurId,
            'password' => $hashedPassword,
            'profile_picture' => $validatedData['profile_picture'],
        ]);


        return redirect()->action([FormateurController::class, 'showFormateurs']);
    }


    public function showFormateurs(Request  $request)
    {
        $directeur = Auth::guard('directeur')->user();

        $formateurs = $directeur->formateurs;
        return view('directeur.gestion_Formateurs', ['formateurs' => $formateurs]);
    }

    public function delete(string $id)
    {
        NewModule::where('formateur_id', $id)->delete();
        NewFormateur::destroy($id);

        return redirect()->action([FormateurController::class, 'showFormateurs']);
    }

    // public function editF(Request $request, string $id)
    // {
    //     $formateur = DB::select("select * from formateurs where id='$id'");
    //     db::table("formateurs")->where('id', '=', $id)->update(["nom" => $request->nom, "prenom" => $request->prenom, "matricule" => $request->matricule, "sexe" => $request->sexe, "CIN" => $request->CIN, "situation" => $request->situation, "email" => $request->email, "password" => $request->password, "date_naissance" => $request->date_naissance, "date_recrutement" => $request->date_recrutement]);
    //     return view("editF")->with('formateur');
    // }
    public function edit($id)
    {
        $formateur = NewFormateur::findOrFail($id);
        $email = str_replace('@taalim.ma', '', $formateur->email);
        return view('directeur.modifierF', compact('formateur', 'email'));
    }

    public function changepassword(Request $request){
        
        $validatedData = $request->validate([
            'password' => 'nullable|string|min:8|confirmed',
        ],[
            'password.min' => 'Le mot de passe doit contenir au moins :min caractères.',
        ]);
        if (isset($validatedData['password'])) {
            $hashedPassword = Hash::make($validatedData['password']);
        }

        $formateur = Auth::guard('formateur')->user();

        if (isset($hashedPassword)) {
            $formateur->password = $hashedPassword;
        }
        $formateur->save();

        return redirect()->back();
    }


    public function update(Request $request, $id)
    {
        $directeurId = Auth::guard('directeur')->user()->id;

        $validatedData = $request->validate([
            'nom' => 'required|string',
            'prenom' => 'required|string',
            'matricule' => 'required|string',
            'sexe' => 'required|in:Homme,Femme',
            'day' => 'required|numeric',
            'month' => 'required|numeric',
            'year' => 'required|numeric',
            'CIN' => 'required|string',
            'situation' => 'required|in:Marié(e),Célibataire',
            'dayR' => 'required|numeric',
            'monthR' => 'required|numeric',
            'yearR' => 'required|numeric',
            'email' => 'required|string',
            'password' => 'nullable|string',
            'profile_picture' => 'image',
        ]);

        if (isset($validatedData['password'])) {
            $hashedPassword = Hash::make($validatedData['password']);
        }
        $emailcomplet = $validatedData['email'] . '@taalim.ma';
        $dateOfBirth = $validatedData['year'] . '-' . $validatedData['month'] . '-' . $validatedData['day'];
        $date_recrutement = $validatedData['yearR'] . '-' . $validatedData['monthR'] . '-' . $validatedData['dayR'];

        $formateur = NewFormateur::findOrFail($id);

        $formateur->nom = $validatedData['nom'];
        $formateur->prenom = $validatedData['prenom'];
        $formateur->matricule = $validatedData['matricule'];
        $formateur->sexe = $validatedData['sexe'];
        $formateur->date_naissance = $dateOfBirth;
        $formateur->CIN = $validatedData['CIN'];
        $formateur->situation = $validatedData['situation'];
        $formateur->date_recrutement = $date_recrutement;
        $formateur->email = $emailcomplet;

        if (isset($hashedPassword)) {
            $formateur->password = $hashedPassword;
        }

        if ($request->hasFile('profile_picture')) {
            $image = $request->file('profile_picture');

            if ($image->isValid()) {
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $imageName);
                $formateur->profile_picture = 'images/' . $imageName;
            }
        }

        $formateur->save();

        return redirect()->action([FormateurController::class, 'showFormateurs']);
    }

    public function filtrerFormateurs(Request $request)
    {
        $directeurId = Auth::guard('directeur')->user()->id;
        $nom = $request->input('nom');
        $prenom = $request->input('prenom');
        $matricule = $request->input('matricule');
        $sexe = $request->input('sexe');
        $situation = $request->input('situation');

        $query = NewFormateur::query();
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
                    'column' => 'matricule',
                    'operator' => 'startsWith',
                    'query_1' => $matricule,
                    'match' => 'and'
                ],
                [
                    'column' => 'sexe',
                    'operator' => 'startsWith',
                    'query_1' => $sexe,
                    'match' => 'and'
                ],
                [
                    'column' => 'situation',
                    'operator' => 'startsWith',
                    'query_1' => $situation,
                    'match' => 'and'
                ],

            ],
            'filter_match' => 'and'
        ];
        $query = $customQueryBuilder->apply($query, $data);
        $query->where('directeur_id', $directeurId);
        $formateurs = $query->get();

        return view('Directeur.gestion_Formateurs', ['formateurs' => $formateurs]);
    }

    public function pagehomeF()
    {
        $formateurId = Auth::guard('formateur')->user()->id;
        $nombreModules = NewModule::where('formateur_id', $formateurId)->count();
        $nombreStagiaires = NewStagiaire::whereHas('groupe.modules', function ($query) use ($formateurId) {
            $query->where('formateur_id', $formateurId);
        })->count();
        $nombreGroupes = NewModule::where('formateur_id', $formateurId)->count();


        // Récupérer les IDs des modules associés à ce formateur
        $moduleIds = NewModule::where('formateur_id', $formateurId)->pluck('id');

        // Récupérer les IDs des groupes associés à ces modules à partir de la table intermédiaire
        $groupesIds = NewGroupe::join('new_groupe_new_module', 'new_groupe_new_module.groupe_id', '=', 'groupes.id')
            ->whereIn('new_groupe_new_module.module_id', $moduleIds)
            ->pluck('groupes.id');

        // Récupérer les détails des groupes associés
        $groupes = NewGroupe::whereIn('id', $groupesIds)
            ->select('id', 'matricule', 'niveau')
            ->with('stagiaires')
            ->with('modules')
            ->get();

        $formateur = Auth::user();

        $exams = NewExam::where('formateur_id', $formateurId)->get();

        return view('formateur.pageHomeF', ['formateur' => $formateur, 'groupes' => $groupes], compact('nombreModules', 'nombreStagiaires', 'nombreGroupes', 'exams'));
    }

    public function groupesF()
    {
        // Récupérer l'ID du formateur connecté
        $formateurId = auth()->guard('formateur')->user()->id;

        // Récupérer les IDs des modules associés à ce formateur
        $moduleIds = NewModule::where('formateur_id', $formateurId)->pluck('id');

        // Récupérer les IDs des groupes associés à ces modules à partir de la table intermédiaire
        $groupesIds = NewGroupe::join('new_groupe_new_module', 'new_groupe_new_module.groupe_id', '=', 'groupes.id')
            ->whereIn('new_groupe_new_module.module_id', $moduleIds)
            ->pluck('groupes.id');

        // Récupérer les détails des groupes associés
        $groupes = NewGroupe::whereIn('id', $groupesIds)
            ->select('id', 'matricule', 'niveau')
            ->with('stagiaires') // Charger les stagiaires associés à chaque groupe
            ->get();

        $formateur = Auth::user();
        return view('formateur.gestion_GroupesF', ['groupes' => $groupes], compact('formateur'));
    }


    public function filtrerGroupesF(Request $request)
    {

        $formateurId = Auth::guard('formateur')->user()->id;
        $matricule = $request->input('matricule');
        $niveau = $request->input('niveau');

        $moduleIds = NewModule::where('formateur_id', $formateurId)->pluck('id');
        $groupesIds = NewGroupe::join('new_groupe_new_module', 'new_groupe_new_module.groupe_id', '=', 'groupes.id')
            ->whereIn('new_groupe_new_module.module_id', $moduleIds)
            ->pluck('groupes.id');

        $query = NewGroupe::whereIn('id', $groupesIds);
        $customQueryBuilder = new CustomQueryBuilder();
        $data = [
            'f' => [
                [
                    'column' => 'matricule',
                    'operator' => 'startsWith',
                    'query_1' => $matricule,
                    'match' => 'and'
                ],
                [
                    'column' => 'niveau',
                    'operator' => 'startsWith',
                    'query_1' => $niveau,
                    'match' => 'and'
                ],
            ],
            'filter_match' => 'and'
        ];
        $query = $customQueryBuilder->apply($query, $data);

        $groupes = $query->get();

        return view('formateur.gestion_GroupesF', ['groupes' => $groupes]);
    }

    public function showModulesF()
    {
        // Récupérer l'ID du formateur connecté
        $formateurId = Auth::guard('formateur')->user()->id;

        // Récupérer les modules associés à ce formateur
        $modules = NewModule::where('formateur_id', $formateurId)->get();

        $formateur = Auth::user();
        return view('formateur.gestion_ModulesF', ['modules' => $modules], compact('formateur'));
    }

    public function filtrerModulesF(Request $request)
    {
        $formateurId = Auth::guard('formateur')->user()->id;
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
        $query->where('formateur_id', $formateurId); // Utiliser formateur_id pour filtrer les modules du formateur connecté
        $modules = $query->get();

        return view('formateur.gestion_ModulesF', ['modules' => $modules]);
    }

    public function profilF(){
        $formateur = Auth::guard('formateur')->user();
        $email = str_replace('@taalim.ma', '', $formateur->email);
        return view( "formateur.profilF", ['formateur' => $formateur], compact('email') );
    }


}
