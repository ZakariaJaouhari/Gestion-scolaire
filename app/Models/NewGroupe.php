<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewGroupe extends Model
{
    use HasFactory;
    protected $table = 'groupes';

    protected $fillable = [
        'matricule',
        'niveau',
        'directeur_id',
    ];

    // public function Formateurs(){
    //     return $this->belongsToMany(NewFormateur::class);
    // }

    public function Modules(){
        return $this->belongsToMany(NewModule::class, 'new_groupe_new_module', 'groupe_id', 'module_id');
    }

    public function stagiaires()
    {
        return $this->hasMany(NewStagiaire::class, 'groupe_id');
    }

    public function Directeur()
    {
        return $this->belongsTo(NewDirecteur::class, "directeur_id");
    }

    public function exams(){
        return $this->hasMany(NewExam::class, "groupe_id");
    }
}
