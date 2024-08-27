<?php

namespace App\Http\Controllers;

use App\Models\NewFormateur;
use App\Models\NewModule;
use App\Support\CustomQueryBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ModuleController extends Controller
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
            'matricule' => 'required|string',
            'dayD' => 'required|numeric',
            'monthD' => 'required|numeric',
            'yearD' => 'required|numeric',
            'dayF' => 'required|numeric',
            'monthF' => 'required|numeric',
            'yearF' => 'required|numeric',
            'heures_P' => 'required|string',
            'coefficient' => 'required|string',
            'formateur' => 'required|string',

        ], $customMessages);
        

        $date_D = $validatedData['yearD'] . '-' . $validatedData['monthD'] . '-' . $validatedData['dayD'];
        $date_F = $validatedData['yearF'] . '-' . $validatedData['monthF'] . '-' . $validatedData['dayF'];
        $heures_P = $validatedData['heures_P'] . '/heures';

        NewModule::create([
            'nom' => $validatedData['nom'],
            'matricule' => $validatedData['matricule'],
            'date_D' => $date_D,
            'date_F' => $date_F,
            'heures_P' => $heures_P,
            'formateur_id' => $validatedData['formateur'],
            'directeur_id' => $directeurId,
            'coefficient' => $validatedData['coefficient'],
        ]);
       
        return redirect()->action([ModuleController::class, 'showModules']);
    }

    public function showModules()
    {
        $directeur = Auth::guard('directeur')->user();
        $modules = $directeur->modules;
        return view('directeur.gestion_Modules', ['modules' => $modules]);
    }

    public function deleteM(string $id)
    {
        //DB::delete("delete from etudiants where id='$id'");
        DB::table('modules')->where('id','=',$id)->delete();
        return redirect()->action([ModuleController::class, 'showModules']);
    }

    public function formAM()
    {
        $directeur = Auth::guard('directeur')->user();

        $formateurs = $directeur->formateurs;
        return view('directeur.ajouter_Module', ['formateurs' => $formateurs]);
    }

    public function editM($id)
    {
        $directeur = Auth::guard('directeur')->user();
        $formateurs = $directeur->formateurs;
        $module = NewModule::findOrFail($id);
        $heures_P = str_replace('/heures', '', $module->heures_P);

        return view('directeur.modifierM', compact('module', 'formateurs', 'heures_P'));
    }


    public function updateM(Request $request, $id)
    {
        $directeurId = Auth::guard('directeur')->user()->id;

        $validatedData = $request->validate([
            'nom' => 'required|string',
            'matricule' => 'required|string',
            'dayD' => 'required|numeric',
            'monthD' => 'required|numeric',
            'yearD' => 'required|numeric',
            'dayF' => 'required|numeric',
            'monthF' => 'required|numeric',
            'yearF' => 'required|numeric',
            'heures_P' => 'required|string',
            'coefficient' => 'required|string',
            'formateur' => 'required|string',

        ]);

        $date_D = $validatedData['yearD'] . '-' . $validatedData['monthD'] . '-' . $validatedData['dayD'];
        $date_F = $validatedData['yearF'] . '-' . $validatedData['monthF'] . '-' . $validatedData['dayF'];
        $heures_P = $validatedData['heures_P'] . '/heures';

        $module = NewModule::findOrFail($id);

        $module->nom = $validatedData['nom'];
        $module->matricule = $validatedData['matricule'];
        $module->date_D = $date_D;
        $module->date_F = $date_F;
        $module->heures_P = $heures_P;
        $module->formateur_id = $validatedData['formateur'];
        $module->directeur_id = $directeurId;
        $module->coefficient = $validatedData['coefficient'];

        $module->save();

        return redirect()->action([ModuleController::class, 'showModules']);
    }

    public function filtrerModules(Request $request)
    {
        $directeurId = Auth::guard('directeur')->user()->id;
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
        $query->where('directeur_id', $directeurId);
        $modules = $query->get();

        return view('Directeur.gestion_Modules', ['modules' => $modules]);
    }

}
