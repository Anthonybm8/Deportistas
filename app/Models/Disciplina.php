<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Disciplina extends Model
{
    protected $table = 'disciplina';
    protected $primaryKey = 'IdDisciplina';
    public $timestamps = false;

    protected $fillable = [
        'NombreDisciplina'
    ];

    // --- Relaciones ---
    public function deportistas()
    {
        return $this->hasMany(Deportista::class, 'IdDisciplina', 'IdDisciplina');
    }
}
