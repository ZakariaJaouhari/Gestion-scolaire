<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;
class NewDirecteur extends User
{
    use HasFactory;
    protected $table = 'directeurs';

    protected $fillable = [
        'nom_ecole',
        'nom_directeur',
        'email',
        'profile_picture',
        'academie',
        'direction',
        'annee',
        'password',
    ];

    public function Formateurs(){
        return $this->hasMany(NewFormateur::class, "directeur_id");
    }

    public function Stagiaires(){
        return $this->hasMany(NewStagiaire::class, "directeur_id");
    }

    public function Groupes(){
        return $this->hasMany(NewGroupe::class, "directeur_id");
    }

    public function Modules(){
        return $this->hasMany(NewModule::class, "directeur_id");
    }

    public function certificats()
    {
        return $this->hasMany(NewCertificat::class);
    }
}
