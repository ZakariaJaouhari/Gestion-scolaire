<?php

namespace App\Http\Controllers;

use App\Models\NewFormateur;
use App\Models\NewGroupe;
use App\Models\NewModule;
use App\Models\NewStagiaire;
use App\Support\CustomQueryBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GroupeController extends Controller
{
    //
    public function Ajouter(Request $request)
    {
        $directeurId = Auth::guard('directeur')->user()->id;

        $validatedData = $request->validate([

            'matricule' => 'required|string',
            'niveau' => 'required|in:1ér année,2éme année',


        ], [
            'matricule.required' => 'Le champ matricule est requis.',
            'niveau.required' => 'Le champ niveau est requis.',
            'niveau.in' => 'Le champ niveau doit être soit "1ér année" soit "2éme année".',
        ]);
        
        // dd($validatedData['niveau']);

        $groupe = NewGroupe::create([
            'matricule' => $validatedData['matricule'],
            'niveau' => $validatedData['niveau'],
            'directeur_id' => $directeurId,
        ]);

        $groupe->Modules()->attach($request->modules);


        return redirect()->action([GroupeController::class, 'showGroupes']);
    }

    public function showGroupes()
    {
        $directeur = Auth::guard('directeur')->user();
        $groupe = NewGroupe::with('modules');
        $groupes = $directeur->groupes;
        return view('directeur.gestion_Groupes', ['groupes' => $groupes], compact("groupe"));
    }

    public function deleteG(string $id)
    {
        NewStagiaire::where('groupe_id', $id)->delete();
        //DB::delete("delete from etudiants where id='$id'");
        NewGroupe::destroy($id);
        return redirect()->action([GroupeController::class, 'showGroupes']);
    }

    public function formAG()
    {
        $directeur = Auth::guard('directeur')->user();

        $groupes = $directeur->groupes;
        $modules = $directeur->modules;
        return view('directeur.ajouter_Groupe', ['groupes' => $groupes, 'modules' => $modules]);
    }

    public function editG($id)
    {
        $directeur = Auth::guard('directeur')->user();
        $modules = $directeur->modules;
        $groupe = NewGroupe::findOrFail($id);

        return view('directeur.modifierG',['modules' => $modules], compact('groupe'));
    }


    public function updateG(Request $request, $id)
    {

        $validatedData = $request->validate([
            'matricule' => 'required|string',
            'niveau' => 'required|in:1ér année,2éme année',

        ]);

        $groupe = NewGroupe::findOrFail($id);

        $groupe->matricule = $validatedData['matricule'];
        $groupe->niveau = $validatedData['niveau'];
        $groupe->Modules()->sync($request->modules);

        $groupe->save();

        return redirect()->action([GroupeController::class, 'showGroupes']);
    }

    public function filtrerGroupes(Request $request)
    {
        $directeurId = Auth::guard('directeur')->user()->id;
        $matricule = $request->input('matricule');
        $niveau = $request->input('niveau');

        $query = NewGroupe::query();
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
        $query->where('directeur_id', $directeurId);

        $groupes = $query->get();

        return view('Directeur.gestion_Groupes', ['groupes' => $groupes]);
    }
}
