<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Vinculo extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    

    public function categorias(): BelongsToMany
    {
        return $this->belongsToMany(Categoria::class);
    }
}
