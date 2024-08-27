<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class NewStagiaire extends Authenticatable
{
    use HasFactory;
    protected $table = 'stagiaires';

    protected $fillable = [
        'nom',
        'prenom',
        'date_naissance',
        'sexe',
        'groupe_id',
        'CIN',
        'directeur_id',
        'email',
        'password',
        'profile_picture',
    ];

    public function Directeur()
    {
        return $this->belongsTo(NewDirecteur::class, "directeur_id");
    }

    public function groupe()
    {
        return $this->belongsTo(NewGroupe::class, "groupe_id");
    }

    public function notes()
    {
        return $this->hasMany(NewNote::class, "stagiaire_id");
    }

    public function certificats()
    {
        return $this->hasMany(NewCertificat::class);
    }
}
