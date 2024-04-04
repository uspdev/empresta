<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CursoHabilitacao extends Model
{
    use HasFactory;

    protected $table = 'cursos_habilitacoes';

    public function setor(): BelongsTo
    {
        return $this->belongsTo(Setor::class);
    }
}
