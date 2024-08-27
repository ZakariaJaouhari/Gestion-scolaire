<?php

namespace App\Http\Controllers;

use App\Models\NewGroupe;
use App\Models\NewModule;
use App\Models\NewNote;
use App\Models\NewStagiaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class NotesController extends Controller
{
    //
    public function downloadpage(){
        $stagiaire = Auth::guard('stagiaire')->user();
        $modules = NewModule::whereIn('id', function ($query) use ($stagiaire){
            $query->select('module_id')
                ->from('new_groupe_new_module')
                ->where('groupe_id', $stagiaire->groupe_id);
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

        return view('directeur.resultat',['modules' => $modules, 'notes' => $notes], compact('stagiaire', 'totalCoefficient', 'totalScore'));
    }
    public function downloadpdf($id){
        $stagiaire = NewStagiaire::findOrFail($id);
        $modules = NewModule::whereIn('id', function ($query) use ($stagiaire){
            $query->select('module_id')
                ->from('new_groupe_new_module')
                ->where('groupe_id', $stagiaire->groupe_id);
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
        $pdf = Pdf::loadView('directeur.resultat',['modules' => $modules, 'notes' => $notes], compact('stagiaire', 'totalCoefficient', 'totalScore'));
        return $pdf->download('downloadedpdf.pdf');
    }




    public function showNotesF(Request $request)
    {
        
        $formateurId = auth()->guard('formateur')->user()->id;

        
        $moduleIds = NewModule::where('formateur_id', $formateurId)->pluck('id');

        $groupesIds = NewGroupe::join('new_groupe_new_module', 'new_groupe_new_module.groupe_id', '=', 'groupes.id')
            ->whereIn('new_groupe_new_module.module_id', $moduleIds)
            ->pluck('groupes.id');

        $groupes = NewGroupe::whereIn('id', $groupesIds)
            ->select('id', 'matricule', 'niveau')
            ->with('stagiaires')
            ->with('modules')
            ->get();

        $modules = NewModule::where('formateur_id', $formateurId)->get();


        $formateur = Auth::user();




        


        return view('formateur.gestion_NotesF', ['groupes' => $groupes,'modules' => $modules], compact('formateur'));
    }

    public function filter(Request $request)
    {
        $groupId = $request->input('groupe');
        $moduleId = $request->input('module');

        $module = NewModule::find($moduleId);
        $formateurId = auth()->guard('formateur')->user()->id;

        $stagiaires = NewStagiaire::where('groupe_id', $groupId)->get();

        $notes = NewNote::whereIn('stagiaire_id', $stagiaires->pluck('id'))
            ->where('module_id', $moduleId)
            ->get();


        $moduleIds = NewModule::where('formateur_id', $formateurId)->pluck('id');

        $groupesIds = NewGroupe::join('new_groupe_new_module', 'new_groupe_new_module.groupe_id', '=', 'groupes.id')
            ->whereIn('new_groupe_new_module.module_id', $moduleIds)
            ->pluck('groupes.id');

        $groupes = NewGroupe::whereIn('id', $groupesIds)
            ->select('id', 'matricule', 'niveau')
            ->with('stagiaires')
            ->with('modules')
            ->get();
        
            

        return view('formateur.affiche', ['groupes' => $groupes], compact('notes', 'stagiaires', 'module'));
    }




    public function sauvegarder(Request $request)
    {
        $notes = $request->input('notes');


        foreach ($notes as $stagiaireId => $note) {
            $existingNote = NewNote::where('stagiaire_id', $stagiaireId)
                ->where('module_id', $request->input('module'))
                ->first();


            if ($existingNote) {
                $existingNote->update(['note' => $note]);
            } else {
                $nouvelleNote = new NewNote();
                $nouvelleNote->stagiaire_id = $stagiaireId;
                $nouvelleNote->module_id = $request->input('module');
                $nouvelleNote->note = $note;
                $nouvelleNote->save();
            }
        }

        return redirect()->action([NotesController::class, 'showNotesF']);
    }

    public function showForm(Request $request)
    {
        $groupId = $request->input('groupe');
        $moduleId = $request->input('module');

        $directeurId = auth()->guard('directeur')->user()->id;
        $groupes = NewGroupe::where('directeur_id', $directeurId)->get();


        $stagiaires = NewStagiaire::where('groupe_id', $groupId)->get();
        $notes = NewNote::whereIn('stagiaire_id', function ($query) use ($groupId) {
            $query->select('id')
                ->from('stagiaires')
                ->where('groupe_id', $groupId);
        })
            ->where('module_id', $moduleId)
            ->get();

        return view('directeur.gestion_Notes', ['groupes' => $groupes, 'stagiaires' => $stagiaires] , compact('notes'));
    }



    public function filterNotesDr(Request $request)
    {
        $directeurId = auth()->guard('directeur')->user()->id;
        $groupId = $request->input('groupe');
        $moduleId = $request->input('module');

        $module = NewModule::find($moduleId);
        $groupe = NewGroupe::find($groupId);

        $stagiaires = NewStagiaire::where('groupe_id', $groupId)->get();

        $isAssociated = NewGroupe::where('id', $groupId)
            ->where('directeur_id', $directeurId)
            ->exists();

        if (!$isAssociated) {

        }

        $notes = NewNote::whereIn('stagiaire_id', function ($query) use ($groupId) {
            $query->select('id')
                ->from('stagiaires')
                ->where('groupe_id', $groupId);
        })
            ->where('module_id', $moduleId)
            ->get();

        $groupes = NewGroupe::where('directeur_id', $directeurId)->get();

        return view('directeur.gestion_Notes', ["groupes" => $groupes, 'stagiaires' => $stagiaires], compact('notes', 'module', 'groupe'));
    }
}
