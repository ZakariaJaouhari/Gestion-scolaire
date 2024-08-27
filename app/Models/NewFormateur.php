<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewFormateur extends Authenticatable
{
    use HasFactory;
    protected $table = 'formateurs';

    protected $fillable = [
        'nom',
        'prenom',
        'matricule',
        'sexe',
        'date_naissance',
        'CIN',
        'date_recrutement',
        'email',
        'directeur_id',
        'password',
        'profile_picture',
        'situation',
    ];

    public function Directeurs()
    {
        return $this->belongsTo(NewDirecteur::class, "directeur_id");
    }

    public function exams(){
        return $this->hasMany(NewExam::class, "formateur_id");
    }

    public function Modules(){
        return $this->hasMany(NewModule::class, "formateur_id");
    }
}
