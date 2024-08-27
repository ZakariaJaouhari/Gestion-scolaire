<?php

namespace App\Http\Controllers;

use App\Models\NewCertificat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CertificatController extends Controller
{
    //

    public function pageCertificat()
    {
        $stagiaire = Auth::guard('stagiaire')->user();
        $stagiaireId = Auth::guard('stagiaire')->user()->id;
        $certificats = NewCertificat::where('stagiaire_id', $stagiaireId)->latest()->get();


        return  view('stagiaire.Certificat', compact("stagiaire", "certificats"));
    }


    public function ajouterC(Request $request)
    {
        $stagiaireId = Auth::guard('stagiaire')->user()->id;
        $directeurId = Auth::guard('stagiaire')->user()->directeur_id;


        $certificat = new NewCertificat();
        $certificat->stagiaire_id = $stagiaireId;
        $certificat->directeur_id = $directeurId;
        $certificat->save();

        return  redirect()->action([CertificatController::class, 'pageCertificat']);
    }



    public function gestionC()
    {
        $certificats = NewCertificat::latest()->get();
        return view('directeur.gestion_Certificats', compact('certificats'));
    }

    public function pret($id)
    {
        $certificat = NewCertificat::findOrFail($id);
        $certificat->status = 'Prêt';
        $certificat->save();
        return redirect()->action([CertificatController::class, 'gestionC']);
    }

    public function livre(Request $request, $id)
    {
        $certificat = NewCertificat::findOrFail($id);
        $certificat->status = 'Livré';
        $certificat->save();
        return redirect()->back()->with('success', 'Certificate request rejected successfully.');
    }
}
