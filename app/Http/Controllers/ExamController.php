<?php

namespace App\Http\Controllers;

use App\Models\NewExam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ExamController extends Controller
{
    //
    public function Ajouter(Request $request)
    {

        $formateurId = Auth::guard('formateur')->user()->id;


        $validatedData = $request->validate([
            'groupe' => 'required|string',
            'module' => 'required|string',
            'date_exam' => 'required',
            'duree' => 'required|string',
            'heure_exam' => 'required',

        ]);

        


        NewExam::create([
            'groupe_id' => $validatedData['groupe'],
            'module_id' => $validatedData['module'],
            'date_exam' => $validatedData['date_exam'],
            'duree' => $validatedData['duree'],
            'heure_exam' => $validatedData['heure_exam'],
            'formateur_id' => $formateurId,
        ]);


        return redirect()->back();
    }


    public function deleteE(string $id)
    {
        //DB::delete("delete from etudiants where id='$id'");
        DB::table('exams')->where('id', '=', $id)->delete();
        return redirect()->back();
    }
    
}
