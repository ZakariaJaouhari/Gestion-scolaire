<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewCertificat extends Model
{
    use HasFactory;
    protected $table = 'certificats';
    protected $fillable = [
        'nom', 
        'description', 
        'stagiaire_id', 
        'directeur_id'
    ];

    public function stagiaire()
    {
        return $this->belongsTo(NewStagiaire::class);
    }

    public function directeur()
    {
        return $this->belongsTo(NewDirecteur::class);
    }
}
