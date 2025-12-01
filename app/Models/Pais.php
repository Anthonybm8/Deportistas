<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
    protected $table = 'pais';
    protected $primaryKey = 'IdPais';
    public $timestamps = false;

    protected $fillable = [
        'NombrePais'
    ];

    // --- Relaciones ---
    public function deportistas()
    {
        return $this->hasMany(Deportista::class, 'IdPais', 'IdPais');
    }
}
