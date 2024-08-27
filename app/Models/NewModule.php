<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewModule extends Model
{
    use HasFactory;
    protected $table = 'modules';

    protected $fillable = [
        'nom',
        'matricule',
        'date_D',
        'date_F',
        'heures_P',
        'formateur_id',
        'directeur_id',
        'coefficient'
    ];

    public function Groupe()
    {
        return $this->belongsToMany(NewGroupe::class);
    }

    public function formateur()
    {
        return $this->belongsTo(NewFormateur::class, "formateur_id");
    }

    public function Directeur()
    {
        return $this->belongsTo(NewDirecteur::class, "directeur_id");
    }

    public function exams(){
        return $this->hasMany(NewExam::class, "module_id");
    }
}
