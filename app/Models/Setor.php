<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Setor extends Model
{
    use HasFactory;

    protected $table = 'setores';

    protected $guarded = ['id'];

    public function cursos(): HasMany
    {
        return $this->hasMany(CursoHabilitacao::class);

    }

    public function categorias(): BelongsToMany
    {
        return $this->belongsToMany(Categoria::class);
    }
}
