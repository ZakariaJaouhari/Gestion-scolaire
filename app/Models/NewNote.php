<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewNote extends Model
{
    use HasFactory;
    protected $table = 'notes';

    protected $fillable = ['stagiaire_id', 'module_id', 'note'];



    public function stagiaire(){
        return $this->belongsTo(NewStagiaire::class , 'stagiaire_id');
    }
}
