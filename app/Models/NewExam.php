<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewExam extends Model
{
    use HasFactory;
    protected $table = 'exams';

    protected $fillable = [
        'formateur_id',
        'groupe_id',
        'module_id',
        'date_exam',
        'duree',
        'heure_exam',
    ];


    

    public function groupe()
    {
        return $this->belongsTo(NewGroupe::class, 'groupe_id');
    }

    public function module()
    {
        return $this->belongsTo(NewModule::class, 'module_id');
    }
}
