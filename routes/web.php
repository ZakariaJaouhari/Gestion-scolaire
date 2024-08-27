<?php

use App\Http\Controllers\CertificatController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DirecteurController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\FormateurController;
use App\Http\Controllers\GroupeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\NotesController;
use App\Http\Controllers\StagiaireController;
use App\Models\NewGroupe;
use Illuminate\Support\Facades\Auth;


Route::middleware('auth')->group(function () {
    
    Route::get('directeur', [DirecteurController::class, 'profil'])->name('profil');
});

Route::get('pagehome', [DirecteurController::class, 'pagehome'])->name('pagehome');


Route::get('gestG', function () {
    return view('directeur.gestion_Groupes');
})->name('groupes');



Route::post('createnew', [DirecteurController::class, 'Ajouter']);

Route::get('ajouF', function () {
    return view('directeur.ajouter_Formateur');
})->name('ajouF');

Route::get('ajouS', [StagiaireController::class, 'formA'])->name('ajouS');
Route::get('ajouGr', [GroupeController::class, 'formAG'])->name('ajouGr');
Route::get('ajouM', [ModuleController::class, 'formAM'])->name('ajouM');

Route::post('createnewF', [FormateurController::class, 'Ajouter']);
Route::post('createnewG', [GroupeController::class, 'Ajouter']);
Route::post('createnewS', [StagiaireController::class, 'Ajouter']);
Route::post('createnewM', [ModuleController::class, 'Ajouter']);



Route::get('gestF', [FormateurController::class, 'showFormateurs'])->name('formateurs');
Route::get('gestM', [ModuleController::class, 'showModules'])->name('modules');
Route::get('gestS', [StagiaireController::class, 'showStagiaires'])->name('stagiaires');
Route::get('gestG', [GroupeController::class, 'showGroupes'])->name('groupes');
Route::get('gestC', [CertificatController::class, 'gestionC'])->name('gestionC');
Route::get('gestCP/{id}', [CertificatController::class, 'pret'])->name('pret');
Route::get('gestCL/{id}', [CertificatController::class, 'livre'])->name('livre');
Route::put('/changepasswordD', [DirecteurController::class, 'changepasswordD'])->name('changepasswordD');
Route::put('updateD', [DirecteurController::class, 'updateD'])->name('updateD');


Route::get('ajouterexam', [ExamController::class, 'Ajouter'])->name('ajouter_exam');
Route::get("deleteE/{id}",[ExamController::class,"deleteE"]);



Route::get("delete/{id}",[FormateurController::class,"delete"]);
Route::get('edit/{id}', [FormateurController::class, 'edit'])->name('formateur.edit');
Route::put('update/{id}', [FormateurController::class, 'update'])->name('formateur.update');
Route::get("deleteS/{id}",[StagiaireController::class,"deleteS"]);
Route::get('editS/{id}', [StagiaireController::class, 'editS'])->name('stagiaireeditS');
Route::put('updateS/{id}', [StagiaireController::class, 'updateS'])->name('stagiaire.update');
Route::get("deleteM/{id}",[ModuleController::class,"deleteM"]);
Route::get('editM/{id}', [ModuleController::class, 'editM'])->name('module.edit');
Route::put('updateM/{id}', [ModuleController::class, 'updateM'])->name('module.update');
Route::get("deleteG/{id}",[GroupeController::class,"deleteG"]);
Route::get('editG/{id}', [GroupeController::class, 'editG'])->name('groupe.edit');
Route::put('updateG/{id}', [GroupeController::class, 'updateG'])->name('groupe.update');




Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login'); 
Route::get('/logout', [LoginController::class, 'logout'])->name("logout");  


Route::post('/filtrer-formateurs', [FormateurController::class, 'filtrerFormateurs'])->name('filtrer_formateurs');
Route::post('/filtrer-stagiaires', [StagiaireController::class, 'filtrerStagiaires'])->name('filtrer_stagiaires');
Route::post('/filtrer-modules', [ModuleController::class, 'filtrerModules'])->name('filtrer_modules');
Route::post('/filtrer-groupes', [GroupeController::class, 'filtrerGroupes'])->name('filtrer_groupes');



Route::get('pagehomeF', [FormateurController::class, 'pagehomeF'])->name('pagehomeF');
Route::get('groupesF', [FormateurController::class, 'groupesF'])->name('groupesF');
Route::post('/filtrer-groupesF', [FormateurController::class, 'filtrerGroupesF'])->name('filtrer_groupesF');
Route::get('gestMF', [FormateurController::class, 'showModulesF'])->name('modulesF');
Route::post('/filtrer-modulesF', [FormateurController::class, 'filtrerModulesF'])->name('filtrer_modulesF');
Route::get('gestNF', [NotesController::class, 'showNotesF'])->name('notesF');


Route::get('/get-groupes', [NotesController::class, 'getGroupes'])->name('get-groupes');
Route::get('/get-modules/{groupId}', [NotesController::class, 'getModules']);
Route::get('/get-stagiaires/{moduleId}', [NotesController::class, 'getStagiaires']);
Route::post('/sauvegarder', [NotesController::class, 'sauvegarder'])->name('sauvegarder');
Route::post('/filter-notesD', [NotesController::class, 'filterNotesDr'])->name('filter.notesDr');
Route::get('/filter-notes', [NotesController::class, 'showForm'])->name('showForm');

Route::get('/get-note/{stagiaireId}/{groupeId}',[NotesController::class, 'getnote'])->name('getnote');
Route::get('/get-modules/{groupeId}',[NotesController::class, 'getmodules'])->name('getmodules');
Route::get('/get-stagiaires/{groupeId}',[NotesController::class, 'getstagiaires'])->name('getstagiaires');

Route::post('/filter-notes', [NotesController::class, 'filter'])->name('filter.notes');
Route::get('/profilF', [FormateurController::class, 'profilF'])->name('profilF');
Route::put('/changepassword', [FormateurController::class, 'changepassword'])->name('changepassword');



Route::get('pagehomeS', [StagiaireController::class, 'pagehomeS'])->name('pagehomeS');
Route::get('gestMS', [StagiaireController::class, 'modulesS'])->name('modulesS');
Route::post('/filtrer-modulesS', [StagiaireController::class, 'filtrerModulesS'])->name('filtrer_modulesS');
Route::get('/profilS', [StagiaireController::class, 'profilS'])->name('profilS');
Route::put('/changepasswordS', [StagiaireController::class, 'changepasswordS'])->name('changepasswordS');
Route::get('/notesS', [StagiaireController::class, 'notesS'])->name('notesS');
Route::get('certificatS', [CertificatController::class, 'pageCertificat'])->name('pageCertificat');
Route::get('ajouterCS', [CertificatController::class, 'ajouterC'])->name('ajouterC');
Route::get('/downloadpage', [NotesController::class, 'downloadpage'])->name('downloadpage');
Route::get('downloadpdf/{id}', [NotesController::class, 'downloadpdf'])->name('downloadpdf');