<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Departamento extends Model
{
    use HasFactory;

    protected $table = 'departamentos_de_ensino';

    public function cursos(): HasMany
    {
        return $this->hasMany(CursoHabilitacao::class);
    }
}