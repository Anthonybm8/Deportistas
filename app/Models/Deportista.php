<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deportista extends Model
{
    protected $table = 'Deportistas'; 
    protected $primaryKey = 'IdDeportista';
    public $timestamps = false;

    protected $fillable = [
        'Nombre',
        'Apellido',
        'IdPais',
        'IdDisciplina',
        'Fecha',
        'Estatura',
        'Peso'
    ];

    public function pais()
    {
        return $this->belongsTo(Pais::class, 'IdPais', 'IdPais');
    }

    public function disciplina()
    {
        return $this->belongsTo(Disciplina::class, 'IdDisciplina', 'IdDisciplina');
    }
}
