<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Material;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Categoria extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function materials()
    {
        return $this->hasMany(Material::class);
    }

    public function vinculos(): BelongsToMany
    {
        return $this->belongsToMany(Vinculo::class);
    }

    public function setores(): BelongsToMany
    {
        return $this->belongsToMany(Setor::class);
    }
}
